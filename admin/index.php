<?php include "inc/header.php"; ?>
  <?php include "../classes/Admin.php"; ?>

  <?php 

    $admin = new Admin();

    $format = new Format();

  ?>



  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
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
            
            <div class="input-group input-group-outline">
              <h6><?= Session::get("sup_email")?></h6>
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
        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-2 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">paid</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                <h4 class="mb-0">
                  &#8358;<?php
                     $email = Session::get("sup_email"); 
                     $date = date('Y-m-d');

                    $getData = $admin->numRowAdminSalesToday($email,$date);
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-2 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Sellers</p>
                <h4 class="mb-0">
                  <?php
                    
                    $getData = $admin->numRowSellers();
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?>                   
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-2 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Users</p>
                <h4 class="mb-0">
                  <?php
                    
                    $getData = $admin->numRowUsers();
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?> 
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
             
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-2 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">receipt</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                <h4 class="mb-0">
                  &#8358;<?php
                     $email = Session::get("sup_email"); 

                    $getData = $admin->numRowAdminSales($email);
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>
      
      
        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">upload</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Products</p>
                <h4 class="mb-0">
                  <?php
                    
                    $getData = $admin->numRowProducts();
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>

        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">upload</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Orders</p>
                <h4 class="mb-0">
                  <?php
                    
                    $email = Session::get("sup_email");
                    $getData = $admin->numRowAdminOrders($email);
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>


        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Visitors</p>
                <h4 class="mb-0">
                  <?php 

                    $query = "SELECT count(counter_id) as total FROM visitors ";
                    $result = $db->select($query);
               

                    if (!$result) {
                      $total_visitors = $result[0]['total'];
                    }
                    $total_visitors = $result[0]['total'];
                                  
                  ?>
                  <?php echo number_format($total_visitors); ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>

        <div class="col-6 col-md-3 mb-4">
          <div class="card">
            <a href="/admin/disburse-payment"><div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">paid</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Payment</p>
                <h4 class="mb-0">
                  <?php
                    
                    $email = Session::get("sup_email");
                    $getData = $admin->numRowAdminOrders($email);
                    
                    if(isset($getData)){                                               
                        echo $getData;
                    }

                  ?>
                </h4>
              </div>
            </div></a>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Website Views</h6>
              <p class="text-sm ">Last Campaign Performance</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> Daily Sales </h6>
              <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> updated 4 min ago </p>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Products</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">
                      <?php
                    
                        $getData = $admin->numRowProducts();
                        
                        if(isset($getData)){                                               
                            echo $getData;
                        }

                      ?> Products
                    </span>
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="/admin/view-product">View All</a></li>
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive text-center">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Image</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Price</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                
                      $getPro = $admin->getAllProductsLimit();

                      if($getPro){
                        $i = 0;
                        foreach ($getPro as $results) {
                          $i++;
     
                    ?>
                    <tr>
                      <td>                          
                        <h6 class="mb-0 text-sm"><?=str_replace(array( '//','\\','\'', '"',',' , ';', '<', '>' ), ' ',$results['product_name'])?></h6>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <img src="<?=$format->esc($results['product_image'])?>" width="50" height="50" alt="" class="rounded-circle">
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> &#8358;<?=number_format($results['product_price'])?></span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold"><?=$format->esc($results['stock'])?></span>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Orders overview</h6>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <?php 
                  $email = Session::get("sup_email"); 

                  $getPro = $admin->getAllAdminOrdersLimit($email,$limit = 10);

                  if($getPro){
                    $i = 0;
                    foreach ($getPro as $results) {
                      $i++;
 
                ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-success text-gradient">notifications</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">&#8358;<?=number_format($results['product_price'])?>, <?=$format->esc($results['product_name'])?></h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?=$format->formatDateTime($results['date_purchased'])?></p>
                  </div>
                </div>
                <?php } } ?>

                <?php  

                  if (empty($getPro)): ?>
                    
                  <div class="text-center">
                    <h5>No Orders</h5>
                  </div>

                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      



<?php include "inc/footer.php"; ?>