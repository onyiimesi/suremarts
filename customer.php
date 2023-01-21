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
                            <h5>Account Overview</h5>
                        </div>

                        <div class="details mt-3">
                            <?php 

                              $info = Session::get("UserEmail");
                        
                              $getCustomerInfo = $user->getCustomerInfo($info);
                              if($getCustomerInfo){
                                foreach($getCustomerInfo as $results){

                            ?>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                  <div class="box">
                                      <div class="head">
                                          <h6>ACCOUNT DETAILS</h6>

                                      </div>

                                      <div>
                                          <h6><?=$results['fname']?> <?=$results['lname']?></h6>
                                          <p style="color: #333;"><?=$results['email']?></p>
                                      </div>
                                  </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="box">
                                      <div class="head">
                                          <h6>ADDRESS BOOK</h6>
                                      </div>

                                      <div>
                                          <h6><b>Your default shipping address:</b></h6>
                                          <span><?=$results['fname']?> <?=$results['lname']?></span><br>
                                          <span><?=$results['address']?></span><br>
                                          <span><?=$results['city']?>, <?=$results['state']?></span><br>
                                          <span><b><?=$results['phone']?></b></span>
                                      </div>
                                    </div> 
                                </div>
                            </div>
                            <?php } } ?>
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