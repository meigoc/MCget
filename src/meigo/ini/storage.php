<?php

namespace meigo\ini;

use script\storage\IniStorage;

class storage
{
	public function initialization()
	{
		$i = new IniStorage;
        $i->path = "settings.ini";
        $i->autoSave = true;
        $i->trimValues = true;
        $i->multiLineValues = true;
		
		echo "-- Loading settings.ini\n";
		$i->set("api","v5.0","main");
		echo "   api = v5.0\n";
		$i->set("legacyapi","50","main");
		echo "   legacyapi = 50\n";
		$i->set("version","v1.9.2","main");
		echo "   version = v1.9.2\n";
		$i->set("build","3012202301","main");
		echo "   build = 3012202301\n";
		
		
		$i->set("motd","clean","body");
		echo "   motd = clean\n";
		
		$i->set("info","clean","body");
		echo "   info = clean\n";
		
		$i->set("maxdisplay","50","body");
		echo "   maxdisplay = 50\n";
		
		$i->set("debug","false","body");
		echo "   debug = false\n";
		
		$i->set("logs","false","body");
		echo "   logs = false\n";
		
		$i->set("null","null","history");
		echo "   null = null\n";
		
		$i->set("file","lang.ini","lang");
		echo "   file = lang.ini\n";
		
        echo "-- Loading lang.ini\n";	
        echo "   Cancelled\n";		
		
		echo "? Successfully loaded!\n";
		
	}
}

?>