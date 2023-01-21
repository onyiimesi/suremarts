<?php include "inc/header.php"; ?>
	<?php include "function.php"; ?>

	<?php 

	    $user = new User();

	?>

	<?php 


	    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gallery'])){

	      $insertgallery = $user->sellerAddGallery($_POST, $_FILES);
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
	                  <h6>Add Image</h6>
	                </div>
	              </div>
	            </div>
	            <div class="card-body p-4 pb-5">
	            	<?php  

		                if (isset($insertgallery)) {
		                  echo $insertgallery;
		                }

		            ?>
	              <form action="" method="post" enctype="multipart/form-data">
	              	<div class="mb-3">
	              		<label for="">Image Name<span style="color: red;">*</span></label>
	              		<input type="text" class="form-control" name="img_name" placeholder="Image Name">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Image Type<span style="color: red;">*</span></label>
	              		<input type="text" class="form-control" name="img_type" placeholder="Portrait or Landscape...">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Image</label>
	              		<input type="file" class="form-control" name="img">
	              	</div>

	              	<button type="submit" name="gallery" class="btn btn-success mt-4">Add Image</button>
	              </form>
	            </div>
	          </div> 
	        </div>
	      </div>
		</div>





<?php include "inc/footer.php"; ?>