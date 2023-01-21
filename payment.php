<?php include "includes/header.php"; ?>

	<?php 
    
      $login = Session::get("CusLogin");
      if($login == false){
          header("Location: login");
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
					    <li class="breadcrumb-item">Payment Page</li>
					    
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

  <?php 
    $info = Session::get("UserEmail");

    $getCustomerInfo = $user->getCustomerInfo($info);
    if($getCustomerInfo){
      foreach($getCustomerInfo as $results){
        $city = $results['state'];
      }
    }
  ?>

	<?php 
                                    
    $getPro = $user->getCartProduct();
    if($getPro){
      $sum = 0;
      foreach($getPro as $result){

				$price = $result['product_price'];
        $percentToGet = $result['discount_price'];
        $percentInDecimal = $percentToGet / 100;
        $amount = $percentInDecimal * $price;

        $totalprice = $price - $amount;

        $sum = $sum + $totalprice;
      }
    }

    $paystackPercent = 1.5;
    $paystackInDecimal = $paystackPercent / 100;
    
    $total = ($paystackInDecimal * $sum) + 100;

  ?>
  <?php 
    $sums = $sum + $total;
    $sums = number_format($sums,0, '.', '');

   ?>
	<div class="payment pt-100">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="pay">
						<form id="paymentForm" method="post">
              <div class="form-group">
                <!-- <label for="last-name">Email Address</label> -->
                <input type="email"class="form-control mb-4 p-3" placeholder="Email Address" id="email-address" required />
              </div>
              <div class="form-group">
                <!-- <label for="amount">Amount</label> -->
                <input type="text"class="form-control mb-4 p-3" id="amount" readonly value="<?=$sums?>" required />
              </div>
              <div class="form-group">
                <!-- <label for="first-name">First Name</label> -->
                <input type="text"class="form-control mb-4 p-3" id="first-name" placeholder="First Name" />
              </div>
              <div class="form-group">
                <!-- <label for="last-name">Last Name</label> -->
                <input type="text"class="form-control mb-4 p-3" id="last-name" placeholder="Last Name" />
              </div>
              <div class="form-submit">
                <button type="submit" class="btn btn-primary button" onclick="payWithPaystack()"> Pay </button>
              </div>
            </form>

            
            <script src="https://js.paystack.co/v1/inline.js"></script>
					</div>
				</div>
			</div>
		</div>
	</div><hr>








<?php include "includes/footer.php"; ?>
