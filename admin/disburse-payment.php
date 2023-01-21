<?php include "inc/header.php"; ?>
<?php include "../classes/Admin.php"; ?>

  <?php 
    
    $admin = new Admin();

    $format = new Format();

  ?>

  <?php 
      
    if(isset($_GET['delseller'])){

      $slug = $_GET['delseller'];
      
      $delpro = $admin->delSeller($slug);
    }

  ?>

  <?php 
      
    if(isset($_GET['disable'])){

      $slug = $_GET['disable'];
      
      $disable = $admin->disableSeller($slug);
    }

    if(isset($_GET['enable'])){

      $slug = $_GET['enable'];
      
      $enable = $admin->enableSeller($slug);
    }
  
  ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Disburse Payment</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Disburse Payment</h6>
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
              <div class="float-start">
                <h6>Disburse Payment List</h6>
              </div>
            </div>
            <div class="card-body p-3">
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
              <div class="table-responsive text-center">
                <table class="table table-hover">
                  <thead>
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>Bank Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php 
                
                      $getSeller = $admin->getAllOrders();

                      if($getSeller){
                        $i = 0;
                        foreach ($getSeller as $results) {
                          $i++;
     
                    ?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$format->esc($results['fname'])?> <?=$format->esc($results['lname'])?></td>
                      <td><?=$format->esc($results['email'])?></td>
                      <td><?=$format->esc($results['acct_num'])?></td>
                      <td><?=$format->esc($results['acct_name'])?></td>

                      <td><?=$format->esc($results['bank_name'])?></td>
                      <?php  

                        $price = $results['product_price'];
                        $percentInDecimal = 1 / 100;
                        $amount = $percentInDecimal * $price;

                        $totalprice = $price - $amount;

                      ?>
                      <td><?= number_format($totalprice) ?></td>
                      <td><?=$format->esc($results['status'])?></td>


                      <td>
                        <a class="btn btn-success btn-sm" href="edit-seller?proid=<?=$results['email']; ?>">Paid</a>

                        <a class="btn btn-danger btn-sm" href="?delseller=<?php echo $results['email']; ?>">Delete</a>
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












<?php include "inc/footer.php"; ?>