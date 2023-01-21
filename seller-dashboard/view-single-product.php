<?php include "inc/header.php"; ?>
  
  <?php 
    
    $user = new User();

    $format = new Format();

  ?>
  
  <?php 

    if(isset($_GET['view'])){
    
      $slug = $_GET['view'];
    }
  
  ?>

  <?php 
        
      if(isset($_GET['delproduct'])){

        $slug = $_GET['delproduct'];
        
        $delpro = $user->delProductBySlug($slug);
      }
    
  ?>

  <?php 
        
      if(isset($_GET['disable'])){

        $slug = $_GET['disable'];
        
        $disable = $user->disableProduct($slug);
      }

      if(isset($_GET['enable'])){

        $slug = $_GET['enable'];
        
        $enable = $user->enableProduct($slug);
      }
    
  ?>

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">View Product</li>
          </ol>
          <h6 class="text-white font-weight-bolder ms-2">View Product</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      
    </div>
    <div class="container-fluid py-4">

      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
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
              <div class="row">
                <?php 
                        
                  $getProduct = $user->getSingleProduct($slug);
                  if($getProduct){
                    foreach($getProduct as $results){

                ?>
                <div class="col-auto mb-3">
                  <div class="">
                    <img src="<?=$results['product_image']?>" alt="profile_image" width="200" height="200" class="border-radius-lg shadow-sm">
                  </div>
                </div>
                <?php } } ?>
              </div>
              <div class="row">
                <?php 
                        
                  $getProduct = $user->getSingleProduct($slug);
                  if($getProduct){
                    foreach($getProduct as $results){

                ?>
                
                <div class="col-md-6 d-flex align-items-center">
                  <h6 class="mb-0"><?=str_replace(array( '//','\\','\'', '"',',' , ';', '<', '>' ), ' ',$results['product_name'])?></h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="edit-product?proid=<?=$results['product_slug']; ?>">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Product"></i>
                  </a>
                </div>
                <?php } } ?>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                <?=$results['product_desc']?>
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group mb-4">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Category:</strong> &nbsp; <?=$results['cat_name']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Size:</strong> &nbsp; <?=$results['product_size']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Color:</strong> &nbsp; <?=$results['product_color']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Price:</strong> &nbsp; &#8358;<?=number_format($results['product_price'])?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Discount:</strong> &nbsp; <?=number_format($results['discount_price'])?>%</li>
                <li class="list-group-item border-0 ps-0 text-sm">
                  <strong class="text-dark">Total:</strong> &nbsp; 
                  <?php  

                    $price = $results['product_price'];
                    $percentToGet = $results['discount_price'];
                    $percentInDecimal = $percentToGet / 100;
                    $totalamount = $percentInDecimal * $price;

                    $totalprice = $price - $totalamount;

                  ?>
                  &#8358;<?=number_format($totalprice)?>
                </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Quantity:</strong> &nbsp; <?=$results['product_qty']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Views:</strong> &nbsp; <?=$results['views']?></li>
                
              </ul>
              <?php  

                if ($results['stock'] == 'In-stock' && $results['product_qty'] != 0): ?>
              
                  <a onClick="return confirm('Disable Product?')" href="?disable=<?php echo $results['product_slug']; ?>" class="btn btn-primary">Disable Product</a>

                <?php else: ?>
                <a onClick="return confirm('Enable Product?')" href="?enable=<?php echo $results['product_slug']; ?>" class="btn btn-success">Enable Product</a>

              <?php endif; ?>
              <a class="btn btn-danger" onClick="return confirm('Are you sure?')" href="?delproduct=<?php echo $results['product_slug']; ?>">Delete Product</a>
            </div>
          </div>
        </div>
        
      </div>



<?php include "inc/footer.php"; ?>