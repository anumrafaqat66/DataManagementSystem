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
		$weapons = $this->db->where('Mission_name', $name)->get('weapon_systems')->result_array();
		//print_r($weapons);exit;

		$result = 1;

		for ($i = 0; $i < count($weapons); $i++) {
			$result = $result * (1 - $weapons[$i]['Availability'] / 100);
			$datarow = $i  + 1;
			$data["weapon$datarow"] = $weapons[$i]['Availability'];
		}

		$data['availability'] = number_format((1 - ($result)) * 100, 2);

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
		$data['weaponReliability1'] = $_POST['wr1'];
		$data['weaponReliability2'] = $_POST['wr2'];
		$data['weaponReliability3'] = $_POST['wr3'];
		$data['weaponReliability4'] = $_POST['wr4'];
		$data['weapon1'] = $_POST['wp1'];
		$data['weapon2'] = $_POST['wp2'];
		$data['weapon3'] = $_POST['wp3'];
		$data['weapon4'] = $_POST['wp4'];
		$data['availability'] = $_POST['avail'];
		$data['reliability'] = $_POST['rel'];
		$data['time_entered'] = $_POST['time'];
		
		if($pageName == 'AAW') {
			echo $data = $this->load->view('mission/AAW', $data, TRUE);
		} else if($pageName == 'ASuW') {
			echo $data = $this->load->view('mission/ASuW', $data, TRUE);
		}
		
	}


	public function get_each_weapon_reliability()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$status = $this->session->userdata('status');
			if ($status == "co") {
				$mission_name = $_POST['mission_name'];

				$weapons_reliablity = $this->db->where('Mission_name', $mission_name)->get('weapon_systems')->result_array();

				$result = 1;
				for ($i = 0; $i < count($weapons_reliablity); $i++) {

					//$result = $result * (1 - $weapons_reliablity[$i]['Reliabbility'] / 100);
					$datarow = $i  + 1;
					$data["weaponReliability$datarow"] = $weapons_reliablity[$i]['Reliabbility'];
				}
				//$data['availability'] = number_format((1 - ($result)) * 100, 2);
				//print_r($data); exit;
				echo json_encode($data);
				//$this->load->view('mission/AAW', $data);
			}
		}
	}

	public function get_mission_reliability()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$status = $this->session->userdata('status');
			if ($status == "co") {
				$mission_name = $_POST['mission_name'];
				$system_time = $_POST['time'];

				$weapons = $this->db->where('Mission_name', $mission_name)->get('weapon_systems')->result_array();
				if (count($weapons) != 0) {
					for ($i = 0; $i < count($weapons); $i++) :
						$this->calculate_weapon_reliability($weapons[$i]['weapon_name'], $system_time);

					endfor;
				}

				$weapons_reliablity = $this->db->where('Mission_name', $mission_name)->get('weapon_systems')->result_array();

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

	public function calculate_weapon_reliability($weapon_name = NULL, $system_time = NULL)
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
		$view_sensors['data'] =  $this->db->get()->result_array();

		if (count($view_sensors['data']) != 0) {
			for ($i = 0; $i < count($view_sensors['data']); $i++) :
				$this->calculate_sensor_reliability($view_sensors['data'][$i]['sensor_id'], $system_time);

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

		//Updation 
		$cond  = ['weapon_name' => $weapon_name];
		$data_update = [
			'Reliabbility' => number_format(($final_result * 100), 2),
		];

		$this->db->where($cond);
		$this->db->update('weapon_systems', $data_update);
	}

	public function calculate_sensor_reliability($controller_id = NULL, $time = NULL)
	{

		if ($time > 0) {

			$view_array = array();
			$view_array['data'] =  $this->db->where('ID', $controller_id)->get('controller_data')->row_array();
			if ($view_array['data']['MTTR'] != '' && $view_array['data']['MTTR'] != 0.00) {
				$power = ($time / $view_array['data']['MTTR']);
				$power = -1 * $power;
				$reliability = number_format(pow(2.718, $power), 4);
			} else {
				$reliability = 0;
			}
		} else {
			$reliability = 0;
		}
		$cond  = ['ID' => $controller_id];
		$data_update = [
			'Reliability' => $reliability * 100,
		];

		$this->db->where($cond);
		$this->db->update('controller_data', $data_update);
	}
}
