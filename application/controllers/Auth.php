<?php

/* * ***
 * Version: V1.0.1
 *
 * Description of Auth Controller
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Auth extends CI_Controller 
{
 
    public function __construct() 
    {
        parent::__construct();
        //load model
        $this->load->model('Auth_model','auth');
        $this->load->library('form_validation');
    }
 
    // user profile
    public function index() {
        if ($this->session->userdata('ci_session_key_generate') == FALSE)
         {
            redirect('signin'); // the user is not logged in, redirect them!
        } else 
        {
            $data = array();
            $data['metaDescription'] = 'User Profile';
            $data['metaKeywords'] = 'User Profile';
            $data['title'] = "User Profile - TechArise";
            $data['breadcrumbs'] = array('Profile' => '#');
            $sessionArray = $this->session->userdata('ci_seesion_key');
            $this->auth->setUserID($sessionArray['user_id']);
            $data['userInfo'] = $this->auth->getUserDetails();
            //$this->page_construct('auth/index', $data);
            $this->load->view('auth/index', $data);
        }
    }
 
    // registration method
    public function register() 
    {
        $data = array();
        $data['metaDescription'] = 'New User Registration';
        $data['metaKeywords'] = 'New User Registration';
        $data['title'] = "Registration - TechArise";
        $data['breadcrumbs'] = array('Registration' => '#');
        //$this->page_construct('auth/register', $data);
        $this->load->view('auth/register',$data);
    }
 
   
     // action create user method
    public function actionCreate()
     {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
       
        if ($this->form_validation->run() == FALSE)
         {
            $this->register();
        } else
         {
            $firstName = $this->input->post('first_name');
            $lastName = $this->input->post('last_name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $contactNo = $this->input->post('contact_no');
           
            //$timeStamp = time();
           // $status = 0;
            //$verificationCode = uniqid();
            //$verificationLink = site_url() . 'signin?usid=' . urlencode(base64_encode($verificationCode));
           // $userName = $this->mail->generateUnique('users', trim($firstName . $lastName), 'user_name', NULL, NULL);
            $this->auth->setUserName($userName);
            $this->auth->setFirstName(trim($firstName));
            $this->auth->setLastName(trim($lastName));
            $this->auth->setEmail($email);
            $this->auth->setPassword($password);
            $this->auth->setContactNo($contactNo);
           
           // $chk = $this->auth->create();
           // if ($chk === TRUE)
           // /// {
                //$this->load->library('encrypt');
                //$mailData = array('topMsg' => 'Hi', 'bodyMsg' => 'Congratulations, Your registration has been successfully submitted.', 'thanksMsg' => SITE_DELIMETER_MSG, 'delimeter' => SITE_DELIMETER, 'verificationLink' => $verificationLink);
                //$this->mail->setMailTo($email);
                //$this->mail->setMailFrom(MAIL_FROM);
                //$this->mail->setMailSubject('User Registeration!');
               // $this->mail->setMailContent($mailData);
               // $this->mail->setTemplateName('verification');
               // $this->mail->setTemplatePath('mailTemplate/');
                //$chkStatus = $this->mail->sendMail(MAILING_SERVICE_PROVIDER);
                //if ($chkStatus === TRUE)
                // {
                 //   redirect('signin');
                //} else
                // {
                //    echo 'Error';
               // }
           // }
           ///  else
            // {
                
            //}
        }
    }}
 
    
 
   