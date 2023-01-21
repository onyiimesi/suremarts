<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../connect/Session.php');
Session::checkSLogin();

include_once ($filepath.'/../connect/Database.php');
include_once ($filepath.'/../lib/format.php'); 


/**
 * Admin Login
 */
class Sellerlogin{

    private $con;
    private $format;

    public function __construct(){
       $this->con = new Database();
       $this->format = new Format();

    }

    public function sellerLogin($data){

        $arr = array();
        $arr['email'] = $data['email'];
        $password = $data['password'];

        if(empty($arr['email']) || empty($data['password'])){?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <?php

            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Email or password must not be empty</div>";
  
        }

        $verifys = "SELECT * FROM sellers WHERE email = :email AND status = 'in-active' LIMIT 1 ";
        $resultss = $this->con->select($verifys,$arr);

        if ($resultss != false) {

            return "<div class='alert alert-danger text-white' style='font-size: 14px;'>Your Account Has Been Deactivated.</div>";

        }

        $verify = "SELECT * FROM sellers WHERE email = :email AND status = 'active' LIMIT 1 ";
        $results = $this->con->select($verify,$arr);

        if ($results) {
            foreach($results as $value){

                if(password_verify($password, $value['password'])) {
                    Session::set("sellerlogin", true);
                    Session::set("seller_id", $value['seller_id']);
                    Session::set("email", $value['email']);
                    Session::set("fname", $value['fname']);
                    Session::set("lname", $value['lname']);

                    header("Location: /seller-dashboard/dashboard");
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

}
