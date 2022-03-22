<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin Login</title>
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
		html, body {
			font-family: "Lato", sans-serif;
			background-image: url("../assets/img/keycloak-bg.png");
			width: 100%;
			height: 100%;
		}
		.container {
			width: inherit;
			height: inherit;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.container .logo {
			margin: 0 64px 0 0;
			/*text-align: right;*/
		}
		.logo h4 {
			padding-top: 5px;
			color: #8f8f8f;
		}
		.login-input{
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.login-form-wrapper {
			padding: 40px;
			min-width: 360px;
			background: rgba(255, 255, 255, 0.15);
			box-shadow: 0 8px 32px 0 rgba(255, 255, 255, 0.25);
			border-radius: 24px;
			border: 1px solid rgba(255, 255, 255, 0.2);
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.login-input label {
			margin-bottom: 8px;
			color: #fff;
			font-weight: bold;
		}
		.login-input input {
			border: none;
			outline: none;
			border-radius: 8px;
			font-size: 16px;
			line-height: 24px;
			vertical-align: middle;
			padding: 8px 16px;
			margin-bottom: 16px;
		}
		#usernameRequiredMessage {
			display: none;
			color: red;
			font-weight: 700;
		}
		#passwordRequiredMessage {
			display: none;
			color: red;
			font-weight: 700;
		}
		.login-button {
			border: none;
			outline: none;
			border-radius: 8px;
			font-size: 16px;
			line-height: 24px;
			vertical-align: middle;
			padding: 8px 16px;
			background: #0188ce;
			color: #fff;
			font-weight: 700;
		}

	</style>

</head>
<body>
<div class="container">
	<div class="logo">
		<img src="<?php echo base_url()."assets/img/geoid_logo.jpeg"; ?>" height="70">
		<h4>Digital Web Office</h4>
	</div>
<!--	<form id="loginForm" class="login-form-wrapper">-->
<!--		<div class="login-input">-->
<!--			<label for="username">Username or email:</label>-->
<!--			<input autocomplete="off" id="username" type="text" name="username" />-->
<!--			<p id="usernameRequiredMessage">Username or email is required</p>-->
<!--		</div>-->
<!--		<div class="login-input">-->
<!--			<label for="password">Password:</label>-->
<!--			<input autocomplete="off" id="password" type="password" name="password" />-->
<!--			<p id="passwordRequiredMessage">Password is required</p>-->
<!--		</div>-->
<!--		<input id="loginButton" class="login-button" type="submit" value="Log In" />-->
<!--	</form>-->
	<form class="login-form-wrapper" id="login" name="login" method="post">
		<div class="login-input">
			<label for="username">Username or email:</label>
			<input type="text" placeholder="Email / Mobile No." id="tu" name="tu" />
			<p id="usernameRequiredMessage">Username or email is required</p>
		</div>
		<div class="login-input">
			<label for="password">Password:</label>
			<input id="tp" name="tp" placeholder="Password" />
			<p id="passwordRequiredMessage">Password is required</p>
		</div>
		<input class="login-button" type="submit" value="Log In" />
	</form>
</div>
</body>
<!-- base:js -->
<script src="<?=base_url('assets/vendors/base/vendor.bundle.base.js')?>"></script>
<!-- endinject -->
<script src="<?=base_url('assets/js/template.js')?>"></script>
<script src="<?=base_url('assets/js/crypto-js/crypto-js.js')?>"></script>
<script src="<?=base_url('assets/js/mamba.js')?>"></script>
<script>

</script>
</html>
