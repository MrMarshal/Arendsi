<?php 

    class Files extends Admin{

        function UploadFile($data){
            $file = $_FILES;
            //$target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/data/products/";
            $target_dir = $_SERVER['DOCUMENT_ROOT']."/sinergia/web/arendsi/assets/data/".$data->get("folder")."/";
            
            $id_name = uniqid();
            $userfile_extn = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.')+1);
            $name = $id_name.".".$userfile_extn;

            $target_file = $target_dir . $name;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $message = "";

            if (file_exists($target_file)) {
                $message .= "Sorry, file already exists.\n";
                $uploadOk = 0;
            }
            if ($file["file"]["size"] > 5000000) {
                $message .= "Sorry, your file is too large.\n";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $message .= "Sorry, only JPG, JPEG, PNG & GIF file are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($file["file"]["tmp_name"], $target_file)) {
                $uploadOk = 1;
                } else {
                $message .= "No se pudo mover";
                $uploadOk = 0;
                }
            }
            $id = 0;
            if ($uploadOk==1){
                $id = $this->Insert(self::TABLE_IMAGES,["product_id"=>$data->get("product_id"),"url"=>$name,"type"=>1],"id");
            }
            return Array("uploaded"=>($uploadOk==1),"message"=>$message,"name"=>$name,"dir"=>$target_dir,"id"=>$id,"alt_name"=>$data->get("alt"));
        }
    }

?>