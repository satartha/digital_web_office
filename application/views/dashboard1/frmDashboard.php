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
  color: #072247;
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
		/*color: grey;*/
		transition: 200ms color;
	}
	.filelabel:hover {
		border: 2px solid #072247;
	}
	.filelabel:hover i,
	.filelabel:hover .title {
		color: #072247;
	}
	#FileInput{
		display:none;
	}
	.file-drop-area {
		position: relative;
		display: flex;
		align-items: center;
	}

	.choose-file-button {
		flex-shrink: 0;
		background-color: rgba(255, 255, 255, 0.04);
		border: 1px solid rgba(255, 255, 255, 0.1);
		border-radius: 3px;
		padding: 8px 15px;
		/*margin-right: 10px;*/
		font-size: 12px;
		text-transform: uppercase;
	}

	.file-message {
		/*font-size: small;*/
		/*font-weight: 300;*/
		line-height: 1.4;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis
	}

	.file-input {
		position: absolute;
		left: 0;
		top: 0;
		height: 100%;
		width: 100%;
		cursor: pointer;
		opacity: 0;
		display: block !important;
	}
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--<div class="container-fluid page-body-wrapper">-->
<!--	<div class="main-panel">-->
<!--		<div class="content-wrapper">-->
<!--			<div class="row">-->
<!--				<div class="col-sm-3 ">-->
<!--					<div class="top_info">Action</div>-->
<!--					<hr class="mod_hr">-->
<!--					<div class="container collapse_div">-->
<!--						<div class="col_div" href="#demo" data-toggle="collapse"><i class="mdi mdi-folder"></i> Simple collapsible <i class="mdi mdi-menu-down right" style="font-size: 20px;"></i></div>-->
<!--						<div id="demo" class="collapse">-->
<!--							<ul>-->
<!--								<li>-->
<!--									<div class="col_div" href="#demo2" data-toggle="collapse"><i class="mdi mdi-folder"></i> sub collapsible</div>-->
<!--									<div id="demo2" class="collapse">-->
<!--									<ul>-->
<!--										<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>-->
<!--										<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>-->
<!--									</ul>-->
<!--									</div>-->
<!--								</li>-->
<!---->
<!--							</ul>-->
<!--						</div>-->
<!--						<div class="col_div" href="#demo1" data-toggle="collapse"><i class="fa fa-facebook"></i><i class="mdi mdi-folder"></i> Simple collapsible <i class="mdi mdi-menu-down right" style="font-size: 20px;"></i></div>-->
<!--						<div id="demo1" class="collapse">-->
<!--							<ul>-->
<!--								<li>-->
<!--									<div class="col_div" href="#demo3" data-toggle="collapse"><i class="mdi mdi-folder"></i> sub collapsible</div>-->
<!--									<div id="demo3" class="collapse">-->
<!--										<ul>-->
<!--											<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>-->
<!--											<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>-->
<!--										</ul>-->
<!--									</div>-->
<!--								</li>-->
<!---->
<!--							</ul>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-9">
						<div class="top_info">Folder Information</div>
					<hr class="mod_hr">
					<table class="table table-condensed table-sm">
						<tbody>
							<tr>
								<td class="inn_padding">Owner:</td>
								<td class="inn_padding" ><a id='owner_nm'>Administrator</a></td>
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
							<hr class="mod_hr">
							<form method="post" enctype="multipart form-data" id="fast_upload">
							<label class="filelabel file-drop-area">
								<i class="mdi mdi-paperclip choose-file-button"></i>
								<span class="title file-message"><b>Choose a File</b> or drag it here.</span>
								<input class="FileUpload1 file-input" id="FileInput" name="booking_attachment" type="file"/>
							</label>
                            </form>
						</div>
					</div>

					<div class="top_info">Folder Content</div>
					<hr class="mod_hr">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
						<tr>
						    <th></th>
							<th  style="width:40%">Name</th>
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

			<div class="row" style="padding-top:10px">

				<div class="col-3">
					<ul id="loadsub0">
					</ul>
				</div>
				<div class="col-9">

					<div class="row">

						<div class="col-4">
            <a href="<?php echo base_url()."Upload_doc/upload_form" ?>"><button type='button' id='file_upload_btn' class='btn btn-primary'><i class="mdi mdi-plus" style="font-size:18px;color:#ffffff"></i>Upload Document</button></a>

            <span id="showpth"  style=" display:none;color:#072247"></span>



						</div>
						<div class="col-8" id="show" style="display:none;">

							<form id="frmDirct" method='post' name='frmDirct'>
								<div class='row'>
									<div class='col-6'>
										<input type='text' placeholder='Enter Folder Name' id='cd' name='cd' class='form-control'>
										<input type='hidden' id='dname' name='dname' value=''>
									</div>
									<div class='col-3'>
										<button type='submit' class='btn btn-primary' id='btnSubmit'>Create</button>
									</div>
									<div class='col-3'>
										<button type='button' class='btn btn-danger' id='btnClose'>Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				    <div class="row" id="loadfile" style="padding-top:10px">
					</div>
				</div>
				
			</div>
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(".col_div").click(function () {
		$(this).find(".right").toggleClass("mdi-menu-down mdi-menu-up");
	});
	$(document).on('change', '.file-input', function() {


		var filesCount = $(this)[0].files.length;

		var textbox = $(this).prev();

		if (filesCount === 1) {
			var fileName = $(this).val().split('\\').pop();
			textbox.text(fileName);
		} else {
			textbox.text(filesCount + ' files selected');
		}
	});
</script>
