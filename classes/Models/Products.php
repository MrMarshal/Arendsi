<?php 

    class Products extends Admin{
        
        function GetAllProducts($data){
            $prods = [];
            $user = ["branch_id"=>1];
            foreach ($this->GetList(self::TABLE_PRODUCTS,"section_id = ".$data->get("section")." AND branch_id = ".$user['branch_id']) as $prod) {
                $prod['category'] = $this->GetById(self::TABLE_CAT_CATEGORIES,$prod['category_id']);
                $prod['subcategory'] = $this->GetById(self::TABLE_CAT_SUBCATEGORIES,$prod['subcategory_id']);
                $prod['image'] = $this->GetByCondition(self::TABLE_IMAGES,"product_id = ".$prod['id']." AND status = 1");
                $prods[] = $prod;
            }
            return $prods;
        }

        function SaveProductCoffe($data) {
            $id = $data->id;
            if ($id == 0){
                $user = ["branch_id" => 1];
                $data->put("branch_id",$user['branch_id']);
                $data->put("section_id",1);
                $id = $this->Insert(self::TABLE_PRODUCTS,$data->extract(["section_id","branch_id","name","category_id","subcategory_id","cost","price","stock","stock_min","description"]),"id");
            }else{
                $this->Save(self::TABLE_PRODUCTS,$data->extract(["name","category_id","subcategory_id","cost","price","stock","stock_min","description"]),$data->id);
            }

            return ["id"=>$id];
        }

        function GetBestsellers() {
            $user = ["branch_id" => 1];
            return $this->GetList(self::TABLE_PRODUCTS,"section_id = 1 AND branch_id = ".$user['branch_id']);
        }
    }

?>