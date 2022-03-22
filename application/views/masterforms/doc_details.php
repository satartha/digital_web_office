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
							<td class="inn_padding">Owner:</td>
							<td class="inn_padding"><a>Administrator</a></td>
						</tr>
						<tr>
							<td class="inn_padding">Created:</td>
							<td class="inn_padding">24-01-22 12:01:53</td>
						</tr>
						<tr>
							<td class="inn_padding">Comment:</td>
							<td class="inn_padding">Billing Detail of January 2022</td>
						</tr>
						<tr>
							<td class="inn_padding">Owner:</td>
							<td class="inn_padding"><a>Administrator</a></td>
						</tr>
						<tr>
							<td class="inn_padding">Created:</td>
							<td class="inn_padding">24-01-22 12:01:53</td>
						</tr>
						<tr>
							<td class="inn_padding">Comment:</td>
							<td class="inn_padding">Billing Detail of January 2022</td>
						</tr>
						<tr>
							<td class="inn_padding">Owner:</td>
							<td class="inn_padding"><a>Administrator</a></td>
						</tr>
						<tr>
							<td class="inn_padding">Created:</td>
							<td class="inn_padding">24-01-22 12:01:53</td>
						</tr>
						<tr>
							<td class="inn_padding">Comment:</td>
							<td class="inn_padding">Billing Detail of January 2022</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-8" >
					<div class="all_padding div_color">
						<h4>Document Name</h4>
						<hr class="mod_hr">
						<div class="row">
							<div class="col-sm-5 img_place">
								<img src="../assets/img/doc.jpg" alt="" height="150">
								<div class="mt-3">
									<button class="btn btn-primary mr-3"><i class="mdi mdi-download"></i> Download</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal_att"><i class="mdi mdi-square-edit-outline"></i> Edit Attribute</button>
								</div>
								<div class="mt-3">
									<button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleModal"><i class="mdi mdi-battery-plus"></i> Work Flow</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal_ver"><i class="mdi mdi-apple-keyboard-caps"></i> Update Version</button>
								</div>
							</div>
							<div class="col-sm-1 vl"></div>
							<div class="col-sm-6">
								<div class="mt-3">
									<span class="head_tag">Version :</span> <span>1</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Size :</span> <span>asdcfadc</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Application Format :</span> <span>wqdwd</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Uploaded By :</span> <span>casc</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Status :</span> <span>qd</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Expires :</span> <span>edwfwefwefwef</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Size :</span> <span>asdcfadc</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Application Format :</span> <span>wqdwd</span>
								</div>
								<div class="mt-2">
									<span class="head_tag">Uploaded By :</span> <span>casc</span>
								</div>

							</div>
						</div>
					</div>
					<h4 class="mt-3">Status</h4>
					<hr class="mod_hr">
					<table class="table table-striped table-bordered" style="width:100%">
						<thead>
						<tr>
							<th>Date/User</th>
							<th>Status</th>
							<th>Comment</th>
						</tr>
						</thead>
						<tbody class="tbl_body">
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td>Tokyo</td>
						</tr>
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td>Tokyo</td>
						</tr>
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td>Tokyo</td>
						</tr>
						</tbody>
					</table>
					<h4 class="mt-3">Version</h4>
					<hr class="mod_hr">
					<table class="table table-striped table-bordered" style="width:100%">
						<thead>
						<tr>
							<th>Date/User</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody class="tbl_body">
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i>&nbsp; <i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i>&nbsp; <i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></td>
						</tr>
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i>&nbsp; <i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i>&nbsp; <i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></td>
						</tr>
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i>&nbsp; <i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i>&nbsp; <i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Modal Workflow -->
			<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Automated Approval Workflow</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" id="modal_flow">
								<p>Automatically sends any file uploaded to this folder to a predefined approval.</p>
								<div>
									<span>Dead Line</span>
									<input class="form-control" type="date">
								</div>
								<div class="mt-2">
									<span>Description</span>
									<textarea class="form-control" name="deac" id="deac" placeholder="Description"></textarea>
								</div>
								<div class="mt-2">
									<span>Assign To</span>
									<input class="form-control" type="text">
								</div>
								<div class="mt-2">
									<input class="mr-1" type="radio" name="type" id="pa">Parallel &nbsp;
									<input class="mr-1" type="radio" name="type" id="se">Serial
									<label style="float: right;">
										<input id="tgl_btn" type="checkbox" data-toggle="toggle">
										Move after approval
									</label>
									<div class="mt-2" id="tgl_load">
										<span>Description</span>
										<input class="form-control" type="text" onclick="open_folder();">
									</div>
								</div>
								<div class="mt-4">
									<div class="responsive-table">
										<table id="sortable">
											<thead>
											<tr class="ui-state-default">
												<th>Drag Row</th>
												<th>Id</th>
												<th>Fruit</th>
												<th>Quantity</th>
												<th>Image</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td><i class="mdi mdi-drag-vertical"></i></td>
												<td data-id="1">1</td>
												<td>Apple</td>
												<td>5</td>
												<td><img src="" alt="noImage" width="30px" height="25px"></td>
												<td><span class="mdi mdi-trash-can-outline"></span></td>
											</tr>
											<tr>
												<td><i class="mdi mdi-drag-vertical"></i></td>
												<td data-id="2">2</td>
												<td>Orange</td>
												<td>8</td>
												<td><img src="" alt="noImage" width="30px" height="25px"></td>
												<td><span class="mdi mdi-trash-can-outline"></span></td>
											</tr>
											<tr>
												<td><i class="mdi mdi-drag-vertical" ></i></td>
												<td data-role="test" data-id="3">3</td>
												<td>Banana</td>
												<td>3</td>
												<td><img src="" alt="noImage" width="30px" height="25px"></td>
												<td><span class="mdi mdi-trash-can-outline"></span></td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Create</button>
						</div>
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
								<div class="col_div" href="#demo" data-toggle="collapse"><i class="mdi mdi-folder"></i> Simple collapsible <i class="mdi mdi-menu-down right" style="font-size: 20px;"></i></div>
								<div id="demo" class="collapse">
									<ul>
										<li>
											<div class="col_div" href="#demo2" data-toggle="collapse"><i class="mdi mdi-folder"></i> sub collapsible</div>
											<div id="demo2" class="collapse">
												<ul>
													<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>
													<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>
												</ul>
											</div>
										</li>

									</ul>
								</div>
								<div class="col_div" href="#demo1" data-toggle="collapse"><i class="fa fa-facebook"></i><i class="mdi mdi-folder"></i> Simple collapsible <i class="mdi mdi-menu-down right" style="font-size: 20px;"></i></div>
								<div id="demo1" class="collapse">
									<ul>
										<li>
											<div class="col_div" href="#demo3" data-toggle="collapse"><i class="mdi mdi-folder"></i> sub collapsible</div>
											<div id="demo3" class="collapse">
												<ul>
													<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>
													<li class="col_div"><div href="#"><i class="mdi mdi-folder"></i> svsvsd</div></li>
												</ul>
											</div>
										</li>

									</ul>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Create</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal for attribute -->
			<div class="modal fade" id="modal_att" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Work Flow</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" id="modal_attr">
<!--								<p>Automatically sends any file uploaded to this folder to a predefined approval.</p>-->
								<div>
									<span>Document Type</span>
									<select class="form-control" id="sel1" name="sellist1">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>
								<div class="mt-2">
									<span>Document Name</span>
									<input class="form-control" type="text">
								</div>
								<div class="mt-2">
									<span>Letter No</span>
									<input class="form-control" type="text">
								</div>
								<div class="mt-2">
									<span>Letter Date</span>
									<input class="form-control" type="date">
								</div>
								<div class="mt-2">
									<span>Expiry Date</span>
									<input class="form-control" type="date">
								</div>

								<div class="mt-2">
									<span>Description</span>
									<textarea class="form-control" name="deac" id="deac" placeholder="Description"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Create</button>
						</div>
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
							<form action="" id="modal_ver">
								<!--								<p>Automatically sends any file uploaded to this folder to a predefined approval.</p>-->
								<div>
									<span>Current Document Version :-</span>
									<span><b>10.2.0</b></span>
								</div>
								<div class="mt-2">
									<span>Upload New Document</span>
									<input class="form-control" type="file">
								</div>
								<div class="mt-2">
									<span>Document Version Comment</span>
									<input class="form-control" type="text">
								</div>
								<div class="mt-2">
									<span>Document Version</span>
									<input class="form-control" type="text">
								</div>

							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Update</button>
						</div>
					</div>
				</div>
			</div>









