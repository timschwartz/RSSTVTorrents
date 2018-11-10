# RSSTVTorrents
Parses RSS feeds and returns an array of TV shows and torrents

## Usage

```
$parser = new RSSParser();
print_r($parser->getTorrents($url));
```

### Output

```
Array
(
    [Public Domain Show] => Array
        (
            [S01E06] => magnet:?xt=...
            [S01E07] => magnet:?xt=...
        )

    [Another Uncopyrighted Show] => Array
        (
            [S10E03] => magnet:?xt=...
        )
)
```
