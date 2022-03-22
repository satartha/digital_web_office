<?php

if(isset($this->session->current_path))
{
   $current_path=$this->session->current_path;
  
}

?>

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
							<h3 class="card-title text-white" >File Upload Form</h3>
						</div>
						
						<div class="card-body">
							<form id="frmCandidate" enctype="multipart/form-data">
                            <input type="hidden" class="form-control"  name="current_path" id="current_path" value="<?php echo $current_path; ?>" required>
								<div class="row">
                               

									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Document Type</label>
											<select class="form-control" name="doctype" id="doctype" required>
												<option value="">Select</option>
											</select>
										</div>
									</div>

									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                                        <input type="hidden" class="form-control" name="txtid" id="txtid" value="0">
										<div class="form-group">
											<label for="cn" class="control-label mb-1">Document Name</label>
											<input type="text" class="form-control" name="doc_name" id="doc_name" onclick="name_validate('doc_name')" placeholder="Enter Document Name" required>
										</div>
									</div>
									<!-- <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="ace" class="control-label mb-1">Khata No.</label>
											<input type="text" class="form-control" name="khatano" id="khatano" onclick="number_validate('khatano')" placeholder="Enter Khata Number " >
										</div>
									</div> -->
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="adds" class="control-label mb-1">Letter No.</label>
											<input type="text" class="form-control" name="letterno" id="letterno" onclick="number_validate('letterno')" placeholder="Enter Letter Number" required>
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="mail" class="control-label mb-1">Letter Date</label>
											<input type="date" class="form-control" name="letterdt" id="letterdt" >
										</div>
									</div>
									<!-- <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="gen" class="control-label mb-1">Comment</label>
											<textarea name="comment" id="comment" class="form-control"  required>

											</textarea>
										</div>
									</div> -->
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Expriry otions</label>
											<select class="form-control" name="exp_opt" id="exp_opt">
												<option value="" hidden="hidden">Select</option>
												<option value="1d">1 Day</option>
												<option value="1wk">1 Week</option>
												<option value="1mn">1 Month</option>
												<option value="6mn">6 Month</option>
												<option value="1yr">1 Year</option>
												
											</select>
										</div>
									</div>

									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Expriry Date</label>
											<input type="date" name="expdt" id="expdt" class="form-control">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="gen" class="control-label mb-1">Description</label>
											<textarea name="description" id="description" class="form-control"  required>

											</textarea>
										</div>
									</div>
									
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="cast" class="control-label mb-1">Version</label>
											<input type="text" class="form-control" name="version" id="version"  placeholder="Enter Document Version">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="cast" class="control-label mb-1">Sent by</label>
											<input type="text" class="form-control" name="sentby" id="sentby"  placeholder="Enter Document Version">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="cast" class="control-label mb-1">Source</label>
											<input type="text" class="form-control" name="source" id="source"  placeholder="Enter Document Version">
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="img" class="control-label mb-1">File Upload</label>
											<input type="file" id="doc" name="doc" class="form-control" required>
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="gen" class="control-label mb-1">Version Comment</label>
											<textarea name="ver_com" id="ver_com" class="form-control" >

											</textarea>
										</div>
									</div>

								<?php
								if(isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){


							?>
							<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="gen" class="control-label mb-1">Assign User</label><br>
								
								<select class="js-example-basic-multiple" style="width:100%;" id="user_as" name="user_as[]" multiple="multiple">
								<option value="" hidden="hidden">Select</option>
								
								</select>
							</div>
							</div>
								
			                <?php					
						}		
								?>

								</div>
								<br>
								<div class="text-right">
									<button type="reset" class="btn btn-danger btn-sm">Reset</button>
									<button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Add</button>
								</div>
							</form>
							<br>
						</div>
					</div>
				</div>
			</div><br>
			

		</div>
	</div>
</div>


