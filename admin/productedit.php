<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php' ;?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php
     $pr = new product();
     if(!isset($_GET['productid']) || $_GET['productid']==NULL){ 
         echo "<script>window.location='productlist.php'</script>";
     }else{
         $id = $_GET['productid'];
     }
     if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']=='POST'){
         $updateProduct = $pr->update_product($_POST,$_FILES,$id);
     }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Fix Product</h2>
        <div class="block">              
            <?php
                if(isset($updateProduct)){
                    echo $updateProduct;
                }
            ?> 
            <?php
                $getprbyid = $pr->getprbyid($id);
                if($getprbyid){
                    while($result_pr = $getprbyid->fetch_assoc()){
            ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_pr['productName']; ?>"class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category"> 
                            <option>---------Select Category----------</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php
                                if($result['catId']==$result_pr['catId']){
                                    echo 'selected';
                                }
                            ?>

                            value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                            <?php
                            }
                        }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>----------Select Brand-----------</option>
                            <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php
                                if($result['brandId']==$result_pr['brandId']){
                                    echo 'selected';
                                }
                            ?>
                            value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                         <?php
                                }
                            }
                         ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="product_desc"><?php echo $result_pr['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_pr['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_pr['image'] ?>" width="90px"><br>
                        <input type="file" name="image">
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if($result_pr['type']==0){
                                ?>
                                    <option selected value="1">Featured</option>
                                    <option value="2">Non-Featured</option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="1">Featured</option>
                                    <option selected value="2">Non-Featured</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


