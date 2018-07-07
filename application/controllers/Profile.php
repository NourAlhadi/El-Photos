<?php

class Profile extends CI_Controller {

    public function index(){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            show_404();
            return;
        }
        $data['user'] = $this->ion_auth->user()->row();
        $data['body'] = $this->load->view('profile', $data, true);
        $this->load->view('base',$data);
    }

}