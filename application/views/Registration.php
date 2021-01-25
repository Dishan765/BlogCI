<?php  if(isset($error)) {echo $error;} ?>

<form action="<?php echo site_url('Registration') ?>" method="POST" enctype="multipart/form-data">
  <fieldset>
    <div class="form-group col-md-6 mx-auto">
      <label for="InputEmail">Email address</label>
      <div style="color:red;"> <?php echo form_error('Email'); ?>
      </div>
      <input type="email" class="form-control" id="InputEmail" name="Email" value="<?php echo set_value('Email'); ?>" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo set_value('Email'); ?>">
    </div>

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

    <div class="form-group col-md-6 mx-auto">
      <label for="InputFile">Profile Picture</label>
      <input type="file" class="form-control-file" id="InputFile" name="img">
    </div>
    <div class=" row justify-content-center">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>
  </fieldset>
</form>