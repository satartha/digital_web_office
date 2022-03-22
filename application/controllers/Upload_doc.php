<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_doc extends CI_Controller {

  
    public function index()
    {
	
        try {
          if (isset($this->session->dflogin)){

                    $this->load->view('include/header');
                    $this->load->view('include/topbar');
                    $this->load->view('include/menubar');
                    $this->load->view('masterforms/upload_doc/upload_doc');
                    $this->load->view('include/footer');
                    $this->load->view('masterforms/upload_doc/upload_docScript');
                    
          }else{
            redirect('Welcome/');
          }
        } catch (Exception $e) {
          echo "Message:" . $e->getMessage();
        }
    }

    public function fast_upload_file()
    {
      try {
        if (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1')){
            
             $status=true;

             if ($this->session->dflogin) 
             {
               $comid=$this->session->dflogin['companyid'];
             } else {
               $comid=$this->session->dflogin_staff['entryby'];
             }
             

             if (isset($_FILES)) 
             {
               if ($this->session->dflogin) {
                if (isset($this->session->basefolder)) {
                  $cur_path=$this->session->basefolder."/raw";
                } else {
                  $status=false;
                }
                
                
               }else{
                 $entryby=$this->session->dflogin_staff['entryby'];
                 $where="isactive=1 and id=$entryby";
                 $com_dtl=$this->Model_Db->select(1,null,$where);

                 if ($com_dtl) 
                 {
                    $cur_path="assets/Documents_company/".$com_dtl[0]->folderpath."/raw";
                 }else{
                   $status=false;
                 }

               }


               if ($status) {
                if(isset($_FILES['booking_attachment']) && !empty($_FILES['booking_attachment']['name'])){
                  $config['upload_path'] = $cur_path."/";
                  $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|zip|rar|doc|pdf|xlsx|xlsm|xlsb|xltx|xltm|xls|csv|txt|pptx|ppt|xps|mp4|wmv';
                  $config['file_name'] =time()."_".$_FILES['booking_attachment']['name'];
                  $full_path=$config['upload_path'].$config['file_name'];
                  
                  
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                  
                  if($this->upload->do_upload('booking_attachment')){
                      $uploadData = $this->upload->data();
                      
                      $insert[0]['filename'] =  $uploadData['raw_name'];
                      $insert[0]['fileext'] =  $uploadData['file_ext'];
                      $insert[0]['documentpath'] =  $full_path;
                      $insert[0]['entryby']=$comid;
                      $insert[0]['entryat']=date("Y-m-d H:i:s");
                      $insert[0]['doctypeid']='6';

                      $res=$this->Model_Db->insert(8,$insert);

                      if ($res) {
                            $data['status']=true;
                            $data['data'] = "Document document uploaded";
                            $data['message'] = "Document document uploaded"; 
                      } else {
                            $data['status']=true;
                            $data['data'] = "Document document  uploaded but not inserted";
                            $data['message'] = "Document document uploaded but not inserted";
                      }
                      
                  

                      
                    
                  }else{                  
                      $data['status']=false;
                      $data['data'] = $this->upload->display_errors();  
                      $data['message'] = $this->upload->display_errors();                
                  }
              }else{                  
                $data['status']=false;
                $data['data'] = "Document Path  Error";
                $data['message'] = "Document Path  Error"; 

                }
               } else {
                $data['status']=false;
                $data['data'] = "Document Path  not found";
                $data['message'] = "Document Path  not found";
               }
               
                


                

             }

             echo json_encode($data);
             
             
        }else{
          redirect('Welcome/');
        }
      } catch (Exception $e) {
        echo "Message:" . $e->getMessage();
      }
    }


   

    public function upload_form()
    {
	
		try {
			if (isset($this->session->dflogin)){

        if (isset($this->session->current_path) ) 
        {
          $data['current_path']=$this->session->current_path;
                
                $this->load->view('include/header');
                $this->load->view('include/topbar');
                $this->load->view('include/menubar');
                $this->load->view('masterforms/upload_doc/upload_doc',$data);
                $this->load->view('include/footer');
                $this->load->view('masterforms/upload_doc/upload_docScript');
          
        }

                
                
			}elseif(isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){
    
        $data['current_path']=$_GET['dname'];
  
        if (isset($data['current_path'])) 
        {
          // $data['current_path']=$this->session->current_path;
                
                $this->load->view('include/header');
                $this->load->view('include/topbar');
                $this->load->view('include/menubar');
                $this->load->view('masterforms/upload_doc/upload_doc',$data);
                $this->load->view('include/footer');
                $this->load->view('masterforms/upload_doc/upload_docScript');
          
        }
          
			}else{
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
    }




    public function r_pc()
    {
      try {
        if (isset($this->session->dflogin)){
          $companyid=$this->session->dflogin['companyid'];

         
          

					$where="entryby=$companyid and isactive=1";

          
          
          $res=$this->Model_Db->select(7,null,$where);

          $where="entryby=$companyid and isactive=1 and usertypeid=3";

          $staff=$this->Model_Db->select(5,null,$where);

          if($staff){
            
            foreach ($staff as $r){
              $data['staff'][]=array(
                'id'=>$r->id,
                'staffname'=>$r->staffname,
                'isactive'=>$r->isactive
              );
            }
          }     
						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
									'typename'=>$r->typename,
									'isactive'=>$r->isactive
								);
							}      
            }else{
                $data['title']="Alert!";
                $data['message']="Sorry,unable to edit this row.";
                $data['status']=false;
                echo json_encode($data);
                exit();
              }
              echo json_encode($data);
                  
        }elseif (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){
          
          $companyid=$this->session->dflogin_staff['entryby'];

					$where="entryby=$companyid and isactive=1";
 
          $res=$this->Model_Db->select(7,null,$where);

          $where="entryby=$companyid and isactive=1 and usertypeid=3";

          $staff=$this->Model_Db->select(5,null,$where);

          if($staff){
            
            foreach ($staff as $r){
              $data['staff'][]=array(
                'id'=>$r->id,
                'staffname'=>$r->staffname,
                'isactive'=>$r->isactive
              );
            }
          }     
						if($res){
							$data['status']=true;
							foreach ($res as $r){
								$data['data'][]=array(
									'id'=>$r->id,
									'typename'=>$r->typename,
									'isactive'=>$r->isactive
								);
							}      
            }else{
                $data['title']="Alert!";
                $data['message']="Sorry,unable to edit this row.";
                $data['status']=false;
                echo json_encode($data);
                exit();
              }
              echo json_encode($data);
                  
        }else{
          redirect('Welcome/');
        }
      } catch (Exception $e) {
        echo "Message:" . $e->getMessage();
      }

    }


    public function exp_dt()
    {
	
        try {
          if (isset($this->session->dflogin) || isset($this->session->dflogin_staff)){

           
              
              extract($_POST);

              $dt['request']=$data;
              $startDate=date('Y-m-d');

              $future_date=date('Y-m-d', strtotime($data, strtotime($startDate)) );
              $dt['startdate']=$startDate;
              $dt['future_date']=$future_date;

              echo json_encode($dt);
              
                
          }
          else{
            redirect('Welcome/');
          }
        } catch (Exception $e) {
          echo "Message:" . $e->getMessage();
        }
    }


    public function update_doc_version()
    {

      try {
        if (isset($this->session->dflogin)){
  
          $request = json_decode(json_encode($_POST), FALSE);
          $status=true;
          if (isset($request->current_path)  && $request->current_path !="") {
            $cur_path=$request->current_path;

            $path=explode("/",$cur_path);
            $c=count($path);
            foreach ($path as $key => $value) 
            {
              if ($key<$c-1) 
              {
                     $n_path[]=$value;
              }
            }
            $cur_path=implode("/",$n_path);

            if(isset($_FILES['doc']) && !empty($_FILES['doc']['name'])){
              $config['upload_path'] = $cur_path."/";
              $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|zip|rar|doc|pdf|xlsx|xlsm|xlsb|xltx|xltm|xls|csv|txt|pptx|ppt|xps|mp4|wmv';
              $config['file_name'] =time()."_".$_FILES['doc']['name'];
              $full_path=$config['upload_path'].$config['file_name'];
              
              
              $this->load->library('upload',$config);
              $this->upload->initialize($config);
              
              if($this->upload->do_upload('doc')){
                  $uploadData = $this->upload->data();
                   
                  $insert[0]['filename'] =  $uploadData['raw_name'];
                  $insert[0]['fileext'] =  $uploadData['file_ext'];
                  $insert[0]['documentpath'] =  $full_path;

                
              }else{                  
                  $status=false;
                  $data['data'] = $this->upload->display_errors();                  
              }
          }else{                  
            $status=false;
            $data['data'] = "Document Path  Error";                  
        }

          } else {

            $data['title'] = "Alert!";
            $data['data'] = "Path error Occured";
            $status = false;
          }
            if(isset($request->txtid) && is_numeric($request->txtid) && $request->txtid>0){
                      $id=$request->txtid;
                      $where="isactive=1 and id=$id";
                      $doc=$this->Model_Db->select(8,null,$where);
                      if (!$doc) 
                      {
                        $status=false;
                        $data['data'] = "Invalid document id  ";  
                      }else{
                        $doc_dt=$doc[0];
                      }
            }else{
                   $status=false;
                    $data['data'] = "Document id  Error";   
            }


                if (isset($request->ver_com) && $request->ver_com !="") {
              
                  // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->ver_com)){
                    $insert[0]['versioncomment'] = trim($request->ver_com);
                    // $data['hii']="hii";
                  }else{
                    $data['title'] = "Alert!";
                    $data['message'] = "Version Comment Error";
                    $status = false;
                  // }
                }
           
                if (isset($request->version) && preg_match('/^[a-zA-Z0-9._]{1,100}$/', $request->version)) {
                  $insert[0]['version'] = trim($request->version);
                } else {
                  $data['title'] = "Alert!";
                  $data['message'] = "Document version error";
                  $status = false;
                }


                if ($status) 
                {
                  
                      
                  $insert[0]['updateby'] = $this->session->dflogin['companyid'];
                  $insert[0]['updateat']=date("Y-m-d H:i:s");
                    
                  if ($request->version > $doc_dt->version ) 
                  {
                    $res=$this->Model_Db->update(8,$insert,"id",$request->txtid);

                    if($res!=false){

                      $old_data=$doc_dt;
                      $new_data=$insert[0];

                      $where="isactive=1 and id=$id";
							       $file_data=$this->Model_Db->select(8,null,$where);

                     if($this->session->userdata('item'))
                    {
                      $this->session->unset_userdata('item');
                    }
                     $dt['file_data']=$file_data[0];
						       $this->session->set_userdata('item',$dt);
                      
                        $in[0]['documentid']=$doc_dt->id;
                        $in[0]['documentpath']=$doc_dt->documentpath;
                        $in[0]['version']=$doc_dt->version;
                        $in[0]['versioncomment']=$doc_dt->versioncomment;
                        $in[0]['owner']=$doc_dt->owner;
                        $in[0]['entryby']=$this->session->dflogin['companyid'];
                        $in[0]['entryat']=date("Y-m-d H:i:s");

                        $res1=$this->Model_Db->insert(12,$in);
                        
                        if ($res1) 
                        {
                          $im[0]['entryby']=$this->session->dflogin['companyid'];
                          $im[0]['entryat']=date("Y-m-d H:i:s");
                          $im[0]['previousvalue']=json_encode($old_data);
                          $im[0]['newvalue']=json_encode($new_data);
                          $im[0]['documentid']=$doc_dt->id;

                          $res2=$this->Model_Db->insert(13,$im);

                          if ($res2) 
                          {
                              $data['title']="Alert!!";
                              $data['message']="Document Details updated successfully.";
                              $data['status']=true;

                              // $this->session->unset_tempdata('editForm');
                          }else{
                            $data['title']="Alert!!";
                            $data['message']="Document edit table error";
                            $data['status']=false;
                          }
                          
                        }else{
                            $data['title']="Alert!!";
                            $data['message']="Document version table error";
                            $data['status']=false;
                        }

                      


                      
                    }else{
                      $data['title']="Alert!!";
                      $data['message']="Document Details updating failed";
                      $data['status']=false;
                    }


                  }else{
                    $data['title']="Alert!!";
                    $data['message']="Document version is not valid";
                    $data['status']=false;
              }


                }else{

                      $data['title']="Alert!!";
                      $data['message']="some error accured";
                      $data['status']=false;

                }


              echo json_encode($data);
        
                  
                 
        }elseif (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){
  
          $request = json_decode(json_encode($_POST), FALSE);
          $status=true;
          if (isset($request->current_path)  && $request->current_path !="") {
            $cur_path=$request->current_path;

            $path=explode("/",$cur_path);
            $c=count($path);
            foreach ($path as $key => $value) 
            {
              if ($key<$c-1) 
              {
                     $n_path[]=$value;
              }
            }
            $cur_path=implode("/",$n_path);

            if(isset($_FILES['doc']) && !empty($_FILES['doc']['name'])){
              $config['upload_path'] = $cur_path."/";
              $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|zip|rar|doc|pdf|xlsx|xlsm|xlsb|xltx|xltm|xls|csv|txt|pptx|ppt|xps|mp4|wmv';
              $config['file_name'] =time()."_".$_FILES['doc']['name'];
              $full_path=$config['upload_path'].$config['file_name'];
              
              
              $this->load->library('upload',$config);
              $this->upload->initialize($config);
              
              if($this->upload->do_upload('doc')){
                  $uploadData = $this->upload->data();
                   
                  $insert[0]['filename'] =  $uploadData['raw_name'];
                  $insert[0]['fileext'] =  $uploadData['file_ext'];
                  $insert[0]['documentpath'] =  $full_path;

                
              }else{                  
                  $status=false;
                  $data['data'] = $this->upload->display_errors();                  
              }
          }else{                  
            $status=false;
            $data['data'] = "Document Path  Error";                  
        }

          } else {

            $data['title'] = "Alert!";
            $data['data'] = "Path error Occured";
            $status = false;
          }
            if(isset($request->txtid) && is_numeric($request->txtid) && $request->txtid>0){
                      $id=$request->txtid;
                      $where="isactive=1 and id=$id";
                      $doc=$this->Model_Db->select(8,null,$where);
                      if (!$doc) 
                      {
                        $status=false;
                        $data['data'] = "Invalid document id  ";  
                      }else{
                        $doc_dt=$doc[0];
                      }
            }else{
                   $status=false;
                    $data['data'] = "Document id  Error";   
            }


                if (isset($request->ver_com) && $request->ver_com !="") {
              
                  // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->ver_com)){
                    $insert[0]['versioncomment'] = trim($request->ver_com);
                    // $data['hii']="hii";
                  }else{
                    $data['title'] = "Alert!";
                    $data['message'] = "Version Comment Error";
                    $status = false;
                  // }
                }
    
                if (isset($request->version) && preg_match('/^[a-zA-Z0-9._]{1,100}$/', $request->version)) {
                  $insert[0]['version'] = trim($request->version);
                } else {
                  $data['title'] = "Alert!";
                  $data['message'] = "Document version error";
                  $status = false;
                }


                if ($status) 
                {
                  
                      
                  $insert[0]['updateby'] = $this->session->dflogin_staff['entryby'];
                  $insert[0]['updateat']=date("Y-m-d H:i:s");
                    
                  if ($request->version > $doc_dt->version ) 
                  {
                    $res=$this->Model_Db->update(8,$insert,"id",$request->txtid);

                    if($res!=false){

                      $old_data=$doc_dt;
                      $new_data=$insert[0];

                      $where="isactive=1 and id=$id";
							       $file_data=$this->Model_Db->select(8,null,$where);

                     if($this->session->userdata('item'))
                    {
                      $this->session->unset_userdata('item');
                    }
                     $dt['file_data']=$file_data[0];
						       $this->session->set_userdata('item',$dt);
                      
                        $in[0]['documentid']=$doc_dt->id;
                        $in[0]['documentpath']=$doc_dt->documentpath;
                        $in[0]['version']=$doc_dt->version;
                        $in[0]['versioncomment']=$doc_dt->versioncomment;
                        $in[0]['owner']=$doc_dt->owner;
                        $in[0]['entryby']=$this->session->dflogin_staff['entryby'];
                        $in[0]['entryat']=date("Y-m-d H:i:s");

                        $res1=$this->Model_Db->insert(12,$in);
                        
                        if ($res1) 
                        {
                          $im[0]['entryby']=$this->session->dflogin_staff['entryby'];
                          $im[0]['entryat']=date("Y-m-d H:i:s");
                          $im[0]['previousvalue']=json_encode($old_data);
                          $im[0]['newvalue']=json_encode($new_data);
                          $im[0]['documentid']=$doc_dt->id;

                          $res2=$this->Model_Db->insert(13,$im);

                          if ($res2) 
                          {
                              $data['title']="Alert!!";
                              $data['message']="Document Details updated successfully.";
                              $data['status']=true;

                              // $this->session->unset_tempdata('editForm');
                          }else{
                            $data['title']="Alert!!";
                            $data['message']="Document edit table error";
                            $data['status']=false;
                          }
                          
                        }else{
                            $data['title']="Alert!!";
                            $data['message']="Document version table error";
                            $data['status']=false;
                        }
                    }else{
                      $data['title']="Alert!!";
                      $data['message']="Document Details updating failed";
                      $data['status']=false;
                    }
                  }else{
                    $data['title']="Alert!!";
                    $data['message']="Document version is not valid";
                    $data['status']=false;
                     }
                }else{

                      $data['title']="Alert!!";
                      $data['data']="some error accured";
                      $data['status']=false;

                }


              echo json_encode($data);
        
                  
                 
        }else{
          redirect('Welcome/');
        }
      } catch (Exception $e) {
        echo "Message:" . $e->getMessage();
      }        
    }

    public function get_ownername($idowner)
    {
      try {
        if (isset($this->session->dflogin)){

               $where="isactive=1 and id=$idowner";  
               $com_dtl=$this->Model_Db->select(1,null,$where);
               return $com_dtl[0]->companyname;
                  
        }else{
          redirect('Welcome/');
        }
      } catch (Exception $e) {
        echo "Message:" . $e->getMessage();
      }
    }

    public function doc_details()
    { 
      try {
        if (isset($this->session->dflogin)){
          $item=$this->session->item;
          $ownerid=$item['file_data']->owner;
          $where="isactive=1 and id=$ownerid";
          $com_dtl=$this->Model_Db->select(1,null,$where);
          $data['owner_name']=$com_dtl[0]->companyname;

          
 
          if (isset($item) )
          {
              $data['status']=true;
              $data['data']=$item;
          }else{
             $data['status']=false;
          } 

          $where="isactive=1";

          $wf=$this->Model_Db->select(11,null,$where);
          
          if ($wf) 
          {
            foreach ($wf as $key => $value) 
            {
              $data['wf'][]=$value;
            }
          }else{
            $data['wf']=false;
          }
           
          $id=$item['file_data']->id;
          
         

          $where="isactive=1 and documentid=".$id;          
          $res=$this->Model_Db->select(12,null,$where);
          
          

          $where="isactive=1 and iscomplete=0 and documentid=".$id;          
          $assign_dtl=$this->Model_Db->select(15,null,$where);
          $com_id=$this->session->dflogin['companyid'];

          $where="isactive=1 and entryby=$com_id";
          $employee_dtl=$this->Model_Db->select(5,null,$where);
          
          if ($employee_dtl!=false) 
          {
             foreach ($employee_dtl as $key => $value) 
             {
               $data['employee_dtl'][$key]=$value;
             }
          }else{
            $data['employee_dtl']=false;
          }
          if (isset($this->session->basefolder)) 
          {
            $data['base_dir']=$this->session->basefolder;
          }

          if ($assign_dtl==false) 
          {
            $data['document_workflow_sts']=false;
          }else{
            $data['document_workflow_sts']=true;
          }

          $data['doc_version']=array();
          if ($res) 
          {
            foreach ($res as $key => $value) 
            {
              $data['doc_version'][]=$value;
              $data['ownername'][]=$this->get_ownername($value->owner);
            }
          }

          $where="isactive=1";
          $doc_type=$this->Model_Db->select(7,null,$where);

          if ($doc_type) 
          {
            foreach ($doc_type as $key => $value) 
            {
              $data['doc_type'][]=$value;
            }
            
          }

          echo json_encode($data);
          
          // $this->session->unset_userdata('item');

        }elseif(isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){

          $item=$this->session->item;
          
          $ownerid=$item['file_data']->owner;
          $where="isactive=1 and id=$ownerid";
          $com_dtl=$this->Model_Db->select(1,null,$where);
          $data['owner_name']=$com_dtl[0]->companyname;
          
          if (isset($item) )
          {
              $data['status']=true;
              $data['data']=$item;
          }else{
             $data['status']=false;
          } 

          $id=$item['file_data']->id;
          $where="isactive=1 and documentid=".$id;          
          $res=$this->Model_Db->select(12,null,$where);

          $where="isactive=1 and iscomplete=0 and documentid=".$id;          
          $assign_dtl=$this->Model_Db->select(15,null,$where);
          $com_id=$this->session->dflogin_staff['entryby'];

          $where="isactive=1 and entryby=$com_id";
          $employee_dtl=$this->Model_Db->select(5,null,$where);
          
          if ($employee_dtl!=false) 
          {
             foreach ($employee_dtl as $key => $value) 
             {
               $data['employee_dtl'][$key]=$value;
             }
          }else{
            $data['employee_dtl']=false;
          }
        
       
       if (isset($this->session->basefolder)) 
       {
         $data['base_dir']=$this->session->basefolder;
       }

            
          
          
          

          if ($assign_dtl==false) 
          {
            $data['document_workflow_sts']=false;
          }else{
            $data['document_workflow_sts']=true;
          }


          $data['doc_version']=array();
          if ($res) 
          {
            foreach ($res as $key => $value) 
            {
              $data['doc_version'][]=$value;
            }
          }

          $where="isactive=1";
          $doc_type=$this->Model_Db->select(7,null,$where);

          if ($doc_type) 
          {
            foreach ($doc_type as $key => $value) 
            {
              $data['doc_type'][]=$value;
            }
            
          }

          
          echo json_encode($data);
          // $this->session->unset_userdata('item');
        }else{
          redirect('Welcome/');
        }
      } catch (Exception $e) {
        echo "Message:" . $e->getMessage();
      }
    }










    public function c_candidate(){
      try{
        if (isset($this->session->dflogin) ) {
          // echo "<pre>";

          // print_r($this->session);
          // exit();
  
            $data=array();
            $insert=array();
            $status=true;
            $request = json_decode(json_encode($_POST), FALSE);

            $data['request']=$request;

     

          if (isset($request->current_path)  && $request->current_path !="") {
            $cur_path=$request->current_path;
          } else {
            $data['title'] = "Alert!";
            $data['message'] = "Path error Occured";
            $status = false;
          }
                    if(isset($_FILES['doc']) && !empty($_FILES['doc']['name'])){
                        $config['upload_path'] = "assets/Documents_company/".$cur_path."/";
                        $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|zip|rar|doc|pdf|xlsx|xlsm|xlsb|xltx|xltm|xls|csv|txt|pptx|ppt|xps|mp4|wmv';
                        $config['file_name'] =time()."_".$_FILES['doc']['name'];
                        $full_path=$config['upload_path'].$config['file_name'];
                        
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);
                        
                        if($this->upload->do_upload('doc')){
                            $uploadData = $this->upload->data();
                           
                            $insert[0]['filename'] =  $uploadData['raw_name'];
                            $insert[0]['fileext'] =  $uploadData['file_ext'];
                            $insert[0]['documentpath'] =  $full_path;
                           
                            // $insert[0]['filename'] =  $uploadData['raw_name'];
                            // if (isset($prev_data) && isset($prev_data[0]->cvpath)) 
                            // {
                            //     $file_path="./assets/dep_logo/".$prev_data[0]->cvpath;
                            //     unlink($file_path);
                            // }
                        }else{                  
                            $status=false;
                            $data['data'] = $this->upload->display_errors();                  
                        }
                    }else{     
                      
                      if(isset($request->txtid) && is_numeric($request->txtid) && $request->txtid>0){

                      }else{
                        $status=false;
                        $data['data'] = "Document file  Error";    
                      }


                                   
                  }
            
               
            if (isset($request->doc_name) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->doc_name)) {
              $insert[0]['documentname'] = trim($request->doc_name);
            } else {
              $data['title'] = "Alert!";
              $data['message'] = "Document Name error";
              $status = false;
            }
            if (isset($request->sentby) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->sentby)) {
              $insert[0]['sentby'] = trim($request->sentby);
            } else {
              $data['title'] = "Alert!";
              $data['message'] = "Sent by error";
              $status = false;
            }
            if (isset($request->source) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->source)) {
              $insert[0]['source'] = trim($request->source);
            } else {
              $data['title'] = "Alert!";
              $data['message'] = "Source Name error";
              $status = false;
            }

            if (isset($request->doctype) && $request->doctype !="") {
              if(preg_match("/^[0-9]{1,}$/",$request->doctype)){
                $insert[0]['doctypeid'] = $request->doctype;
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Invalid Document type";
                $status = false;
              }
            }

            // if (isset($request->khatano) && $request->khatano !="") {
            //   if(preg_match("/^[0-9]{1,}$/",$request->khatano)){
            //     $insert[0]['kahatano'] = $request->khatano;
            //   }
            // }

            if (isset($request->letterno) && $request->letterno !="") {
              if(preg_match("/^[0-9]{1,}$/",$request->letterno)){
                $insert[0]['letterno'] = $request->letterno;
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Invalid Letter Number";
                $status = false;
              }
            }

          
  
            
  
            if (isset($request->letterdt) ) {
              $insert[0]['letterdate'] = $request->letterdt;
            } 
  
                      
            if (isset($request->expdt) && $request->expdt !="") {
            
                $insert[0]['expirydate'] = $request->expdt;
              }
            if (isset($this->session->dflogin['companyid']) && $this->session->dflogin['companyid']!="") 
            {
              
              $insert[0]['owner'] = $this->session->dflogin['companyid'];
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Owner Details Error";
              $status = false;
            }
              

            if (isset($request->description) && $request->description !="") {
              // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->description)){
                $insert[0]['description'] = trim($request->description);
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Description Error";
                $status = false;
              }
            // }
            if (isset($request->ver_com) && $request->ver_com !="") {
              
              // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->ver_com)){
                $insert[0]['versioncomment'] = trim($request->ver_com);
                // $data['hii']="hii";
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Version Comment Error";
                $status = false;
              // }
            }

            if (isset($request->version) && preg_match('/^[a-zA-Z0-9._]{1,100}$/', $request->version)) {
              $insert[0]['version'] = trim($request->version);
            } else {
              $data['title'] = "Alert!";
              $data['message'] = "Document Version error";
              $status = false;
            }
       
            if($status){
              if(isset($request->txtid) && is_numeric($request->txtid)){
                if($request->txtid>0){
                  if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                    $insert[0]['updateby'] = $this->session->dflogin['companyid'];
                    $insert[0]['updateat']=date("Y-m-d H:i:s");
                    $res=$this->Model_Db->update(8,$insert,"id",$request->txtid);
                    $insert_id = $this->db->insert_id();

                    if($res!=false){

                      if ($request->version > $this->session->editForm['version'] ) 
                      {
                        $old_data=$this->session->editForm;
                        $new_data=$insert[0];
                        
                        $in[0]['documentid']=$this->session->editForm['id'];
                        $in[0]['documentpath']=$this->session->editForm['documentpath'];
                        $in[0]['version']=$this->session->editForm['version'];
                        $in[0]['versioncomment']=$this->session->editForm['versioncomment'];
                        $in[0]['owner']=$this->session->editForm['owner'];
                        $in[0]['entryby']=$this->session->dflogin['companyid'];
                        $in[0]['entryat']=date("Y-m-d H:i:s");
                        
                        $res1=$this->Model_Db->insert(12,$insert);
                        
                        if ($res1) 
                        {
                          $im[0]['entryby']=$this->session->dflogin['companyid'];
                          $im[0]['entryat']=date("Y-m-d H:i:s");
                          $im[0]['previousvalue']=json_encode($old_data);
                          $im[0]['newvalue']=json_encode($new_data);
                          $im[0]['documentid']=$this->session->editForm['id'];

                          $res2=$this->Model_Db->insert(11,$insert);

                          if ($res2) 
                          {
                           
                              $data['title']="Alert!!";
                              $data['message']="Document Details updated successfully.";
                              $data['status']=true;

                              $this->session->unset_tempdata('editForm');
                          }else{
                            $data['title']="Alert!!";
                            $data['message']="Document edit table error";
                            $data['status']=false;
                          }
                          
                        }else{
                            $data['title']="Alert!!";
                            $data['message']="Document version table error";
                            $data['status']=false;
                        }
                           
                      }

                    }else{
                      $data['title']="Alert!!";
                      $data['message']="Document Details updating failed";
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
                  $res=$this->Model_Db->insert(8,$insert);
                  $insert_id = $this->db->insert_id();
                  if($res!=false){
                    $data['title']="Alert!";
                    $data['message']="Doucment Uploaded successfully.";
                    $data['status']=true;
                  }else{
                    $data['title']="Alert!";
                    $data['message']="Doucment Upload failed";
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
               
            // if($data['status']==true)
            // {
            //         // $id=$request->txtid;
                    
            //         // echo print_r($request);
            //         // exit();
            //         foreach ($request->user_as as $value) 
            //         {  
            //           $where="documentid=$insert_id and userid=".$value;
            //           // $data['where']=$where;
            //           $doc_per=$this->Model_Db->select(14,null,$where);

            //           if (!$doc_per) 
            //           {
                        
            //              $imkm[0]['userid']=$value;
            //              $imkm[0]['documentid']=$insert_id;
            //              $imkm[0]['assignedby']=17;
            //              $imkm[0]['entryby']=$this->session->dflogin['companyid'];
            //              $imkm[0]['entryat']=date("Y-m-d H:i:s");
                         
                        

            //              $data['new'][]= $imkm[0];
            //             //   print_r($imkm[0]);
            //             //  exit();
                         
            //              $res12=$this->Model_Db->insert(14,$imkm);
                 
            //             if($res12!=false){
            //               $data['title']="Alert!";
            //               $data['message']="Doucment Uploaded and permission given to the users successfully.";
            //               $data['status']=true;
            //             }else{
            //               $data['title']="Alert!";
            //               $data['message']="Doucment Uploaded but permission cannot be given to the users completetly";
            //               $data['status']=false;
            //             }

            //           }
                      
            //         }
    
            // }  

            echo json_encode($data);
            exit();
      
        }elseif(isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){
              

          $data=array();
          $insert=array();
          $status=true;
          $request = json_decode(json_encode($_POST), FALSE);

          $data['request']=$request;

      

        if (isset($request->current_path)  && $request->current_path !="") {
          $cur_path=$request->current_path;
        } else {
          $data['title'] = "Alert!";
          $data['message'] = "Path error Occured";
          $status = false;
        }

       
                  if(isset($_FILES['doc']) && !empty($_FILES['doc']['name'])){
                      $config['upload_path'] = "assets/Documents_company/".$cur_path."/";
                      $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|zip|rar|doc|pdf|xlsx|xlsm|xlsb|xltx|xltm|xls|csv|txt|pptx|ppt|xps|mp4|wmv';
                      $config['file_name'] =time()."_".$_FILES['doc']['name'];
                      $full_path=$config['upload_path'].$config['file_name'];
                      
                      $this->load->library('upload',$config);
                      $this->upload->initialize($config);
                      
                      if($this->upload->do_upload('doc')){
                          $uploadData = $this->upload->data();
                         
                          $insert[0]['filename'] =  $uploadData['raw_name'];
                          $insert[0]['fileext'] =  $uploadData['file_ext'];
                          $insert[0]['documentpath'] =  $full_path;
                         
                          // $insert[0]['filename'] =  $uploadData['raw_name'];
                          // if (isset($prev_data) && isset($prev_data[0]->cvpath)) 
                          // {
                          //     $file_path="./assets/dep_logo/".$prev_data[0]->cvpath;
                          //     unlink($file_path);
                          // }
                      }else{                  
                          $status=false;
                          $data['data'] = $this->upload->display_errors();                  
                      }
                  }else{     
                    
                    if(isset($request->txtid) && is_numeric($request->txtid) && $request->txtid>0){

                    }else{
                      $status=false;
                      $data['data'] = "Document file  Error";    
                    }


                                 
                }
             
          if (isset($request->doc_name) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->doc_name)) {
            $insert[0]['documentname'] = trim($request->doc_name);
          } else {
            $data['title'] = "Alert!";
            $data['message'] = "Document Name error";
            $status = false;
          }

          if (isset($request->doctype) && $request->doctype !="") {
            if(preg_match("/^[0-9]{1,}$/",$request->doctype)){
              $insert[0]['doctypeid'] = $request->doctype;
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Invalid Document type";
              $status = false;
            }
          }

     

          if (isset($request->letterno) && $request->letterno !="") {
            if(preg_match("/^[0-9]{1,}$/",$request->letterno)){
              $insert[0]['letterno'] = $request->letterno;
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Invalid Letter Number";
              $status = false;
            }
          }

          if (isset($request->letterdt) ) {
            $insert[0]['letterdate'] = $request->letterdt;
          } 

                    
          if (isset($request->expdt) && $request->expdt !="") {
          
              $insert[0]['expirydate'] = $request->expdt;
            }
          if (isset($this->session->dflogin_staff['entryby']) && $this->session->dflogin_staff['entryby']!="") 
          {
            $insert[0]['owner'] = $this->session->dflogin_staff['entryby'];
          }else{
            $data['title'] = "Alert!";
            $data['message'] = "Owner Details Error";
            $status = false;
          }
            

          if (isset($request->description) && $request->description !="") {
            // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->description)){
              $insert[0]['description'] = trim($request->description);
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Description Error";
              $status = false;
            }
          // }
          if (isset($request->ver_com) && $request->ver_com !="") {
            
            // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->ver_com)){
              $insert[0]['versioncomment'] = trim($request->ver_com);
              // $data['hii']="hii";
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Version Comment Error";
              $status = false;
            // }
          }

          if (isset($request->version) && preg_match('/^[a-zA-Z0-9._]{1,100}$/', $request->version)) {
            $insert[0]['version'] = trim($request->version);
          } else {
            $data['title'] = "Alert!";
            $data['message'] = "Document Name error";
            $status = false;
          }
     
          if($status){
            if(isset($request->txtid) && is_numeric($request->txtid)){
              if($request->txtid>0){
                if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                  $insert[0]['updateby'] = $this->session->dflogin_staff['entryby'];
                  $insert[0]['updateat']=date("Y-m-d H:i:s");
                  $res=$this->Model_Db->update(8,$insert,"id",$request->txtid);
                  $insert_id = $this->db->insert_id();

                  if($res!=false){

                    
                    if ($request->version > $this->session->editForm['version'] ) 
                    {
                      $old_data=$this->session->editForm;
                      $new_data=$insert[0];
                      
                      $in[0]['documentid']=$this->session->editForm['id'];
                      $in[0]['documentpath']=$this->session->editForm['documentpath'];
                      $in[0]['version']=$this->session->editForm['version'];
                      $in[0]['versioncomment']=$this->session->editForm['versioncomment'];
                      $in[0]['owner']=$this->session->editForm['owner'];
                      $in[0]['entryby']=$this->session->dflogin_staff['entryby'];
                      $in[0]['entryat']=date("Y-m-d H:i:s");

                      $res1=$this->Model_Db->insert(12,$insert);
                      
                      if ($res1) 
                      {
                        $im[0]['entryby']=$this->session->dflogin_staff['entryby'];
                        $im[0]['entryat']=date("Y-m-d H:i:s");
                        $im[0]['previousvalue']=json_encode($old_data);
                        $im[0]['newvalue']=json_encode($new_data);
                        $im[0]['documentid']=$this->session->editForm['id'];

                        $res2=$this->Model_Db->insert(11,$insert);

                        if ($res2) 
                        {
                         
                            $data['title']="Alert!!";
                            $data['message']="Document Details updated successfully.";
                            $data['status']=true;

                            $this->session->unset_tempdata('editForm');
                        }else{
                          $data['title']="Alert!!";
                          $data['message']="Document edit table error";
                          $data['status']=false;
                        }
                        
                      }else{
                          $data['title']="Alert!!";
                          $data['message']="Document version table error";
                          $data['status']=false;
                      }
                         
                    }

                  }else{
                    $data['title']="Alert!!";
                    $data['message']="Document Details updating failed";
                    $data['status']=false;
                  }
                }else{
                  $data['status']=false;
                  $data['title']='Time out';
                  $data['message']='You have exceeded the max time limit of 30 seconds to edit this form.';
                }
              }else if($request->txtid==0){
                $insert[0]['entryby']=$this->session->dflogin_staff['entryby'];
                                // $insert[0]['companyid']=$this->session->dflogin['companyid'];
                $insert[0]['entryat']=date("Y-m-d H:i:s");
                $res=$this->Model_Db->insert(8,$insert);
                $insert_id = $this->db->insert_id();
                if($res!=false){
                  $data['title']="Alert!";
                  $data['message']="Doucment Uploaded successfully.";
                  $data['status']=true;
                }else{
                  $data['title']="Alert!";
                  $data['message']="Doucment Upload failed";
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
             
          if($data['status']==true)
          {
                  // $id=$request->txtid;
                  
                  // echo print_r($request);
                  // exit();


                  if (isset($request->user_as) && count($request->user_as)>0) {
                    foreach ($request->user_as as $value) 
                    {  
                      $where="documentid=$insert_id and userid=".$value;
                      // $data['where']=$where;
                      $doc_per=$this->Model_Db->select(14,null,$where);
  
                      if (!$doc_per) 
                      {
                        
                         $imkm[0]['userid']=$value;
                         $imkm[0]['documentid']=$insert_id;
                         $imkm[0]['assignedby']=$this->session->dflogin_staff['staffid'];;
                         $imkm[0]['entryby']=$this->session->dflogin_staff['entryby'];
                         $imkm[0]['entryat']=date("Y-m-d H:i:s");
                         
                         $data['new'][]= $imkm[0];
                        //   print_r($imkm[0]);
                        //  exit();
                         $res12=$this->Model_Db->insert(14,$imkm);
                 
                        if($res12!=false){
                          $data['title']="Alert!";
                          $data['message']="Doucment Uploaded and permission given to the users successfully.";
                          $data['status']=true;
                        }else{
                          $data['title']="Alert!";
                          $data['message']="Doucment Uploaded but permission cannot be given to the users completetly";
                          $data['status']=false;
                        }
  
                      }
                      
                    }
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





    public function edit_attr(){
      
      try{
        if (isset($this->session->dflogin) ) {
  
  
          
            $data=array();
            $insert=array();
            $status=true;
            $request = json_decode(json_encode($_POST), FALSE);

            $data['request']=$request;
            
         
            if(isset($request->txtid) && is_numeric($request->txtid) && $request->txtid>0){
                    $id=$request->txtid;
                    $where="isactive=1 and id=$id";
                    $doc=$this->Model_Db->select(8,null,$where);
                    if (!$doc) 
                    {
                      $status=false;
                      $data['data'] = "Invalid document id  ";  
                    }else{
                      $doc_dt=$doc[0];
                    }
            }else{
                  $status=false;
                    $data['data'] = "Document id  Error";   
            }
            
            if (isset($request->doc_name) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->doc_name)) {
              $insert[0]['documentname'] = trim($request->doc_name);
            } else {
              $data['title'] = "Alert!";
              $data['message'] = "Document Name error";
              $status = false;
            }

            if (isset($request->doctype) && $request->doctype !="") {
              if(preg_match("/^[0-9]{1,}$/",$request->doctype)){
                $insert[0]['doctypeid'] = $request->doctype;
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Invalid Document type";
                $status = false;
              }
            }

          

            if (isset($request->letterno) && $request->letterno !="") {
              if(preg_match("/^[0-9]{1,}$/",$request->letterno)){
                $insert[0]['letterno'] = $request->letterno;
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Invalid Letter Number";
                $status = false;
              }
            }
  
            
  
            if (isset($request->letterdt) ) {
              $insert[0]['letterdate'] = $request->letterdt;
            } 
  
                      
            if (isset($request->expdt) && $request->expdt !="") {
            
                $insert[0]['expirydate'] = $request->expdt;
              }
         
              

            if (isset($request->description) && $request->description !="") {
              // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->description)){
                $insert[0]['description'] = trim($request->description);
              }else{
                $data['title'] = "Alert!";
                $data['message'] = "Description Error";
                $status = false;
              }
            // }
         
       
            if($status){
              if(isset($request->txtid) && is_numeric($request->txtid)){
                if($request->txtid>0){

                    $insert[0]['updateby'] = $this->session->dflogin['companyid'];
                    $insert[0]['updateat']=date("Y-m-d H:i:s");
                    $res=$this->Model_Db->update(8,$insert,"id",$request->txtid);

                    if($res!=false){

                      $where="isactive=1 and id=$id";
                      $file_data=$this->Model_Db->select(8,null,$where);
 
                      if($this->session->userdata('item'))
                     {
                       $this->session->unset_userdata('item');
                     }
                      $dt['file_data']=$file_data[0];
                    $this->session->set_userdata('item',$dt);

                        $old_data=$doc_dt;
                        $new_data=$insert[0];

                    
                          $im[0]['entryby']=$this->session->dflogin['companyid'];
                          $im[0]['entryat']=date("Y-m-d H:i:s");
                          $im[0]['previousvalue']=json_encode($old_data);
                          $im[0]['newvalue']=json_encode($new_data);
                          $im[0]['documentid']=$doc_dt->id;

                          $res2=$this->Model_Db->insert(13,$im);

                          if ($res2) 
                          {
                              $data['title']="Alert!!";
                              $data['message']="Document Details updated successfully.";
                              $data['status']=true;

                             
                          }else{
                            $data['title']="Alert!!";
                            $data['message']="Document edit table error";
                            $data['status']=false;
                          }
                        
                    }else{
                      $data['title']="Alert!!";
                      $data['message']="Document Details updating failed";
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
      
        }elseif (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'  ) {
  
  
          
          $data=array();
          $insert=array();
          $status=true;
          $request = json_decode(json_encode($_POST), FALSE);

          $data['request']=$request;
          
       
          if(isset($request->txtid) && is_numeric($request->txtid) && $request->txtid>0){
                  $id=$request->txtid;
                  $where="isactive=1 and id=$id";
                  $doc=$this->Model_Db->select(8,null,$where);
                  if (!$doc) 
                  {
                    $status=false;
                    $data['data'] = "Invalid document id  ";  
                  }else{
                    $doc_dt=$doc[0];
                  }
          }else{
                $status=false;
                  $data['data'] = "Document id  Error";   
          }
          
          if (isset($request->doc_name) && preg_match('/^[a-zA-Z0-9 ]{1,100}$/', $request->doc_name)) {
            $insert[0]['documentname'] = trim($request->doc_name);
          } else {
            $data['title'] = "Alert!";
            $data['message'] = "Document Name error";
            $status = false;
          }

          if (isset($request->doctype) && $request->doctype !="") {
            if(preg_match("/^[0-9]{1,}$/",$request->doctype)){
              $insert[0]['doctypeid'] = $request->doctype;
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Invalid Document type";
              $status = false;
            }
          }

        

          if (isset($request->letterno) && $request->letterno !="") {
            if(preg_match("/^[0-9]{1,}$/",$request->letterno)){
              $insert[0]['letterno'] = $request->letterno;
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Invalid Letter Number";
              $status = false;
            }
          }

          

          if (isset($request->letterdt) ) {
            $insert[0]['letterdate'] = $request->letterdt;
          } 

                    
          if (isset($request->expdt) && $request->expdt !="") {
          
              $insert[0]['expirydate'] = $request->expdt;
            }
       
            

          if (isset($request->description) && $request->description !="") {
            // if(preg_match("/^[0-9a-zA-Z,-\/() ]{0,200}$/",$request->description)){
              $insert[0]['description'] = trim($request->description);
            }else{
              $data['title'] = "Alert!";
              $data['message'] = "Description Error";
              $status = false;
            }
          // }
       
     
          if($status){
            if(isset($request->txtid) && is_numeric($request->txtid)){
              if($request->txtid>0){

                  $insert[0]['updateby'] = $this->session->dflogin_staff['entryby'];
                  $insert[0]['updateat']=date("Y-m-d H:i:s");
                  $res=$this->Model_Db->update(8,$insert,"id",$request->txtid);

                  if($res!=false){

                    $where="isactive=1 and id=$id";
                    $file_data=$this->Model_Db->select(8,null,$where);

                    if($this->session->userdata('item'))
                   {
                     $this->session->unset_userdata('item');
                   }
                    $dt['file_data']=$file_data[0];
                  $this->session->set_userdata('item',$dt);

                      $old_data=$doc_dt;
                      $new_data=$insert[0];

                  
                        $im[0]['entryby']=$this->session->dflogin_staff['entryby'];
                        $im[0]['entryat']=date("Y-m-d H:i:s");
                        $im[0]['previousvalue']=json_encode($old_data);
                        $im[0]['newvalue']=json_encode($new_data);
                        $im[0]['documentid']=$doc_dt->id;

                        $res2=$this->Model_Db->insert(13,$im);

                        if ($res2) 
                        {
                            $data['title']="Alert!!";
                            $data['message']="Document Details updated successfully.";
                            $data['status']=true;

                           
                        }else{
                          $data['title']="Alert!!";
                          $data['message']="Document edit table error";
                          $data['status']=false;
                        }
                      
                  }else{
                    $data['title']="Alert!!";
                    $data['message']="Document Details updating failed";
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


    public function restore_version()
    { 
      try {
        if (isset($this->session->dflogin)){
            $data=array();
       
            $request = json_decode(json_encode($_POST), FALSE);

            $data['request']=$request;
            // $request->id=json_decode($request->id);
          if (isset($request->id) && is_numeric($request->id) && $request->id>0) {
            $id=$request->id;
  
             $where="isactive=1 and id=$id";

             $doc_dt=$this->Model_Db->select(12,null,$where);
       
             $doc_id=$doc_dt[0]->documentid;

             $where="isactive=1 and id=$doc_id";

             $doc_prev=$this->Model_Db->select(8,null,$where);
             $prev_doc=$doc_prev[0];


        
                       $imd[0]['documentid']=$prev_doc->id;
                        $imd[0]['documentpath']=$prev_doc->documentpath;
                        $imd[0]['version']=$prev_doc->version;
                        $imd[0]['versioncomment']=$prev_doc->versioncomment;
                        $imd[0]['owner']=$prev_doc->owner;
                        $imd[0]['entryby']=$this->session->dflogin['companyid'];
                        $imd[0]['entryat']=date("Y-m-d H:i:s");

                        $res1=$this->Model_Db->insert(12,$imd);

            if ($res1) 
            {
                   
                        $in[0]['documentpath']=$doc_dt[0]->documentpath;
                        $in[0]['versioncomment']=$doc_dt[0]->versioncomment;
                        $in[0]['version']=$doc_dt[0]->version;
                        $in[0]['updateby'] = $this->session->dflogin['companyid'];
                        $in[0]['updateat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->update(8,$in,"id",$doc_id);
          
          
          
          
                        if($res!=false){
                        $imk[0]['isactive']=0;
                        $dt_nm=$this->Model_Db->update(12,$imk,"id",$id);//Here to start--------------------------
          
          
                        $where="isactive=1 and id=$doc_id";
                        $file_data=$this->Model_Db->select(8,null,$where);
          
                        if($this->session->userdata('item'))
                        {
                          $this->session->unset_userdata('item');
                        }
                        $dt['file_data']=$file_data[0];
                      $this->session->set_userdata('item',$dt);
          
                          $old_data=$doc_dt;
                          $new_data=$in[0];
                        
                      
                            $im[0]['entryby']=$this->session->dflogin['companyid'];
                            $im[0]['entryat']=date("Y-m-d H:i:s");
                            $im[0]['previousvalue']=json_encode($old_data);
                            $im[0]['newvalue']=json_encode($new_data);
                            $im[0]['documentid']=$doc_id;
          
                            $res2=$this->Model_Db->insert(13,$im);
          
                            if ($res2) 
                            {
                                $data['title']="Alert!!";
                                $data['message']="Document Details updated successfully.";
                                $data['status']=true;
          
                                
                            }else{
                              $data['title']="Alert!!";
                              $data['message']="Document edit table error";
                              $data['status']=false;
                            } 
                    } else {
                              $data['title']="Alert!!";
                              $data['message']="Document Insert  error";
                              $data['status']=false;
                    }
                    
          
          
                    }else {
                      $data['title']="Alert!!";
                      $data['message']="Document Version ID  error";
                      $data['status']=false;
                    }


            } else {
              
              $data['title']="Alert!!";
              $data['message']="Document Version insert  error";
              $data['status']=false;


            }
         echo json_encode($data);
  
        }elseif (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'){
          $data=array();
     
          $request = json_decode(json_encode($_POST), FALSE);

          $data['request']=$request;
    
        
          // $request->id=json_decode($request->id);
          
        if (isset($request->id) && is_numeric($request->id) && $request->id>0) {
          $id=$request->id;

       
      

           $where="isactive=1 and id=$id";

           $doc_dt=$this->Model_Db->select(12,null,$where);
     
           $doc_id=$doc_dt[0]->documentid;

           $where="isactive=1 and id=$doc_id";

           $doc_prev=$this->Model_Db->select(8,null,$where);
           $prev_doc=$doc_prev[0];


      
                     $imd[0]['documentid']=$prev_doc->id;
                      $imd[0]['documentpath']=$prev_doc->documentpath;
                      $imd[0]['version']=$prev_doc->version;
                      $imd[0]['versioncomment']=$prev_doc->versioncomment;
                      $imd[0]['owner']=$prev_doc->owner;
                      $imd[0]['entryby']=$this->session->dflogin_staff['entryby'];
                      $imd[0]['entryat']=date("Y-m-d H:i:s");

                      $res1=$this->Model_Db->insert(12,$imd);

          if ($res1) 
          {
                 
                      $in[0]['documentpath']=$doc_dt[0]->documentpath;
                      $in[0]['versioncomment']=$doc_dt[0]->versioncomment;
                      $in[0]['version']=$doc_dt[0]->version;
                      $in[0]['updateby'] = $this->session->dflogin_staff['entryby'];
                      $in[0]['updateat']=date("Y-m-d H:i:s");
                      $res=$this->Model_Db->update(8,$in,"id",$doc_id);
        
        
        
        
                      if($res!=false){
                      $imk[0]['isactive']=0;
                      $dt_nm=$this->Model_Db->update(12,$imk,"id",$id);//Here to start--------------------------
        
        
                      $where="isactive=1 and id=$doc_id";
                      $file_data=$this->Model_Db->select(8,null,$where);
        
                      if($this->session->userdata('item'))
                      {
                        $this->session->unset_userdata('item');
                      }
                      $dt['file_data']=$file_data[0];
                    $this->session->set_userdata('item',$dt);
        
                        $old_data=$doc_dt;
                        $new_data=$in[0];
                      
                    
                          $im[0]['entryby']=$this->session->dflogin_staff['entryby'];
                          $im[0]['entryat']=date("Y-m-d H:i:s");
                          $im[0]['previousvalue']=json_encode($old_data);
                          $im[0]['newvalue']=json_encode($new_data);
                          $im[0]['documentid']=$doc_id;
        
                          $res2=$this->Model_Db->insert(13,$im);
        
                          if ($res2) 
                          {
                              $data['title']="Alert!!";
                              $data['message']="Document Details updated successfully.";
                              $data['status']=true;

                          }else{
                            $data['title']="Alert!!";
                            $data['message']="Document edit table error";
                            $data['status']=false;
                          } 
                  } else {
                            $data['title']="Alert!!";
                            $data['message']="Document Insert  error";
                            $data['status']=false;
                  }
                  
        
        
                  }else {
                    $data['title']="Alert!!";
                    $data['message']="Document Version ID  error";
                    $data['status']=false;
                  }


          } else {
            
            $data['title']="Alert!!";
            $data['message']="Document Version insert  error";
            $data['status']=false;


          }
       echo json_encode($data);

      }else{
          redirect('Welcome/');
        }
      } catch (Exception $e) {
        echo "Message:" . $e->getMessage();
      }
      
    }

}




?>