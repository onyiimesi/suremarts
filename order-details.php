<?php include "includes/header.php"; ?>

	<?php 
    
      $login = Session::get("CusLogin");
      if($login == false){
          header("Location: login");
      }

  ?>

  <?php 
      $getData = $user->checkCartTable();
      if(empty($getData)){
          header("Location: /");
      }else{
          $getData = 0;
      }                               
  ?>


	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <li class="breadcrumb-item">Order Details</li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="information pt-100">
		<div class="container">
			<div class="row">
				<?php 
          $info = Session::get("UserEmail");

          $getCustomerInfo = $user->getCustomerInfo($info);
          if($getCustomerInfo){
            foreach($getCustomerInfo as $results){
            	$city = $results['state'];
        ?>
				<div class="col-md-4 mb-4">
					<div class="personal contact_bg">
						<h4>Delivery Address</h4>
						<hr>
						<p>
							<?=$results['address']?>
						</p>
						<p>
							<?=$results['city']?>
						</p>
						<p>
							<?=$results['state']?>
						</p>
						
						
					</div>
				</div>
				<?php } }?>

				
				<div class="col-md-8 mb-4">
					<div class="personal contact_bg">
						<h4>Order Summary</h4>
						<hr>
						<table class="table table-hover">
							<tr>
								<th>PRODUCT</th>
								<th>TOTAL</th>
							</tr>

							<?php 
                                    
			          $getPro = $user->getCartProduct();
			          
			          
			          if($getPro){
			              $sum = 0;
			              $sumss = 0;
			              foreach($getPro as $result){

			        ?>
							<tr>
								<td><?=$result['product_name']?></td>
								<?php  

                    $price = $result['product_price'];
                    $percentToGet = $result['discount_price'];
                    $percentInDecimal = $percentToGet / 100;
                    $amount = $percentInDecimal * $price;

                    $totalprice = $price - $amount;



                    $cities = array('Lagos', 'Abuja');

                    

                ?>

                                            
								<td>&#8358;<?=number_format($totalprice);?></td>
								<?php
                    $sum = $sum + $totalprice;
                    Session::set("sum", $sum);
                ?>
							</tr>
							<?php } } ?>
							
							<tr>
								<th>VAT:</th>

								<th>
									<?php 
										$paystackPercent = 1.5;
										$paystackInDecimal = $paystackPercent / 100;
										
                    $total = ($paystackInDecimal * $sum) + 100;


									
									
									?>
                  &#8358;<?= number_format($total); ?>

								</th>
							</tr>
							<tr>
								<th>Total:</th>
								<?php $sums = $sum + $total; ?>
								<th>&#8358;<?= number_format($sums); ?> <span>+ Delivery fee</span></th>
							</tr>
						</table>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="bt float-end">
						<a href="/payment"><button type="submit" style="width: 160px;padding: 10px;font-size: 15px;" class="btn btn-primary button" name="">Procced to Payment</button></a>
					</div>
				</div>
			</div>
		</div>
	</div><hr>






<?php include "includes/footer.php"; ?>