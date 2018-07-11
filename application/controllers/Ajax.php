<?php

class Ajax extends CI_Controller {

    public function add_view(){
        $photo_id = $this->input->post('photo_id');
        $this->photo_model->add_view($photo_id);
    }

    public function add_love(){
        $photo_id = $this->input->post('photo_id');
        $user_id = $this->input->post('user_id');
        $this->photo_model->add_love($user_id, $photo_id);
    }

    public function remove_love(){
        $photo_id = $this->input->post('photo_id');
        $user_id = $this->input->post('user_id');
        $this->photo_model->remove_love($user_id, $photo_id);
    }
}