<?php
namespace meigo;

use jurl;
use std, gui, framework, meigo;
use meigo\ini\storage;
use meigo\minecraft\playerapi;
use meigo\alert;
use php\lib\fs;
use php\io\File;

class mapp
{

    /**
     * @event construct 
     */
    function __construct()
    {
		echo "| Loading INI files...\n";
        (new storage)->initialization(); // initialization ini files
		echo "| Loading mods...\n";
		fs::makedir("mods");
		
		$directory = new File('./mods');

		$list = $directory->findFiles();
		foreach ($directory->findFiles() as $one) {
			if ($one->isFile() == true){
				if (fs::ext($one) == "php") {
					echo "Loading mod ".$one->getName()."\n";
					include($one);
				} else {
					echo "Unsupported format mod ".$one->getName()."\n";
				}
			} else {
				echo $one->getName()." isn't mod or deprecated\n";
			}
		}
		
        echo "█▀▄▀█ █▀▀ █▀▀ █▀▀ ▀█▀   █░█ ▄█ ░ █▀█ ▄█\n";
        echo "█░▀░█ █▄▄ █▄█ ██▄ ░█░   ▀▄▀ ░█ ▄ ▀▀█ ░█\n";
        echo "McGet v1.91.0 | Build 16112024_01 | Developed by Meigo\n";
        echo "Check Updates Disabled!\n";
        echo "* Github: @meigoc\n";
        echo "* Discord: @glebbb\n";
        echo "* Repository: github.com/meigoc/MCget\n\n";
        echo "Menu: (Commands)\n\n";
        echo "& request (java/bedrock/player/launcher) {ip}\n";
        echo "   Example: request java hypixel.net\n";
        echo "   Example: request bedrock play.nethergames.net\n";
        echo "   Example: request player Notch\n";
        echo "   Example: request launcher vimeworld\n";
        echo "& license\n";
        echo "& exit\n";
        (new alert)->alert();
        
        
    
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
                $this->java($args[1]);
            break;
            
            case 'player':
                $valid = playerapi::isValidUsername($args[1]);
                if ($valid == 1){
                  $uuid = playerapi::getUuid($args[1]);
                    if ($uuid != null){
                        $abc = playerapi::getProfile($args[1]);
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
            
            case 'launcher':
                if ($args[1] == "vimeworld"){
                    $this->vimeworld();
                } else {
                    echo "The server is unsupported for two reasons. First reason: CloudFlare usage. Second reason: The server does not have a public API.\n";
                }
                
            break;
                
        }
    } 
    
    function cmdlicense(){
        // license
        echo "█░░ █ █▀▀ █▀▀ █▄░█ █▀ █▀▀\n";
        echo "█▄▄ █ █▄▄ ██▄ █░▀█ ▄█ ██▄\n";
        echo "License @ GNU GENERAL PUBLIC LICENSE v3.0\n";
        echo "============================================\n";
        $a = file_get_contents("https://github.com/meigoc/MCget/raw/refs/heads/main/LICENSE");
        echo $a."\n";
        echo "============================================\n";
    }

    // DEV TOOLS
    
    function vimeworld(){
                $qa = json_decode(file_get_contents("https://api.vimeworld.com/online"));
                echo "| Current online: ".$qa->total."\n";
                $qb = json_decode(file_get_contents("https://api.vimeworld.com/online/staff"));
                echo "| Current online staff: ";
                foreach ($qb as $qj) {
               echo $qj.', ';
                }
                echo ".\n";
    }
    
    function alertupdate($type){
        if ($type == 1){
            echo "==============================================\nA new update has been found! Download it from our github. For more information use the command.\n==============================================\n";
        } elseif ($type == 2){
            echo "& infoupdate\n& downloadupdate\n";
        } else {
            //
        }
    }
    
    function javaicon($ip){
        $url = "https://api.mcsrvstat.us/3/".$ip;
        
        $ch = curl_init($url);
        $v = curl_exec($ch);
        $a = json_decode($v);
        if ($a->icon != null){
            //
            echo "| (".$ip.") Opening the link in your browser...\n";
            //browse("https://run.mgo.lol/icon/?ip=".$ip); don't work
        } else {
            echo "# Error: This server has no icon\n";
        }
        
    }
    
    function java($ip){
        // Java Request
        $url = "https://api.mcsrvstat.us/3/".$ip;
        
        $ch = curl_init($url);
        $v = curl_exec($ch);
        $a = json_decode($v);
        
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
        echo "Protocol: ".$a->protocol->name." (".$a->protocol->version.") [".$a->version."]\n";
        
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
        $url = "https://api.mcsrvstat.us/bedrock/3/".$ip;
        
        $ch = curl_init($url);
        $v = curl_exec($ch);
        $a = json_decode($v);
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
        echo "| The command has been temporarily removed, but we will bring it back soon!\n";
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
