<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
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
                redirect('User_Login');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('User_Login');
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
            redirect('User_Login');
        }
    }
}
