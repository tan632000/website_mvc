<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
?>

<?php
    /**
     * 
     */
    class category{ 
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_category($catName)
        {
            $catName = $this->fm->validation($catName); 
            $catName = mysqli_real_escape_string($this->db->link,$catName); //ket noi co so du lieu

            if(empty($catName)){
                $alert = "<span class='fail'>Category must not be empty</span>";
                return $alert;
            }else{  
                $query = "INSERT into tbl_category(catName) VALUES ('$catName')";
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
        public function show_category(){
            $query = "SELECT * FROM tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getcatbyid($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_category($catName,$id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $id = mysqli_real_escape_string($this->db->link,$id);
            if(empty($catName)){
                $alert = "<span class 'fail'>Category must not be empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Category update successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'fail'>Category updae fail</span>";
                    return $alert;
                }
            }
        }
        public function del_category($id){
            $query = "DELETE From tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class = 'success'>Delete category successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'fail'>Delete category fail</span>";
                return $alert;
            }
        }
    }

?>