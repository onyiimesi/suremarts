<?php include "includes/header.php"; ?>

	<?php 
    
        $login = Session::get("CusLogin");
        if($login == false){
            header("Location: login");
        }

    ?>

    <?php 
        
    if(isset($_GET['order'])){
    
      $order = $_GET['order'];
    }
    
    ?>


    <section class="customer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                   <div class="customer_nav">
                        <div class="first">
                          
                            <a href="/customer" class="active"><i class="fas fa-user"></i> My Account</a>
                            <a href="/view-orders"><i class="fas fa-shopping-bag"></i> Orders</a>
                            <a href=""><i class="fas fa-heart"></i> Wishlist</a>
                           
                        </div>

                        <div class="second">
                           
                           <a href="/customer-details">Details</a>
                           <a href="/customer-change-password">Change Password</a>
                           
                        </div>

                        <div class="third">
                           <a href="/logout">LOGOUT</a>
                        </div>
                   </div> 
                </div>

                <div class="col-md-9">
                    <div class="customer_details">
                        <div class="over">
                            <h5>Order Details</h5>
                        </div>

                        <div class="details mt-3">
                            <?php 
                        
                                $getSingleOrder = $user->getSingleOrder($order);
                                if($getSingleOrder){
                                    $sum = 0;
                                  foreach($getSingleOrder as $results){

                              ?>
                            <div class="row">
                                <div class="col-md-12 pb-4">
                                    <div class="order_det">
                                        <p style="color: #333;">Order nº: <b><?=$format->esc($results['order_no'])?></b></p>
                                        <span><?=$format->esc($results['product_qty'])?> Items</span><br>
                                        <span>Placed On: <?=$format->formatDateTime($results['date_purchased'])?></span><br>

                                        <?php  

                                            $amount = $results['product_price'] * $results['product_qty'];

                                        ?>
                                        <span>Total: &#8358;<?=number_format($amount)?></span>
                                    </div>
                                </div><hr>
                            </div>

                            <?php
                                $sum = $sum + $amount;
                                Session::set("sum", $sum);
                            ?>
                            <?php } } ?>

                            
                            <div class="row">
                                <h6>ITEMS IN YOUR ORDER</h6>
                                <?php 
                        
                                    $getSingleOrder = $user->getSingleOrder($order);
                                    if($getSingleOrder){
                                        $amount = 0;
                                      foreach($getSingleOrder as $results){

                                ?>
                                <div class="col-md-12 pb-4">
                                    <div class="box d-flex">
                                        <div class="or_img">
                                          <img src="/admin/<?=$results['product_image']?>" width="100" height="100" class="img-fluid" alt="">
                                        </div>

                                        <div class="or_detail"> 
                                            <p style="color: #333;"><?=$format->esc($results['product_name'])?></p>
                                            <span><?=$format->esc($results['delivery_status'])?></span><br>

                                            <?php if (!$results['delivery_date'] == NULL): ?>
                                                <span>On <?=$format->formatDateTime($results['delivery_date'])?></span>
                                            <?php endif ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                            

                            <?php 
                        
                                $getSingleOrder = $user->getSingleOrder($order);
                                if($getSingleOrder){
                                    $amount = 0;
                                  foreach($getSingleOrder as $results){

                            ?>
                            <?php } } ?>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="box">
                                      <div class="head">
                                          <h6>PAYMENT INFORMATION</h6>

                                      </div>

                                      <div>
                                          <h6><b>Payment Details</b></h6>
                                          <span>Items total: <b>&#8358;<?=number_format($sum)?></b></span>
                                          <span></span>


                                      </div>
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="head">
                                          <h6>DELIVERY INFORMATION</h6>
                                        </div>

                                        <div>
                                            <h6><b>Shipping Address</b></h6>
                                          <p style="color: #333;"><?=$format->esc($results['address'])?>, <?=$format->esc($results['city'])?> <?=$format->esc($results['state'])?></p>
                                        </div>
                                    </div> 
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