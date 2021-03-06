<?php

namespace timschwartz\RSSTVTorrents\Feeds;

use timschwartz\RSSTVTorrents\RSS;

class EZTV extends RSS
{
    public static $valid_feeds = array("https://eztv.re/ezrss.xml");

    public function getTorrents()
    {
        if(count($this->torrents)) return $this->torrents;

        foreach($this->items as $item)
        {
            $title = $item->get_title();

            $resolution = "SD";
            if(stripos($title, "720p") !== false) $resolution = "720p";
            if(stripos($title, "1080p") !== false) $resolution = "1080p";

            // Check for S01E01 format
            $title_match = preg_match("/S\d\dE\d\d/i", $title, $matches);
 
            if(!$title_match)
            {
                // Check for YYYY MM DD format
                $title_match = preg_match("/\d\d\d\d \d\d \d\d/", $title, $matches);
            }

            if(!$title_match) continue;

            $title_parts = explode($matches[0], $title);
            $title = trim($title_parts[0]);
            $episode = $matches[0];

            $data = $item->data['child']['http://xmlns.ezrss.it/0.1/'];
            $size = $data['contentLength'][0]['data'];

            $url = $data['magnetURI'][0]['data'];

            if(!isset($this->torrents[$title])) $this->torrents[$title] = array();
            if(!isset($this->torrents[$title][$episode])) $this->torrents[$title][$episode] = array();
            array_push($this->torrents[$title][$episode],
                array('magnetURI'=>$url, 'size'=>$size, 'resolution'=>$resolution)
            );
        }

        return $this->torrents;
    }
}
