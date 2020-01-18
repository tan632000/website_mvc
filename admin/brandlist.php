<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php' ?>
<?php
	$br = new brand();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delbr = $br->del_brand($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>List Brand</h2>
                <div class="block">       
					<?php
						 if(isset($delbr)){
							echo $delbr;
						}
					?> 
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show_br = $br->show_brand();
							if($show_br){
								$i = 0;
								while($result = $show_br->fetch_assoc()){
									$i++;
								
						?>	
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['brandName']; ?></td>	
								<td><a href="brandedit.php?brid=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick=
								"return confirm ('Are u want to delete?')" href="?delid=<?php echo $result['brandId']; ?>">Delete</a></td>
							</tr>
						<?php
						}
					}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

