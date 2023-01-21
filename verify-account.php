<?php include "includes/header.php"; ?>



	<?php 
  
	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])){

	    $verify = $user->userVerify($_POST);
	 }

	?>


	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
					    <li class="breadcrumb-item">Verify Account</li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="login pt-100">
		<div class="container">
			<form action="" method="post">
				<div class="row">
					<div class="col-md-6 mb-4 ms-auto me-auto">
						<div class="personal contact_bg shadow text-center">
							<h4>Verify Account</h4>
							<?php 
                            
                                if(isset($verify)){
                                    echo $verify;
                                }
                            
                            ?>
                            <?php  
	                
				                if(isset($_SESSION['message'])) {

				                	echo $_SESSION['message'];

				                	unset($_SESSION['message']);
				    
				                }

				            ?>
							<form action="" method="post">
								
								<div class="mb-3">
									<input type="text" class="form-control" name="otp_code" placeholder="OTP Code">
								</div>

								<button type="submit" class="btn btn-primary button" name="verify">VERIFY</button>
							</form>
							
						</div>
					</div>

				</div>
			</form>
		</div>
	</div><hr>






<?php include "includes/footer.php"; ?>