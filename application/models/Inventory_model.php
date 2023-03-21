<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory_model extends CI_Model
{
    public function get_house_inventory($steam_id){
        $this->db->select('inventory_name');
        $this->db->select('name');
        $this->db->select('count');
        $this->db->where('owner', $steam_id);
        $this->db->from('addon_inventory_items');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_inventory($steam_id){
        $this->db->select('item');
        $this->db->select('count');
        $this->db->where('count >', $steam_id);
        $this->db->where('identifier', $steam_id);
        $this->db->from('user_inventory');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_trunk_inventory($plate){
        $this->db->select('data');
        $this->db->where('plate', $plate);
        $this->db->from('trunk_inventory');
        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }
}