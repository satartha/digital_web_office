<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DmsCron extends CI_Controller {


    public function Doc_exp_cron(){
         
        try{

            

            $data = array();
            $status = true;
            $current_time=time();
            $updays= date('Y-m-d',strtotime('+15 days',$current_time));
            echo $updays;
            
            $where="isactive=1 and expirydate='".$updays."'";
            $orderby="id asc";
            $res = $this->Model_Db->select(8, null, $where, $orderby);

            if ($res) 
            {
                  
                foreach ($res as $key => $value) 
                {
                    if ($value->owner && $value->owner!=null) 
                    {
                        $dtl=$this->getDtl_frm_id($value->owner);
                         
                        if ($dtl!=false) 
                        {
                            $companyname=$dtl[0]->companyname;
                            $email=$dtl[0]->companyemail;
                            $document_name=$value->documentname;
                            $letterno=$value->letterno;
                            $expirydate=$value->expirydate;
                            $version=$value->version;
    
    
                            $message="<div>
                            Hii $companyname<br>
                            Your Document is About to Expiry in 15days<br>
                            Please Provide Attention<br>
                            
                            <table>
                                    <tr>
                                    <td>Document Name</td>
                                    <td>$document_name</td>
                                    </tr>
                                    <tr>
                                    <td>Expiry Date</td>
                                    <td>$expirydate</td>
                                    </tr>
                                    <tr>
                                    <td>Letter No</td>
                                    <td>$letterno</td>
                                    </tr>
                                    <tr>
                                    <td>Version</td>
                                    <td>$version</td>
                                    </tr>
    
                            <table>
    
                            <br>
                            <br>
                            <b>Thanks and Regards</b><br>
                            Digital Web Office
                            
                            </div>";
                            $subject="Document Expiry Mail";
    
                            if ($this->exp_cron_mail($email,$message,$subject)) {
                                $data['data']="expiry email is sent";
                                $data['message']="expiry email is sent";
                                $data['statue']=true;
                                $data['emailsent'][]=$value->id;
                            }else{
                                $data['data']="expiry email cannot be sent";
                                $data['message']="expiry email cannot be sent";
                                $data['statue']=false;
                                $data['no_emailsent'][]=$value->id;
    
                            }
                        } else {
                                $data['data']="Owner Details not Found";
                                $data['message']="Owner Details not Found";
                                $data['statue']=false; 
                        }
                        
                        
               
                    }
                    
                }

            }else{
                $data['data']="No Record Found";
                $data['message']="No Record Found";
                $data['status']=false;
            }

            echo "<pre>";
            echo json_encode($data);
          
			
		}catch (Exception $e) {
			$data['message'] = "Message:" . $e->getMessage();
            $data['status'] = false;
            echo json_encode($data);
            exit();
		}

    }

    public function exp_cron_mail($email,$message,$subject)
{
	
	$this->load->library('email');
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.atreyaassociates.com',
					'smtp_port' => 465,
					'smtp_user' => 'testing@atreyaassociates.com',
					'smtp_pass' => 'pCbNEqq0yE~[',
					'smtp_crypto' => 'ssl',
					'mailtype' => 'html',
					// 'smtp_timeout' => '4',
					'charset' => 'utf-8',
					'wordwrap' => TRUE
				);
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('testing@atreyaassociates.com', 'Digital Web Office');
				$this->email->to($email);
				$this->email->subject($subject);
				
				// $message = "Dear  Your One Time Password for Reseting Password is";
				$this->email->message($message);
	
	 if($this->email->send())
	 { 
		 return true;
	 }else {
	 return false; 
	 }		
		
}


    public function getDtl_frm_id($id){
         
        try{
           
            $status = true;
             
        if (!is_numeric($id) || $id<=0) 
        {
          $status=false;   
        }


        if ($status) 
        {
            $where="isactive=1 and id=$id";
            
            $res = $this->Model_Db->select(1, null, $where);

            if ($res) 
            {
                return $res;
            }else{
               return false;
            }
        } else {
            return false;
        }

			
		}catch (Exception $e) {
			$data['message'] = "Message:" . $e->getMessage();
            $data['status'] = false;
            echo json_encode($data);
            exit();
		}

    }

    


    // public function pmcall_cron()
    // {
    //     try {
    //         $request = json_decode(json_encode($_POST), FALSE);
    //         $data = array();
    //         $status = true;
    //         $where1 = "isactive=true";
    //         //$where2 = "isactive=true OR isactive=false";
    //         $orderby = "id desc";
    //         $res4 = $this->Model_Db->select(26, null, $where1, $orderby);
    //         $res = $this->Model_Db->select(25, null, $where1, $orderby);
    //         $res1 = $this->Model_Db->select(24, null, $where1, $orderby);
    //         $res2 = $this->Model_Db->select(5, null, $where1, $orderby);

    //         if ($res4 != false) {
    //             $i = 0;
    //             $data['status'] = true;
    //             foreach ($res4 as $r4) {
    //                 $data['data'][] = array(
    //                     'pm_date' => $r4->pmdate,
    //                     'isscheduled' => $r4->isscheduled,
    //                     'isactive' => $r4->isactive,
    //                     'pmid' => $r4->id
    //                 );
    //                 foreach ($res as $r) {
    //                     if ($r4->amcid == $r->id) {
    //                         $data['data'][$i]['amcid'] = $r->id;
    //                     }
    //                 }
    //                 foreach ($res1 as $r1) {
    //                     if ($r1->id == $r->crid) {
    //                         $data['data'][$i]['customerid'] = $r1->customerid;
    //                         $data['data'][$i]['itemid'] = $r1->itemid;
    //                     }
    //                 }
    //                 foreach ($res2 as $r2) {
    //                     if ($r1->itemid == $r2->id) {
    //                         $data['data'][$i]['itemname'] = $r2->itemname;
    //                     }
    //                 }
    //                 $today1 = date('Y-m-d H:i:s');
    //                 $today = strtotime($today1);
    //                 $pmdate1 = $r4->pmdate;
    //                 $pmdate = strtotime($pmdate1);
    //                 if ($today <= $pmdate) {
    //                     $complaintnumber = $this->get_complain_number();
    //                     $insert1[0]['customerid'] = $r1->customerid;
    //                     $insert1[0]['complaintnumber'] = $complaintnumber;
    //                     $itemname = $r2->itemname;
    //                     $insert1[0]['categoryid'] = 2;
    //                     $insert1[0]['complainttext'] = "This is PM call For " . $itemname;
    //                     $insert1[0]['itemid'] = $r1->itemid;
    //                     $insert1[0]['flagid'] = 1;
    //                     $insert1[0]['entryby'] = $r1->customerid;
    //                     $insert1[0]['entryat'] = date("Y-m-d H:i:s");
    //                     $insert1[0]['flagid'] = 1;
    //                     $insert2[0]['isactive'] = 0;
    //                     $insert2[0]['isscheduled'] = 1;
    //                     $this->db->trans_start();
    //                     $res = $this->Model_Db->insert(11, $insert1);
    //                     $res1 = $this->Model_Db->update(26, $insert2, "id", $r4->id);
    //                     $this->db->trans_complete();
    //                     $this->db->trans_commit();
    //                 }
    //                 $i++;
    //             }
    //         } else {
    //             $data['status'] = false;
    //             $data['message'] = "No data found.";
    //             $data['data'] = "Requested data not found.";
    //         }
    //         // echo json_encode($data);
    //         // exit();
    //     } catch (Exception $e) {
    //         $data['message'] = "Message:" . $e->getMessage();
    //         $data['status'] = false;
    //         echo json_encode($data);
    //         exit();
    //     }
    // }








}
?>