 
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

        $data['ship_id'] = $this->session->userdata('ship_id');
        $data['controller_data'] = $this->db->where('Controller_type', 'Weapon')->where('Ship_ID', $data['ship_id'])->get('controller_data')->result_array();
        $this->load->view('weo/weo', $data);
    }

    public function get_all_weapons_availability()
    {
        $ship_id = $_POST['ship_id'];
        $weapons_array = array();
        $weapons_array['data'] = $this->db->where('Controller_type', 'Weapon')->where('Ship_ID', $ship_id)->get('controller_data')->result_array();
        
        if (count($weapons_array['data']) != 0) {
            for ($i = 0; $i < count($weapons_array['data']); $i++) :
                $this->get_system_availability($weapons_array['data'][$i]['Controller_Name'],$ship_id);
            endfor;
        }

        $weapons_avail = array();
        $weapons_avail['data'] = $this->db->select('weapon_name, Availability')->distinct()->where('Ship_ID', $ship_id)->get('weapon_systems')->result_array();

        echo json_encode($weapons_avail['data']);
    }


    public function get_system_availability($weapon = NULL, $ship_id = NULL)
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
                $this->db->where('ws.Ship_ID', $ship_id); //For parallel

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
                        $this->db->where('ws.Ship_ID', $ship_id); //For parallel

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
                $this->db->where('ws.Ship_ID', $ship_id); //For ship 

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

                //Updation 
                $cond  = ['weapon_name' => $weapon_name, 'Ship_ID' => $ship_id];
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
        $system_time = 0;
        if ($isDefault == "Yes") {
            $system_time = 30;
        } else if ($isDefault == "No") {
            $system_time = $_POST['time'];
        }

        $ship_id = $_POST['ship_id']; // Get Ship ID
        
        $weapons_array = array();
        $weapons_array['data'] = $this->db->where('Controller_type', 'Weapon')->where('Ship_ID', $ship_id)->get('controller_data')->result_array();

        if (count($weapons_array['data']) != 0) {
            for ($i = 0; $i < count($weapons_array['data']); $i++) :
                $this->get_system_reliability($weapons_array['data'][$i]['Controller_Name'], $system_time, $isDefault, $ship_id );
            endfor;
        }

        $weapons_rel = array();
        $weapons_rel['data'] = $this->db->select('weapon_name, default_reliability,reliabbility')->distinct()->where('Ship_ID', $ship_id)->get('weapon_systems')->result_array();

        echo json_encode($weapons_rel['data']);
    }

    public function get_system_reliability($weapon_name = NULL, $time = NULL, $isDefault = NULL, $ship_id = NULL)
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
                $this->db->where('ws.Ship_ID', $ship_id); //for ship
                $view_sensors['data'] =  $this->db->get()->result_array();

                if (count($view_sensors['data']) != 0) {
                    for ($i = 0; $i < count($view_sensors['data']); $i++) :
                        $this->calculate_sensor_reliability($view_sensors['data'][$i]['sensor_id'], $system_time, $isDefault, $ship_id);
                    endfor;
                }

                $this->db->select('wsc.connection_group');
                $this->db->distinct();
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('wsc.connection_type', 'P'); //For parallel
                $this->db->where('ws.Ship_ID', $ship_id); //for ship

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
                        $this->db->where('ws.Ship_ID', $ship_id); //for ship

                        $view_array['data'] =  $this->db->get()->result_array();
                        $resultant_parallel = 1;
                        $data_index = 0;
                        if (count($view_array['data']) != 0) {
                            foreach ($view_array['data'] as $row) {
                                if ($isDefault == "Yes") {
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
                $this->db->where('ws.Ship_ID', $ship_id); //for ship

                $view_array['data'] =  $this->db->get()->result_array();
                $resultant_series = 1;
                $data_index = 0;
                if (count($view_array['data']) != 0) {
                    foreach ($view_array['data'] as $row) {
                        if ($isDefault == "Yes") {
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
                //echo number_format(($final_result * 100), 2);

                //Updation 
                $cond  = ['weapon_name' => $weapon_name, 'Ship_ID' => $ship_id];
                if ($isDefault == "Yes") {
                    $data_update = [
                        'Default_Reliability' => number_format(($final_result * 100), 2)
                    ];
                } else {
                    $data_update = [
                        'Reliabbility' => number_format(($final_result * 100), 2)
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
            $ship_id = $this->session->userdata('ship_id');
            if ($status == "weo" || $status = "co") {
                $weapon_name = $_POST['weapon_name'];
                $view_array = array();

                $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Availability,cd.Reliability, cd.Default_Reliability');
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('ws.Ship_ID', $ship_id);

                $view_array['data'] =  $this->db->get()->result_array();
                echo json_encode($view_array['data']);
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }


    public function calculate_sensor_reliability($controller_id = NULL, $time = NULL, $isDefault = NULL, $ship_id = NULL)
    {

        if ($time > 0) {

            $view_array = array();
            $view_array_detail = array();

            $view_array['data'] =  $this->db->where('ID', $controller_id)->where('Ship_ID',$ship_id)->get('controller_data')->row_array();

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
            } else {
                $reliability = 0;
            }
        } else {
            $reliability = 0;
        }
        $cond  = ['ID' => $controller_id, 'Ship_ID' => $ship_id];

        $data_update = [
            'Default_Reliability' => $reliability * 100,
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
    }
}
