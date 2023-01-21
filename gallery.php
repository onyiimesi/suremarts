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
					    <li class="breadcrumb-item">Gallery</li>
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

	<section class="arts">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="arts_txt text-center">
						<?php 
                        
			                $getSellerInfo = $user->getSellerInfo($info);
			                if($getSellerInfo){
			                  foreach($getSellerInfo as $results){

			            ?>
						<h3><?=$results['biz_name']?> <br> Gallery</h3>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="collections other_products bg_coll">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="txt">
						<h3>Gallery</h3>
						<div></div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php 

	              $getPro = $user->getSellerGal($info);

	              if($getPro){
	                foreach ($getPro as $results) {
	                 
	            ?>
				<div class="col-6 col-md-2 mb-4 text-center">
					<div class="others gal shadow-sm border">
						<img src="/seller-dashboard/<?=$results['img']?>" class="img-fluid" alt="">
						<h5 style="font-size: 14px;padding: 20px;"><?=$results['img_name']?></h5>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>




<?php include "includes/footer.php"; ?>