<?php  

	$filepath = realpath(dirname(__FILE__));

	include_once ($filepath.'/../connect/Database.php');
	include_once ($filepath.'/../lib/format.php');



class User{

	private $con;
	private $format;

	public function __construct(){
   		$this->con = new Database();
   		$this->format = new Format();
	}


//  	public function userAddCategory($data){

//  		$arr = array();
		// $arr['cat_name'] = addslashes($data['cat_name']);
		// $arr['user_email'] = Session::get("email");

		// if ($arr['cat_name'] == ""){
		// 	return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Field cannot be empty</div>";
		// }

		// $query = "INSERT INTO category (user_email, cat_name) VALUES(:user_email, :cat_name)";
		// $insert_row = $this->con->insert($query,$arr);


		// if ($insert_row) {
		// 	return "<div class='alert alert-success text-white' style='font-size: 14px;'>Created Successfully!</div>";

		// }else{
		// 	return "<div class='alert alert-danger text-white'>Error</div>";
		// }

//  	}

//  	public function getAllCat(){

//  		$arr = array();
//  		$arr['user_email'] = Session::get("email");

//  		$query = "SELECT * FROM category WHERE user_email = :user_email ";
//  		return $this->con->select($query,$arr);

//  	}

	public function getAllCatByEmail($email){

		$arr = array();
		$arr['email'] = $email;

		$query = "SELECT seller_cat, seller_sub_cat FROM sellers WHERE email = :email ";
		return $this->con->select($query,$arr);

	}

	public function sellerdelCat($id){

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

	public function sellerAddProduct($data, $file){

        $arr = array();

        $arr['email'] = Session::get("email");
        $email = $arr['email'];

        $arr['productname'] = addslashes($data['product_name']);
        $arr['productslug'] = slug($arr['productname']);
        
        $arr['category'] = addslashes($data['category']);
        $arr['catslug'] = slug($arr['category']);
        
        $arr['catname'] = addslashes($data['cat_name']);
        $arr['subcatslug'] = slug($arr['catname']);
        
        $arr['brandname'] = addslashes($data['brand']);
        $arr['productsize'] = addslashes($data['product_size']);
        $arr['productcolor'] = addslashes($data['product_color']);
        $arr['productdesc'] = addslashes($data['product_desc']);
        $arr['productprice'] = addslashes($data['product_price']);
        $arr['discount'] = addslashes($data['discount_price']);
        $arr['productqty'] = addslashes($data['product_qty']);
        $arr['type'] = addslashes($data['type']);
        

        $permit = array('jpg','jpeg','png');
        $file_name = $file['product_image']['name'];
        $file_size = $file['product_image']['size'];
        $file_temp = $file['product_image']['tmp_name'];

        // Check for empty fields
        if ($arr['productname'] == "" || $arr['catname'] == "" || $arr['productsize'] == "" || $arr['brandname'] == "" || $arr['productcolor'] == "" || $arr['productdesc'] == "" || $arr['productprice'] == "" || $arr['discount'] == "" || $arr['productqty'] == "" || $file_name == ""){
            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Field cannot be empty</div>";
        }

        $sourceProperties = getimagesize($file_temp);

        $folder = "../a70a5ak61q/upload/$email/";

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
                $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"300");
                imagejpeg($imageLayer,$arr['unique_image']);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($file_temp); 
                $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"300");
                imagegif($imageLayer,$arr['unique_image']);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($file_temp); 
                $imageLayer = $this->format->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,"300");
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
            $query = "INSERT INTO products(user_email,product_name,product_slug,category,cat_slug,cat_name,subcat_slug,brand,product_size,discount_price,product_color,product_desc,product_price,product_image,product_qty,type) 
            VALUES(:email, :productname, :productslug, :category, :catslug, :catname, :subcatslug, :brandname, :productsize, :discount, :productcolor, :productdesc,:productprice, :unique_image, :productqty, :type) ";

            $insert_row = $this->con->insert($query,$arr);
            if($insert_row){
                return "<div class='alert alert-success text-white' style='font-size: 14px;'>Product inserted successfully.</div>";
               
            }else{
                return "<div class='alert alert-danger text-white'>Error inserting product.</div>";
                
            }

        }   

    }

	public function getSeller($email){
		$arr = array();
		$arr['email'] = $email;

		$query = "SELECT * FROM sellers WHERE email = :email ";
		return $this->con->select($query,$arr);

	}

	public function numRowSellerProducts($email){

		$arr = array();
		$arr['email'] = $email;

        $query = "SELECT count(product_id) as total FROM products WHERE user_email = :email AND stock = 'In-stock' ";
        $myproducts = $this->con->select($query,$arr);
		
        if($myproducts){
            $totalproducts = $myproducts[0]['total'];
            echo $totalproducts;
        }elseif (empty($myproducts)) {
            echo 0;
        }           
                           
    }

    public function numRowSellerOrders($email){

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

    public function numRowSellerSalesToday($email,$date){

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

    public function numRowSellerSales($email){

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

    public function getSellerProducts($email){

    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM products WHERE user_email = :email ORDER BY product_id DESC ";
		return $this->con->select($query, $arr);
	}

	public function getSellerOrders($email){

    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM orders WHERE user_email = :email AND delivery_status != 'Delivered' AND delivery_status != 'Order Cancelled' ORDER BY order_id DESC ";
		return $this->con->select($query, $arr);
	}

	public function getSellerConfirmedOrders($email){

    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM orders WHERE user_email = :email AND delivery_status = 'Delivered' ORDER BY order_id DESC ";
		return $this->con->select($query, $arr);
	}

	public function getSingleProduct($slug){

    	$arr = array();
    	$arr['slug'] = $slug;

        $query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE product_slug = :slug ";
        return $this->con->select($query,$arr);
        
    }

    public function getSellerInfo($info){

    	$arr = array();
    	$arr['info'] = $info;

        $query = "SELECT * FROM sellers WHERE biz_slug = :info ";
        return $this->con->select($query,$arr);
        
    }

    public function getSellerProd($info,$limit){

    	$arr = array();
    	$arr['info'] = $info;

        $query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE sellers.biz_name = :info ORDER BY rand() LIMIT $limit ";
        return $this->con->select($query,$arr);
        
    }


    public function sellerproductUpdate($data, $file, $slug){
        $arr = array();

		$arr['email'] = Session::get("email");
		$email = $arr['email'];
		$arr['slug'] = $slug;

		$arr['productname'] = addslashes($data['product_name']);
		$arr['productslug'] = slug($arr['productname']);

		$arr['catname'] = addslashes($data['cat_name']);
        
		$arr['brandname'] = addslashes($data['brand']);
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

        

        $folder = "../admin/upload/$email/";

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
                    return "<div class='alert alert-danger text-white' style='font-size: 14px;'>You can upload only ".implode(',', $permit)."</div>";
                }else{

                    move_uploaded_file($file_ext, $arr['unique_image']);

                    $query ="UPDATE products 
                    SET
                    user_email = :email,
                    product_name = :productname,
                    product_slug = :productslug,
                    cat_name = :catname,
                    brand = :brandname,
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
                brand = :brandname,
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

    public function disableProduct($slug){

    	$arr = array();
    	$arr['slug'] = $slug;
    	$arr['email'] = Session::get("email");

    	$dproduct = "UPDATE products SET stock = 'Out of Stock' WHERE product_slug = :slug AND user_email = :email ";
        $dpro = $this->con->update($dproduct, $arr);
        if($dpro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Product Disabled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Product Not Disabled.</div>";
        } 
    }

    public function enableProduct($slug){

    	$arr = array();
    	$arr['slug'] = $slug;
    	$arr['email'] = Session::get("email");

    	$eproduct = "UPDATE products SET stock = 'In-stock' WHERE product_slug = :slug AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Product Enabled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Product Not Enabled.</div>";
        } 
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

    public function getAllSellersProductsLimit($email,$limit){
    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM products WHERE user_email = :email AND stock = 'In-stock' ORDER BY product_id DESC LIMIT $limit ";
		return $this->con->select($query, $arr);
	}

	public function getAllSellersOrdersLimit($email,$limit){
    	$arr = array();
    	$arr['email'] = $email;

		$query = "SELECT * FROM orders WHERE user_email = :email AND delivery_status = 'Pending' ORDER BY order_id DESC LIMIT $limit ";
		return $this->con->select($query, $arr);
	}

	public function getSellerProfile(){

    	$arr = array();
    	$arr['seller'] = Session::get("email");;

    	$query = "SELECT * FROM sellers WHERE email = :seller ";
    	return $this->con->select($query,$arr);
    }

	public function getProfile($id){

    	$arr = array();
    	$arr['seller'] = $id;

    	$query = "SELECT * FROM sellers WHERE email = :seller ";
    	return $this->con->select($query,$arr);
    }

    public function sellerUpdateProfile($data, $id){
        $arr = array();

		$arr['id'] = $id;

		$arr['fname'] = addslashes($data['fname']);
		$arr['lname'] = addslashes($data['lname']);
		$arr['email'] = addslashes($data['email']);
		$arr['phone_number'] = addslashes($data['phone_number']);
		$arr['description'] = addslashes($data['description']);
		$arr['address'] = addslashes($data['address']);
		$arr['facebook'] = addslashes($data['facebook']);
		$arr['instagram'] = addslashes($data['instagram']);
		$arr['twitter'] = addslashes($data['twitter']);


        $query ="UPDATE sellers 
        SET
        fname = :fname,
        lname = :lname,
        email = :email,
        phone_number = :phone_number,
        description = :description,
        address = :address,
        facebook = :facebook,
        instagram = :instagram,
        twitter = :twitter

        WHERE email = :id ";

        $update_profile = $this->con->update($query,$arr);
        if($update_profile){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Profile Updated Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Error Updating Profile.</div>";
            
        }     
        
    }

    public function sellerChangePass($data, $id){

		$arr = array();

		$arr['email'] = $id;
		$email = $arr['email'];

        
        $current_pass = $data['cupass'];
        $new_pass = $data['nepass'];
        $confirm_pass = $data['copass'];
		

		$arr['nepass'] = password_hash($data['nepass'], PASSWORD_DEFAULT);

		if (strlen($data['nepass']) && strlen($data['copass']) < 8 ) {
                
            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Password must be 8 characters long</div>";

        }


        $query = "SELECT password FROM sellers WHERE email = '$email' ";
        $result = $this->con->select($query);
        if($result){
        	$oldpassword = '';
            foreach($result as $row){
            	if(password_verify($current_pass, $row['password']) == $row['password']) {
                	
		                if ($new_pass == $confirm_pass) {


		                    $query = "UPDATE sellers SET 
		                    password = :nepass 

		                    WHERE email = :email ";

		                    $update_query = $this->con->update($query, $arr);
		                    if($update_query){
		                        return "<div class='alert alert-success text-white' style='font-size: 14px;'>Password Changed Successfully.</div>";
		                        
		                    }else{
		                        return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Password Change Not Successful.</div>";
		                        
		                    }

		                }else{
		                    return "<div class='alert alert-danger text-white' style='font-size: 14px;'>New & Retype Password Don't Match.</div>";
		                    
		                }

		            
                }else{
		                return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Old Password Don't Match.</div>";
		                
		            }
            }
            
        }

    }

    public function addToCart($data, $slug){

    	$arr = array();

        
        $arr['slugs'] = $slug;
        $slugs = $arr['slugs'];

        $arr['session'] = session_id();
        $sid = $arr['session'];

        $arr['visitor_ip'] = $_SERVER['REMOTE_ADDR'];
        $ip = $arr['visitor_ip'];

        $arr['product_qty'] = addslashes($data['product_qty']);

        $squery = "SELECT * FROM products WHERE product_slug = '$slugs' ";
        $result = $this->con->select($squery);

        if ($result) {
        	foreach($result as $row){
        		$arr['user_email'] = $row['user_email'];
        		$arr['product_name'] = $row['product_name'];
	            $arr['product_price'] = $row['product_price'];
	            $arr['discount_price'] = $row['discount_price'];
	            $arr['product_image'] = $row['product_image'];

        	}

        	
        }
        

        $cquery = "SELECT * FROM cart WHERE product_slug = '$slugs' AND s_id = '$sid' ";
        $getProduct = $this->con->select($cquery);
        if($getProduct){
            return "<div class='alert alert-danger'>Product Already Added!</div>";
             
        }else{           

            $query = "INSERT INTO cart(ip_address,s_id,user_email,product_name,product_slug,product_price,discount_price,product_qty,product_image) 
            VALUES(:visitor_ip,:session,:user_email,:product_name,:slugs,:product_price,:discount_price,:product_qty,:product_image) ";

            $insert_row = $this->con->insert($query, $arr);
            if($insert_row){
                header("Location: /cart");
            }else{
                header("Location: /404");
            }
        }

    }

    public function updateCartQuantity($cart_id, $product_quantity){
    	$arr = array();

        $arr['cart_id'] = addslashes($cart_id);
        $arr['product_quantity'] = addslashes($product_quantity);

        $query = "UPDATE cart SET product_qty = :product_quantity WHERE cart_id = :cart_id ";
        $update_query = $this->con->update($query, $arr);
        if($update_query){
            
        	return "<div class='alert alert-success'>Quantity Updated.</div>";

        }else{
            return "<div class='alert alert-danger'>Quantity not Updated.</div>";
            
        }

    }

    public function getCartProduct(){
    	$arr = array();

        $arr['sid'] = session_id();
        $query = "SELECT * FROM cart WHERE s_id = :sid ";
        $result = $this->con->select($query, $arr);
        return $result;
    }

    public function checkCartTable(){
        $arr = array();

        $arr['sid'] = session_id();
        $query = "SELECT * FROM cart WHERE s_id = :sid ";
        $result = $this->con->select($query, $arr);
        return $result;
    }

    public function numRow(){
    	$arr = array();

        $arr['sid'] = session_id();

        $query = "SELECT count(cart_id) as total FROM cart WHERE s_id = :sid ";
        $result = $this->con->select($query, $arr);
        if($result){
            $totalcart = $result[0]['total'];
            echo $totalcart;
        }elseif (empty($result)) {
            echo 0;
        }           
                           
    }

    public function delProductByCart($delId){
    	$arr = array();


        $arr['delId'] = addslashes($delId);

        $delquery = "DELETE FROM cart WHERE cart_id = :delId ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            header("Location: /cart");
            
        }else{
            return "<span class='danger'>Removed from cart unsuccessful.</span>";
            
        }
    }

    public function customerRegistration($data){
    	$arr = array();         

        $arr['fname'] = addslashes($data['fname']);
        $fname = $arr['fname'];

        $arr['lname'] = addslashes($data['lname']);
        

        $arr['email'] = addslashes($data['email']);

        $otp = rand(1000,999999999);
    	$arr['otp'] = $otp;
        $_SESSION['otp'] = $otp;
        $email = $arr['email'];


        $_SESSION['mail'] = $arr['email'];

        $arr['phone'] = addslashes($data['phone']);
        

        $arr['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		

        // Check for empty fields
		if ($arr['fname'] == "" || $arr['lname'] == "" || $arr['email'] == "" || $arr['phone'] == "" || $arr['password'] == ""){?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php

			return "<div class='alert alert-danger'>Field cannot be empty</div>";
		}

		// Check for firstname
        if (empty($arr['fname']) || !preg_match('/^[a-zA-Z]+$/', $arr['fname'])) {?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
            
            return "<div class='alert alert-danger'>Only letters allowed in First Name</div>";

        }

        // Check for lastname
        if (empty($arr['lname']) || !preg_match('/^[a-zA-Z]+$/', $arr['lname'])) {?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
            
            return "<div class='alert alert-danger'>Only letters allowed in Last Name</div>";

        }

        // Check for email
        if (empty($arr['email']) || !filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
            
            return "<div class='alert alert-danger'>Email is not valid</div>";

        }
        
        $mailquery = "SELECT * FROM users WHERE email = '$email' LIMIT 1 ";
        $mailcheck = $this->con->select($mailquery);
        if($mailcheck != false){
            return "<div class='alert alert-danger'>Email already exist.</div>";

        }


        if(isset($data['password'])){
            // Check for password
            if (empty($data['password'])) {?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
                
                return "<div class='alert alert-danger'>Password field can't be empty!</div>";

            }

            if (strlen($data['password']) < 8 ) {?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
                
                return "<div class='alert alert-danger'>Password must be 8 characters long</div>";

            }


        }


        $query = "INSERT INTO users(fname,lname,email,phone,password,otp_code) 
        VALUES(:fname,:lname,:email,:phone,:password,:otp) ";
        $insert_customer = $this->con->insert($query, $arr);

        if($insert_customer){
            require "Mail/phpmailer/PHPMailerAutoload.php";


            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=465;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='ssl';

            $mail->Username='bradwick789@gmail.com';
            $mail->Password='12345@@456';

            $mail->setFrom('bradwick789@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["email"]);

            $mail->isHTML(true);
            $mail->Subject="Your verification code";
            $mail->Body="<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Verify Email</title>

                    <style>

                        .wrapper{
                            background: #fff;
                            padding: 20px 0 30px 20px;
                            border-radius: 5px;
                            text-align: center;
                        }

                        .otp{
                            width: 300px;
                            padding: 1px;
                            background: #16638f;
                            border-radius: 8px;
                            margin: 0 auto;
                        }
                        .otp h4{
                            letter-spacing: 0.7em;
                            color: #fff;
                            font-size: 18px;
                        }
                        p{
                            color: #333;
                            text-align: center;
                        }

                        .header{
                            text-align: center;
                            margin: 10px 0 20px 0;
                        }

                    </style>
                </head>
                <body>
                    
                    <div class='wrapper'>
                        <div class='header'>

                            <img src='https://suremarts.com/img/logo/logo.jpg' />

                        </div>

                        <h3>Dear $fname,</h3>
                        <h4>
                            Verify O.T.P Code
                        </h4>
                        <div class='otp'>
                            <h4>$otp</h4>
                        </div>
                        <p>The code expires in 10 minutes.</p>
                    </div>
                </body>
                </html>
            ";
            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo "Register Failed, Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                <script>
                    alert("<?php echo "Registration Successful, verification code sent to " . $email ?>");
                    window.location.replace('/verify-account');
                </script>
                <?php
            }
            
        }else{
            return "<div class='alert alert-danger'>Registration not Successful.</div>";
            
        }

        $notverify = "SELECT * FROM users WHERE email = '$email' AND verify = '0' LIMIT 1 ";
        $notcheck = $this->con->select($notverify);

        if($notcheck != false){
        	Session::set("CusLogin", false);
            
            $_SESSION['message'] = "<div class='alert alert-danger'>
            <p>A verification code has been sent to the Email Address you provided. Please copy the code and verify</p>
            </div>";
            
         header("Location: /verify-account");
        }
        
    }

    public function customerLogin($data){
    	$arr = array();


        $arr['email'] = addslashes($data['email']);
        $password = $data['password'];

        if(empty($arr['email']) || empty($data['password'])){?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php

            return "<div class='alert alert-danger' style='font-size: 14px;'>Email or password must not be empty</div>";
  
        }

        $verifys = "SELECT * FROM users WHERE email = :email AND status = 'in-active' LIMIT 1 ";
        $resultss = $this->con->select($verifys,$arr);

        if ($resultss != false) {

            return "<div class='alert alert-danger' style='font-size: 14px;'>Your Account Has Been Deactivated.</div>";

        }

        $verify = "SELECT * FROM users WHERE email = :email AND status = 'active' LIMIT 1 ";
    	$results = $this->con->select($verify,$arr);

    	if ($results) {
            foreach($results as $value){

                if(password_verify($password, $value['password'])) {
                    Session::set("CusLogin", true);
                    Session::set("UserId", $value['user_id']);
                    Session::set("UserEmail", $value['email']);
                    Session::set("UserFname", $value['fname']);
                    Session::set("UserLname", $value['lname']);

                    header("Location: /customer");
                }else{?>

                    <script>
                        if ( window.history.replaceState ) {
                            window.history.replaceState( null, null, window.location.href );
                        }
                    </script>
                    <?php
            
                    return "<div class='alert alert-danger' style='font-size: 14px;'>Email or Password do not match</div>";

                }

            }
        }else{?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
    
            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Email or Password do not match</div>";

        }

        
    }

    public function userVerify($data){

    	$arr = array();

        $arr['otp'] = $_SESSION['otp'];

        $arr['email'] = $_SESSION['mail'];
        $email = $arr['email'];

        $arr['otpcode'] = addslashes($data['otp_code']);

        if ($arr['otpcode'] == "") {
            return "<div class='alert alert-danger'>Please fill in the field.</div>";
        }



        if($arr['otp'] != $arr['otpcode']){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{

            $query = "UPDATE users SET verify = 1 WHERE email = '$email' ";
            $update_query = $this->con->update($query);

            if ($update_query) {

                
                $userquery = "SELECT * FROM users WHERE email = '$email' LIMIT 1 ";
                $results = $this->con->select($userquery);

                if ($results) {
                    foreach($results as $value){

                    	Session::set("CusLogin", true);
	                    Session::set("UserId", $value['user_id']);
	                    Session::set("UserEmail", $value['email']);
	                    Session::set("UserFname", $value['fname']);
	                    Session::set("UserLname", $value['lname']);

                    }
                    
                }
            }

            ?>
             <script>
                 alert("Verfiy Account Done");
                   window.location.replace("/customer");
             </script>
             <?php
        }

    }

    public function getCustomerInfo($info){

    	$arr = array();
    	$arr['info'] = $info;

        $query = "SELECT * FROM users WHERE email = :info ";
        return $this->con->select($query,$arr);
        
    }

    public function customerdetUpdate($data){
        $arr = array();

		$arr['emails'] = Session::get("UserEmail"); 

		$arr['fname'] = addslashes($data['fname']);
		$arr['lname'] = addslashes($data['lname']);
		$arr['email'] = addslashes($data['email']);
		$arr['phone'] = addslashes($data['phone']);
		$arr['gender'] = addslashes($data['gender']);
		$arr['address'] = addslashes($data['address']);
		$arr['city'] = addslashes($data['city']);
		$arr['state'] = addslashes($data['state']);

		$rawdate = htmlentities($data['birthday']);
    	$arr['birthday'] = date('Y-m-d', strtotime($rawdate));


		// Check for empty fields
		if ($arr['fname'] == "" || $arr['lname'] == "" || $arr['email'] == "" || $arr['phone'] == "" || $arr['gender'] == "" || $data['address'] == "" || $data['city'] == "" || $data['state'] == "" || $data['birthday'] == ""){?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
			return "<div class='alert alert-danger'>Field cannot be empty</div>";
		}

		if (!preg_match('/^[0-9 +-]*$/', $arr['phone'])) {?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
            
            return "<div class='alert alert-danger'>Only numbers allowed in phone number</div>";

        }

        // Check for firstname
        if (!preg_match('/^[a-zA-Z]+$/', $arr['fname'])) {?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
            
            return "<div class='alert alert-danger'>Only letters allowed in first name</div>";

        }

        // Check for lastname
        if (!preg_match('/^[a-zA-Z]+$/', $arr['lname'])) {?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
            
            return "<div class='alert alert-danger'>Only letters allowed in last name</div>";

        }else{

        	$query = "UPDATE users SET
            fname = :fname,
            lname = :lname,
            email = :email,
            phone = :phone,
            gender = :gender,
            birthday = :birthday,
            address = :address,
            state = :state,
            city = :city
            WHERE email = :emails ";

            $update_row = $this->con->update($query, $arr);
            if($update_row){?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
                return "<div class='alert alert-success'>Updated Successfully.</div>";
            }else{?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
                return "<div class='alert alert-danger'>Error updating.</div>";
        		}
        	
        }
	}


	public function customerdeteUpdate($data){
        $arr = array();

		$arr['emails'] = Session::get("UserEmail"); 

		$arr['fname'] = addslashes($data['fname']);
		$arr['lname'] = addslashes($data['lname']);
		$arr['email'] = addslashes($data['email']);
		$arr['phone'] = addslashes($data['phone']);
		$arr['address'] = addslashes($data['address']);
		$arr['city'] = addslashes($data['city']);
		$arr['state'] = addslashes($data['state']);


		// Check for empty fields
		if ($arr['fname'] == "" || $arr['lname'] == "" || $arr['email'] == "" || $arr['phone'] == "" || $data['address'] == "" || $data['city'] == "" || $data['state'] == "" ){?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
			return "<div class='alert alert-danger'>Field cannot be empty</div>";
		}

		if (!preg_match('/^[0-9 +-]*$/', $arr['phone'])) {?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
            
            return "<div class='alert alert-danger'>Only numbers allowed in phone number</div>";

        }

        // Check for firstname
        if (!preg_match('/^[a-zA-Z]+$/', $arr['fname'])) {?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
            
            return "<div class='alert alert-danger'>Only letters allowed in first name</div>";

        }

        // Check for lastname
        if (!preg_match('/^[a-zA-Z]+$/', $arr['lname'])) {?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
            
            return "<div class='alert alert-danger'>Only letters allowed in last name</div>";

        }else{

        	$query = "UPDATE users SET
            fname = :fname,
            lname = :lname,
            email = :email,
            phone = :phone,
            address = :address,
            state = :state,
            city = :city
            WHERE email = :emails ";

            $update_row = $this->con->update($query, $arr);
            if($update_row){

            	header("Location: /order-details");

            }else{?>

	            <script>
	                if ( window.history.replaceState ) {
	                    window.history.replaceState( null, null, window.location.href );
	                }
	            </script>
	            <?php
                return "<div class='alert alert-danger'>Error updating.</div>";
        		}
        	
        }
	}

	public function changePass($data){

		$arr = array();

		$arr['email'] = Session::get("UserEmail");
		$email = $arr['email'];

        
        $current_pass = $data['cpass'];
        $new_pass = $data['npass'];
        $confirm_pass = $data['repass'];
		

		$arr['npass'] = password_hash($data['npass'], PASSWORD_DEFAULT);

		if (strlen($data['npass']) && strlen($data['repass']) < 8 ) {?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php
                
            return "<div class='alert alert-danger'>Password must be 8 characters long</div>";

        }


        $query = "SELECT password FROM users WHERE email = '$email' ";
        $result = $this->con->select($query);
        if($result){
        	$oldpassword = '';
            foreach($result as $row){
            	if(password_verify($current_pass, $row['password']) == $row['password']) {
                	
		                if ($new_pass == $confirm_pass) {


		                    $query = "UPDATE users SET 
		                    password = :npass 

		                    WHERE email = :email ";

		                    $update_query = $this->con->update($query, $arr);
		                    if($update_query){
		                        return "<div class='alert alert-success'>Password Changed Successfully.</div>";
		                        
		                    }else{
		                        return "<div class='alert alert-danger'>Password Change Not Successful.</div>";
		                        
		                    }

		                }else{
		                    return "<div class='alert alert-danger'>New & Retype Password Don't Match.</div>";
		                    
		                }

		            
                }else{
		                return "<div class='alert alert-danger'>Old Password Don't Match.</div>";
		                
		            }
            }
            
        }

    }

    public function getOrder($id){
    	$arr = array();

    	$arr['email'] = Session::get("UserEmail");
    	$arr['id'] = $id;

        $query = "SELECT * FROM orders WHERE email = :email AND reference = :id ";
        $result = $this->con->select($query, $arr);
        return $result;
    }

    public function getOrders($email, $offset, $total_records_per_page){
    	$arr = array();

    	$arr['email'] = $email;

        $query = "SELECT * FROM orders WHERE email = :email ORDER BY order_id DESC LIMIT $offset, $total_records_per_page ";
        $result = $this->con->select($query, $arr);
        return $result;
    }

    public function getSingleOrder($order){

    	$arr = array();
    	$arr['order'] = $order;

        $query = "SELECT * FROM orders WHERE order_no = :order ";
        return $this->con->select($query,$arr);
        
    }

    public function confirmOrder($confirm){

    	$arr = array();
    	$arr['confirm'] = $confirm;
    	$arr['email'] = Session::get("email");

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
    	$arr['email'] = Session::get("email");

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

    	$arr['email'] = Session::get("email");
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

    	$arr['email'] = Session::get("email");
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
    	$arr['email'] = Session::get("email");

    	$eproduct = "UPDATE orders SET delivery_status = 'Order Cancelled' WHERE order_id = :cancel AND user_email = :email ";
        $epro = $this->con->update($eproduct, $arr);
        if($epro){
            return "<div class='alert alert-success text-white' style='font-size: 14px;'>Order Cancelled Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Order Not Cancelled.</div>";
        } 
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

    public function productBySearch($search){
    	
        $query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND product_name LIKE '%$search%' OR product_desc LIKE '%$search%' ";
        return $this->con->select($query);
    }

    public function productByCat($cat){
    	$arr = array();
    	$arr['cat'] = addslashes($cat);

        $query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND category = :cat OR cat_name = :cat ";
        return $this->con->select($query, $arr);
    }

    public function productBySubCat($subcat){
    	$arr = array();
    	$arr['subcat'] = addslashes($subcat);

        $query = "SELECT * FROM products LEFT JOIN sellers ON sellers.email = products.user_email WHERE stock = 'In-stock' AND cat_name = :subcat ";
        return $this->con->select($query, $arr);
    }


    public function sellerAddGallery($data, $file){

        $arr = array();

        $arr['email'] = Session::get("email");
        $email = $arr['email'];

        $arr['imgname'] = addslashes($data['img_name']);
        $arr['imgslug'] = slug($arr['imgname']);
        
        $arr['type'] = addslashes($data['img_type']);
        

        $permit = array('jpg','jpeg','png');
        $file_name = $file['img']['name'];
        $file_size = $file['img']['size'];
        $file_temp = $file['img']['tmp_name'];

        // Check for empty fields
        if ($arr['imgname'] == "" || $arr['type'] == "" || $file_name == ""){
            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Field cannot be empty</div>";
        }

        $sourceProperties = getimagesize($file_temp);

        $folder = "gallery/$email/";

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
            $query = "INSERT INTO gallery(user_email,img_name,img_slug,img_type,img) 
            VALUES(:email, :imgname, :imgslug, :type, :unique_image) ";

            $insert_row = $this->con->insert($query,$arr);
            if($insert_row){
                return "<div class='alert alert-success text-white' style='font-size: 14px;'>Image Inserted Successfully.</div>";
               
            }else{
                return "<div class='alert alert-danger text-white'>Error inserting product.</div>";
                
            }

        }   

    }

    public function getSellerGallery($email){

        $arr = array();
        $arr['email'] = $email;

        $query = "SELECT * FROM gallery WHERE user_email = :email ORDER BY gallery_id DESC ";
        return $this->con->select($query, $arr);
    }

    public function delGalleryBySlug($slug){

        $arr = array();
        $arr['slug'] = $slug;

        $query = "SELECT * FROM gallery WHERE img_slug = :slug ";
        $getData = $this->con->select($query,$arr);
        if($getData){
            foreach($getData as $delImg){
                unlink($delImg['img']);
            }
                
        }
        

        $delquery = "DELETE FROM gallery WHERE img_slug = :slug LIMIT 1 ";
        $deldata = $this->con->delete($delquery, $arr);
        if($deldata){
            return "<div class='alert alert-success text-white'>Deleted Successfully.</div>";
            
        }else{
            return "<div class='alert alert-danger text-white'>Not deleted.</div>";
        } 
    }

    public function getSellerGal($info){
        $arr = array();
        $arr['info'] = $info;

        $query = "SELECT * FROM gallery LEFT JOIN sellers ON sellers.email = gallery.user_email WHERE sellers.biz_slug = :info ORDER BY gallery_id DESC ";
        return $this->con->select($query,$arr);
    }

}