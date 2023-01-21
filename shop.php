<?php include "includes/header.php"; ?>

	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <li class="breadcrumb-item">Shop With Us</li>
					  </ol>
					</nav>
									</div>
			</div>
		</div>
	</div>


	<section class="shop">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="shop_category">
						<h4>Category</h4><hr>
						<?php 
                
              $getCat = $admin->getAllCat();

              if($getCat){
                $i = 0;
                foreach ($getCat as $results) {
                  $i++;

            ?>
						<a href="/category/<?=urlencode($results['cat_name'])?>"><div class="">

               <h6 style="font-weight: bold;"><?=$format->esc($results['cat_name'])?><h6>
            </div></a>
						<?php } } ?>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row sho">
            
            <?php 
    
              $getPro = $admin->getAllPro();

              if($getPro){
               
                foreach ($getPro as $results) {
                 

            ?>
            <div class="col-6 col-md-3 text-center mb-4">
                <div class="img">
                    <div class="image">
                        <a href="/product-detail/<?=$results['product_slug']?>">
                            <!-- <div class="content-overlay"></div> -->
                            <?php  
                                if ($results['discount_price'] > 0) {?>
                                    <div class="new-badge">
                                        <span><?=-$results['discount_price']?>%</span>
                                    </div>
                                <?php }?>
                            
                            <img src="/admin/<?=$format->esc($results['product_image'])?>" alt="">

                            <div class="content-details">
                                <h4 class="content-title"><?=str_replace(array( '//','\\','\'', '"',',' , ';', '<', '>' ), ' ',$results['product_name'])?></h4>
                                	<?php  
                                      if($results['type'] == "Admin"): ?>
                                          <span class="locator"><i class="fas fa-map-marker-alt"></i> <?=$format->textShorten('Surulere, Lagos, Nigeria', 13)?></span><br>

                                  <?php elseif($results['type'] == "Seller"): ?>
                                      <span class="locator"><i class="fas fa-map-marker-alt"></i> <?=$format->textShorten($results['address'], 13)?></span><br>

                                  <?php endif; ?>
                                    <span>
                                        <?php  

                                              $price = $results['product_price'];
                                              $percentToGet = $results['discount_price'];
                                              $percentInDecimal = $percentToGet / 100;
                                              $amount = $percentInDecimal * $price;

                                              $totalprice = $price - $amount;

                                          ?>
                                          &#8358;<?=number_format($totalprice)?>
                    
                                    </span>
                                    <?php  
                                        if ($results['discount_price'] && $results['discount_price'] > 0) {?>
                                            <strike>&#8358;<?=number_format($results['product_price'])?></strike>
                                        <?php }
                                    ?>
                                
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php } } ?>     
        </div>
				</div>
			</div>
		</div>
	</section>







<?php include "includes/footer.php"; ?>