# McGet V2.0 is developed to be 40% complete.

Current Tasks:
- ~~Detailed download of the program, including downloading various php scripts with the path.~~ **- DONE**
- ~~Add the "about" command~~ **- DONE**
- ~~More beautiful text formatting using different symbols and emoji.~~ **- DONE**
- ~~Program optimization, code simplification.~~ **- DONE**
- ~~Get the location of the server, as well as its hosting.~~ **- DONE**
- ~~Requests to the webserver (webrequest)~~ **- DONE%**
- Detailed information about the player **- 2%**
- Detailed information about servers **- 95%**
- Add search history **- 12%**
- Multilanguage application **- 3%**
- Ability to create mods using the API. **- 1%**

# :bird: McGet - Send a request for server or player data in minecraft.
[![made-with-jphp](https://img.shields.io/badge/Made_with_JPHP-1f425f)](http://jphp.develnext.org/)
[![License: GPL v3](https://img.shields.io/github/license/pterodactyl-installer/pterodactyl-installer)](LICENSE)
[![built-on-meigoapi](https://img.shields.io/badge/Built_on_MeigoAPI_v5.0-1f425f)](LICENSE)

Using this utility or our API, you can send requests to get the server or player information you need. You can get information about the plugin, players playing on the server, MOTD and much more.

## Features

coming soon

## Documentation (MeigoAPI v5.0)

Player list
```php
$status = json_decode(file_get_contents("http://api.mgo.lol/meigoapi/50/json.php?ip=mon.skybars.net"));
   foreach ($status->players->list as $player) {
	    echo $player.'\n';
   }
```

## Bedrock Documentation (MeigoAPI v5.0) [Bedrock]

(Bedrock) Players
```php
$a = json_decode(file_get_contents("http://api.mgo.lol/meigoapi/50/bedrock.php?ip=play.nethergames.net"));
echo "Players: ".$a->players->online."/".$a->players->max."\n";
```

## McGet Documentation

Latest Update
```php
$a = file_get_contents("https://api.mgo.lol/mcget/latestupdate");
echo $a;
```

## Install

Run start.bat

or

```yaml
@echo off
chcp 65001
echo V1.9.2 Downloaded from https://github.com/meigoc/MCget/
echo --------------------
java -Xmx1024M -jar "McGetRecrafted.jar"
echo --------------------
echo Downloaded from https://github.com/meigoc/MCget/
pause
```

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

## Version History
[![tag](https://4.vercel.app/static/tag/555/v1.9.6/84bf96?icon=tag)](../../releases)

| Date             | Version        | Build                     | Built on MeigoAPI    | Language           | Size of the update |
| ---------------- | -------------- | ------------------------- | -------------------- | ------------------ | ------------------ |
| 27.12.2023       | v2.0 :moneybag:| 27122023_01               | MeigoAPI v5.0 :fire: | PHP: 5.6.99        | ?                  |
| 26.12.2023       | v2.0 BETA      | 26122023_04               | MeigoAPI v5.0 :fire: | PHP: 5.6.99        | ?                  |
| 26.12.2023       | v2.0 BETA      | 26122023_03               | MeigoAPI v4.1 & v4.9 | PHP: 5.6.99        | 3.63 MB            |
| 26.12.2023       | v2.0 BETA      | 26122023_02               | MeigoAPI v4.1 & v4.9 | PHP: 5.6.99        | 2.96 MB            |
| 25.12.2023       | v2.0 BETA      | 25122023_01               | MeigoAPI v4.1 & v4.9 | PHP: 5.6.99        | 2.96 MB            |
| 31.08.2023       | v1.7.1 :fire:  | 31082023_01               | MeigoAPI v4.1        | PHP: 5.6.99        | 3.27 MB            |
| 30.08.2023       | v1.7 :fire:    | 30082023_05               | MeigoAPI v4.1        | PHP: 5.6.99        | 3.27 MB            |
| 30.08.2023       | v1.6           | 30082023_04               | MeigoAPI v4.0        | PHP: 5.6.99        | 3.27 MB            |
| 30.08.2023       | v1.5           | 30082023_03               | MeigoAPI v4.0        | PHP: 5.6.99        | 3.27 MB            |
| 30.08.2023       | v1.4.1 :fire:  | 30082023_02               | MeigoAPI v3.0        | PHP: 5.6.99        | 3.27 MB            |
| 30.08.2023       | v1.4           | 30082023_01               | MeigoAPI v2.0        | PHP: 5.6.99        | 3.27 MB            |
| 29.08.2023       | v1.2           | 29082023_03               | Does not have an API | PHP: 5.6.99        | 3.27 MB            |
| 29.08.2023       | v1.1           | 29082023_02               | Does not have an API | PHP: 5.6.99        | 3.27 MB            |
| 29.08.2023       | v1.0           | 29082023_01               | Does not have an API | PHP: 5.6.99        | 3.3 MB             |
## Contributors ✨

coming soon
