<?php include "includes/header.php"; ?>

	<?php 
    
        $login = Session::get("CusLogin");
        if($login == false){
            header("Location: login");
        }

    ?>


    <?php 

        $info = Session::get("UserEmail");

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){

          $save = $user->customerdetUpdate($_POST);
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
                            <h5>Details</h5>
                        </div>

                        <div class="details mt-3">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                  <div class="boxs">
                                    <form action="" method="post">
                                        <?php  
                                            if (isset($save)) {
                                                echo $save;
                                            }
                                        ?>

                                        <?php 
                                    
                                          $getCustomerInfo = $user->getCustomerInfo($info);
                                          if($getCustomerInfo){
                                            foreach($getCustomerInfo as $results){

                                        ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="">First Name</label>
                                                <input type="text" class="form-control" name="fname" value="<?=$results['fname']?>">
                                            </div>

                                            <div class="col-md-6 mb-4">
                                               <label for="">Last Name</label>
                                                <input type="text" class="form-control" name="lname" value="<?=$results['lname']?>"> 
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="">E-mail</label>
                                                <input type="email" class="form-control" name="email" value="<?=$results['email']?>" readonly>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                               <label for="">Phone Number (optional)</label>
                                                <input type="text" class="form-control" name="phone" value="<?=$results['phone']?>"> 
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="">Gender</label>
                                                <select name="gender" class="form-control" id="">
                                                    <option>Please select</option>
                                                    <option selected value="<?=$results['gender']?>"><?=$results['gender']?></option>
                                                    <option value="<?=$results['gender']?>">Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                               <label for="">Birthday (optional)</label>
                                                <input type="date" class="form-control" name="birthday" value="<?=$results['birthday']?>"> 
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="">Address</label>
                                                <textarea class="form-control" name="address"><?=$results['address']?></textarea>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                               <label for="">City</label>
                                                <input type="text" class="form-control" name="city" value="<?=$results['city']?>"> 
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                               <label for="">State</label>
                                                <input type="text" class="form-control" name="state" value="<?=$results['state']?>"> 
                                            </div>
                                        </div>
    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary button" name="save">Save</button>
                                            </div>
                                        </div>
                                        <?php } } ?>
                                    </form>
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