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
			} elseif ($status == "toplevel") {
				redirect('WEO');
			}
		} else {
			$this->load->view('login');
		}
	}

	public function login_process()
	{
		if ($this->input->post()) {
			$postedData = $this->security->xss_clean($this->input->post());
			//To create encrypted password use
			$username = $postedData['username'];
			$password = $postedData['password'];
			$status = $postedData['optradio'];
			//echo $status;exit;
			// $p = password_hash($postedData['password'], PASSWORD_BCRYPT);
			$query = $this->db->where('username', $username)->where('password', $password)->where('status', $status)->get('security_info')->row_array();
			//print_r($query['user_id']);exit;
			//echo $p; exit;
			if (!empty($query)) {
				$this->session->set_userdata('user_id', $query['id']);
				$this->session->set_userdata('status', $query['status']);
				$this->session->set_userdata('username', $query['username']);
				$this->session->set_flashdata('success', 'Login successfully');
				redirect('User_Login');
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
