 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Manager extends CI_Controller
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
            if ($status == "manager") {
              $data['manager_controller_data'] = $this->db->get('controller_data')->result_array();
                $this->load->view('manager/manager', $data);
                }else{
                    $this->load->view('login');
                }
    }
    else
        { 
            $this->load->view('login');
        }
}

public function manager_data_listing(){
if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "manager") {
              $data['manager_controller_data'] = $this->db->get('controller_data')->result_array();
              $this->load->view('manager/manager', $data);
            }
            else{
                $this->load->view('login');
            }
    }
    else{
     $this->load->view('login');
    }
}

 public function Update_data($id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());
            $TBF = $postData['TBF'];
            $TCM = $postData['TCM'];
            $TPM = $postData['TPM'];
            $ADLT = $postData['ADLT'];
            $TTR = $postData['TTR'];
            $TCM_Desc = $postData['TCM_Desc'];
            $TPM_Desc = $postData['TPM_Desc'];
            $ADLT_Desc = $postData['ADLT_Desc'];


            $cond  = ['id' => $id];
            $data_update = [
                'TBF' => $TBF,
                'TCM' => $TCM,
                'TPM' => $TPM,
                'ADLT' => $ADLT,
                'TTR' => $TTR,
                'TCM_Desc' => $TCM_Desc,
                'TPM_Desc' => $TPM_Desc,
                'ADLT_Desc' => $ADLT_Desc

            ];
            $this->db->where($cond);
            $this->db->update('controller_data', $data_update);
            $this->session->set_flashdata('success', 'Data Updated successfully');
            redirect('Manager');
        }
    }

    public function Get_Values($id = NULL)
    {
        
        $data['manager_controller_data'] = $this->db->get('controller_data')->result_array();
        $data['selected_controller_data'] = $this->db->where('id', $id)->get('controller_data')->row_array();
        $this->load->view('manager/manager', $data);
        //redirect('User_Login');
    }
}