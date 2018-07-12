<?php

// TODO: Try to make every redirection to login reversable

/**
 * Class Profile This is the main controller of anything related to user profile!!
 */
class Profile extends CI_Controller {

    /**
     * The index action is the action which will view the profile of user -- if logged in --
     */
    public function index(){
        // Checking if user is logged in, otherwise redirect to login page
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            $_SESSION['redirect'] = '/profile';
            $this->session->mark_as_flash('redirect');

            redirect('auth/login');
        }

        // Rendering the profile view
        $data['user'] = $this->ion_auth->user()->row();
        $data['body'] = $this->load->view('profile', $data, true);
        $this->load->view('base',$data);
    }

    /**
     * The User{id} action is the action which is in control of other users profiles
     *
     * @param $id, The requested user id.
     */
    public function user($id){

        // Checking if user is logged in and getting his row data
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        $data['user'] = $this->ion_auth->user()->row();

        // if the user is requesting his own page redirect him to profile
        if ($data['user_logged_in']){
            if ($data['user']->id == $id ){
                redirect('profile');
            }
        }

        // Getting requested user's data, or redirect to index if user not found
        // TODO: show error message instead of redirect
        $request = $this->ion_auth->user($id)->row();
        if (is_null($request)){
            redirect("/");
        }

        // Checking relation between the logged in user and the requested user if any
        $check = $data['user'] != null && $this->relation_model->check_friends($data['user']->id, $request->id);
        $data['friend'] = $check;

        // Setting up requested user to be rendered on view
        $data['user'] = $request;

        // Setting up that this is a strange user's profile, not mine!!
        $data['strange'] = true;

        // Rendering the requested user's profile view
        $data['body'] = $this->load->view('profile', $data, true);
        $this->load->view('base',$data);
    }

    /**
     * The Add User{id} action is the action which is in control of adding other users to my community
     *
     * @param $user_id, The user's id to be added
     */
    public function add($user_id){

        // Checking if request comes from logged in user, otherwise redirect to login
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            $_SESSION['redirect'] = '/profile/user/' . $user_id;
            $this->session->mark_as_flash('redirect');

            redirect('auth/login');
        }

        // Getting my id
        $me = $this->ion_auth->user()->row()->id;

        // Adding relation to database, and reload the view
        $this->relation_model->follow($me,$user_id);
        redirect("profile/user/".$user_id);
    }

    /**
     * The Remove User{id} action is the action which is in control of removing other users from my community
     *
     * @param $user_id, The user's id to be removed
     */
    public function remove($user_id){

        // Checking if request comes from logged in user, otherwise redirect to login
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            $_SESSION['redirect'] = '/profile/user/'.$user_id;
            $this->session->mark_as_flash('redirect');

            redirect('auth/login');
        }

        // Getting my id
        $me = $this->ion_auth->user()->row()->id;

        // Removing relation from database, and reload the view
        $this->relation_model->unfollow($me,$user_id);
        redirect("profile/user/".$user_id);
    }

    /**
     * The Change Avatar action is the action which allows users to change their profile pictures
     */
    public function change_avatar(){

        // Checking if user is logged in, otherwise redirect to login page
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            $_SESSION['redirect'] = '/profile';
            $this->session->mark_as_flash('redirect');

            redirect('auth/login');
        }

        // Setting up upload library configuration
        $config['upload_path']          = './uploads/avatars/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 2028;
        $config['max_height']           = 1024;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')) {
            // DONOT REMOVE THIS VARIABLE, NEEDED FOR DEBUGGING
            //$error = array('error' => $this->upload->display_errors());

            // Reload the view
            $data['body'] = $this->load->view('change_avatar', $data, true);
            $this->load->view('base',$data);
        }
        else {

            // Finalize uploading and saving to database
            $upload = array('upload_data' => $this->upload->data());
            $name = $upload['upload_data']['file_name'];
            $user = $this->ion_auth->user()->row();
            $id = $user->id;

            $this->ion_auth->change_avatar($id,$name);

            // Redirect to profile after finish
            redirect('profile');
        }
    }

    /**
     * The Change Avatar action is the action which allows users to remove their profile pictures
     */
    public function remove_avatar(){

        // Checking if user is logged in, otherwise redirect to login page
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            $_SESSION['redirect'] = '/profile';
            $this->session->mark_as_flash('redirect');

            redirect('auth/login');
        }

        // Removing avatar from user and update database
        $user = $this->ion_auth->user()->row();
        $id = $user->id;

        $this->ion_auth->change_avatar($id,"");

        // Redirect to profile after finish
        redirect('profile');
    }

    /**
     * The Change action is the action which allows users to change their profiles
     */
    public function change() {

        // Checking if user is logged in, otherwise redirect to login page
        $this->user_logged_in = (bool)$this->ion_auth->logged_in();
        $data["user_logged_in"] = $this->user_logged_in;
        if (!$this->user_logged_in){
            $_SESSION['redirect'] = '/profile/change';
            $this->session->mark_as_flash('redirect');

            redirect('auth/login');
        }

        // Getting current user's data
        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;

        // Setting up form rules
        $this->form_validation->set_rules('first_name', 'First name', 'trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        // Checking if form is submitted
        if ($this->form_validation->run() === FALSE) {

            // Reload the view
            $data['body'] = $this->load->view('edit_profile', $data, true);
            $this->load->view('base',$data);

        } else {

            // Setting up data to be saved
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );

            // Checking if new password is more than 6 chars.
            if (strlen($this->input->post('password')) >= 6)
                $new_data['password'] = $this->input->post('password');

            // Saving data to database
            $this->ion_auth->update($user->id, $data);

            // Redirect to profile
            redirect('profile');
        }

    }

}