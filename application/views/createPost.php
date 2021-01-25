<br />
<div>
  <form action="<?php echo site_url('CreatePost') ?>" method="POST">
    <fieldset>
      <div class="form-group col-md-6 mx-auto">
        <label for="InputTitle">Title</label>
        <div style="color:red;"><?php echo form_error('Title'); ?></div>
        <input type="text" class="form-control " id="InputTitle" name="Title" placeholder="Enter Title" value="<?php echo set_value('Title'); ?>">
      </div>

      <div class="form-group col-md-10 mx-auto">
        <label for="editor">Content</label>
        <div style="color:red;"><?php echo form_error('Content'); ?></div>
        <textarea id="editor" class="form-control" id="myTextarea" name="Content">
          <?php echo set_value('Content'); ?>
        </textarea>
      </div>


      <input type="hidden" name="hide" <?php if (empty($category)) {
                                          echo "value = 'hide'";
                                        } ?> />
      <div class="center-block" style="color:red;"><?php echo form_error('NewCategory'); ?></div>
      <div class="form-row">
        <div class="form-group col-md-4 <?php if (empty($category)) {
                                          echo "d-none";
                                        } ?>">
          <label for=Select2">Choose an existing Category.</label>
          <select class="form-control" id="Select2" name="Category" value="<?php echo set_value('Category'); ?>">
            <option value="" selected>Choose Category</option>
            <?php
            foreach ($category as $key => $value) {
              echo "<option value = '" . $value['Category'] . "'" . set_select('Category',  $value['Category']) . ">" . $value['Category'] . "</option>";
            }
            ?>
          </select>
        </div>



        <div class="form-group col-md-6 <?php if (!empty($category)) {
                                          echo "offset-2";
                                        } ?> mx-auto">
          <label for="InputNewCategory">Add a new Category</label>
          <input type="text" class="form-control" id="InputNewCategory" name="NewCategory" placeholder="Enter New Category" value="<?php echo set_value('NewCategory'); ?>">
        </div>
      </div>
    </fieldset>

    <div class=" row justify-content-center">
      <button name="register" type="submit" class="btn btn-primary">Submit Post</button>
    </div>
  </form>
</div>

<br />