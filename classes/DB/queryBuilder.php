<?php 
	class QueryBuilder
	{
		public function insert($table,$items)
		{
			$fields = "";
			$values = "";
			foreach ($items as $field => $value) {
				$fields = $fields.$field.",";
				if (strpos($value,"()")===false)
					$values = $values."'".$value."',";
				else
					$values = $values." ".$value.",";
			}
			$fields = substr($fields, 0, -1);
			$values = substr($values, 0, -1);
			$query = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";

			return $query;
		}

		public function insert_raw($table,$items)
		{
			$fields = "";
			$values = "";
			foreach ($items as $field => $value) {
				$fields = $fields.$field.",";
				$values = $values." ".$value.",";
			}
			$fields = substr($fields, 0, -1);
			$values = substr($values, 0, -1);
			$query = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";

			return $query;
		}

		public function select($fields,$table,$conditions="true",$order='id')
		{
			$query = "SELECT $fields FROM $table WHERE $conditions ORDER BY $order";
			return $query;
		}

		public function update($table,$items,$conditions)
		{
			$set = "";
			foreach ($items as $field => $value) {
				if (strpos($value,"()")===false)
					$set = $set.$field."='".$value."',";
				else
					$set = $set.$field."=".$value.",";
			}
			$set = substr($set, 0, -1);
			$query = "UPDATE $table SET $set WHERE $conditions";
			return $query;
		}

		public function select_join($fields,$table,$joins,$conditions = "true",$order='id')
		{
			if (is_array($fields))
				$fields = $this->view_values($fields);
			$js = "";
			$os = "";
			$as = substr($table, 0, 1);
			foreach ($joins as $j => $value) {
				$jas = substr($j, 0, 4);
				$js = $js." LEFT JOIN ".$j." AS ".$jas." ON ".$value." ";
			}
			$o = $order=="id"?"ORDER BY id":($order);
			$query = "SELECT $fields FROM $table AS $as $js WHERE $conditions $o";

			return $query;
		}

		public function view_values($nams)
		{
			$names = "";
			foreach ($nams as $field => $value) {
				$names = $names.$field." AS ".$value.",";
			}
			$names = substr($names, 0, -1);
			return $names;
		}

		public function GetFiltersByFormData($d)
		{
			$f = "";
			if ($d!=""){
				$c = 0;
				if ($d['place']!=0){
					$c++;
					$f.=" place_id = ".$d['place'];
				}
				if ($d['status']!=0){
					$f.=($c>0)?" AND ":"";
					$f.="status_id = ".$d['status'];
					$c++;
				}
				if ($c == 0){
					$f = "true";
				}
				return $f;
			}else{
				return "true";
			}
		}
	}

 ?>