<?php include "inc/header.php"; ?>

	<?php 
    
	    $user = new User();

	    $format = new Format();

	    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category'])){

	        $insertcat = $user->userAddCategory($_POST);
	    }

	?>

	<?php 
      
	    if(isset($_GET['delcat'])){

	      $id = $_GET['delcat'];
	      
	      $delcat = $user->sellerdelCat($id);
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
	        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
	          <div class="card">
	            <div class="card-header pb-0">
	              <div class="row">
	                <div class="col-lg-12 col-7">
	                  <h6>Create Category</h6>
	                  <p class="text-sm mb-0">
	                    Create category for your product.
	                  </p>
	                </div>
	              </div>
	            </div>
	            <div class="card-body p-4 pb-5">
	            	<?php  

		              if (isset($insertcat)) {
		                echo $insertcat;
		                }

		            ?>
	              <form action="" method="post">
	              	<input type="text" class="form-control" name="cat_name" placeholder="Category Name">
	              	<button type="submit" name="category" class="btn btn-success mt-3">Create</button>
	              </form>
	            </div>
	          </div> 
	        </div>
	        <div class="col-lg-6 col-md-6">
	          <div class="card h-100">
	            <div class="card-header pb-0">
	              <h6>Category List</h6>
	            </div>
	            <div class="card-body p-3">
	            	<?php  

		              if (isset($delcat)) {
		                echo $delcat;
		                }

		            ?>
	              <div class="table-responsive">
	              	<table class="table table-hover">
	              		<thead>
	              			<th>S/N</th>
	              			<th>Name</th>
	              			<th>Date</th>
	              			<th>Action</th>
	              		</thead>
	              		<tbody>
	              			<?php 
                
		                      $getCat = $user->getAllCat();

		                      if($getCat){
		                        $i = 0;
		                        foreach ($getCat as $results) {
		                          $i++;
		     
		                    ?>
	              			<tr>
	              				<td><?=$i?></td>
			                    <td><?=$results['user_email']?></td>
			                    <td><?=$format->esc($results['cat_name'])?></td>
			                    <td><?=$format->formatDate($results['date_created'])?></td>

			                    <td>
			                        <?php  
			                          $email = Session::get("email");
			                          if ($email == $results['user_email']){ ?>
			                            
			                            <a class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?')" href="?delcat=<?php echo $results['cat_id']; ?>">Delete</a>
			                            <?php }else{ ?>
			                              <a class="btn btn-danger btn-sm disabled">Delete</a>
			                        <?php } ?>
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