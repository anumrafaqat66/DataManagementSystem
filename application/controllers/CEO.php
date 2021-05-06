 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CEO extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['controller_data'] = $this->db->where('Controller_type', 'Weapon')->get('controller_data')->result_array();
        $this->load->view('ceo/ceo', $data);
    }

    public function get_system_availability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "weo") {
                $weapon_name = $_POST['weapon_name'];
                $view_array = array();
                $view_rows = array();

                $this->db->select('wsc.connection_group');
                $this->db->distinct();
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('wsc.connection_type', 'P'); //For parallel

                $view_rows['data'] =  $this->db->get()->result_array();
                $sub_final_result = 1;
                if (count($view_rows['data']) != 0) {
                    for ($i = 1; $i <= count($view_rows['data']); $i++) :
                        $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Availability');
                        $this->db->from('weapon_systems ws');
                        $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                        $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                        $this->db->where('ws.weapon_name', $weapon_name);
                        $this->db->where('wsc.connection_type', 'P'); //For parallel
                        $this->db->where('wsc.connection_group', $i); //For group

                        $view_array['data'] =  $this->db->get()->result_array();
                        $resultant_parallel = 1;
                        $data_index = 0;
                        if (count($view_array['data']) != 0) {
                            foreach ($view_array['data'] as $row) {
                                $resultant_parallel = $resultant_parallel * (1 - ($view_array['data'][$data_index]['Availability']) / 100);
                                $data_index++;
                            }
                            $resultant_parallel =   1 - $resultant_parallel;
                        } else {
                            $resultant_parallel = 0;
                            return $resultant_parallel;
                        }

                        $sub_final_result = $sub_final_result * $resultant_parallel;

                    endfor;
                }

                $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Availability');
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('wsc.connection_type', 'S'); //For series

                $view_array['data'] =  $this->db->get()->result_array();
                $resultant_series = 1;
                $data_index = 0;
                if (count($view_array['data']) != 0) {
                    foreach ($view_array['data'] as $row) {
                        $resultant_series = $resultant_series * (($view_array['data'][$data_index]['Availability']) / 100);
                        $data_index++;
                    }
                } else {
                    $resultant_series = 0;
                    return $resultant_series;
                }

                $final_result = $sub_final_result * $resultant_series;
                echo number_format(($final_result * 100), 2);

                //Updation 
                
                 $cond  = ['weapon_name' => $weapon_name];
                 $data_update = [
                'Availability' => number_format(($final_result * 100), 2),
            ];

            $this->db->where($cond);
            $this->db->update('weapon_systems', $data_update);

            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function get_system_reliability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "weo") {
                $weapon_name = $_POST['weapon_name'];
                //echo $weapon_name;exit;
                $view_array = array();
                $view_rows = array();

                $this->db->select('wsc.connection_group');
                $this->db->distinct();
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('wsc.connection_type', 'P'); //For parallel

                $view_rows['data'] =  $this->db->get()->result_array();
                $sub_final_result = 1;
                if (count($view_rows['data']) != 0) {
                    for ($i = 1; $i <= count($view_rows['data']); $i++) :

                        $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Reliability');
                        $this->db->from('weapon_systems ws');
                        $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                        $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                        $this->db->where('ws.weapon_name', $weapon_name);
                        $this->db->where('wsc.connection_type', 'P'); //For parallel
                        $this->db->where('wsc.connection_group', $i); //For group

                        $view_array['data'] =  $this->db->get()->result_array();
                        $resultant_parallel = 1;
                        $data_index = 0;
                        if (count($view_array['data']) != 0) {
                            foreach ($view_array['data'] as $row) {
                                $resultant_parallel = $resultant_parallel * (1 - ($view_array['data'][$data_index]['Reliability']) / 100);
                                $data_index++;
                            }
                            $resultant_parallel =   1 - $resultant_parallel;
                        } else {
                            $resultant_parallel = 0;
                            return $resultant_parallel;
                        }
                        $sub_final_result = $sub_final_result * $resultant_parallel;

                    endfor;
                }


                $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Reliability');
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('wsc.connection_type', 'S'); //For series

                $view_array['data'] =  $this->db->get()->result_array();
                $resultant_series = 1;
                $data_index = 0;
                if (count($view_array['data']) != 0) {
                    foreach ($view_array['data'] as $row) {
                        $resultant_series = $resultant_series * (($view_array['data'][$data_index]['Reliability']) / 100);
                        $data_index++;
                    }
                } else {
                    $resultant_series = 0;
                    return $resultant_series;
                }

                $final_result = $sub_final_result * $resultant_series;
                echo number_format(($final_result * 100), 2);

                //Updation 

                  $cond  = ['weapon_name' => $weapon_name];
                 $data_update = [
                'Reliabbility' => number_format(($final_result * 100), 2),
            ];

            $this->db->where($cond);
            $this->db->update('weapon_systems', $data_update);

            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }


    public function get_sensors_data()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "weo") {
                $weapon_name = $_POST['weapon_name'];
                $view_array = array();

                $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Availability,cd.Reliability');
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);

                $view_array['data'] =  $this->db->get()->result_array();
                echo json_encode($view_array['data']);
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
