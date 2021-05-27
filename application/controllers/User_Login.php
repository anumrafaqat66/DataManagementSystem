<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	
	}

	public function index()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$status = $this->session->userdata('status');
			
			if ($status == "technician") {
				redirect('Technician');
			} elseif ($status == "manager") {
				redirect('Manager');
			} elseif ($status == "hod") {
				redirect('HOD');
			} elseif ($status == "weo") {
				redirect('WEO?we=Select Weapon');
			}elseif ($status == "co") {
				redirect('CO');
			}elseif ($status == "typecdr") {
				redirect('Cdr');
			}
		} else {
			$this->load->view('login');
		}
	}
	public function dashboard(){
     $this->load->view('dashboard');
	}

	public function login_process()
	{
		if ($this->input->post()) {
			$postedData = $this->security->xss_clean($this->input->post());
			//To create encrypted password use
			$username = $postedData['username'];
			$password = $postedData['password'];
			$status = $postedData['optradio'];
			$query = $this->db->where('username', $username)->where('status', $status)->get('security_info')->row_array();
			$hash= $query['password'];

				if (!empty($query)) {
					if(password_verify($password, $hash)){
					$this->session->set_userdata('user_id', $query['id']);
					$this->session->set_userdata('status', $query['status']);
					$this->session->set_userdata('username', $query['username']);
					$this->session->set_flashdata('success', 'Login successfully');
					redirect('User_Login');
				 }else{
					$this->session->set_flashdata('failure', 'No such user exist. Kindly create New User using Admin panel');
					redirect('User_Login');
				 }
				//print_r($query); exit; 
			} else {
				$this->session->set_flashdata('failure', 'Login failed');
				redirect('User_Login');
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('User_Login');
	}

	// public function technician_data_listing()
	// {
		
	// }

}
