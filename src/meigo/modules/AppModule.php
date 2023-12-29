<?php
namespace meigo\modules;

use std, gui, framework, meigo;


class AppModule extends AbstractModule
{

    /**
     * @event construct 
     */
    function doConstruct(ScriptEvent $e = null)
    {    
    	echo "| (chcp 65001) Attempting to set page code 65001 manually...\n";
        $result = (new Process(['cmd.exe', '/c chcp 65001']))->start()->getInput()->readFully();
        $result = str::decode($result, 'cp866'); //  командная строка windows работает с кодировкой OEM-866
    
        echo "█▀▄▀█ █▀▀ █▀▀ █▀▀ ▀█▀   █░█ ▄█ ░ █▀█\n";
        echo "█░▀░█ █▄▄ █▄█ ██▄ ░█░   ▀▄▀ ░█ ▄ ▀▀█\n";
        echo "McGet v1.9 | Build 29122023_01 | Developed by Meigo\n";
        echo "\n";
        echo "* Github: @meigoc\n";
        echo "* Discord: @glebbb\n";
        echo "* Repository: github.com/meigoc/MCget\n\n";
        echo "Menu: (Commands)\n\n";
        echo "& request (java/bedrock) {ip} [icon]\n";
        echo "   Example: request java hypixel.net\n";
        echo "   Example: request bedrock play.nethergames.net\n";
        echo "   Example: request java hypixel.net icon\n";
        echo "& exit\n";
        
        
    
        $misc = new MiscStream('stdin');
        $misc->eachLine(function($line){
            $cmd = str::split($line, ' ');
            $method = 'cmd' . $cmd[0];
            
            if (method_exists($this, $method)){ // Если метод существует
                unset($cmd[0]);
                echo call_user_func_array([$this, $method], $cmd);
            } else { // неизвестная команда
                echo "Unsupported command привет";
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
