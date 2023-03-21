<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Expose-Headers: Access-Control-*');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Allow: GET, POST, PUT, DELETE, OPTIONS, HEAD');

class Forum extends CI_Controller {
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
		$this->load->model('Forum_model');
    }
    public function get_forum(){
        $forum = $this->Forum_model->get_forum();
        echo json_encode($forum);
    }
    public function get_comment(){
        $forum = $this->Forum_model->get_comment();
        echo json_encode($forum);
    }
    public function forum_cat(){
        $forum = $this->Forum_model->forum_cat();
        echo json_encode($forum);
    }
    public function forum_post(){
        $user = $this->session->userdata('steamid');
		if($user) {
            $steam_id = dechex($user);
            $postData = json_decode(file_get_contents('php://input'), true);
            if($steam_id == $postData["identifier"]){
                $forum = $this->Forum_model->forum_post($postData);
                echo json_encode($forum);
            }
            else
                echo json_encode(array('resp'=>'error'));
        }
    }
    public function forum_post_by_id($post_id){
        $forum = $this->Forum_model->forum_post_by_id($post_id);
        echo json_encode($forum);
    }
    public function forum_comment_post(){
        $user = $this->session->userdata('steamid');
		if($user) {
            $steam_id = dechex($user);
            $postData = json_decode(file_get_contents('php://input'), true);
            if($steam_id == $postData["identifier"]){
                $forum = $this->Forum_model->forum_comment_post($postData);
                echo json_encode($forum);
            }
            else
                echo json_encode(array('resp'=>'error'));
        }
    }
    public function forum_post_delete(){
        $user = $this->session->userdata('steamid');
		if($user) {
            $steam_id = dechex($user);
            $postData = json_decode(file_get_contents('php://input'), true);
            if($steam_id == $postData["identifier"]){
                $forum = $this->Forum_model->forum_post_delete($postData["id"],$postData["comment_id"],$postData["identifier"]);
                echo json_encode($forum);
            }
            else
                echo json_encode(array('resp'=>'error')); 
        }
    }
}