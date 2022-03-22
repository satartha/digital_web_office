<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Staff extends CI_Controller
{

	public function index()
	{
		try {
			if (isset($this->session->dflogin)) {
				
					$this->load->view('include/header');
					$this->load->view('include/topbar');
					$this->load->view('include/menubar');
					$this->load->view('masterforms/staff/staff');
					$this->load->view('include/footer');
					$this->load->view('masterforms/staff/staff_script');
				
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}
	public function c_candidate(){
		try{
			if (isset($this->session->dflogin) ) {


				
					$data=array();
					$insert=array();
					$status=true;
					$request = json_decode(json_encode($_POST), FALSE);
					
	//				$segment=explode(':',$request->frm_data);
	//				$key = base64_decode($segment[0]);
	//				$iv =  base64_decode($segment[2]);
	//				$decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
	//				$datalist =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
	//				$request = json_decode($datalist);
	            //    echo "<pre>";
				//    print_r($request);
				//    print_r($_FILES[''])
				//    exit();


					$config['upload_path']          = './assets/staff_image';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2048;
					$config['max_width']            = 2048;
					$config['max_height']           = 2048;
					$config['file_name']           = 'Staff_photo'.date("Y-m-d@H-i-s");
					$this->load->library('upload', $config);
					if ( $this->upload->do_upload('txtPic')){
						$upload_photo = $this->upload->data();
						$insert[0]['staffpic']=$upload_photo['file_name'] ;
					}
	//				if(isset($request->cboTp) && preg_match('/^[0-9]{1,3}$/',$request->cboTp)){
	//					$insert[0]['ctype']=$request->cboTp;
	//				}else{
	//					$data['title']="Alert!";
	//					$data['message']="Candidate Type error";
	//					$status=false;
	//				}
					if (isset($request->txtCnm) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->txtCnm)) {
						$insert[0]['staffname'] = $request->txtCnm;
					} else {
						$data['title'] = "Alert!";
						$data['message'] = "Name error";
						$status = false;
					}

					

					// if (isset($request->password) && preg_match('/^[a-zA-Z0-9 ]{8,20}$/', $request->password)) {
					// 	$insert[0]['password'] = password_hash($request->password,PASSWORD_DEFAULT);
					// } 


					if (isset($request->password) && preg_match('/^[a-zA-Z0-9.@$]{8,20}$/', $request->password)) {
                        $insert[0]['password'] = password_hash($request->password,PASSWORD_DEFAULT);
                    } else {

                        if (isset($request->txtid) && is_numeric($request->txtid) && $request->txtid==0) {
                            $data['title'] = "Alert!";
                            $data['message'] = "Invalid  Password";
                            $status = false;
                        }
                       
                    }







                    
					if (isset($request->txtMob) && $request->txtMob !="") {
						if(preg_match("/^[6,7,8,9]{1}+[0-9]{9}$/",$request->txtMob)){
							$insert[0]['staffmobile'] = $request->txtMob;
						}else{
							$data['title'] = "Alert!";
							$data['message'] = "Enter Valid Mobile Number";
							$status = false;
						}
					}
					if (isset($request->txtAds) && $request->txtAds !="") {
						if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->txtAds)){
							$insert[0]['staffaddress'] = $request->txtAds;
						}else{
							$data['title'] = "Alert!";
							$data['message'] = "Address Error";
							$status = false;
						}
					}
					if (isset($request->txtMail) && $request->txtMail !="") {
						if(preg_match("/^[@.a-zA-Z0-9]{0,50}$/",$request->txtMail)){
							$insert[0]['staffemail'] = $request->txtMail;
						}else{
							$data['title'] = "Alert!";
							$data['message'] = "Email Error";
							$status = false;
						}
					}
					if (isset($request->cboGender) && preg_match('/^[0-9]{1,2}$/', $request->cboGender)) {
						$insert[0]['staffgender'] = $request->cboGender;
					}
					if (isset($request->dob) ) {
						$insert[0]['staffdob'] = $request->dob;
					}


					// if (isset($request->companydeptid) && is_numeric($request->companydeptid) ) 
                    // {
						
						if (isset($request->usertype)) {
							$insert[0]['usertypeid'] = $request->usertype;
						}
					// }else{
                    //     $status=false;
                    //     $data['title']=$request->companydeptid;
                    //     $data['message'] = "Departmentid Error";
                    // }

                    // if (isset($request->companydeptid) && is_numeric($request->companydeptid) ) 
                    // {
						
						if (isset($request->companydeptid)) {
							$insert[0]['companydeptid'] = $request->companydeptid;
						}
					// }else{
                    //     $status=false;
                    //     $data['title']=$request->companydeptid;
                    //     $data['message'] = "Departmentid Error";
                    // }
					if (isset($request->staff_age) && preg_match('/^[1-9]{1}[0-9]{1,}$/', $request->staff_age)) {
						$insert[0]['staffage'] = $request->staff_age;
					}

					if($status){
						if(isset($request->txtid) && is_numeric($request->txtid)){
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
								$insert[0]['entryby']=$this->session->dflogin['companyid'];
                                // $insert[0]['companyid']=$this->session->dflogin['companyid'];
								$insert[0]['entryat']=date("Y-m-d H:i:s");
								$res=$this->Model_Db->insert(5,$insert);
								if($res!=false){
									$data['title']="Alert!";
									$data['message']="Staff created successfully.";
									$data['status']=true;
								}else{
									$data['title']="Alert!";
									$data['message']="Staff creating failed";
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

    public function dept_dtl_nw($id)
    {
		$where="id=$id and isactive=1";
        $res_map=$this->Model_Db->select(4,null,$where);
        $deptid=$res_map[0]->deptid;
        $where="id=$deptid";
        $res=$this->Model_Db->select(2,null,$where);
        return $res[0]->deptname;

    }

	public function dept_dtl($id)
    {
		
        $where="id=$id";
        $res=$this->Model_Db->select(2,null,$where);
        return $res[0];

    }

	public function user_t_dtl($id)
    {
        $where="id=$id ";
        $res=$this->Model_Db->select(6,null,$where);
        return $res[0];

    }
	public function r_candidate(){
		try{
			if (isset($this->session->dflogin)) {
				
					// $where="1=1";
					$companyid=$this->session->dflogin['companyid'];
					$where="entryby=".$companyid;
					$orderby="id asc";
					$res=$this->Model_Db->select(5,null,$where,$orderby);
                    $coM_id=$this->session->dflogin['companyid'];
                    $where="companyid=$coM_id and isactive=1";
                    $res_map=$this->Model_Db->select(4,null,$where,$orderby);
                    $where="isactive=1";
                    $user=$this->Model_Db->select(6,null,$where);
					$where="entryby=$coM_id and isactive=1";
                    $des=$this->Model_Db->select(3,null,$where,$orderby);

					if($des){
                        foreach ($des as $k => $v) 
                        {
                            $data['des'][]=$v;
                        }
                    }
                    
                    if($user){
                        foreach ($user as $k => $v) 
                        {
                            $data['user'][]=$v;
                        }
                    }
                    if ($res_map) 
                    {
                        foreach ($res_map as $key => $value) 
                        {
                            $data['dept_data'][]=array(
                                'dept_dtl'=>$this->dept_dtl($value->deptid),
                                'id'=> $value->id
                            );
                        }
                    }
					if($res){
						$i=0;
						foreach ($res as $r){
							$data['status']=true;
							$data['data'][$i]['id']=$r->id;
	//						$data['data'][$i]['ctype']=$r->ctype;
							$data['data'][$i]['name']=$r->staffname;
							$data['data'][$i]['mobile']=$r->staffmobile;
							$data['data'][$i]['address']=$r->staffaddress;
							$data['data'][$i]['email']=$r->staffemail;
							$data['data'][$i]['deptname']=$this->dept_dtl_nw($r->companydeptid);
							$data['data'][$i]['gender']=$r->staffgender;
							$data['data'][$i]['age']=$r->staffage;
							$data['data'][$i]['dob']=$r->staffdob;
							$data['data'][$i]['image']=$r->staffpic;
							$data['data'][$i]['isactive']=$r->isactive;
							$i++;
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
	public function active_inactive_candidate(){
		try{
			if (isset($this->session->dflogin) ) {
			
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
						$res=$this->Model_Db->select(5,null,$where);
						if($res!=false){
							$result=$this->Model_Db->update(5,$update,'id',$request->rowid);
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

    

	public function edit_candidate(){
		try{
			if (isset($this->session->dflogin) ) {
				
					extract($_POST);
					if(isset($id) && $id>0 && is_numeric($id)){
						$where="id=$id and isactive=true";
						$res=$this->Model_Db->select(5,null,$where);

						$orderby="id asc";
						$coM_id=$this->session->dflogin['companyid'];
                    $where="companyid=$coM_id and isactive=1";
                    $res_map=$this->Model_Db->select(4,null,$where,$orderby);
                    $where="isactive=1";
                    $user=$this->Model_Db->select(6,null,$where);
                    
                    if($user){
                        foreach ($user as $k => $v) 
                        {
                            $data['user'][]=$v;
                        }
                    }
                    if ($res_map) 
                    {
                        foreach ($res_map as $key => $value) 
                        {
                            $data['dept_data'][]=array(
                                'dept_dtl'=>$this->dept_dtl($value->deptid),
                                'id'=> $value->id
                            );
                        }
                    }

					$genderr=$this->Model_Default->gender();
					foreach ($genderr as $value) 
					{
						$data['gender'][]=$value;
					}

					

						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
	                            //	'ctype'=>$r->ctype,
	                                'companydeptid'=>$r->companydeptid,
									'usertypeid'=>$r->usertypeid,
									
									'name'=>$r->staffname,
									'mobile'=>$r->staffmobile,
									'address'=>$r->staffaddress,
									'email'=>$r->staffemail,
									'staffage'=>$r->staffage,
									'staffdob'=>$r->staffdob,
									'gender'=>$r->staffgender,
									'image'=>$r->staffpic,
									'password'=>$r->password,
									'usertype'=>$r->usertypeid,
									'department'=>$r->companydeptid,
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
}
