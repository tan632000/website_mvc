<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
?>

<?php
    /**
     * 
     */
    class user{ 
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        // public function insert_brand($brandName)
        // {
        //     $brandName = $this->fm->validation($brandName); 
        //     $brandName = mysqli_real_escape_string($this->db->link,$brandName); //ket noi co so du lieu

        //     if(empty($brandName)){
        //         $alert = "<span class='fail'>Brand must not be empty</span>";
        //         return $alert;
        //     }else{  
        //         $query = "INSERT into tbl_brand(brandName) VALUES ('$brandName')";
        //         $result = $this->db->insert($query);
        //         if($result){
        //             $alert = "<span class='success'>Them thanh cong</span>";
        //             return $alert;
        //         }
        //         else{
        //             $alert = "<span class='fail'>Them moi khong thanh cong</span>";
        //             return $alert;
        //         }
        //     }
        // }
        // public function show_brand(){
        //     $query = "SELECT * FROM tbl_brand order by brandId desc";
        //     $result = $this->db->select($query);
        //     return $result;
        // }
        // public function getbrbyid($id){
        //     $query = "SELECT * FROM tbl_brand WHERE brandId = '$id' ";
        //     $result = $this->db->select($query);
        //     return $result;
        // }
        // public function update_brand($brandName,$id){
        //     $brandName = $this->fm->validation($brandName);
        //     $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        //     $id = mysqli_real_escape_string($this->db->link,$id);
        //     if(empty($brandName)){
        //         $alert = "<span class 'fail'>Brand must not be empty</span>";
        //         return $alert;
        //     }else{
        //         $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
        //         $result = $this->db->update($query);
        //         if($result){
        //             $alert = "<span class = 'success'>Brand update successfully</span>";
        //             return $alert;
        //         }else{
        //             $alert = "<span class = 'fail'>Brand update fail</span>";
        //             return $alert;
        //         }
        //     }
        // }
        // public function del_brand($id){
        //     $query = "DELETE From tbl_brand WHERE brandId = '$id'";
        //     $result = $this->db->delete($query);
        //     if($result){
        //         $alert = "<span class = 'success'>Delete brand successfully</span>";
        //         return $alert;
        //     }else{
        //         $alert = "<span class = 'fail'>Delete brand fail</span>";
        //         return $alert;
        //     }
        // }
    }

?>