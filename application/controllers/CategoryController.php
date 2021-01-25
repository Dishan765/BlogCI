<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->database();
    $this->load->model('PostModel');
  }

  public function Category()
  {
    $this->load->view('header');
    $data['category'] = $this->PostModel->getCategory();
    $this->load->view('category', $data);
    $this->load->view('footer');
  }

  public function SpecificCategory($category)
  {
    $this->load->view('header');
    $category = urldecode($category);
    $data['cat'] = $this->PostModel->SpecificCategoryModel($category);
    $this->load->view('SpecificCat', $data);
    $this->load->view('footer');
  }

}
