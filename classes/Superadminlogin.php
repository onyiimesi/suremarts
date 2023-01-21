<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../connect/Session.php');
Session::checkLogin();

include_once ($filepath.'/../connect/Database.php');
include_once ($filepath.'/../lib/format.php');



/**
 * Admin Login
 */
class Superadminlogin{

    private $con;
    private $format;

    public function __construct(){
       $this->con = new Database();
       $this->format = new Format();

    }

    public function adminLogin($data){

        $adminUser = $this->format->validation($data['sup_email']);
        $adminPass = $this->format->validation($data['sup_password']);

        $arr = array();
        $arr['sup_email'] = $data['sup_email'];
        $arr['sup_password'] = md5($data['sup_password']);

        $adminPass = $arr['sup_password'] = md5($data['sup_password']);

        if(empty($arr['sup_email']) || empty($data['sup_password'])){?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php

            return "<div class='alert alert-danger text-white'>Username or sup_password must not be empty</div>";
  
        }else{
            $query = "SELECT * FROM sup_admin WHERE sup_email = :sup_email AND sup_password = :sup_password ";
            $result = $this->con->select($query,$arr);

            if($result != false){

                foreach($result as $value){
                    Session::set("adminlogin", true);
                    Session::set("id", $value['id']);
                    Session::set("sup_email", $value['sup_email']);
                    Session::set("role", $value['role']);
                }
                
                header("Location: /admin/");
            }else{
                return "<div class='alert alert-danger text-white'>Username or Password do not match</div>";
    
            }
        }
    }

}
