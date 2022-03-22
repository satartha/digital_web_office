<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function load_include()
	{
		$this->load->view('include/header');
		$this->load->view('include/topbar');
		$this->load->view('include/menubar');
	}

    public function index()
    {
	
		try{
			if(isset($this->session->dflogin_admin)) {

				$this->load->view('include/header');
		        $this->load->view('include/topbar');
		        $this->load->view('admin/menubar');
				$this->load->view('admin/admin_dashboard');
				$this->load->view('include/footer');
				$this->load->view('admin/admin_dashboardScript');

			}else{
				redirect('Welcome/admin');
			}
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}

    }

    // public function create_super()
    // {
    //      $insert[0]=array(
    //          'name'=>'Satartha Prakash Parida',
    //          'mobile'=>'7978425583',
    //          'email'=>'psatarthaprakash@gmail.com',
    //          'address'=>'Bhubaneswar,Odisha',
    //          'usertypeid'=>'1',
    //          'password'=>password_hash('admin1234',PASSWORD_DEFAULT)
    //      );

    //      $res = $this->Model_Db->insert(9, $insert);
    //      if ($res != false) {
    //          echo "superadmin insert successfull";
    //      } else {
    //         echo "superadmin insert failed";
    //      }
    // }



    public function create_company_alt()
    {
        try{
			if(isset($this->session->dflogin_admin)) {

				$this->load->view('include/header');
		        $this->load->view('include/topbar');
		        $this->load->view('admin/menubar');
				$this->load->view('admin/company_create');
				$this->load->view('include/footer');
				$this->load->view('admin/company_createScript');

			}else{
				redirect('Welcome/admin');
			}
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
    }

    public function create_admin_alt()
    {
        try{
			if(isset($this->session->dflogin_admin)) {

				$this->load->view('include/header');
		        $this->load->view('include/topbar');
		        $this->load->view('admin/menubar');
				$this->load->view('admin/admin_create');
				$this->load->view('include/footer');
				$this->load->view('admin/admin_createScript');

			}else{
				redirect('Welcome/admin');
			}
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
    }




    


    public function create_company(){
        try {
            if (isset($this->session->dflogin_admin)) {
                $data = array();
                $insert = array();
                $status = true;
                $request = json_decode(json_encode($_POST), FALSE);
       
                    if (isset($request->comName) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->comName)) {
                        $insert[0]['companyname'] = $request->comName;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Company Name error";
                        $status = false;
                    }
                    if (isset($request->comcode) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->comcode)) {
                        $insert[0]['companycode'] = $request->comcode;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid  Company Code ";
                        $status = false;
                    }
                  

                    if (isset($request->comcode) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->comcode)) {
                        $insert[0]['companycode'] = $request->comcode;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid  Company Code ";
                        $status = false;
                    }


                    if (isset($request->gst) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->gst)) {
                        $insert[0]['gstno'] = $request->gst;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid  GST Number";
                        $status = false;
                    }


                    if (isset($request->regdno) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->regdno)) {
                        $insert[0]['registrationno'] = $request->regdno;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid  Registration Number";
                        $status = false;
                    }
                    
                    if (isset($request->pan) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->pan)) {
                        $insert[0]['pan'] = $request->pan;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid  PAN ";
                        $status = false;
                    }



                    if (isset($request->txtpass) && preg_match('/^[a-zA-Z0-9.@$]{8,20}$/', $request->txtpass)) {
                        $insert[0]['password'] = password_hash($request->txtpass,PASSWORD_DEFAULT);
                    } else {

                        if (isset($request->txtid) && is_numeric($request->txtid) && $request->txtid==0) {
                            $data['title'] = "Alert!";
                            $data['message'] = "Invalid  Password";
                            $status = false;
                        }


                       
                    }

                    if (isset($request->conPer) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->conPer)) {
                        $insert[0]['contactperson'] = $request->conPer;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid  Contact Person Name";
                        $status = false;
                    }

                    // if (isset($request->parentid) && is_numeric($request->parentid)) {
                    //     $insert[0]['parentid'] = $request->parentid;
                    // } else {
                    //     $data['title'] = "Alert!";
                    //     $data['message'] = "Invalid  parent id";
                    //     $status = false;
                    // }

                    if (isset($request->comsrt) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->comsrt)) {
                        $insert[0]['companysrtname'] = $request->comsrt;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Company Short Name error";
                        $status = false;
                    }
                  
                    if(isset($request->txtMobile) && $request->txtMobile !="" && preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$request->txtMobile)){
                        $insert[0]['contactmobile'] = $request->txtMobile;
                    }else{
                        $data['title'] = "Alert!";
                        $data['message'] = "Enter Valid Contact Number";
                        $status = false;
                    }
                 
                    if (isset($request->txtEmail) && preg_match('/^[@.a-zA-Z0-9]{0,50}$/', $request->txtEmail)) {
                        $insert[0]['companyemail'] = $request->txtEmail;
                    }else{
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid Contact Email Id";
                        $status = false;
                    }
                    
                    if (isset($request->txtAddress) && preg_match('/[0-9a-zA-Z, \-\.\(\)\:\/]{0,200}$/', $request->txtAddress)) {
                        $insert[0]['address'] = $request->txtAddress;
                    }else{
                        $data['title'] = "Alert!";
                        $data['message'] = "Enter Valid Address";
                        $status = false;
                    }

                    if (isset($_FILES)) 
                    {
                       if(!empty($_FILES['logo']['name'])){
                           $config['upload_path'] = "assets/com_logo/";
                           $config['allowed_types'] = 'jpg|png|svg|jpeg';
                           $config['file_name'] =rand(100000,999999)."_".$_FILES['logo']['name'];
                           
                           
                           $this->load->library('upload',$config);
                           $this->upload->initialize($config);
                           
                           if($this->upload->do_upload('logo')){
                               $uploadData = $this->upload->data();
                               $insert[0]['logo'] =  $uploadData['file_name'];
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

                   


                  
                    
                    if ($status) {
                        
                        if(isset($request->txtid) && is_numeric($request->txtid)){
                            if($request->txtid>0){
                                if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                                    $insert[0]['updateby'] = $this->session->dflogin_admin['adminid'];
                                    $insert[0]['updateat']=date("Y-m-d H:i:s");
                                    $res=$this->Model_Db->update(1,$insert,"id",$request->txtid);
                                    if($res){
                                        $data['message']="Update successful.";
                                        $data['data']="Company updated successfully.";
                                        $data['status']=true;
                                        $this->session->unset_tempdata('editForm');
                                    }else{
                                        $data['title'] = "Alert!!";
                                        $data['message'] = "Updating failed.";
                                        $data['status'] = false;
                                    }
                                }else{
                                    $data['status']=false;
                                    $data['message']='Invalid edit request';
                                    $data['data']='You have exceeded the max time limit of 30 seconds to edit this form.';
                                }
                            }else if($request->txtid==0){
                                $insert[0]['entryby'] = $this->session->dflogin_admin['adminid'];
                                $insert[0]['entryat'] = date("Y-m-d H:i:s");

                                //==========================Folder creation Started================
                                
                                // $folder_path=$this->session->dflogin['folderpath'];
                                
                                $upload_path=str_replace(' ','_',$request->comName);
                                $createfile="assets/Documents_company/".$upload_path;
                                $rawpath=$createfile."/raw";
                                if (!file_exists($createfile)) {
                                    // $data['status']=true;
                                    $r=mkdir($createfile, 0777, true);
                                    if($r){
                                        $rw=mkdir($rawpath, 0777, true);

                                        if($rw){
                                            $insert[0]['folderpath']=$upload_path;
                                            $res = $this->Model_Db->insert(1, $insert);
                                            if ($res != false) {
                                                $data['title'] = "Alert!";
                                                $data['message'] = "Company created successfully.";
                                                $data['status'] = true;
                                            } else {
                                                $data['title'] = "Alert!";
                                                $data['message'] = "Company creation failed";
                                                $data['status'] = false;
                                            }

                                        }else{
                                            $data['status']=false;
                                            $data['message']="Raw File Not Created";
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
                              
                            }
                        }else{
                            $data['title']="Insufficient/Invalid data.";
                            $data['message']="Some error occurred.Please try again or contact with Admin.";
                            $data['status']=false;
                        }
                        echo json_encode($data);
                        exit();
                    } else {
                        $data['title'] = "Error!";
                        $data['status'] = false;
                        echo json_encode($data);
                        exit();
                    }
            
            } else {
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }

    }


    public function r_admin(){

		try{
			if (isset($this->session->dflogin_admin)) {
				//    $parentid=$this->session->dflogin['companyid'];

                $data['admin_dtl']=$this->session->dflogin_admin;
                $data['usertypeid']=$this->session->dflogin_admin['usertypeid'];

                $adminid=$this->session->dflogin_admin['adminid'];
                $where="entryby=$adminid and isactive=1";
                $company_dtl=$this->Model_Db->select(1,null,$where);
                    if ($company_dtl)
                    {
                        $k=0;
						foreach ($company_dtl as $r){
							
							$data['company'][$k]['com_details']=$r;						
							$k++;
						}
                    }

                if ($data['usertypeid']=='1') 
                {
                    $where="entryby=1";
				$orderby="id asc";
				$res=$this->Model_Db->select(9,null,$where,$orderby);

					if($res){
						$i=0;
						foreach ($res as $r){
							
							$data['admin'][$i]['id']=$r->id;
							$data['admin'][$i]['name']=$r->name;
							$data['admin'][$i]['mobile']=$r->mobile;
							$data['admin'][$i]['address']=$r->address;
							$data['admin'][$i]['email']=$r->email;
							$data['admin'][$i]['pic']=$r->pic;
							$data['admin'][$i]['usertypeid']=$r->usertypeid;
                            $data['admin'][$i]['entryat']=date("F j, Y, g:i a",strtotime($r->entryat));
							$data['admin'][$i]['isactive']=$r->isactive;
							$i++;

						}
					}
                }


                if ($res || $company_dtl) 
                {
                       $data['status']=true;
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


    public function create_Admin(){
        try {
            if (isset($this->session->dflogin_admin)) {
                $data = array();
                $insert = array();
                $status = true;
                $request = json_decode(json_encode($_POST), FALSE);
                // $this->load->library('check_master');
                // $valid = $this->check_master->validate($request);
                // if ($valid) {

                    // echo "<pre>";
                    // print_r($request);

                    // echo "</pre>";
                    // exit();
                    if (isset($request->comName) && preg_match('/^[a-zA-Z0-9. ]{0,100}$/', $request->comName)) {
                        $insert[0]['name'] = $request->comName;
                    } else {
                        $data['title'] = "Alert!";
                        $data['message'] = "Admin Name error";
                        $status = false;
                    }
             
                  
                    if (isset($request->txtpass) && preg_match('/^[a-zA-Z0-9.@$]{8,20}$/', $request->txtpass)) {
                        $insert[0]['password'] = password_hash($request->txtpass,PASSWORD_DEFAULT);
                    } else {

                        if (isset($request->txtid) && is_numeric($request->txtid) && $request->txtid==0) {
                            $data['title'] = "Alert!";
                            $data['message'] = "Invalid  Password";
                            $status = false;
                        }
                       
                    }

              

                    // if (isset($request->parentid) && is_numeric($request->parentid)) {
                    //     $insert[0]['parentid'] = $request->parentid;
                    // } else {
                    //     $data['title'] = "Alert!";
                    //     $data['message'] = "Invalid  parent id";
                    //     $status = false;
                    // }

                  
                    if(isset($request->txtMobile) && $request->txtMobile !="" && preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$request->txtMobile)){
                        $insert[0]['mobile'] = $request->txtMobile;
                    }else{
                        $data['title'] = "Alert!";
                        $data['message'] = "Enter Valid Admin Number";
                        $status = false;
                    }
                 
                    if (isset($request->txtEmail) && preg_match('/^[@.a-zA-Z0-9]{0,50}$/', $request->txtEmail)) {
                        $insert[0]['email'] = $request->txtEmail;
                    }else{
                        $data['title'] = "Alert!";
                        $data['message'] = "Invalid Admin Email Id";
                        $status = false;
                    }
                    
                    if (isset($request->txtAddress) && preg_match('/[0-9a-zA-Z, \-\.\(\)\:\/]{0,200}$/', $request->txtAddress)) {
                        $insert[0]['address'] = $request->txtAddress;
                    }else{
                        $data['title'] = "Alert!";
                        $data['message'] = "Enter Valid Address";
                        $status = false;
                    }

                    if (isset($_FILES)) 
                    {
                       if(!empty($_FILES['logo']['name'])){
                           $config['upload_path'] = "assets/admin_logo/";
                           $config['allowed_types'] = 'jpg|png|svg|jpeg';
                           $config['file_name'] =rand(100000,999999)."_".$_FILES['logo']['name'];
                           
                           
                           $this->load->library('upload',$config);
                           $this->upload->initialize($config);
                           
                           if($this->upload->do_upload('logo')){
                               $uploadData = $this->upload->data();
                               $insert[0]['pic'] =  $uploadData['file_name'];
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
                    
                    if ($status) {
                        $insert[0]['usertypeid']='2';
                        if(isset($request->txtid) && is_numeric($request->txtid)){
                            if($request->txtid>0){
                                if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                                    $insert[0]['updateby'] = $this->session->dflogin_admin['adminid'];
                                    $insert[0]['updateat']=date("Y-m-d H:i:s");
                                    $res=$this->Model_Db->update(9,$insert,"id",$request->txtid);
                                    if($res){
                                        $data['message']="Update successful.";
                                        $data['data']="Company updated successfully.";
                                        $data['status']=true;
                                        $this->session->unset_tempdata('editForm');
                                    }else{
                                        $data['title'] = "Alert!!";
                                        $data['message'] = "Updating failed.";
                                        $data['status'] = false;
                                    }
                                }else{
                                    $data['status']=false;
                                    $data['message']='Invalid edit request';
                                    $data['data']='You have exceeded the max time limit of 30 seconds to edit this form.';
                                }
                            }else if($request->txtid==0){
                                $insert[0]['entryby'] = $this->session->dflogin_admin['adminid'];
                                $insert[0]['entryat'] = date("Y-m-d H:i:s");

                                // echo "<pre>";

                                // print_r($insert);

                                // exit();

                                
                                            $res = $this->Model_Db->insert(9, $insert);
                                            if ($res != false) {
                                                $data['title'] = "Alert!";
                                                $data['message'] = "Admin created successfully.";
                                                $data['status'] = true;
                                            } else {
                                                $data['title'] = "Alert!";
                                                $data['message'] = "Admin creation failed";
                                                $data['status'] = false;
                                            }

                  
                              
                            }
                        }else{
                            $data['title']="Insufficient/Invalid data.";
                            $data['message']="Some error occurred.Please try again or contact with Admin.";
                            $data['status']=false;
                        }
                        echo json_encode($data);
                        exit();
                    } else {
                        $data['title'] = "Error!";
                        $data['status'] = false;
                        echo json_encode($data);
                        exit();
                    }
            
            } else {
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }

    }


    public function r_candidate(){

		try{
			if (isset($this->session->dflogin_admin)) {
				//    $parentid=$this->session->dflogin['companyid'];
                    $adminid= $this->session->dflogin_admin['adminid'];
					$where="parentid=0 or  parentid=".null;
					$orderby="id asc";
					$res=$this->Model_Db->select(1,null,$where,$orderby);
                    
					if($res){
						$i=0;
						foreach ($res as $r){
							$data['status']=true;
							$data['data'][$i]['id']=$r->id;
	    //		            $data['data'][$i]['ctype']=$r->ctype;
							$data['data'][$i]['name']=$r->companyname;
							$data['data'][$i]['mobile']=$r->contactmobile;
							$data['data'][$i]['address']=$r->address;
							$data['data'][$i]['email']=$r->companyemail;
							$data['data'][$i]['companycode']=$r->companycode;
							$data['data'][$i]['contactperson']=$r->contactperson;
                            $data['data'][$i]['logo']=$r->logo;
							$data['data'][$i]['gstno']=$r->gstno;
							$data['data'][$i]['registrationno']=$r->registrationno;
                            $data['data'][$i]['pan']=$r->pan;
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
			if (isset($this->session->dflogin_admin) ) {
			
					$request=json_decode(json_encode($_POST));
					$data=array();
					if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0){
						$where="id=$request->rowid";
						$update=array();
						$update[]=array(
							// 'updateby'=>$this->session->dflogin['companyid'],
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
						$res=$this->Model_Db->select(1,null,$where);
						if($res!=false){
							$result=$this->Model_Db->update(1,$update,'id',$request->rowid);
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


    public function active_inactive_admin(){
		try{
			if (isset($this->session->dflogin_admin) ) {
			
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
						$res=$this->Model_Db->select(9,null,$where);
						if($res!=false){
							$result=$this->Model_Db->update(9,$update,'id',$request->rowid);
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



















    public function edit_admin(){
		try{
			if (isset($this->session->dflogin_admin) ) {
				
					extract($_POST);
					if(isset($id) && $id>0 && is_numeric($id)){
						$where="id=$id and isactive=true";
						$res=$this->Model_Db->select(9,null,$where);


						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
	                            //	'ctype'=>$r->ctype,
	                                'name'=>$r->name,
									'email'=>$r->email,
									'mobile'=>$r->mobile,
									'pic'=>$r->pic,
									'address'=>$r->address,
									'entryby'=>$r->entryby,
									'usertypeid'=>$r->usertypeid,
									'password'=>$r->password,
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










    public function edit_candidate(){
		try{
			if (isset($this->session->dflogin_admin) ) {
				
					extract($_POST);
					if(isset($id) && $id>0 && is_numeric($id)){
						$where="id=$id and isactive=true";
						$res=$this->Model_Db->select(1,null,$where);


						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
	                            //	'ctype'=>$r->ctype,
	                                'companyname'=>$r->companyname,
									'companysrtname'=>$r->companysrtname,
									'companycode'=>$r->companycode,
									'companyemail'=>$r->companyemail,
									'address'=>$r->address,
									'contactmobile'=>$r->contactmobile,
									'contactperson'=>$r->contactperson,
									'gstno'=>$r->gstno,
									'registrationno'=>$r->registrationno,
									'image'=>$r->logo,
                                    'pan'=>$r->pan,
									'password'=>$r->password,
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




?>