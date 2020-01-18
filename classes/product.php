<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
?>

<?php
    /**
     * 
     */
    class product{ 
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_product($data,$files)
        {
            $productName = mysqli_real_escape_string($this->db->link,$data['productName']); //ket noi co so du lieu
            $category = mysqli_real_escape_string($this->db->link,$data['category']); //ket noi co so du lieu
            $brand = mysqli_real_escape_string($this->db->link,$data['brand']); //ket noi co so du lieu
            $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']); //ket noi co so du lieu
            $price = mysqli_real_escape_string($this->db->link,$data['price']); //ket noi co so du lieu
            $type = mysqli_real_escape_string($this->db->link,$data['type']); //ket noi co so du lieu
            // check anh va lay anh cho vao folder uploads
            $permited = array('jpg','jpeg','img','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type=="" || $file_name==""){
                $alert = "<span class='fail'>Fields must not be empty</span>";
                return $alert;
            }else{  
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT into tbl_product(productName,catId,brandId,product_desc,price,type,image) VALUES ('$productName','$category'
                ,'$brand','$product_desc','$price','$type','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Them thanh cong</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class='fail'>Them moi khong thanh cong</span>";
                    return $alert;
                }
            }
        }
        public function show_product(){
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName FROM tbl_product 
            INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
            ORDER BY tbl_product.productId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getprbyid($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_product($data,$files,$id){
            // $productName = $this->fm->validation($data['productName']);
            // $category = $this->fm->validation($data['category']);
            // $brand = $this->fm->validation($data['brand']);
            // $product_desc = $this->fm->validation($data['product_desc']);
            // $price = $this->fm->validation($data['price']);
            // $type = $this->fm->validation($data['type']);
            $productName = mysqli_real_escape_string($this->db->link,$data['productName']); //ket noi co so du lieu
            $category = mysqli_real_escape_string($this->db->link,$data['category']); //ket noi co so du lieu
            $brand = mysqli_real_escape_string($this->db->link,$data['brand']); //ket noi co so du lieu
            $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']); //ket noi co so du lieu
            $price = mysqli_real_escape_string($this->db->link,$data['price']); //ket noi co so du lieu
            $type = mysqli_real_escape_string($this->db->link,$data['type']); //ket noi co so du lieu
            // check anh va lay anh cho vao folder uploads
            $permited = array('jpg','jpeg','img','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name); // ham tach qua dau cham
            $file_ext = strtolower(end($div)); // viet hoa phan duoi
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext; //ham random so tu 1 den 10 va ghep thanh ten moi
            $uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type==""){
                $alert = "<span class='fail'>Fields must not be empty</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    // neu nguoi dung chon anh
                    if($file_size>20480){
                        $alert = "<span class = 'success'>Image Size should be less than 2Mb</span>";
                        return $alert;
                    }elseif(in_array($file_ext,$permited)===false){ // kiem tra loai file an dc cho phep upload
                        $alert = "<span class = 'fail'>You can upload only:-".implode(',',$permited)."</span>";
                        return $alert;
                    }
                    $query = "UPDATE tbl_product SET 
                        productName = '$productName';
                        brandId = '$brand';
                        catId = '$category';
                        type = '$type';
                        price = '$price';
                        image = '$unique_image';
                        product_desc = '$product_desc'
                        WHERE productId = '$id' ";
                }else{    
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName';
                    brandId = '$brand';
                    catId = '$category';
                    type = '$type';
                    price = '$price';
                    product_desc = '$product_desc'
                    WHERE productId = '$id' ";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Product update successfully</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class = 'fail'>Product update fail</span>";
                    return $alert;
                }
            }
        }
        public function del_product($id){
            $query = "DELETE From tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class = 'success'>Delete product successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'fail'>Delete product fail</span>";
                return $alert;
            }
        }
    }

?>