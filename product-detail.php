<?php include "includes/header.php"; ?>

	

	<?php 
		
    if(isset($_GET['proid'])){
    
      $slug = $_GET['proid'];
    }
    
    ?>

    <?php 
                        
	    $getProduct = $user->getSingleProduct($slug);
	    if($getProduct){
	      foreach($getProduct as $results){
	      	$product_qty = $results['product_qty'];

	  ?>
	  <?php } } ?>

	  <?php  

	  	if ($product_qty == 0) {
	  		header("Location: /");
	  	}

	  ?>

    <?php 
    
       
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
          
        $addCart = $user->addToCart($_POST, $slug);
      
      }
 
    ?>

    <?php 
      //$cusId = Session::get("cusId");
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){ 
          $product_id = $_POST['product_id'];
          $insertCompare = $product->insertCompare($product_id, $cusId);
      }

    ?>

    <?php 
      //$cusId = Session::get("cusId");
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){ 
          $wishlist = $product->saveWishlist($id, $cusId);
      }

    ?>


	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <?php 
                        
                $getProduct = $user->getSingleProduct($slug);
                if($getProduct){
                  foreach($getProduct as $results){

              ?>
					    <li class="breadcrumb-item"><a href="/category/<?=$results['category']?>"><?=$results['category']?></a></li>
					    
					    <li class="breadcrumb-item active" aria-current="page"><?=$results['product_name']?></li>
						<?php } } ?>	
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>



	<div class="product_detail pt-100">
		<div class="container">
			<div class="row">
				<?php 
                        
          $getProduct = $user->getSingleProduct($slug);
          if($getProduct){
            foreach($getProduct as $results){

        ?>
				<div class="col-md-4 mb-5">
					<div class="product_img">
						<img src="/admin/<?=$results['product_image']?>" class="img-fluid" alt="">
					</div>
					<div class="img_slide pt-3">
					    <div>
					    	<img src="/img/ban1.jpg" class="img-fluid" alt="">
					    </div>
					    <div>
					    	<img src="/img/ban1.jpg" class="img-fluid" alt="">
					    </div>
					    <div>
					    	<img src="/img/ban1.jpg" class="img-fluid" alt="">
					    </div>
					    <div>
					    	<img src="/img/ban1.jpg" class="img-fluid" alt="">
					    </div>
					    <div>
					    	<img src="/img/ban1.jpg" class="img-fluid" alt="">
					    </div>
					    <div>
					    	<img src="/img/ban1.jpg" class="img-fluid" alt="">
					    </div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="product_desc">
						<h3><?=$results['product_name']?></h3>
						<?php  
	              if($results['type'] == "Admin"): ?>
	                  <span class="locator"><i class="fas fa-map-marker-alt"></i> Surulere, Lagos, Nigeria</span><br>

	          		<?php elseif($results['type'] == "Seller"): ?>
	              <span class="locator"><i class="fas fa-map-marker-alt"></i> <?=$format->esc($results['address'])?></span><br>

	          <?php endif; ?>
						<div class="mt-3">
							<?php  

                $price = $results['product_price'];
                $percentToGet = $results['discount_price'];
                $percentInDecimal = $percentToGet / 100;
                $amount = $percentInDecimal * $price;

                $totalprice = $price - $amount;

            	

              ?>
							<h5><strong>&#8358;<?=number_format($totalprice)?></strong></h5>
							<span style="font-size: 14px;">
								<?php  
                  if ($results['discount_price'] > 0) {?>
                      <strike>&#8358;<?=number_format($results['product_price'])?></strike>  
                        <span class="bg text-white p-1">-<?=number_format($results['discount_price'])?>%</span>
                      
                <?php }?>
							</span>
						</div>
						<hr>
						<div class="mb-3 dett">
							<strong>
								<span class="pe-1" style="font-size: 14px;">Seller:
									<?php  
										if ($results['type'] == "Admin") {?>
										
										<a href="/seller/<?=urlencode($results['biz_name'])?>">Sure Marts</a>
										<?php } else{ ?>
											<a href="/seller/<?=urlencode($results['biz_name'])?>"><?=$results['biz_name']?></a>
										<?php } ?>
								</span>
							</strong> |
							<strong><span class="pe-1 ps-1" style="font-size: 14px;">Stock: <?=$results['stock']?></span></strong> |
							<strong><span class="pe-1 ps-1" style="font-size: 14px;">Brand: <?=$results['brand']?></span></strong>
						</div>
						<p>
							<?=$format->textShorten($results['product_desc'], 100)?>
						</p>
						<hr>
						<form action="" method="post">
							<?php 
                  if(isset($addCart)){
                      echo $addCart;
                  }                                
              ?>
							<div class="qty-label">
	              Qty
	              <div class="input-number">
	                  <input type="number" name="product_qty" value="1">
	                  <span class="qty-up">+</span>
	                  <span class="qty-down">-</span>
	              </div>
	            </div>
							<button type="submit" class="btn btn-primary button" name="submit">ADD TO CART</button>
						</form>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>
	

	<div class="pro_desc">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12">
					<div class="title text-center">
						<h3>Product Description</h3>
						<div></div>
					</div>
				</div>
			</div>
			<div class="row">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<!-- <span class="mt-2 me-3">FILTERS <i class="fas fa-sliders-h"></i></span> -->
				  <li class="nav-item" role="presentation">
				    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link" id="maths-tab" data-bs-toggle="tab" data-bs-target="#maths" type="button" role="tab" aria-controls="maths" aria-selected="false">Review</button>
				  </li>
				</ul>

				<div class="tab-content" id="pills-tabContent">
					
					<div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="pills-home-tab">

			  		<div class="row mt-3">
							
			  			<div class="col-md-12">
								<?php 
			                        
				          $getProduct = $user->getSingleProduct($slug);
				          if($getProduct){
				            foreach($getProduct as $results){

				        ?>
								<div class="txt">
									<?=$results['product_desc']?>
								</div>
								<?php } } ?>
							</div>
						</div>
			  	</div>

			  	<div class="tab-pane fade show" id="maths" role="tabpanel" aria-labelledby="pills-home-tab">
			  		
			  		
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