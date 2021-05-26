
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
            if ($status == "manager" || $status == "co" || $status == "hod" || $status == "weo") {

                $this->db->select('cd.*,sd.Ship_name');
                $this->db->from('controller_data cd');
                $this->db->join('ship_data sd', 'sd.ID = cd.ship_ID');
                $data['manager_controller_data'] = $this->db->get()->result_array();
                 
                $this->load->view('manager/manager', $data);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function manager_data_listing()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "manager") {
                $data['manager_controller_data'] = $this->db->get('controller_data')->result_array();
                $this->load->view('manager/manager', $data);
            } else {
                $this->load->view('login');
            }
        } else {
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
            $FSD = strtotime($postData['Failure_start_date']);
            $FED = strtotime($postData['Failure_end_date']);

            $cond  = ['id' => $id];
            $data_update = [
                'TBF' => $TBF,
                'TCM' => $TCM,
                'TPM' => $TPM,
                'ADLT' => $ADLT,
                'TTR' => $TTR,
                'TCM_Desc' => $TCM_Desc,
                'TPM_Desc' => $TPM_Desc,
                'ADLT_Desc' => $ADLT_Desc,
                'Failure_start_date' => date($FSD, 'yyyy-mm-dd'),
                'Failure_end_date' => date($FED, 'yyyy-mm-dd')

            ];
            $this->db->where($cond);
            $this->db->update('controller_data_detail', $data_update);
            $this->session->set_flashdata('success', 'Data Updated successfully');
            redirect('Manager');
        }
    }

    public function Calculate_Mean($id = NULL)
    {
        $this->db->select('count(*) count');
        $this->db->from('controller_data_detail');
        $this->db->where('Controller_Data_ID', $id);
        $query1 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $count = $query1->row()->count;
        }

        $this->db->select('sum(TBF) STBF, sum(TTR) STTR');
        $this->db->from('controller_data_detail');
        $this->db->where('Controller_Data_ID', $id);
        $query2 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $STBF = $query2->row()->STBF;
            $STTR = $query2->row()->STTR;
        }

        $MTBF = $STBF / $count;
        $MTTR = $STTR / $count;

        $cond  = ['ID' => $id];
        $data_update = [
            'MTBF' => $MTBF,
            'MTTR' => $MTTR
        ];
        $this->db->where($cond);
        $this->db->update('controller_data', $data_update);
    }


    public function add_data($id = NULL)
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
            $FSD = $postData['failure_start_date'];
            $FED = $postData['failure_end_date'];

            $insert_array = array(
                'Controller_Data_ID' => $id,
                'TBF' => $TBF,
                'TCM' => $TCM,
                'TPM' => $TPM,
                'ADLT' => $ADLT,
                'TTR' => $TTR,
                'TCM_Desc' => $TCM_Desc,
                'TPM_Desc' => $TPM_Desc,
                'ADLT_Desc' => $ADLT_Desc,
                'Failure_start_date' => $FSD,
                'Failure_end_date' => $FED 
            );

            $insert = $this->db->insert('controller_data_detail', $insert_array);

            if (!empty($insert)) {
                $this->Calculate_Mean($id);
                $this->session->set_flashdata('success', 'Data inserted successfully');
                redirect('Manager');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Manager');
        }
    }



    public function Get_Values($id = NULL)
    {

        $data['manager_controller_data'] = $this->db->get('controller_data')->result_array();
        $data['selected_controller_data'] = $this->db->where('id', $id)->get('controller_data')->row_array();

        $this->db->select('cd.Controller_Name, cd.ESWB,cdd.*');
        $this->db->from('controller_data cd');
        $this->db->join('controller_data_detail cdd', 'cd.id = cdd.Controller_Data_ID');
        $this->db->where('cdd.Controller_Data_ID', $id);
        $data['controller_detail_records'] = $this->db->get()->result_array();
        $this->load->view('manager/manager', $data);
    }

    public function add_details($id = NULL)
    {
        $data['selected_controller_data'] = $this->db->where('id', $id)->get('controller_data')->row_array();
        $this->load->view('manager/add_details', $data);
    }

    public function show_records($id = NULL)
    {
        // $data['controller_detail_records'] = $this->db->where('Controller_Data_ID',$id)->get('controller_data_detail')->result_array();
        $this->db->select('cd.Controller_Name, cd.ESWB,cdd.*');
        $this->db->from('controller_data cd');
        $this->db->join('controller_data_detail cdd', 'cd.id = cdd.Controller_Data_ID');
        $this->db->where('cdd.Controller_Data_ID', $id);
        $data['controller_detail_records'] = $this->db->get()->result_array();
        $this->load->view('manager/data_records', $data);
    }
}
