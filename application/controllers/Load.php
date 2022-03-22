<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Load extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Model_Default');
    }

    public function load_datatype(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id desc";
                $res=$this->Model_Db->select(61,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->typename</option>";
                    }
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

    public function load_usertype(){
        try{
            if (isset($this->session->dflogin)) {
            	$usertype=$this->session->dflogin['typeid'];
                $data=array();
                if($usertype == 1){
                	$where="isactive=true";
				}else{
                	$where="id=3";
				}
                $orderby="id asc";
                $res=$this->Model_Db->select(1,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->typename</option>";
                    }
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
    public function load_user(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="type=3 and isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(2,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->name</option>";
                    }
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
    public function load_tl(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="type=2 and isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(2,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->name</option>";
                    }
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
    public function load_areatype(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(3,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->areatypename</option>";
                    }
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
    public function load_areacategory(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(59,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->categoryname</option>";
                    }
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
    public function load_district(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(5,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->distname</option>";
                    }
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
    public function load_documnet_type(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(29,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->typename</option>";
                    }
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
    public function load_admin_district(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(5,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->distname'>$r->id - $r->distname</option>";
                    }
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
    public function load_block(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(6,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->id - $r->blockname</option>";
                    }
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
    public function load_label(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(4,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->labelname</option>";
                    }
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
    public function load_unit(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(7,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->unitname</option>";
                    }
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
    public function load_pc(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="pccode asc";
                $res=$this->Model_Db->select(12,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->pccode - $r->pcname</option>";
                    }
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
	public function load_ac(){
		try{
			if (isset($this->session->dflogin)) {
				$data=array();
				$where="isactive=true";
				$orderby="accode asc";
				$res=$this->Model_Db->select(13,null,$where,$orderby);
				$data[]="<option value=''>Select</option>";
				if($res){
					foreach ($res as $r){
						$data[] = "<option value='$r->id'>$r->accode - $r->acname</option>";
					}
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
	public function load_tour_category(){
		try{
			if (isset($this->session->dflogin)) {
				$data=array();
				$where="isactive=true";
				$orderby="id asc";
				$res=$this->Model_Db->select(36,null,$where,$orderby);
				$data[]="<option value=''>Select</option>";
				if($res){
					foreach ($res as $r){
						$data[] = "<option value='$r->id'>$r->catname</option>";
					}
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
    public function load_zilla(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="zillacode asc";
                $res=$this->Model_Db->select(22,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->zillacode - $r->zillaname</option>";
                    }
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
    public function load_mandal(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(20,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->id - $r->mandalname</option>";
                    }
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
    public function load_shakti(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(23,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->id - $r->shaktiname</option>";
                    }
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
    public function load_booth(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $where="isactive=true";
                $orderby="boothcode asc";
                $res=$this->Model_Db->select(15,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->id - $r->boothname</option>";
                    }
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
    public function load_gender(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $res=$this->Model_Default->gender();
                $data[]="<option value=''>Select</option>";
                foreach ($res as $key=>$value){
                    $data[] = "<option value='$key'>$value</option>";
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
    public function load_caste(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $res=$this->Model_Default->caste();
                $data[]="<option value=''>Select</option>";
                foreach ($res as $key=>$value){
                    $data[] = "<option value='$key'>$value</option>";
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
    public function load_religion(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $res=$this->Model_Default->religion();
                $data[]="<option value=''>Select</option>";
                foreach ($res as $key=>$value){
                    $data[] = "<option value='$key'>$value</option>";
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
	public function load_pooling_year(){
		try{
			if (isset($this->session->dflogin)) {
				$data=array();
				$res=$this->Model_Default->pooling_year();
				$data[]="<option value=''>Select</option>";
				foreach ($res as $key=>$value){
					$data[] = "<option value='$key'>$value</option>";
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
	public function load_candidate_type(){
		try{
			if (isset($this->session->dflogin)) {
				$data=array();
				$res=$this->Model_Default->candidate_type();
				$data[]="<option value=''>Select</option>";
				foreach ($res as $key=>$value){
					$data[] = "<option value='$key'>$value</option>";
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
    public function load_areatype_wise_district(){
        try{
            if (isset($this->session->dflogin)) {
                $data=array();
                $request = json_decode(json_encode($_POST), false);
                $where= "isactive=true";
                if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                    $where.=" and district=$request->id";
                }else{
                    $data['data']="Invalid Stateid.";
                    $data['message']="Bad request.";
                    $data['status']=false;
                    echo json_encode($data);
                    exit();
                }
                $orderby="id asc";
                $res=$this->Model_Db->select(6,null,$where,$orderby);
                $data[]="<option value=''>--Select--</option>";
                if($res!=false){
                    foreach ($res as $r){
                        $data[]="<option value='$r->id'>$r->district</option>";
                    }
                }
                echo json_encode($data);
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
    public function load_areatype_wise_category(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and areatypeid=$request->id";
            }else{
                $data['data']="Invalid Areatype.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(59,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->categoryname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_pc_wise_ac(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and pc=$request->id";
            }else{
                $data['data']="Invalid Stateid.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="accode asc";
            $res=$this->Model_Db->select(13,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->accode - $r->acname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_label_wise_subunit(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and labelid=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(9,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->unitname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_unit_wise_subunit(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and unitid=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(9,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->subunitname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_unit_label_wise_subunit(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->unitid) && is_numeric($request->unitid) && $request->unitid>0 && isset($request->labelid) && $request->labelid>0){
                $where.=" and unitid=$request->unitid and labelid=$request->labelid";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(9,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->subunitname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_category_dist_wise_block(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->aid) && is_numeric($request->aid) && $request->aid>0){
                $where.=" and areacategory=$request->aid";
            }else{
                $data['data']="Invalid Areacategory.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            if(isset($request->did) && is_numeric($request->did) && $request->did>0){
                $where.=" and district=$request->did";
            }else{
                $data['data']="Invalid District.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="blockname asc";
            $res=$this->Model_Db->select(6,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->blockname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_block_wise_district(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and district=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="blockname asc";
            $res=$this->Model_Db->select(6,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->blockname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }   
    public function load_block_wise_gp(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and block=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(16,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->gpname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_block_wise_village(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and block=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="villagename asc";
            $res=$this->Model_Db->select(18,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->villagename</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
	public function load_gp_wise_village(){
		try{
			$data=array();
			$request = json_decode(json_encode($_POST), false);
			$where= "isactive=true";
			if(isset($request->id) && is_numeric($request->id) && $request->id>0){
				$where.=" and gp=$request->id";
			}else{
				$data['data']="Invalid ID.";
				$data['message']="Bad request.";
				$data['status']=false;
				echo json_encode($data);
				exit();
			}
			$orderby="villagename asc";
			$res=$this->Model_Db->select(18,null,$where,$orderby);
			$data[]="<option value=''>Select</option>";
			if($res!=false){
				foreach ($res as $r){
					$data[]="<option value='$r->id'>$r->villagename</option>";
				}
			}
			echo json_encode($data);
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
    public function load_subnit_wise_designation(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->sid) && is_array($request->sid)){
                $count=count($request->sid);
                if($count>0){
                    $id=implode(",",$request->sid);
                    $w_su = "subunitid in($id) and isactive=true";
                }
                $sunit = $this->Model_Db->select(11, null, $w_su);
                if ($sunit) {
                    foreach ($sunit as $r) {
                        $ids[] = $r->id;
                    }
                    $did = implode(",", $ids);
                    $where .= " and id in($did)";
                } else {
                    $data['title'] = "Alert!!";
                    $data['message'] = "Designation not found";
                    $data['status'] = false;
                    echo json_encode($data);
                    exit();
                }
                $orderby="id asc";
                $res=$this->Model_Db->select(10,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res!=false){
                    foreach ($res as $r){
                        $data[]="<option value='$r->id'>$r->designationname</option>";
                    }
                }
            }                      
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_sunit_wise_disignation(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and subunit=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(10,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->designationname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_ac_wise_mandal(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and ac=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(20,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->id - $r->mandalname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_ac_wise_mandal_new(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && count($request->id)>0){
                $where="";
                foreach ($request->id as $key => $value) 
                {
                    if ($key>0) 
                    {
                        $where.=" or ac=$value";
                    }else{
                        $where.=" ac=$value";
                        
                    }
                }
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(20,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->id - $r->mandalname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_ac_wise_booth(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and ac=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="boothcode asc";
            $res=$this->Model_Db->select(14,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->boothcode - $r->boothname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }




    public function load_ac_wise_booth_new(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && count($request->id)>0){
                $where="";
                foreach ($request->id as $key => $value) 
                {
                    if ($key>0) 
                    {
                        $where.=" or ac=$value";
                    }else{
                        $where.=" ac=$value";
                        
                    }
                }
               

            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="boothcode asc";
            $res=$this->Model_Db->select(14,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->boothcode - $r->boothname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_mandal_wise_shaktikendra(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and mandal=$request->id";
            }else{
                $data['data']="Invalid ID.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(23,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->id - $r->shaktiname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function demo(){
        try{
            if ($this->session->dflogin['userid']) {

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
    public function load_EPc(){
        try{
            if ($this->session->dflogin['userid']) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(12,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->pccode - $r->pcname'>$r->pccode - $r->pcname</option>";
                    }
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
    public function load_EPc_wise_EAc(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and pc=$request->id";
            }else{
                $data['data']="Invalid Stateid.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(13,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->accode - $r->acname'>$r->accode - $r->acname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_category(){
        try{
            if ($this->session->dflogin['userid']) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(41,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->catname</option>";
                    }
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
    public function load_cat_wise_subcat(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and catid=$request->id";
            }else{
                $data['data']="Invalid Stateid.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(42,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->subcatname</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_remark(){
        try{
            if ($this->session->dflogin['userid']) {
                $data=array();
                $where="isactive=true";
                $orderby="id asc";
                $res=$this->Model_Db->select(45,null,$where,$orderby);
                $data[]="<option value=''>Select</option>";
                if($res){
                    foreach ($res as $r){
                        $data[] = "<option value='$r->id'>$r->remarkname</option>";
                    }
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
    public function load_remark_wise_cause(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and remarkid=$request->id";
            }else{
                $data['data']="Invalid Remarkid.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(46,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->causename</option>";
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_campaign(){
		try {
			if (isset($this->session->dflogin['userid'])){
				$data = array();
				$where = "isactive=true";
				$orderby="id desc";
				$res = $this->Model_Db->select(48, null, $where,$orderby);
				$data[] = "<option value=''>Select</option>";
				if ($res != false) {
					foreach ($res as $r) {
						$data[] = "<option value='$r->id'>$r->campaignname</option>";
					}
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
    public function load_questiontype(){
		try {
			if (isset($this->session->dflogin['userid'])){
				$data = array();
				$where = "isactive=true";
				$res = $this->Model_Db->select(50, null, $where);
				$data[] = "<option value=''>Select</option>";
				if ($res != false) {
					foreach ($res as $r) {
						$data[] = "<option value='$r->id'>$r->questiontype</option>";
					}
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
    public function load_type_wise_question(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), false);
            $where= "isactive=true";
            if(isset($request->id) && is_numeric($request->id) && $request->id>0){
                $where.=" and questiontypeid=$request->id";
            }else{
                $data['data']="Invalid Questiontype.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(51,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->question</option>";
                }
            }
            echo json_encode($data);
            exit();
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_campaignwise_tellecaller(){
		try {
			if (isset($this->session->dflogin['userid'])){
				extract($_POST);
				$data = array();
				$usertypeid = $this->session->dflogin['typeid'];
				if($usertypeid == 1 || $usertypeid == 2) {
					$where = "campaignid=$id and isactive=true";
				}
				$where_user="isactive=true";
				$res_user = $this->Model_Db->select(2, null, $where_user);
				$res = $this->Model_Db->select(49, null, $where);
				$data[] = "<option value=''>Select</option>";
				if ($res != false) {
					$i = 0;
					foreach ($res as $r){
						foreach ($res_user as $s) {
							if ($r->userid == $s->id && $s->type == 3) {
								$data[] = "<option value='$s->id'>$s->name</option>";
							}
							$i++;
						}
					}
				}
				echo json_encode($data);
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
}
