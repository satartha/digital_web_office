<style>
	@media (min-width: 768px) {
		#login-container {
			margin-left: 85px;
		}
	}

	@media (min-width: 1400px) {
		#login-container {
			margin-left: 110px;
		}
	}

	#login-container {
		/* margin-left:110px; */
		height: 200px;
		width: 350px;
		padding: 20px;
		border-radius: 5px;
		background: #fffffb;
		position: relative;
		box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
	}

	#login-container .profile-img {
		height: 70px;
		width: 70px;
		position: absolute;
		top: -25px;
		left: -25px;
		border-radius: 50%;
		box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
	}

	#login-container h1 {
		font-family: 'Sriracha', arial, sans-serif;
		text-align: center;
		margin-bottom: 20px;
		color: #ff4f00;
	}

	#login-container .social {
		display: flex;
		justify-content: space-between;
		align-items: center;
		width: calc(100% - 40px);
		margin: 0 auto;
		margin-top: 30px;
	}

	#login-container .social a {
		text-align: center;
		border: solid 2px #ff6b6c;
		width: 75px;
		padding: 5px 0;
		border-radius: 5px;
	}

	#login-container .social a:hover {
		background: #ff6b6c;
		color: white;
		cursor: pointer;
	}

	#login-container button:active {
		box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.5);
		transform: translateY(4px);
	}

	#img1 {
		background: url('./assets/img/formicon/sstate1.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	#img2 {
		background: url('./assets/img/formicon/zilla1.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	#img3 {
		background: url('./assets/img/formicon/mandal1.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	#img4 {
		background: url('./assets/img/formicon/skendra1.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	#img5 {
		background: url('./assets/img/formicon/booth1.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	#img6 {
		background: url('./assets/img/formicon/tour.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	#img7 {
		background: url('./assets/img/formicon/datatype.png');
		background-size: cover;
		background-position: center;
		background-color: #ffff;
	}

	@-webkit-keyframes gradientBG {
		0% {
			background-position: 0% 50%;
		}

		100% {
			background-position: 100% 50%;
		}
	}

	@keyframes gradientBG {
		0% {
			background-position: 0% 50%;
		}

		100% {
			background-position: 100% 50%;
		}
	}

	#main {
		margin: 50px 0;
	}

	#main #faq .card {
		margin-bottom: 30px;
		border: 0;
	}

	#main #faq .card .card-header {
		border: 0;
		-webkit-box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
		box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
		border-radius: 2px;
		padding: 0;
	}

	#main #faq .card .card-header .btn-header-link {
		color: #fff;
		display: block;
		text-align: left;
		background: #FFE472;
		color: #222;
		padding: 20px;
	}

	#main #faq .card .card-header .btn-header-link:after {
		content: "\f107";
		font-family: 'Font Awesome 5 Free';
		font-weight: 900;
		float: right;
	}

	#main #faq .card .card-header .btn-header-link.collapsed {
		background: #A541BB;
		color: #fff;
	}

	#main #faq .card .card-header .btn-header-link.collapsed:after {
		content: "\f106";
	}

	#main #faq .card .collapsing {
		background: #FFE472;
		line-height: 30px;
	}

	#main #faq .card .collapse {
		border: 0;
	}

	#main #faq .card .collapse.show {
		background: #FFE472;
		line-height: 30px;
		color: #222;
	}

	.filelabel {
		border: 2px dashed grey;
		border-radius: 5px;
		display: block;
		padding: 20px;
		transition: border 300ms ease;
		cursor: pointer;
		text-align: center;
		margin: 0;
	}

	.filelabel i {
		display: block;
		font-size: 30px;
		padding-bottom: 5px;
	}

	.filelabel i,
	.filelabel .title {
		color: grey;
		transition: 200ms color;
	}

	.filelabel:hover {
		border: 2px solid #FF4F00;
	}

	.filelabel:hover i,
	.filelabel:hover .title {
		color: #FF4F00;
	}

	#FileInput {
		display: none;
	}

	/*.right{*/
	/*	float: right;*/
	/*}*/
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-sm-3 ">
					<div class="top_info">Action</div>
					<hr class="mod_hr">
					<div class="container collapse_div">
						<div class="col_div" href="#demo" data-toggle="collapse"><i class="mdi mdi-folder"></i> <span id="com_name"></span> <i class="mdi mdi-menu-down right" style="font-size: 20px;"></i></div>
						<div id="demo" class="collapse">
							<!-- <ul >
								<li>
									<div class="col_div" href="#demo2" data-toggle="collapse"><i class="mdi mdi-folder"></i> sub collapsible</div>
									<div id="demo2" class="collapse">
									<ul>
										<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>
										<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>
									</ul>
									</div>
								</li>

							</ul> -->
							<ul id="loadsub01">


							</ul>
						</div>


					</div>
				</div>
				<div class="col-sm-6">
					<div class="top_info">Folder Information</div>
					<hr class="mod_hr">
					<table class="table table-condensed table-sm">
						<tbody>
							<tr>
								<td class="inn_padding">Name:</td>
								<td class="inn_padding"><a id='owner_nm'>Administrator</a></td>
							</tr>
							<tr>
								<td class="inn_padding">Created:</td>
								<td class="inn_padding" id='cr_dt'>24-01-22 12:01:53</td>
							</tr>
							<!-- <tr>
								<td class="inn_padding">Comment:</td>
								<td class="inn_padding">Billing Detail of January 2022</td>
							</tr> -->
						</tbody>
					</table>
				</div>
				<div class="col-sm-3">
					<div class="top_info">Fast Upload</div>
					<div>
						<span id="showpth" style=" display:none;color:#ff4f00"></span>
					</div>
					<hr class="mod_hr">
					<label class="filelabel">
						<i class="mdi mdi-paperclip"></i>
						<span class="title">Add File</span>
						<input class="FileUpload1" id="FileInput" name="booking_attachment" type="file" />
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9 offset-3">
					<div class="top_info">Folder Content</div>
					<hr class="mod_hr">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th></th>
								<th style="width:40%">Name</th>
								<th>Status</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody id="fld_dt">


						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Status</th>
								<th>Action</th>

							</tr>
						</tfoot>
					</table>
				</div>
			</div>


</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(".col_div").click(function() {
		$(this).find(".right").toggleClass("mdi-menu-down mdi-menu-up");
	});
</script>