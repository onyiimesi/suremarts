<?php include "includes/header.php"; ?>

	<?php 
        if(isset($_GET['delpro'])){
            $delId = $_GET['delpro'];
            $delProduct = $user->delProductByCart($delId);
        }
    
    ?>

    <?php 
    
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cart_id = $_POST['cart_id'];
            $product_quantity = $_POST['product_qty'];

            $updateCart = $user->updateCartQuantity($cart_id, $product_quantity);
            if($product_quantity <= 0){
                $delProduct = $user->delProductByCart($cart_id);
            }

            
        }
 
    ?>


	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="#">Home</a></li>
					    <li class="breadcrumb-item"><a href="#">Your Cart</a></li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="cart pt-100">
		<div class="container">
			<div class="row">
				<div class="col-md-8 mb-3">
					<div class="cart-items shadow-sm">
						<div class="table-responsive">
							<table class="table table-borderless">
							  <thead>
							    <tr>
							      <th scope="col">Cart(<?php
                                            $getData = $user->numRow();
                                            
                                            if(isset($getData)){                                               
                                                echo $getData;
                                            }

                                        ?>)</th>
							      <th scope="col">Name</th>
							      <th scope="col">Price</th>
							      <th scope="col">Qty</th>
							      <th scope="col">Total</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  	<tbody>
							  		<?php 
                                    
                                        $getPro = $user->getCartProduct();
                                        if($getPro){
                                            $sum = 0;
                                            foreach($getPro as $result){

                                    ?>
								    <tr>
								      
								      <td>
								      	<img src="/admin/<?php echo $result['product_image']; ?>" width="50" height="50" class="img-fluid" alt="">
								      </td>
								      <td>
								      	<span style="font-size: 16px;"><?=$result['product_name']; ?></span>
								  	  </td>
								  	  <td>
								      	<h5><strong><?php  

                                                        $price = $result['product_price'];
                                                        $percentToGet = $result['discount_price'];
                                                        $percentInDecimal = $percentToGet / 100;
                                                        $amount = $percentInDecimal * $price;

                                                        $totalprice = $price - $amount;

                                                    ?>
                                                   
                                                &#8358;<?=number_format($totalprice)?></strong></h5>
										<span style="font-size: 14px;">

											<?php 

												if ($result['discount_price'] && $result['discount_price'] > 0) { ?>
												<strike style="font-size: 12px;">&#8358;<?=number_format($result['product_price']) ?></strike>  
												
											<span class="bg text-white p-1" style="font-size: 12px;"><?=$result['discount_price'] ?>%</span>
											<?php }
											?>
										</span>
								      </td>
								      <td>
								      	
								      	<div class="quantity">
                                            <div class="pro-qty">
                                                <form action="" method="post">
                                                    <input type="hidden" name="cart_id" value="<?=$result['cart_id']; ?>">
                                                    <input type="number" name="product_qty" value="<?=$result['product_qty']; ?>">
                                                    <input type="submit" name="submit" value="Update">
                                                </form>                                               
                                            </div>
                                        </div>
								      </td>
								      <td>
								      	<strong>&#8358;<?php  
                                            $total = $totalprice * $result['product_qty'];
                                            echo number_format($total);
                                            ?></strong>
								      </td>
								      <td><a onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm" href="cart/<?php echo $result['cart_id']; ?>">Remove</a></td>
								    </tr>
								    <?php
                                        $sum = $sum + $total;
                                        Session::set("sum", $sum);
                                    ?>
                                    <?php } } ?>
							    </tbody>
							</table>
							<?php 
                                $getData = $user->checkCartTable();
                                if(empty($getData)){
                                    header("Location: /");
                                }else{
                                    $getData = 0;
                                }                               
                            ?>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="cart-items">
						<h3 style="font-size: 16px;"><strong>Cart Summary</strong></h3><hr>
						<div>
							<?php 
                                $getData = $user->checkCartTable();
                                if($getData){
                               
                            ?>
							<h6>Subtotal: <strong>&#8358;<?php echo number_format($sum); ?></strong></h6>
							<?php } ?>
							<!-- <span style="font-size: 14px;">Delivery fee not included yet.</span> -->
							<a href="/additional-info"><button class="btn btn-primary button mt-3">CHECKOUT</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="other_products pt-100">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12">
					<div class="other_txt text-center">
						<h3>Shop More</h3>
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
				<div class="col-6 col-md-2 mb-4 text-center">
					<a href="/product-detail/<?=$results['product_slug']?>"><div class="others shadow">
						<img src="/admin/<?=$results['product_image']?>" class="img-fluid" alt="">
						<h5 style="font-size: 14px;"><?=$results['product_name']?></h5>
						<?php  
                if($results['type'] == "Admin"): ?>
                    <span class="locator"><i class="fas fa-map-marker-alt"></i> <?=$format->textShorten('Surulere, Lagos, Nigeria', 13)?></span><br>

            <?php elseif($results['type'] == "Seller"): ?>
                <span class="locator"><i class="fas fa-map-marker-alt"></i> <?=$format->textShorten($results['address'], 13)?></span><br>

            <?php endif; ?>
						<h6>
							<?php  

                  $price = $results['product_price'];
                  $percentToGet = $results['discount_price'];
                  $percentInDecimal = $percentToGet / 100;
                  $amount = $percentInDecimal * $price;

                  $totalprice = $price - $amount;

              ?>
							<strong>&#8358;<?=number_format($totalprice)?></strong> 
							<span style="font-size: 11px;">

								<?php  
                    if ($results['discount_price'] && $results['discount_price'] > 0) {?>
                        <strike>&#8358;<?=number_format($results['product_price'])?></strike>
                    <?php }
                ?>
							</span>
						</h6>
						<button class="btn btn-primary button">Buy Now</button>
					</div></a>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div><hr>


<?php include "includes/footer.php"; ?>