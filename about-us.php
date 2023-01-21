<?php include "includes/header.php"; ?>

	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <li class="breadcrumb-item">About Us</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>


	<section class="about-us pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<?php 
                
            $getPro = $admin->getAbout();

            if($getPro){
              $i = 0;
              foreach ($getPro as $results) {
                $i++;

          ?>
					<div class="abt">
						<h3><?=$results['about_title']?></h3><hr>
						<p>
							<?=$results['about_desc']?>
						</p>
					</div>
					<?php } } ?>
				</div>
			</div>
		</div>	
	</section><hr>			







<?php include "includes/footer.php"; ?>