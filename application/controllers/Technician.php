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
            $data['ship_id'] = $this->session->userdata('ship_id');

            if ($status == "technician" || $status == "co" || $status == "hod" || $status == "weo" || $status == "manager" ||  $status == "typecdr" ) {
                $data['technician_controller_data'] = $this->db->where('Ship_ID',$data['ship_id'])->get('controller_data')->result_array();
                $data['ships_data'] = $this->db->where('ID',$data['ship_id'])->get('ship_data')->result_array();
                $this->load->view('technician/technician', $data);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function technician_data_listing()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            // $data['ship_id'] = $this->session->userdata('ship_id');
            if ($status == "technician") {
                $data['technician_controller_data'] = $this->db->get('controller_data')->result_array();
                $data['ships_data'] = $this->db->get('ship_data')->result_array();
                $this->load->view('technician/technician', $data);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    function dateDiffInDays($date1, $date2)
    {
        // Calculating the difference in timestamps
        $diff = strtotime($date2) - strtotime($date1);
        return abs(round($diff / 86400));
    }

    public function get_TBF()
    {
        $start_data = $_POST['start_data'];
        $sensor_id = $_POST['sensor_id'];
        $end_data = $this->db->select('*')->where('Controller_Data_ID', $sensor_id)->order_by('id', 'desc')->limit(1)->get('controller_data_detail')->row_array();
        $cont_data = $this->db->select('*')->where('ID', $sensor_id)->order_by('id', 'desc')->limit(1)->get('controller_data')->row_array();
        
        if ($end_data['Failure_end_date'] != null && $end_data['Failure_end_date'] != 0) {
            $TBF = $end_data['Failure_end_date'];
        } else {
            $TBF = $cont_data['Comission_date'];
        }
        
        $dateDiff = $this->dateDiffInDays($TBF, $start_data);
        
        echo json_encode($dateDiff);
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
            $ship_id = $postData['Ship_ID'];
            $comission_date = $postData['Comission_date'];
            $Total_Equipped = $postData['Total_Equipped'];

            $insert_array = array(
                'controller_type' => $controller_type,
                'ESWB' => $eswb,
                'controller_name' => $name,
                'includes' => $included,
                'Not_Includes' => $notIncluded,
                'Associated_Equipment' => $AssociatedEquipment,
                'Ship_ID' => $ship_id,
                'Comission_date' => $comission_date,
                'Total_Equipped' => $Total_Equipped
            );
            // 	// print_r($insert_array);exit;
            $insert = $this->db->insert('controller_data', $insert_array);

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
