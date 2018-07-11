<?php

// TODO: Try to make every redirection to login reversable

/**
 * Class Photos This is the main controller of anything related to photos!!
 */
class Photos extends CI_Controller{

    /**
     * The index action is the action which will render the trend view as my default index view (Homepage)
     */
    public function index(){

        // Checking if user is logged in (important for navbar)
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;

        // Getting trends from database
        $data['photos'] = $this->photo_model->get_best_photos();

        // Getting user's data
        $data['user'] = $this->ion_auth->user()->row();


        // Loading trends view
        $data['body'] = $this->load->view('trends', $data, true);

        // Setting trends as current active page in navbar
        $data['tact'] = "active";

        // Rendering the basic view with trends template
        $this->load->view('base', $data);
    }

    /**
     * The upload action is the action which will help users upload photos
     */
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


        // Setting roles for the upload form
        $this->form_validation->set_rules('post', 'Post Description', 'trim');


        // Checking if form is submitted
        if ($this->form_validation->run() === FALSE) {

            // If not, render the upload view
            $data['body'] = $this->load->view('upload_photo', $data, true);
            $this->load->view('base',$data);

        } else {

            // If user's photo not uploaded
            if ( ! $this->upload->do_upload('userfile')) {
                // Setup an error message
                $data['errors'] = "Can not upload your photo please try again!! ";

                // Render the view again!!
                $data['body'] = $this->load->view('upload_photo', $data, true);
                $this->load->view('base',$data);
            }
            // Uploaded Successfully
            else {

                // Getting uploaded photo
                $upload = array('upload_data' => $this->upload->data());
                $name = $upload['upload_data']['file_name'];

                // Setting up photo to be inserted in DB
                $data = array(
                    'post' => $this->input->post('post'),
                    'date' => $now = date('Y-m-d H:i:00'),
                    'link' => $name,
                    'uploader' => $user->id,
                    'uploader_name' => $user->first_name .' ' . $user->last_name,
                    'views' => 0,
                    'loves' => 0
                );

                // Insert the photo into the database
                $this->photo_model->insert_photo($data);

                // Redirect to homepage
                redirect('/');
            }


        }


    }
}