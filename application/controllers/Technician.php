<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Technician extends CI_Controller
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
          	 $data['technician_controller_data'] = $this->db->get('controller_data')->result_array();
		   	 $this->load->view('technician/technician', $data);
	       }else{
		      $this->load->view('login');
	           }
    }else{
     $this->load->view('login');
    }
}

    public function technician_data_listing(){
        if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$status = $this->session->userdata('status');
			if ($status == "technician") {
				 $data['technician_controller_data'] = $this->db->get('controller_data')->result_array();
		        $this->load->view('technician/technician', $data);
        	}else{
        		$this->load->view('login');
        	}
    }else{
        $this->load->view('login');
    }
}

     public function add_data_into_db()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $controller_type = $postData['controller_type'];
            $eswb = $postData['eswb'];
            $name = $postData['name'];
            $included = $postData['included'];
            $notIncluded = $postData['notIncluded'];
            $AssociatedEquipment = $postData['AssociatedEquipment'];

            $insert_array = array(
                'controller_type' => $controller_type,
                'ESWB' => $eswb,
                'controller_name' => $name,
                'includes' => $included,
                'Not_Includes' => $notIncluded,
                'Associated_Equipment' => $AssociatedEquipment,
            );
            // 	// print_r($insert_array);exit;
            $insert = $this->db->insert('controller_data', $insert_array);
            //$data['last_id'] = $this->db->insert_id();
            //	echo $data['last_id'];exit;
            // 	print_r($insert);exit;

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('Technician');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Technician');
        }
    }

}