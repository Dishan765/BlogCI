<?php

if ($this->session->flashdata('post_del')) {
  echo "<h3 class='alert alert-success'>" . $this->session->flashdata('post_del') . "</h3>";
}

if ($this->session->flashdata('post_edit')) {
  echo "<h3 class='alert alert-success'>" . $this->session->flashdata('post_edit') . "</h3>";
}
?>


</br>
<div class="row justify-content-center">
  <a class="btn btn-primary btn-lg" href="<?php echo site_url("CreatePost") ?>" role="button">Create a Story</a>
</div>
</br>
</br>

<?php
foreach ($record as $key => $value) {
  echo "<div class=\"card text-white bg-success mb-3 mx-auto\" style=\"max-width: 75%;\">";
  echo "<div class=\"card-header \">";
  echo "<img src='" . base_url() . $value['Image'] . "' alt=\"Profile Picture\" class=\"rounded-circle img-thumbnail align-self-start mr-3\" style=\"height:auto; width:80px;\">";
  echo " " . $value['UserName'];
  echo "<div class = \" float-right\"> Tag:" . $value['Category'] . "</div> </div>";
  echo "<div class=\"card-body\">";
  echo "<h4 class=\"card-title\">" . $value['Title'] . "</h4>";
  echo "<p class=\"card-text\">" . $value['content'] . "</p>";
  echo "</div>";
  echo "</div>";


  echo "<div class=\"row justify-content-center\">";
  echo "<a class=\"md-4 btn btn-primary btn-lg\" href=\"" . base_url() . "Edit/" . $value['PostID'] . "\" role=\"button\">Edit</a>";
  echo "<a class=\"offset-1 btn btn-primary btn-lg\" href=\"" . base_url() . "Delete/" . $value['PostID']  . "\" role=\"button\">Delete</a>";
  echo "</div>";
  echo "<br/>";
}
?>

<div class="pagination_links">
  <?php echo "<br/>" . $this->pagination->create_links(); ?>
</div>