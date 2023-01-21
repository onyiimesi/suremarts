<?php include "includes/header.php"; ?>

	<?php 
    
      $login = Session::get("CusLogin");
      if($login == false){
          header("Location: login");
      }

  	?>

	<div class="bread_crumb shadow-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb m-0 p-0">
					    <li class="breadcrumb-item"><a href="#">Home</a></li>
					    <li class="breadcrumb-item"><a href="#">Payment Successful</a></li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="success pt-100">
		<div class="container">
			<div class="row">
				<div class="col-md-12 s_bg">
					<div class="success_txt text-center">
						<i class="fas fa-check-circle"></i>
						<h3>PAYMENT SUCCESSFUL!!!</h3>
						<h6>Thanks for patronizing us. Order was successful, we will contact you shortly with delivery details.</h6>

						<?php 
                             
              $id = $_GET['ref'];

              $id= isset($id) ? $id: ''; 

					    $getPro = $user->getOrder($id);
					    if($getPro){
					        
					        foreach($getPro as $result){

							  $ref = $result['order_no'];
					        
					        }
					    }

					    $ref= isset($ref) ? $ref: '';

				  	?>
						<p style="color: #333;">
							<strong>Order No: <?=$ref?></strong>
						</p>

						<a href="/"><button class="btn btn-primary button" style="max-width: 200px;">Continue Shopping</button></a>
					</div>
				</div>
			</div>
		</div>
	</div><hr>




<?php include "includes/footer.php"; ?>