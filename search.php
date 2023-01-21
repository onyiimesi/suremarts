<?php include "includes/header.php"; ?>

	<?php 
    
        if(!isset($_GET['search']) || $_GET['search'] == null){
            header("Location: /");
        }else{
            $search = $_GET['search'];
        }
    
    
    ?>


	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <li class="breadcrumb-item">Search Page</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>



	<section class="collections">
        <div class="container">
            
            <div class="row section mt-4">

                <?php 

                    $productBySearch = $user->productBySearch($search);
                    if($productBySearch){
                   
                    	foreach ($productBySearch as $results) {


                ?>
                <div class="col-6 col-md-2">
                    <div class="img">
                        <div class="image">
                            <a href="/product-detail/<?=$results['product_slug']?>">
                                <!-- <div class="content-overlay"></div> -->
                                <?php  
                                    if ($results['discount_price'] && $results['discount_price'] > 0) {?>
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
                                                $totalamount = $percentInDecimal * $price;

                                                $totalprice = $price - $totalamount;
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

                <?php if (empty($productBySearch)): ?>
                  	<div class="text-center">
                  		<i style="font-size: 40px;color: red;" class="fas fa-exclamation-triangle"></i>
                  		<h4 class="pt-3">Sorry Your Search Wasn't Found!</h4>
                  	</div>
                <?php endif ?>  
            </div>
           
        </div>
    </section><hr>









<?php include "includes/footer.php"; ?>