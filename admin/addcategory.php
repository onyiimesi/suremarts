<?php include "inc/header.php"; ?>
  <?php include "../classes/Admin.php"; ?>
  <?php include "function.php"; ?>


  <?php 
    
     $admin = new Admin();

     $format = new Format();

     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category'])){

        $insertcat = $admin->addCategory($_POST, $_FILES);
     }

  
  
  ?>

  <?php 
      
    if(isset($_GET['delcat'])){

      $id = $_GET['delcat'];
      
      $delcat = $admin->delCat($id);
    }
  
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Category</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Category</h6>
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
        <div class="col-lg-6 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Create Category</h6>
            </div>

            

            <div class="card-body">
              <?php  

              if (isset($insertcat)) {
                echo $insertcat;
                }

              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <input type="text" class="form-control border ps-3 pe-3 pt-3 pb-3" name="cat_name" placeholder="Category Name">
                  <label for="">Image</label>
                  <input type="file" class="form-control border ps-3 pe-3 pt-3 pb-3" name="cat_img">
                  <button type="submit" name="category" class="btn btn-success mt-3">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Category List</h6>
            </div>
            <div class="card-body p-3">
              <?php  

              if (isset($delcat)) {
                echo $delcat;
                }

              ?>
              <div class="table-responsive text-center">
                <table class="table table-hover">
                  <thead>
                    <th>S/N</th>
                    <th>Seller Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php 
                
                      $getCat = $admin->getAllCat();

                      if($getCat){
                        $i = 0;
                        foreach ($getCat as $results) {
                          $i++;
     
                    ?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$results['user_email']?></td>
                      <td><?=$format->esc($results['cat_name'])?></td>
                      <td><img src="<?=$results['cat_img']?>" width="50" height="50" alt=""></td>
                      <td><?=$format->formatDate($results['date_created'])?></td>

                      <td>

                        <?php  
                          $email = Session::get("sup_email");
                          if ($email == $results['user_email']){ ?>
                            
                            <a class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?')" href="?delcat=<?php echo $results['cat_id']; ?>">Delete</a>
                            <?php }else{ ?>
                              <a class="btn btn-danger btn-sm disabled">Delete</a>
                          <?php } ?>
                      </td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>













<?php include "inc/footer.php"; ?>