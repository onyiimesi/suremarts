<?php

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../connect/Database.php');
include_once ($filepath.'/../lib/format.php');


class Admin{

	private $con;
	private $format;

	public function __construct(){
   		$this->con = new Database();
   		$this->format = new Format();
	}

	public function createSeller($data){

		$arr = array();
		$arr['fname'] = addslashes($data['fname']);
		$fname = $arr['fname'];

		$arr['lname'] = addslashes($data['lname']);
		$lname = $arr['lname'];

		$arr['email'] = addslashes($data['email']);
		$email = $arr['email'];

		$arr['biz_name'] = addslashes($data['biz_name']);
		$biz_name = $arr['biz_name'];

		$arr['catname'] = addslashes($data['seller_cat']);

		$arr['subcat'] = addslashes($data['seller_sub_cat']);

		$arr['phone'] = addslashes($data['phone_number']);

		$arr['address'] = addslashes($data['address']);

		$arr['acct_number'] = addslashes($data['acct_num']);

		$arr['acctname'] = addslashes($data['acct_name']);

		$arr['bankname'] = addslashes($data['bank_name']);

		$arr['selltype'] = addslashes($data['seller_type']);

		$arr['splitcode'] = addslashes($data['split_code']);
		$arr['codes'] = addslashes($data['code']);

		$rawdate = htmlentities($data['sub_end']);
  		$arr['subend'] = date('Y-m-d H:i:s', strtotime($rawdate));

  		$ends = $arr['subend'];
  		$subend = date('F jS, Y', strtotime($ends));
  		


		$arr['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		$password = $data['password'];

		//|| $arr['splitcode'] == "" || $arr['codes'] == "" ||


		// Check for empty fields
		if ($arr['fname'] == "" || $arr['lname'] == "" || $arr['email'] == "" || $arr['biz_name'] == "" || $arr['catname'] == "" || $arr['subcat'] == "" || $arr['selltype'] == "" || $data['sub_end'] == "" || $arr['password'] == "" || $arr['phone'] == "" || $arr['address'] == "" || $arr['acct_number'] == "" || $arr['acctname'] == "" || $arr['bankname'] == ""){
			return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Field cannot be empty</div>";
		}

		// Check for firstname
        if (empty($arr['fname']) || !preg_match('/^[a-zA-Z]+$/', $arr['fname'])) {
            
            return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Only letters allowed in first name</div>";

        }

        // Check for lastname
        if (empty($arr['lname']) || !preg_match('/^[a-zA-Z]+$/', $arr['lname'])) {
            
            return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Only letters allowed in last name</div>";

        }

        // Check for email
        if (empty($arr['email']) || !filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
            
            return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Email is not valid</div>";

        }



        // Check if Email Exists
        $mailquery = "SELECT * FROM sellers WHERE email = '$email' LIMIT 1 ";
        $mailcheck = $this->con->select($mailquery);
        if($mailcheck != false){
            return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Seller already exist!</div>";
        }

        // Check if Business Name Exists
        $bizquery = "SELECT * FROM sellers WHERE biz_name = '$biz_name' LIMIT 1 ";
        $bizcheck = $this->con->select($bizquery);
        if($mailcheck != false){
            return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Business Name Already Exist!</div>";
        }


        if(isset($data['password'])){
            // Check for password
            if (empty($data['password'])) {
                
                return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Password field can't be empty!</div>";

            }

            if (strlen($data['password']) < 8 ) {
                
                return "<div class='alert alert-danger text-white' style='font-size: 15px;'>Password must be 8 characters long</div>";

            }


        }


		$query = "INSERT INTO sellers (fname,lname,email,biz_name,seller_cat,seller_sub_cat,phone_number,address,seller_type,split_code,code,acct_num,acct_name,bank_name,sub_end,password) VALUES(:fname,:lname,:email,:biz_name,:catname,:subcat,:phone,:address,:selltype,:splitcode,:codes,:acct_number,:acctname,:bankname,:subend,:password)";
		$insert_row = $this->con->insert($query,$arr);


		if ($insert_row) {

			require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=465;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='ssl';

            $mail->Username='bradwick789@gmail.com';
            $mail->Password='12345@@456';

            $mail->setFrom('bradwick789@gmail.com', 'Account Creation');
            $mail->addAddress($data["email"]);

            $mail->isHTML(true);
            $mail->Subject="Your Account Has Been Created.";
            $mail->Body="<!DOCTYPE html>
		        <html lang='en'>
		        <head>
		            <meta charset='UTF-8'>
		            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
		            <title>Verify Email</title>

		            <style>

		            	.header{
		            		background: #16a9d6;
		            		padding: 8px;
		            	}
		            	.header h3{
		            		color: #fff;
		            		text-align: center;
		            	}

		            	.wrapper{
		            		background: #f5f5f5;
		            		padding: 50px 20px;
		            		border-radius: 5px;
		            	}

		            	.footer{
		            		background: #16a9d6;
		            		padding: 10px;
		            	}
		            	.footer a{
		            		color: #fff;
		            		text-align: center;
		            		font-size: 15px;
		            		text-decoration: none;
		            	}

		            </style>
		        </head>
		        <body>
		        	<div class='header'>
		        		<h3>SUREMARTS</h3>
		              
		            </div>

		            <div class='wrapper'>
	                	<h3>Dear $fname,</h3>
	            		<h4>
	            			Here is your login details
	            		</h4>
	            		<p>
	            			<b>Email:</b> $email <br>
	            			<b>Password:</b> $password
	            		</p>
	            		<h4><b>Your Subscription ends in $subend.</b> </h4>
	            		<br>
	            		<a href='https://suremarts.com/seller-dashboard/sign-in' style='text-decoration: none; width: 100px;height:auto;padding: 10px;background: #16a9d6;color: white;border-radius: 5px;'>Login Now</a>
	            		<br>

	            		<p>Please ensure you fill in your profile information.</p>
	            		<h4>Note: Change your password once you login to your dashboard.</h4>
	            		<h4>Note: Please do not share this with anyone.</h4>
            		
	            	</div>

	            	<div class='footer'>
		             <a href='https://suremarts.com'>www.suremarts.com</a>
		            </div>
		        </body>
		        </html>
            ";

            if(!$mail->send()){
                return "<div class='alert alert-danger text-white'>Error</div>";
            }else{
                return "<div class='alert alert-success text-white'>Seller Added Successfully!</div>";
            }

		}else{
			return "<div class='alert alert-danger text-white'>Error</div>";
		}

	}

	public function getAllSellers(){

		$query = "SELECT * FROM sellers ";
		return $this->con->select($query);

	}

	public function getAllSellersArt(){

		$query = "SELECT * FROM sellers ";
		return $this->con->select($query);

	}

	public function getAllUsers(){

		$query = "SELECT * FROM users ";
		return $this->con->select($query);

	}

	public function numRowSellers(){
        $query = "SELECT count(seller_id) as total FROM sellers WHERE status = 'active' ";
        $mysellers = $this->con->select($query);
		
        if($mysellers){
            $totalsellers = $mysellers[0]['total'];
            echo $totalsellers;
        }elseif (empty($mysellers)) {
            echo 0;
        }           
                           
    }

    public function numRowUsers(){
        $query = "SELECT count(user_id) as total FROM users ";
        $myusers = $this->con->select($query);
		
        if($myusers){
            $totalusers = $myusers[0]['total'];
            echo $totalusers;
        }elseif (empty($myusers)) {
            echo 0;
        }           
                           
    }

    public function numRowAdminOrders($email){

		$arr = array();
		$arr['email'] = $email;

        $query = "SELECT count(order_id) as total FROM orders WHERE user_email = :email AND delivery_status != 'Delivered' AND delivery_status != 'Order Cancelled' ";
        $myorders = $this->con->select($query,$arr);
		
        if($myorders){
            $totalproducts = $myorders[0]['total'];
            echo $totalproducts;
        }elseif (empty($myorders)) {
            echo 0;
        }           
                           
    }

    public function numRowAdminSales($email){

		$arr = array();
		$arr['email'] = $email;

        $query = "SELECT sum(product_price) as product_price FROM orders WHERE user_email = :email AND delivery_status = 'Delivered' ";
        $myproducts = $this->con->select($query,$arr);
		
        if($myproducts){
            $totalproducts = $myproducts[0]['product_price'];
            echo number_format($totalproducts);
        }elseif (empty($myproducts)) {
            echo 0;
        }           
                           
    }

    public function numRowAdminSalesToday($email,$date){

		$arr = array();

		$arr['email'] = $email; 

		$arr['dates'] = $date; 

        $query = "SELECT delivery_date, sum(product_price) as product_price FROM orders WHERE user_email = :email AND delivery_date >= :dates ";
        $myproducts = $this->con->select($query, $arr);
		
        if($myproducts){
            $totalproducts = $myproducts[0]['product_price'];
            echo number_format($totalproducts);
        }elseif (empty($myproducts)) {
            echo 0;
        }           
                           
    }


	public function addCategory($data, $file){

		$arr = array();
		$arr['cat_name'] = addslashes($data['cat_name']);
		$arr['catslug'] = slug($arr['cat_name']);
		$catname = $arr['cat_name'];
		$arr['user_email'] = Session::get("sup_email");

		$permit = array('jpg','jpeg','png');
        $file_name = $file['cat_img']['name'];
        $file_size = $file['cat_img']['size'];
        $file_temp = $file['cat_img']['tmp_name'];

        $sourceProperties = getimagesize($file_temp);

        $folder = "catimage/";

        if(!file_exists($folder)) {
        	mkdir($folder, 0777, true);
        }

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $arr['cat_img'] = $folder . substr(md5(time()), 0, 10).'.'.$file_ext;

        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($file_temp); 
                $imageLayer = $this->format->resizeCat($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$arr['cat_img']);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($file_temp); 
                $imageLayer = $this->format->resizeCat($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$arr['cat_img']);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($file_temp); 
                $imageLayer = $this->format->resizeCat($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$arr['cat_img']);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }

        if($file_size > 5054589){
        return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Image size should be less than 1MB.</div>";
        }

		if ($arr['cat_name'] == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}

		if(in_array($file_ext, $permit) === false){
            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>You can upload only ".implode(', ', $permit)."</div>";
        }



		$cat = "SELECT * FROM category WHERE cat_name = '$catname' LIMIT 1 ";
		$query = $this->con->select($cat);
		if ($query) {

			return "<div class='alert alert-danger text-white'>Category Already Exist!!!</div>";

		}else{

			move_uploaded_file($file_ext, $arr['cat_img']);
			$query = "INSERT INTO category (user_email, cat_name, cat_slug, cat_img) VALUES(:user_email, :cat_name, :catslug, :cat_img)";
			$insert_row = $this->con->insert($query,$arr);


			if ($insert_row) {
				return "<div class='alert alert-success text-white'>Created Successfully!</div>";

			}else{
				return "<div class='alert alert-danger text-white'>Error</div>";
			}
		}

	}

	public function createSubCat($data){
		$arr = array();
		$arr['cat_name'] = addslashes($data['cat_name']);

		$arr['subcat_name'] = addslashes($data['subcat_name']);

		$catname = $arr['cat_name'];
		$subcatname = $arr['subcat_name'];

		$arr['user_email'] = Session::get("sup_email");


        if(empty($data)){
            return "<div class='alert alert-danger'>Field cannot be empty</div>";
           
        }

        $cat = "SELECT * FROM subcategory WHERE subcat_name = '$subcatname' LIMIT 1 ";
		$query = $this->con->select($cat);
		if ($query) {


			return "<div class='alert alert-danger text-white'>Sub-Category Already Exist!!!</div>";


		}else{
            $query = "INSERT INTO subcategory(user_email,cat_name,subcat_name) VALUES (:user_email,:cat_name,:subcat_name)";
            $catInsert = $this->con->insert($query,$arr);
            if($catInsert){
                return "<div class='alert alert-success text-white' style='font-size: 14px;'>Sub-Category Inserted Successfully.</div>";
                
            }else{
                return "<div class='alert alert-danger text-white'>Error inserting subcategory.</div>";
               
            }

        }

    }

    public function getAllCat(){

		$query = "SELECT * FROM category ";
		return $this->con->select($query);

	}

	public function getAllSubCats($cat){

		$query = "SELECT * FROM subcategory WHERE cat_name = '$cat' ";
		return $this->con->select($query);

	}

	public function getAllSubCat(){

		$query = "SELECT * FROM subcategory ";
		return $this->con->select($query);

	}

	public function getAllCatByEmail($email){

		$arr = array();
		$arr['email'] = $email;

		$query = "SELECT * FROM category WHERE user_email = :email ";
		return $this->con->select($query,$arr);

	}

	public function delCat($id){

    	$arr = array();
    	$arr['id'] = $id;
    	

        $delquery = "DELETE FROM category WHERE cat_id = :id LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Category Deleted Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Category not Deleted.</div>";
        } 
    }


	public function adminAddProduct($data, $file){

		$arr = array();

		$arr['email'] = Session::get("sup_email");
		$email = $arr['email'];

		$arr['productname'] = addslashes($data['product_name']);
		$arr['productslug'] = slug($arr['productname']);
		$arr['catname'] = addslashes($data['cat_name']);
		$arr['productsize'] = addslashes($data['product_size']);
		$arr['productcolor'] = addslashes($data['product_color']);
		$arr['productdesc'] = addslashes($data['product_desc']);
		$arr['productprice'] = addslashes($data['product_price']);
		$arr['discount'] = addslashes($data['discount_price']);
		$arr['productqty'] = addslashes($data['product_qty']);
		$arr['type'] = "Admin";
		

		$permit = array('jpg','jpeg','png','gif');
        $file_name = $file['product_image']['name'];
        $file_size = $file['product_image']['size'];
        $file_temp = $file['product_image']['tmp_name'];

        // Check for empty fields
		if ($arr['productname'] == "" || $arr['catname'] == "" || $arr['productsize'] == "" || $arr['productcolor'] == "" || $arr['productdesc'] == "" || $arr['productprice'] == "" || $arr['discount'] == "" || $arr['productqty'] == "" || $file_name == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}

        $sourceProperties = getimagesize($file_temp);

        $folder = "upload/$email/";

        if(!file_exists($folder)) {
        	mkdir($folder, 0777, true);
        }

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $arr['unique_image'] = $folder . substr(md5(time()), 0, 10).'.'.$file_ext;
        

        
        
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($file_temp); 
                $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"400");
                imagejpeg($imageLayer,$arr['unique_image']);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($file_temp); 
                $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"400");
                imagegif($imageLayer,$arr['unique_image']);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($file_temp); 
                $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"400");
                imagepng($imageLayer,$arr['unique_image']);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }


        if($file_size > 5054589){
        	return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Image size should be less than 1MB.</div>";
        }

        if(in_array($file_ext, $permit) === false){
            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>You can upload only ".implode(', ', $permit)."</div>";
        }else{

        	move_uploaded_file($file_ext, $arr['unique_image']);
            $query = "INSERT INTO products(user_email,product_name,product_slug,cat_name,product_size,discount_price,product_color,product_desc,product_price,product_image,product_qty,type) 
            VALUES(:email, :productname, :productslug, :catname, :productsize, :discount, :productcolor, :productdesc,:productprice, :unique_image, :productqty, :type) ";

            $insert_row = $this->con->insert($query,$arr);
            if($insert_row){
                return "<div class='alert alert-success text-white'>Product inserted successfully.</div>";
               
            }else{
                return "<div class='alert alert-danger text-white'>Error inserting product.</div>";
                
            }

        }	

	}

	public function addSlider($data, $file){

		$arr = array();

		$arr['email'] = Session::get("sup_email");

		$arr['slidertitle'] = addslashes($data['slider_title']);

		$permit = array('jpg','jpeg','png','gif');

        $file_name = $file['slider_img']['name'];
        $file_size = $file['slider_img']['size'];
        $file_temp = $file['slider_img']['tmp_name'];

        // Check for empty fields
		if ($arr['slidertitle'] == "" || $file_name == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}

		$sourceProperties = getimagesize($file_temp);

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $arr['slider_image'] = "slider/".$unique_image;
        
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($file_temp); 
                $imageLayer = $this->format->resizeBannerImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$arr['slider_image']);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($file_temp); 
                $imageLayer = $this->format->resizeBannerImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$arr['slider_image']);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($file_temp); 
                $imageLayer = $this->format->resizeBannerImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$arr['slider_image']);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }

        if($file_size > 5054589){
        echo "<div class='alert alert-danger'>Image size should be less than 1MB.</div>";
        }

        if(in_array($file_ext, $permit) === false){
            echo "<div class='alert alert-danger'>You can upload only".implode(',', $permit)."</div>";
        }else{

        	move_uploaded_file($file_ext, $arr['slider_image']);

            $query = "INSERT INTO slider(email,slider_title,slider_img) 
            VALUES(:email, :slidertitle, :slider_image) ";

            $insert_row = $this->con->insert($query,$arr);
            if($insert_row){
                return "<div class='alert alert-success text-white'>Slider Inserted Successfully.</div>";
               
            }else{
                return "<div class='alert alert-danger text-white'>Error inserting slider.</div>";
                
            }

        }

	}

	public function addAdvert($data, $file){

		$arr = array();

		$arr['email'] = Session::get("sup_email");

		$arr['adslink'] = addslashes($data['ads_link']);

		$permit = array('jpg','jpeg','png','gif');

        $file_name = $file['ads_image']['name'];
        $file_size = $file['ads_image']['size'];
        $file_temp = $file['ads_image']['tmp_name'];

        // Check for empty fields
		if ($arr['adslink'] == "" || $file_name == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}

		$sourceProperties = getimagesize($file_temp);

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $arr['ads_image'] = "advert/".$unique_image;
        
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($file_temp); 
                $imageLayer = $this->format->resizeAdsImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$arr['ads_image']);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($file_temp); 
                $imageLayer = $this->format->resizeAdsImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$arr['ads_image']);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($file_temp); 
                $imageLayer = $this->format->resizeAdsImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$arr['ads_image']);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }

        if($file_size > 5054589){
        echo "<div class='alert alert-danger'>Image size should be less than 1MB.</div>";
        }

        if(in_array($file_ext, $permit) === false){
            echo "<div class='alert alert-danger'>You can upload only".implode(',', $permit)."</div>";
        }else{

        	move_uploaded_file($file_ext, $arr['ads_image']);

            $query = "INSERT INTO adverts(user_email,ads_link,ads_image) 
            VALUES(:email, :adslink, :ads_image) ";

            $insert_row = $this->con->insert($query,$arr);
            if($insert_row){
                return "<div class='alert alert-success text-white'>Advert Inserted Successfully.</div>";
               
            }else{
                return "<div class='alert alert-danger text-white'>Error Inserting Advert.</div>";
                
            }

        }

	}

	public function getSlider(){

		$query = "SELECT * FROM slider ";
		return $this->con->select($query);

	}

	public function getAds($limit){

		$query = "SELECT * FROM adverts ORDER BY ads_id DESC LIMIT $limit ";
		return $this->con->select($query);

	}

	public function delImage($id){

    	$arr = array();
    	$arr['ids'] = $id;

        $query = "SELECT * FROM slider WHERE slider_id = :ids ";
        $getData = $this->con->select($query,$arr);
        if($getData){
            foreach($getData as $delImg){
                unlink($delImg['slider_img']);
            }
                
        }
    	

        $delquery = "DELETE FROM slider WHERE slider_id = :ids LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Image deleted successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Image not deleted.</div>";
        } 
    }

    public function delAdsImage($id){

    	$arr = array();
    	$arr['ids'] = $id;

        $query = "SELECT * FROM adverts WHERE ads_id = :ids ";
        $getData = $this->con->select($query,$arr);
        if($getData){
            foreach($getData as $delImg){
                unlink($delImg['ads_image']);
            }
                
        }
    	

        $delquery = "DELETE FROM adverts WHERE ads_id = :ids LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Advert deleted successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Advert not deleted.</div>";
        } 
    }

	public function getAllProducts(){
		$query = "SELECT * FROM products WHERE type = 'Admin' ORDER BY product_id DESC ";
		return $this->con->select($query);
	}

	public function getAllPro(){

		$query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND product_qty != 0 ORDER BY rand() ";
		return $this->con->select($query);
	}

	public function getDeals($limit){

		$query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND product_qty != 0 AND product_price <= 60000 ORDER BY rand() LIMIT $limit ";
		return $this->con->select($query);
	}

	public function getItems($limit){

		$query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND product_qty != 0 AND cat_name = 'Clothing' ORDER BY rand() LIMIT $limit ";
		return $this->con->select($query);
	}

	public function getSubPro($limit = ''){

		$query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' ORDER BY rand() LIMIT $limit ";
		return $this->con->select($query);
	}

	public function getAllSellersProducts(){
		$query = "SELECT * FROM products WHERE type = 'Seller' AND stock = 'In-stock' ORDER BY product_id DESC ";
		return $this->con->select($query);
	}

	public function getAllProductsLimit(){
		$query = "SELECT * FROM products WHERE type = 'Admin' AND stock = 'In-stock' ORDER BY product_id DESC LIMIT 10 ";
		return $this->con->select($query);
	}


	public function numRowProducts(){
        $query = "SELECT count(product_id) as total FROM products WHERE type = 'Admin' AND stock = 'In-stock' ";
        $myproducts = $this->con->select($query);
		
        if($myproducts){
            $totalproducts = $myproducts[0]['total'];
            echo $totalproducts;
        }elseif (empty($myproducts)) {
            echo 0;
        }           
                           
    }

    public function getSingleProduct($slug){

    	$arr = array();
    	$arr['slug'] = $slug;

        $query = "SELECT * FROM products WHERE product_slug = :slug ";
        return $this->con->select($query,$arr);
        
    }

    public function delProductBySlug($slug){

    	$arr = array();
    	$arr['slug'] = $slug;

        $query = "SELECT * FROM products WHERE product_slug = :slug ";
        $getData = $this->con->select($query,$arr);
        if($getData){
            foreach($getData as $delImg){
                unlink($delImg['product_image']);
            }
                
        }
    	

        $delquery = "DELETE FROM products WHERE product_slug = :slug LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Product deleted successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Product not deleted.</div>";
        } 
    }

    public function disableProduct($slug){

    	$arr = array();
    	$arr['slug'] = $slug;
    	$arr['email'] = Session::get("sup_email");

    	$dproduct = "UPDATE products SET stock = 'Out of Stock' WHERE product_slug = :slug AND user_email = :email ";
        $dpro = $this->con->update($dproduct, $arr);
        if($dpro){
            return "<div class='alert alert-success text-white'>Product Disabled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Product Not Disabled.</div>";
        } 
    }

    public function enableProduct($slug){

    	$arr = array();
    	$arr['slug'] = $slug;
    	$arr['email'] = Session::get("sup_email");

    	$eproduct = "UPDATE products SET stock = 'In-stock' WHERE product_slug = :slug AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){
            return "<div class='alert alert-success text-white'>Product Enabled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Product Not Enabled.</div>";
        } 
    }

    public function disableSeller($slug){

    	$arr = array();
    	$arr['slug'] = $slug;

    	$dseller = "UPDATE sellers SET status = 'in-active' WHERE email = :slug ";
    	$query = "UPDATE products SET status = 'Out of Stock' WHERE user_email = :slug ";

        $dsell = $this->con->update($dseller, $arr);
        if($dsell){
            return "<div class='alert alert-success text-white'>Seller Disabled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Seller Not Disabled.</div>";
        } 
    }

    public function enableSeller($slug){

    	$arr = array();
    	$arr['slug'] = $slug;

    	$eseller = "UPDATE sellers SET status = 'active' WHERE email = :slug ";
    	$query = "UPDATE products SET status = 'In-stock' WHERE user_email = :slug ";
    	
        $esell = $this->con->update($eseller, $arr);
        if($esell){
            return "<div class='alert alert-success text-white'>Seller Enabled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Seller Not Enabled.</div>";
        } 
    }

    public function delSeller($slug){

    	$arr = array();
    	$arr['slug'] = $slug;
    	

        $delquery = "DELETE FROM sellers WHERE email = :slug LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Seller Deleted Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Seller not Deleted.</div>";
        } 
    }

    public function getProBySlug($slug){
    	$arr = array();
    	$arr['slug'] = $slug;

        $query = "SELECT * FROM products WHERE product_slug = :slug ";
        return $this->con->select($query,$arr);
        
    }

    public function adminproductUpdate($data, $file, $slug){
        $arr = array();

		$arr['email'] = Session::get("sup_email");
		$email = $arr['email'];
		$arr['slug'] = $slug;

		$arr['productname'] = addslashes($data['product_name']);
		$arr['productslug'] = slug($arr['productname']);
		$arr['catname'] = addslashes($data['cat_name']);
		$arr['productsize'] = addslashes($data['product_size']);
		$arr['productcolor'] = addslashes($data['product_color']);
		$arr['productdesc'] = addslashes($data['product_desc']);
		$arr['productprice'] = addslashes($data['product_price']);
		$arr['discount'] = addslashes($data['discount_price']);
		$arr['productqty'] = addslashes($data['product_qty']);

        $permit = array('jpg','jpeg','png');
        $file_name = $file['product_image']['name'];
        $file_size = $file['product_image']['size'];
        $file_temp = $file['product_image']['tmp_name'];

        $folder = "upload/$email/";

        if(!file_exists($folder)) {
        	mkdir($folder, 0777, true);
        }

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $arr['unique_image'] = $folder . substr(md5(time()), 0, 10).'.'.$file_ext;

        
            if(!empty($file_name)){
                
                $sourceProperties = getimagesize($file_temp);

                $uploadImageType = $sourceProperties[2];
                $sourceImageWidth = $sourceProperties[0];
                $sourceImageHeight = $sourceProperties[1];

                switch ($uploadImageType) {
                    case IMAGETYPE_JPEG:
                        $resourceType = imagecreatefromjpeg($file_temp); 
                        $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                        imagejpeg($imageLayer,$arr['unique_image']);
                        break;
         
                    case IMAGETYPE_GIF:
                        $resourceType = imagecreatefromgif($file_temp); 
                        $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                        imagegif($imageLayer,$arr['unique_image']);
                        break;
         
                    case IMAGETYPE_PNG:
                        $resourceType = imagecreatefrompng($file_temp); 
                        $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                        imagepng($imageLayer,$arr['unique_image']);
                        break;
         
                    default:
                        $imageProcess = 0;
                        break;
                }

            
        
                if($file_size > 5054589){
                    return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Image size should be less than 1MB.</div>";
                }

                if(in_array($file_ext, $permit) === false){
                    return "<div class='alert alert-danger text-white' style='font-size: 14px;'>You can upload only ".implode(', ', $permit)."</div>";
                }else{

                    move_uploaded_file($file_ext, $arr['unique_image']);

                    $query ="UPDATE products 
                    SET
                    user_email = :email,
                    product_name = :productname,
                    product_slug = :productslug,
                    cat_name = :catname,
                    product_size = :productsize,
                    discount_price = :discount,
                    product_color = :productcolor,
                    product_desc = :productdesc,
                    product_price = :productprice,
                    product_image = :unique_image,
                    product_qty = :productqty

                    WHERE product_slug = :slug AND user_email = :email ";

                    $update_row = $this->con->update($query,$arr);
                    if($update_row){
                        return "<div class='alert alert-success text-white'>Product Updated Successfully.</div>";
                        
                    }else{
                        return "<div class='alert alert-danger text-white'>Error updating product.</div>";
                        
                    }
                }


            }else{
                $query ="UPDATE products 
                SET
                user_email = :email,
                product_name = :productname,
                product_slug = :productslug,
                cat_name = :catname,
                product_size = :productsize,
                discount_price = :discount,
                product_color = :productcolor,
                product_desc = :productdesc,
                product_price = :productprice,
                product_qty = :productqty
                WHERE product_slug = :slug AND user_email = :email  ";

                $update_row = $this->con->update($query, $arr);
                if($update_row){
                    return "<div class='alert alert-success text-white'>Product Updated Successfully.</div>";
                }else{
                    return "<div class='alert alert-danger text-white'>Error updating product.</div>";
                }
            }
        
    }

    public function getAdminProfile(){

    	$arr = array();
    	$arr['admin'] = Session::get("sup_email");;

    	$query = "SELECT * FROM sup_admin WHERE sup_email = :admin ";
    	return $this->con->select($query,$arr);
    }

    public function getAdminOrders($email){

    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM orders WHERE user_email = :email AND delivery_status != 'Delivered' AND delivery_status != 'Order Cancelled' ORDER BY order_id DESC ";
		return $this->con->select($query, $arr);
	}

	public function delOrder($deleteorder){

    	$arr = array();
    	$arr['deleteorder'] = $deleteorder;
    	

        $delquery = "DELETE FROM orders WHERE order_id = :deleteorder LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Order Deleted Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order not Deleted.</div>";
        } 
    }

    public function confirmOrder($confirm){

    	$arr = array();
    	$arr['confirm'] = $confirm;
    	$arr['email'] = Session::get("sup_email");

    	$eproduct = "UPDATE orders SET delivery_status = 'Order Confirmed' WHERE order_id = :confirm AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Order Confirmed Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order Not Confirmed.</div>";
        } 
    }

    public function processOrder($process){

    	$arr = array();
    	$arr['process'] = $process;
    	$arr['email'] = Session::get("sup_email");

    	$eproduct = "UPDATE orders SET delivery_status = 'Processing' WHERE order_id = :process AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Order Processing Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order Not Processed.</div>";
        } 
    }

    public function deliverOrder($deliver){

    	$arr = array();
    	$arr['deliver'] = $deliver;
    	$del = $arr['deliver'];
    	$arr['email'] = Session::get("sup_email");
    	$emails = $arr['email'];

    	$query = "SELECT * FROM orders WHERE user_email = '$emails' AND order_id = '$del' ";
	    $getInfo = $this->con->select($query);
	    if($getInfo){
	      foreach($getInfo as $result){
	      	$orderno = $result['order_no'];
	      	$fullname = $result['fullname'];
	      	$email_addr = $result['email'];
	      	$prodname = $result['product_name'];
	      	$prodqty = $result['product_qty'];
	      	$prodprice = $result['product_price'];

	      	$total = $result['product_price'] * $result['product_qty'];
			$prodimg = $result['product_image'];
	      }
	    }

    	$eproduct = "UPDATE orders SET delivery_status = 'Out for Delivery' WHERE order_id = :deliver AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){

        	require "../Mail/phpmailer/PHPMailerAutoload.php";


	          $mail = new PHPMailer;

	          $mail->isSMTP();
	          $mail->Host='smtp.gmail.com';
	          $mail->Port=465;
	          $mail->SMTPAuth=true;
	          $mail->SMTPSecure='ssl';

	          $mail->Username='bradwick789@gmail.com';
	          $mail->Password='12345@@456';

	          $mail->setFrom('bradwick789@gmail.com');
	          $mail->addAddress($email_addr);

	          $mail->isHTML(true);
	          $mail->Subject="Order Out for Delivery";
	          $mail->Body="<p>Dear <b>$fullname</b>, </p> 

	          <p>
	          Your Order is out for Delivery. Our delivery rider will contact you shortly
	          for more details.
	          </p>
	          <h3>
	          	Delivery Details:
	          </h3>
	          <p>Order No: $orderno</p>
	          <p>Product Name: $prodname</p>
          	  <p>Product Qty: $prodqty</p>
          	  <p>Product Price: &#8358;$total</p>
          	  <p>Product Image:<br> <img src='/admin/$prodimg' width='100' height='100'></p>
	          <br><br>
	          <p>With regrads,</p>
	          <b>Shop Wise</b>
	          ";
	          if(!$mail->send()){
	            ?>
	                <script>
	                    alert("<?php echo "Failed, Invalid Email"?>");
	                </script>
	            <?php
	          }


            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Order Out for Delivery.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order Not Out.</div>";
        } 
    }

    public function orderDelivered($delivered){

    	$arr = array();
    	$arr['delivered'] = $delivered;
    	$del = $arr['delivered'];

    	$arr['email'] = Session::get("sup_email");
    	date_default_timezone_set('Africa/Lagos');
    	$arr['date_time'] = date('Y-m-d H:i', time());

    	$email = $arr['email'];

    	$query = "SELECT * FROM orders WHERE user_email = '$email' AND order_id = '$del' ";
	    $getInfo = $this->con->select($query);
	    if($getInfo){
	      foreach($getInfo as $result){
	      	$productname = $result['product_name'];
	        $product_qtys = $result['product_qty'];
	      }
	    }

	    $query = "SELECT * FROM products WHERE user_email = '$email' ";
	    $getInfo = $this->con->select($query);
	    if($getInfo){
	      foreach($getInfo as $result){
	        $productqty = $result['product_qty'];
	      }
	    }

    	$eproduct = "UPDATE orders SET delivery_status = 'Delivered', delivery_date = :date_time WHERE order_id = :delivered AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);

        

	    $e = "UPDATE products SET product_qty = product_qty - $product_qtys WHERE product_name = '$productname' AND user_email = '$email' ";
        $pro = $this->con->update($e);


        if($epro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Order Delivered Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order Not Delivered.</div>";
        } 
    }

    public function orderCancel($cancel){

    	$arr = array();
    	$arr['cancel'] = $cancel;
    	$arr['email'] = Session::get("sup_email");

    	$eproduct = "UPDATE orders SET delivery_status = 'Order Cancelled' WHERE order_id = :cancel AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Order Cancelled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order Not Cancelled.</div>";
        } 
    }

    public function getAllAdminOrdersLimit($email,$limit){
    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM orders WHERE user_email = :email AND delivery_status = 'Pending' ORDER BY order_id DESC LIMIT $limit ";
		return $this->con->select($query, $arr);
	}

    public function getAdminConfirmedOrders($email){

    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM orders WHERE user_email = :email AND delivery_status = 'Delivered' ORDER BY order_id DESC ";
		return $this->con->select($query, $arr);
	}

	public function getSellerByEmail($email){
    	$arr = array();
    	$arr['email'] = $email;

        $query = "SELECT * FROM sellers WHERE email = :email ";
        return $this->con->select($query,$arr);
        
    }

    public function editSeller($data, $email, $file){
        $arr = array();

		$arr['emails'] = $email;
		$emails = $arr['emails'];

		$arr['fnames'] = addslashes($data['fname']);
		$arr['lnames'] = addslashes($data['lname']);
		$arr['email'] = addslashes($data['email']);
		$arr['bizname'] = addslashes($data['biz_name']);
		$arr['phone'] = addslashes($data['phone_number']);

		$arr['address'] = addslashes($data['address']);
		
		$arr['acct_number'] = addslashes($data['acct_num']);

		$arr['acctname'] = addslashes($data['acct_name']);

		$arr['bankname'] = addslashes($data['bank_name']);

		$rawdate = htmlentities($data['sub_end']);
  		$arr['subend'] = date('Y-m-d H:i:s', strtotime($rawdate));


  		$permit = array('jpg','jpeg','png');
        $file_name = $file['seller_image']['name'];
        $file_size = $file['seller_image']['size'];
        $file_temp = $file['seller_image']['tmp_name'];

        $folder = "art/";
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $arr['sell_image'] = $folder . substr(md5(time()), 0, 10).'.'.$file_ext;

        if(!empty($file_name)){
        	$sourceProperties = getimagesize($file_temp);

            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];

            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($file_temp); 
                    $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"300");
                    imagejpeg($imageLayer,$arr['sell_image']);
                    break;
     
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($file_temp); 
                    $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"300");
                    imagegif($imageLayer,$arr['sell_image']);
                    break;
     
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($file_temp); 
                    $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"300");
                    imagepng($imageLayer,$arr['sell_image']);
                    break;
     
                default:
                    $imageProcess = 0;
                    break;
            }

            if(in_array($file_ext, $permit) === false){
                return "<div class='alert alert-danger text-white' style='font-size: 14px;'>You can upload only ".implode(',', $permit)."</div>";
            }else{

            	move_uploaded_file($file_ext, $arr['sell_image']);

			    $query ="UPDATE sellers 
			    SET
			    fname = :fnames,
			    lname = :lnames,
			    email = :email,
			    biz_name = :bizname,
			    phone_number = :phone,
			    seller_image = :sell_image,
			    address = :address,
			    acct_num = :acct_number,
			    acct_name = :acctname,
			    bank_name = :bankname,
			    sub_end = :subend

			    WHERE email = :emails ";

			    $update_row = $this->con->update($query,$arr);
			    if($update_row){
			        return "<div class='alert alert-success text-white'>Seller Info Updated Successfully.</div>";
			        
			    }else{
			        return "<div class='alert alert-danger text-white'>Error Updating Seller Info.</div>";
			        
			    }
			}
		}else{

        	move_uploaded_file($file_ext, $arr['sell_image']);

		    $query ="UPDATE sellers 
		    SET
		    fname = :fnames,
		    lname = :lnames,
		    email = :email,
		    biz_name = :bizname,
		    phone_number = :phone,
		    address = :address,
		    acct_num = :acct_number,
		    acct_name = :acctname,
		    bank_name = :bankname,
		    sub_end = :subend

		    WHERE email = :emails ";

		    $update_row = $this->con->update($query,$arr);
		    if($update_row){
		        return "<div class='alert alert-success text-white'>Seller Info Updated Successfully.</div>";
		        
		    }else{
		        return "<div class='alert alert-danger text-white'>Error Updating Seller Info.</div>";
		        
		    }
		}
    }

    public function aboutUs($data){

		$arr = array();
		$arr['abouttitle'] = addslashes($data['about_title']);

		$arr['aboutdesc'] = ($data['about_desc']);


		// Check for empty fields
		if ($arr['abouttitle'] == "" || $arr['aboutdesc'] == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}



		$query = "INSERT INTO aboutus (about_title,about_desc) VALUES(:abouttitle,:aboutdesc)";
		$insert_row = $this->con->insert($query,$arr);


		if ($insert_row) {
            return "<div class='alert alert-success text-white'>Added Successfully!</div>";
            
		}else{
			return "<div class='alert alert-danger text-white'>Error</div>";
		}

	}

	public function getAbout(){
		$query = "SELECT * FROM aboutus ORDER BY about_id DESC LIMIT 1 ";
		return $this->con->select($query);
	}

	public function privacyPolicy($data){

		$arr = array();
		$arr['privacytitle'] = addslashes($data['privacy_title']);

		$arr['privacydesc'] = addslashes($data['privacy_desc']);


		// Check for empty fields
		if ($arr['privacytitle'] == "" || $arr['privacydesc'] == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}



		$query = "INSERT INTO privacy (privacy_title,privacy_desc) VALUES(:privacytitle,:privacydesc)";
		$insert_row = $this->con->insert($query,$arr);


		if ($insert_row) {
            return "<div class='alert alert-success text-white'>Added Successfully!</div>";
            
		}else{
			return "<div class='alert alert-danger text-white'>Error</div>";
		}

	}

	public function getprivacy(){
		$query = "SELECT * FROM privacy ORDER BY privacy_id DESC LIMIT 1";
		return $this->con->select($query);
	}

	public function terms($data){

		$arr = array();
		$arr['termstitle'] = addslashes($data['terms_title']);

		$arr['termsdesc'] = addslashes($data['terms_desc']);


		// Check for empty fields
		if ($arr['termstitle'] == "" || $arr['termsdesc'] == ""){
			return "<div class='alert alert-danger text-white'>Field cannot be empty</div>";
		}



		$query = "INSERT INTO terms (terms_title,terms_desc) VALUES(:termstitle,:termsdesc)";
		$insert_row = $this->con->insert($query,$arr);


		if ($insert_row) {
            return "<div class='alert alert-success text-white'>Added Successfully!</div>";
            
		}else{
			return "<div class='alert alert-danger text-white'>Error</div>";
		}

	}

	public function getTerms(){
		$query = "SELECT * FROM terms ORDER BY terms_id DESC LIMIT 1";
		return $this->con->select($query);
	}
    
    public function getAllOrders(){

        $query = "SELECT * FROM orders LEFT JOIN sellers ON sellers.email = orders.user_email ORDER BY order_id DESC ";
        return $this->con->select($query);
    }

    public function getDealsShoes($limit){

		$query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND product_qty != 0 AND cat_name = 'shoes' ORDER BY rand() LIMIT $limit ";
		return $this->con->select($query);
	}

	public function getDealsSkin($limit){

		$query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND product_qty != 0 AND cat_name = 'shoes' ORDER BY rand() LIMIT $limit ";
		return $this->con->select($query);
	}
   
}




	