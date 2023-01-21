<?php include "inc/header.php"; ?>
  <?php include "../classes/Admin.php"; ?>
  <?php include "function.php"; ?>

  <?php 

    $admin = new Admin();

  ?>

  <?php 


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['about'])){

      $insertabout = $admin->aboutUs($_POST);
    }


  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add About</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Add About</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">


      <div class="row">
        <div class="col-lg-12">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Add About</h6>
            </div>
            <div class="card-body p-3">
              <?php  

                if (isset($insertabout)) {
                  echo $insertabout;
                }

              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <?php 
                
                  $getPro = $admin->getAbout();

                  if($getPro){
                    $i = 0;
                    foreach ($getPro as $results) {
                      $i++;
 
                ?>
                <div class="mb-3">
                  <label for="">Title</label>
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="about_title" placeholder="Title" value="<?=$results['about_title']?>">
                </div>

                <div class="mb-3">
                  <label for="">Description</label>
                  <textarea class="form-control border ps-3 pe-3 pt-3 pb-3" name="about_desc" placeholder="Description" id="editor" cols="30" rows="10"><?=$results['about_desc']?></textarea>
                </div>
                <?php } } ?>

                <button type="submit" class="btn btn-success mt-4" name="about">Add About</button>
              </form>
            </div>
          </div>
        </div>
      </div>










<?php include "inc/footer.php"; ?>