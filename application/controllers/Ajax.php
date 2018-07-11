<?php

class Ajax extends CI_Controller {

    public function add_view(){
        $photo_id = $this->input->post('photo_id');
        $this->photo_model->add_view($photo_id);
    }

    public function add_love(){
        $photo_id = $this->input->post('photo_id');
        $user_id = $this->input->post('user_id');
        $ret = $this->photo_model->add_love($user_id, $photo_id);
        if ($ret == false) {
            print json_encode(array("status" => "fail", "message" => "Already loved"));
        } else {
            print json_encode(array("status" => "success", "message" => "Good"));
        }
    }
}