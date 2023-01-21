<?php include "includes/header.php"; ?>

	<?php 
    
        $login = Session::get("CusLogin");
        if($login == false){
            header("Location: login");
        }

    ?>


    <section class="customer">
        <div class="container">
            <div class="row">


                <?php  

                    $activePage = basename($_SERVER['PHP_SELF'], ".php");

                ?>
                
                <div class="col-md-3 mb-4">
                    <div class="customer_nav">
                        <div class="first">
                          
                            <a href="/customer" class="<?= ($activePage == 'customer') ? 'active':''; ?>"><i class="fas fa-user"></i> My Account</a>
                            <a href="/view-orders" class="<?= ($activePage == 'view-orders') ? 'active':''; ?>"><i class="fas fa-shopping-bag"></i> Orders</a>
                            <!-- <a href=""><i class="fas fa-heart"></i> Wishlist</a> -->
                           
                       </div>

                       <div class="second">
                           
                           <a href="/customer-details" class="<?= ($activePage == 'customer-details') ? 'active':''; ?>">Details</a>
                           <a href="/customer-change-password" class="<?= ($activePage == 'customer-change-password') ? 'active':''; ?>">Change Password</a>
                           
                       </div>

                        <div class="third">
                           <a href="/logout">LOGOUT</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="customer_details">
                        <div class="over">
                            <h5>Orders</h5>
                        </div>

                        <div class="details mt-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <?php 

                                        $email = Session::get("UserEmail");


                                        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                            
                                        $page_no = $_GET['page_no'];
                                        } else {
                                            $page_no = 1;
                                        }

                                        $total_records_per_page = 5;
                                        $offset = ($page_no-1) * $total_records_per_page;
                                        $previous_page = $page_no - 1;
                                        $next_page = $page_no + 1;
                                        $adjacents = "2";
                                        $result_count = "SELECT COUNT(*) As total_records FROM orders WHERE email = '$email' ";
                                        $result = $db->select($result_count);
            
                                        $total_records = $result[0]['total_records'];
                                        $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                        $second_last = $total_no_of_pages - 1; // total pages minus 1

                                        $post_query_count = "SELECT COUNT(*) As total_records FROM orders WHERE email = '$email' ";
                                        $result = $db->select($post_query_count);
                                        $count = $result[0]['total_records'];

                                        $count = ceil($count / $total_records_per_page);

                                        $second_last = $count - 1; // total page minus 1


                                      

                                      $getOrders = $user->getOrders($email,$offset, $total_records_per_page);
                                      if($getOrders){
                                        foreach($getOrders as $results){

                                    ?>
                                    <a href="/view-order-details/<?=$results['order_no']?>"><div class="box d-flex mb-3">
                                        <div class="or_img">
                                          <img src="admin/<?=$results['product_image']?>" width="100" height="100" class="img-fluid" alt="">
                                        </div>

                                        <div class="or_detail"> 
                                            <p style="color: #333;"><?=$format->esc($results['product_name'])?></p>
                                            <span>Order no: <b><?=$format->esc($results['order_no'])?></b></span><br><br>
                                            <span>

                                                <?=$format->esc($results['delivery_status'])?><br>
                                                
                                                <?php  
                                                    if ($results['delivery_status'] == "Pending" ) {
                                                        $value = 10;
                                                    }else if ($results['delivery_status'] == "Order Confirmed") {
                                                        $value = 30;
                                                    }else if ($results['delivery_status'] == "Processing") {
                                                        $value = 50;
                                                    }else if ($results['delivery_status'] == "Out for Delivery") {
                                                        $value = 80;
                                                    }else if ($results['delivery_status'] == "Delivered") {
                                                        $value = 100;
                                                        $color = 'green';
                                                    }else if ($results['delivery_status'] == "Order Cancelled") {
                                                        $value = 100;
                                                        $color = 'red';
                                                        
                                                    }
                                                ?>
                                                <progress class="bg-warning" id="file" value="<?=$value?>" max="100" style="background: <?=$color?>;"> 32% </progress>
                                            </span>
                                            <p><b>Placed On: <?=$format->formatDate($results['date_purchased'])?></b></p>
                                        </div>
                                    </div></a>  
                                    <?php } }else if (empty($getOrder)): ?>
                                        
                                        <div class="text-center">
                                            <h5>No Orders Made Yet.</h5>
                                            <a class="btn btn-primary button" style="width: 150px;color: #fff;" href="/">Shop Now</a>
                                        </div>
                                    
                                    <?php endif; ?>
                                    
                                </div>
                            </div>

                            
                                         
                                <div class="row">
                                  <div class="col-md-12">
                                  <div style='padding: 25px 20px 0px;'>
                                      <strong>Page <?php echo $page_no." of ".$count; ?></strong>
                                  </div>
                                  <style>
                                    .active .pg{
                                        background-color: #333 !important;
                                        border: 1px solid #fff !important;
                                        color: #fff !important;
                                    }
                                  </style>

                                  <ul class="pagination" style="margin: 20px 0 0 0;">
                                      <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
                                      
                                      <li class="page-item" <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                                      <a class="page-link" <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
                                      </li>
                                          
                                        <?php 
                                          if ($count <= 10){     
                                          for ($counter = 1; $counter <= $count; $counter++){
                                              if ($counter == $page_no) {
                                              echo "<li class='page-item active'><a class='page-link pg'>$counter</a></li>";  
                                              }else{
                                                  echo "<li class='page-item'><a class='page-link pg' href='?page_no=$counter'>$counter</a></li>";
                                              }
                                              }
                                          }
                                          elseif($count > 10){
                                          
                                          if($page_no <= 4) {     
                                          for ($counter = 1; $counter < 8; $counter++){     
                                              if ($counter == $page_no) {
                                              echo "<li class='page-item active'><a>$counter</a></li>";  
                                              }else{
                                                  echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                              }
                                              }
                                          echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                          }

                                          elseif($page_no > 4 && $page_no < $count - 4) {     
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                              echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                              for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
                                                  if ($counter == $page_no) {
                                              echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";  
                                              }else{
                                                  echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                              }                  
                                              }
                                              echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                                  }
                                          
                                          else {
                                              echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                          echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                              echo "<li class='page-item'><a class='page-link'>...</a></li>";

                                              for ($counter = $count - 6; $counter <= $count; $counter++) {
                                                  if ($counter == $page_no) {
                                              echo "<li class='page-item active'><a>$counter</a></li>";  
                                              }else{
                                                  echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                              }                   
                                                      }
                                                  }
                                          }
                                        ?>
                                      
                                      <li class='page-item' <?php if($page_no >= $count){ echo "class='disabled'"; } ?>>
                                      <a class='page-link' <?php if($page_no < $count) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                                      </li>
                                      <?php if($page_no < $count){
                                      echo "<li class='page-item'><a class='page-link' href='?page_no=$count'>Last</a></li>";
                                      } ?>
                                  </ul>
                                  </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="other_products pt-100">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="other_txt text-center">
                        <h3>Recommended for you</h3>
                        <div></div>
                    </div>  
                </div>
            </div>
            <div class="row">
                <?php 
                
          $getPro = $admin->getSubPro($limit = 6);

          if($getPro){
           
            foreach ($getPro as $results) {
             

        ?>
                <div class="col-6 col-md-2">
                    <a href="/product-detail/<?=$results['product_slug']?>"><div class="others shadow">
                        <img src="/admin/<?=$results['product_image']?>" class="img-fluid" alt="">
                        <h5 style="font-size: 14px;"><?=$results['product_name']?></h5>

                        <h6>
                            <?php  

                $price = $results['product_price'];
                $percentToGet = $results['discount_price'];
                $percentInDecimal = $percentToGet / 100;
                $totalamount = $percentInDecimal * $price;

              ?>
                            <strong>&#8358;<?=number_format($totalamount)?></strong> <span style="font-size: 11px;"><strike>&#8358;<?=number_format($results['product_price'])?></strike></span>
                        </h6>
                        <button class="btn btn-primary button">Buy Now</button>
                    </div></a>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div><hr>








<?php include "includes/footer.php"; ?>