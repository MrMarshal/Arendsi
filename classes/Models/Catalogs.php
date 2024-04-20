<?php 
    class Catalogs extends Admin{

        function GetAllLocations() {
            $branch_id = 1;
            return $this->GetList(self::TABLE_CAT_LOCATIONS,"status = 1");
        }

    }
?>