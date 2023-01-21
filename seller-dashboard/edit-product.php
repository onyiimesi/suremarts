<?php include "inc/header.php"; ?>
	<?php include "function.php"; ?>

	<?php 

    	$admin = new Admin();

	?>

	<?php 
	    
	    if(!isset($_GET['proid']) || $_GET['proid'] == null){
	        echo "<script>window.location = 'edit-product'; </script> ";
	      }else{
	        $slug = $_GET['proid'];
	    }
	  
	  
	?>


	<?php 


	    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productupdate'])){

	      $productupdate = $user->sellerproductUpdate($_POST, $_FILES, $slug);
	    }


	?>

	<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
		<!-- Navbar -->
	    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
	      <div class="container-fluid py-1 px-3">
	        <nav aria-label="breadcrumb">
	          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
	            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
	            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
	          </ol>
	          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
	        </nav>
	        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
	          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
	            <div class="input-group">
	              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
	              <input type="text" class="form-control" placeholder="Type here...">
	            </div>
	          </div>
	          <ul class="navbar-nav  justify-content-end">
	            
	            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
	              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
	                <div class="sidenav-toggler-inner">
	                  <i class="sidenav-toggler-line"></i>
	                  <i class="sidenav-toggler-line"></i>
	                  <i class="sidenav-toggler-line"></i>
	                </div>
	              </a>
	            </li>
	            
	            
	          </ul>
	        </div>
	      </div>
	    </nav>
	    <!-- End Navbar -->
		<div class="container-fluid py-4">
			<div class="row my-4">
	        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
	          <div class="card">
	            <div class="card-header pb-0">
	              <div class="row">
	                <div class="col-lg-6 col-7">
	                  <h6>Edit Product</h6>
	                </div>
	              </div>
	            </div>
	            <div class="card-body p-4 pb-5">
	            	<?php 
                        
		                if(isset($productupdate)){
		                  echo $productupdate;
		                }
		              
		            ?>

		            <?php 

		                $getPro = $admin->getProBySlug($slug);
		                  if($getPro){
		                      foreach($getPro as $results){
		                  
		            ?>
	              <form action="" method="post" enctype="multipart/form-data">
	              	<div class="mb-3">
	              		<label for="">Product Name</label>
	              		<input type="text" class="form-control" name="product_name" value="<?=$results['product_name']?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Category</label>
		        
	                    <?php 
	                      
	                       $email = Session::get("email");             

	                       $getCat = $user->getAllCatByEmail($email);
	                       if($getCat){
	                            foreach ($getCat as $resultss) {

	                    ?>
	                    <input type="text" class="form-control" <?php 
	                      if($results['category'] == $resultss['seller_cat']){ ?>
	                        <?php } ?> value="<?=$resultss['seller_cat']?>" readonly name="category">
	                    
	                    <?php } } ?>

	              	</div>

	              	<div class="mb-3">
	              		<label for="">Sub-Category</label>
		        
	                    <?php 
	                      
	                       $email = Session::get("email");             

	                       $getCat = $user->getAllCatByEmail($email);
	                       if($getCat){
	                            foreach ($getCat as $resultss) {

	                    ?>
	                    <input type="text" class="form-control" <?php 
	                      if($results['cat_name'] == $resultss['seller_sub_cat']){ ?>
	                        <?php } ?> value="<?=$resultss['seller_sub_cat']?>" readonly name="cat_name">
	                    
	                    <?php } } ?>

	              	</div>

	              	<div class="mb-3">
	              		<label for="">Brand Name</label>
	              		<input type="text" class="form-control" name="brand" value="<?=$results['brand']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Product Size</label>
	              		<input type="text" class="form-control" name="product_size" value="<?=$results['product_size']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Product Colors</label>
	              		<input type="text" class="form-control" name="product_color" value="<?=$results['product_color']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Description</label>
	              		<textarea class="form-control" name="product_desc" id="editor" cols="30" rows="10"><?=$results['product_desc']; ?></textarea>
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Product Price</label>
	              		<input type="text" class="form-control" name="product_price" value="<?=$results['product_price']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Discount Price (optional)</label>
	              		<input type="text" class="form-control" name="discount_price" value="<?=$results['discount_price']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Product Image</label><br>
	              		<img src="<?=$results['product_image']; ?>" width="50" height="50" alt="">
	              		<input type="file" class="form-control" name="product_image">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Product Quantity</label>
	              		<input type="text" class="form-control" name="product_qty" value="<?=$results['product_qty']; ?>">
	              	</div>

	              	<button type="submit" name="productupdate" class="btn btn-success mt-4">Update Product</button>
	              </form>
	              <?php } } ?>
	            </div>
	          </div> 
	        </div>
	      </div>
		</div>





<?php include "inc/footer.php"; ?>