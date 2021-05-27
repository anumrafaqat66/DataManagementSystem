<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cdr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
     $missions = $this->db->get('missions')->result_array();
        $result = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result = $result * (1 - $missions[$i]['Availability'] / 100);
            $datarow = $i  + 1;
            $data["mission$datarow"] = $missions[$i]['Availability'];
        }
        $data['availability'] = number_format((1 - ($result)) * 100, 2);
        $this->load->view('cdr/cdr',$data);
    }
    public function co($ship=null){
         $missions = $this->db->get('missions')->result_array();
        $result = 1;
        for ($i = 0; $i < count($missions); $i++) {
            $result = $result * (1 - $missions[$i]['Availability'] / 100);
            $datarow = $i  + 1;
            $data["mission$datarow"] = $missions[$i]['Availability'];
        }
        $data['availability'] = number_format((1 - ($result)) * 100, 2);
        $this->load->view('ship/ship', $data);
    }
}
  
