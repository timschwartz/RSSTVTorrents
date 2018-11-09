<?php

namespace timschwartz\RSSTVTorrents;

use \Feeds;

abstract class RSS
{
    protected $feed;
    protected $items;
    protected $torrents = array();

    public function __construct($url)
    {
        $this->feed = Feeds::make($url);
        $this->items = $this->feed->get_items();
    }

    abstract public function getTorrents();
    abstract public static function checkFeedURL($url);
}
