<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Register This is the main controller of registration proccess
 */
class Register extends CI_Controller{

    /**
     *  Index is the only action needed for now!!
     */
    public function index(){

        // Setting up form rules
        $this->form_validation->set_rules('first_name', 'First name','trim|required');
        $this->form_validation->set_rules('last_name', 'Last name','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('email','Email','trim|valid_email|required');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');

        // Checking if form is submitted
        if($this->form_validation->run()===FALSE) {

            // If not, reload the view
            $this->user_logged_in = (bool)$this->ion_auth->logged_in();
            $data["user_logged_in"] = $this->user_logged_in;
            $data['body'] = $this->load->view('auth/register', '', true);
            $this->load->view('base',$data);
        }
        else {

            // Getting data from the form
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $first_name,
                'last_name' => $last_name
            );


            // Checking if data is correct: (Unique username, registration completed).
            if($this->ion_auth->check_unique_username($username) && $this->ion_auth->register($username,$password,$email,$additional_data, array())) {

                // Setup a flash message
                $_SESSION['auth_message'] = 'The account has been created. You may now login.';
                $this->session->mark_as_flash('auth_message');

                // Redirect to login
                redirect('auth/login');
            }
            else {
                // Setup a flash message
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');

                // Reload the view
                redirect('register');
            }
        }
    }
}