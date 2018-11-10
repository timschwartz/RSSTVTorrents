<?php

namespace timschwartz\RSSTVTorrents;

class RSSParser
{
    private $skip = array(".", "..", "RSS.php", "RSSParser.php");

    public function getTorrents($url)
    {
        // Match feed with a class
        $class = null;

        $dir = scandir(__DIR__."/Feeds");
        foreach($dir as $file)
        {
            if(in_array($file, $this->skip)) continue;
            if(stripos($file, ".php") === false) continue;

            $classname = "timschwartz\\RSSTVTorrents\\Feeds\\".str_replace(".php", "", $file);
            if($classname::checkFeedURL($url)) $class = new $classname($url);
        }

        if($class == null) throw new \Exception('Could not find a parser for feed: '.$url);

        return $class->getTorrents();
    }
}
