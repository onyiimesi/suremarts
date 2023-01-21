<?php include "inc/header.php"; ?>
  <?php include "../classes/Admin.php"; ?>


  <?php 
    
    $admin = new Admin();

    $format = new Format();

  ?>
  
  <?php 

    if(isset($_GET['view'])){
    
      $slug = $_GET['view'];
    }
  
  ?>

  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">View Product</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">View Product</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
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
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <?php 
                        
            $getProduct = $admin->getSingleProduct($slug);
            if($getProduct){
              foreach($getProduct as $results){

          ?>
          <div class="col-auto">
            <div class="">
              <img src="<?=$results['product_image']?>" alt="profile_image" width="200" height="200" class="border-radius-lg shadow-sm">
            </div>
          </div>
          
          <div class="col-auto my-auto">
            
            <div class="h-100">
              <h5 class="mb-1">
                <?=str_replace(array( '//','\\','\'', '"',',' , ';', '<', '>' ), ' ',$results['product_name'])?>
              </h5>
              <!-- <p class="mb-0 font-weight-normal text-sm">
                CEO / Co-Founder
              </p> -->
            </div>
          </div>
          <?php } } ?>
        </div>
        <div class="row">
          <div class="row">
            <div class="col-12 col-xl-12">
              <div class="card card-plain h-100">
                <?php 
                        
                  $getProduct = $admin->getSingleProduct($slug);
                  if($getProduct){
                    foreach($getProduct as $results){

                ?>
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Product Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                      <a href="edit-product?proid=<?=$results['product_slug']; ?>">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Product"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    <?=$results['product_desc']?>
                  </p>
                  <hr class="horizontal gray-light my-4">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Category:</strong> &nbsp; <?=$results['cat_name']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Size:</strong> &nbsp; <?=$results['product_size']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Color:</strong> &nbsp; <?=$results['product_color']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Price:</strong> &nbsp; &#8358;<?=number_format($results['product_price'])?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Discount:</strong> &nbsp; <?=number_format($results['discount_price'])?>%</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Quantity:</strong> &nbsp; <?=$results['product_qty']?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Views:</strong> &nbsp; <?=$results['views']?></li>
                    
                  </ul>
                </div>
                <?php } } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<?php include "inc/footer.php"; ?>