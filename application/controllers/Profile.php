<?php

class Profile extends CI_Controller {

    public function index(){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            redirect('auth/login');
        }
        $data['user'] = $this->ion_auth->user()->row();
        $data['body'] = $this->load->view('profile', $data, true);
        $this->load->view('base',$data);
    }


    public function user($id){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        $data['user'] = $this->ion_auth->user()->row();
        if ($data['user']->id == $id){
            if (! $data['user_logged_in'] ){
                redirect('auth/login');
            }else{
                redirect('profile');
            }
        }


        $request = $this->ion_auth->user($id)->row();
        if (is_null($request)){
            redirect("/");
        }

        $check = $this->relation_model->check_friends($data['user']->id, $request->id);
        $data['friend'] = $check;

        $data['user'] = $request;

        $data['strange'] = true;
        $data['body'] = $this->load->view('profile', $data, true);
        $this->load->view('base',$data);
    }

    public function add($user_id){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            redirect('auth/login');
        }
        $me = $this->ion_auth->user()->row()->id;
        $this->relation_model->follow($me,$user_id);
        redirect("profile/user/".$user_id);
    }

    public function remove($user_id){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            redirect('auth/login');
        }
        $me = $this->ion_auth->user()->row()->id;
        $this->relation_model->unfollow($me,$user_id);
        redirect("profile/user/".$user_id);
    }

    public function change_avatar(){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            redirect('auth/login');
        }


        $config['upload_path']          = './uploads/avatars/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 2028;
        $config['max_height']           = 1024;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            $this->user_logged_in = (bool)$this->ion_auth->logged_in();
            $data["user_logged_in"] = $this->user_logged_in;
            $data['body'] = $this->load->view('change_avatar', $data, true);
            $this->load->view('base',$data);
        }
        else {
            $upload = array('upload_data' => $this->upload->data());
            $name = $upload['upload_data']['file_name'];
            $user = $this->ion_auth->user()->row();
            $id = $user->id;

            $this->ion_auth->change_avatar($id,$name);

            redirect('profile');
        }
    }

    public function remove_avatar(){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            redirect('auth/login');
        }

        $user = $this->ion_auth->user()->row();
        $id = $user->id;

        $this->ion_auth->change_avatar($id,"");

        redirect('profile');
    }

    public function change() {
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            redirect('auth/login');
        }

        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;

        $this->form_validation->set_rules('first_name', 'First name', 'trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if ($this->form_validation->run() === FALSE) {

            $this->user_logged_in = (bool)$this->ion_auth->logged_in();
            $data["user_logged_in"] = $this->user_logged_in;
            $data['body'] = $this->load->view('edit_profile', $data, true);
            $this->load->view('base',$data);

        } else {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );

            if (strlen($this->input->post('password')) >= 6)
                $new_data['password'] = $this->input->post('password');
            $this->ion_auth->update($user->id, $data);


            redirect('profile');
        }

    }

}