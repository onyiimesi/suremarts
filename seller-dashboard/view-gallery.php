<?php include "inc/header.php"; ?>

	<?php 
	      
	    if(isset($_GET['delimg'])){

	      $slug = $_GET['delimg'];
	      
	      $delpro = $user->delGalleryBySlug($slug);
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
	    	<div class="row">
		        <div class="col-12">
		          <div class="card mb-4">
		            <div class="card-header pb-0">
		              <h6>View Image(s)</h6>
		            </div>
		            <?php 
            
		                if(isset($delpro)){
		                  echo $delpro;
		                }

		                if(isset($disable)){
		                  echo $disable;
		                }

		                if(isset($enable)){
		                  echo $enable;
		                }

		            ?>
		            <div class="card-body px-0 pt-0 pb-2">
		            	
		              <div class="table-responsive p-0 text-center">
		                <table class="table align-items-center mb-0">
		                  <thead>
		                    <tr>
		                      	<th>S/N</th>
			                    <!-- <th>Email</th> -->
			                    <th>Image Name</th>
			                    <th>Image Type</th>
			                    <!-- <th>Category</th> -->
			                    <th>Image</th>
			                    <th>Date</th>
			                    <th>Actions</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  	<?php 
                				$email = Session::get("email");

		                      $getPro = $user->getSellerGallery($email);

		                      if($getPro){
		                        $i = 0;
		                        foreach ($getPro as $results) {
		                          $i++;
		     
		                    ?>
		                    <tr>
		                      <td><?=$i?></td>
		                      
		                      <td><?=str_replace(array( '//','\\','\'', '"',',' , ';', '<', '>' ), ' ',$results['img_name'])?></td>
		                      <td><?= $results['img_type']?></td>
		                      <td><img src="<?=$format->esc($results['img'])?>" width="80" height="80" alt=""></td>

		                      <td><?=$format->formatDate($results['date_created'])?></td>

		                      <td>

		                        <a onClick="return confirm('Are you sure?')" href="?delimg=<?php echo $results['img_slug']; ?>" class="btn btn-danger btn-sm">Delete</a>
		                      </td>
		                    </tr>
		                    <?php } } ?>
		                  </tbody>
		                </table>
		              </div>
		            </div>
		          </div>
		        </div>
		    </div>
	    </div>









<?php include "inc/footer.php"; ?>