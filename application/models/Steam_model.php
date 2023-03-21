<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once('assets/steamauth/steamauth.php');
require_once('assets/steamauth/openid.php');
class Steam_model extends CI_Model
{
    public function create_id($steamId){
        $steam_id = array();
        $steam_id[0] = dechex($steamId);
        $steam_id[1] = "steam:".dechex($steamId);
        $steam_id[2] = "Char1:".dechex($steamId);
        $steam_id[3] = "Char2:".dechex($steamId);
        $steam_id[4] = "Char3:".dechex($steamId);
        $steam_id[5] = "Char4:".dechex($steamId);
        $steam_id[6] = "Char5:".dechex($steamId);
        $steam_id[7] = "Char6:".dechex($steamId);
        $steam_id[8] = "Char7:".dechex($steamId);
        return $steam_id;
    }
}