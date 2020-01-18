<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php' ?>
<?php
    $br = new brand();
    if(!isset($_GET['brid'])||$_GET['brid']==NULL){
        echo "<script>window.location='brlist.php'</script>";
    }else{
        $id = $_GET['brid'];
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $brandName = $_POST['brandName'];
        $updatebr = $br->update_brand($brandName,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit brand</h2>
                <?php
                    if(isset($updatebr)){
                        echo $updatebr;
                    }
                ?>
                <?php
                    $get_br_name = $br->getbrbyid($id);
                    if($get_br_name){
                        while($result=$get_br_name->fetch_assoc()){
                            ?>
                            <div class="block copyblock"> 
                                <form action="" method="POST">
                                    <table class="form">					
                                        <tr>
                                            <td>
                                                <input name="brandName" value="<?php echo $result['brandName']; ?>" type="text" placeholder="Edit brand..." class="medium" />
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <input type="submit" name="submit" Value="Update" />
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            <?php
                                }
                            }
                            ?>
                            </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>