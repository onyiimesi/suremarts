<?php 

  include 'connect/Session.php';
  Session::init();

  include "admin/function.php";

  include 'connect/Database.php';
  $db = new Database();


?>
<?php
  
  $ref = $_GET['reference'];
  if ($ref == "") {
    header("Loction: javascript://history.go(-1)");
  }
?>

<?php

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_cc80fac6e46a9e8e8eed04c6e60536882869a6c8",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
    $result = json_decode($response);
  }
  if ($result->data->status == 'success') {

    $arr = array();

    $arr['status'] = $result->data->status;
    

    $arr['reference'] = $result->data->reference;
    

    $lname = $result->data->customer->last_name;

    $fname = $result->data->customer->first_name;

    $arr['fullname'] = $lname.' '.$fname;
    

    $arr['cusemail'] = $result->data->customer->email;
     

    date_default_timezone_set('Africa/Lagos');
    $arr['Date_time'] = date('Y-m-d H:i', time());
    

    $sid = session_id();

    $email = Session::get("UserEmail");

    $arr['order_no'] = rand(1000,999999);
    

    $query = "SELECT * FROM users WHERE email = '$email' ";
    $getInfo = $db->select($query);
    if($getInfo){
      foreach($getInfo as $result){
        $arr['phone'] = $result['phone'];
        $arr['address'] = $result['address'];
        $arr['city'] = $result['city'];
        $arr['state'] = $result['state'];
  
      }
    }


    $query = "SELECT * FROM cart WHERE s_id = '$sid' ";
    $getPro = $db->select($query);
    if($getPro){
      foreach($getPro as $result){
        $arr['user_email'] = $result['user_email'];
        $user_email = $arr['user_email'];

        $arr['product_name'] = $result['product_name'];
        $productname = $arr['product_name'];
        $arr['product_qty'] = $result['product_qty'];
        $product_qty = $arr['product_qty'];
        //$arr['product_price'] = $result['product_price'];
        $arr['product_image'] = $result['product_image'];


        $price = $result['product_price'];
        $percentToGet = $result['discount_price'];
        $percentInDecimal = $percentToGet / 100;
        $totalamount = $percentInDecimal * $price;

        $arr['totalprice'] = $price - $totalamount;

        //echo $user_email;


        $stmt = "INSERT INTO orders(order_no,user_email,product_name,product_qty,product_price,product_image,status,reference,fullname, date_purchased, email, phone, address, state, city) VALUES(:order_no, :user_email,:product_name,:product_qty,:totalprice,:product_image, :status, :reference, :fullname,:Date_time, :cusemail, :phone, :address, :state, :city)";
        $insert_row = $db->insert($stmt, $arr);

        $views = "UPDATE products SET views = views + 1 WHERE product_name = '$productname' ";
        $viewresult = $db->update($views);

        

      }

      if ($insert_row) {

        require "Mail/phpmailer/PHPMailerAutoload.php";


        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=465;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='ssl';

        $mail->Username='bradwick789@gmail.com';
        $mail->Password='12345@@456';

        $mail->setFrom('bradwick789@gmail.com', 'Order Placed');

        $query = "SELECT * FROM cart LEFT JOIN products ON products.user_email = cart.user_email WHERE s_id = '$sid' AND products.product_name = cart.product_name ";
        $getPro = $db->select($query);

        if($getPro){
          
          foreach($getPro as $result){

            $user_emails = $result['user_email'];
          
            $mail->addAddress($user_emails);
          }
        }
        

        $mail->isHTML(true);
        $mail->Subject="An Order Has Been Placed On Your Product";
        $mail->Body="<h3>Check your dashboard for more details. <br></h3>
        <br><br>
        <p>With regrads,</p>
        <b>SUREMARTS</b>
        ";
        
        


        if(!$mail->send()){
          ?>
              <script>
                  alert("<?php echo "Failed, Invalid Email"?>");
              </script>
          <?php
        }

        $sid = session_id();
        $query = "DELETE FROM cart WHERE s_id = '$sid' ";
        $db->delete($query);

        header("Location: payment-success/success&ref=".$arr['reference']);

      }else{
          
        echo 'There is an error'. mysqli_error($link);
        exit();
      }
    }





  }else{
    header("Location: error");
    exit();
  }


?>