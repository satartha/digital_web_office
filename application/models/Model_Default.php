<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Model_Default extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }
    public function gender(){
        try{
            $data=array(
                1 => 'Male',
                2 => 'Female',
                3 => 'Other'
            );
            return $data;
        }catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
    public function caste(){
        try{
            $data=array(
                1 => 'General',
                2 => 'OBC',
                3 => 'SC',
                4 => 'ST'
            );
            return $data;
        }catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
    public function religion(){
        try{
            $data=array(
                1 => 'Hindu',
                2 => 'Muslim',
                3 => 'Christian',
                4 => 'Sikh',
                5 => 'Buddhist',
                6 => 'Jain',
                7 => 'Parsi'
            );
            return $data;
        }catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
	public function pooling_year(){
		try{
			$data=array(
				1 => '2009',
				2 => '2014',
				3 => '2019'
			);
			return $data;
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}
	public function candidate_type(){
		try{
			$data=array(
				1 => 'MP',
				2 => 'MLA'
			);
			return $data;
		}catch (Exception $e) {
			echo "Message:" . $e->getMessage();
		}
	}
}
