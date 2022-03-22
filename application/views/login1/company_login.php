<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Company Login</title>
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
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}

		body {
			width: 100%;
			min-height: 100vh;
			background: linear-gradient(-45deg, rgba(255, 137, 84, 0.82), rgba(208, 64, 0, 0.83));
			display: grid;
			place-items: center;

		}
		.box{
			height: 600px;
			width: 350px;
			background: linear-gradient(-45deg, #ff8954, #d04000);
			position: relative;
			overflow: hidden;
			border-radius: 10px;
			box-shadow: 0 0 10px 2px rgb(255,255,255,0.4);
		}
		.graphic1{
			height: 180px;
			width: 200px;
			background: #d74d0f;
			position: absolute;
			top: -120px;
			right: 20px;
			transform: rotate(45deg);
			border-radius: 20px;
			box-shadow: 0 0 10px 2px rgb(255,255,255,0.4);
		}
		.graphic2{
			height: 600px;
			width: 180px;
			background: #d74d0f;
			position: absolute;
			top: -100px;
			right: -15%;
			transform: rotate(45deg);
			border-radius: 30px;
			box-shadow: 0 0 10px 2px rgb(255,255,255,0.4);
		}
		.graphic3{
			height: 300px;
			width: 250px;
			background: #ea5512;
			position: absolute;
			right: -30px;
			bottom: -160px;
			transform: rotate(45deg);
			border-radius: 30px;
			box-shadow: 0 0 10px 2px rgb(255,255,255,0.4);
		}
		.graphic4{
			height: 600px;
			width: 500px;
			position: absolute;
			background: #fff;
			transform: rotate(135deg);
			position: absolute;
			left:-300px ;
			top: -100px;
			border-radius: 100px 0 0 0;
			box-shadow: 0 0 10px 2px rgb(255,255,255,0.4);

		}
		form{
			position: absolute;
			width: 220px;
			top: 150px;
			left: 30px;
		}
		form span{
			margin-bottom: 30px;
			display: block;
			width: 100%;
			border-bottom: 2px solid grey;
		}
		form span input{
			border: none;
			margin-left: 10px;
			height: 1.5rem;

		}
		form span input:focus{
			outline: none;
		}
		form span ion-icon{
			font-size: 18px;
			color: #ea5512;
		}

		.box .social{
			position: absolute;
			bottom: 60px;
			right: 30px;
			color: #fff;
			font-family: 'nunito',sans-serif;

		}
		.social ion-icon{
			margin-top: 15px;
			font-size: 18px;
			margin-right: 10px;
		}

		.box button{
			position: absolute;
			border: 2px solid grey;
			background: #fff;
			top: 60%;
			left: 10%;
			width: 230px;
			color: #ea5512;
			font-weight: bolder;
			font-size: 1.2rem;
			border-radius: 30px;
			padding: 6px;
			box-shadow: -2px 5px 10px 2px rgba(234, 85, 18, 0.36);
		}
		button ion-icon{
			font-size: 1.5rem;
			float: right;
			margin-right:20px ;
			width: 20%;
		}
		a{
			color: #fff;
			text-decoration: none;
		}
	</style>

</head>
<body>
<div class="box">
	<div class="graphic1"></div>
	<div class="graphic2"></div>
	<div class="graphic3"></div>
	<div class="graphic4"></div>

	<form id="login" name="login" method="post">

		<span>
			<ion-icon name="person-outline"></ion-icon>
			<input type="text" placeholder="Email / Mobile No." id="tu" name="tu">
        </span>
		<span>
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" id="tp" name="tp" placeholder="Password">
        </span>
		<span style="border-bottom: none;">
            <a href="<?=base_url('Forgotpwd')?>" class="auth-link text-black">Forgot password?</a>
        </span>
		<button type="submit" style="top: 25vh;">
			Company LOGIN
			<ion-icon name="chevron-forward-outline"></ion-icon>

		</button>

	</form>



	<div class="social">
		<p>LOG IN VIA</p>
		<a href="#"> <ion-icon name="logo-instagram"></ion-icon></a>
		<a href="#"> <ion-icon name="logo-facebook"></ion-icon></a>
		<a href="#"> <ion-icon name="logo-google"></ion-icon></a>
	</div>

</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
<!-- base:js -->
<script src="<?=base_url('assets/vendors/base/vendor.bundle.base.js')?>"></script>
<!-- endinject -->
<script src="<?=base_url('assets/js/template.js')?>"></script>
<script src="<?=base_url('assets/js/crypto-js/crypto-js.js')?>"></script>
<script src="<?=base_url('assets/js/mamba.js')?>"></script>

</html>
