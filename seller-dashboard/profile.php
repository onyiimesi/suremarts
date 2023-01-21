<?php include "inc/header.php"; ?>

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
          </ol>
          <h6 class="text-white font-weight-bolder ms-2">Profile</h6>
        </nav>
        <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>


      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <?php 
        
             
            $getProfile = $user->getSellerProfile();

            if($getProfile){
              $i = 0;
              foreach ($getProfile as $results) {
                $i++;

          ?>
          <div class="col-auto">
            <!-- <div class="avatar avatar-xl position-relative">
              <img src="assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div> -->
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?=$results['fname']?> <?=$results['lname']?>
              </h5>
            </div>
          </div>
          <?php } } ?>  
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <?php 
        
             
          $getProfile = $user->getSellerProfile();

          if($getProfile){
            $i = 0;
            foreach ($getProfile as $results) {
              $i++;

        ?>
        <div class="col-12 col-xl-12">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="edit-profile?edit=<?=$results['email']?>">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                <?=$results['description']?>
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?=$results['fname']?> <?=$results['lname']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?=$results['phone_number']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?=$results['email']?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; <?=$results['address']?></li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="<?=$results['facebook']?>">
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="<?=$results['twitter']?>">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="<?=$results['instagram']?>">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>

                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Copy Profile Link:</strong> 
                  <div class="containerss">
                    <div id="inviteCode" class="invite-page">
                      <input id="link" value="http://shopwise.web/seller/<?=urlencode($results['biz_name'])?>" readonly>
                      <div id="copy">
                        <i class="fa fa-clipboard" aria-hidden="true" data-copytarget="#link"></i>
                      </div>
                    </div>
                  </div>

                </li>
              </ul>
            </div>
          </div>
        </div>
        <?php } } ?>
      </div>



<?php include "inc/footer.php"; ?>