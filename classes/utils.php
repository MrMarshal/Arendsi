<?php 

	class Utils
	{
		public function randomKey($length) {
			$key = "";
		    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));
		    for($i=0; $i < $length; $i++) {
		        $key .= $pool[mt_rand(0, count($pool) - 1)];
		    }
		    return $key;
		}

		public function getSlug($text, string $divider = '-')
		{
		  // replace non letter or digits by divider
		  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

		  // transliterate
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		  // remove unwanted characters
		  $text = preg_replace('~[^-\w]+~', '', $text);

		  // trim
		  $text = trim($text, $divider);

		  // remove duplicate divider
		  $text = preg_replace('~-+~', $divider, $text);

		  // lowercase
		  $text = strtolower($text);

		  if (empty($text)) {
		    return 'n-a';
		  }

		  return $text;
		}
	}

	class Request{
		public $obj; 
		public $id;

		function __construct($post)
		{
			$this->obj = $post;
			$this->id = (isset($this->obj['id'])?$this->obj['id']:null);
		}

		public function get($val,$default = null)
		{
			return (isset($this->obj[$val])?($this->obj[$val]==null?$default:$this->obj[$val]):$default);
		}

		public function put($key, $val)
		{
			$this->obj[$key] = $val;
		}

		public function extract($fields)
		{
			$res = array();
			foreach ($fields as $f) {
				if (is_array($f)){
					if (isset($this->obj[key($f)])){
						$res[$f[key($f)]] = $this->obj[key($f)];
					}
				}else{
					if (isset($this->obj[$f])){
						$res[$f] = $this->obj[$f];
					}
				}
			}
			return $res;
		}

	}

	class Router
	{
		public $actions = array();
		public $data = null;
		public $action;
		public $admin;

		function __construct()
		{
			require "../classes/LoadModels.php";
			$this->action = $_GET['action'];
			$this->admin = new Model;
			if (!empty($_POST))
				$this->data = new Request($_POST);
			else
				$this->data = new Request($_GET);
		}

		public function NewRoute($route,$function)
		{
			$this->actions[$route] = $function;
		}

		/*Group("controlador",
			[
				["ruta a consultar","Función del controlador"]
			]
		);*/

		public function Group($controller,$functions)
		{
			foreach ($functions as $fn) {
				$this->NewRoute($fn[0],$controller."/".$fn[1]);
			}
		}

		public function Crud($controller,$suffix)
		{
			$crud = [["new","Create"],["get","Read"],["save","Update"],["delete","Delete"]];
			foreach ($crud as $c) {
				$crud[array_search($c, $crud)] = [$c[0].$suffix,$c[1]];
			}
			$this->Group($controller,$crud);
		}

		public function RUN($view_actions = false)
		{
			if ($view_actions == true)
				var_dump($this->actions);
			if (isset($this->action)){
				if (isset($this->actions[$this->action])){
					$controller = explode("/", $this->actions[$this->action])[0];
					$function = explode("/", $this->actions[$this->action])[1];
					if ($function == "Read"){
						echo json_encode($this->admin->$controller->$function($this->data->get('id')));
					}else{
						echo json_encode($this->admin->$controller->$function($this->data));
					}
				}
				else
					echo "Petición inválida";
			}else{
				echo "Acción inválida";
			}
		}
	}
?>