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
        echo "█▀▄▀█ █▀▀ █▀▀ █▀▀ ▀█▀   █░█ ▄█ ░ █▀█ ░ ▀█\n";
        echo "█░▀░█ █▄▄ █▄█ ██▄ ░█░   ▀▄▀ ░█ ▄ ▀▀█ ▄ █▄\n";
        echo "McGet v1.9.2 | Build 30122023_01 | Developed by Meigo\n";
        $upd = file_get_contents("http://api.mgo.lol/mcget/updates/3012202301/i.txt");
        if ($upd == "3012202301"){
        echo "\n";
        } else {
            echo "==============================================\nA new update has been found! Download it from our github. For more information use the command.\n==============================================\n";
        }
        echo "* Github: @meigoc\n";
        echo "* Discord: @glebbb\n";
        echo "* Repository: github.com/meigoc/MCget\n\n";
        echo "Menu: (Commands)\n\n";
        echo "& request (java/bedrock/player) {ip} [icon]\n";
        echo "   Example: request java hypixel.net\n";
        echo "   Example: request bedrock play.nethergames.net\n";
        echo "   Example: request java hypixel.net icon\n";
        echo "& exit\n";
        if ($upd != "3012202301"){
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
        $upd = file_get_contents("http://api.mgo.lol/mcget/updates/3012202301/i.txt");
        if ($upd == "3012202301"){
            echo "Unsupported command\n";
        } else {
            echo "| Receive information about updates...\n";
            $o = json_decode(file_get_contents("http://api.mgo.lol/mcget/updates/3012202301/info.json"));
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