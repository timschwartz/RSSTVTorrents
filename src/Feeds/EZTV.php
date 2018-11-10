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
            if(stripos($title, "720p") === false) continue;

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

            $MB = 1024 * 1024;
            if($size < 100 * $MB) continue;
            
            $url = $data['magnetURI'][0]['data'];

            if(!isset($this->torrents[$title])) $this->torrents[$title] = array();
            $this->torrents[$title][$episode] = $url;
        }

        return $this->torrents;
    }

/*
    public static function checkFeedURL($url)
    {
        if(in_array($url, self::$valid_feeds)) return true;
        
        return false;
    }
*/
}
