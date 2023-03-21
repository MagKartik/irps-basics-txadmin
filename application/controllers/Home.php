<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Expose-Headers: Access-Control-*');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Allow: GET, POST, PUT, DELETE, OPTIONS, HEAD');

class Home extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->helper('string');
		$this->load->helper('url');
		$this->load->library(array(
				'session',
				'form_validation',
            ));
            
        $this->load->model('Steam_model');
		$this->load->model('User_model');
    }
    public function landing(){
		$data['footer'] = $this->load->view('components/footer', null, true);
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('landing',$data);
        $this->load->view('footer');
    }
    public function profile(){
        $user = $this->session->userdata('steamid');
		if($user) {
            $steam_array = $this->Steam_model->create_id($user);
            $user_details = $this->User_model->get_user_info($steam_array);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $main_array = array();
            $main_array['characters'] = $user_details;
            if(count($server_role)>0){
                $main_array['role'] = $server_role[0];
            }else{
                $empty = array();
                $empty["role"] = "Player";
                $empty["identity"] = "0";
                $empty["access"] = "0";
                $main_array['role'] = $empty;
            }
            $main_array["isLogin"] = true;
            $main_array["dec"] = $user;
            $main_array["hex"] = $steam_array[1];
            $steam_id = dechex($user);
            $steam_id1 = "steam:".dechex($user);
            $ch = curl_init("https://steamid.venner.io/raw.php?input=".$user);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $decCode = json_decode($data);
            $arr = array();
            $resData = $this->User_model->get_priority_info($decCode->steamid,$steam_id1);
            if(count($resData)>0){
                if($resData[0]->end_time >= time()){
                    $arr['level'] = (int)$resData[0]->power;
                    $arr['days'] = $resData[0]->end_time;
                }else{
                    $arr['level'] = 0;
                    $arr['days'] = 0;
                }
            }else{
                $arr['level'] = 0;
                $arr['days'] = 0;
            }
            // echo json_encode($arr);
            $data = array();
            $data['player_data'] = $main_array;
            $data['priority'] = $arr;
            $this->load->view('header');
            $this->load->view('components/transnav');
            $this->load->view('profile', $data);
            $this->load->view('footer');
        }else{
            header('Location: ' . base_url());
        }
    }
    public function player(){
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('player');
        $this->load->view('footer');
    }
    public function priority(){
		$data = array();
		$data['priority_success'] = $this->load->view('components/prioritysuccess', null, true);
		$data['priority_error'] = $this->load->view('components/priorityerror', null, true);
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('priority',$data);
        $this->load->view('footer');
    }
    public function banned(){
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('banned');
        $this->load->view('footer');
	}
	public function staff_management(){
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('staff_management');
		$this->load->view('footer');
	}
	public function rules(){
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('rules');
		$this->load->view('footer');
	}
	public function timeline(){
		$data['sidenav'] = $this->load->view('components/sidenavtimeline', null, true);
		$data['upload'] = $this->load->view('components/statusandupload', null, true);
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('timeline',$data);
		$this->load->view('footer');
	}
	public function cars(){
		$data['footer'] = $this->load->view('components/footer', null, true);
        $this->load->view('header');
        $this->load->view('components/transnav');
        $this->load->view('cars',$data);
		$this->load->view('footer');
	}
	
}