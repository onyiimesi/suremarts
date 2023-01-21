<?php include "includes/header.php"; ?>
    
    <button id="scrollToTopButton" onclick="scrollToTop(300,3)" title="Scroll to Top">
        <i class="lnr lnr-chevron-up"></i>
    </button>

    <!-- Image Carousel -->


    <section class="image-carousel">
        <div class="container">
            <div class="row sliders">
                <?php 
                    $getPro = $admin->getSlider();

                    if($getPro){

                        $i = 0;
                        foreach($getPro as $slider) {  

                        ?> 
                <div class="col-md-12">
                    
                    <a href="<?=$slider['slider_title'] ?>"><div class="slide_img">
                        <img src="/admin/<?=$slider['slider_img'] ?>" class="img-fluid d-block w-100">
                    </div></a>
                    
                </div>
                <?php $i++; } } ?>
            </div>
        </div>
    </section>

    
    <!-- End -->

    <div class="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div>
                        <h4>Shop From Our Top Categories</h4>
                        <div class="line mb-2"></div>
                    </div> -->
                    <div class="img_slide shadow-sm">                       
                        <?php 
                
                          $getCat = $admin->getAllCat();

                          if($getCat){
                            $i = 0;
                            foreach ($getCat as $results) {
                              $i++;
         
                        ?>
                        <a href="/category/<?=urlencode($results['cat_name'])?>"><div>

                            <?php  
                                
                                if (file_exists($results['cat_img'])) {

                                   $img = "/img/category.jpg";

                                }else{

                                    $img = "admin/".$results["cat_img"];
                                }

                            ?>

                            <img src="<?=$img?>" class="img-fluid" alt="">
                            <h6 style="font-weight: bold;" class="text-center"><?=$format->esc($results['cat_name'])?><h6>
                        </div></a>
                      <?php } } ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <section class="topdeals">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top">
                        <div class="top_txt">
                            <h4 class="float-start">Top Deals | Shoes</h4>
                            <a href="/shop" class="float-end">See All <i class="fas fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>

                        <div class="top_items shadow-sm text-center">
                            <div class="row">
                                
                                <div class="col-md-12">

                                    <div class="image">
                                        <?php 
            
                                          $getPro = $admin->getDealsShoes($limit = 12);

                                          if($getPro){
                                           
                                            foreach ($getPro as $results) {
                                             
                         
                                        ?>
                                        <a href="/product-detail/<?=$results['product_slug']?>"><div class="items mt-3 mb-4 me-3 ms-0">
                                            <?php  
                                            if ($results['discount_price'] > 0) {?>
                                                <div class="new-badge">
                                                    <span><?=-$results['discount_price']?>%</span>
                                                </div>
                                            <?php }?>
                                            <img src="/admin/<?=$format->esc($results['product_image'])?>" class="img-fluid" alt="">
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
                                        </div></a>
                                        <?php } } ?> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sellers">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top">
                        <div class="top_txt">
                            <h4 class="text-center">Shop From Our Sellers!</h4>
                            
                        </div>

                        <div class="top_items shadow-sm">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <div class="image">
                                       <a href="">
                                            <div class="seller_img">
                                               <img src="/img/sellers/oma.jpg" class="img-fluid" alt="">

                                            </div>
                                        </a>  

                                        <a href="">
                                            <div class="seller_img">
                                                <img src="/img/sellers/kwueton.jpg" class="img-fluid" alt="">
                                            </div>
                                        </a>

                                        <a href="">
                                            <div class="seller_img">
                                                <img src="/img/sellers/sleek.jpg" class="img-fluid" alt="">
                                            </div>
                                        </a>

                                        <a href="">
                                            <div class="seller_img">
                                                <img src="/img/sellers/vicky.jpg" class="img-fluid" alt="">
                                            </div>
                                        </a>
                                    </div>
                                   
                                </div>

                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="topdeals">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top">
                        <div class="top_txt">
                            <h4 class="float-start">Top Deals | Skin Care</h4>
                            <a href="/shop" class="float-end">See All <i class="fas fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>

                        <div class="top_items shadow-sm text-center">
                            <div class="row">
                                
                                <div class="col-md-12">

                                    <div class="image">
                                        <?php 
            
                                          $getPro = $admin->getDealsShoes($limit = 12);

                                          if($getPro){
                                           
                                            foreach ($getPro as $results) {
                                             
                         
                                        ?>
                                        <a href="/product-detail/<?=$results['product_slug']?>"><div class="items mt-3 mb-4 me-3 ms-0">
                                            <?php  
                                            if ($results['discount_price'] > 0) {?>
                                                <div class="new-badge">
                                                    <span><?=-$results['discount_price']?>%</span>
                                                </div>
                                            <?php }?>
                                            <img src="/admin/<?=$format->esc($results['product_image'])?>" class="img-fluid" alt="">
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
                                        </div></a>
                                        <?php } } ?> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <section class="ads">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="txt text-center">
                        <h5>Don't Miss Out On These!!!</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
            
                  $getPro = $admin->getAds($limit = 4);

                  if($getPro){
                   
                    foreach ($getPro as $results) {
                     
 
                ?>
                <div class="col-6 col-md-6 mb-4">
                    <a href="<?=$results['ads_link']?>"><div class="adverts shadow-sm">
                        <img src="/admin/<?=$results['ads_image']?>" class="img-fluid" alt="">
                    </div></a>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    <!-- End -->

    <section class="topdeals">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top">
                        <div class="top_txt">
                            <h4 class="float-start">Top Deals</h4>
                            <a href="/shop" class="float-end">See All <i class="fas fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>

                        <div class="top_items shadow-sm text-center">
                            <div class="row">
                                
                                <div class="col-md-12">

                                    <div class="image">
                                        <?php 
            
                                          $getPro = $admin->getDeals($limit = 12);

                                          if($getPro){
                                           
                                            foreach ($getPro as $results) {
                                             
                         
                                        ?>
                                        <a href="/product-detail/<?=$results['product_slug']?>"><div class="items mt-3 mb-4 me-3 ms-0">
                                            <?php  
                                            if ($results['discount_price'] > 0) {?>
                                                <div class="new-badge">
                                                    <span><?=-$results['discount_price']?>%</span>
                                                </div>
                                            <?php }?>
                                            <img src="/admin/<?=$format->esc($results['product_image'])?>" class="img-fluid" alt="">
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
                                        </div></a>
                                        <?php } } ?> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ads">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="txt text-center">
                        <h5>Services Rendered</h5>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <a href="/travel">
                        <div class="service_render">
                            <div class="sss">
                                <i class="mdi mdi-airplane"></i>
                                <h4>Travel Agency</h4> 
                            </div>
                        </div>
                    </a> 
                </div>

                <div class="col-md-6 mb-4">
                    <a href="/kwueton-services">
                        <div class="service_render">
                            <div class="sss">
                                <i class="mdi mdi-air-conditioner"></i>
                                <h4>Service & Maintenance</h4> 
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->


    <section class="topdeals">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top">
                        <div class="top_txt">
                            <h4 class="float-start">Top Deals | Clothes</h4>
                            <a href="/shop" class="float-end">See All <i class="fas fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>

                        <div class="top_items shadow-sm text-center">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="image">
                                        <?php 
            
                                          $getPro = $admin->getItems($limit = 12);

                                          if($getPro){
                                           
                                            foreach ($getPro as $results) {
                                             
                         
                                        ?>
                                        <a href="/product-detail/<?=$results['product_slug']?>"><div class="items mt-3 mb-4 me-3 ms-0">
                                            <?php  
                                            if ($results['discount_price'] > 0) {?>
                                                <div class="new-badge">
                                                    <span><?=-$results['discount_price']?>%</span>
                                                </div>
                                            <?php }?>
                                            <img src="/admin/<?=$format->esc($results['product_image'])?>" class="img-fluid" alt="">
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
                                        </div></a>
                                        <?php } } ?> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><hr>


<?php include "includes/footer.php"; ?>