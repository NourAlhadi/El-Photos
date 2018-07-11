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

    public function add_view($photo_id){
        $this->db->where('id',$photo_id);
        $this->db->select('views');
        $views = $this->db->get('photo')->row();
        $views = $views->views;

        $views = $views + 1;

        $this->db->set('views', $views);
        $this->db->where('id', $photo_id);
        $this->db->update('photo');
    }

    public function add_love($user_id,$photo_id){
        $this->db->where('user_id',$user_id)->where('photo_id',$photo_id);
        $query = $this->db->get('user_loves');
        if ($query->num_rows() != 0) return false;

        $data = array(
            "user_id" => $user_id,
            "photo_id" => $photo_id
        );
        $this->db->insert('user_loves',$data);


        $this->db->where('id',$photo_id);
        $this->db->select('loves');
        $loves = $this->db->get('photo')->row();
        $loves = $loves->loves;

        $loves = $loves + 1;

        $this->db->set('loves', $loves);
        $this->db->where('id', $photo_id);
        $this->db->update('photo');
    }


}