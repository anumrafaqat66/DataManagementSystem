<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cdr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($entered_time = NULL)
    {
        $this->session->set_userdata('ship_id', 1); //Default Set
        $ship_id = $this->session->userdata('ship_id');

        ////////// SHIP A ///////////////////////////
        $missions = $this->db->where('Ship_ID', 1)->get('missions')->result_array();
        $result_shipA = 1;
        $result_shipA_rel = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result_shipA = $result_shipA * (1 - $missions[$i]['Availability'] / 100);
            $result_shipA_rel = $result_shipA_rel * (1 - $missions[$i]['Reliability'] / 100);
            $datarow = $i  + 1;
            $data["shipA_mission$datarow"] = $missions[$i]['Availability'];
            $data["shipA_mission_rel$datarow"] = $missions[$i]['Reliability'];
        }
        $data['availability_missionA'] = number_format((1 - ($result_shipA)) * 100, 2);
        $data['reliability_missionA'] = number_format((1 - ($result_shipA_rel)) * 100, 2);

        //////// SHIP B //////////////////////////////
        $missions = $this->db->where('Ship_ID', 2)->get('missions')->result_array();
        $result_shipB = 1;
        $result_shipB_rel = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result_shipB = $result_shipB * (1 - $missions[$i]['Availability'] / 100);
            $result_shipB_rel = $result_shipB_rel * (1 - $missions[$i]['Reliability'] / 100);
            $datarow = $i  + 1;
            $data["shipB_mission$datarow"] = $missions[$i]['Availability'];
            $data["shipB_mission_rel$datarow"] = $missions[$i]['Reliability'];
        }
        $data['availability_missionB'] = number_format((1 - ($result_shipB)) * 100, 2);
        $data['reliability_missionB'] = number_format((1 - ($result_shipB_rel)) * 100, 2);

        ///////// SHIP C //////////////////////////
        $missions = $this->db->where('Ship_ID', 3)->get('missions')->result_array();
        $result_shipC = 1;
        $result_shipC_rel = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result_shipC = $result_shipC * (1 - $missions[$i]['Availability'] / 100);
            $result_shipC_rel = $result_shipC_rel * (1 - $missions[$i]['Reliability'] / 100);
            $datarow = $i  + 1;
            $data["shipC_mission$datarow"] = $missions[$i]['Availability'];
            $data["shipC_mission_rel$datarow"] = $missions[$i]['Reliability'];
        }
        $data['availability_missionC'] = number_format((1 - ($result_shipC)) * 100, 2);
        $data['reliability_missionC'] = number_format((1 - ($result_shipC_rel)) * 100, 2);

        ////////// SHIP D ////////////////////////
        $missions = $this->db->where('Ship_ID', 4)->get('missions')->result_array();
        $result_shipD = 1;
        $result_shipD_rel = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result_shipD = $result_shipD * (1 - $missions[$i]['Availability'] / 100);
            $result_shipD_rel = $result_shipD_rel * (1 - $missions[$i]['Reliability'] / 100);
            $datarow = $i  + 1;
            $data["shipD_mission$datarow"] = $missions[$i]['Availability'];
            $data["shipD_mission_rel$datarow"] = $missions[$i]['Reliability'];
        }
        $data['availability_missionD'] = number_format((1 - ($result_shipD)) * 100, 2);
        $data['reliability_missionD'] = number_format((1 - ($result_shipD_rel)) * 100, 2);


        $ship_data = $this->db->get('ship_data')->result_array();
        for ($i = 0; $i < count($ship_data); $i++) {
            $datarow = $i  + 1;
            $data["ship_data$datarow"] = $ship_data[$i]['Ship_name'];
        }

        if ($entered_time != null && $entered_time != '') {
            $data['entered_time'] = $entered_time;
        }

        $this->load->view('cdr/cdr', $data);
    }

    public function co($ship = null)
    {
        if ($ship == "Ship1") {
            $this->session->set_userdata('ship_id', 1);
        } else if ($ship == "Ship2") {
            $this->session->set_userdata('ship_id', 2);
        } else if ($ship == "Ship3") {
            $this->session->set_userdata('ship_id', 3);
        } else if ($ship == "Ship4") {
            $this->session->set_userdata('ship_id', 4);
        }

        $ship_id = $this->session->userdata('ship_id');
        $missions = $this->db->where('Ship_ID', $ship_id)->get('missions')->result_array();
        $result = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result = $result * (1 - $missions[$i]['Availability'] / 100);
            $datarow = $i  + 1;
            $data["mission$datarow"] = $missions[$i]['Availability'];
        }
        $data['availability'] = number_format((1 - ($result)) * 100, 2);
        $this->load->view('ship/ship', $data);
    }

    public function redirect($page = null)
    {
        if ($page == 'co') {
            redirect('CO');
        } elseif ($page == 'weo') {
            redirect('WEO');
        } elseif ($page == 'hod') {
            redirect('HOD');
        } elseif ($page == 'manager') {
            redirect('Manager');
        } elseif ($page == 'technician') {
            redirect('Technician');
        }
    }

    public function PageReload()
    {
        $time_entered = $_POST['time'];
        $this->index($time_entered);
        //echo $data = $this->load->view('Cdr/cdr', $data, TRUE);
    }


    public function get_all_ships_reliability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            $system_time = $_POST['time'];

            if ($status == "co" || $status == "typecdr") {
                $ships = $this->db->get('ship_data')->result_array();

                if (count($ships) != 0) {
                    for ($i = 0; $i < count($ships); $i++) :
                        $this->get_complete_ship_reliability($ships[$i]['ID'], $system_time);
                    endfor;
                }
            }
        }
    }

    public function get_complete_ship_reliability($ship_id = NULL, $time = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
            //$ship_id = $ship_id; //$this->session->userdata('ship_id');

            if ($status == "co" || $status == "typecdr") {
                //$mission_name = $_POST['mission_name'];
                $system_time = $time;

                $missions = $this->db->where('Ship_ID', $ship_id)->get('missions')->result_array();
                //print_r($missions);exit;
                if (count($missions) != 0) {
                    for ($i = 0; $i < count($missions); $i++) :
                        $this->get_mission_reliability($missions[$i]['Mission_name'], $system_time, $ship_id);
                    endfor;
                }

                $mission_reliablity = $this->db->where('Ship_ID', $ship_id)->get('missions')->result_array();

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
            if ($status == "co" || $status == "typecdr") {
                $mission_name = $mission_name;
                $system_time = $time;

                $weapons = $this->db->where('Mission_name', $mission_name)->where('Ship_ID', $ship_id)->get('weapon_systems')->result_array();
                if (count($weapons) != 0) {
                    for ($i = 0; $i < count($weapons); $i++) :
                        $this->calculate_weapon_reliability($weapons[$i]['weapon_name'], $system_time, $ship_id);
                    endfor;
                }

                $weapons_reliablity = $this->db->where('Mission_name', $mission_name)->where('Ship_ID', $ship_id)->get('weapon_systems')->result_array();

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
        $cond  = ['ID' => $controller_id, 'Ship_ID' => $ship_id];
        $data_update = [
            'Reliability' => $reliability * 100,
        ];

        $this->db->where($cond);
        $this->db->update('controller_data', $data_update);
    }
}
