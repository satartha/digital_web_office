<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	.responsive-table {
		overflow: auto;
	}

	table {
		width: 100%;
		border-spacing: 0;
		border-collapse: collapse;
		white-space:nowrap;
	}

	table th {
		background: #BDBDBD;
	}

	table tr:nth-child(odd) {
		background-color: #F2F2F2;
	}
	table tr:nth-child(even) {
		background-color: #E6E6E6;
	}

	th, tr, td {
		text-align: center;
		border: 1px solid #E0E0E0;
		padding: 5px;
	}

	img {
		font-style: italic;
		font-size: 11px;
	}

	.mdi-drag-vertical{
		cursor: move;
	}
	input[name="status"], input[name="type"]{
		accent-color: #072247;
	}
	#tgl_load{
		display: none;
	}
</style>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-sm-4">
					<table class="table table-condensed table-sm">
						<h3>Document Information</h3>
						<tbody>

					                                 <tr>
                                                         <td class="inn_padding ">Document Name </td>
                                                         <td class="doc_nm inn_padding"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="inn_padding">By </td>
                                                         <td class="docowner inn_padding"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="inn_padding">Comment:</td>
                                                         <td class="doc_com inn_padding"></td>
                                                      </tr>

                                                      <tr>
                                                         <td class="inn_padding">Current  Version</td>
                                                         <td class="doc_ver inn_padding"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="inn_padding">Version Comment</td>
                                                         <td class="doc_ver_com inn_padding"></td>
                                                      </tr>

                                                      <tr>
                                                         <td class="inn_padding">Letter Number</td>
                                                         <td class="doc_letterno inn_padding"></td>
                                                      </tr>

                                                      
                                                      <tr>
                                                         <td class="inn_padding">Letter Date</td>
                                                         <td class="doc_letterdt inn_padding"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="inn_padding">Size:</td>
                                                         <td class="doc_sp inn_padding"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="inn_padding">Created :</td>
                                                         <td class="doc_cr inn_padding"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="inn_padding">Expires on :</td>
                                                         <td class="doc_exp inn_padding"></td>
                                                      </tr>

						</tbody>
					</table>
				</div>
				<div class="col-sm-8" >
					<div class="all_padding div_color">
						<h4 class='docname'>Document Name</h4>
						<hr class="mod_hr">
						<div class="row">
							<div class="col-sm-5 img_place">
							<a href="" target="_blank" id="doc_prev" ><img src="<?php echo base_url('assets/img/doc_img.jpg') ?>" alt="no image for now" height="150"></a>
								<div class="mt-3">
									<a class="btn btn-primary mr-3" id="download_btn" download><i class="mdi mdi-download"></i> Download</a>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal_att"><i class="mdi mdi-square-edit-outline"></i> Edit Attribute</button>
								</div>
								<div class="mt-3">
									<button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleModal" id="workflow_btn"><i class="mdi mdi-battery-plus"></i> Work Flow</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal_ver"><i class="mdi mdi-apple-keyboard-caps"></i> Update Version</button>
								</div>
							</div>
							<div class="col-sm-1 vl"></div>
							<div class="col-sm-6">
								<div class="mt-3">
									<span class="head_tag">Version :</span> <span class="doc_ver"></span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Size :</span> <span class="doc_sp"></span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Document Name :</span> <span class="doc_nm"></span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Uploaded By :</span> <span class="docowner"></span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Letter Number  :</span> <span class="doc_letterno">qd</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Letter Date :</span> <span class="doc_letterdt"></span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Created :</span> <span class="doc_cr"></span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Expires on :</span> <span class="doc_exp">casc</span>
								</div>

							</div>
						</div>
					</div>
			
					<h4 class="mt-3">Version</h4>
					<hr class="mod_hr">
					<table class="table table-striped table-bordered" style="width:100%">
						<thead>
						<tr>
						                <th>Document Versions</th>
                                        <th>updated by</th>
                                        <th>version Comment</th>
                                        
                                        <th>action</th>
						</tr>
						</thead>
						<tbody class="tbl_body " id="doc_ver_tbl">
					
						</tbody>
					</table>
				</div>
			</div>

			<!-- Modal Workflow -->
			<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Generate Workflow</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						
							<form action="" enctype="multitype/form-data" method="post" id="modal_flow">
							<input class="form-control" type="hidden" name="txtid"  value="0">
							<input class="form-control" type="hidden" name="docid"  id="docid">
							<div class="mt-2">
									<span>Workflow Name</span>

									<select name="wfid" id="wfid" class="form-control" required> 
									<option value="" hidden="hidden">Choose</option>
								    </select> 

								</div>
								<!-- <p>Automatically sends any file uploaded to this folder to a predefined approval.</p> -->
								
								<div class="mt-2">
									<span>Description</span>
									<textarea class="form-control" name="descrip" id="deac" placeholder="Description"></textarea>
								</div>
								<div>
									<span>Dead Line</span>
									<input class="form-control" type="date" name="ded">
								</div>
								<div class="mt-2">
									<span>Assign To</span>
									<input class="form-control" id="as_input" type="text" placeholder="Assign Here" required> 

								</div>
								<div class="mt-2" >
							
									<div id="as_div" style="z-index:10;">

									<ul id="as_ul" style="list-style:none;">  
                    			    
								    </ul>

                                    </div>
								</div>
								
								
								<div class="mt-2">
									<input class="mr-1" type="radio" name="wftype" value="1" id="pa">Parallel &nbsp;
									<input class="mr-1" type="radio" name="wftype" value="0" id="se">Serial
									<label style="float: right;">
										<input id="tgl_btn" type="checkbox"  data-toggle="toggle">
										Move after approval
									</label>
									<div class="mt-2" id="tgl_load">
										<span>folder Path</span>
										<input class="form-control pth" type="text" name="moveafter"  onclick="open_folder();">
									</div>
								</div>
								<div class="mt-4">
									<div class="responsive-table">
										<table id="sortable">
											<thead>
											<tr class="ui-state-default">
												<th>Drag Row</th>
											
												<th>Assigned</th>
												
												<th>Action</th>
											</tr>
											</thead>
											<tbody id="drag_ndtl">
											
										
											</tbody>
										</table>
									</div>
								</div>
								
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
						</form>
						
					</div>
				</div>
			</div>

			<!-- Modal for folder -->
			<div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Choose Your Folder</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container collapse_div div_color">
								<div class="col_div" href="#demo" data-toggle="collapse"><i class="mdi mdi-folder"></i> <span id="base_pathname"> </span><i class="mdi mdi-menu-down right" style="font-size: 20px;"></i></div>
								<div id="demo" class="collapse">
									<ul id="loadsub01">
										<!-- <li><div class="col_div" href="#demo2" data-toggle="collapse"><i class="mdi mdi-folder"></i> sub collapsible</div></li> -->
									</ul>
								</div>
								
								
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="choose_btn">Choose</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal for attribute -->
			<div class="modal fade" id="modal_att" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Document Attribute</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="lunch_can" id="btnSubmit1" class="new_form" enctype="multipart/form-data">
<!--								<p>Automatically sends any file uploaded to this folder to a predefined approval.</p>-->
                            <input type="text" name="txtid" value="" class="txtid form-control inputbox" id="recipient-name1">	
                              <div>
									<span>Document Type</span>
									<select class="form-control" name="doctype" id="doctype1" required>
										
									</select>
								</div>
								<div class="mt-2">
									<span>Document Name</span>
									<input class="form-control"  name="doc_name" id="doc_name" onclick="name_validate('doc_name')" placeholder="Enter Document Name" required>
								</div>
								<div class="mt-2">
									<span>Letter No</span>
									<input class="form-control" type="text" name="letterno" id="letterno" onclick="number_validate('letterno')" placeholder="Enter Letter Number" required>
								</div>
								<div class="mt-2">
									<span>Letter Date</span>
									<input class="form-control" type="date" name="letterdt" id="letterdt" >
								</div>
								<div class="mt-2">
									<span>Expiry Date</span>
									<input class="form-control" type="date" name="expdt" id="expdt">
								</div>

								<div class="mt-2">
									<span>Description</span>
									<textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
								</div>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="attr_btn" id="attr_btn">Update Attribute</button>
						</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal for Version -->
			<div class="modal fade" id="modal_ver" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Update Version</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="upload_joining_doc" id="ver_submit" class="new_form" enctype="multipart/form-data">
								<!--								<p>Automatically sends any file uploaded to this folder to a predefined approval.</p>-->
								<input type="text" name="txtid" value="" class="txtid form-control inputbox" id="recipient-name1" >
								<input type="text" name="current_path" value="" id='current_path' class=" form-control inputbox" id="recipient-name1" >
								<div>
									<span>Current Document Version :-</span>
									<b><span id="curr_version"></span></b>
								</div>
								<div class="mt-2">
									<span>Upload New Document</span>
									<input class="form-control" type="file"  name="doc" name="ver_com" placeholder="Enter Document Version comment"  required>
								</div>
								<div class="mt-2">
									<span>Document Version Comment</span>
									<input class="form-control" name="ver_com" placeholder="Enter Document Version Comment" type="text">
								</div>
								<div class="mt-2">
									<span>Document Version</span>
									<input class="form-control" name="version" placeholder="Enter Document Version" type="text">
								</div>

							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="update_btn" id="update_btn" class="btn btn-primary">Update</button>
						</div>
						</form>
					</div>
				</div>
			</div>









