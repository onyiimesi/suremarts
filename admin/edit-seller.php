<?php include "inc/header.php"; ?>
  <?php include "../classes/Admin.php"; ?>
  <?php include "function.php"; ?>

  <?php 

    $admin = new Admin();

    $format = new Format();

  ?>

  <?php 
    
    if(!isset($_GET['proid']) || $_GET['proid'] == null){
        echo "<script>window.location = 'edit-product'; </script> ";
      }else{
        $email = $_GET['proid'];
    }
  
  
  ?>


  <?php 


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editseller'])){

      $editseller = $admin->editSeller($_POST, $email, $_FILES);
    }


  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Seller</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Edit Seller</h6>
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
              <h6>Edit Seller</h6>
            </div>
            <div class="card-body p-3">
              <?php 
                        
                if(isset($editseller)){
                  echo $editseller;
                }
              
              ?>

              <?php 

                $getPro = $admin->getSellerByEmail($email);
                  if($getPro){
                      foreach($getPro as $results){
                  
              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="">First Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="fname" value="<?=$results['fname']?>">
                </div>

                <div class="mb-3">
                  <label for="">Last Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="lname" value="<?=$results['lname']?>">
                </div>

                <div class="mb-3">
                  <label for="">Email Address</label>
                    <input type="email" class="form-control border ps-3 pe-3 pt-3 pb-3" name="email" readonly value="<?=$results['email']?>">
                </div>

                <div class="mb-3">
                  <label for="">Business Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="biz_name" value="<?=$results['biz_name']?>">
                </div>

                <div class="mb-3">
                  <label for="">Phone Number</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="phone_number" value="<?=$results['phone_number']?>">
                </div>

                <?php if ($results['seller_cat'] == "Arts"): ?>
                <div class="mb-3">
                  <label for="">Art Image</label>
                  <input type="file" class="form-control border ps-3 pe-3 pt-3 pb-3" name="seller_image">
                </div>
                <?php endif; ?>

                <div class="mb-3">
                  <label for="">Account Number</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="acct_num" value="<?=$results['acct_num']?>">
                </div>

                <div class="mb-3">
                  <label for="">Account Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="acct_name" value="<?=$results['acct_name']?>">
                </div>

                <div class="mb-3">
                  <label for="">Bank Name</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="bank_name" value="<?=$results['bank_name']?>">
                </div>

                <div class="mb-3">
                  <label for="">Location</label>
                    <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="address" value="<?=$results['address']?>">
                </div>

                <div class="mb-3">
                  <label for="">Subscription Date</label>
                    <input type="datetime-local" class="form-control border ps-3 pe-3 pt-3 pb-3" name="sub_end" value="<?=date('Y-m-d\TH:i:s', strtotime($results['sub_end']))?>">
                </div>

                <button type="submit" class="btn btn-success mt-4" name="editseller">Edit Seller</button>
              </form>
              <?php } } ?>
            </div>
          </div>
        </div>
      </div>










<?php include "inc/footer.php"; ?>