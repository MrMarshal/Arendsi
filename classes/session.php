<?php 
	class Session
	{
		public $user;
		public $login;
		function __construct()
		{
			if(!isset($_SESSION)) 
			   session_start();
			if (!empty($_SESSION["user"])){
				$this->user = $_SESSION["user"];
				$this->login = $_SESSION["login"];
				$this->expire = isset($_SESSION["expire"])?$_SESSION["expire"]:null;
			}
		}

		public function SessionStart($user)
		{
			$_SESSION['login'] = 1;
			$_SESSION['start'] = time();
			if (!isset($user["business_id"])){
				$_SESSION['expire'] = $_SESSION['start'] + (1440 * 60);
			}
			$user['single_name'] = explode(" ",$user['name'])[0];
			$user['pass'] = "Qué miras, puto";
			$user['password'] = $user['pass'];
			$_SESSION['user'] = $user;
		}

		public function SessionEnd()
		{
			$_SESSION['login'] = 0;
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (1440 * 60);
			$_SESSION['user'] = null;
			session_destroy();
		}

		public function isLoged()
		{
			return $this->login;
		}
	}

?>