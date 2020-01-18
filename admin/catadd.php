<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/category.php' ?>
<?php
	$cat = new category();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$catName = $_POST['catName'];

		$insertCat = $cat->insert_category($catName);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add category</h2>
                <?php
                    if(isset($insertCat)){
                        echo $insertCat;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="catadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input name="catName" type="text" placeholder="Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>