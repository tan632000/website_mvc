<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php' ;?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php'; ?>
<?php
	$pr = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
		$id = $_GET['productid'];
		$delbrand = $pr->del_product($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
		<h2>Product List</h2>
		<?php
						 if(isset($delbrand)){
							echo $delbrand;
						}
					?> 
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$prlist = $pr->show_product();
					if($prlist){
						$i = 0;
						while($result = $prlist->fetch_assoc()){
							$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['productName'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><img src = "uploads/<?php echo $result['image'];?>" width="50px;" height="50px;"></td>
							<td><?php echo $result['catName'];?></td>
							<td><?php echo $result['brandName'];?></td>
							<td><?php echo $fm->textShorten($result['product_desc'],50);?></td>
							<td><?php
								if($result['type']==1){
									echo 'Feathered';
								}else{
									echo 'Non-feathered';
								}

							?></td>
							<td><a href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit</a> || <a href="?productid=<?php echo $result['productId']; ?>">Delete</a></td>
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
