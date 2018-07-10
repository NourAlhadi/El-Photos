<?php

class Photos extends CI_Controller{

    public function index(){
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        $data['photos'] = $this->photo_model->get_best_photos();
        $data['body'] = $this->load->view('trends', $data, true);
        $data['tact'] = "active";

        $this->load->view('base', $data);
    }

    public function upload(){
        // Checking if user logged in / if not redirect to login page
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        $data["uact"] = "active";
        if (!$this->user_logged_in){
            redirect('auth/login');
        }

        // getting user info
        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;


        // setting up upload parameter's
        $config['upload_path']          = './uploads/posts/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 2028;
        $config['max_height']           = 1024;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('post', 'Post Description', 'trim');

        if ($this->form_validation->run() === FALSE) {

            $data['body'] = $this->load->view('upload_photo', $data, true);
            $this->load->view('base',$data);

        } else {
            if ( ! $this->upload->do_upload('userfile')) {
                $data['errors'] = "Can not upload your photo please try again!! ";
                $data['body'] = $this->load->view('upload_photo', $data, true);
                $this->load->view('base',$data);
            }
            else {
                $upload = array('upload_data' => $this->upload->data());
                $name = $upload['upload_data']['file_name'];

                $data = array(
                    'post' => $this->input->post('post'),
                    'date' => $now = date('Y-m-d H:i:00'),
                    'link' => $name,
                    'uploader' => $user->id,
                    'uploader_name' => $user->first_name .' ' . $user->last_name,
                    'views' => 0,
                    'loves' => 0
                );

                $this->photo_model->insert_photo($data);


                redirect('/');
            }


        }


    }
}