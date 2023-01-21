<?php include "inc/header.php"; ?>
  <?php include "../classes/Admin.php"; ?>
  <?php include "function.php"; ?>

  <?php 

    $admin = new Admin();

  ?>

  <?php 


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product'])){

      $insertproduct = $admin->adminAddProduct($_POST, $_FILES);
    }


  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Product</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Add Product</h6>
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
    <div class="container-fluid py-4">


      <div class="row">
        <div class="col-lg-12">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Add Product</h6>
            </div>
            <div class="card-body p-3">
              <?php  

                if (isset($insertproduct)) {
                  echo $insertproduct;
                }

              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="">Product Name</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_name" placeholder="Product Name">
                </div>

                <div class="mb-3">
                  <label for="">Category</label>
                  
                  <select name="cat_name" class="form-control border ps-3 pe-3 pt-3 pb-3" id="">
                    <option value="">Choose</option>
                    <?php 
                      
                       $email = Session::get("sup_email");             

                       $getCat = $admin->getAllCatByEmail($email);
                       if($getCat){
                            foreach ($getCat as $results) {

                    ?>
                    <option value="<?=$results['cat_name']?>"><?=$results['cat_name']?></option>
                    <?php } } ?>
                  </select>
                  
                </div>

                <div class="mb-3">
                  <label for="">Product Size</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_size" placeholder="Product Size">
                </div>

                <div class="mb-3">
                  <label for="">Product Colors</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_color" placeholder="Product Colors">
                </div>

                <div class="mb-3">
                  <label for="">Description</label>
                  <textarea class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_desc" placeholder="Description" id="editor" cols="30" rows="10"></textarea>
                </div>

                <div class="mb-3">
                  <label for="">Product Price</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_price" placeholder="Product Price">
                </div>

                <div class="mb-3">
                  <label for="">Discount(%)</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="discount_price" placeholder="5%, 10%, 15%">
                </div>

                <div class="mb-3">
                  <label for="">Product Image</label>
                  <input type="file" class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_image">
                </div>

                <div class="mb-3">
                  <label for="">Product Quantity</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="product_qty" placeholder="Product Quantity">
                </div>

                <button type="submit" class="btn btn-success mt-4" name="product">Add Product</button>
              </form>
            </div>
          </div>
        </div>
      </div>










<?php include "inc/footer.php"; ?>