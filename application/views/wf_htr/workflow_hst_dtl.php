<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="container">
				<div class="card card_approve">
					<div class="img_div">
						<img src="../assets/img/docs.jpg" alt="" height="110" width="150">
					</div>
					<div class="card_head">
						<h4>Workflow Details</h4>
                        
					</div>
					<div class="img_box">
						<div class="row">
							<div class="col-sm-8">
								<p class="img_name"><i class="mdi mdi-panorama mdi-24px"></i> <span class="doc_name"></span></p>
							</div>
							<div class="vl1"></div>
							<div class="col-sm-2 img_icon">
								<a href="" class="doc_pth" download><i class="mdi mdi-download mdi-24px"></i></a>
							</div>
							<div class="vl1"></div>
							<div class="col-sm-2 img_icon">
								<a href="" class="doc_pth" target="_blank"><i class="mdi mdi-file-document-box-search mdi-24px"></i></a>
							</div>
						</div>
					</div>
                    <div class="mt-3">
						<h4 class="card_head1">Workflow Name</h4>
						<span id="wf_nm"></span>
					</div>
					<div class="mt-3">
						<h4 class="card_head1">Workflow Description</h4>
						<span id="wf_descp"></span>
					</div>
					<div class="mt-3">
						<h4 class="card_head1">Current Status</h4>
						<span id="wf_sts"></span>
					</div>
				</div>
				<div class="card card_approve mt-1">
					<div class="mt-3">
						<h4 class="card_head2">Persons Resposible in this workflow </h4>
					</div>
					<div class="status" id="wf_status">
						<!-- <div><i class="mdi mdi-record mr-3" style="color: red"></i> folderit@gmail.com</div>
						<div><i class="mdi mdi-record mr-3" style="color: green"></i> folderit@gmail.com</div>
						<div><i class="mdi mdi-record mr-3" style="color: #f304fb"></i> folderit@gmail.com</div>
						<div><i class="mdi mdi-record-circle-outline mr-3" style="color: #f304fb"></i> folderit@gmail.com</div>
						<div><i class="mdi mdi-close-circle mr-3" style="color: red"></i> folderit@gmail.com</div>
						<div><i class="mdi mdi-check-circle mr-3" style="color: green"></i> folderit@gmail.com</div> -->

                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                 <tr>
                                     <td>Status</td>
                                     <td>Staff Name</td>
                                     <td>Assign Date</td>
                                     <td>Verified on</td>
                                     <td>Comment</td>
                                     

                                  </tr>
                            </thead>
                            <tbody id="histry_lst">

                                 <tr>
                                     <td colspan="5">NO Details Found</td>
                                  </tr>

                            </tbody>

                        </table>
					</div>


					<div id="appr_div">


					</div>
					
                 
				</div>
			</div>