 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CO extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['ship_id'] = $this->session->userdata('ship_id');
        $missions = $this->db->where('Ship_ID',$data['ship_id'])->get('missions')->result_array();

        $result = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result = $result * (1 - $missions[$i]['Availability'] / 100);
            $datarow = $i  + 1;
            $data["mission$datarow"] = $missions[$i]['Availability'];
        }
        $data['availability'] = number_format((1 - ($result)) * 100, 2);
        $this->load->view('ship/ship', $data);
    }

    public function mission()
    {
        //$data['controller_data'] = $this->db->where('Controller_type', 'Weapon')->get('controller_data')->result_array();
        $data['ship_id'] = $this->session->userdata('ship_id');
        $missions = $this->db->where('Ship_ID',$data['ship_id'])->get('missions')->result_array();
        $result = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result = $result * (1 - $missions[$i]['Availability'] / 100);
            $datarow = $i  + 1;
            $data["mission$datarow"] = $missions[$i]['Availability'];
        }
        $data['availability'] = number_format((1 - ($result)) * 100, 2);
        $this->load->view('ship/ship', $data);
    }

    public function PageReload()
    {
        $data['MissionReliability1'] = $_POST['wr1'];
        $data['MissionReliability2'] = $_POST['wr2'];
        $data['MissionReliability3'] = $_POST['wr3'];
        $data['MissionReliability4'] = $_POST['wr4'];
        $data['mission1'] = $_POST['wp1'];
        $data['mission2'] = $_POST['wp2'];
        $data['mission3'] = $_POST['wp3'];
        $data['mission4'] = $_POST['wp4'];

        $data['availability'] = $_POST['avail'];
        $data['reliability'] = $_POST['rel'];
        $data['time_entered'] = $_POST['time'];
        $data['button_clicked'] = 1;

        echo $data = $this->load->view('ship/ship', $data, TRUE);
    }

    public function get_each_mission_reliability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            $ship_id = $this->session->userdata('ship_id');
            if ($status == "co" || $status =="typecdr") {
                //$mission_name = $_POST['mission_name'];
                $mission_reliablity = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();
                $result = 1;
                for ($i = 0; $i < count($mission_reliablity); $i++) {

                    //$result = $result * (1 - $weapons_reliablity[$i]['Reliabbility'] / 100);
                    $datarow = $i  + 1;
                    $data["MissionReliability$datarow"] = $mission_reliablity[$i]['Reliability'];
                }
                echo json_encode($data);
            }
        }
    }

    public function get_complete_ship_reliability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            $ship_id = $this->session->userdata('ship_id');

            if ($status == "co" || $status =="typecdr") {
                //$mission_name = $_POST['mission_name'];
                $system_time = $_POST['time'];

                $missions = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();
                //print_r($missions);exit;
                if (count($missions) != 0) {
                    for ($i = 0; $i < count($missions); $i++) :
                        $this->get_mission_reliability($missions[$i]['Mission_name'], $system_time, $ship_id);
                    endfor;
                }

                $mission_reliablity = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();

                $result = 1;
                for ($i = 0; $i < count($mission_reliablity); $i++) {
                    $result = $result * (1 - $mission_reliablity[$i]['Reliability'] / 100);
                }
                echo number_format((1 - ($result)) * 100, 2);
                //exit;
            }
        }
    }

    public function get_mission_reliability($mission_name = NULL, $time = NULL, $ship_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "co" || $status =="typecdr") {
                $mission_name = $mission_name;
                $system_time = $time;

                $weapons = $this->db->where('Mission_name', $mission_name)->where('Ship_ID',$ship_id)->get('weapon_systems')->result_array();
                if (count($weapons) != 0) {
                    for ($i = 0; $i < count($weapons); $i++) :
                        $this->calculate_weapon_reliability($weapons[$i]['weapon_name'], $system_time, $ship_id);
                    endfor;
                }

                $weapons_reliablity = $this->db->where('Mission_name', $mission_name)->where('Ship_ID',$ship_id)->get('weapon_systems')->result_array();

                $result = 1;
                for ($i = 0; $i < count($weapons_reliablity); $i++) {
                    $result = $result * (1 - $weapons_reliablity[$i]['Reliabbility'] / 100);
                }

                //Update into Database
                $cond  = ['Mission_name' => $mission_name, 'Ship_ID' => $ship_id];
                $data_update = [
                    'Reliability' => number_format((1 - ($result)) * 100, 2),
                ];

                $this->db->where($cond);
                $this->db->update('missions', $data_update);
            }
        }
    }

    public function calculate_weapon_reliability($weapon_name = NULL, $system_time = NULL, $ship_id = NULL)
    {
        $view_array = array();
        $view_rows = array();
        $view_sensors = array();

        $this->db->select('wsc.sensor_id');
        $this->db->distinct();
        $this->db->from('weapon_systems ws');
        $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
        $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
        $this->db->where('ws.weapon_name', $weapon_name);
        $this->db->where('ws.Ship_ID', $ship_id);

        $view_sensors['data'] =  $this->db->get()->result_array();

        if (count($view_sensors['data']) != 0) {
            for ($i = 0; $i < count($view_sensors['data']); $i++) :
                $this->calculate_sensor_reliability($view_sensors['data'][$i]['sensor_id'], $system_time, $ship_id);

            endfor;
        }

        $this->db->select('wsc.connection_group');
        $this->db->distinct();
        $this->db->from('weapon_systems ws');
        $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
        $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
        $this->db->where('ws.weapon_name', $weapon_name);
        $this->db->where('wsc.connection_type', 'P'); //For parallel
        $this->db->where('ws.Ship_ID', $ship_id);

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
                $this->db->where('ws.Ship_ID', $ship_id);

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
        $this->db->where('ws.Ship_ID', $ship_id);

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

        //Updation 
        $cond  = ['weapon_name' => $weapon_name, 'Ship_ID' => $ship_id];
        $data_update = [
            'Reliabbility' => number_format(($final_result * 100), 2),
        ];

        $this->db->where($cond);
        $this->db->update('weapon_systems', $data_update);
    }

    public function calculate_sensor_reliability($controller_id = NULL, $time = NULL, $ship_id = NULL)
    {
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
            $days = floor($diff / 60 / 60 / 24);

            //Total_Equipped
            $Controller_name =  $this->db->select('Controller_Name')->where('ID', $controller_id)->limit(1)->get('controller_data')->row_array();
            $Total_Equiped_sum =  $this->db->select_sum('Total_Equipped')->where('Controller_Name', $Controller_name['Controller_Name'])->get('controller_data')->row_array();
            $Total_Equiped = $Total_Equiped_sum['Total_Equipped']; 
            // $Total_Equiped = $view_array['data']['Total_Equipped'];

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
        $cond  = ['ID' => $controller_id, 'Ship_ID'=> $ship_id];
        $data_update = [
            'Reliability' => $reliability * 100,
        ];

        $this->db->where($cond);
        $this->db->update('controller_data', $data_update);
    }


    public function get_complete_ship_availability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            $ship_id = $this->session->userdata('ship_id');

            if ($status == "co" || $status =="typecdr") {
                //$mission_name = $_POST['mission_name'];
                // $system_time = $_POST['time'];

                $missions = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();
                //print_r($missions);exit;
                if (count($missions) != 0) {
                    for ($i = 0; $i < count($missions); $i++) :
                        $this->get_mission_availability($missions[$i]['Mission_name'], $ship_id);
                    endfor;
                }

                $mission_availability = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();

                $result = 1;
                for ($i = 0; $i < count($mission_availability); $i++) {
                    $result = $result * (1 - $mission_availability[$i]['Availability'] / 100);
                }
                echo number_format((1 - ($result)) * 100, 2);
                //exit;
            }
        }
    }

    public function get_mission_availability($mission_name = NULL, $ship_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            if ($status == "co" || $status =="typecdr") {
                $mission_name = $mission_name;

                $weapons = $this->db->where('Mission_name', $mission_name)->where('Ship_ID',$ship_id)->get('weapon_systems')->result_array();
                if (count($weapons) != 0) {
                    for ($i = 0; $i < count($weapons); $i++) :
                        $this->get_system_availability($weapons[$i]['weapon_name'], $ship_id);
                    endfor;
                }

                $weapons_availability = $this->db->where('Mission_name', $mission_name)->where('Ship_ID',$ship_id)->get('weapon_systems')->result_array();

                $result = 1;
                for ($i = 0; $i < count($weapons_availability); $i++) {
                    $result = $result * (1 - $weapons_availability[$i]['Availability'] / 100);
                }

                //Update into Database
                $cond  = ['Mission_name' => $mission_name, 'Ship_ID' => $ship_id];
                $data_update = [
                    'Availability' => number_format((1 - ($result)) * 100, 2),
                ];

                $this->db->where($cond);
                $this->db->update('missions', $data_update);
            }
        }
    }

    public function get_system_availability($weapon_name = NULL, $ship_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            $ship_id = $ship_id;
            if ($status == "co" || $status =="typecdr") {
                $weapon_name = $weapon_name;
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
                        $this->get_sensor_availability($view_sensors['data'][$i]['sensor_id'], $ship_id);
                    endfor;
                }

                $this->db->select('wsc.connection_group');
                $this->db->distinct();
                $this->db->from('weapon_systems ws');
                $this->db->join('weapon_system_config wsc', 'ws.id = wsc.weapon_id');
                $this->db->join('controller_data cd', 'wsc.sensor_id = cd.ID');
                $this->db->where('ws.weapon_name', $weapon_name);
                $this->db->where('wsc.connection_type', 'P'); //For parallel
                $this->db->where('ws.Ship_ID', $ship_id); //For ship
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
                        $this->db->where('ws.Ship_ID', $ship_id); //For ship
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
                echo number_format(($final_result * 100), 2);

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

    public function get_sensor_availability($sensor_id = NULL, $ship_id=null)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');

            if ($status == "hod" || $status == "weo" || $status == "co" || $status =="typecdr") {
                $controller_id = $sensor_id; //$_POST['controller_id'];
                $view_array = array();
                $view_array['data'] =  $this->db->where('ID', $controller_id)->where('Ship_ID', $ship_id)->get('controller_data')->row_array();
                if ($view_array['data']['MTBF'] != '' && $view_array['data']['MTTR'] != '' && $view_array['data']['MTBF'] != 0.00 && $view_array['data']['MTTR'] != 0.00) {
                    $availability = number_format($view_array['data']['MTBF'] / ($view_array['data']['MTBF'] + $view_array['data']['MTTR']), 4);
                    //echo ($availability * 100);
                } else {
                    $availability = 0;
                    //echo ($availability * 100);
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

    public function get_system_reliability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            $ship_id = $this->session->userdata('Ship_ID');
            if ($status == "co" || $status =="typecdr") {
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
                $this->db->where('ws.Ship_ID', $ship_id); //For ship

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
                        $this->db->where('ws.Ship_ID', $ship_id); //For ship

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
                $this->db->where('ws.Ship_ID', $ship_id); //For ship

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

                $cond  = ['weapon_name' => $weapon_name, 'Ship_ID' => $ship_id];
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
            $ship_id = $this->session->userdata('Ship_ID');
            if ($status == "weo" || $status =="co" || $status =="typecdr") {
                $weapon_name = $_POST['weapon_name'];
                $view_array = array();

                $this->db->select('ws.weapon_name,cd.Controller_Name,cd.Availability,cd.Reliability');
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
