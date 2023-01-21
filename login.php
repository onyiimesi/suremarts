<?php include "includes/header.php"; ?>

	<?php 
    
        $login = Session::get("CusLogin");
        if($login == true){
            header("Location: /customer");
        }

    ?>

	<?php 
                
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

            $customerlogin = $user->customerLogin($_POST);
        }

    ?>


	<!-- <div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="#">Home</a></li>
					    <li class="breadcrumb-item"><a href="#">Additional Information</a></li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div> -->

	<div class="login pt-100">
		<div class="container">
			<form action="" method="post">
				<div class="row">
					<div class="col-md-6 mb-4">
						<div class="personal contact_bg shadow text-center">
							<h4>Login</h4>
							<?php 
                            
                                if(isset($customerlogin)){
                                    echo $customerlogin;
                                }
                            
                            ?>
							<form action="" method="post">
								
								<div class="mb-3">
									<input type="email" class="form-control" name="email" placeholder="Email Address">
								</div>

								<div class="mb-3">
									<input type="password" class="form-control" name="password" placeholder="Password">
								</div>

								<button type="submit" class="btn btn-primary button" name="login">LOGIN</button>
							</form>
							
						</div>
					</div>

					<div class="col-md-6 mb-4">
						<div class="personal contact_bg shadow">
							<h4>Create your SUREMARTS Account</h4>
							<?php 
                    
			                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){

			                        $registeruser = $user->customerRegistration($_POST);
			                    }
			                
			                ?>

			                <?php 
                            
                                if(isset($registeruser)){
                                    echo $registeruser;
                                }
                            
                            ?>
							<form action="" method="post">
								
								<div class="mb-3">
									<input type="text" class="form-control" name="fname" placeholder="First Name">
								</div>

								<div class="mb-3">
									<input type="text" class="form-control" name="lname" placeholder="Last Name">
								</div>

								<div class="mb-3">
									<input type="email" class="form-control" name="email" placeholder="Email Address">
								</div>

								<div class="mb-3">
									<input type="text" class="form-control" name="phone" placeholder="Phone Number">
								</div>

								<div class="mb-3">
									<input type="password" class="form-control" name="password" placeholder="Password">
								</div>

								<button type="submit" class="btn btn-primary button" name="register">SIGN UP</button>
							</form>

						</div>

					</div>
				</div>
			</form>
		</div>
	</div><hr>






<?php include "includes/footer.php"; ?>