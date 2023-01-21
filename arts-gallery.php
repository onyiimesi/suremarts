<?php include "includes/header.php"; ?>


	<section class="arts">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="arts_txt text-center">
						<h3>Conceptual Art <br>& <br>Drawings</h3>
						<!-- <p style="color: #fff !important;">
							Conceptual art is art for which the idea (or concept) behind the work is more important than the finished art object.
						</p> -->
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="concept_art">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="offer_txt">
						<h3>Our Artists</h3>
						<div></div>
					</div>
				</div>
			</div>

			<div class="row text-center mt-5 mb-5">

				<?php 
                
                  $getSeller = $admin->getAllSellersArt();

                  if($getSeller){
                    foreach ($getSeller as $results) {

                    	if ($results['seller_cat'] == "Arts") {
                    		// code...
                    	
 
                ?>
				<div class="col-6 col-md-3 mb-4">
					<a href="/gallery/<?= $results['biz_slug'] ?>">
					<div class="offers shadow-sm border">
						<img src="/admin/<?= $results['seller_image'] ?>" class="img-fluid" alt="">
						<h3><strong><?= $results['biz_name'] ?></strong></h3>
						<p>
							<?= $results['description'] ?>
						</p>
					</div>
					</a>
				</div>
				

				<?php } } } ?>
			</div>

		</div>
	</section><hr>











<?php include "includes/footer.php"; ?>