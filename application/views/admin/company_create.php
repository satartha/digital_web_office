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
							<h3 class="card-title text-white" > Company Details Entry Form</h3>
						</div>
						<div class="card-body">
                        <form id="frmEform2">
                                   <div class="row">
                                       <section style="width: 100%;">
                                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                                               <li class="nav-item waves-effect waves-light">
                                                   <a class="nav-link active a1" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Company Registration Data</a>
                                               </li>
                                              
                                           </ul>
                                           <div class="tab-content" id="myTabContent">
                                               <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                   <div class="row">
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                       
                                                       <input type="hidden" id="txtid" name="txtid" value="0" >    
                                                       <div class="form-group">
                                                                  
                                                               <label for="gen" class="control-label mb-1">Campany Name<span style="color:red;">*</span></label>
                                                               <input type="text" id="comName" name="comName" class="form-control"  placeholder="Enter Your Company Name."  required>
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                               
<!--                                                               <input type="hidden" id="txtPersonid" name="txtPersonid" value="0" >-->
                                                               <label for="name" class="control-label mb-1">Company Short Name<span style="color:red;">*</span></label>
                                                               <input type="text" id="comsrt" name="comsrt" class="form-control" placeholder="Enter Your Company Short Name."   required>
                                                           </div>
                                                       </div>
                                                       
                                                       <!-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                              
                                               <input type="hidden" id="txtPersonid" name="txtPersonid" value="0" >-->
                                                               <!-- <label for="name" class="control-label mb-1">Company Logo<span style="color:red;">*</span></label>
                                                               <input type="file" id="comlogo" name="comlogo" class="form-control"   required> -->
                                                           <!-- </div> -->
                                                       <!-- </div> -->
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                               <label for="mNo" class="control-label mb-1">Company Contact No.</label>
                                                               <input type="text" id="txtMobile" name="txtMobile" class="form-control"  placeholder="Enter Your Company Contact No." minlength="10" maxlength="10" required>
                                                               <span id="message"></span>
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                               <label for="wNo" class="control-label mb-1">Company code</label>
                                                               <input type="text" id="comcode" name="comcode" class="form-control"  placeholder="Enter Your Company Code" required>
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                               <label for="email" class="control-label mb-1">Company Email id</label>
                                                               <input type="email" id="txtEmail" name="txtEmail" class="form-control"  maxlength="100" placeholder="Enter Your Company Email Id" required>
                                                           </div>
                                                       </div>
                                                       <!-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                               <button type="button" class="btn btn-primary btn-sm" id="btnPUpdate" style="display: none;">Update Person</button>
                                                           </div>
                                                       </div> -->
                                                   </div>
                                                   <div class="row">
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                               <label for="gen" class="control-label mb-1">Contact Person</label>
                                                               <input type="text" id="conPer" name="conPer" class="form-control"  placeholder="Contact Person name" required>
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                       <div class="form-group">
                                                               <label for="gen" class="control-label mb-1">GST No.</label>
                                                               <input type="text" id="gst" name="gst" class="form-control" placeholder="Enter Company GST Number" >
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                           <label for="wNo" class="control-label mb-1">Registration No.</label>
                                                            <input type="text" id="regdno" name="regdno" class="form-control"  placeholder="Enter Your company Registration No.">
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                           <label for="mNo" class="control-label mb-1">PAN No.</label>
                                                            <input type="text" id="pan" name="pan" class="form-control"  placeholder="Enter Your Company Pan No." >
                                                            <span id="message"></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                           <div class="form-group">
                                                           <label for="wNo" class="control-label mb-1">Password</label>
                                                            <input type="password" id="txtpass" name="txtpass" class="form-control"  placeholder="Enter Your Company's login Password.">
                                                            <span id="message"></span>
                                                            </div>
                                                       </div>
                                                      
                                                       <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                           <div class="form-group">
                                                               <label for="address" class="control-label mb-1">Company Address</label>
                                                               <textarea type="text" rows="3" id="txtAddress" name="txtAddress" class="form-control" placeholder="Enter Your Company Adderss" maxlength="200" required></textarea>
                                                           </div>
                                                       </div>
                                                       <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                           <div class="form-group">
                                                               <label for="address" class="control-label mb-1">Company Logo</label>
                                                               <input type="file" rows="3" id="logo" name="logo" class="form-control"></input>
                                                           </div>
                                                       </div>

                                                       
                                                   </div>
                                                   <div class="text-right">
<!--                                                       <button type="reset" class="btn btn-primary btn-sm">Reset</button>-->
<!--                                                       <button type="button" class="btn btn-primary btn-sm" id="btnNext">Next</button>-->
<!--                                                       <button type="button" class="btn btn-primary btn-sm" id="btnPUpdate" style="display: none;">Update Person</button>-->
                                                   </div>
                                               </div>
                                             

                                               </div>
                                           </div>
                                           <div class="text-right">
                                               <button type="reset" class="btn btn-primary btn-sm">Reset</button>
                                               <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Create
												   <div id="crt" class="spinner-border" role="status" style="height: 15px;width:15px; display: none">
													   <span class="sr-only">Loading...</span>
												   </div>
											   </button>
                                               <button type="button" class="btn btn-primary btn-sm" id="btnNext"><i class="mdi mdi-chevron-right"></i></button>
                                               <button type="button" class="btn btn-primary btn-sm" id="btnPrev" style="display: none;"><i class="mdi mdi-chevron-left"></i></button>
                                           </div>
                                       </section>
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
									<th class="text-center">Company Name</th>
									<th class="text-center">Company Code</th>
									<!-- <th class="text-center">Company Address</th> -->
									<th class="text-center">Company Email</th>
									<!-- <th class="text-center">Contact Person</th> -->
                                    <!-- <th class="text-center">Contact Mobile</th> -->
									<th class="text-center">Registration No.</th>
									<th class="text-center">GST No.</th>
									<th class="text-center">PAN no.</th>
                                
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



















