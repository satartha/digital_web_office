<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Dept_mapping extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
			// if (isset($this->session->dflogin) && $this->session->dflogin['typeid']<=2) {
			
					$this->load->view('include/header');
					$this->load->view('include/topbar');
					$this->load->view('include/menubar');
					$this->load->view('masterforms/dept_mapping/dept_mapping');
					$this->load->view('include/footer');
					$this->load->view('masterforms/dept_mapping/dept_mapping_script');
			
            // } else {
            //     redirect('Welcome/');
            // }
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }

    

    public function c_dp(){
        try{
			if (isset($this->session->dflogin) ) {
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
					
					if(isset($request->dept_map) && is_numeric($request->dept_map)){
						$insert[0]['deptid']=$request->dept_map;
						$where="id=".$request->dept_map;
                        $dep_dtl=$this->Model_Db->select(2,null,$where);
						$dep_name=$dep_dtl[0]->deptname;


					}else{
						$data['title']="Alert!";
						$data['message']="Department name error";
						$status=false;
					}





                    
                //  echo "<pre>";

                //  print_r($_FILES);

                //  exit();
                 
					if($status){
						if(isset($request->txtid) && is_numeric($request->txtid)){
							if($request->txtid>0){
								if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
									$insert[0]['updateby'] = $this->session->dflogin['companyid'];
									$insert[0]['updateat']=date("Y-m-d H:i:s");
									$res=$this->Model_Db->update(2,$insert,"id",$request->txtid);
									if($res!=false){
										$data['title']="Alert!!";
										$data['message']="Department updated successfully.";
										$data['status']=true;
										$this->session->unset_tempdata('editForm');
									}else{
										$data['title']="Alert!!";
										$data['message']="Department updating failed";
										$data['status']=false;
									}
								}else{
									$data['status']=false;
									$data['title']='Time out';
									$data['message']='You have exceeded the max time limit of 30 seconds to edit this form.';
								}
							}else if($request->txtid==0){
								$insert[0]['entryby']=$this->session->dflogin['companyid'];
                                $insert[0]['companyid']=$this->session->dflogin['companyid'];
								$insert[0]['entryat']=date("Y-m-d H:i:s");



								
								//==========================Folder creation Started================
                                
                                $folder_path=$this->session->dflogin['folderpath'];
                                
                                $upload_path=$folder_path.'/'.str_replace(' ','_',$dep_name);
                                $createfile="assets/Documents_company/".$upload_path;
                               
                                if (!file_exists($createfile)) {
                                    // $data['status']=true;
                                    $r=mkdir($createfile, 0777, true);
                                    if($r){
                                            $insert[0]['folderpath']=$upload_path;
                                            $res=$this->Model_Db->insert(4,$insert);
											if($res!=false){
												$data['title']="Alert!";
												$data['message']="Department Added successfully.";
												$data['status']=true;
											}else{
												$data['title']="Alert!";
												$data['message']="Department Added failed";
												$data['status']=false;
											}

                                    }else{
                                        $data['status']=false;
                                        $data['message']="Main File Not Created";
                                    }
                                }else{
                                    $data['status']=false;
                                    $data['message']="Directory already exist";
                                }


                              //==========================Folder creation Ended================










								
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


    public function r_pc(){
        try{
			if (isset($this->session->dflogin) ) {
				
					// $companyid=$this->session->dflogin['companyid'];
					// $where="entryby=".$companyid;

					$orderby="id asc";
					$res=$this->Model_Db->select(2,null,null,$orderby);
					
                    $coM_id=$this->session->dflogin['companyid'];
                    $where="companyid=$coM_id ";
                    $res_map=$this->Model_Db->select(4,null,$where,$orderby);
                    
					$data['res_or']=$res;
                    $data['map']=$res_map;

					if($res ){

                        if ($res_map) 
                        {
                            foreach ($res as $r){
                                $sts=true;
                              foreach ($res_map as $km){
                                   
                                  if ($r->id==$km->deptid)
                                  {
                                      $data['data'][]=array(
                                          'id'=>$r->id,
                                          'deptname'=>$r->deptname,
                                          'deptid'=>$r->id,
                                          'isactive'=>$r->isactive
                                      );
                                      $sts=false;
                                  }
                              
                                 
                              }
  
                              $data['status']=true;
  
                              if($sts==true)
                              {
                                  $data['data_form'][]=array(
                                      'id'=>$r->id,
                                      'deptname'=>$r->deptname,
                                      'deptid'=>$r->id,
                                      'isactive'=>$r->isactive
                                  );
                              }
  
                          }
                        }else{

                            foreach ($res as $r){

                                $data['data_form'][]=array(
                                    'id'=>$r->id,
                                    'deptname'=>$r->deptname,
                                    'deptid'=>$r->id,
                                    'isactive'=>$r->isactive
                                );

                            }


                        }
					
					}else{
						$data['title']="Alert!";
						$data['message']="No data found.";
						$data['status']=false;
					}
					// echo "<pre>";
					// print_r($data);
					// exit();
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
			if (isset($this->session->dflogin)) {
				
					extract($_POST);
					if(isset($id) && $id>0 && is_numeric($id)){
						$where="id=$id and isactive=true";
						$res=$this->Model_Db->select(2,null,$where);
						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
									'deptname'=>$r->deptname,
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
			if (isset($this->session->dflogin)) {
				
					$request=json_decode(json_encode($_POST));
					$data=array();
					if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0){
						$where="id=$request->rowid";
						$update=array();
						$update[]=array(
							'updateby'=>$this->session->dflogin['companyid'],
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
						$res=$this->Model_Db->select(4,null,$where);
						if($res!=false){
							$result=$this->Model_Db->update(4,$update,'id',$request->rowid);
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
