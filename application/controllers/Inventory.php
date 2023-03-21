<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Expose-Headers: Access-Control-*');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Allow: GET, POST, PUT, DELETE, OPTIONS, HEAD');

class Inventory extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->helper('string');
		$this->load->helper('url');
		$this->load->library(array(
				'session',
				'form_validation',
			));
		$this->load->model('Inventory_model');
    }
    public function get_house_inventory($steam_id){
        $inventory = $this->Inventory_model->get_house_inventory($steam_id);
        echo json_encode($inventory);
    }
    public function get_trunk_inventory($plate){
        $inventory = $this->Inventory_model->get_trunk_inventory($plate);
        echo json_encode($inventory);
    }
    public function get_inventory($steam_id){
        $inventory = $this->Inventory_model->get_inventory($steam_id);
        echo json_encode($inventory);
    }
	
}