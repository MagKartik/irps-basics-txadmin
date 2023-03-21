<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Forum_model extends CI_Model
{
    public function get_forum(){
        $this->db->select('*');
        $this->db->from('forum_post');
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_comment(){
        $this->db->select('*');
        $this->db->from('forum_comment');
        $this->db->order_by('post_date','desc');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function forum_cat(){
        $this->db->select('*');
        $this->db->from('forum_cat');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function forum_post($array){
        if($this->db->insert('forum_post',$array)){
            $id = $this->db->insert_id();
            if($id){
                return array('resp'=>'success');
            }
        }else{
            return array('resp'=>'error');
        }
    }


    public function forum_post_by_id($post_id){
        $this->db->select('*');
        $this->db->from('forum_post');
        $this->db->where('comment_id', $post_id);
        $query1 = $this->db->get();
        $result1 = $query1->result();
        $main_array["post"] = $result1[0];

        $this->db->select('*');
        $this->db->from('forum_comment');
        $this->db->where('post_id', $post_id);
        $this->db->order_by('post_date','desc');
        $query2 = $this->db->get();
        $result2 = $query2->result();
        $main_array["comment"] = $result2;

        return $main_array;
    }




    public function forum_post_delete($id,$comment_id,$steam_id){
        $this->db->where('id', $id);
        $this->db->where('comment_id', $comment_id);
        $this->db->where('identifier', $steam_id);
        $this->db->delete('forum_post');
        return array('resp'=>'success');  
    }
    public function forum_comment_post($array){
        if($this->db->insert('forum_comment',$array)){
            $id = $this->db->insert_id();
            if($id){
                return array('resp'=>'success');
            }
        }else{
            return array('resp'=>'error');
        }

    }


}