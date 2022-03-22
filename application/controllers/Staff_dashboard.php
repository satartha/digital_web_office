<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_dashboard extends CI_Controller {

	public function load_include()
	{
		$this->load->view('include/header');
		$this->load->view('include/topbar');
		$this->load->view('include/menubar');
	}

    public function index()
    {
	
		try{
			if(isset($this->session->dflogin_staff)) {
				
				if ($this->session->dflogin_staff['usertypeid']=='1') 
				{
					$this->load->view('include/header');
					$this->load->view('include/topbar');
				// $this->load->view('include/menubar');
					$this->load->view('staff_dashboard/staff_dashboard');
					$this->load->view('include/footer');
					$this->load->view('staff_dashboard/staff_dashboardScript');
				} else {
					$this->load->view('include/header');
					$this->load->view('include/topbar');
				 // $this->load->view('include/menubar');
					$this->load->view('staff_dashboard/staffuser_dashboard');
					$this->load->view('include/footer');
					$this->load->view('staff_dashboard/staffuser_dashboardScript');
				}
			
			}else{
				redirect('Welcome/user');
			}
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}

    }
	


	public function staff_section(){
	
		try{
			

			if(isset($this->session->dflogin_staff)) {
				
	
				if ($this->session->dflogin_staff['usertypeid']=='1') 
				{
				
					$this->load->view('include/header');
					$this->load->view('include/topbar');
			
					$this->load->view('staff_dashboard/staff_dashboard');
					$this->load->view('include/footer');
					$this->load->view('staff_dashboard/staff_dashboardScript');
				} else {
					$this->load->view('include/header');
					$this->load->view('include/topbar');
				
					$this->load->view('staff_dashboard/staffuser_dashboard');
					$this->load->view('include/footer');
					$this->load->view('staff_dashboard/staffuser_dashboardScript');
				}




			}else{
				redirect('Welcome/user');
			}
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}



	public function upload_pdf(){
		try{
			if (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['typeid']==1) {
				$request=json_decode(json_encode($_POST), FALSE);
				$data=array();
				$config['upload_path'] = './assets/pdf/'.$request->pathname;
				$config['allowed_types'] = 'pdf|csv|xlsx';
				$config['max_size'] = 51200;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('uploadfile')) {
					$upload_photo = $this->upload->data();
					if($upload_photo){
						$data['status']=true;
						$data['title']="Alert!!";
						$data['message']="File Upload successfully";
					}else{
						$data['status']=false;
						$data['title']="Alert!!";
						$data['message']="File Upload Failed";
					}
				} else {
					$status = false;
					$data['data'] = $this->upload->display_errors();
				}
				// print_r($data);
				// exit();
				echo json_encode($data);
				exit();
			}else{
				redirect('Welcome/');
			}
		}catch(Exception $e){
			echo "Message:" . $e->getMessage();
		}
	}

	public function pdf_rpt(){
		try{
			if (isset($this->session->dflogin) ) {
				$path=$this->session->dflogin['folderpath'];
				$pdfs='assets/Documents_company/'.$path;
				$directory = array_diff(scandir($pdfs), array('..', '.'));
				if(count($directory)>0){
					$data['status']=true;
					foreach($directory as $d){
						$withoutd = substr($d, 0, strrpos($d, "."));
						$filetype = substr($d, strrpos($d, "."));
						$data['data'][]=array(
							'filename'=>$d,
							'heading'=>$withoutd,
							'filetype'=>$filetype
						);
					}
				}
				echo json_encode($data);
				exit();
			}else {
				redirect('Welcome/user');
			}
		}catch (Exception $e){
			echo "Message:" . $e->getMessage();
		}
	}

	public function size_as_kb($size)
	{
		if ($size < 1024) {
			return "$size bytes";
		} elseif ($size < 1048576) {
			$size_kb = round($size / 1024);
			return "$size KB";
		} else {
			$size_mb = round($size / 1048576, 1);
			return "$size MB";
		}
	}

	public function show_dir(){
		try{
			if (isset($this->session->dflogin_staff) ) {
				// $path=$this->session->dflogin['folderpath'];
				// $folder='assets/Documents_company/'.$path;



                if (isset($this->session->dflogin_staff['companydeptid']) && $this->session->dflogin_staff['companydeptid']!="") {
                   
                    

					if ($this->session->dflogin_staff['usertypeid']=="1") 
					{

						$comdept_id=$this->session->dflogin_staff['companydeptid'];
						$data['staffname']=$this->session->dflogin_staff['staffname'];
						$data['cr_on']=date("F j, Y, g:i a", strtotime($this->session->dflogin_staff['entryat']));
						$where="id=".$comdept_id;
						$map_dtl=$this->Model_Db->select(4,null,$where);
	
						$folder='assets/Documents_company/'.$map_dtl[0]->folderpath;

								if (isset($this->session->basefolder)) 
						{
							unset($this->session->basefolder);
						}
						$this->session->set_userdata('basefolder',$folder);



						$data['path']=$map_dtl[0]->folderpath;
	
						$subdirectory = array_diff(scandir($folder), array('..', '.'));
	
						if (count($subdirectory) > 0) {
							$data['status'] = true;
							$data['data'] = array(
								'subdircount' => 0,
								'filescount' => 0,
								'subdir' => array(),
								'files' => array()
							);
							foreach ($subdirectory as $s) {
								$dirpath = $folder . '/' . $s;
								$meta = stat($dirpath);
								if (strpos($s, ".")) {
	
	
								   
									$filetype = substr($s, strpos($s, "."));
									$withoutd = substr($s, 0, strrpos($s, "."));
									$data['data']['files'][] = array(
										'filename' => $s,
										'filetype' => $filetype,
										'heading' => $withoutd,
										'create_time' => date("F j, Y, g:i a", $meta['ctime']),
										'file_size' => $this->size_as_kb($meta['size']),
										'meta'=>$meta
									);
								} else {
									$data['data']['subdircount'] += 1;
									$data['data']['subdir'][] = array(
										'subdirectory' => $s,
										// 'filetype'=>$filetype
										'meta'=>$meta,
										'filecount' => count(glob($dirpath . "/*.*")),
										'dircount' => count(glob($dirpath . "/*", GLOB_ONLYDIR)),
										'dir_meta' => $meta,
										'create_time' => date("F j, Y, g:i a", $meta['ctime']),
										'folder_size' => $this->size_as_kb($meta['size'])
									
									);
								}
	
							}
	
							if (count($data['data']['files']) > 0) {
								$com_id = $this->session->dflogin_staff['entryby'];
								$where = "isactive=1 and owner=$com_id";
								$file_data = $this->Model_Db->select(8, null, $where);
		
								foreach ($file_data as $key => $value) {
									foreach ($data['data']['files'] as $prop => $dt) {
										// echo "<pre>";
										// print_r( $value);
										// exit(); 
										if ($dt['heading'] == $value->filename) {
											$data['data']['filescount'] += 1;
											$data['data']['new_file'][] = array(
												'files' => $dt,
												'db_data' => $value
											);
										}
									}
								}
							} else {
								$data['data']['new_file'][] = array(
									'files' => null,
									'db_data' => null
								);
							}
	
	
						} else {
							$data['status'] = false;
						}




						
					} elseif($this->session->dflogin_staff['usertypeid']=="3" || $this->session->dflogin_staff['usertypeid']=="2" ) {
					    
						
                        
                        $userid=$this->session->dflogin_staff['staffid'];
                        $where="isactive=1 and userid=$userid";
						$permission=$this->Model_Db->select(14,null,$where);


						$comdept_id=$this->session->dflogin_staff['companydeptid'];
						$data['staffname']=$this->session->dflogin_staff['staffname'];
						$data['cr_on']=date("F j, Y, g:i a", strtotime($this->session->dflogin_staff['entryat']));
						$where="id=".$comdept_id;
						$map_dtl=$this->Model_Db->select(4,null,$where);
	
						$folder='assets/Documents_company/'.$map_dtl[0]->folderpath;

								if (isset($this->session->basefolder)) 
						{
							unset($this->session->basefolder);
						}
						$this->session->set_userdata('basefolder',$folder);


						foreach($permission as $k => $value)
						{
                            $in[]=$value->documentid;
						}

						$arr_in= implode(",",$in);

						$whr="id in ($arr_in) and isactive=1";

						$document_p=$this->Model_Db->select(8,null,$whr);

						$data['document_p']=$document_p;
						$data['permission']=$permission;


						foreach ($data['document_p'] as $key => $value) 
						{
							$meta=stat($value->documentpath);
						
							 $data['meta'][$key]['last_mod'] = date("F j, Y, g:i a", $meta['mtime']);
							 $data['meta'][$key]['file_size'] = $this->size_as_kb($meta['size']);	
						}

						$data['filecount']=0;

						foreach ($permission as $key => $value) 
						{
							$data['filecount']++;
						   
						}

					
						$comdept_id=$this->session->dflogin_staff['companydeptid'];
						$data['staffname']=$this->session->dflogin_staff['staffname'];
						$data['cr_on']=date("F j, Y, g:i a", strtotime($this->session->dflogin_staff['entryat']));
						
						
						$where="id=".$comdept_id;
						$map_dtl=$this->Model_Db->select(4,null,$where);
	
						$folder='assets/Documents_company/'.$map_dtl[0]->folderpath;
						$data['path']=$map_dtl[0]->folderpath;
						$data['status']=true;
	
						// $subdirectory = array_diff(scandir($folder), array('..', '.'));
	
						// if (count($subdirectory) > 0) {
						// 	$data['status'] = true;
						// 	$data['data'] = array(
						// 		'subdircount' => 0,
						// 		'filescount' => 0,
						// 		'subdir' => array(),
						// 		'files' => array()
						// 	);
						// 	foreach ($subdirectory as $s) {
						// 		$dirpath = $folder . '/' . $s;
						// 		$meta = stat($dirpath);
						// 		if (strpos($s, ".")) {
	
	
								   
						// 			$filetype = substr($s, strpos($s, "."));
						// 			$withoutd = substr($s, 0, strrpos($s, "."));
						// 			$data['data']['files'][] = array(
						// 				'filename' => $s,
						// 				'filetype' => $filetype,
						// 				'heading' => $withoutd,
						// 				'create_time' => date("F j, Y, g:i a", $meta['ctime']),
						// 				'file_size' => $this->size_as_kb($meta['size']),
						// 				'meta'=>$meta
						// 			);
						// 		} else {
						// 			$data['data']['subdircount'] += 1;
						// 			$data['data']['subdir'][] = array(
						// 				'subdirectory' => $s,
						// 				// 'filetype'=>$filetype
						// 				'meta'=>$meta,
						// 				'filecount' => count(glob($dirpath . "/*.*")),
						// 				'dircount' => count(glob($dirpath . "/*", GLOB_ONLYDIR)),
						// 				'dir_meta' => $meta,
						// 				'create_time' => date("F j, Y, g:i a", $meta['ctime']),
						// 				'folder_size' => $this->size_as_kb($meta['size'])
									
						// 			);
						// 		}
	
						// 	}
	
						// 	if (count($data['data']['files']) > 0) {
						// 		$com_id = $this->session->dflogin_staff['entryby'];
						// 		$where = "isactive=1 and owner=$com_id";
						// 		$file_data = $this->Model_Db->select(8, null, $where);
		
						// 		foreach ($file_data as $key => $value) {
						// 			// echo "<pre>";
						// 			// print_r($value);
						// 			// exit();

						// 			foreach ($data['data']['files'] as $prop => $dt) {
						// 				// echo "<pre>";
						// 				// print_r( $value);
						// 				// exit(); 
								
						// 				if ($dt['heading'] == $value->filename) {



						// 					foreach ($permission as $nm => $mm) 
						// 					{

						// 						if ($mm->documentid==$value->id) {

						// 							$data['data']['filescount'] += 1;
						// 							$data['data']['new_file'][] = array(
						// 								'files' => $dt,
						// 								'db_data' => $value
						// 							);

						// 						}					
						// 					}
											
						// 				}
						// 			}
						// 		}
						// 	} else {
						// 		$data['data']['new_file'][] = array(
						// 			'files' => null,
						// 			'db_data' => null
						// 		);
						// 	}
	
	
						// } else {
						// 	$data['status'] = false;
						// }
				
					}
					

				echo json_encode($data);
				exit();
             }
			}else {
				redirect('Welcome/user');
			}
		}catch(Exception $e){
			echo "Message:" . $e->getMessage();
		}
	}

	public function subname()
	{
		try {
			if (isset($this->session->dflogin_staff)) {
				$data = array();
				$request = json_decode(json_encode($_POST), FALSE);
				$subfolder = 'assets/Documents_company/' . $request->dname;
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

						$dirpath = $subfolder . '/' . $s;
						$meta = stat($dirpath);
						if (strpos($s, ".")) {
							$data['data']['filescount'] += 1;
							$filetype = substr($s, strpos($s, "."));
							$withoutd = substr($s, 0, strrpos($s, "."));
							// $entryby = $this->session->dflogin['companyname'];

							// $where = "entryby=$entryby and filename='" . $withoutd . "' and fileext='" . $filetype . "'";



							$data['data']['files'][] = array(
								'filename' => $s,
								'filetype' => $filetype,
								'heading' => $withoutd,
								'file_meta' => $meta,
								'create_time' => date("F j, Y, g:i a", $meta['ctime']),
								'file_size' => $this->size_as_kb($meta['size']),
								
							);
						} else {
							$data['data']['subdircount'] += 1;

							$data['data']['subdir'][] = array(
								'subdirectory' => $s,
								'filecount' => count(glob($dirpath . "/*.*")),
								'dircount' => count(glob($dirpath . "/*", GLOB_ONLYDIR)),
								'dir_meta' => $meta,
								'create_time' => date("F j, Y, g:i a", $meta['ctime']),
								'folder_size' => $this->size_as_kb($meta['size']),
								

							);
						}
					}



					if (count($data['data']['files']) > 0) {
						$com_id = $this->session->dflogin_staff['entryby'];
						$where = "isactive=1 and owner=$com_id";
						$file_data = $this->Model_Db->select(8, null, $where);

						foreach ($file_data as $key => $value) {
							foreach ($data['data']['files'] as $prop => $dt) {
								// echo "<pre>";
								// print_r( $value);
								// exit(); 
								if ($dt['heading'] == $value->filename) {
									$data['data']['new_file'][] = array(
										'files' => $dt,
										'db_data' => $value
									);
								}
							}
						}
					} else {
						$data['data']['new_file'][] = array(
							'files' => null,
							'db_data' => null
						);
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

	public function dlt(){
		try{
			if (isset($this->session->dflogin) && $this->session->dflogin['typeid']==1 ||$this->session->dflogin['typeid']==4) {
				$data=array();
				$request=json_decode(json_encode($_POST));
				$file=$request->fname;
				$dltfile='assets/pdf/'.$file;
				if(unlink($dltfile)){
					$data['status']=true;
				}else{
					$data['status']=false;
				}
				echo json_encode($data);
				exit();
			}else {
				redirect('Welcome/');
			}
		}catch(Exception $e){
			echo "Message:" . $e->getMessage();
		}
	}

	public function make_directory(){
		try{
			if (isset($this->session->dflogin_staff) ) {
				$data=array();
				$request=json_decode(json_encode($_POST));
				// echo "<pre>";
                // print_r($request);
				// exit();
				$createfile="assets/Documents_company/$request->dname/$request->input";
				if (!file_exists($createfile)) {
					// $data['status']=true;
					$r=mkdir($createfile, 0777, true);
					if($r){
						$data['status']=true;
						$data['data']="File Created";
						$data['message']="File Created";
					}else{
						$data['status']=false;
						$data['data']="File Not Created";
						$data['message']="File Created";
					}
				}else{
					$data['status']=false;
					$data['data']="Directory already exist";
					$data['message']="File Created";
				}
				echo json_encode($data);
				// print_r($createfile);
				exit();
			}else {
				redirect('Welcome/user');
			}
		}catch(Exception $e){
			echo "Message:" . $e->getMessage();
		}
	}

	public function delete_directory(){
		try{
			if (isset($this->session->dflogin) && ($this->session->dflogin['typeid']==1 ||$this->session->dflogin['typeid']==4)) {
				$data=array();
				$request=json_decode(json_encode($_POST));
				$createfile="assets/pdf/$request->dname";
				if (!file_exists($createfile)) {
					// $data['status']=true;
					$data['status']=false;
					$data['data']="Directory Does not exist";
				}else{
					$this->load->helper('file'); 
					delete_files($createfile, true);
					$r=rmdir($createfile);
					if($r){
						$data['status']=true;
						$data['data']="Folder Deleted";
					}else{
						$data['status']=false;
						$data['data']="Folder Not Deleted";
					}
				}
				echo json_encode($data);
				// print_r($createfile);
				exit();
			}else {
				redirect('Welcome/');
			}
		}catch(Exception $e){
			echo "Message:" . $e->getMessage();
		}
	}




}
