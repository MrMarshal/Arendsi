<?php
class Connection {
	protected $conn  = '';

	public function Connect()
	{
		require_once 'data.php';
		$data = new Data;

		if ($data->production) {
			try {
				$conn = new PDO('mysql:host='.$data->database['host'].';dbname='.$data->database['name'], $data->database['user'], $data->database['password']);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec("set names utf8");
			} catch(PDOException $error) {
					throw new PDOException('Mysql Resource failed: ' . $error->getMessage());
			}

		} else {
			try {
				$conn = new PDO('mysql:host='.$data->databaseDev['host'].';dbname='.$data->databaseDev['name'], $data->databaseDev['user'], $data->databaseDev['password']);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec("set names utf8");
			} catch(PDOException $error) {
					throw new PDOException('Mysql Resource failed: ' . $error->getMessage());
			}

		}

		return $conn;
	}
}
?>
