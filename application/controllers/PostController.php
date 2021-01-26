<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostController extends CI_Controller
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



  public function CreatePost()
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('LogIn');
    }


    $this->load->view('header');

    /*Validation Rules */
    $this->form_validation->set_rules('Title', 'Title', 'required|min_length[3]');
    $this->form_validation->set_rules('Content', 'Content', 'required|min_length[15]');
    $this->form_validation->set_rules('Category', 'Category', 'callback_CategoryCheck');
    $this->form_validation->set_rules('NewCategory', 'Category', 'callback_CategoryCheck|min_length[3]');

    if ($this->form_validation->run() == FALSE) {
      $data['category'] = $this->PostModel->getCategory();
      $this->load->view('createPost', $data);
    } else {
      $data['category'] = $this->PostModel->submitPost($this->session->userdata('userID'));

      $this->session->set_flashdata('post_created', 'Post created sucessfully.');
      //$this->load->view('PostUploaded', compact('msg'));
      redirect('index');
      //$this->load->view('createPost', $data);
    }
    $this->load->view('footer');
  }

  public function CategoryCheck($cat, $newCat)
  {
    if ($this->input->post("hide") == 'hide') {
      if (empty($this->input->post("NewCategory"))) {
        $this->form_validation->set_message('CategoryCheck', 'Enter a new category.');
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      if (empty($this->input->post("Category")) && empty($this->input->post("NewCategory"))) {
        $this->form_validation->set_message('CategoryCheck', 'Choose an existing Category OR Add a new one.');
        return FALSE;
      } else if (!empty($this->input->post("Category")) && !empty($this->input->post("NewCategory"))) {
        $this->form_validation->set_message('CategoryCheck', 'Choose an existing Category OR Add a new one.NOT BOTH.');
        return FALSE;
      } else {
        return TRUE;
      }
    }
  }

  public function userPost()
  {
    $userid = $this->session->userdata('userID');
    $this->load->view('header');

    $config['base_url'] = base_url() . 'userPost';
    $config['total_rows'] = $this->PostModel->getNoUserPosts($userid);
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


    if ($this->uri->segment(2) == 0) {
      $page = 0;
    } else {
      $page = $this->uri->segment(2);
    }

    $data['record'] = $this->PostModel->getUserPost($userid, $config['per_page'], $page);

    $this->load->view('Userpost', $data);
    $this->load->view('footer');
  }

  public function Delete($postid)
  {

    if ($this->PostModel->delete($postid)) {
      $this->session->set_flashdata('post_del', 'Post deleted sucessfully.');
      redirect('userPost');
    }
  }

  public function Edit($postid)
  {
    $this->load->view('header');

    $record = $this->PostModel->getSpecificPost($postid);
    $category['cat'] = $this->PostModel->getCategory();
    $data = array_merge($record, $category);

    $this->form_validation->set_rules('Title', 'Title', 'required|min_length[3]');
    $this->form_validation->set_rules('Content', 'Content', 'required|min_length[15]');
    $this->form_validation->set_rules('Category', 'Category', 'callback_ExistCategoryCheck');
    $this->form_validation->set_rules('NewCategory', 'Category', 'callback_ExistCategoryCheck|min_length[3]');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('editPost', $data);
    } else {
      if ($this->PostModel->edit($postid)) {
        $this->session->set_flashdata('post_edit', 'Post updated sucessfully.');
        redirect('userPost');
      }
    }

    $this->load->view('footer');
  }

  public function ExistCategoryCheck()
  {
    if (empty($this->input->post("Category")) && empty($this->input->post("NewCategory"))) {
      $this->form_validation->set_message('ExistCategoryCheck', 'Choose an existing Category OR Add a new one.');
      return FALSE;
    } else if (!empty($this->input->post("Category")) && !empty($this->input->post("NewCategory"))) {
      $this->form_validation->set_message('ExistCategoryCheck', 'Choose an existing Category OR Add a new one.NOT BOTH.');
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
