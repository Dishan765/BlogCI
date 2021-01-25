<?php
class PostModel extends CI_Model
{

  public function getPost($limit, $start)
  {
    //$query = $this->db->get('Posts');
    $SQLquery = "SELECT Posts.PostID, Posts.content,Posts.Category, User.UserName, Posts.Title, User.Image, User.UserID FROM Posts,User WHERE Posts.UserID = User.UserID ORDER BY TimeStamp DESC LIMIT $start , $limit";
    $query = $this->db->query($SQLquery);
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    }
    return $query->result_array();
    //return $query->result_array();
  }

  public function getNoPosts(){
    $SQLquery = "SELECT Posts.content,Posts.Category, User.UserName, Posts.Title, User.Image, User.UserID FROM Posts,User WHERE Posts.UserID = User.UserID ORDER BY TimeStamp DESC";
    $query = $this->db->query($SQLquery);
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    }
    return $query->num_rows();
  }

  public function getCategory()
  {
    $SQLquery = "SELECT DISTINCT Category FROM Posts";
    $query = $this->db->query($SQLquery);
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    }
    return $query->result_array();
  }

  public function submitPost($userid)
  {
    $data['UserID'] = $userid;
    $data['Title'] = $this->input->post("Title");
    $data['Content'] = $this->input->post("Content");;

    if (!empty($this->input->post("Category")))
      $data['Category'] = $this->input->post("Category");
    else {
      $data['Category'] = $this->input->post("NewCategory");
    }

    $this->db->insert('Posts', $data);
  }

  public function SpecificCategoryModel($category)
  {
    $SQLquery = "SELECT Posts.content,Posts.Category, User.UserName, Posts.Title, User.Image FROM Posts,User WHERE Posts.UserID = User.UserID AND Posts.Category = ? ORDER BY TimeStamp DESC";
    $query = $this->db->query($SQLquery, array($category));
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    }
    return $query->result_array();
  }

  public function saveRegistration($imgData)
  {
    $data['Email'] = $this->input->post("Email");
    $data['UserName'] = $this->input->post("Name");
    $pwd = $this->input->post("pwd");
    $data['Password'] = password_hash($pwd, PASSWORD_DEFAULT);
    $data['Image'] = $imgData;

    $this->db->insert('User', $data);
  }

  public function Login($userName, $pwd)
  {
    $SQLquery = "Select UserID, Email, UserName, Image, Password FROM User WHERE ? = UserName";
    $query = $this->db->query($SQLquery, array($userName));
    $result = $query->row_array();

    if (!empty($result)) {
      if (password_verify($pwd, $result['Password'])) {
        return $result;
      }
      else{
        return NULL;
      }
    } else {
      return NULL;
    }
  }


  public function getNoUserPosts($userid){
    $SQLquery = "SELECT Posts.content,Posts.Category, User.UserName, Posts.Title, User.Image, User.UserID FROM Posts,User WHERE Posts.UserID = User.UserID AND Posts.UserID = $userid ORDER BY TimeStamp DESC";
    $query = $this->db->query($SQLquery);
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    }
    return $query->num_rows();
  }

  public function getUserPost($userid, $start, $limit){
    $SQLquery = "SELECT Posts.PostID, Posts.content,Posts.Category, User.UserName, Posts.Title, User.Image, User.UserID FROM Posts,User WHERE Posts.UserID = User.UserID AND Posts.UserID = $userid ORDER BY TimeStamp DESC LIMIT $limit, $start";
    $query = $this->db->query($SQLquery);
    if (!$query) {
      $error = $this->db->error();
      print_r($error);
    }
    return $query->result_array();
  }

  public function delete($postid){
    $SQLquery = "DELETE FROM Posts WHERE PostID = $postid";
    $query = $this->db->query($SQLquery);
    if($query){
      return TRUE;
    }
    else{
      return FALSE;
    }
  }
  
  public function edit($postid){
    $SQLquery = "SELECT * FROM Posts WHERE PostID = $postid";
    $query = $this->db->query($SQLquery);
    return $query->row_array();
  }
}
