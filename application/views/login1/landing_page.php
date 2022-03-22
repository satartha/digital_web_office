<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Digital Web Office</title>
	<!-- base:css -->
	<link rel="stylesheet" href="<?=base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/base/vendor.bundle.base.css')?>">
	<!-- endinject -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
	<!-- endinject -->
	<link rel="shortcut icon" href="<?=base_url('assets/images/favicon.png')?>" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/dist/css/bootstrap.min.css')?>">
	<!-- CSS only -->
	<style>
		.main_div{
			margin-top: 27vh;
		}
		.card:hover{
			opacity: 0.8;
		}
		.card_img:hover{
			transform: translateY(-5px);
		}
		body{
			background-image: url('<?php echo base_url()."assets/img/backimg.png"; ?>') !important;
		}
		.card{
			border: none;
		}
	</style>
</head>
<body style="background: #ececec;background-position: center bottom;background-repeat: no-repeat;background-size: cover;height: 100vh;">
<div class="container">
	<div class="col-sm-12 main_div">
		<h2 class="text-center mb-5" style="font-weight: bold;font-size: 35px;color: #d74d0f;">WELCOME TO <br> DIGITAL WEB OFFICE</h2>
		<div class="row text-center">
			<div class="col-sm-4 card_img">
				<a href="<?=base_url('Welcome/c_login')?>">
					<div class="card" style="background-image:linear-gradient(0deg, rgba(6, 6, 6, 0.61), rgba(6, 6, 6, 0.09)), url('<?php echo base_url()."assets/img/company.jpg"; ?>');height: 15vh;border-radius: 10px;background-position: center;background-size: cover;">
						<span class="text-white" style="position: absolute;bottom: 20px;left: 15px;font-size: 20px;">Login As Company &nbsp;-></span>
					</div>
				</a>
			</div>
			<div class="col-sm-4 card_img">
				<a href="<?=base_url('Welcome/admin')?>">
					<div class="card" style="background-image:linear-gradient(0deg, rgba(6, 6, 6, 0.61), rgba(6, 6, 6, 0.09)), url('<?php echo base_url()."assets/img/admin.jpg"; ?>');height: 15vh;border-radius: 10px;background-position: center;background-size: cover;">
						<span class="text-white" style="position: absolute;bottom: 20px;left: 15px;font-size: 20px;">Login As Admin &nbsp;-></span>
					</div>
				</a>
			</div>
			<div class="col-sm-4 card_img">
				<a href="<?=base_url('Welcome/user')?>">
					<div class="card" style="background-image:linear-gradient(0deg, rgba(6, 6, 6, 0.61), rgba(6, 6, 6, 0.09)), url('<?php echo base_url()."assets/img/staff.jpg"; ?>');height: 15vh;border-radius: 10px;background-position: center;background-size: cover;">
						<span class="text-white" style="position: absolute;bottom: 20px;left: 15px;font-size: 20px;">Login As Staff &nbsp;-></span>
					</div>
				</a>
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
