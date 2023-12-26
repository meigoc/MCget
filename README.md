# :bird: McGet - Send a request for server or player data in minecraft.
[![made-with-jphp](https://img.shields.io/badge/Made_with_JPHP-1f425f)](http://jphp.develnext.org/)
[![License: GPL v3](https://img.shields.io/github/license/pterodactyl-installer/pterodactyl-installer)](LICENSE)
[![built-on-meigoapi](https://img.shields.io/badge/Built_on_MeigoAPI_v4.9-1f425f)](LICENSE)

Using this utility or our API, you can send requests to get the server or player information you need. You can get information about the plugin, players playing on the server, MOTD and much more.

## Features

coming soon

## Documentation

Player list
```php
<?php
$players = file_get_contents("https://api.mgo.lol/meigoapi/49/players/list/?ip=mon.skybars.net");

echo $players;
?>
```

## Install

## Supported operating systems

:white_check_mark: - It works, it's been tested.
:red_circle: - McGet is not supported on this operating system
:yellow_circle: - Probably mcget should work on this system, however this has not been tested.

| Operating System | Version | Supported          |
| ---------------- | ------- | ------------------ |
| Windows          | 11      | :white_check_mark: |
|                  | 10      | :white_check_mark: |
|                  | 8.1     | :yellow_circle:    |
|                  | 8       | :yellow_circle:    |
|                  | 7       | :white_check_mark: |
|                  | Vista   | :yellow_circle: \* |
|                  | XP      | :yellow_circle: \* |
| Ubuntu           | 14.04   | :red_circle:       |
|                  | 16.04   | :red_circle:       |
|                  | 18.04   | :red_circle:       |
|                  | 20.04   | :yellow_circle:    |
|                  | 22.04   | :yellow_circle:    |

## Contributors ✨

coming soon
