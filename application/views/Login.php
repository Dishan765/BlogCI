<br />
<div class="container">
  <?php
  if ($this->session->flashdata('loginErr')) {

    echo "<h3 class ='alert alert-danger'>" . $this->session->flashdata('loginErr') . "</h3>";
  }

  if ($this->session->flashdata('loginNow')) {

    echo "<h3 class ='alert alert-danger'>" . $this->session->flashdata('loginNow') . "</h3>";
  }

  $page = "login";
  ?>
</div>

<div class="container">
  <?php
  if ($this->session->flashdata('registered')) {
    echo "<h3 class ='alert alert-success'>" . $this->session->flashdata('registered') . "</h3>";
  }
  ?>
</div>

<form action="<?php echo site_url('/Login') ?>" method="POST" enctype="multipart/form-data">
  <fieldset>
    <div class="form-group col-md-6 mx-auto">
      <label for="InputName">Username</label>
      <div style="color:red;"> <?php echo form_error('Name'); ?></div>
      <input type="text" class="form-control" id="InputName" name="Name" value="<?php echo set_value('Name'); ?>" placeholder="Enter Username" value="<?php echo set_value('Name'); ?>">
    </div>


    <div class="form-group col-md-6 mx-auto">
      <label for="Password">Password</label>
      <div style="color:red;"><?php echo form_error('pwd'); ?></div>
      <input type="password" class="form-control" id="InputPassword" name="pwd" placeholder="Password">
    </div>

    <div class=" row justify-content-center">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
  </fieldset>
</form>