<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Model_Db extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }
    public function find_table($tblno){
        try{
            $table=array(
                '1'=>'tbl_copmpanies','2'=>'tbl_department','3'=>'tbl_designation','4'=>'tbl_company_dept_mapping','5'=>'tbl_company_staffs','6'=>'tbl_user_type',
                '7'=>'tbl_document_type','8'=>'tbl_documents','9'=>'tbl_admin','10'=>'tbl_admin_user_type','11'=>'tbl_workflow',
                '12'=>'tbl_document_versions','13'=>'tbl_document_edits','14'=>'tbl_user_assign','15'=>'tbl_document_workflow_assign','16'=>'tbl_document_workflow_steps'
            );
            if($table[$tblno]){
                return $table[$tblno];
            }else{
                return false;
            }
        }catch (Exception $e){
            echo "Message:".$e->getMessage();
        }
    }

    // public function validation(){
	// 	try{
	// 		$validate=array(
	// 			'Text'=>'/^[a-zA-Z ]{3,100}$/',
	// 			'AlphaNumeric'=>'/^[0-9a-zA-Z ]{3,100}$/',
	// 			'Email'=>'/^[0-9a-zA-Z@.]{3,100}$/',
	// 			'Mobile'=>'/^[0-9]{10}$/',
	// 			'Date'=>'/^[0-9-]{10}$/',
	// 			'Address'=>'/^[0-9a-zA-Z\,\-\/() ]{0,200}$/',
	// 			'Other'=>'',
	// 		);
	// 		return $refil;
	// 	}catch (Exception $e){
	// 		echo "Message:".$e->getMessage();
	// 	}
	// }
    public function select($tblno,$select=null,$where=null,$orderby=null,$groupby=null,$limit=0,$distinct=null,$offset=0){
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                if($select!=null){
                    $this->db->select($select);
                }
                if($where!=null){
                    $this->db->where($where);
                }
                if($orderby!=null){
                    $this->db->order_by($orderby);
                }
                if($groupby!=null){
                    $this->db->group_by($groupby);
                }
                if($limit>0){
                    $this->db->limit($limit);
                    if($offset>0){
                        $this->db->offset($offset);
                    }
                }
                if($distinct!=null){
                    $this->db->distinct($distinct);
                }
                $response=$this->db->get($table);
                if($response->num_rows()>0){
                    return $response->result();
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch (Exception $e){
            echo "Message:".$e->getMessage();
        }
    }
    public function insert($tblno,$data=array())
    {
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                if(count($data)==1){
                    $this->db->insert($table,$data[0]);
                    if($this->db->affected_rows()>0){
                        $id=$this->db->insert_id();
                    }else{
                        $id=false;
                    }
                    return $id;
                }else{
                    $this->db->insert_batch($table,$data);
                    $res=$this->db->affected_rows();
                    if($res>0){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }catch (Exception $e)
        {
            echo "Message :".$e->getMessage();
        }
    }
    public function update($tblno,$data,$column_name,$ids=null,$where=null)
    {
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                if(count($data)>1){
                    $this->db->update_batch($table, $data, $column_name);
                }else{
                    $this->db->set($data[0]);
                    $status=true;
                    if($where!=null){
                        $this->db->where($where);
                    }else if($ids!=null){
                        $this->db->where_in($column_name,$ids);
                    }else{
                        $status=false;
                    }
                    if($status){
                        $this->db->update($table);
                    }else{
                        return false;
                    }
                }
                if($this->db->affected_rows()>0)
                {
                    if($where!=null){
                        return $this->db->affected_rows();
                    }else{
                        return true;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch (Exception $e)
        {
            echo "Message :".$e->getMessage();
        }
    }
    public function query($query,$type=null){
        try{
            if($query!=""){
                $res=$this->db->query($query);
                if($type!=null){
                    return	$this->db->affected_rows();
                }else{
                    if($res->num_rows()>0){
                        return $res->result();
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }catch (Exception $e){
            echo "Message :".$e->getMessage();
        }
    }
}
