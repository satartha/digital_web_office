<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workflow extends CI_Controller 
{

	public function load_include()
	{
		$this->load->view('include/header');
		$this->load->view('include/topbar');
		$this->load->view('include/menubar');
	}

    public function index()
    {
		
		try {
			if (isset($this->session->dflogin_admin)){
               
				$this->load_include();
				$this->load->view('masterforms/workflow_type/tworkflow');
				$this->load->view('include/footer');
				$this->load->view('masterforms/workflow_type/tworkflow_script');

			}else{
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
    }

	public function wf_str()
	{
		try {
			if (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'))
			{
				$this->load->view('include/header');
		        $this->load->view('include/topbar');
				$this->load->view('wf_htr/workflow_history');
				$this->load->view('include/footer');
				$this->load->view('wf_htr/workflow_historyScript');

			}else{
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}






	public function get_staff(){

		try{
			if (isset($this->session->dflogin)  || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1')) {
				
					$data=array();
					$status=true;
					$request=json_decode(json_encode($_POST));
					if (!empty($request->name) && preg_match('/^[0-9a-zA-Z ]{0,50}$/',$request->name)) {
						$name=$request->name;
					} else {
						$data['data']="Name Error";
						$status=false;
					}
					
					
					if ($this->session->dflogin) 
					{
						$id=$this->session->dflogin['companyid'];
					} else {
						$id=$this->session->dflogin_staff['entryby'];
					}
					
					if ($status) {
						$query="select*from tbl_company_staffs where entryby=$id and staffname like '%{$name}%' and isactive=1";
					    // echo $query;
						// exit();
						$staff_dtl=$this->Model_Db->Query($query);
						if($staff_dtl){
                           foreach ($staff_dtl as $key => $value) 
						   {
							   $data['staff'][]=$value;
						   }
						   $data['status']=true;
						}else{
							$data['status']=false;
							$message["message"]="No Staff found";
							$data['data']="No staff found";
						}
					} else {
						$data['status']=false;
						$message["message"]="invalid id";
					}
					
					
					echo json_encode($data);
					exit();
				
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }


	}


	public function get_ind_staff(){

		try{
			if (isset($this->session->dflogin)  || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1')) {
				
					$data=array();
					$status=true;
					$request=json_decode(json_encode($_POST));
					
					if (!empty($request->sid) && is_numeric($request->sid)) {
						$id=$request->sid;
					} else {
						$data['data']="id Error";
						$status=false;
					}
				
					
			
					
					if ($status) {
						$where="id=$id and isactive=1";
					   
						$staff_dtl=$this->Model_Db->select(5,null,$where);
						if($staff_dtl){
                        
							$data['ind_staff']=$staff_dtl[0];
						   $data['status']=true;
						}else{
							$data['status']=false;
							$message["message"]="No Staff found";
							$data['data']="No staff found";
						}
					} else {
						$data['status']=false;
						$message["message"]="invalid id";
					}
					
					
					echo json_encode($data);
					exit();
				
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }





	}

    public function c_dp(){
        try{
			if (isset($this->session->dflogin_admin) ) {
				// if($this->session->dflogin['typeid']==1 || ($this->session->dflogin['typeid']==2 && $this->session->dflogin['entry']==1)) {
					$data=array();
					$insert=array();
					$status=true;
					$request = json_decode(json_encode($_POST), FALSE);
					$segment=explode(':',$request->frm_data);
					$key = base64_decode($segment[0]);
					$iv =  base64_decode($segment[2]);
					$decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
					$datalist =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
					$request = json_decode($datalist);
					
					if(isset($request->wfnm) && preg_match('/^[0-9a-zA-Z ]{0,50}$/',$request->wfnm)){
						$insert[0]['workflowname']=$request->wfnm;
					}else{
						$data['title']="Alert!";
						$data['message']="Workflow Status name error";
						$status=false;
					}

					if($status){
						if(isset($request->txtid) && is_numeric($request->txtid)){
							if($request->txtid>0){
								if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
									$insert[0]['updateby'] = $this->session->dflogin_admin['adminid'];
									$insert[0]['updateat']=date("Y-m-d H:i:s");
									$res=$this->Model_Db->update(11,$insert,"id",$request->txtid);
									if($res!=false){
										$data['title']="Alert!!";
										$data['message']="Workflow Status updated successfully.";
										$data['status']=true;
										$this->session->unset_tempdata('editForm');
									}else{
										$data['title']="Alert!!";
										$data['message']="Workflow Status updating failed";
										$data['status']=false;
									}
								}else{
									$data['status']=false;
									$data['title']='Time out';
									$data['message']='You have exceeded the max time limit of 30 seconds to edit this form.';
								}
							}else if($request->txtid==0){
								$insert[0]['entryby']=$this->session->dflogin_admin['adminid'];
								$insert[0]['entryat']=date("Y-m-d H:i:s");
								$res=$this->Model_Db->insert(11,$insert);
								if($res!=false){
									$data['title']="Alert!";
									$data['message']="Workflow created successfully.";
									$data['status']=true;
								}else{
									$data['title']="Alert!";
									$data['message']="Workflow creating failed";
									$data['status']=false;
								}
							}else{
								$data['title']="Insufficient/Invalid data.";
								$data['message']="Some error occurred.Please try again or contact with Admin.";
								$data['status']=false;
							}
						}else{
							$data['title']="Insufficient/Invalid data.";
							$data['message']="Some error occurred.Please try again or contact with Admin.";
							$data['status']=false;
						}
					}else{
						$data['title']="Error!";
						$data['status']=false;
					}
					echo json_encode($data);
					exit();
				// }else{
				// 	redirect('Welcome/');
				// }
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }



	public function generate_workflow()
	{
         
		
			try{
				if (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1')  ) {
	
						$data=array();
						$insert=array();
						$status=true;
						$request = json_decode(json_encode($_POST), FALSE);
						// echo "<pre>";
						// print_r($request);
						// exit();
						
	                    if (isset($request->docid) && is_numeric($request->docid) && $request->docid>0) {
							
                            
							$where ="isactive=1 and documentid=$request->docid and iscomplete=0";

							$assign_dtl=$this->Model_Db->select(15,null,$where);
                            
							if ($assign_dtl) 
							{
								$data['title'] = "Alert!";
								$data['message'] = "Document is already in the workflow Process";
								$status = false;
							}else{
								$insert[0]['documentid'] = $request->docid;
							}


						} else {
							$data['title'] = "Alert!";
							$data['message'] = "Document id error";
							$status = false;
						}


						if (isset($request->wfid) && is_numeric($request->wfid) && $request->wfid>0) {
							$insert[0]['workflowid'] = $request->wfid;
						} else {
							$data['title'] = "Alert!";
							$data['message'] = "WorkflowId error";
							$status = false;
						}
						// $insert[0]['workflowid'] ="1";


						if (isset($request->wftype) && is_numeric($request->wftype)) {

							
							if ($request->wftype==0 || $request->wftype==1) 
							{
								$insert[0]['isparallel'] = $request->wftype;
							} else {
								$data['title'] = "Alert!";
								$data['message'] = "Workflow type error";
								$status = false;
							}

						} else {
							$data['title'] = "Alert!";
							$data['message'] = "Workflow type error";
							$status = false;
						}



						if (isset($request->txtid) && is_numeric($request->txtid) ) {
							
						} else {
							$data['title'] = "Alert!";
							$data['message'] = "text id error";
							$status = false;
						}

						if (isset($request->descrip) && preg_match('/^[a-zA-Z0-9 ]{1,200}$/', $request->descrip)) {
							$insert[0]['description'] = $request->descrip;
						} else {
							$data['title'] = "Alert!";
							$data['message'] = "Workflow Description error";
							$status = false;
						}

						if (isset($request->ded) ) {
							$insert[0]['deadlineby'] = $request->ded;
						}else{
							$data['title'] = "Alert!";
							$data['message'] = "Document Deadline error";
							$status = false;
						}

						if (isset($request->moveafter) ) {
							$insert[0]['moveafter'] = $request->moveafter;
						}

						if (isset($request->resp_per)) 
						{
									foreach ($request->resp_per as $key => $value) 
								{
									$where ="isactive=1 and id=$value";

									$assign_dtl=$this->Model_Db->select(5,null,$where);
									if ($assign_dtl==false)
									{
										$data['title'] = "Alert!";
										$data['message'] = "Assigned Person error";
										$status = false;
										exit();
									}
								}
						}else{
							$data['title'] = "Alert!";
							$data['message'] = "Assigned Person is not given";
							$status = false;
						}
						$data['status']=true;

						if($status){
							if(isset($request->txtid) && is_numeric($request->txtid)){

								if (isset($this->session->dflogin)) 
								{
									$entryby=$this->session->dflogin['companyid'];
								}else{
									$entryby=$this->session->dflogin_staff['entryby'];
								}
								// echo "<pre>";
	
								// print_r($insert);
								// exit();
								if($request->txtid>0){
									if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
										$insert[0]['updateby'] = $this->session->dflogin['companyid'];
										$insert[0]['updateat']=date("Y-m-d H:i:s");
										$res=$this->Model_Db->update(5,$insert,"id",$request->txtid);
										if($res!=false){
											$data['title']="Alert!!";
											$data['message']="Staff updated successfully.";
											$data['status']=true;
											$this->session->unset_tempdata('editForm');
										}else{
											$data['title']="Alert!!";
											$data['message']="Staff updating failed";
											$data['status']=false;
										}
									}else{
										$data['status']=false;
										$data['title']='Time out';
										$data['message']='You have exceeded the max time limit of 30 seconds to edit this form.';
									}
								}else if($request->txtid==0){
									$insert[0]['entryby']=$entryby;
									
									$insert[0]['entryat']=date("Y-m-d H:i:s");


                                    $res=$this->Model_Db->insert(15,$insert);
									if($res!=false){
										$in[0]['dwaid']=$this->db->insert_id();
										$in[0]['assigndate']=date("Y-m-d H:i:s");
										                
										foreach ($request->resp_per as $key => $value) 
										{
											if ($key==0) 
											{
												$first_person=$value;
											}

											$in[0]['assignedto']=$value;
											$rk=$this->Model_Db->insert(16,$in);
											if($rk==false){
												$data['title']="Alert!";
												$data['data']="Workflow cannot be assigned to the Insertructed person";
												$data['status']=false;
												exit();
											}
										}

										if ($data['status']==true) 
										{

											$wftype=$request->wftype;
                                            $message="You have Assigned for a Document Workflow";
											if($wftype==0)
											{
												$where ="isactive=1 and id=$first_person";

							                    $assign_dtl=$this->Model_Db->select(5,null,$where);

												if ($assign_dtl) 
												{
													$per_email[]=$assign_dtl[0]->staffemail;

													if ($this->Workflow_mail($per_email,$message)) {
														$data['title']="Alert!";
														$data['message']="Successfully Workflow is Generated and Assigned to Repective person";
														$data['status']=true;
													}else{
                                                        $data['title']="Alert!";
														$data['message']="Successfully Workflow is Generated and Assigned to Repective person mail cannot be sent";
														$data['status']=false;
													}

												}else{
													$data['title']="Alert!";
													$data['message']="Assign person is not valid";
													$data['status']=false;
												}
											}else{

												foreach ($request ->resp_per  as $key => $value) 
												{
													$where ="isactive=1 and id=$value";

							                        $assign_dtl=$this->Model_Db->select(5,null,$where);
													
													$per_email[]=$assign_dtl[0]->staffemail;
												}

												if ($this->Workflow_mail($per_email,$message)) {
													$data['title']="Alert!";
													$data['message']="Successfully Workflow is Generated and Assigned to Repective person";
													$data['status']=true;
												}else{
													$data['title']="Alert!";
													$data['message']="Successfully Workflow is Generated and Assigned to Repective person mail cannot be sent";
													$data['status']=false;
												}
											}
										} else {
										
												$data['data']="Workflow cannot be assigned to the Insertructed person";
												
										}
										
									}else{
										$data['title']="Alert!";
										$data['message']="Cannot assign Workflow ";
										$data['status']=false;
									}

								}else{
									$data['title']="Insufficient/Invalid data.";
									$data['message']="Some error occurred.Please try again or contact with Admin.";
									$data['status']=false;
								}
							}else{
								$data['title']="Insufficient/Invalid data.";
								$data['message']="Some error occurred.Please try again or contact with Admin.";
								$data['status']=false;
							}
						}else{
							$data['title']="Error!";
							$data['status']=false;
						}
						echo json_encode($data);
						exit();
			
				}else{
					redirect('Welcome/');
				}
			} catch (Exception $e) {
				$data['message'] = $e->getMessage();
				$data['status'] = false;
				$data['error'] = true;
				echo json_encode($data);
			}

	}

	public function approve_wf()
	{    
		try{
			if ( (isset($this->session->dflogin_staff) ) ) 
			{
				// if($this->session->dflogin['typeid']==1 || ($this->session->dflogin['typeid']==2 && $this->session->dflogin['entry']==1)) {
					$data=array();
					$insert=array();
					$status=true;
					$request = json_decode(json_encode($_POST), FALSE);
                    
					// echo "<pre>";
					// print_r($request);
					// exit();
				    
                    //id of documents table
					if (isset($request->doc_id) && is_numeric($request->doc_id) && $request->doc_id>0) 
					{
						$document_id = $request->doc_id;
					} else {
						$data['title'] = "Alert!";
						$data['message'] = "Document id error";
						$status = false;
					}


                    
					//id of workflow assign table
					if (isset($request->wf_id) && is_numeric($request->wf_id) && $request->wf_id>0) 
					{
						$wfid = $request->wf_id;
					} else {
						$data['title'] = "Alert!";
						$data['message'] = "Workflow id error";
						$status = false;
					}
                       
					//id of workflow step table
					if  (isset($request->wf_type_id) && is_numeric($request->wf_type_id) && $request->wf_type_id>0) 
					{
						$wf_type_id = $request->wf_type_id;  
					} else {
						$data['title'] = "Alert!";
						$data['message'] = "Workflow Type id error";
						$status = false;
					}

					//whether document is aproved or rejected

					if (isset($request->isaproved) && is_numeric($request->isaproved) ) 
					{ 
						
						
						if ($request->isaproved=='1' || $request->isaproved=='0') 
						{
							$aprove=$request->isaproved;
							$isaprove['aprove']=$request->isaproved;
							
						} else {
							$data['title'] = "Alert!";
							$data['message'] = "Please Provide Correct Aproval";
							$status = false;
						}

					} else {
						$data['title'] = "Alert!";
						$data['message'] = "approval Not provided";
						$status = false;
					}


                    //comment of approval or rejection comment
					if (isset($request->comment) && preg_match('/^[a-zA-Z0-9 ]{1,200}$/', $request->comment)) {
						$insert[0]['comment'] = $request->comment;
					} else {
						$data['title'] = "Alert!";
						$data['message'] = "Approval Comment error";
						$status = false;
					}

					if($status){

								$staffid=$this->session->dflogin_staff['staffid'];

								$where="isactive=1 and id=$wfid";
								$wf_as_dtl=$this->Model_Db->select(15,null,$where);

							
								
								// if ($wf_as_dtl[0]->assignedto==$staffid){


									$workflow_admin_id=$wf_as_dtl[0]->workflowid;
                                
									if ($wf_as_dtl) 
									{
										if ($wf_as_dtl[0]->iscomplete==true) 
										{
											  
											$data['title']="Error!";
											$data['data']="Workflow is Already completed";
											$data['message']="Workflow is Already completed";
											$data['status']=false;
				
										} else {
	
												
											if(strtotime($wf_as_dtl[0]->deadlineby) > time() )
											{
												$cur_path=$this->session->basefolder."/attachments";
	                                            // echo $cur_path;
												// exit();
												$insert[0]['iscomplete']='1';
												$insert[0]['completedate']=date("Y-m-d H:i:s");
												$insert[0]['updateat']=date("Y-m-d H:i:s");
												$insert[0]['updateby']=$this->session->dflogin_staff['staffid'];
												$insert[0]['isapproved']='1';
	
												if(isset($_FILES['appr_attch']) && !empty($_FILES['appr_attch']['name'])){
													$config['upload_path'] = $cur_path."/";
													$config['allowed_types'] = 'gif|jpg|png|svg|jpeg|zip|rar|doc|pdf|xlsx|xlsm|xlsb|xltx|xltm|xls|csv|txt|pptx|ppt|xps|mp4|wmv';
													$config['file_name'] =time()."_".$_FILES['appr_attch']['name'];
													$full_path=$config['upload_path'].$config['file_name'];
													
	
													$this->load->library('upload',$config);
													$this->upload->initialize($config);
													
													if($this->upload->do_upload('appr_attch')){
														
														$uploadData = $this->upload->data();
														 
														$insert[0]['attachment'] =  $uploadData['file_name'];
	
														$res=$this->Model_Db->update(16,$insert,"id",$wf_type_id);
	
														if ($res) 
														{
	
															$where="isactive=1 and id=$document_id ";
															
															$doc_dtl=$this->Model_Db->select(8,null,$where);
															$document_name=$doc_dtl[0]->documentname;
	
															$where="isactive=1 and id=$workflow_admin_id";
															
															$add_wf_dlt=$this->Model_Db->select(11,null,$where);
															
															$wf_name=$add_wf_dlt[0]->workflowname;
	
														   
																	if ($aprove=='1') 
															{
																
																$where="isactive=1 and dwaid=$wfid";
																$all_wf_dtl=$this->Model_Db->select(16,null,$where);
																$all_per=0;
																$appr_per=0;
																foreach ($all_wf_dtl as $key => $value) 
																{
																	$all_per++;
																	if ($value->iscomplete=='1') 
																	{
																		$appr_per++;	
																	}
																	
																}
	
																if ($all_per==$appr_per) 
																{
																	$int[0]['iscomplete']='1';
																	$int[0]['updateat']=date("Y-m-d H:i:s");
																	$int[0]['updateby']=$this->session->dflogin_staff['staffid'];
																	$res1=$this->Model_Db->update(15,$int,"id",$wfid);
	
																	if($res1){
																		$com_id=$this->session->dflogin_staff['entryby'];
	
																		$where="isactive=1 and id=$com_id";
																		
																		$com_dtl=$this->Model_Db->select(1,null,$where);
	
																		$com_email=$com_dtl[0]->companyemail;
	
																		$message="The $wf_name Workflow of $document_name is completed";
	                                                                    
																		
                                                                        
																		$where="isactive=1 and id=$document_id";
																		$doc_nw_dtl=$com_dtl=$this->Model_Db->select(8,null,$where);
																		$move_aftr="assets/Documents_company/".$wf_as_dtl[0]->moveafter."/".$doc_nw_dtl[0]->filename.$doc_nw_dtl[0]->fileext;

																		$old_path=$doc_nw_dtl[0]->documentpath;
																		$new_path=$move_aftr;
																		// echo "$old_path <br> $new_path";
																		// exit();
																		
																		if (rename($old_path,$new_path)) 
																		{
																			$up[0]['documentpath']=$new_path;
																			$up[0]['updateat']=date("Y-m-d H:i:s");
																			$up[0]['updateby']=$this->session->dflogin_staff['entryby'];
																			$rup=$this->Model_Db->update(8,$up,"id",$document_id);
																			if ($rup) {
																				if ($this->Workflow_mail($com_email,$message)) {
																					$data['title']="Alert!";
																					$data['message']="Successfully document is aproved and Workflow Process is completed";
																					$data['status']=true;
																				}else{
																					$data['title']="Alert!";
																					$data['message']="Document is approved and Workflow Process is completed but cannot sent mail to respective department ";
																					$data['status']=false;
																				}
																			} else {
																				$data['title']="Alert!";
																				$data['message']="Document is approved and Workflow Process is completed but ";
																				$data['status']=false;
																			}
																			
																		} else {
																			$data['title']="Alert!";
																			$data['message']="Document is approved and Workflow Process is completed but cannot move to directed location";
																			$data['status']=false;
																		}

																		// if ($this->Workflow_mail($com_email,$message)) {
																		// 	$data['title']="Alert!";
																		// 	$data['message']="Successfully document is aproved and Workflow Process is completed";
																		// 	$data['status']=true;
																		// }else{
																		// 	$data['title']="Alert!";
																		// 	$data['message']="Document is approved and Workflow Process is completed but cannot sent mail to respective department ";
																		// 	$data['status']=false;
																		// }
																		
																		

																		
																		
	
																	}else{
																		$data['title']="Error!";
																		$data['data']="Cannot Update Workflow asign table Data";
																		$data['message']="Cannot Update Workflow assign table Data";
																		$data['status']=false;
																	}
	
																}else{
	
																	if ($wf_as_dtl[0]->isparallel==1) 
																	{
																			$data['title']="Alert!";
																			$data['message']="Successfully document is aproved , Thanks For Your time";
																			$data['status']=true;

																	} else {
																		//Here We Should send email to the next assigned person;


																		$where="isactive=1 and iscomplete=0 and dwaid=$wfid";
																        $all_wf_dtl=$this->Model_Db->select(16,null,$where);

																		if ($all_wf_dtl) {

																					foreach ($all_wf_dtl as $key => $value) 
																				{
																					$next_assignee[]=$value->id;
																					
																				}

																				$next_per=min($next_assignee);

																				$where="isactive=1 and id=".$next_per;
																				
																				
																                $all_wf_dtl=$this->Model_Db->select(16,null,$where);
																				$staffid=$all_wf_dtl[0]->assignedto;
																				$where="isactive=1 and id=$staffid";
																				$staff_dtl_ind=$this->Model_Db->select(5,null,$where);

																		
																		$nxt_staff_id=$staffid;
																		$nxt_staff_email=$staff_dtl_ind[0]->staffemail;
																		
																		$message="Your have assigned to the document  this approval Process,Please Verify the document.<br>Workflow Name : $wf_name<br>Document Name : $document_name";
																		  
																		if ($this->Workflow_mail($nxt_staff_email,$message)) {
																			$data['title']="Alert!";
																			$data['message']="Successfully document is aproved and successfully assigned to next person";
																			$data['status']=true;
																		}else{
																			$data['title']="Alert!";
																			$data['message']="Successfully document is aproved and successfully assigned to next person";
																			$data['status']=false;
																		}
																	 }else{
																		 $data['status']=false;
																		 $data['message']="No Workflow Data found";
																		 $data['data']="No Workflow Data found";
																	 }
																	}
								
																}
	
															}else{

																$int[0]['iscomplete']='0';
																$int[0]['updateat']=date("Y-m-d H:i:s");
																$int[0]['updateby']=$this->session->dflogin_staff['staffid'];
																$res2=$this->Model_Db->update(15,$int,"id",$wfid);
	
																if($res2){
																	
																	$com_id=$this->session->dflogin_staff['entryby'];
																	
																	$where="isactive=1 and id=$com_id";
																	
																	$com_dtl=$this->Model_Db->select(1,null,$where);
	
																	$com_email=$com_dtl[0]->companyemail;
	
																	$message="The $wf_name Workflow of $document_name is completed";
	
																	if ($this->Workflow_mail($com_email,$message)) {
																		$data['title']="Alert!";
																		$data['message']="Successfully document is rejected and Workflow Process is completed";
																		$data['status']=true;
																	}else{
																		$data['title']="Alert!";
																		$data['message']="Document  is rejected and Workflow Process is completed but cannot sent mail to respective department ";
																		$data['status']=false;
																	}
	
																}else{
																	$data['title']="Error!";
																	$data['data']="Cannot Update Workflow asign table Data";
																	$data['message']="Cannot Update Workflow assign table Data";
																	$data['status']=false;
																}

															}
	
														} else {
															$data['title']="Error!";
															$data['data']="Cannot Update Workflow type Data";
															$data['message']="Cannot Update Workflow type Data";
															$data['status']=false;
														}
												
													}else{                  
														$data['status']=false;
														$data['data'] = $this->upload->display_errors();                  
													}
												}
	
												// $insert[0]['updateby'] = $this->session->dflogin['companyid'];
												// $insert[0]['updateat']=date("Y-m-d H:i:s");
												// $res=$this->Model_Db->update(5,$insert,"id",$request->txtid);
	
											}else{
												$data['title']="Error!";
												$data['data']="Workflow Deadline already exceeded";
												$data['message']="Workflow Deadline already exceeded";
												$data['status']=false;  
											}
			
										}

									}else{
	
										$data['title']="Error!";
										$data['data']="Invalid Workflow Details input data";
										$data['message']="Invalid Workflow Details input data";
										$data['status']=false;
									}
								
								// } else {
								// 	    $data['title']="Error!";
								// 		$data['data']="Invalid Access";
								// 		$data['message']="Invalid Access";
								// 		$data['status']=false;
								// }
						
						// if ($data['status']==true) 
						// {
						// 	$data['individual__workflow_detail']=$this->staff_cur_wf_details($wfid,$staffid);//here to get current Workflow Details with the current staff;
						// }else{
						// 	$data['status']=false;
						// 	$data['message']="there is no details found";
						// }
						
					
					}else{
						$data['title']="Error!";
						$data['data']="Error in input data";
						$data['status']=false;

					}

					echo json_encode($data);
					exit();
			
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }

	}
    // the below method should be used for get workflow detiails assigned staff wise and all the details of the current workflow will be returned
	public function staff_cur_wf_details($wf_asid,$staffid)
	{
		try{
			if (isset($this->session->dflogin_staff)  ) 
			{
					$data=array();
					$insert=array();
					$status= true;

					
				    
					if (isset($wf_asid) && is_numeric($wf_asid) && $wf_asid>0) 
					{
						
					} else {
						$status= false;
						
					}
					if (isset($staffid) && is_numeric($staffid) && $staffid>0) 
					{
						
					} else {
						$status= false;
					
					}
					

					if ($status) 
					{

						$where="isactive=1 and dwaid=$wf_asid";
						$work_htr_data=$this->Model_Db->select(16,null,$where);
                        
						$where="isactive=1 and id=$wf_asid";
                        $work_assign=$this->Model_Db->select(15,null,$where);
						
						$where="isactive=1 and id=".$work_assign[0]->dwaid;
                        $workflow=$this->Model_Db->select(11,null,$where);

						

						$data['doc_wf_ind']['workflow']=$workflow[0];
						$data['doc_wf_ind']['workflow_assign']=$work_assign[0];

						if ($work_htr_data) 
						{
									foreach ($work_htr_data as $key => $value) 
								{
									$data['workflow_data'][]=$value;
								}

								if($value->assignedto==$staffid)
								{
									$data['doc_wf_ind']['staff_workflow_dtl']=$value;
								}
								
							
						}else{
						return false;
						}
	
					} else {

						return false;

					}

				    echo json_encode($data);
					exit();
			
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }

	}





	public function get_wf_dtl_ind()
	{
		try{
			if ( isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1' )) 
			{
					$data=array();
					
					$status=true;

					// if (isset($this->session->workflow_id)) 
					// {
					// 	$wfid=$this->session->workflow_id;
					// }

					$wfid="12";
				    
					if (isset($wfid) && is_numeric($wfid) && $wfid>0) 
					{
						
					} else {
						$data['data']="Invalid Workflow id";
						$status=false;
					}



					if ($status) 
					{
						
						

						$where="isactive=1 and dwaid=$wfid";
						$work_htr_data=$this->Model_Db->select(16,null,$where);

						
                        
						// echo "<pre>";
						// print_r($ind_wf_dtl);
						// exit();
						
						

                        
						$where="isactive=1 and id=$wfid";
                        $work_assign=$this->Model_Db->select(15,null,$where);

						
						
						$where="isactive=1 and id=".$work_assign[0]->workflowid;
						
                        $workflow=$this->Model_Db->select(11,null,$where);

						$where="isactive=1 and id=".$work_assign[0]->documentid;
						
                        $document=$this->Model_Db->select(8,null,$where);

						$data['doc_dtl']=$document[0];



						$data['doc_wf_ind']['workflow']=$workflow[0];
						$data['doc_wf_ind']['workflow_assign']=$work_assign[0];
                        
						if ($work_htr_data) 
						{
							$count=0;
						    $wf_apr=0;
							$completed=0;
							$rj=0;
									foreach ($work_htr_data as $key => $value) 
								{
									$data['workflow_data'][]=$value;
									$count++;
									if ($value->iscomplete=="1" ) {
										$completed++;
									}
									if ($value->isapproved=="1") 
									{
										$wf_apr++;
									}
									if ($value->isapproved=="0" && $value->iscomplete=="1") 
									{
										$rj++;
									}

								}
								if ($count==$completed && $wf_apr==$completed) 
								{
									$data['wf_status']="Approved";
								} elseif($count==$completed && $wf_apr!=$completed){
									$data['wf_status']="Rejected";
								}elseif($count!=$completed){
									$data['wf_status']="Pending";
								}
								elseif($rj>0)
								{
									$data['wf_status']="Rejected";
								}
								
								
								$data['status']=true;
							
						}else{
						$data['status']=false;
						$data['message']="No Workflow History Found";
						$data['data']="No Workflow History Found";
						}

						foreach ($data['workflow_data'] as $key => $value) 
						{
							$id=$value->assignedto;
							$where="isactive=1 and id=".$id;
						    $staff=$this->Model_Db->select(5,null,$where);

							if ($staff) 
							{
								$data['staff_name'][]=$staff[0]->staffname;
							}else{
								$data['staff_name'][]=false;
							}

						}
	
					} else {

						$data['message']="Somethind Gone Wrong";
						$data['status']=false;

					}

				    echo json_encode($data);
					exit();
			
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
	}

	public function get_wf_dtl()
	{
		try{
			if ((isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1' ) || isset($this->session->dflogin)) 
			{ 
				$wf_id=base64_decode($_GET['I']);

				if ($this->session->workflow_id) {
					$this->session->unset_userdata("workflow_id");
				}
				$this->session->set_userdata('workflow_id',$wf_id);

				$this->load->view('include/header');
			    $this->load->view('wf_htr/workflow_hst_dtl');
				$this->load->view('include/footer');
				$this->load->view('wf_htr/workflow_hst_dtlScript');
				
                


            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
	}


	  




	public function ind_wf_dtl()
	{
		try{
			if ((isset($this->session->dflogin_staff) )) 
			{
					$data=array();
					$insert=array();
					$status=true;

					// $wfid=base64_decode($_GET['WF']);
					$wfid="12";
				    
					if (isset($wfid) && is_numeric($wfid) && $wfid>0) 
					{
						
					} else {
						$data['data']="Invalid Workflow id";
						$status=false;
					}



					if ($status) 
					{
						$data['this_id']=$this->session->dflogin_staff['staffid'];
						$staffid=$this->session->dflogin_staff['staffid'];

						$where="isactive=1 and dwaid=$wfid";
						$work_htr_data=$this->Model_Db->select(16,null,$where);

						$where="isactive=1 and dwaid=$wfid and assignedto=$staffid";
						$ind_wf_dtl=$this->Model_Db->select(16,null,$where);
                        
						// echo "<pre>";
						// print_r($ind_wf_dtl);
						// exit();
						
						if ($ind_wf_dtl[0]->iscomplete=="1") 
						{
							$data['iscompleted']=true;
							$data['ind_dtl']=$ind_wf_dtl[0];
						}else{
							$data['iscompleted']=false;
						}

                        
						$where="isactive=1 and id=$wfid";
                        $work_assign=$this->Model_Db->select(15,null,$where);

						
						
						$where="isactive=1 and id=".$work_assign[0]->workflowid;
						
                        $workflow=$this->Model_Db->select(11,null,$where);

						$where="isactive=1 and id=".$work_assign[0]->documentid;
						
                        $document=$this->Model_Db->select(8,null,$where);

						$data['doc_dtl']=$document[0];



						$data['doc_wf_ind']['workflow']=$workflow[0];
						$data['doc_wf_ind']['workflow_assign']=$work_assign[0];
                        
						if ($work_htr_data) 
						{
							$count=0;
						    $wf_apr=0;
							$completed=0;
							$rj=0;
									foreach ($work_htr_data as $key => $value) 
								{
									$data['workflow_data'][]=$value;
									$count++;
									if ($value->iscomplete=="1" ) {
										$completed++;
									}
									if ($value->isapproved=="1") 
									{
										$wf_apr++;
									}
									if ($value->isapproved=="0" && $value->iscomplete=="1") 
									{
										$rj++;
									}

								}
								if ($count==$completed && $wf_apr==$completed) 
								{
									$data['wf_status']="Approved";
								} elseif($count==$completed && $wf_apr!=$completed){
									$data['wf_status']="Rejected";
								}elseif($count!=$completed){
									$data['wf_status']="Pending";
								}
								elseif($rj>0){
									$data['wf_status']="Rejected";
								}

								
								$data['status']=true;
							
						}else{
						$data['status']=false;
						$data['message']="No Workflow History Found";
						$data['data']="No Workflow History Found";
						}

						foreach ($data['workflow_data'] as $key => $value) 
						{
							$id=$value->assignedto;
							$where="isactive=1 and id=".$id;
						    $staff=$this->Model_Db->select(5,null,$where);

							if ($staff) 
							{
								$data['staff_name'][]=$staff[0]->staffname;
							}else{
								$data['staff_name'][]=false;
							}

						}
	
					} else {

						$data['message']="Somethind Gone Wrong";
						$data['status']=false;

					}

				    echo json_encode($data);
					exit();
			
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
	}



	public function Workflow_hst_detail()
	{
		try{
			if ( (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid'] =="1") ) ) 
			{
					$data=array();
					$insert=array();
					$status=true;
				    if ($this->session->dflogin) 
					{
						$com_id=$this->session->dflogin['companyid'];
					}elseif ($this->session->dflogin_staff) 
					{
						$com_id=$this->session->dflogin_staff['entryby'];
					}
                    

					$where="isactive=1 and entryby=$com_id";

				    $work_htr_data=$this->Model_Db->select(15,null,$where);
					if ($work_htr_data) 
					{
								foreach ($work_htr_data as $key => $value) 
							{
								$data['workflow_history'][]=$value;

								$doc_id=$value->documentid;
                                $where="isactive=1 and id=$doc_id";
								$doc_dtl=$this->Model_Db->select(8,null,$where);
								$data['doc_dtl'][]=$doc_dtl[0];
								  
								$wfid=$value->id;

								$where="isactive=1 and dwaid=$wfid";
								$work_htr_data=$this->Model_Db->select(16,null,$where);
                                
								if ($work_htr_data) 
								{

									$count=0;
						    $wf_apr=0;
							$completed=0;
							$rj=0;
									foreach ($work_htr_data as $k => $v) 
								{
									
									$count++;
									if ($v->iscomplete=="1" ) {
										$completed++;
									}
									if ($v->isapproved=="1") 
									{
										$wf_apr++;
									}
									if ($v->isapproved=="0" && $v->iscomplete=="1") 
									{
										$rj++;
									}

								}
								if ($count==$completed && $wf_apr==$completed) 
								{
									$data['wf_status'][]="Approved";
								} elseif($count==$completed && $wf_apr!=$completed){
									$data['wf_status'][]="Rejected";
								}elseif($count!=$completed){
									$data['wf_status'][]="Pending";
								}
								elseif($rj>0){
									$data['wf_status'][]="Rejected";
								}
                                
								}



							}
							$data['status']=true;
						
					}else{
                       $data['status']=false;
					   $data['message']="No Workflow History Found";
					   $data['data']="No Workflow History Found";
					}

				    echo json_encode($data);
					exit();
			
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
	}





	public function get_doc_wfdtl()
	{
		try{
			if ( (isset($this->session->dflogin_staff) ) ) 
			{
				// if($this->session->dflogin['typeid']==1 || ($this->session->dflogin['typeid']==2 && $this->session->dflogin['entry']==1)) {
					$data=array();
					$insert=array();
					$status=true;
					$request = json_decode(json_encode($_POST), FALSE);

					$wf_as_id=$request->doc_id;  //document id to be sent when we click the notification button to the approval details page

                    $where="id=$wf_as_id and isactive=1";
					$get_wf_dtl=$this->Model_Db->select(15,null,$where);

					if ($get_wf_dtl!=false) 
					{
						$data['status']=true;
						$data['assign_dtl']=$get_wf_dtl[0];
						$wf_as_id=$get_wf_dtl[0]->id;

						$where="isactive=1 and dwaid=$wf_as_id";
						$wf_steps=$this->Model_Db->select(16,null,$where);

						if ($wf_steps!=false) 
						{
							foreach ($wf_steps as $key => $value) 
							{
								$data['doc_workflow_steps'][]=$value;
							}
						}else{
							$data['doc_workflow_steps']=false;
						}
					}else{
						$data['assign_dtl']=false;
						$data['doc_workflow_steps']=false;
						$data['status']=false;
					}

					echo json_encode($data);
					exit();
			
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
	}


	public function get_dir()
	{
		try {
			if (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1')) 
			{

				$path = $this->session->basefolder;
				$directory = array_diff(scandir($path), array('..', '.'));
				if (count($directory) > 0) {
				
					$data['status'] = true;
					foreach ($directory as $d) {
		
						$data['data'][] = array(
							'directory' => $path . '/' . $d,
							'directory_name' => $d
							
					);
					}
				}
				echo json_encode($data);
				exit();
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}


	
public function Workflow_mail($email,$message)
{
	
	$this->load->library('email');
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.atreyaassociates.com',
					'smtp_port' => 465,
					'smtp_user' => 'testing@atreyaassociates.com',
					'smtp_pass' => 'pCbNEqq0yE~[',
					'smtp_crypto' => 'ssl',
					'mailtype' => 'html',
					// 'smtp_timeout' => '4',
					'charset' => 'utf-8',
					'wordwrap' => TRUE
				);
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('testing@atreyaassociates.com', 'Atreya Associates');
				$this->email->to($email);
				$this->email->subject('Assigned to a Workflow');
				
				
				$this->email->message($message);
	
				if($this->email->send()){
				return true;
				}else {
				return false; 
				}		
		
}

public function getsubname()
	{
		try {
			if (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1')) 
			{
				$data = array();
				$request = json_decode(json_encode($_POST), FALSE);
				$subfolder =  $request->dname;
				$this->session->set_userdata('current_path', $request->dname);
				$subdirectory = array_diff(scandir($subfolder), array('..', '.'));
				if (count($subdirectory) > 0) {
					$data['status'] = true;
					$data['data'] = array(
						'subdircount' => 0,
						'filescount' => 0,
						'subdir' => array(),
						'files' => array()
					);
					foreach ($subdirectory as $s) {
						if (strpos($s, ".")) {
							
						} else {
							$data['data']['subdircount'] += 1;
							$data['data']['subdir'][] = array(
								'subdirectory' => $s
							);
						}
					}
				} else {
					$data['status'] = false;
				}
				echo json_encode($data);
				exit();
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}


	public function workflow_approval()
	{
		try {
			if ( (isset($this->session->dflogin_staff) )) 
			{
				$this->load->view('include/header');
				// $this->load->view('include/topbar');
				// $this->load->view('include/menubar');
				$this->load->view('doc_wf/work_approval');
				$this->load->view('include/footer');
				$this->load->view('doc_wf/doc_wf_aprovalScript');
				// $data = array();
				// $request = json_decode(json_encode($_POST), FALSE);
				// $subfolder =  $request->dname;
				// $this->session->set_userdata('current_path', $request->dname);
				// $subdirectory = array_diff(scandir($subfolder), array('..', '.'));
				// if (count($subdirectory) > 0) {
				// 	$data['status'] = true;
				// 	$data['data'] = array(
				// 		'subdircount' => 0,
				// 		'filescount' => 0,
				// 		'subdir' => array(),
				// 		'files' => array()
				// 	);
				// 	foreach ($subdirectory as $s) {
				// 		if (strpos($s, ".")) {
							
				// 		} else {
				// 			$data['data']['subdircount'] += 1;
				// 			$data['data']['subdir'][] = array(
				// 				'subdirectory' => $s
				// 			);
				// 		}
				// 	}
				// } else {
				// 	$data['status'] = false;
				// }
				// echo json_encode($data);
				// exit();
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}



    public function r_pc(){
        try{
			if (isset($this->session->dflogin_admin) ) {
				
					// $where="isactve=1";
					$adminid=$this->session->dflogin_admin['adminid'];
					$where="entryby=".$adminid;
					$orderby="id asc";
					$res=$this->Model_Db->select(11,null,$where,$orderby);
					if($res){
						foreach ($res as $r){
							$data['status']=true;
							$data['data'][]=array(
								'id'=>$r->id,
								'wfnm'=>$r->workflowname,
								'isactive'=>$r->isactive
							);
						}
					}else{
						$data['title']="Alert!";
						$data['message']="No data found.";
						$data['status']=false;
					}
					echo json_encode($data);
					exit();
				
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }


    public function edit_pc(){
        try{
			if (isset($this->session->dflogin_admin)) {
				
					extract($_POST);
					if(isset($id) && $id>0 && is_numeric($id)){
						$where="id=$id and isactive=true";
						$res=$this->Model_Db->select(11,null,$where);
						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
									'wfnm'=>$r->workflowname,
									'isactive'=>$r->isactive
								);
							}
							$this->session->set_tempdata('editForm',$data['data'][0],120);
						}else{
							$data['title']="Alert!";
							$data['message']="Sorry,unable to edit this row.";
							$data['status']=false;
							echo json_encode($data);
							exit();
						}
						echo json_encode($data);
					}else{
						$data['title']="Alert!";
						$data['message']="Sorry,unable to edit this row.";
						$data['status']=false;
					}
				
            }else{
                redirect('Welcome/');
            }
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }


    public function active_inactive_pc(){
        try{
			if (isset($this->session->dflogin_admin)) {
				
					$request=json_decode(json_encode($_POST));
					$data=array();
					if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0){
						$where="id=$request->rowid";
						$update=array();
						$update[]=array(
							'updateby'=>$this->session->dflogin['adminid'],
							'updateat'=>date('Y-m-d H:i:s')
						);
						if(isset($request->isactive) && is_numeric($request->isactive)){
							if ($request->isactive==1){
								$update[0]['isactive']=false;
								$where.=" and isactive=true";
							}elseif ($request->isactive==0){
								$update[0]['isactive']=true;
								$where.=" and isactive=false";
							}else{
								$data['status']=false;
								$data['title']="Bad request";
								$data['message']="Invalid request for delete";
								echo json_encode($data);
								exit();
							}
						}
						$res=$this->Model_Db->select(11,null,$where);
						if($res!=false){
							$result=$this->Model_Db->update(11,$update,'id',$request->rowid);
							if($result!=false){
								$data['status']=true;
								$data['title']="Alert!!";
								$data['message']="Excution successfully";
							}else{
								$data['status']=false;
								$data['title']="Delete failed.";
								$data['message']="Some error occurred .Please try again.";
							}
						}else{
							$data['status']=false;
							$data['title']="Invalid rowid";
							$data['message']="Invalid request for delete";
						}
						echo json_encode($data);
					}else{
						$data['status']=false;
						$data['title']="Bad request";
						$data['message']="Invalid request generated.";
						echo json_encode($data);
					}
				
            }else{
                redirect('Welcome/');
            }

        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }

}
?>