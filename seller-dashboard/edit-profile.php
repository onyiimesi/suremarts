<?php include "inc/header.php"; ?>


	<?php 
	    
	    if(!isset($_GET['edit']) || $_GET['edit'] == null){
	        echo "<script>window.location = 'edit-product'; </script> ";
	      }else{
	        $id = $_GET['edit'];
	    }
	  
	  
	?>


	<?php 


	    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateprofile'])){

	      $updateprofile = $user->sellerUpdateProfile($_POST, $id);
	    }


	?>

	<?php 


	    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])){

	      $change = $user->sellerChangePass($_POST, $id);
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
	                  <h6>Edit Profile</h6>
	                </div>
	              </div>
	            </div>
	            <div class="card-body p-4 pb-5">
	            	<?php 
                        
		                if(isset($updateprofile)){
		                  echo $updateprofile;
		                }
		              
		            ?>

		            <?php 

		                $getPro = $user->getProfile($id);
		                  if($getPro){
		                      foreach($getPro as $results){
		                  
		            ?>
	              <form action="" method="post" enctype="multipart/form-data">
	              	<div class="mb-3">
	              		<label for="">First Name</label>
	              		<input type="text" class="form-control" name="fname" value="<?=$results['fname']?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Last Name</label>
	              		<input type="text" class="form-control" name="lname" value="<?=$results['lname']?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Email Address</label>
	              		<input type="text" class="form-control" name="email" value="<?=$results['email']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Phone Number</label>
	              		<input type="text" class="form-control" name="phone_number" value="<?=$results['phone_number']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Say something about yourself</label>
	              		<textarea class="form-control" name="description" id="editor" cols="30" rows="10"><?=$results['description']; ?></textarea>
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Address</label>
	              		<input type="text" class="form-control" name="address" value="<?=$results['address']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Facebook</label>
	              		<input type="text" class="form-control" name="facebook" value="<?=$results['facebook']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Instagram</label>
	              		<input type="text" class="form-control" name="instagram" value="<?=$results['instagram']; ?>">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Twitter</label>
	              		<input type="text" class="form-control" name="twitter" value="<?=$results['twitter']; ?>">
	              	</div>

	              	<button type="submit" name="updateprofile" class="btn btn-success mt-4">Update Profile</button>
	              </form><hr>
	              <?php } } ?>


	              <?php 
                        
	                if(isset($change)){
	                  echo $change;
	                }
		              
		           ?>
	              <form action="" method="post">
	              	<h6>Change Password</h6>
	              	<div class="mb-3">
	              		<label for="">Current Password</label>
	              		<input type="password" class="form-control" name="cupass" placeholder="Current Password">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">New Password</label>
	              		<input type="password" class="form-control" name="nepass" placeholder="New Password">
	              	</div>

	              	<div class="mb-3">
	              		<label for="">Confirm Password</label>
	              		<input type="password" class="form-control" name="copass" placeholder="Confirm Password">
	              	</div>

	              	<div class="mb-3">
	              		<button type="submit" name="changepass" class="btn btn-success mt-4">Change</button>
	              	</div>
	              </form>
	            </div>
	          </div> 
	        </div>
	      </div>
		</div>





<?php include "inc/footer.php"; ?>