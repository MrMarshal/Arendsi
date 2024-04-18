<?php
class Users extends Admin
{

	public $communicationModel;

	function __construct()
	{
		parent::__construct();
	}

	public function GetUserData(Request $data)
	{
		return $this->GetById(self::TABLE_USERS, $data->id);
	}

	public function Login(Request $data)
	{
		if (session_status() !== PHP_SESSION_ACTIVE) session_start();
		$login = isset($_SESSION['login'])?$_SESSION['login']:0;
		$user = $this->query->select("*", self::TABLE_USERS, "email = '" . $data->get('email') . "' AND password = '" . md5($data->get("password")) . "'");
		$user = $this->GetFirst($user);
		if ($login!=1 || $user!=null){
			if ($user == null) {
				return ["login" => false, "message" => "Datos incorrectos"];
			} else {
				$_SESSION['login'] = 1;
				$_SESSION['start'] = time();
				$user['pass'] = "Qué miras, puto";
				$user['password'] = $user['pass'];
				$_SESSION['user'] = $user;
				return ["login" => true, "type"=>intval($user['type']),"login_status"=>$login];
			}
		}else{
			return ["login" => true, "type"=>intval($user['type']) ,"login_status"=>$login];
		}
	}

	public function GetAddressDetails(Request $data)
	{
		return $this->GetById(self::TABLE_ADDRESSES,$data->get("address_id"));
	}

	public function GetInvoices()
	{
		if (session_status() === PHP_SESSION_NONE) session_start();
		$user_id = $_SESSION['user']['id'];
		$res = $this->GetList(self::TABLE_CARTS,"user_id = ".$user_id);
		$carts = array();
		foreach ($res as $row) {
			$row['address'] = $this->GetById(self::TABLE_ADDRESSES,$row['address_id']);
			$ords = $this->GetList(self::TABLE_ORDERS,"cart_id = ".$row['id']);
			$row['orders'] = array();
			foreach ($ords as $ord) {
				$ord['product'] = $this->GetById(self::TABLE_PRODUCTS,$ord['product_id']);
				$ord['product']['image'] = $this->GetByCondition(self::TABLE_PRODUCT_IMAGES,"product_id = ".$ord['product_id']);
				$row['orders'][] = $ord;
			}
			$carts[] = $row;
		}
		return $carts;
	}

	public function RegisterNewAddress(Request $data)
	{
		if ($data->get("address_id")!=0){
			return $this->UpdateAddress($data);
		}else{
			$data->put("principal",1);
			if ($data->get("email")==null || $data->get("email")==""){
				$email = $this->GetById(self::TABLE_USERS,$data->get("user_id"));
				if ($email!=null)
					$data->put("email",$email['email']);
			}
			$d = $data->extract([
				"user_id","email", "address", "state", "townhall", "zipcode", "status", "principal",
				"name_address",
				"name",
				"second_name",
				"phone",
				"phone_mobile",
				"exterior",
				"interior",
				"reference"
			]);
			$userId = $data->get("user_id")!=null?$data->get("user_id"):0;
			$query = $this->query->update(self::TABLE_ADDRESSES, ["principal" => "0"], " user_id= ".$userId);
			$this->RunQuery($query);
			return $this->Insert(self::TABLE_ADDRESSES, $d, "id");
		}
	}

	public function UpdateAddress(Request $data)
	{
		$d = $data->extract([
			"email", "address", "state", "townhall", "zipcode", "status",
			"name_address",
			"name",
			"second_name",
			"phone",
			"phone_mobile",
			"exterior",
			"interior",
			"reference"
		]);
		
		$query = $this->query->update(self::TABLE_ADDRESSES, $d, $data->get("address_id"));
		return $this->RunQuery($query);
	}
	/**
	 * Obtiene la dirección preferida de la persona logueada
	 */
	public function GetAddressPrefired(Request $data)
	{
		$userId = $data->get("user_id");
		$query = $this->query->select("*", self::TABLE_ADDRESSES, "user_id = $userId AND principal=true", "id desc");
		$address = $this->GetFirst($query);
		if ($address == null) {
			header("HTTP/1.0 404 Not Found");
			return;
		}
		return $address;
	}
	/**
	 * Setea la dirección preferida
	 */
	public function SetAddressPrefired(Request $data)
	{
		$id = $data->get('id');
		$query = $this->query->update(self::TABLE_ADDRESSES, ["principal" => "1"], " id = ".$id);
		$query2 = $this->query->update(self::TABLE_ADDRESSES, ["principal" => "0"], " user_id= ".$data->get("user_id"));
		$this->RunQuery($query2);
		return $this->RunQuery($query);
	}
	/**
	 * elimina la dirección
	 */
	public function deleteAddress(Request $data)
	{
		$id = $data->get('id');
		$table = self::TABLE_ADDRESSES;
		$query = "DELETE FROM $table where id= ".$id;
		return $this->RunQuery($query);
	}


	/**
	 * Obtiene las direcciones de la persona logueada
	 */
	public function GetAddressesUser(Request $data)
	{
		$userId = $data->get("user_id");
		$query = $this->query->select("*", self::TABLE_ADDRESSES, "user_id = ".$userId);
		if ($userId==null) return null;
		$addresses = $this->GetAllRows($query);
		return $addresses;
	}
	/**
	 * Setea la direcciones no preferidas
	 */
	public function SetAddressNoPrefired(Request $data)
	{
		$userId = $data->get('user_id');
		$query = $this->query->update(self::TABLE_ADDRESSES, ["principal" => "0"], " user_id= ".$userId);

		return $this->RunQuery($query);
	}
	/**
	 * Obtiene los detalles del usuario logueado
	 */
	public function getUserDetail(Request $data)
	{
		$userId = $data->get("user_id");
		$query = $this->query->select("*", self::TABLE_USERS, " id = ".$userId);
		$user = $this->GetFirst($query);
		if ($user == null) {
			return header("HTTP/1.0 404 Not Found");
		}
		return $user;
	}
	/**
	 * Actualiza los detalles del usuario
	 */
	public function updateUserDetail(Request $data)
	{
		$userId = $data->get("user_id");
		$query = $this->query->select("*", self::TABLE_USERS, " id = ".$userId);
		$user = $this->GetFirst($query);
		if ($user == null) {
			return header("HTTP/1.0 404 Not Found");
		}
		$resp = $this->Save(self::TABLE_USERS,$data->extract(["name","lastname","phone","gender"]),$userId,"all");
		session_start();
		$_SESSION['user']['name'] = $data->get("name");
		$_SESSION['user']['lastname'] = $data->get("lastname");
		$_SESSION['user']['phone'] = $data->get("phone");
		$_SESSION['user']['gender'] = $data->get("gender");
		return $resp;
	}
	/**
	 * Actualiza el email del usuario
	 */
	public function updateEmailDetail(Request $data)
	{
		$userId = $data->get("user_id");;
		$query = $this->query->select("*", self::TABLE_USERS, " id = ".$userId);
		$user = $this->GetFirst($query);
		if ($user == null) {
			return header("HTTP/1.0 404 Not Found");
		}
		$query = "UPDATE " . self::TABLE_USERS . " set email='" . $data->get('email') . "' where id= ".$userId;
		if (session_status() === PHP_SESSION_NONE) session_start();
		$_SESSION['user']['email'] = $data->get("email");
		$resp = $this->RunQuery($query);
		return $resp;
	}
	/**
	 * Actualiza la contraseña del usuario
	 */
	public function updatePasswordDetail(Request $data)
	{
		$userId = $data->get("user_id");
		$query = $this->query->select("*", self::TABLE_USERS, " id = ".$userId);
		$user = $this->GetFirst($query);
		if ($user == null) {
			return header("HTTP/1.0 404 Not Found");
		}
		$query = "UPDATE " . self::TABLE_USERS . " set password='" . md5($data->get('password')) . "' where id=".$userId;
		$resp = $this->RunQuery($query);
		return $resp;
	}

	public function ChangePassword(Request $data)
	{
		$query = "UPDATE " . self::TABLE_USERS . " set status = 1, password='" . md5($data->get('password')) . "' where id=".$data->get("user_id");
		$resp = $this->RunQuery($query);
		if (session_status() === PHP_SESSION_NONE) session_start();
		$_SESSION['user']['status'] = 1;
		return $resp;
	}
}
