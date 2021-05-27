<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class HOD extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['ship_id'] = $this->session->userdata('ship_id');
        $data['sensor_data'] = $this->db->where('Controller_type', 'Sensor')->where('Ship_ID',$data['ship_id'])->get('controller_data')->result_array();
        $data['fire_controller_data'] = $this->db->where('Controller_type', 'Fire Controller')->where('Ship_ID',$data['ship_id'])->get('controller_data')->result_array();
        $data['weapon_data'] = $this->db->where('Controller_type', 'Weapon')->where('Ship_ID',$data['ship_id'])->get('controller_data')->result_array();
        $this->load->view('hod/hod', $data);
    }

    public function get_availability_for_all()
    {
        $view_array = array();
        $view_array['data'] =  $this->db->get('controller_data')->result_array();
        $ship_id = $this->session->userdata('ship_id');
        if (count($view_array['data']) != 0) {
            for ($i = 0; $i < count($view_array['data']); $i++) :
                $this->get_availability($view_array['data'][$i]['ID'], $ship_id);
            endfor;
        }

    }

    public function get_availability($sensor_id = NULL, $ship_id)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');

            if ($status == "hod" || $status == "weo" || $status == "co") {
                $controller_id = $sensor_id; //$_POST['controller_id'];
                $view_array = array();
                $view_array['data'] =  $this->db->where('ID', $controller_id)->where('Ship_ID', $ship_id)->get('controller_data')->row_array();
                if ($view_array['data']['MTBF'] != '' && $view_array['data']['MTTR'] != '' && $view_array['data']['MTBF'] != 0.00 && $view_array['data']['MTTR'] != 0.00) {
                    $availability = number_format($view_array['data']['MTBF'] / ($view_array['data']['MTBF'] + $view_array['data']['MTTR']), 4);
                    //$aval =$availability * 100;
                    //print_r($aval);
                    echo ($availability * 100);
                } else {
                    $availability = 0;
                    echo ($availability * 100);
                }
                $cond  = ['ID' => $controller_id, 'Ship_ID' => $ship_id];
                $data_update = [
                    'Availability' => $availability * 100                    
                ];
                $this->db->where($cond);
                $this->db->update('controller_data', $data_update);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function get_reliability_for_all()
    {
        $ship_id = $this->session->userdata('ship_id');
        $isDefault = $_POST['isDefault'];
        $system_time = 0;
        if ($isDefault == "Yes") {
            $system_time = 30;
        } else if ($isDefault == "No") {
            $system_time = $_POST['time'];
        }

        $view_array['data'] =  $this->db->where('Ship_ID',$ship_id)->get('controller_data')->result_array();
        if (count($view_array['data']) != 0) {
            for ($i = 0; $i < count($view_array['data']); $i++) :
                $this->get_reliability($view_array['data'][$i]['ID'], $system_time, $isDefault, $ship_id);
            endfor;
        }

        $sensor_rel = array();
        $sensor_rel['data'] = $this->db->select('Controller_Name, Controller_type, Default_Reliability, Reliability, Availability')->distinct()->where('Ship_ID',$ship_id)->get('controller_data')->result_array();

        echo json_encode($sensor_rel['data']);
    }

    public function get_reliability($sensor_id = NULL, $entered_time = NULL, $isDefault = NULL, $ship_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');

            if ($status == "hod" || $status == "weo" || $status == "co") {
                $controller_id = $sensor_id; //$_POST['controller_id'];
                $time = $entered_time; //$_POST['time'];
                if ($time > 0) {
                    $view_array = array();
                    $view_array_detail = array();
                    $view_array['data'] =  $this->db->where('ID', $controller_id)->where('Ship_ID', $ship_id)->get('controller_data')->row_array();

                    //Get Total No. of Failures 
                    $view_array_detail['data'] =  $this->db->where('Controller_Data_ID', $controller_id)->get('controller_data_detail')->result_array();
                    $Total_failure_count = count($view_array_detail['data']);

                    //Total Time 
                    $current_date = date("Y-m-d");
                    $comission_date = $view_array['data']['Comission_date'];
                    $diff = abs(strtotime($comission_date) - strtotime($current_date));
                    $days = floor($diff/60/60/24);

                    //Total_Equipped
                    $Total_Equiped = $view_array['data']['Total_Equipped'];

                    if ($view_array['data']['MTBF'] != '' && $view_array['data']['MTBF'] != 0.00) {
                        $power = ($Total_failure_count / ($days * $Total_Equiped)) * $time;
                        $power = -1 * $power;
                        $reliability = number_format(pow(2.718, $power), 4);
                        $rel = $reliability * 100;
                        //echo $rel;
                        //echo "dsfsd";
                    } else {
                        $reliability = 0;
                        //echo ($reliability * 100);
                    }
                } else {
                    $reliability = 0;
                    //echo ($reliability * 100);
                }
                $cond  = ['ID' => $controller_id, 'Ship_ID' => $ship_id];
                $data_update = [
                    'Reliability' => $reliability * 100,
                ];

                if ($isDefault == "Yes") {
                    $data_update = [
                        'Default_Reliability' => $reliability * 100
                    ];
                } else if ($isDefault == "No") {
                    $data_update = [
                        'Reliability' => $reliability * 100
                    ];
                }

                $this->db->where($cond);
                $this->db->update('controller_data', $data_update);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    //  public function Update_data($id = NULL)
    //     {
    //         if ($this->input->post()) {
    //             $postData = $this->security->xss_clean($this->input->post());
    //             $TBF = $postData['TBF'];
    //             $TCM = $postData['TCM'];
    //             $TPM = $postData['TPM'];
    //             $ADLT = $postData['ADLT'];
    //             $TTR = $postData['TTR'];
    //             $TCM_Desc = $postData['TCM_Desc'];
    //             $TPM_Desc = $postData['TPM_Desc'];
    //             $ADLT_Desc = $postData['ADLT_Desc'];


    //             $cond  = ['id' => $id];
    //             $data_update = [
    //                 'TBF' => $TBF,
    //                 'TCM' => $TCM,
    //                 'TPM' => $TPM,
    //                 'ADLT' => $ADLT,
    //                 'TTR' => $TTR,
    //                 'TCM_Desc' => $TCM_Desc,
    //                 'TPM_Desc' => $TPM_Desc,
    //                 'ADLT_Desc' => $ADLT_Desc

    //             ];
    //             $this->db->where($cond);
    //             $this->db->update('controller_data', $data_update);
    //             $this->session->set_flashdata('success', 'Data Updated successfully');
    //             redirect('Manager');
    //         }
    //     }

    // public function Get_Values($id = NULL)
    // {

    //     $data['manager_controller_data'] = $this->db->get('controller_data')->result_array();
    //     $data['selected_controller_data'] = $this->db->where('id', $id)->get('controller_data')->row_array();
    //     $this->load->view('manager/manager', $data);
    //     //redirect('User_Login');
    // }
}
