<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php' ?>
<?php
	$br = new brand();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$brandName = $_POST['brandName'];

		$insertbr = $br->insert_brand($brandName);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add brand</h2>
                <?php
                    if(isset($insertbr)){
                        echo $insertbr;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="brandadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input name="brandName" type="text" placeholder="Name..." class="medium" />
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