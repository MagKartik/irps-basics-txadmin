<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Expose-Headers: Access-Control-*');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Allow: GET, POST, PUT, DELETE, OPTIONS, HEAD');

class Steam extends CI_Controller {
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
	}	
	public function login(){
		try {
			require 'assets/steamauth/SteamConfig.php';
			$openid = new LightOpenID($steamauth['domainname']);
			
			if(!$openid->mode) {
				$openid->identity = 'https://steamcommunity.com/openid';
				header('Location: ' . $openid->authUrl());
			} elseif ($openid->mode == 'cancel') {
				echo 'User has canceled authentication!';
			} else {
				if($openid->validate()) { 
					$id = $openid->identity;
					$ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
					preg_match($ptn, $id, $matches);
					
					$_SESSION['steamid'] = $matches[1];
					if (!headers_sent()) {
						header('Location: '.$steamauth['loginpage']);
						exit;
					} else {
						?>
						<script type="text/javascript">
							window.location.href="<?=$steamauth['loginpage']?>";
						</script>
						<noscript>
							<meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />
						</noscript>
						<?php
						exit;
					}
				} else {
					echo "User is not logged in.\n";
				}
			}
		} catch(ErrorException $e) {
			echo $e->getMessage();
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}

	public function user_data(){
		$user = $this->session->userdata('steamid');
		if(!isset($user)) {
			$data1 = array();
			$data1['isLogin'] = false;
			echo json_encode($data1);
		}  else {
			include ('assets/steamauth/userInfo.php');
			$data1 = array();
			$data1['isLogin'] = true;
			$data1['details'] = $steamprofile;
			echo json_encode($data1);
		}    		
	}
}