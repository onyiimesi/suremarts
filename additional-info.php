<?php include "includes/header.php"; ?>

	<?php 
    
        $login = Session::get("CusLogin");
        if($login == false){
            header("Location: login");
        }

    ?>

    <?php 

        $info = Session::get("UserEmail");

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['continue'])){

          $save = $user->customerdeteUpdate($_POST);
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
					    <li class="breadcrumb-item">Additional Information</li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="information pt-100">
		<div class="container">
			<?php 

              $info = Session::get("UserEmail");
        
              $getCustomerInfo = $user->getCustomerInfo($info);
              if($getCustomerInfo){
                foreach($getCustomerInfo as $results){

            ?>
			<form action="" method="post">
				<div class="row">
					<div class="col-md-4 mb-4">
						<div class="personal contact_bg">
							<h4>Contact Information</h4>
							<hr>
							
							<div class="mb-3">
								<input type="text" class="form-control" name="fname" value="<?=$results['fname']?>" placeholder="First Name">
							</div>

							<div class="mb-3">
								<input type="text" class="form-control" name="lname" value="<?=$results['lname']?>" placeholder="Last Name">
							</div>

							<div class="mb-3">
								<input type="email" class="form-control" name="email" value="<?=$results['email']?>" placeholder="Email Address">
							</div>

							<div class="mb-3">
								<input type="text" class="form-control" name="phone" value="<?=$results['phone']?>" placeholder="Phone Number">
							</div>
							
						</div>
					</div>

					<div class="col-md-8 mb-4">
						<div class="personal contact_bg">
							<h4>Contact Address</h4>
							<hr>

							<div class="mb-3">
								<input type="text" class="form-control" name="address" value="<?=$results['address']?>" placeholder="Address">
							</div>

							<div class="mb-3">
								<input type="text" class="form-control" name="city" value="<?=$results['city']?>" placeholder="City">
							</div>

							<div class="mb-3">
								<input type="text" class="form-control" name="state" value="<?=$results['state']?>" placeholder="State">
							</div>
						</div>
					</div>					
				</div>

				<div class="row mt-3 contact_bg">
					<div class="col-md-4">
						<div class="bt">
							<button type="submit" class="btn btn-primary button" name="continue">Continue</button>
						</div>
					</div>
				</div>
			</form>
			<?php } } ?>
		</div>
	</div><hr>






<?php include "includes/footer.php"; ?>