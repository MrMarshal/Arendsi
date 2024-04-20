<?php 
    class Tables extends Admin{

        function GetAllTables() {
            $branch_id = 1;
            $tables = [];
            foreach ($this->GetList(self::TABLE_TABLES,"branch_id = " . $branch_id." AND status = 1") as $table) {
                $table['location'] = $this->GetById(self::TABLE_CAT_LOCATIONS,$table['location_id']);
                $tables[] = $table;
            }
            return $tables;
        }

        function GetTableById($data){
            return $this->GetById(self::TABLE_TABLES,$data->id);
        }

        function SaveTable($data) {
            $branch_id = 1;
            $data->put("branch_id",$branch_id);
            $id = $data->id;
            if ($id!=0){
                $this->Save(self::TABLE_TABLES,$data->extract(["name","location_id","branch_id"]),$data->id);
            }else{
                $id = $this->Insert(self::TABLE_TABLES,$data->extract(["name","location_id","branch_id"]),$data->id,"id");
            }

            return ["id"=>$id];
        }
    }

?>