<?php
namespace meigo\modules;

use std, gui, framework, meigo;


class AppModule extends AbstractModule
{

    /**
     * @event action 
     */
    function doAction(ScriptEvent $e = null)
    {    
        include("res://meigo/mapp.php");
        $a = new mapp;
    }

    /**
     * @event construct 
     */
    function doConstruct(ScriptEvent $e = null)
    {    
        echo "Starting...\n";
    }

}
