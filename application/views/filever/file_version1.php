<div>
    
       <span style="width: 35%;" >
            <table border='0px'>
                <tr>
                    <td><b>ID:</b></td>
                    <td class="docid"></td>
                </tr>

                <tr>
                    <td><b>Name:</b></td>
                    <td class="doc_nm"></td>
                </tr>
                <tr>
                    <td><b>Owner:</b></td>
                    <td class="docowner"></td>
                </tr>
                <tr>
                    <td><b>Comment:</b></td>
                    <td class="doc_com"></td>
                </tr>
                <tr>
                    <td><b>Used disk space:</b></td>
                    <td class="doc_sp"></td>
                </tr>
                <tr>
                    <td><b>Created:</b></td>
                    <td class="doc_cr"></td>
                </tr>
                <tr>
                    <td><b>Expires: </b></td>
                    <td class="doc_exp"></td>
                </tr>
            </table>
        </span>
        <span style="width: 75%; ">

          <div style="margin-left:20px;">
                    <h3 class='docname'>Dummy</h3><br>
                    <hr>

                    <table class="row" cellpadding ="20px">
                            
                            <tr class="col-12" > 
                                        <td >
                                        <a href="" target="_blank" id="doc_prev" ><img src="<?php echo base_url('assets/img/doc_img.jpg') ?>"  alt="no image for now" height="200px" width="150px"></a>
                                        </td>
                                        <td >
                                        <table border='0px'>
                                                   

                                                      <tr>
                                                         <td>Document Name </td>
                                                         <td class="doc_nm"></td>
                                                      </tr>
                                                      <tr>
                                                         <td>By </td>
                                                         <td class="docowner"></td>
                                                      </tr>
                                                      <tr>
                                                         <td>Comment:</td>
                                                         <td class="doc_com"></td>
                                                      </tr>

                                                      <tr>
                                                         <td>Current Document Version</td>
                                                         <td class="doc_ver"></td>
                                                      </tr>
                                                      <tr>
                                                         <td>Current Document Version Comment</td>
                                                         <td class="doc_ver_com"></td>
                                                      </tr>

                                                      <tr>
                                                         <td>Letter Number </td>
                                                         <td class="doc_letterno"></td>
                                                      </tr>

                                                      
                                                      <tr>
                                                         <td>Letter Date</td>
                                                         <td class="doc_letterdt"></td>
                                                      </tr>

                                                   
                                                      

                                                      <tr>
                                                         <td>Size:</td>
                                                         <td class="doc_sp"></td>
                                                      </tr>
                                                      <tr>
                                                         <td>Created :</td>
                                                         <td class="doc_cr"></td>
                                                      </tr>
                                                      <tr>
                                                         <td><b>Expires on :</b></td>
                                                         <td class="doc_exp"></td>
                                                      </tr>
                                                   </table>
                                        </td>
                                        <td >
                                            <a href="" id="download_btn" class="btn btn-primary" download> Download </a><br><br>
                                            <a data-toggle="modal" data-target="#employee_lunch" data-whatever="@getbootstrap" data-eid=""  class="upload_btn btn btn-success"><button type="button" class="btn top_btn all_btn mr-3"><i class="" aria-hidden="true"></i>Document Atribute Edit</button></a>
                                            <br><br>
                                            <a data-toggle="modal" data-target="#assetsmodel" data-whatever="@getbootstrap" data-eid=""  class="upload_btn btn btn-secondary"><button type="button" class="btn top_btn all_btn mr-3"><i class="" aria-hidden="true"></i>Update Document version</button></a>
                                            <br>
                                          
                                        </td>

                            </tr>

                    </table>
          </div>


          <div style="margin-left:20px;">
                    <h3 class='doc_sts'>Document Status</h3><br>
                    <hr>

                    <table class="row" cellpadding ="5px">
                            
                            <tr > 
                                <th>Date/User</th>
                                <th>status</th>
                                <th>Comment</th>
                                

                                       

                            </tr>

                    </table>
          </div>

          <div>
                    <h3 class='doc_sts'>Document Status</h3><br>
                    <hr>

                    <table class="row" cellpadding ="5px">
                            
                            <tr > 
                                <th>Date/User</th>
                                <th>status</th>
                                <th>Comment</th>
                                 

                            </tr>
                            

                    </table>
          </div>

          <div style="margin-left:20px;">
                    <h3 class='doc_sts'>Document Versions</h3><br>
                    <hr>

                    <table  cellpadding ="10px">
                            
                           <thead>
                                <tr > 
                                        <th>Document Versions</th>
                                        <th>updated by</th>
                                        <th>version Comment</th>
                                        <th>view</th>
                                        <th>action</th>
                                        
                                 </tr>
                                 
                           </thead>
                           <tbody id="doc_ver_tbl">
                      

                           </tbody>

                    </table>
          </div>

            
        </span>
</div>



  <!-- sample modal content -->
  <div class="modal fade" id="assetsmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
               <div class="modal-header">
                  <h2 class="modal-title" id="exampleModalLabel1">Update Document version</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
               <form method="post" action="upload_joining_doc" id="btnSubmit" class="new_form" enctype="multipart/form-data">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6">
                          
                           <input type="text" name="txtid" value="" class="txtid form-control inputbox" id="recipient-name1" >
                           <input type="text" name="current_path" value="" id='current_path' class=" form-control inputbox" id="recipient-name1" >
                           <div class="form-group">
                              <h3>Current Document version</h3>
                              <span id="curr_version"><span>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">
                                 <h3>Upload Document Here</h3>
                              </label>
                              <input type="file"  name="doc" class="form-control  inputbox" id="recipient-name1" required>
                           </div>
                           <div class="form-group">
                              <label class="control-label">
                                 <h3>Document Version Comment</h3>
                              </label>
                              <input type="text"  name="ver_com" class="form-control  inputbox" id="recipient-name1" placeholder="Enter Document Version comment"  required>
                           </div>

                           <div class="form-group">
                              <label class="control-label">
                                 <h3>Document Version </h3>
                              </label>
                              <input type="text"  name="version" class="form-control  inputbox" id="recipient-name1"  placeholder="Enter Document Version" required>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="aid" value="">
                     <button type="button" class="btn all_btn mr-3" data-dismiss="modal">Close</button>
                     <button type="submit" name="update_btn" id="update_btn" class="btn all_btn">Update version</button>
                  </div>
               </form>
            </div>
         </div>
      </div>



      

      <div class="modal fade" id="employee_lunch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content ">
         <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel1">Edit Document Attribute</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <form method="post" action="lunch_can" id="btnSubmit1" class="new_form" enctype="multipart/form-data">
         
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                  <input type="text" name="txtid" value="" class="txtid form-control inputbox" id="recipient-name1">
										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Document Type</label>
											<select class="form-control" name="doctype" id="doctype1" required>
												<option value="">Select</option>
											</select>
										</div>
									

								
                                       
										<div class="form-group">
											<label for="cn" class="control-label mb-1">Document Name</label>
											<input type="text" class="form-control" name="doc_name" id="doc_name" onclick="name_validate('doc_name')" placeholder="Enter Document Name" required>
										</div>
								
						           
										
                             
                              <div class="form-group">
											<label for="adds" class="control-label mb-1">Letter No.</label>
											<input type="text" class="form-control" name="letterno" id="letterno" onclick="number_validate('letterno')" placeholder="Enter Letter Number" required>
										</div>
							
									
										<div class="form-group">
											<label for="mail" class="control-label mb-1">Letter Date</label>
											<input type="date" class="form-control" name="letterdt" id="letterdt" >
										</div>

                  </div>
                  <div class="col-md-6">

										<div class="form-group">
											<label for="rlg" class="control-label mb-1">Expriry Date</label>
											<input type="date" name="expdt" id="expdt" class="form-control">
										</div>
									
									
										<div class="form-group">
											<label for="gen" class="control-label mb-1">Description</label>
											<textarea name="description" id="description" class="form-control"  required>
											</textarea>
										</div>
								
									
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" name="aid" value="">
               <button type="button" class="btn all_btn mr-3" data-dismiss="modal">Close</button>
               <button type="submit" name="attr_btn" id="attr_btn" class="btn all_btn">Lunch As Employee</button>
            </div>
         </form>
      </div>
   </div>
</div>






