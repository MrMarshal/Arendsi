<?php 

    class Categories extends Admin{
        function GetAllCategories($data){
            $user = ["branch_id" => 1];
            return $this->GetList(self::TABLE_CATEGORIES,"branch_id = ".$user['branch_id']." AND section_id = ".$data->get("section")." AND status = 1");
        }

        function GetAllSubcategoriesByCategory($data){
            return $this->GetList(self::TABLE_SUBCATEGORIES,"category_id = ".$data->get("category")." AND status = 1");
        }

        function GetAllSubcategories($data) {
            $user = ["branch_id" => 1];
            $res = [];
            foreach ($this->GetList(self::TABLE_SUBCATEGORIES,"branch_id = ".$user["branch_id"]." AND section_id = ".$data->get("section")." AND status = 1") as $item) {
                $item['category'] = $this->GetById(self::TABLE_CATEGORIES,$item["category_id"]);
                $res[] = $item;
            }
            return $res;
        }

        function SaveCategory($data) {
            $branch_id = 1;
            $data->put("branch_id",$branch_id);
            if ($data->id != 0){
                $this->Save(self::TABLE_CATEGORIES,$data->extract(["name","description"]),$data->id);
            }else{
                $this->Insert(self::TABLE_CATEGORIES,$data->extract(["name","description","section_id","branch_id"]));
            }
        }

        function SaveSubcategory($data) {
            $branch_id = 1;
            $data->put("branch_id",$branch_id);
            if ($data->id != 0){
                $this->Save(self::TABLE_SUBCATEGORIES,$data->extract(["category_id","name","description"]),$data->id);
            }else{
                $this->Insert(self::TABLE_SUBCATEGORIES,$data->extract(["category_id","name","description","branch_id","section_id"]));
            }
        }

        function ToggleCategoryStatus($data) {
            $this->Save(self::TABLE_CATEGORIES,["status"=>"!status"],$data->id);
            return $data->get("current_status");
        }

        function ToggleSubcategoryStatus($data) {
            $this->Save(self::TABLE_SUBCATEGORIES,["status"=>"!status"],$data->id);
            return $data->get("current_status");
        }

        function GetCategoryById($data) {
            return $this->GetById(self::TABLE_CATEGORIES,$data->id);
        }

        function GetSubcategoryById($data) {
            return $this->GetById(self::TABLE_SUBCATEGORIES,$data->id);
        }
    }

?>