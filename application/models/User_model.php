<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class User_model extends CI_Model
{
    public function get_user_info($steam_array){
        $this->db->select('id');
        $this->db->select('identifier');
        $this->db->select('money');
        $this->db->select('name');
        $this->db->select('job');
        $this->db->select('money');
        $this->db->select('bank');
        $this->db->select('status');
        $this->db->select('firstname');
        $this->db->select('lastname');
        $this->db->select('loadout');
        $this->db->select('phone_number');
        $this->db->select('is_dead');
        foreach ($steam_array as $steam_id){
            $this->db->or_where('identifier',$steam_id);
        }
        $this->db->from('users');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_server_role($steam_id){
        $this->db->select('role');
        $this->db->select('identity');
        $this->db->select('access');
        $this->db->from('server_role');
        $this->db->where('identifier', $steam_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_priority_info($steamid,$steam_id1){
        $this->db->select('steam');
        $this->db->select('power');
        $this->db->select('end_time');
        $this->db->from('priorityqueue');
        $this->db->where('steam', $steamid);
        $this->db->or_where('steam', $steam_id1);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_user_properties($steamid){
        $this->db->select('name');
        $this->db->from('owned_properties');
        $this->db->where('owner', $steamid);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_user_vehicles($steamid){
        $this->db->select('plate');
        $this->db->from('owned_vehicles');
        $this->db->where('owner', $steamid);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_vehicles_categories($cat){
        $this->db->select('name');
        if($cat=="xclu"){
            $this->db->from('x_vehicle_categories');
        }else{
            $this->db->from('vehicle_categories');
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_vehicles_list($q,$cat){
        $this->db->select('*');
        $this->db->like('name', $q);
        if($cat=="xclu"){
            $this->db->from('x_vehicles');
        }else{
            $this->db->from('vehicles');
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_banlist(){
        $this->db->select('identifier');
        $this->db->from('banlist');
        $this->db->where('permanent', 1);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function priority_info(){
        $this->db->select('*');
        $this->db->from('priorityqueue');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_staff_token(){
        $this->db->select('*');
        $this->db->from('staff_magagement');
        $this->db->where('delete_flag', 0);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function set_staff_token($postData){
        if($this->db->insert('staff_magagement',$postData)){
            $id = $this->db->insert_id();
            if($id)
                return 'success';
        }else
            return 'error';
    }
    public function update_staff_token($postData){
        $this->db->where('id', $postData["id"]);
        $this->db->update('staff_magagement',array("flag"=>$postData["flag"],"id"=>$postData["id"]));
        return 'success';
    }
    public function delete_staff_token($postData){
        $this->db->where('id', $postData["id"]);
        $this->db->update('staff_magagement',array("delete_reason"=>$postData["delete_reason"],"delete_flag"=>1));
        return 'success';
    }

    public function priority_check($steamid,$q){
        $this->db->select('steam');
        $this->db->select('power');
        $this->db->select('end_time');
        $this->db->from('priorityqueue');
        $this->db->where('steam', $steamid);
        $this->db->or_where('steam',$q);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            $row1 = $result[0];
            $arr = array();
            if($row1->end_time >= time()){
                $arr['level'] = (int)$row1->power;
                $arr['avail'] = true;
            }else{
                $arr['level'] = 0;
                $arr['avail'] = false;
            }
            return $arr;
        }else{
            $data = array();
            $data['level'] = 0;
            $data['avail'] = false;
            return $data;
        }
    }
    public function foregin_whitelist($steamid){
        $this->db->select('*');
        $this->db->from('foregin_whitelist');
        $this->db->where('identifier', $steamid);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            return "true";
        }else{
            return "false";
        }
    }
    public function plate_avail($plate){
        $this->db->select('owner');
        $this->db->from('owned_vehicles');
        $this->db->where('plate', $plate);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            return false;
        }else{
            return true;
        }
    }
    public function phone_avail($phone){
        $this->db->select('identifier');
        $this->db->from('users');
        $this->db->where('phone_number', $phone);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            return false;
        }else{
            return true;
        }
    }
    public function get_players($q){
        $like_array = array('name'         => $q,
                            'firstname'    => $q,
                            'lastname'     => $q,
                            'identifier'   => $q,
                            'phone_number' => $q);
        $this->db->select('name');
        $this->db->select('firstname');
        $this->db->select('lastname');
        $this->db->select('identifier');
        $this->db->select('money');
        $this->db->select('bank');
        $this->db->select('job');
        $this->db->select('status');
        $this->db->select('phone_number');
        $this->db->select('loadout');
        $this->db->select('is_dead');
        $this->db->from('users');
        $this->db->or_like($like_array);
        $this->db->limit(15);  
        $query = $this->db->get();
        $result = $query->result();
        return $result;
        if(count($result)>0){
            return $result;
        }
        else{
            $this->db->select('owner');
            $this->db->select('type');
            $this->db->from('owned_vehicles');
            $this->db->where('plate', $q);
            $query1 = $this->db->get();
            $result1 = $query1->result();
            return $result1;
        }
    }    

    public function set_dead_or_alive($postData){
        $this->db->set('is_dead', $postData['dead']);  
        $this->db->where('identifier', $postData['identifier']);
        $this->db->update('users');
        return 'success';
    }

    public function set_vehicle_money($postData){
        if($postData["isExclusive"]==true){
            $this->db->set('price', $postData["setMoney"]);  
            $this->db->where('model', $postData["model"]);
            $this->db->update('x_vehicles');
            return 'success';
        }
        else{
            $this->db->set('price', $postData["setMoney"]);  
            $this->db->where('model', $postData["model"]);
            $this->db->update('vehicles');
            return 'success';
        }            
    }

    public function change_mobile($new, $old){
        $this->db->select('phone_number');
        $this->db->from('users');
        $this->db->where('phone_number', $new);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0)
            return 'error';
        else{
            $this->db->set('phone_number', $new);  
            $this->db->where('phone_number', $old);
            $this->db->update('users');
            return 'success';
        }
    }
    public function set_priority($postData){
        $time_s = date('d-m-Y H:i:s');
        $array = array('steam'=>$postData["steam"],
                        'name'=>$postData["name"],
                        'power'=>$postData["power"],
                        'start_time'=>$postData["start_time"],
                        'add_on'=>$time_s,
                        'end_time'=>$postData["end_time"],
                        'amount_paid'=>$postData["amount_paid"]
                    );
        $this->db->select('*');
        $this->db->from('priorityqueue');
        $this->db->where('steam', $postData["steam"]);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            $this->db->where('steam', $postData["steam"]);
            $this->db->delete('priorityqueue');
            if($this->db->insert('priorityqueue',$array)){
                $id = $this->db->insert_id();
                if($id)
                    return 'success';
            }else
                return 'error';
            return 'success';
        }
        else{
            if($this->db->insert('priorityqueue',$array)){
                $id = $this->db->insert_id();
                if($id)
                    return 'success';
            }else
                return 'error';
        }
    }

    public function delete_house($postData){
        $this->db->where('name', $postData["name"]);
        $this->db->where('owner', $postData["owner"]);
        $this->db->delete('owned_properties');
        return 'success';
    }
    public function delete_priority($postData){
        $this->db->where('steam', $postData["steam_id"]);
        $this->db->delete('priorityqueue');
        return 'success';
    }

    public function delete_car($plate){
        $this->db->where('plate', $plate);
        $this->db->delete('owned_vehicles');
        return 'success';
    }

    public function set_plate_avail($postData){
        $this->db->select('vehicle');
        $this->db->from('owned_vehicles');
        $this->db->where('plate', $postData["old"]);
        $query = $this->db->get();
        $result = $query->result();
        $dat_array = $result[0];
        $plate_data = json_decode($dat_array->vehicle,true);
        $plate_data["plate"] = $postData["new"];
        $encode_plate_details = json_encode($plate_data);

        $this->db->where('plate', $postData["old"]);
        $this->db->update('owned_vehicles',array("plate"=>$postData['new'],"vehicle"=>$encode_plate_details));

        $this->db->set('plate', $postData["new"]);  
        $this->db->where('plate', $postData["old"]);
        $this->db->update('trunk_inventory');

        return 'success';
    }
    public function check_exc($steam64, $identifier){
        $this->db->select('steam');
        $this->db->select('power');
        $this->db->select('end_time');
        $this->db->from('priorityqueue');
        $this->db->where('steam', $steam64);
        $this->db->or_where('steam', $identifier);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            $row = $result[0];
            if($row->end_time >=time()){
                $level = (int)($row->power);
                if($level > 5)
                    return "true";
                else
                    return "false";
            }else
                return "false";
        }else
            return "false";
    }
    public function is_owned($owner,$plate){
        $this->db->select('owner');
        $this->db->from('owned_vehicles');
        $this->db->where('owner', $owner);
        $this->db->where('plate', $plate);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            return "true";
        }
        else
            return "false";
    }

    public function get_datastore($name){
        $this->db->select('*');
        $this->db->from('datastore_data');
        $this->db->where('name', $name);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            return $result;
        }
        else
            return array();
    }
    
        public function get_priority(){
        $this->db->select('*');
        $this->db->from('priorityqueue');
        // $this->db->where('name', $name);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result)>0){
            foreach ( $result as $row1) {
                if($row1->end_time >= time()){
                    $arr[$row1->steam] = (int)$row1->power;
                }
            }
            return $arr;
        }
        else
            return array();
    }
}