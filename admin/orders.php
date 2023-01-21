<?php include "inc/header.php"; ?>

  <?php include "../classes/Admin.php"; ?>

  <?php 
    
    $admin = new Admin();

    $format = new Format();

  ?>

  <?php 
        
      if(isset($_GET['deleteorder'])){

        $deleteorder = $_GET['deleteorder'];
        
        $delpro = $admin->delOrder($deleteorder);
      }
    
  ?>

  <?php 

    if(isset($_GET['confirm'])){

        $confirm = $_GET['confirm'];
        
        $confirmorder = $admin->confirmOrder($confirm);
      }

      if(isset($_GET['process'])){

        $process = $_GET['process'];
        
        $processorder = $admin->processOrder($process);
      }

      if(isset($_GET['deliver'])){

        $deliver = $_GET['deliver'];
        
        $deliverorder = $admin->deliverOrder($deliver);
      }
        
      if(isset($_GET['delivered'])){

        $delivered = $_GET['delivered'];
        
        $orderdelivered = $admin->orderDelivered($delivered);
      }

      if(isset($_GET['cancel'])){

        $cancel = $_GET['cancel'];
        
        $ordercanceled = $admin->orderCancel($cancel);
      }
    
  ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Products</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Products</h6>
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
              <h6>Product List</h6>
            </div>
            <div class="card-body p-3">
              <?php 
            
                if(isset($confirmorder)){
                  echo $confirmorder;
                }

                if(isset($processorder)){
                  echo $processorder;
                }

                if(isset($deliverorder)){
                  echo $deliverorder;
                }

                if(isset($orderdelivered)){
                  echo $orderdelivered;
                }

                if(isset($ordercanceled)){
                  echo $ordercanceled;
                }

                if(isset($delpro)){
                  echo $delpro;
                }

                ?>
              <div class="table-responsive text-center">
                <table class="table table-hover">
                  <thead>
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
                  </thead>
                  <tbody>
                    <?php 

                      $getPro = $admin->getSellerOrders();

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
                        <!-- Confirm Order -->
                        <?php  

                        if($results['delivery_status'] == "Pending"):
                        ?>
                        <a onClick="return confirm('Are you sure?')" href="?confirm=<?php echo $results['order_id']; ?>" class="btn btn-success btn-sm">Confirm</a>

                        <a onClick="return confirm('Are you sure?')" href="?cancel=<?php echo $results['order_id']; ?>" class="btn btn-primary btn-sm">Cancel</a>

                        <?php 
                        elseif($results['delivery_status'] == "Order Confirmed"): 
                        ?>
                        <a onClick="return confirm('Are you sure?')" href="?process=<?php echo $results['order_id']; ?>" class="btn btn-success btn-sm">Process</a>

                        <a onClick="return confirm('Are you sure?')" href="?cancel=<?php echo $results['order_id']; ?>" class="btn btn-primary btn-sm">Cancel</a>

                        <?php elseif($results['delivery_status'] == "Processing"): ?>

                          <a onClick="return confirm('Are you sure?')" href="?deliver=<?php echo $results['order_id']; ?>" class="btn btn-success btn-sm">Deliver</a>

                          <a onClick="return confirm('Are you sure?')" href="?cancel=<?php echo $results['order_id']; ?>" class="btn btn-primary btn-sm">Cancel</a>

                        <?php elseif($results['delivery_status'] == "Out for Delivery"): ?>

                          <a onClick="return confirm('Are you sure?')" href="?delivered=<?php echo $results['order_id']; ?>" class="btn btn-success btn-sm">Delivered</a>

                          <a onClick="return confirm('Are you sure?')" href="?cancel=<?php echo $results['order_id']; ?>" class="btn btn-primary btn-sm">Cancel</a>
                        <?php endif; ?>

                        <!-- End Confirm Order -->


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


<?php include "inc/footer.php"; ?>