<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }



    public function check_login(){
        
        try{
            $request = json_decode(json_encode($_POST), FALSE);
            $data=array();
            $status=true;
            $segment=explode(':',$request->data1);
            $key = base64_decode($segment[0]);
            $iv =  base64_decode($segment[2]);
            $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $userid =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
            $segment=explode(':',$request->data2);
            $key = base64_decode($segment[0]);
            $iv =  base64_decode($segment[2]);
            $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $password =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
            if(isset($userid) && $userid!=null){
                $isemail=false;
                $ismobile=false;
                if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$userid)){
                    $data['message']="Its an email id.";
                    $isemail=true;
                }else if(preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$userid)){
                    $data['message']="Its a mobile number.";
                    $ismobile=true;
                }else{
                    $data['status']=false;
                    $data['message']="Invalid User id.";
                    $status=false;
                }
                if(isset($password) && preg_match("/[0-9A-Za-z!@#$%]{6,12}$/",$password)){
                    $insert[0]['password']=$password;
                }else{
                    $data['status']=false;
                    $data['message']="User id or password is wrong.";
                    $status=false;
                }
                if($isemail){
                    $where="companyemail='$userid' ";
                }else if($ismobile){
                    $where="contactmobile=$userid ";
                }else{
                    $data['status']=false;
                }
                if($status){
                    $where.=" and isactive=true";
                    $res=$this->Model_Db->select(1,null,$where);
                    if($res!=false){
                        if(count($res)>1){
                            $data['status']=false;
                            $data['message']="Unexpected error occoured.Please contact admin.";
                        }else{
                        	// $upid=$res[0]->id;
							// $where="userid=$upid and isactive=true";
							// $permission=$this->Model_Db->select(60,null,$where);
                            if(password_verify($password,$res[0]->password)){
                                $data['companyid']=$res[0]->id;
                                $data['parentid']=$res[0]->parentid;
                                $data['companyname']=$res[0]->companyname;
                                $data['folderpath']=$res[0]->folderpath;
                                $data['companymobile']=$res[0]->contactmobile;
                                $data['companyemail']=$res[0]->companyemail;
                                $data['companyaddress']=$res[0]->address;
                                $data['company_data']=$res[0];
                                // $data['typeid']=$res[0]->type;
                                // $data['softid']="";
                                // $data['status']=true;
                                // $data['state']=false;
                                // $data['zilla']=false;
                                // $data['mandal']=false;
                                // $data['shakti']=false;
                                // $data['booth']=false;
                                // $data['tour']=false;
                                // $data['special']=false;
                                // $data['entry']=false;
                                // $data['report']=false;
                                // $data['calling']=false;
                                // $data['campaign']=false;
                                // $data['user']=false;
                                // if($permission){
                                // 	if($res[0]->id ==$permission[0]->userid){
								// 		$data['state']=$permission[0]->state;
								// 		$data['zilla']=$permission[0]->zilla;
								// 		$data['mandal']=$permission[0]->mandal;
								// 		$data['shakti']=$permission[0]->shakti;
								// 		$data['booth']=$permission[0]->booth;
								// 		$data['tour']=$permission[0]->tour;
								// 		$data['special']=$permission[0]->special;
								// 		$data['entry']=$permission[0]->entry;
								// 		$data['report']=$permission[0]->report;
								// 		$data['calling']=$permission[0]->calling;
								// 		$data['campaign']=$permission[0]->campaign;
								// 		$data['user']=$permission[0]->user;
								// 	}
								// }
                                $this->session->set_userdata('dflogin',$data);
                            }else{
                                $data['status']=false;
                                $data['message']="User id or password error.";
                            }
                        }
                    }else{
                        $data['status']=false;
                        $data['message']="Userid doesnot exist.";
                    }
                }else{
                    $data['status']=false;
                    $data['message']="error";
                }
            }else{
                $data['status']=false;
                $data['message']="No Userid entered.";
            }
            echo json_encode($data);
            exit();
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            echo json_encode($data);
            exit();
        }
        // $data['name']="Satartha Prakash Parida";
        // $this->session->set_userdata('dflogin',$data);
        //     $data['status']=true;
        //     echo json_encode($data);
        //     exit();
    }
    public function logout(){
        try{
            $data = array();
            $this->session->sess_destroy();
            $data['status']=true;
            $data['message']="Logout Successful.";
            redirect('Welcome/');
        }catch(Exception $e){
            $data = array();
            $this->session->sess_destroy();
            $data['status']=true;
            $data['message']="Message:".$e->getMessage();
            redirect('Dashboard/');
        }
    }

    public function check_staff_login(){
        try{
            $request = json_decode(json_encode($_POST), FALSE);
            $data=array();
            $status=true;
            $segment=explode(':',$request->data1);
            $key = base64_decode($segment[0]);
            $iv =  base64_decode($segment[2]);
            $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $userid =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
            $segment=explode(':',$request->data2);
            $key = base64_decode($segment[0]);
            $iv =  base64_decode($segment[2]);
            $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $password =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
            
            if(isset($userid) && $userid!=null){
                $isemail=false;
                $ismobile=false;
                if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$userid)){
                    $data['data']="Its an email id.";
                    $isemail=true;
                }else if(preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$userid)){
                    $data['data']="Its a mobile number.";
                    $ismobile=true;
                }else{
                    $data['status']=false;
                    $data['data']="Invalid User id.";
                    $status=false;
                }
                if(isset($password) && preg_match("/[0-9A-Za-z!@#$%]{6,12}$/",$password)){
                    $insert[0]['password']=$password;
                }else{
                    $data['status']=false;
                    $data['data']="User id or password is wrong.";
                    $status=false;
                }
                
                if($isemail){
                    $where="staffemail='$userid' ";
                }else if($ismobile){
                    $where="staffmobile=$userid ";
                }else{
                    $data['status']=false;
                }
                if($status){
                    $where.=" and isactive=true";
                    $res=$this->Model_Db->select(5,null,$where);
                    if($res!=false){
                        if(count($res)>1){
                            $data['status']=false;
                            $data['message']="Unexpected error occoured.Please contact admin.";
                        }else{
                        	// $upid=$res[0]->id;
							// $where="userid=$upid and isactive=true";
							// $permission=$this->Model_Db->select(60,null,$where);
                            if(password_verify($password,$res[0]->password)){
                            	// if($permission){
                            	// 	if($permission[0]->calling == 1 || $permission[0]->campaign == 1){
                                     //--------------->
										$data['staffid']=$res[0]->id;
										$data['staffname']=$res[0]->staffname;
										$data['staffmobile']=$res[0]->staffmobile;
										$data['staffemail']=$res[0]->staffemail;
										$data['staffpic']=$res[0]->staffpic;
										$data['usertypeid']=$res[0]->usertypeid;
										$data['companydeptid']=$res[0]->companydeptid;
                                        $data['staffpic']=$res[0]->staffpic;
                                        $data['entryby']=$res[0]->entryby;
                                        $data['entryat']=date("F j, Y, g:i a",strtotime($res[0]->entryat));
                                        //--------------->
//										$data['state']=$permission[0]->state;
//										$data['zilla']=$permission[0]->zilla;
//										$data['mandal']=$permission[0]->mandal;
//										$data['shakti']=$permission[0]->shakti;
//										$data['booth']=$permission[0]->booth;
//										$data['tour']=$permission[0]->tour;
//										$data['special']=$permission[0]->special;
//										$data['entry']=$permission[0]->entry;
//										$data['report']=$permission[0]->report;
										// $data['calling']=$permission[0]->calling;
										// $data['campaign']=$permission[0]->campaign;
										// $data['user']=$permission[0]->user;
										$data['status']=true;
										$this->session->set_userdata('dflogin_staff',$data);
								// 	}else{
								// 		$data['status']=false;
								// 		$data['message']="You have no permission to login";
								// 	}
								// }else{
								// 	$data['status']=false;
								// 	$data['message']="You have no permission to login";
								// }
                            }else{
                                $data['status']=false;
                                $data['message']="User id or password error.";
                            }
                        }
                    }else{
                        $data['status']=false;
                        $data['message']="Userid doesnot exist.";
                    }
                }else{
                    $data['status']=false;
                    $data['message']="error";
                }
            }else{
                $data['status']=false;
                $data['message']="No Userid entered.";
            }
            // print_r($data);
            echo json_encode($data);
            exit();
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            echo json_encode($data);
            exit();
        }
    }


    public function header_info()
    {
        try {

            if(isset($this->session->dflogin_admin)){
                $data['status']=true;
				$data['header_img']= base_url().'assets/img/geoid_logo.jpeg';

                $data['companyname']="Digital Web Office";
                

			}elseif (isset($this->session->dflogin_staff) || isset($this->session->dflogin)) 
            {
                if (isset($this->session->dflogin_staff)) {

                    $companyid=$this->session->dflogin_staff['entryby'];

                }elseif (isset($this->session->dflogin)) 
                {
                    $companyid=$this->session->dflogin['companyid'];
                }

                $where = "id=$companyid and isactive=1";

                $com_dtl=$this->Model_Db->select(1,null,$where);
                
                $data['header_img']= base_url()."assets/com_logo/".$com_dtl[0]->logo;
                $data['companyname']=$com_dtl[0]->companyname;
                $data['status']=true;
            }else{
				redirect('Welcome/admin');
                exit();
			}

            echo json_encode($data);







            
        } catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            echo json_encode($data);
            exit();
        }
    }


    public function check_login_admin(){
        try{
            $request = json_decode(json_encode($_POST), FALSE);

            $data=array();
            $status=true;
            $segment=explode(':',$request->data1);
            $key = base64_decode($segment[0]);
            $iv =  base64_decode($segment[2]);
            $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $userid =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
            $segment=explode(':',$request->data2);
            $key = base64_decode($segment[0]);
            $iv =  base64_decode($segment[2]);
            $decrypted = openssl_decrypt($segment[1], 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $password =(string) preg_replace('/[[:cntrl:]]/', '', trim($decrypted));
            
            if(isset($userid) && $userid!=null){
                $isemail=false;
                $ismobile=false;
                if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$userid)){
                    $data['data']="Its an email id.";
                    $isemail=true;
                }else if(preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$userid)){
                    $data['data']="Its a mobile number.";
                    $ismobile=true;
                }else{
                    $data['status']=false;
                    $data['data']="Invalid User id.";
                    $status=false;
                }
                if(isset($password) && preg_match("/[0-9A-Za-z!@#$%]{6,12}$/",$password)){
                    $insert[0]['password']=$password;
                }else{
                    $data['status']=false;
                    $data['data']="User id or password is wrong.";
                    $status=false;
                }
                
                if($isemail){
                    $where="email='$userid' ";
                }else if($ismobile){
                    $where="mobile=$userid ";
                }else{
                    $data['status']=false;
                }
                if($status){
                    $where.=" and isactive=true";
                    $res=$this->Model_Db->select(9,null,$where);
                    if($res!=false){
                        if(count($res)>1){
                            $data['status']=false;
                            $data['message']="Unexpected error occoured.Please contact admin.";
                        }else{
                        	// $upid=$res[0]->id;
							// $where="userid=$upid and isactive=true";
							// $permission=$this->Model_Db->select(60,null,$where);
                            if(password_verify($password,$res[0]->password)){
                            	// if($permission){
                            	// 	if($permission[0]->calling == 1 || $permission[0]->campaign == 1){
                                     //--------------->
										$data['adminid']=$res[0]->id;
										$data['adminname']=$res[0]->name;
										$data['adminmobile']=$res[0]->mobile;
										$data['adminemail']=$res[0]->email;
										$data['pic']=$res[0]->pic;
										$data['usertypeid']=$res[0]->usertypeid;
										$data['entryby']=$res[0]->entryby;
                                        $data['entryat']=date("F j, Y, g:i a",strtotime($res[0]->entryat));
                                        // $data['staffpic']=$res[0]->staffpic;
                                        //--------------->
//										$data['state']=$permission[0]->state;
//										$data['zilla']=$permission[0]->zilla;
//										$data['mandal']=$permission[0]->mandal;
//										$data['shakti']=$permission[0]->shakti;
//										$data['booth']=$permission[0]->booth;
//										$data['tour']=$permission[0]->tour;
//										$data['special']=$permission[0]->special;
//										$data['entry']=$permission[0]->entry;
//										$data['report']=$permission[0]->report;
										// $data['calling']=$permission[0]->calling;
										// $data['campaign']=$permission[0]->campaign;
										// $data['user']=$permission[0]->user;
										$data['status']=true;
										$this->session->set_userdata('dflogin_admin',$data);
								// 	}else{
								// 		$data['status']=false;
								// 		$data['message']="You have no permission to login";
								// 	}
								// }else{
								// 	$data['status']=false;
								// 	$data['message']="You have no permission to login";
								// }
                            }else{
                                $data['status']=false;
                                $data['message']="User id or password error.";
                            }
                        }
                    }else{
                        $data['status']=false;
                        $data['message']="Userid doesnot exist.";
                    }
                }else{
                    $data['status']=false;
                    $data['message']="error";
                }
            }else{
                $data['status']=false;
                $data['message']="No Userid entered.";
            }

            echo json_encode($data);
            exit();
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            echo json_encode($data);
            exit();
        }
    }





}
