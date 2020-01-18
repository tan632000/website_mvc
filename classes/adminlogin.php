<?php
    include_once '../lib/session.php';
    Session:: checkLogin();
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
?>

<?php
    /**
     * 
     */
    class adminlogin{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminUser,$adminPass)
        {
            $adminUser = $this->fm->validation($adminUser); //kt user hop le hay k
            $adminPass = $this->fm->validation($adminPass); //kt pass hop le k

            $adminUser = mysqli_real_escape_string($this->db->link,$adminUser); //ket noi co so du lieu
            $adminPass = mysqli_real_escape_string($this->db->link,$adminPass); //ket noi co so du lieu

            if(empty($adminUser) || empty($adminPass)){
                $alert = "User and pass must not be empty";
                return $alert;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1 ";
                $result = $this->db->select($query);

                if($result){
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin',true); // phien lam viec co ten la adminlogin
                    Session::set('adminId',$value['adminId']); 
                    Session::set('adminUser',$value['adminUser']);
                    Session::set('adminPass',$value['adminPass']);
                    Session::set('adminName',$value['adminName']);
                    header('Location:index.php');
                }else{
                    $alert = "User and Pass not match";
                    return $alert;
                }
            }
        }
    }

?>