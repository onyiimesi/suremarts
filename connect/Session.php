<?php 
/**
 * Session Class
 */

 ob_start();

class Session{
    public static function init(){
        session_start();
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        } else{
            return false;
        }
    }


    public static function checkAdminSession(){
        
        self::init();
        if(self::get("adminlogin") == false){
            self::destroy();
            header("Location: /admin/login");
        }
    }


    public static function checkLogin(){
        self::init();
        if(self::get("adminlogin") == true){
            header("Location: admin");
        }
    }

    public static function checkSellerLogin(){
        self::init();
        if(self::get("sellerlogin") == false){
            self::destroy();
            header("Location: /seller-dashboard/sign-in");
        }
    }

    public static function checkSLogin(){
        self::init();
        if(self::get("sellerlogin") == true){
            header("Location: /seller-dashboard/dashboard");
        }
    }

    public static function destroy(){
        session_destroy();
        header("Location: login");
    }
}


?>