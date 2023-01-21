<?php include "inc/header.php"; ?>

  <?php include "../classes/Admin.php"; ?>


  <?php 
    
     $admin = new Admin();

     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])){

        $createseller = $admin->createSeller($_POST);
     }

  
  
  ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Seller</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Add Seller</h6>
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
              <h6>Add Seller</h6>
            </div>
            <div class="card-body p-3">
              <?php  

              if (isset($createseller)) {
                echo $createseller;
                }

              ?>
              <form action="" method="post">
                  <div class="mb-3">
                    <label for="">First Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="fname" placeholder="First Name">
                  </div>

                  <div class="mb-3">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="lname" placeholder="Last Name">
                  </div>

                  <div class="mb-3">
                    <label for="">Email Address</label>
                    <input type="email" class="form-control border ps-3 pe-3 pt-3 pb-3" name="email" placeholder="Email Address">
                  </div>

                  <div class="mb-3">
                    <label for="">Business Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="biz_name" placeholder="Business Name">
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1">Category</label>
                    <select class="form-control border ps-3 pe-3 pt-3 pb-3" name="seller_cat" id="">
                      <option value="" selected>Choose</option>
                      <?php 
                                   
                         $getCat = $admin->getAllCat();
                         if($getCat){
                            foreach($getCat as $result){

                      ?>

                      <option value="<?php echo $result['cat_name']; ?>"><?php echo $result['cat_name']; ?></option>
                      <?php } } ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1">Sub-Category</label>
                    <select class="form-control border ps-3 pe-3 pt-3 pb-3" name="seller_sub_cat" id="">
                      <option value="" selected>Choose</option>
                      <?php 
                                   
                         $getCat = $admin->getAllSubCat();
                         if($getCat){
                            foreach($getCat as $result){

                      ?>

                      <option value="<?php echo $result['subcat_name']; ?>"><?php echo $result['subcat_name']; ?></option>
                      <?php } } ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="">Phone Number</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="phone_number" placeholder="Phone Number">
                  </div>

                  <div class="mb-3">
                    <label for="">Address</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="address" placeholder="Address">
                  </div>

                  <div class="mb-3">
                    <label for="">Type</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="seller_type" placeholder="Seller or Admin">
                  </div>

                  <div class="mb-3">
                    <label for="">Split Code</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="split_code" placeholder="Split Code">
                  </div>

                  <div class="mb-3">
                    <label for="">Code</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="code" placeholder="Code">
                  </div>

                  <div class="mb-3">
                    <label for="">Account Number</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="acct_num" placeholder="Account Number">
                  </div>

                  <div class="mb-3">
                    <label for="">Account Name</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="acct_name" placeholder="Account Name">
                  </div>

                  <div class="mb-3">
                    <label for="">Bank Name</label>
                      <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="bank_name" placeholder="Bank Name">
                  </div>

                  <div class="mb-3">
                    <label for="">Subscription Date</label>
                      <input type="datetime-local" class="form-control border ps-3 pe-3 pt-3 pb-3" name="sub_end">
                  </div>

                  <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control border ps-3 pe-3 pt-3 pb-3" name="password" placeholder="Password">
                  </div>

                  <button type="submit" name="create" class="btn btn-success mt-4">Add Seller</button>
                </form>
            </div>
          </div>
        </div>
      </div>













<?php include "inc/footer.php"; ?>