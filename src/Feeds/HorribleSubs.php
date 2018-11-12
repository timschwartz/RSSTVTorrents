<?php

namespace timschwartz\RSSTVTorrents\Feeds;

use timschwartz\RSSTVTorrents\RSS;

class HorribleSubs extends RSS
{
    public static $valid_feeds = array("https://horriblesubs.info/rss.php?res=all",
                                        "https://horriblesubs.info/rss.php?res=sd",
                                        "https://horriblesubs.info/rss.php?res=720",
                                        "https://horriblesubs.info/rss.php?res=1080");

    public function getTorrents()
    {
        if(count($this->torrents)) return $this->torrents;

        foreach($this->items as $item)
        {
            $title = $item->get_title();

            $resolution = "SD";
            if(stripos($title, "720p") !== false) $resolution = "720p";
            if(stripos($title, "1080p") !== false) $resolution = "1080p";

            $title_parts = explode(" - ", $title);
            if(count($title_parts) == 1) continue;

            $title = str_replace("[HorribleSubs] ", "", $title_parts[0]);

            if(count($title_parts) == 3)
            {
                $title.= " - ".$title_parts[1];
                $episode_parts = explode(" ", $title_parts[2]);
                $episode = $episode_parts[0];
            }
            else
            {
                $episode_parts = explode(" ", $title_parts[1]);
                $episode = $episode_parts[0];
            }

            if(!isset($this->torrents[$title])) $this->torrents[$title] = array();
            if(!isset($this->torrents[$title][$episode])) $this->torrents[$title][$episode] = array();

            array_push($this->torrents[$title][$episode],
                array('magnetURI'=>$item->get_permalink(), 'resolution'=>$resolution)
            );
        }

        return $this->torrents;
    }
}
