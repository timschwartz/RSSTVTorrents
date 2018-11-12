<?php

namespace timschwartz\RSSTVTorrents\Feeds;

use timschwartz\RSSTVTorrents\RSS;

class GJM extends RSS
{
    public static $valid_feeds = array("https://www.goodjobmedia.com/feed/");

    public function getTorrents()
    {
        if(count($this->torrents)) return $this->torrents;

        foreach($this->items as $item)
        {
            $title_parts = explode(" – Episode ", $item->get_title());
            if(count($title_parts) == 1) continue;
            $title = $title_parts[0];
            $episode = $title_parts[1];

            $dom = new \DOMDocument;
            $dom->loadHTML($item->get_content());

            $imgs = $dom->getElementsByTagName('img');
            foreach($imgs as $img) 
            {
                $dimensions = explode(",", $img->getAttribute('data-orig-size'));
                $size = $dimensions[1]."p";
            }

            $links = $dom->getElementsByTagName('a');
            foreach($links as $link)
            {
                $url = $link->getAttribute('href');
                if(strpos($url, "magnet") === false) continue;

                if(!isset($this->torrents[$title])) $this->torrents[$title] = array();
                if(!isset($this->torrents[$title][$episode])) $this->torrents[$title][$episode] = array();
                array_push($this->torrents[$title][$episode],
                    array('magnetURI'=>$url, 'size'=>$size)
                );
            }
        }

        return $this->torrents;
    }
}
