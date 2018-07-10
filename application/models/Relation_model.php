<?php

class Relation_model extends CI_Model {

    public function check_friends($me, $him){
        $check = $this->db->get_where('follow',array("me" => $me,"him"=> $him));
        if ($check->num_rows() != 0) return true;
        return false;
    }

    public function follow($me,$him){
        $data = array(
            'me'=>$me,
            'him'=>$him
        );

        $this->db->insert('follow',$data);
    }

    public function unfollow($me,$him){
        $this->db->where('me', $me)->where('him', $him);
        $this->db->delete('follow');
    }

}