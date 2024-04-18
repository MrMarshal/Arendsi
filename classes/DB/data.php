<?php
	class Data
	{
		public $production = false;

		public $mail = array(
			"host"=>'hazclink.com',  // Specify main and backup SMTP servers
			"username"=>'promociones@hazclink.com',                 // SMTP username
			"password"=>'Shiosaki.0',                           // SMTP password
			"from"=>'promociones@hazclink.com',
			"from_name"=>'Clink!'
		);

		public $database = array(
			"host"=>"127.0.0.1",
			"name"=>"drjuan_db2",
			"user"=>"drjuan_user",
			"password"=>"Shiosaki.0"
		);

		public $databaseDev = array(
			"host"=>"127.0.0.1",
			"name"=>"arendsi",
			"user"=>"root",
			"password"=>""
		);

		public $costs = array(
			"shipping"=>"0"
		);
	}
?>
