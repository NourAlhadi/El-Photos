<?php

class Photo_model extends CI_Model{

    public function get_best_photos(){
        $query = $this->db->order_by("loves", "desc")->get('photo');
        return $query->result();
    }

    public function get_photos(){
        $query = $this->db->get('photo');
        return $query->result();
    }

    public function select_photo($photo_id){
        $this->db->where('id',$photo_id);
        $query = $this->db->get('photo');
        return $query->result();
    }

    public function insert_photo($data){
        $query = $this->db->insert('photo',$data);
    }


}