<?php include "includes/header.php"; ?>

	<?php 

	    if(isset($_GET['info'])){
	    
	      $info = $_GET['info'];
	    }
	  
	?>


	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <li class="breadcrumb-item">Seller Profile</li>
					    <?php 
                        
			                $getSellerInfo = $user->getSellerInfo($info);
			                if($getSellerInfo){
			                  foreach($getSellerInfo as $results){

			            ?>
					    <li class="breadcrumb-item active" aria-current="page"><?=$results['biz_name']?></li>
					    <?php } } ?>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="seller pt-100">
		<div class="container">
			<div class="row">
				<?php 
                        
		          $getSellerInfo = $user->getSellerInfo($info);
		          if($getSellerInfo){
		            foreach($getSellerInfo as $results){

		        ?>

		        <?php if($results['seller_type'] == "Seller"): ?>
				<div class="col-md-6 mb-3">
					<div class="profile">
						<div>
							<h6>SELLER INFORMATION</h6>
						</div>
						<p>
							Selling on Suremarts:&nbsp; <strong><?=$format->formatDate($results['date_created'])?></strong>
						</p>
						<p>
							<!-- Successful Sales:&nbsp; <strong>10000+</strong> -->
						</p>
						<p>
							Country of Origin:&nbsp; <strong>Nigeria</strong>
						</p>
					</div>
				</div>

				<div class="col-md-6 mb-3">
					<div class="profile">
						<div>
							<h6>CONTACT DETAILS</h6>
						</div>
						<p>
							Address:&nbsp; <strong><?=$format->esc($results['address'])?></strong>
						</p>
						<p>
							Facebook:&nbsp; <a href="https://www.facebook.com/<?=$format->esc($results['facebook'])?>" target="_blank"><strong><?=$format->esc($results['facebook'])?></strong></a>
						</p>
						<p>
							Instagram:&nbsp; <a href="https://www.instagram.com/<?=$format->esc($results['instagram'])?>" target="_blank"><strong><?=$format->esc($results['instagram'])?></strong></a>
						</p>
						<p>
							Whatsapp:&nbsp; <a href="https://wa.me/<?=$format->esc($results['phone_number'])?>" class="text-dark"><strong><?=$format->esc($results['phone_number'])?></strong></a>
						</p>
					</div>
				</div>
				<?php elseif($results['seller_type'] == "Admin"): ?>

				<?php endif; ?>
				<?php } } ?>
			</div>
		</div>
	</div>

	<div class="collections other_products bg_coll">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="txt">
						<h3>Seller's Products</h3>
						<div></div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php 
                        
                  $getSellerInfo = $user->getSellerProd($info,$limit = 50);
                  if($getSellerInfo){
                    foreach($getSellerInfo as $results){

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
	</div>




<?php include "includes/footer.php"; ?>