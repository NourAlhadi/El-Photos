<?php

class Main extends CI_Controller{

    public function index (){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        $data['body'] = $this->load->view('index', '', true);
        $data['tact'] = "active";
        $this->load->view('base',$data);
    }

}