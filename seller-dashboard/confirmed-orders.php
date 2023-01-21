<?php include "inc/header.php"; ?>

	<?php 
	      
	    if(isset($_GET['deleteorder'])){

	      $deleteorder = $_GET['deleteorder'];
	      
	      $delpro = $user->delOrder($deleteorder);
	    }
	  
	?>


	<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
		<!-- Navbar -->
	    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
	      <div class="container-fluid py-1 px-3">
	        <nav aria-label="breadcrumb">
	          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
	            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
	            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Orders</li>
	          </ol>
	          <h6 class="font-weight-bolder mb-0">Orders</h6>
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
		              <h6>Confirmed Order(s)</h6>
		            </div>

		            <?php 

		                if(isset($delpro)){
		                  echo $delpro;
		                }

		            ?>
		            <div class="card-body px-0 pt-0 pb-2">
		              <div class="table-responsive text-center p-0">
		                <table class="table align-items-center mb-0">
		                  <thead>
		                    <tr>
		                      	<th>S/N</th>
			                    <th>Order No</th>
			                    <th>Product Name</th>
			                    <th>Product Qty</th>
			                    <th>Product Image</th>
			                    <th>Product Price</th>
			                    <th>Full Name</th>
			                    <th>Customer Email</th>
			                    <th>Phone Number</th>
			                    <th>Address</th>
			                    <th>Status</th>
			                    <th>Date</th>
			                    <th>Actions</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  	<?php 
                				$email = Session::get("email");

		                      $getPro = $user->getSellerConfirmedOrders($email);

		                      if($getPro){
		                        $i = 0;
		                        foreach ($getPro as $results) {
		                          $i++;
		     
		                    ?>
		                    <tr>
		                        <td><?=$i?></td>
		                        <td><?=$format->esc($results['order_no'])?></td>
		                        <td><?=$format->esc($results['product_name'])?></td>
		                        <td><?=$format->esc($results['product_qty'])?></td>
		                        <td><img src="/admin/<?=$results['product_image']?>" width="100" height="100" alt=""></td>
		                        <td>&#8358;<?=number_format($results['product_price'])?></td>
		                        <td><?=$format->esc($results['fullname'])?></td>
		                        <td><?=$format->esc($results['email'])?></td>
		                        <td><?=$format->esc($results['phone'])?></td>
		                        <td><?=$format->esc($results['address'])?>, <?=$format->esc($results['city'])?> <?=$format->esc($results['state'])?></td>
		                        <td><?=$format->esc($results['delivery_status'])?></td>
		                        <td><?=$format->formatDateTime($results['date_purchased'])?></td>
		                        <td>
		                        	<a onClick="return confirm('Are you sure?')" href="?deleteorder=<?php echo $results['order_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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