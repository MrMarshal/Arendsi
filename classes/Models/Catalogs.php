<?php 
    class Catalogs extends Admin{
        
        function GetAllCategories($data){
            $user = ["branch_id" => 1];
            return $this->GetList(self::TABLE_CAT_CATEGORIES,"branch_id = ".$user['branch_id']." AND section_id = ".$data->get("section")." AND status = 1");
        }

        function GetAllSubcategoriesByCategory($data){
            return $this->GetList(self::TABLE_CAT_SUBCATEGORIES,"category_id = ".$data->get("category")." AND status = 1");
        }

        function GetAllSubcategories() {
            $user = ["branch_id" => 1];
            $res = [];
            foreach ($this->GetList(self::TABLE_CAT_SUBCATEGORIES,"branch_id = ".$user["branch_id"]." AND status = 1") as $item) {
                $item['category'] = $this->GetById(self::TABLE_CAT_CATEGORIES,$item["category_id"]);
                $res[] = $item;
            }
            return $res;
        }

        function SaveCategory($data) {
            if ($data->id != 0){
                $this->Save(self::TABLE_CAT_CATEGORIES,$data->extract(["name","description"]),$data->id);
            }else{
                $this->Insert(self::TABLE_CAT_CATEGORIES,$data->extract(["name","description"]));
            }
        }

        function SaveSubcategory($data) {
            if ($data->id != 0){
                $this->Save(self::TABLE_CAT_SUBCATEGORIES,$data->extract(["category_id","name","description"]),$data->id);
            }else{
                $this->Insert(self::TABLE_CAT_SUBCATEGORIES,$data->extract(["category_id","name","description"]));
            }
        }

        function ToggleCategoryStatus($data) {
            $this->Save(self::TABLE_CAT_CATEGORIES,["status"=>"!status"],$data->id);
            return $data->get("current_status");
        }

        function ToggleSubcategoryStatus($data) {
            $this->Save(self::TABLE_CAT_SUBCATEGORIES,["status"=>"!status"],$data->id);
            return $data->get("current_status");
        }

        function GetCategoryById($data) {
            return $this->GetById(self::TABLE_CAT_CATEGORIES,$data->id);
        }

        function GetSubcategoryById($data) {
            return $this->GetById(self::TABLE_CAT_SUBCATEGORIES,$data->id);
        }

    }
?>