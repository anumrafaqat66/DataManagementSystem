 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class WEO extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($weapon = NULL)
    {

        //$input_params = $this->input->get(); // this will give you all parameters
        //print_r($input_params['we']); exit;
        //$data['selected_weapon'] = $input_params['we'];

        $data['controller_data'] = $this->db->where('Controller_type', 'Weapon')->get('controller_data')->result_array();
        $this->load->view('weo/weo', $data);
    }

    public function get_all_weapons_availability()
    {
        //$system_time = $_POST['time'];
        $weapons_array = array();
        $weapons_array['data'] = $this->db->where('Controller_type', 'Weapon')->get('controller_data')->result_array();

        if (count($weapons_array['data']) != 0) {
            for ($i = 0; $i < count($weapons_array['data']); $i++) :
                $this->get_system_availability($weapons_array['data'][$i]['Controller_Name']);
            endfor;
        }
    }


    public function get_system_availability($weapon = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "weo" || $status = "co") {
                $weapon_name = $weapon;
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

    public function get_all_weapons_reliability()
    {
        $isDefault = $_POST['isDefault'];
        if ($isDefault == true) {
            $system_time = 30;
        } else if ($isDefault == false) {
            $system_time = $_POST['time'];
        }
        echo $isDefault; echo $system_time; exit;
        $weapons_array = array();
        $weapons_array['data'] = $this->db->where('Controller_type', 'Weapon')->get('controller_data')->result_array();

        if (count($weapons_array['data']) != 0) {
            for ($i = 0; $i < count($weapons_array['data']); $i++) :
                $this->get_system_reliability($weapons_array['data'][$i]['Controller_Name'], $system_time, $isDefault);
            endfor;
        }
    }

    public function get_system_reliability($weapon_name = NULL, $time = NULL, $isDefault = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "weo" || $status = "co") {
                //$weapon_name = $_POST['weapon_name'];
                $system_time = $time;
                //echo $weapon_name;exit;
                $view_array = array();
                $view_rows = array();
                $view_sensors = array();

                $this->db->select('wsc.sensor_id');
                $this->db->distinct();
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $view_sensors['data'] =  $this->db->get()->result_array();

                if (count($view_sensors['data']) != 0) {
                    for ($i = 0; $i < count($view_sensors['data']); $i++) :
                        $this->calculate_sensor_reliability($view_sensors['data'][$i]['sensor_id'], $system_time, $isDefault);

                    endfor;
                }

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

                        $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Reliability, cd.Default_Reliability');
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
                                if($isDefault){
                                    $resultant_parallel = $resultant_parallel * (1 - ($view_array['data'][$data_index]['Default_Reliability']) / 100);
                                } else {
                                    $resultant_parallel = $resultant_parallel * (1 - ($view_array['data'][$data_index]['Reliability']) / 100);    
                                }
                                
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


                $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Reliability, cd.Default_Reliability');
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
                        if ($isDefault) {
                            $resultant_series = $resultant_series * (($view_array['data'][$data_index]['Default_Reliability']) / 100);
                        } else {
                            $resultant_series = $resultant_series * (($view_array['data'][$data_index]['Reliability']) / 100);
                        }
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
                if ($isDefault) {
                    $data_update = [
                        'Default_Reliability' => number_format(($final_result * 100), 2),
                    ];
                } else {
                    $data_update = [
                        'Reliabbility' => number_format(($final_result * 100), 2),
                    ];
                }

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
            if ($status == "weo" || $status = "co") {
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


    public function calculate_sensor_reliability($controller_id = NULL, $time = NULL, $isDefault = NULL)
    {

        if ($time > 0) {

            $view_array = array();
            $view_array['data'] =  $this->db->where('ID', $controller_id)->get('controller_data')->row_array();
            if ($view_array['data']['MTBF'] != '' && $view_array['data']['MTBF'] != 0.00) {
                $power = ($time / $view_array['data']['MTBF']);
                $power = -1 * $power;
                $reliability = number_format(pow(2.718, $power), 4);
            } else {
                $reliability = 0;
            }
        } else {
            $reliability = 0;
        }
        $cond  = ['ID' => $controller_id];

        if ($isDefault = true) {
            $data_update = [
                'Default_Reliability' => $reliability * 100,
            ];
        } else if($isDefault = false) {
            $data_update = [
                'Reliability' => $reliability * 100,
            ];
        }
        $this->db->where($cond);
        $this->db->update('controller_data', $data_update);
    }
}
