<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
			if (isset($this->session->dflogin)) {
				$this->load_include();
				$this->load->view('dashboard1/frmDashboard');
				$this->load->view('include/footer');
				$this->load->view('dashboard1/scriptDashboard');
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}






	public function upload_pdf()
	{
		try {
			if (isset($this->session->dflogin) && $this->session->dflogin['typeid'] == 1) {
				$request = json_decode(json_encode($_POST), FALSE);
				$data = array();
				$config['upload_path'] = './assets/pdf/' . $request->pathname;
				$config['allowed_types'] = 'pdf|csv|xlsx';
				$config['max_size'] = 51200;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('uploadfile')) {
					$upload_photo = $this->upload->data();
					if ($upload_photo) {
						$data['status'] = true;
						$data['title'] = "Alert!!";
						$data['message'] = "File Upload successfully";
					} else {
						$data['status'] = false;
						$data['title'] = "Alert!!";
						$data['message'] = "File Upload Failed";
					}
				} else {
					$status = false;
					$data['data'] = $this->upload->display_errors();
				}
				// print_r($data);
				// exit();
				echo json_encode($data);
				exit();
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}

	public function pdf_rpt()
	{
		try {
			if (isset($this->session->dflogin)) {
				$path = $this->session->dflogin['folderpath'];
				$pdfs = 'assets/Documents_company/' . $path;
				$directory = array_diff(scandir($pdfs), array('..', '.'));
				if (count($directory) > 0) {
					$data['status'] = true;
					foreach ($directory as $d) {
						$withoutd = substr($d, 0, strrpos($d, "."));
						$filetype = substr($d, strrpos($d, "."));
						$data['data'][] = array(
							'filename' => $d,
							'heading' => $withoutd,
							'filetype' => $filetype
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

	public function show_dir()
	{
		try {
			if (isset($this->session->dflogin)) {
				$path = $this->session->dflogin['folderpath'];
				$data['base_path']=$path;
				$data['com_name']=$this->session->dflogin['companyname'];
				$folder = 'assets/Documents_company/' . $path;
				if (isset($this->session->basefolder)) 
				{
					unset($this->session->basefolder);
				}
                $this->session->set_userdata('basefolder',$folder);
				$com_dt = $this->session->dflogin;
				$data['com_nm'] = $com_dt['company_data']->companyname;
				$data['cr_on'] = date("d-m-Y", strtotime($com_dt['company_data']->entryat));
				$directory = array_diff(scandir($folder), array('..', '.'));
				if (count($directory) > 0) {
				
					$data['status'] = true;
					foreach ($directory as $d) {
						$dir=$folder . '/' . $d;
						$meta = stat($dir);

						$data['data'][] = array(
							'directory' => $path . '/' . $d,
							'directory_name' => $d,
							'filecount' => count(glob($dir . "/*.*")),
							'dircount' => count(glob($dir . "/*", GLOB_ONLYDIR)),
							'dir_meta' => $meta,
							'create_time' => date("F j, Y, g:i a", $meta['ctime']),
							'folder_size' => $this->size_as_kb($meta['size'])
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

	public function subname()
	{
		try {
			if (isset($this->session->dflogin)) {
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
							$entryby = $this->session->dflogin['companyname'];

							$where = "entryby=$entryby and filename='" . $withoutd . "' and fileext='" . $filetype . "'";



							$data['data']['files'][] = array(
								'filename' => $s,
								'filetype' => $filetype,
								'heading' => $withoutd,
								'file_meta' => $meta,
								'create_time' => date("F j, Y, g:i a", $meta['ctime']),
								'file_size' => $this->size_as_kb($meta['size']),
								'owner' => $this->session->dflogin['companyname']
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
								'owner' => $this->session->dflogin['companyname']

							);
						}
					}



					if (count($data['data']['files']) > 0) {
						$com_id = $this->session->dflogin['companyid'];
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



	public function File_dtl()
	{
		try {
			if (isset($this->session->dflogin)) {

				$this->load->view('include/header');
				$this->load->view('include/topbar');
				$this->load->view('filever/file_version');
				$this->load->view('include/footer');
				$this->load->view('filever/file_versionScript');
			}elseif(isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){
				$this->load->view('include/header');
				$this->load->view('include/topbar');
				$this->load->view('filever/file_version');
				$this->load->view('include/footer');
				$this->load->view('filever/file_versionScript');
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}
	
	public function fdoc_dt()
	{
		try {
			if (isset($this->session->dflogin)) {

				$doc_id = $_POST['doc_id'];

				$com_id = $this->session->dflogin['companyid'];
				$where = "isactive=1 and owner=$com_id and id=$doc_id";
				$file_data = $this->Model_Db->select(8, null, $where);

				if ($file_data) {

					$file_dt = $file_data[0];
					$d =  $file_dt->documentpath;
					$dt['file_data'] = $file_dt;

					if ($file_dt->documentpath) {
						$dt['file_meta'] = stat($d);
					}
					$dt['file_size'] = $this->size_as_kb($dt['file_meta']['size']);

					if ($this->session->userdata('item')) {
						$this->session->unset_userdata('item');
					}

					$this->session->set_userdata('item', $dt);
					$data['status'] = true;
				} else {
					$data['status'] = false;
					$data['message'] = "No Data Is atttached to the file";
				}
				echo json_encode($data);
			} elseif (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1') {

				$doc_id = $_POST['doc_id'];

				$com_id = $this->session->dflogin_staff['entryby'];
				$where = "isactive=1 and owner=$com_id and id=$doc_id";
				$file_data = $this->Model_Db->select(8, null, $where);

				if ($file_data) {

					$file_dt = $file_data[0];
					$d = $_SERVER['DOCUMENT_ROOT'] . "/digital_web_office/" . $file_dt->documentpath;
					$dt['file_data'] = $file_dt;

					if ($file_dt->documentpath) {
						$dt['file_meta'] = stat($d);
					}
					$dt['file_size'] = $this->size_as_kb($dt['file_meta']['size']);

					if ($this->session->userdata('item')) {
						$this->session->unset_userdata('item');
					}

					$this->session->set_userdata('item', $dt);
					$data['status'] = true;
				} else {
					$data['status'] = false;
					$data['message'] = "No Data Is atttached to the file";
				}
				echo json_encode($data);
			}else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}




	public function dlt()
	{
		try {
			if (isset($this->session->dflogin) && $this->session->dflogin['typeid'] == 1 || $this->session->dflogin['typeid'] == 4) {
				$data = array();
				$request = json_decode(json_encode($_POST));
				$file = $request->fname;
				$dltfile = 'assets/pdf/' . $file;
				if (unlink($dltfile)) {
					$data['status'] = true;
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

	public function make_directory()
	{
		try {
			if (isset($this->session->dflogin) && ($this->session->dflogin['typeid'] == 1 || $this->session->dflogin['typeid'] == 4)) {
				$data = array();
				$request = json_decode(json_encode($_POST));
				$createfile = "assets/pdf/$request->dname/$request->input";
				if (!file_exists($createfile)) {
					// $data['status']=true;
					$r = mkdir($createfile, 0777, true);
					if ($r) {
						$data['status'] = true;
						$data['data'] = "File Created";
					} else {
						$data['status'] = false;
						$data['data'] = "File Not Created";
					}
				} else {
					$data['status'] = false;
					$data['data'] = "Directory already exist";
				}
				echo json_encode($data);
				// print_r($createfile);
				exit();
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}

	public function delete_directory()
	{
		try {
			if (isset($this->session->dflogin) && ($this->session->dflogin['typeid'] == 1 || $this->session->dflogin['typeid'] == 4)) {
				$data = array();
				$request = json_decode(json_encode($_POST));
				$createfile = "assets/pdf/$request->dname";
				if (!file_exists($createfile)) {
					// $data['status']=true;
					$data['status'] = false;
					$data['data'] = "Directory Does not exist";
				} else {
					$this->load->helper('file');
					delete_files($createfile, true);
					$r = rmdir($createfile);
					if ($r) {
						$data['status'] = true;
						$data['data'] = "Folder Deleted";
					} else {
						$data['status'] = false;
						$data['data'] = "Folder Not Deleted";
					}
				}
				echo json_encode($data);
				// print_r($createfile);
				exit();
			} else {
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}
}
?>