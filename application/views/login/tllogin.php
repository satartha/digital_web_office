<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Digital Office</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?=base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/vendors/base/vendor.bundle.base.css')?>">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.png')?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <h1 class="animate__animated animate__bounce" style="color:#072247"><b>Digital Office</b></h1>
              </div>
              <h4>Welcome back!</h4>
              <h6 class="font-weight-light">Happy to see you again! <i class="mdi mdi-emoticon" style="color:#072247;"></i> </h6>
              <h6 class="font-weight-light">Login as Staff <i class="mdi mdi-emoticon" style="color:#072247;"></i> </h6>
              <form class="pt-3" id="login" name="login" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail">Email / Mobile No.</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="tu" name="tu" placeholder="Email / Mobile No.">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="exampleInputEmail">Softphone Id</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-phone-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="si" name="si" placeholder="Softphone Id">
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="tp" name="tp" placeholder="Password">
					  <div class="input-group-append bg-transparent" style="border-right:1px solid;">
						  <span class="input-group-text bg-transparent border-right-0">
							<i class="mdi mdi-eye-off mdi-eye" id="tpwd" style="color: #072247;cursor: pointer"></i>
						  </span>
					  </div>
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="<?=base_url('Forgotpwd')?>" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <div class="my-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020  All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- base:js -->
  <script src="<?=base_url('assets/vendors/base/vendor.bundle.base.js')?>"></script>
  <!-- endinject -->
  <script src="<?=base_url('assets/js/template.js')?>"></script>
  <script src="<?=base_url('assets/js/crypto-js/crypto-js.js')?>"></script>
  <script src="<?=base_url('assets/js/mamba.js')?>"></script>
  <!-- endinject -->
</body>
</html>
