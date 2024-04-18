<?php 
    class Tables extends Admin{

        function GetAllTables() {
            $branch_id = 1;
            return $this->GetList(self::TABLE_TABLES,"branch_id = " . $branch_id." AND status = 1");
        }
    }

?>