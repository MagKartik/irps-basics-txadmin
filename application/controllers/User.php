<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Expose-Headers: Access-Control-*');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Allow: GET, POST, PUT, DELETE, OPTIONS, HEAD');
class User extends CI_Controller {
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
    public function my_data(){
        $user = $this->session->userdata('steamid');
		if($user) {
            $steam_array = $this->Steam_model->create_id($user);
            $user_details = $this->User_model->get_user_info($steam_array);
            $post_count = $this->User_model->count_user_posts($steam_array[0]);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $main_array = array();
            $main_array['characters'] = $user_details;
            $main_array['forum'] = $post_count;
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
            echo json_encode($main_array);
        }
        else{
			$data1 = array();
			$data1['isLogin'] = false;
			echo json_encode($data1);		
        }
    }
    public function check_priority(){
        $user = $this->session->userdata('steamid');
		if($user) {
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
            echo json_encode($arr);
        }
    }
    public function get_user_properties($steam_id){
        $data = $this->User_model->get_user_properties($steam_id);
        echo json_encode($data);
    }
    public function get_user_vehicles($steam_id){
        $data = $this->User_model->get_user_vehicles($steam_id);
        echo json_encode($data);
    }
    public function get_vehicles_categories($cat){
        $data = $this->User_model->get_vehicles_categories($cat);
        echo json_encode($data);
    }
    public function get_players($q){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array["players"] = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["players"] = $this->User_model->get_players($q);
                }
            }
            if($data_main_array){
                $data_main_array["identity"] = $flag;    
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{
            $data_main_array["identity"] = 0;    
            $data_main_array["players"] = array();
            $data_main_array["isLogin"] = false;
            $data_main_array["access"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function plate_avail(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array["avail"] = false;
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["avail"] =  $this->User_model->plate_avail($postData["plate"]);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{
            $data_main_array["avail"] = false;
            $data_main_array["isLogin"] = false;
            $data_main_array["access"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function phone_avail($phone){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array["avail"] = false;
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["avail"] = $this->User_model->phone_avail($phone);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{
            $data_main_array["avail"] = false;
            $data_main_array["isLogin"] = false;
            $data_main_array["access"] = false;
            echo json_encode($data_main_array);
        }
    }

    public function get_vehicles_list($cat,$q){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array["list"] = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["list"] = $this->User_model->get_vehicles_list($q,$cat);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{
            $data_main_array["isLogin"] = false;
            $data_main_array["access"] = false;
            echo json_encode($data_main_array);
        }
    }

    public function set_dead_or_alive(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->set_dead_or_alive($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }

    public function change_mobile(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->change_mobile($postData["new"], $postData["old"]);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function delete_car(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->delete_car($postData["plate"]);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function delete_house(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->delete_house($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function set_vehicle_money(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->set_vehicle_money($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function set_priority(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->set_priority($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function delete_priority(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->delete_priority($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }

    public function set_plate_avail(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = $this->User_model->set_plate_avail($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function set_staff_token(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2||$flag==3){
                    $data_main_array["resp"] = $this->User_model->set_staff_token($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function update_staff_token(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2||$flag==3){
                    $data_main_array["resp"] = $this->User_model->update_staff_token($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function irps_mama(){
        $postData = json_decode(file_get_contents('php://input'), true);
        $content = $postData["content"];
        $identifier = hexdec(str_replace("steam:","",$postData["steam"]));
        $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=CE022AA4CA037D2EFBBD317EC4D18B20&steamids=".$identifier); 
        $avatar =  json_decode($url)->response->players[0]->avatarmedium;
        $username =  json_decode($url)->response->players[0]->realname;
        $url =  json_decode($url)->response->players[0]->profileurl;
        function color(){
            $color_array = array("2061822", "14942328", "1879160", "16744192", "16711219", "10420421");
            $random = rand(0,count($color_array)-1);
            return $color_array[$random];
        }
        // echo $result;
        // // echo $identifier;
        // $ch = curl_init("https://discordapp.com/api/webhooks/654183976029650975/OLdNovQF1WQ7yfQoHvOjH5D0OglRCGlYoObEvrNBaiGoXJsnbv3GL8FTBtimk_V0gLMo");
        $ch = curl_init("https://discordapp.com/api/webhooks/656458275457597451/kRzvHdlGuKEOfrFNmEfEOvUdhlgMIN_isEhOKGApbqcz7SKoz-HEhCspnYkHNSKsMXIc");
        
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode(array("embeds"=>array(array("description"=> "**".$content['user']."** (".$content['stat'].") : ".$content['content']." ","color"=> color())),"username"=>$username,"avatar_url"=>$avatar)));
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        echo $data;
    }
    public function delete_staff_token(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2||$flag==3){
                    $data_main_array["resp"] = $this->User_model->delete_staff_token($postData);
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function get_staff_token(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            $data_main_array = array();
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity;
                if($flag==1||$flag==2||$flag==3){
                    $data_main_array["data"] = $this->User_model->get_staff_token();
                }
            }
            if($data_main_array){
                $data_main_array["isLogin"] = true;    
                $data_main_array["access"] = true;
                echo json_encode($data_main_array);
            }
        }
        else{        
            $data_main_array["access"] = false;
            $data_main_array["avail"] = false;
            echo json_encode($data_main_array);
        }
    }

    public function is_staff(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $data_main_array = array();
            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
            $time_s = date('d-m-Y H:i:s');
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity; 
                if($flag==1||$flag==2){
                    $data_main_array["resp"] = "success";
                    $data_main_array["isLogin"] = true;    
                    $data_main_array["access"] = true;
                    $data_main_array["manage"] = true;
                    $data_main_array["staff"] = true;
                    echo json_encode($data_main_array);
                }
                else if($flag==3){
                    $data_main_array["resp"] = "success";
                    $data_main_array["isLogin"] = true;    
                    $data_main_array["access"] = true;
                    $data_main_array["manage"] = false;
                    $data_main_array["staff"] = true;
                    echo json_encode($data_main_array);
                }
                else{
                    $data_main_array["resp"] = "success";
                    $data_main_array["isLogin"] = false;    
                    $data_main_array["access"] = false;
                    $data_main_array["manage"] = false;
                    $data_main_array["staff"] = false;
                    echo json_encode($data_main_array);
                }
            }else {
                $data_main_array["resp"] = "error";
                $empty = array();
                $data_main_array["access"] = false;
                $data_main_array["manage"] = false;
                $data_main_array["staff"] = false;
                echo json_encode($data_main_array);
                $conn->close();
            }        

        }else{
            $data_main_array["resp"] = "error";
            $data_main_array["isLogin"] = false;
            $data_main_array["access"] = false;
            $data_main_array["manage"] = false;
            $data_main_array["staff"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function get_banlist(){
        $banlist = $this->User_model->get_banlist();
        echo json_encode($banlist);
    }

    public function priority_check($steamid){
        if(isset($steamid)) {
            $decstring = str_replace("steam:","",$steamid);
            $decstring = hexdec($decstring);
            // echo $decstring;
            $ch = curl_init("https://steamid.venner.io/raw.php?input=".$decstring);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $decCode = json_decode($data);
            $result = $this->User_model->priority_check($decCode->steamid,$steamid);
            echo json_encode($result);
        }else{
            $data = array();
            $data['level'] = 0;
            $data['avail'] = false;
            echo json_encode($data);
        }
    }

    public function foregin_whitelist($steamid){
        if(isset($steamid)){
            $result = $this->User_model->foregin_whitelist($steamid);
            echo $result;
        }
    }
    public function steam64(){
        $user = $this->session->userdata('steamid');
        $user = true;
		if($user) {
            $postData = json_decode(file_get_contents('php://input'), true);
            $ch = curl_init("https://steamid.venner.io/raw.php?input=".$postData["steam_id"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $decCode = json_decode($data);
            $arr = array();
            if(isset($decCode->steamid)){
                echo json_encode(array("steam"=>$decCode->steamid, "name"=>$decCode->name, "response"=>"success","steamHex"=>"steam:".dechex($decCode->steamid64)));
            }else 
                echo json_encode(array("steam"=>"Not found!", "name"=>"", "response"=>"error"));
        }
    }
    public function get_priority_info(){
        $user = $this->session->userdata('steamid');
        $data_main_array = array();
		if($user) {
            $data_main_array = array();
            $steam_array = $this->Steam_model->create_id($user);
            $server_role = $this->User_model->get_server_role($steam_array[0]);
            $flag = 0;
            if(count($server_role)>0){
                $server_role = $server_role[0];
                $flag = $server_role->identity; 
                if($flag==1||$flag==2){
                    $data_main_array["priority"] = $this->User_model->priority_info();
                    $data_main_array["isLogin"] = true;    
                    $data_main_array["access"] = true;
                    $data_main_array["watch"] = true;
                    echo json_encode($data_main_array);
                } 
                else if($flag==3){
                    $data_main_array["priority"] = $this->User_model->priority_info();
                    $data_main_array["isLogin"] = true;    
                    $data_main_array["watch"] = true;
                    $data_main_array["access"] = false;
                    echo json_encode($data_main_array);
                }
                else{
                    $data_main_array["priority"] = array();
                    $data_main_array["isLogin"] = true;    
                    $data_main_array["access"] = false;
                    $data_main_array["watch"] = false;
                    echo json_encode($data_main_array);
                }
            }else {
                $data_main_array["priority"] = array();
                $data_main_array["access"] = false;
                $data_main_array["watch"] = false;
                $data_main_array["staff"] = false;
                echo json_encode($data_main_array);
            }        

        }else{
            $data_main_array["priority"] = array();
            $data_main_array["isLogin"] = false;
            $data_main_array["access"] = false;
            $data_main_array["watch"] = false;
            echo json_encode($data_main_array);
        }
    }
    public function check_exc($identifier){
        if(isset($identifier)) {
            $decstring = str_replace("steam:","",$identifier);
            $decstring = hexdec($decstring);
            // echo $decstring;
            $ch = curl_init("https://steamid.venner.io/raw.php?input=".$decstring);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $decCode = json_decode($data);
            $codeDec = "";
            if(isset($decCode->steamid))
                $codeDec = $decCode->steamid;
            else
                $codeDec = $identifier;
            $result = $this->User_model->check_exc($codeDec,$identifier);
            echo $result;
        }
        else
            echo "false";
    }
    public function is_owned(){
        if((isset($_GET["key"]))&&(isset($_GET["identifier"]))&&(isset($_GET["plate"]))){
            if($_GET["key"]=="bhosdiwalechacha"){
                $owner =  base64_decode($_GET['identifier']);
                $plate = base64_decode($_GET['plate']);
                $res = $this->User_model->is_owned($owner,$plate);
                echo $res;
            }
            else 
                echo "false";
        }else
            echo "false";
    }
    public function get_datastore(){
        if(isset($_GET["key"])&&isset($_GET["name"])){
            if($_GET["key"]=="bhosdiwalechacha"){
                $name = base64_decode($_GET['name']);
                // $name = $_GET["name"];
                $resp = $this->User_model->get_datastore($name);
                echo json_encode($resp);
            }else
                echo json_encode(array());
        }else
            echo json_encode(array());
    }    
    public function get_priority(){
        if(isset($_GET["key"])){
            if($_GET["key"]=="bhosdiwalechacha"){
                $resp = $this->User_model->get_priority();
                echo json_encode($resp);
            }else
                echo json_encode(array());
        }else
            echo json_encode(array());
    }
}