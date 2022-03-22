<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Department extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
	
    public function index()
    {
        try {
			if (isset($this->session->dflogin_admin)) {
			
					$this->load->view('include/header');
					$this->load->view('include/topbar');
					$this->load->view('admin/menubar');
					$this->load->view('masterforms/department/department');
					$this->load->view('include/footer');
					$this->load->view('masterforms/department/department_script');
			
            } else {
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
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
					// $segment=explode(':',$request->frm_data);
					// $key = base64_decode($segment[0]);
					// $iv =  base64_decode($segment[2]);
					// $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
					// $datalist =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
					// $request = json_decode($datalist);
					
					if(isset($request->txtDpname) && preg_match('/^[0-9a-zA-Z ]{0,50}$/',$request->txtDpname)){
						$insert[0]['deptname']=$request->txtDpname;
					}else{
						$data['title']="Alert!";
						$data['message']="Department name error";
						$status=false;
					}

                    if (isset($_FILES)) 
                 {
                    if(!empty($_FILES['dep_logo']['name'])){
                        $config['upload_path'] = "assets/dep_logo/";
                        $config['allowed_types'] = 'jpg|png|svg|jpeg';
                        $config['file_name'] =rand(100000,999999)."_".$_FILES['dep_logo']['name'];
                        
                        
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);
                        
                        if($this->upload->do_upload('dep_logo')){
                            $uploadData = $this->upload->data();
                            $insert[0]['deptlogo'] =  $uploadData['file_name'];
                            // if (isset($prev_data) && isset($prev_data[0]->cvpath)) 
                            // {
                            //     $file_path="./assets/dep_logo/".$prev_data[0]->cvpath;
                            //     unlink($file_path);
                            // }
                        }else{                  
                            $status=false;
                            $data['data'] = $this->upload->display_errors();                  
                        }
                    }
                 }
                 
                //  echo "<pre>";
                //  print_r($_FILES);
                //  exit();
                 
					if($status){
						if(isset($request->txtid) && is_numeric($request->txtid)){
							if($request->txtid>0){
								if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
									$insert[0]['updateby'] = $this->session->dflogin_admin['adminid'];
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
								$insert[0]['entryby']=$this->session->dflogin_admin['adminid'];
								$insert[0]['entryat']=date("Y-m-d H:i:s");



								$res=$this->Model_Db->insert(2,$insert);
								if($res!=false){
									$data['title']="Alert!";
									$data['message']="Department created successfully.";
									$data['status']=true;
								}else{
									$data['title']="Alert!";
									$data['message']="Department creating failed";
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


    public function r_pc(){
        try{
			if (isset($this->session->dflogin_admin) ) {
				    //  $companyid=$this->session->dflogin['adminid'];
					
					// echo $where;
					// exit();
					$orderby="id asc";
					$res=$this->Model_Db->select(2,null,null,$orderby);
					if($res){
						foreach ($res as $r){
							$data['status']=true;
							$data['data'][]=array(
								'id'=>$r->id,
								'deptname'=>$r->deptname,
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
			if (isset($this->session->dflogin_admin)) {
				
					$request=json_decode(json_encode($_POST));
					$data=array();
					if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0){
						$where="id=$request->rowid";
						$update=array();
						$update[]=array(
							'updateby'=>$this->session->dflogin_admin['adminid'],
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
						$res=$this->Model_Db->select(2,null,$where);
						if($res!=false){
							$result=$this->Model_Db->update(2,$update,'id',$request->rowid);
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
