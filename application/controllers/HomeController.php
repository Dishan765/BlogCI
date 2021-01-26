<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->database();
    $this->load->model('PostModel');
  }

  public function index()
  {

    $this->load->view('header');
    

    $config['base_url'] = base_url().'index';
    $config['total_rows'] = $this->PostModel->getNoPosts();
    $config['per_page'] = 2;
    
    /*For bootstrap 4 */
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['first_link']       = false;
    $config['last_link']        = false;
    $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul>';
    $config['attributes']       = ['class' => 'page-link'];
    $config['first_tag_open']   = '<li class="page-item">';
    $config['first_tag_close']  = '</li>';
    $config['prev_tag_open']    = '<li class="page-item">';
    $config['prev_tag_close']   = '</li>';
    $config['next_tag_open']    = '<li class="page-item">';
    $config['next_tag_close']   = '</li>';
    $config['last_tag_open']    = '<li class="page-item">';
    $config['last_tag_close']   = '</li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['num_tag_open']     = '<li class="page-item">';
    $config['num_tag_close']    = '</li>';
    
    $this->pagination->initialize($config);
    
    if($this->uri->segment(2) == 0){
      $page = 0;
    }
    else{
      $page = $this->uri->segment(2);
    }
    
    $data['record'] = $this->PostModel->getPost($config['per_page'], $page);
    //$data["links"] = $this->pagination->create_links();
    $this->load->view('home', $data);
    $this->load->view('footer');
  }


  public function LogIn()
  {
    $this->load->view('header');

    $this->form_validation->set_rules('Name', 'Name', 'required');
    $this->form_validation->set_rules('pwd', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('Login');
    } else {
      $data = $this->PostModel->Login($this->input->post('Name'), $this->input->post('pwd'));
      
      if ($data == NULL) {   
        //var_dump($data);
        $this->session->set_flashdata('loginErr', 'Wrong Username or password.');
        redirect('LogIn');
      } else {

        $newdata = array(
          'username'  => $data['UserName'],
          'userID'    => $data['UserID'],
          'logged_in' => TRUE
        );

        $this->session->set_userdata($newdata);

        $this->session->set_flashdata('login', 'You are now logged in.');
        redirect('index');
      }
    }
    $this->load->view('footer');
  }


  public function Logout()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('LogIn');  
    }
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('userID');
    $this->session->unset_userdata('logged_in');

    $this->session->set_flashdata('logout', 'You are now logged out.');
    redirect('index');
  }

  public function Registration()
  {
    $this->load->view('header');

    $config['upload_path'] = './Uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 2000;
    $config['max_width'] = 1500;
    $config['max_height'] = 1500;

    $this->load->library('upload', $config);

    /*VALIDATION RULES */
    $this->form_validation->set_rules('Name', 'Name', 'required|callback_check_duplicate_name');
    $this->form_validation->set_rules('Email', 'Email', 'required|valid_email|callback_check_duplicate_mail');
    $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[5]');
    //$this->form_validation->set_rules('img', 'Imgage', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('Registration');
    } else {
      if (! $this->upload->do_upload('img')) {
        //$error = array('error' => $this->upload->display_errors());
        //$this->load->view('Registration', $error);
        $data =  $this->upload->data();
        $fileName = $config['upload_path'] . "Default.jpeg";
        $this->PostModel->saveRegistration($fileName);

        $this->session->set_flashdata('registered', 'You are now registered and can Log In.');
        redirect('LogIn');
      } else {
        $data =  $this->upload->data();
        $fileName = $config['upload_path'] . $data['file_name'];
        $this->PostModel->saveRegistration($fileName);

        $this->session->set_flashdata('registered', 'You are now registered and can Log In.');
        redirect('LogIn');
      }
    }
    $this->load->view('footer');
  }

  public function check_duplicate_name($Name)
  {
    $SQLquery = "SELECT UserName FROM User WHERE UserName = ?";
    $query = $this->db->query($SQLquery, array($Name));
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    } else if ($query->num_rows() > 0) {
      $this->form_validation->set_message('check_duplicate_name', $Name . ' belongs to an existing account');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function check_duplicate_mail($Email)
  {
    $SQLquery = "SELECT Email FROM User WHERE Email = ?";
    $query = $this->db->query($SQLquery, array($Email));
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    } else if ($query->num_rows() > 0) {
      $this->form_validation->set_message('check_duplicate_mail', $Email . ' belongs to an existing account');
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
