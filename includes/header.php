<?php
 include "connect/Session.php";
Session::init();

include 'connect/Database.php';
include 'lib/format.php';

spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
});

$db = new Database();
$format = new Format();

$admin = new Admin();
$user = new User();

?>

<?php

    $visitor_ip = $_SERVER['REMOTE_ADDR'];

    $total_visitors = "";

    $query = "SELECT count(counter_id) as total FROM visitors WHERE ip_address = '$visitor_ip' ";
    $result = $db->select($query);

    if ($result) {
        $total_visitors = $result[0]['total'];
    }

    if ($total_visitors < 1) {
        $query = "INSERT INTO visitors (ip_address) VALUES ('$visitor_ip') ";
        $result = $db->insert($query);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/logo/logoa.png" />
    <title>SHOP WISE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/55ffce7a75.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css"/>
</head>
<body>

    <div id="popUp" style="display: none;">
        <div id="pop">
            <div class="lo text-center">
                <img src="/img/logo/logo.jpg" alt="">
            </div>
            <div class="header">Welcome To SUREMARTS</div>
            <div class="body">
                <p>
                    A Marketplace for Buyers, Sellers & Business Owners.
                </p>
                <p>
                    <strong>SUREMARTS</strong> is a marketplace where you showcase your products or what you do to the world.
                </p>
                <p>
                    We hope you find what you are looking for.
                </p>
            </div>
            <div class="footer">
                <button type="button" class="submitId">Close</button>
            </div>
        </div>
    </div>
    <header>
        <!-- <div class="gif">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/1170x60.gif" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div> -->
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo">
                            <a href="/"><img src="/img/logo/logo.jpg" class="img-fluid" alt=""></a> 
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="search">
                            <form action="/search/" method="get">
                                <input type="text" class="input" name="search" placeholder="Search here">
                                <button type="submit" class="search-btn"><i class="lnr lnr-magnifier"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="navbar">
                            <!-- responsive-nav -->
                            <div id="responsive-nav">
                                <!-- NAV -->
                                <?php  

                                    $activePage = basename($_SERVER['PHP_SELF'], ".php");

                                ?>
                                <ul>
                                    <li class="<?= ($activePage == 'index') ? 'active':''; ?>"><a href="/">Home</a></li>
                                    <?php 
                
                                      $getCat = $admin->getAllCat();

                                      if($getCat){
                                       
                                        foreach ($getCat as $results) {
                                            
                                          $cat = $results['cat_name'];
                                          $url = filter_var($cat, FILTER_SANITIZE_URL);
                     
                                    ?>
                                    <li class="<?= ($activePage == '/category/<?=$url?>') ? 'active':''; ?> dropdown">
                                        <a href="/category/<?=$url?>"><?=$format->esc($results['cat_name'])?></a>
                                        <ul class="sub-menu">
                                            <?php  

                                                $getCat = $admin->getAllSubCats($cat);

                                                  if($getCat){
                                                   
                                                    foreach ($getCat as $results) {
                                                        $url = $results['subcat_name'];
                                                        $url = filter_var($url, FILTER_SANITIZE_URL);
                                            ?>
                                            <li><a href="/subcategory/<?=$url?>"><?=$format->esc($results['subcat_name'])?></a></li>
                                            <?php } } ?>
                                        </ul>
                                    </li>
                                    <?php } } ?>
                                    <li><a href="javascript:void">Services</a>
                                    <ul class="sub-menu">
                                        <li><a href="/travel">Travel Agency</a></li>
                                        <li><a href="/kwueton-services">A.C Maintenance</a></li>
                                    </ul>
                                    </li>
                                    <li><a href="/arts-gallery">Arts & Gallery</a></li>
                                </ul>
                                <!-- /NAV -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart header-ctn">
                            
                            <?php  
                            $login = Session::get("CusLogin");

                            if($login == false): ?>
                            <div>
                                <a href="/cart">
                                    <i class="lnr lnr-cart"></i>
                                    <div class="qty">
                                        <?php
                                            $getData = $user->numRow();
                                            
                                            if(isset($getData)){                                               
                                                echo $getData;
                                            }

                                        ?>
                                    </div>
                                </a>
                            </div>

                            <!-- <div>
                                <a href="#">
                                    <i class="fas fa-heart"></i>
                                    <div class="qty">
                                        
                                    </div>
                                </a>
                            </div> -->
                            <div class="dropdown-center">
                                
                                <button class="btn btn-secondary bg-white text-dark dropdown-toggle shadow-none border-0" type="button" id="dropdownCenterBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i style="font-size: 20px;" class="lnr lnr-user"></i> <span style="font-size: 15px;">Account</span>
                                </button>
                                <ul class="dropdown-menu p-3" aria-labelledby="dropdownCenterBtn">
                                    <li><a class="dropdown-item text-center button" href="/login">SIGN IN</a></li><hr>
                                    <li><a class="dropdown-item pb-3" href="/customer"><i class="lnr lnr-user" style="color: #333;"></i>&nbsp;&nbsp; My Account</a></li>
                                    <li><a class="dropdown-item" href="/view-orders"><i class="lnr lnr-briefcase"></i>&nbsp;&nbsp; Orders</a></li>
                                </ul>
                                
                            </div> 

                            <?php elseif ($login == true): ?>
                                <div>
                                    <a href="/cart">
                                        <i class="fas fa-shopping-basket"></i>
                                        <div class="qty">
                                            <?php
                                                $getData = $user->numRow();
                                                
                                                if(isset($getData)){                                               
                                                    echo $getData;
                                                }

                                            ?>
                                        </div>
                                    </a>
                                </div>
                                <!-- <div>
                                    <a href="#">
                                        <i class="fas fa-heart"></i>
                                        <div class="qty">
                                            
                                        </div>
                                    </a>
                                </div> -->

                                <div class="dropdown-center">
                                
                                    <button class="btn btn-secondary bg-white text-dark dropdown-toggle shadow-none border-0" type="button" id="dropdownCenterBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i style="font-size: 18px;color: #333;" class="lnr lnr-user-check"></i> <span style="font-size: 14px;font-weight: 600;">Hi, <?=Session::get("UserFname")?></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownCenterBtn">
                                        <li><a class="dropdown-item pb-3" href="/customer"><i class="lnr lnr-user" style="color: #333;"></i>&nbsp;&nbsp; My Account</a></li>


                                        <li><a class="dropdown-item pb-2" href="/view-orders"><i class="lnr lnr-briefcase" style="color: #333;"></i>&nbsp;&nbsp; Orders</a></li><hr>

                                        <li><a class="dropdown-item" href="/logout"><i class="fas fa-power-off" style="color: #333;"></i>&nbsp;&nbsp; Logout</a></li>
                                    </ul>
                                    
                                </div> 
                                
                            <?php endif; ?>
                            
                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="lnr lnr-menu"></i>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>