<br />
<div class="row justify-content-center">
  <a class="btn btn-primary btn-lg" href="<?php echo site_url("CreatePost") ?>" role="button">Create a Post</a>
</div>

<br />

<?php
foreach ($cat as $key => $value) {
  echo "<div class=\"card text-white bg-success mb-3 mx-auto\" style=\"max-width: 75%;\">";
  echo "<div class=\"card-header \">";
  echo "<img src='" . base_url() . $value['Image'] . "' alt=\"Profile Picture\" class=\"rounded-circle img-thumbnail align-self-start mr-3\" style=\"height:auto; width:80px;\">";
  echo " " . $value['UserName'];
  echo "<div class = \" float-right\"> Category: ".$value['Category']."</div> </div>";
  echo "<div class=\"card-body\">";
  echo "<h4 class=\"card-title\">" . $value['Title'] . "</h4>";
  echo "<p class=\"card-text\">" . $value['content'] . "</p>";
  echo "</div>";
  echo "</div>";
}

?>
