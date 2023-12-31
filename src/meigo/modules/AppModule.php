<?php
namespace meigo\modules;

use jurl;
use std, gui, framework, meigo;
use meigo\ini\storage;
use meigo\minecraft\playerapi;


class AppModule extends AbstractModule
{

    /**
     * @event construct 
     */
    function doConstruct(ScriptEvent $e = null)
    {
        echo "| Loading INI files...\n";
        (new storage)->initialization(); // initialization ini files
        echo "█▀▄▀█ █▀▀ █▀▀ █▀▀ ▀█▀   █░█ ▄█ ░ █▀█ ░ █░█\n";
        echo "█░▀░█ █▄▄ █▄█ ██▄ ░█░   ▀▄▀ ░█ ▄ ▀▀█ ▄ ▀▀█\n";
        echo "McGet v1.9.3 (v1.9.4) | Build 01012024_01 | Developed by Meigo\n";
        $upd = file_get_contents("http://api.mgo.lol/mcget/updates/0101202401/i.txt");
        if ($upd == "0101202401"){
        echo "\n";
        } else {
            echo "==============================================\nA new update has been found! Download it from our github. For more information use the command.\n==============================================\n";
        }
        echo "* Github: @meigoc\n";
        echo "* Discord: @glebbb\n";
        echo "* Repository: github.com/meigoc/MCget\n\n";
        echo "Menu: (Commands)\n\n";
        echo "& request (java/bedrock/player) {ip} [icon/monitoring]\n";
        echo "   Example: request java hypixel.net\n";
        echo "   Example: request bedrock play.nethergames.net\n";
        echo "   Example: request java hypixel.net icon\n";
        echo "& exit\n";
        if ($upd != "0101202401"){
            echo "& infoupdate\n& downloadupdate\n";
        }
        
        
    
        $misc = new MiscStream('stdin');
        $misc->eachLine(function($line){
            $cmd = str::split($line, ' ');
            $method = 'cmd' . $cmd[0];
            
            if (method_exists($this, $method)){ // Если метод существует
                unset($cmd[0]);
                echo call_user_func_array([$this, $method], $cmd);
            } else { // неизвестная команда
                echo "Unsupported command";
            }
            
            echo "\n";
        }); 
    }



    // McGet Commands (based on MeigoAPI v5.0)

    /**
     * Command: request
     */
    function cmdrequest(...$args){
        switch ($args[0]){
            case 'java':
                if ($args[2] == "icon"){
                    echo "| (".$args[1].") A request for a server icon has been sent.\n";
                    $this->javaicon($args[1]);
                } elseif ($args[2] == "monitoring"){
                    $a = file_get_contents("https://monitoringminecraft.ru/chart/".$args[1].".png");
                    
                    if ($a == '<!DOCTYPE html><html lang="ru"><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <meta name="referrer" content="origin"/> <meta name="robots" content="noindex,nofollow" /> <title>Страница не найдена</title> <link rel="icon" type="image/x-icon" href="/favicon.png" /> <meta name="viewport" content="width=device-width, initial-scale=1"> <meta property="og:image" content="https://monitoringminecraft.ru/images/ig.png"> <link rel="apple-touch-icon" sizes="57x57" href="/themes/.default/media/ico/apple-57x57.png"> <link rel="apple-touch-icon" sizes="72x72" href="/themes/.default/media/ico/apple-72x72.png"> <link rel="apple-touch-icon" sizes="114x114" href="/themes/.default/media/ico/apple-114x114.png"> <link rel="preload" href="/themes/.default/media/fonts/ubuntu-v15-latin_cyrillic-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous"> <link rel="stylesheet" href="/themes/.default/media/css/update.min.css?c"/> </head> <body style="font-family: Ubuntu, Mc Sans Serif"> <div id="wrapper"> <div id="content"> <header><div id="header"> <div> <a href="/" title="Мониторинг серверов Minecraft">Сервера Minecraft</a> <div id="hnav"><nav> <input type="checkbox" name="menu" id="btn-menu" /> <label for="btn-menu">&nbsp;</label> <ul><li><a href="/novie-servera">Новые сервера</a></li><li><a href="/add-server">Добавить сервер</a></li><li><a href="/top">Топ серверов</a></li><li><!--noindex--><a href="/acc" rel="nofollow">Вход в ЛК</a><!--/noindex--></li><li><a href="/skachat.html" style="color:#ffff88">Скачать Майнкрафт</a></li> </ul> </nav></div> </div> </div></header> <div class="shadowi"></div> <div style="margin:0 auto; text-align:center; padding:10px; padding-top:0;"> <div style="padding:20px; padding-top:0px;"> <img src="/themes/.default/media/images/404.jpg" alt="404" style="width:100%; height:auto; max-width:350px;"> <h1>Страница не найдена</h1> <br> <div class="descr">Этой страницы никогда не было, либо она была удалена.<div style="padding-top:10px;"><b>Ищете хороший <a href="/">сервер Майнкрафт</a>?</b><br> Тогда добро пожаловать на крупнейший мониторинг в рунете.</div></div>	</div> </div> <div class="shadow"></div> </div> <div id="footer"> <div> <div> Возникли вопросы? Почитайте <a href="/faq" title="FAQ для владельцев серверов">FAQ</a><br> Или напишите нам: <a href="mailto:monitoringminecraft@gmail.com">monitoringminecraft@gmail.com</a> </div> <div> <!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=21374131&amp;from=informer" target="_blank" rel="nofollow"><img src="https://metrika-informer.com/informer/21374131/3_1_FFFFFFFF_FFFFFFFF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="21374131" data-lang="ru" /></a> <!-- /Yandex.Metrika informer --> <!--LiveInternet counter--><a href="https://www.liveinternet.ru/click" target="_blank"><img id="licnt55F0" width="88" height="31" style="border:0" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7" alt=""/></a><script>(function(d,s){d.getElementById("licnt55F0").src= "https://counter.yadro.ru/hit?t14.1;r"+escape(d.referrer)+ ((typeof(s)=="undefined")?"":";s"+s.width+"*"+s.height+"*"+ (s.colorDepth?s.colorDepth:s.pixelDepth))+";u"+escape(d.URL)+ ";h"+escape(d.title.substring(0,150))+";"+Math.random()}) (document,screen)</script><!--/LiveInternet--> </div><div class="clear"></div> </div> </div> </div> </body></html>'){
                        echo "| Unable to create a chart for this server. You might be using a server with a domain.\n";
                    } else {
                        browse("https://monitoringminecraft.ru/chart/".$args[1].".png");
                    }
                    
                    
                    
                } else {
                
                $this->java($args[1]);
                }
            break;
            
            case 'player':
                $valid = playerapi::isValidUsername($args[1]);
                if ($valid == 1){
                  $uuid = playerapi::getUuid($args[1]);
                    if ($uuid != null){
                        $abc = playerapi::getProfile("gleb_petrovich");
                        echo "& UUID: ".$uuid."\n";
                        echo "& ID: ".$abc['id']."\n";
                        echo "& Skin URL: ".playerapi::getSkinUrl($uuid)."\n";
                    }
                } else {
                    echo "| Error\n";
                }
            break;
            
            case 'bedrock':
                $this->bedrock($args[1]);
            break;
                
        }
    } 

    // DEV TOOLS
    
    function javaicon($ip){
        $a = json_decode(file_get_contents("http://api.mgo.lol/meigoapi/50/json.php?ip=".$ip));
        if ($a->icon != null){
            //
            echo "| (".$ip.") Opening the link in your browser...\n";
            browse("https://run.mgo.lol/icon/?ip=".$ip);
        } else {
            echo "# Error: This server has no icon\n";
        }
        
    }
    
    function java($ip){
        // Java Request
        $a = json_decode(file_get_contents("http://api.mgo.lol/meigoapi/50/json.php?ip=".$ip));
        // IP PORT HOSTNAME
        if ($a->ip == null){
            echo "### FATAL ERROR MEIGOAPI v5.0 | CODE ERROR: 100\n";
        } else { // fatal error
        echo "IP: ".$a->ip." (Port: ".$a->port.") ";
        if ($a->hostname != null){
            echo "[".$a->hostname."]";
        }
        echo "\n";
        // IP PORT HOSTNAME
        
        // Protocol , protocol name, version 
        echo "Protocol: ".$a->protocol_name." (".$a->protocol.") [".$a->version."]\n";
        
        // Players
        echo "Players: ".$a->players->online."/".$a->players->max."\n";
        
        // Blocked by mojang
        if ($a->eula_blocked != null){
        echo "Blocked by mojang: ".$a->eula_blocked."\n";
        }
        
        
        } // fatal error
        
    }
    
    function bedrock($ip){
        // Java Request
        $a = json_decode(file_get_contents("http://api.mgo.lol/meigoapi/50/bedrock.php?ip=".$ip));
        echo "IP: ".$a->ip." (Port: ".$a->port.") ";
        if ($a->hostname != null){
            echo "[".$a->hostname."]";
        }
        echo "\n";
        
                // Players
        echo "Players: ".$a->players->online."/".$a->players->max."\n";
        
        
    }
  
    // Extra commands
    // $upd = file_get_contents("http://api.mgo.lol/mcget/updates/2912202302/i.txt");    
    
    /**
     * Command: infoupdate
     */
    function cmdinfoupdate(){
        $upd = file_get_contents("http://api.mgo.lol/mcget/updates/0101202401/i.txt");
        if ($upd == "0101202401"){
            echo "Unsupported command\n";
        } else {
            echo "| Receive information about updates...\n";
            $o = json_decode(file_get_contents("http://api.mgo.lol/mcget/updates/0101202401/info.json"));
            echo "Build: ".$o->build."\n";
            echo "Name: ".$o->name."\n";
            echo "Size: ".$o->size."\n";
            echo "Description: ".$o->description."\n";
            
        }
    } 
    
    /**
     * Command: downloadupdate
     */
    function cmddownloadupdate(){
        $j = new jURLDownloader;
        echo "Coming soon\n";
    }

    // Basic commands (for developer)
    
    /**
     * Command: Now 
     */
    function cmdNow(){
        return Time::Now()->getTime();
    } 
    
    /**
     * Command: Base64
     */
    function cmdbase64(...$args){
        switch ($args[0]){
            case 'encode':
                return base64_encode($args[1]);
            break;
            
            case 'decode':
                return base64_decode($args[1]);
            break;
                
        }
    } 
    
    /**
     * Command: Exit
     */
    function cmdExit(){
        echo "Exiting...\nIf the exit fails, use the keyboard shortcut CTRL+C\n";
        exit;
    } 






}
