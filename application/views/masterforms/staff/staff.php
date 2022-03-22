<style>
    @media (min-width: 768px) {
        #login-container {
            margin-left: 85px;
        }
    }
    @media (min-width: 1400px) {
        #login-container {
            margin-left:110px;
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
  margin-top:30px;
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
#img1{
    background: url('./assets/img/formicon/sstate1.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
}
#img2{
    background: url('./assets/img/formicon/zilla1.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
}
#img3{
    background: url('./assets/img/formicon/mandal1.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
}
#img4{
    background: url('./assets/img/formicon/skendra1.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
}
#img5{
    background: url('./assets/img/formicon/booth1.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
}
#img6{
    background: url('./assets/img/formicon/tour.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
}
#img7{
    background: url('./assets/img/formicon/datatype.png');
    background-size: cover;
    background-position: center;
    background-color:#ffff;
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
	#FileInput{
		display:none;
	}
	/*.right{*/
	/*	float: right;*/
	/*}*/
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="card-header" style="background-color:#ff4f00">
							<h3 class="card-title text-white" > Staff Form</h3>
						</div>
						<div class="card-body">
							<form id="frmCandidate" enctype="multipart/form-data">	
								<div class="row">
                                <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Department</label>
											<select class="form-control" name="companydeptid" id="companydeptid">
												<option value="">Select</option>
											</select>
										</div>
									</div>

									<!-- <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Designation</label>
											<select class="form-control" name="designationid" id="designationid">
												<option value="">Select</option>
											</select>
										</div>
									</div> -->

									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Usertype</label>
											<select class="form-control" name="usertype" id="usertype">
												<option value="">Select</option>
											</select>
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                                        <input type="hidden" class="form-control" name="txtid" id="txtid" value="0">
										<div class="form-group">
											<label for="cn" class="control-label mb-1">Name</label>
											<input type="text" class="form-control" name="txtCnm" id="txtCnm" onclick="charachters_validate('txtCnm')" placeholder="Enter Candidate Name" required>
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="ace" class="control-label mb-1">Mobile</label>
											<input type="text" class="form-control" name="txtMob" id="txtMob" onclick="number_validate('txtMob')" placeholder="Enter Mobile Number" minlength="10" maxlength="10">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="adds" class="control-label mb-1">Address</label>
											<input type="text" class="form-control" name="txtAds" id="txtAds" onclick="address_validate('txtAds')" placeholder="Enter Candidate Address">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="mail" class="control-label mb-1">Email</label>
											<input type="email" class="form-control" name="txtMail" id="txtMail" onclick="email_validate('txtMail')" placeholder="Enter Candidate Email">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="gen" class="control-label mb-1">Gender</label>
											<select class="form-control" name="cboGender" id="cboGender">
												<option value="">Select</option>
											</select>
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Date of Birth</label>
											<input type="date" name="dob" id="dob" class="form-control">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="cast" class="control-label mb-1">Age</label>
											<input type="text" class="form-control" name="staff_age" id="staff_age" onclick="number_validate('staff_age')" placeholder="Enter Staff's Age">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="cast" class="control-label mb-1">Password</label>
											<input type="password" class="form-control" name="password" id="password" onclick="password_validate('password')" placeholder="Enter Staff's Password">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="img" class="control-label mb-1">Photo</label>
											<input type="file" id="txtPic" name="txtPic" class="form-control">
										</div>
									</div>
								</div>
								<br>
								<div class="text-right">
									<button type="reset" class="btn btn-danger btn-sm">Reset</button>
									<button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Create</button>
								</div>
							</form>
							<br>
						</div>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
					<div class="card card-secondary">
						<div class="card-header" style="background-color:#ff4f00">
							<h3 class="card-title text-white">Report</h3>
						</div>
						<div class="card-body">
							<table id="CReport" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th class="text-center">Sl#</th>
<!--									<th class="text-center">Type</th>-->
									<th class="text-center">Name</th>
									<th class="text-center">Department</th>
									<th class="text-center">Mobile</th>
									<th class="text-center">Email</th>
									<th class="text-center">Gender</th>
									<th class="text-center">DOB</th>
									<th class="text-center">Age</th>
									<th class="text-center">Image</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody id="cndrpt" class="text-center">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


