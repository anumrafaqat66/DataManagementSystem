
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
            $data['ship_id'] = $this->session->userdata('ship_id');

            if ($status == "manager" || $status == "co" || $status == "hod" || $status == "weo" || $status == "typecdr") {
                $this->db->select('cd.*,sd.Ship_name');
                $this->db->from('controller_data cd');
                $this->db->join('ship_data sd', 'sd.ID = cd.ship_ID');
                $this->db->where('Ship_ID',$data['ship_id']);
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
            $data['ship_id'] = $this->session->userdata('ship_id');
            if ($status == "manager") {
                $data['manager_controller_data'] = $this->db->where('Ship_ID',$data['ship_id'])->get('controller_data')->result_array();
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
        $ship_id = $this->session->userdata('ship_id');
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

            if ($FED == '' || $FED == null) {
                $status = 'In Progress';
            } else {
                $status = 'Completed';
            }

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
                'Failure_start_date' => $FSD,
                'Failure_end_date' => $FED,
                'Status' => $status

            ];
            $this->db->where($cond);
            $this->db->update('controller_data_detail', $data_update);
            $this->Calculate_Mean($id, $ship_id);
            $this->session->set_flashdata('success', 'Data Updated successfully');
            redirect('Manager');
        }
    }

    public function Calculate_Mean($id = NULL, $ship_id = NULL)
    {
        $cont_data = $this->db->select('*')->where('id', $id)->limit(1)->get('controller_data_detail')->row_array();
        
        $this->db->select('count(*) as count');
        $this->db->from('controller_data cd');
        $this->db->join('controller_data_detail cdd', 'cd.id = cdd.Controller_Data_ID');  
        $this->db->where('cdd.Controller_Data_ID', $cont_data['Controller_Data_ID']);
        $this->db->where('cd.Ship_ID', $ship_id);

        $query1 = $this->db->get();

        if ($query1->num_rows() > 0) {
            $count = $query1->row()->count;
        }

        $this->db->select('sum(TBF) STBF, sum(TTR) STTR');
        $this->db->from('controller_data cd');
        $this->db->join('controller_data_detail cdd', 'cd.id = cdd.Controller_Data_ID');  
        $this->db->where('cdd.Controller_Data_ID', $cont_data['Controller_Data_ID']);
        $this->db->where('cd.Ship_ID', $ship_id);

        $query2 = $this->db->get();

        if ($query1->num_rows() > 0) {
            $STBF = $query2->row()->STBF;
            $STTR = $query2->row()->STTR;
        }
        echo $count; echo 'count';         
        $MTBF = $STBF / $count;
        $MTTR = $STTR / $count;

        $cond  = ['ID' => $cont_data['Controller_Data_ID']];
        $data_update = [
            'MTBF' => $MTBF,
            'MTTR' => $MTTR
        ];
        $this->db->where($cond);
        $this->db->update('controller_data', $data_update);
    }


    public function add_data($id = NULL)
    {
        $ship_id = $this->session->userdata('ship_id');
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

            if ($FED == '' || $FED == null) {
                $status = 'In Progress';
            } else {
                $status = 'Completed';
            }

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
                'Failure_end_date' => $FED,
                'Status' => $status
            );

            $insert = $this->db->insert('controller_data_detail', $insert_array);

            if (!empty($insert)) {
                $this->Calculate_Mean($id, $ship_id);
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
        $data['update'] = 'No';
        $this->load->view('manager/add_details', $data);
    }

    public function update_details($id = NULL)
    {
        $this->db->select('cdd.id as ID, cd.Controller_Name, cd.ESWB, cd.Controller_type, cdd.Failure_start_date, cdd.Failure_end_date, cdd.TBF, cdd.TCM, cdd.TPM, cdd.ADLT, cdd.TTR, cdd.TCM_Desc, cdd.TPM_Desc, cdd.ADLT_Desc, cdd.TTR');
        $this->db->from('controller_data cd');
        $this->db->join('controller_data_detail cdd', 'cd.id = cdd.Controller_Data_ID');
        $this->db->where('cdd.id', $id);
        $data['selected_controller_data'] = $this->db->get()->row_array();
        $data['update'] = 'Yes';
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
