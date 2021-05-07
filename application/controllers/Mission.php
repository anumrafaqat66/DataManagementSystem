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

	public function mission($name=NUL){
		if($name="AAW"){
			$weapons= $this->db->where('Mission_name',$name)->get('weapon_systems')->result_array();
			//print_r($weapons);exit;
			if(count($weapons)==4){
			$first=0;
			$second=0;
			$third=0;
			$fourth=0;}
			

			for($i=0;$i<count($weapons);$i++){
				if($i==0){
					$first=(1-$weapons[$i]['Availability'])/100;
				}
				if($i==1){
					$second=(1-$weapons[$i]['Availability'])/100;
				}
				if($i==2){
					$third=(1-$weapons[$i]['Availability'])/100;
				}
				if($i==3){
					$fourth=(1-$weapons[$i]['Availability'])/100;
				}
			}
			$data['availability']=number_format((1-($first*$second*$third*$fourth))*100,2);
			echo $data['availability']; 
         	 $this->load->view('Mission/AAW',$data);

		}else if($name="ASuW"){
 			$this->load->view('Mission/ASuW');
		}else if($name="ASW"){
 			$this->load->view('Mission/ASW');
		}else if($name="EW"){
 			$this->load->view('Mission/EW');	
		}
	}
}