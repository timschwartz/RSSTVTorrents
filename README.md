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
            [S01E06] => Array
                (
                    [0] => Array
                    (
                        [magnetURI] => magnet:?xt=...
                        [size] => 310368748
                        [resolution] => SD
                    )

                    [1] => Array
                    (
                        [magnetURI] => magnet:?xt=...
                        [size] => 620668788
                        [resolution] => 720p
                    )

                )

            [S01E07] => Array
                (
                    [0] => Array
                    (
                        [magnetURI] => magnet:?xt=...
                        [size] => 450748435
                        [resolution] => 720p
                    )

                    [1] => Array
                    (
                        [magnetURI] => magnet:?xt=...
                        [size] => 1150748435
                        [resolution] => 1080p
                    )

                )

        )

    [Another Uncopyrighted Show] => Array
        (
            [S10E03] => Array
                (
                    [0] => Array
                    (
                        [magnetURI] => magnet:?xt=...
                        [size] => 350478452
                        [resolution] => 720p
                    )

                )
        )
)
```
