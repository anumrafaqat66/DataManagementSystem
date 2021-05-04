 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class HOD extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['sensor_data'] = $this->db->where('Controller_type', 'Sensor')->get('controller_data')->result_array();
        $data['fire_controller_data'] = $this->db->where('Controller_type', 'Fire Controller')->get('controller_data')->result_array();
        $data['weapon_data'] = $this->db->where('Controller_type', 'Weapon')->get('controller_data')->result_array();
        $this->load->view('hod/hod', $data);
    }

    public function get_availability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');

            if ($status == "hod") {
                $controller_id = $_POST['controller_id'];
                $view_array = array();
                $view_array['data'] =  $this->db->where('ID', $controller_id)->get('controller_data')->row_array();
                if ($view_array['data']['MTBF'] != '' && $view_array['data']['MTTR'] != '') {
                    $availability = number_format($view_array['data']['MTBF'] / ($view_array['data']['MTBF'] + $view_array['data']['MTTR']), 4);
                    //print_r($availability);
                    echo ($availability * 100);
                } else {
                    $availability = 0;
                    echo ($availability * 100);
                }
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function get_reliability()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');
            $status = $this->session->userdata('status');

            if ($status == "hod") {
                $controller_id = $_POST['controller_id'];
                $time = $_POST['time'];
                if ($time > 0) {
                    $view_array = array();
                    $view_array['data'] =  $this->db->where('ID', $controller_id)->get('controller_data')->row_array();
                    if ($view_array['data']['MTTR'] != '') {
                        $power = ($time / $view_array['data']['MTTR']);
                        $power = -1 * $power;
                        $reliability = number_format(pow(2.718, $power), 4);
                        echo ($reliability * 100);
                    } else {
                        $reliability = 0;
                        echo ($reliability * 100);
                    }
                } else {
                    $reliability = 0;
                    echo ($reliability * 100);
                }
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
