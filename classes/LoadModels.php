<?php  
	class Model
	{
		function __construct()
		{
			require "admin.php";
			$mydir = __DIR__.'/Models';   
			$myfiles = array_diff(scandir($mydir), array('.', '..')); 
			foreach ($myfiles as $f) {
				require "Models/".$f;
			}
			foreach ($myfiles as $f) {
				$c = str_replace(".php", "", $f);
				$o = strtolower($c);
				$this->{$o} = new $c;
			}
		}
	}
?>