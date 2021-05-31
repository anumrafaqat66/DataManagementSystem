<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mission extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function mission($name = NULL)
	{
		$ship_id = $this->session->userdata('ship_id');
		$weapons = $this->db->where('mission_name', $name)->where('Ship_ID', $ship_id)->get('weapon_systems')->result_array();
		// print_r($weapons);exit;

		$result = 1;

		for ($i = 0; $i < count($weapons); $i++) {
			$result = $result * (1 - $weapons[$i]['Availability'] / 100);
			$datarow = $i  + 1;
			$data["weapon$datarow"] = $weapons[$i]['Availability'];
		}

		$data['availability'] = number_format((1 - ($result)) * 100, 2);

		$cond  = ['mission_name' => $name, 'Ship_ID' => $ship_id];
		$data_update = [
			'Availability' => $data['availability'],
		];

		$this->db->where($cond);
		$this->db->update('missions', $data_update);

		if ($name == "AAW") {
			$this->load->view('mission/AAW', $data);
		} else if ($name == "ASuW") {
			$this->load->view('mission/ASuW', $data);
		} else if ($name == "ASW") {
			$this->load->view('mission/ASW', $data);
		} else if ($name == "EW") {
			$this->load->view('mission/EW', $data);
		}
	}

	public function PageReload()
	{
		$pageName = $_POST['page_name'];

		if ($pageName == 'AAW' || $pageName == 'ASuW') {
			$data['weaponReliability1'] = $_POST['wr1'];
			$data['weaponReliability2'] = $_POST['wr2'];
			$data['weaponReliability3'] = $_POST['wr3'];
			$data['weaponReliability4'] = $_POST['wr4'];
			$data['weapon1'] = $_POST['wp1'];
			$data['weapon2'] = $_POST['wp2'];
			$data['weapon3'] = $_POST['wp3'];
			$data['weapon4'] = $_POST['wp4'];
		} else if ($pageName == 'ASW' || $pageName == 'EW') {
			$data['weaponReliability1'] = $_POST['wr1'];
			$data['weaponReliability2'] = $_POST['wr2'];
			$data['weapon1'] = $_POST['wp1'];
			$data['weapon2'] = $_POST['wp2'];
		}

		$data['availability'] = $_POST['avail'];
		$data['reliability'] = $_POST['rel'];
		$data['time_entered'] = $_POST['time'];

		if ($pageName == 'AAW') {
			echo $data = $this->load->view('mission/AAW', $data, TRUE);
		} else if ($pageName == 'ASuW') {
			echo $data = $this->load->view('mission/ASuW', $data, TRUE);
		} else if ($pageName == 'ASW') {
			echo $data = $this->load->view('mission/ASW', $data, TRUE);
		} else if ($pageName == 'EW') {
			echo $data = $this->load->view('mission/EW', $data, TRUE);
		}
	}


	public function get_each_weapon_reliability()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$status = $this->session->userdata('status');
			$ship_id = $this->session->userdata('ship_id');

			if ($status == "co" || $status == "typecdr") {
				$mission_name = $_POST['mission_name'];
				$weapons_reliablity = $this->db->where('Mission_name', $mission_name)->where('Ship_ID', $ship_id)->get('weapon_systems')->result_array();
				$result = 1;
				for ($i = 0; $i < count($weapons_reliablity); $i++) {
					$datarow = $i  + 1;
					$data["weaponReliability$datarow"] = $weapons_reliablity[$i]['Reliabbility'];
				}
				echo json_encode($data);
			}
		}
	}

	public function get_mission_reliability()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$status = $this->session->userdata('status');
			$ship_id = $this->session->userdata('ship_id');

			if ($status == "co" || $status == "typecdr") {
				$mission_name = $_POST['mission_name'];
				$system_time = $_POST['time'];

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
					//$datarow = $i  + 1;
					//$data["weapon$datarow"] = $weapons_reliablity[$i]['Reliability'];
				}
				echo number_format((1 - ($result)) * 100, 2);
				//exit;
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
            $Total_Equiped = $view_array['data']['Total_Equipped'];


			if ($view_array['data']['MTBF'] != '' && $view_array['data']['MTBF'] != 0.00) {
				// $power = ($time / $view_array['data']['MTBF']);
				$power = ($Total_failure_count / ($days * $Total_Equiped)) * $time; //Formula Updated
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


	public function get_sensors_data()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');
			$ship_id = $this->session->userdata('ship_id');
            if ($status == "weo" || $status = "co" || $status =="typecdr") {
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
}
