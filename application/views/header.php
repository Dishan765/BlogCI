<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
  <link rel="stylesheet" href="CSS/bootstrap.css" />
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo site_url('index') ?>">Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav mr-auto">
        <li class="<?php if ($this->uri->uri_string() == 'index') {
                      echo 'active';
                    } ?> nav-item">
          <a class="nav-link" href="<?php echo base_url().'index'; ?>">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class=" <?php if ($this->uri->uri_string() == 'Category') {
                      echo 'active';
                    } ?> nav-item">
          <a class="nav-link" href="<?php echo base_url().'Category'; ?>">Categories</a>
        </li>
    </div>

    <div class="collapse navbar-collapse justify-content-end" id="navbarColor03">
      <ul class="navbar-nav">

        <?php if (!$this->session->userdata('logged_in')) : ?>
          <li class="<?php if ($this->uri->uri_string() == 'LogIn') {
                        echo 'active';
                      } ?> nav-item">
            <a class="nav-link" href="<?php echo base_url().'LogIn'; ?>">Log In</a>
          </li>

          <li class="<?php if ($this->uri->uri_string() == 'Registration') {
                        echo 'active';
                      } ?> nav-item">
            <a class="nav-link" href="<?php echo base_url().'Registration'; ?>">Sign Up</a>
          </li>
        <?php endif; ?>

        <?php if ($this->session->userdata('logged_in')) : ?>
          <li class="<?php if ($this->uri->uri_string() == 'userPost') {
                        echo 'active';
                      } ?> nav-item">
            <a class="nav-link" href="<?php echo base_url().'userPost'; ?>">Your Posts</a>
          </li>
          
          <li class="<?php if ($this->uri->uri_string() == 'Logout') {
                        echo 'active';
                      } ?> nav-item">
            <a class="nav-link" href="<?php echo base_url().'Logout'; ?>">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>