<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cdr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('ship_id', 1); //Default Set
        $ship_id = $this->session->userdata('ship_id');
        $missions = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();
        $result = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result = $result * (1 - $missions[$i]['Availability'] / 100);
            $datarow = $i  + 1;
            $data["mission$datarow"] = $missions[$i]['Availability'];
        }
        $data['availability'] = number_format((1 - ($result)) * 100, 2);
        $this->load->view('cdr/cdr', $data);
    }
    
    public function co($ship = null)
    {
        if($ship == "Ship1"){
            $this->session->set_userdata('ship_id', 1);
        } else if($ship == "Ship2"){
            $this->session->set_userdata('ship_id', 2);
        }

        $ship_id = $this->session->userdata('ship_id');
        $missions = $this->db->where('Ship_ID',$ship_id)->get('missions')->result_array();
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
}
