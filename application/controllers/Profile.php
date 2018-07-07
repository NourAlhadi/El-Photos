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

    public function change_avatar(){
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 2028;
        $config['max_height']           = 1024;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);

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
        $user = $this->ion_auth->user()->row();
        $id = $user->id;

        $this->ion_auth->change_avatar($id,"");

        redirect('profile');
    }

    public function change() {
        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;

        $this->load->library('form_validation');
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