<?php 

    class Products extends Admin{
        
        function GetAllProducts($data){
            $prods = [];
            $user = ["branch_id"=>1];
            foreach ($this->GetList(self::TABLE_PRODUCTS,"section_id = ".$data->get("section")." AND branch_id = ".$user['branch_id']) as $prod) {
                $prod['category'] = $this->GetById(self::TABLE_CATEGORIES,$prod['category_id']);
                $prod['subcategory'] = $this->GetById(self::TABLE_SUBCATEGORIES,$prod['subcategory_id']);
                $prod['image'] = $this->GetByCondition(self::TABLE_IMAGES,"product_id = ".$prod['id']." AND status = 1");
                $prods[] = $prod;
            }
            return $prods;
        }

        function GetActiveProducts($data) {
            $prods = [];
            $user = ["branch_id"=>1];
            foreach ($this->GetList(self::TABLE_PRODUCTS,"section_id = ".$data->get("section")." AND branch_id = ".$user['branch_id']." AND status = 1") as $prod) {
                $prod['category'] = $this->GetById(self::TABLE_CATEGORIES,$prod['category_id']);
                $prod['subcategory'] = $this->GetById(self::TABLE_SUBCATEGORIES,$prod['subcategory_id']);
                $prod['image'] = $this->GetByCondition(self::TABLE_IMAGES,"product_id = ".$prod['id']." AND status = 1");
                $prods[] = $prod;
            }
            return $prods;
        }

        function SaveProduct($data) {
            $id = $data->id;
            if ($id == 0){
                $user = ["branch_id" => 1];
                $data->put("branch_id",$user['branch_id']);
                $id = $this->Insert(self::TABLE_PRODUCTS,$data->extract(["section_id","branch_id","name","category_id","subcategory_id","cost","price","stock","stock_min","description","code"]),"id");
            }else{
                $this->Save(self::TABLE_PRODUCTS,$data->extract(["name","category_id","subcategory_id","cost","price","stock","stock_min","description","code"]),$data->id);
            }

            return ["id"=>$id];
        }

        function GetProductById($data) {
            $prod = $this->GetById(self::TABLE_PRODUCTS,$data->id);
            $prod['images'] = $this->GetList(self::TABLE_IMAGES,"product_id = ".$prod['id']);
            return $prod;
        }

        function GetBestsellers($data) {
            $user = ["branch_id" => 1];
            $prods = $this->GetList(self::TABLE_PRODUCTS,"branch_id = ".$user['branch_id']." AND section_id = ".$data->get('section'));
            $res = [];
            foreach($prods as $prod) {
                $prod['image'] = $this->GetByCondition(self::TABLE_IMAGES,"product_id = ".$prod['id']);
                $res[] = $prod;
            }
            return $res;
        }

        function GetProductByCode($data) {
            $branch_id = 1;
            return $this->GetByCondition(self::TABLE_PRODUCTS,"code = ".$data->get("code")." AND branch_id = ".$branch_id);
        }

        function SearchProducts($data) {
            $branch_id = 1;
            $f = "branch_id = ".$branch_id." AND section_id = ".$data->get('section');
            if ($data->get('description')!=""){
                $f .= " AND description LIKE '%".$data->get('description')."%'";
            }
            if ($data->get('price')!=""){
                $f .= " AND price = ".$data->get('price');
            }
            $prods = $this->GetList(self::TABLE_PRODUCTS,$f);
            $res = [];
            foreach($prods as $prod) {
                $prod['image'] = $this->GetByCondition(self::TABLE_IMAGES,"product_id = ".$prod['id']);
                $res[] = $prod;
            }
            return $res;
        }
    }

?>