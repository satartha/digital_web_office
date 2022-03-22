<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		if (isset($this->session->dflogin)) {
			redirect('Dashboard/');
		}elseif (isset($this->session->dflogin_staff)) {
			redirect('Staff_dashboard/');
		}elseif (isset($this->session->dflogin_admin)) {
			redirect('Admin/');
		}else{
			$this->load->view('login/landing_page');
		}
	}
	public function c_login()
	{

		if (isset($this->session->dflogin)) {
			redirect('Dashboard/');
		}elseif (isset($this->session->dflogin_staff)) {
			redirect('Staff_dashboard/');
		}elseif (isset($this->session->dflogin_admin)) {
			redirect('Admin/');
		}else{
			$this->load->view('login/company_login');
			$this->load->view('login/login_script');
		}
	}
	
	public function user()
	{

		if (isset($this->session->dflogin_staff)) {
			redirect('Staff_dashboard/');
		}elseif (isset($this->session->dflogin)) {
			redirect('Dashboard/');
		}elseif (isset($this->session->dflogin_admin)) {
			redirect('Admin/');
		}else{
			$this->load->view('login/staff_login');
		$this->load->view('login/tllogin_script');
		}
	}

	public function admin()
	{

		if (isset($this->session->dflogin_admin)) {
			redirect('Admin/');
		}elseif (isset($this->session->dflogin_staff)) {
			redirect('Staff_dashboard/');
		}elseif (isset($this->session->dflogin)) {
			redirect('Dashboard/');
		}else{
			$this->load->view('login/admin_login');
		$this->load->view('login/adminlogin_script');
		}

		
	}


	public function dashboard()
	{
		// $this->load->view('include/header');
		// $this->load->view('include/topbar');
		// $this->load->view('include/menubar');
		$this->load->view('dashboard/frmDashboard');
     //	this->load->view('include/footer');
	}
	public function mdashboard()
	{
		$this->load->view('dashboard/mobiledashboard');
//		$this->load->view('include/footer');
	}
	public function data_table()
    {
        try {
            if ($this->session->dflogin['userid']) {
                $this->load->view('include/header');
                $this->load->view('include/topbar');
                $this->load->view('include/menubar');
                $this->load->view('masterforms/data_table');
                $this->load->view('include/footer');
                // $this->load->view('masterforms/gp/gp_script');
            } else {
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
	public function doc()
	{
		$this->load->view('include/header');
		$this->load->view('include/topbar');
		$this->load->view('masterforms/doc_details');
		$this->load->view('include/footer');
//		$this->load->view('include/footer');
	}


}
