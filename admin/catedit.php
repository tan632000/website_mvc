<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/category.php' ?>
<?php
    $cat = new category();
    if(!isset($_GET['catid'])||$_GET['catid']==NULL){
        echo "<script>window.location='catlist.php'</script>";
    }else{
        $id = $_GET['catid'];
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $catName = $_POST['catName'];
        $updateCat = $cat->update_category($catName,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit category</h2>
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                <?php
                    $get_cate_name = $cat->getcatbyid($id);
                    if($get_cate_name){
                        while($result=$get_cate_name->fetch_assoc()){
                            ?>
                            <div class="block copyblock"> 
                                <form action="" method="POST">
                                    <table class="form">					
                                        <tr>
                                            <td>
                                                <input name="catName" value="<?php echo $result['catName']; ?>" type="text" placeholder="Edit category..." class="medium" />
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