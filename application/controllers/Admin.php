<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
     $this->load->view('create_user');
    }
    public function add_user(){
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $username = $postData['username'];
            $password = password_hash($postData['password'], PASSWORD_DEFAULT);
            //$reg_data = date('Y-M-D');
            $status = $postData['status'];
        

            $insert_array = array(
                'username' => $username,
                'password' => $password,
                //'reg_data' => $reg_data,
                'status' => $status,
                
               
            );
             //print_r($insert_array);exit;
            $insert = $this->db->insert('security_info', $insert_array);
            //$data['last_id'] = $this->db->insert_id();
            //  echo $data['last_id'];exit;
            //  print_r($insert);exit;

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('Admin');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                redirect('Admin');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Admin');
        }
    }
}
