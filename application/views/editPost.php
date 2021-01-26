<br />
<br />
<div>
  <form action="<?php echo base_url() . 'Edit/' . $PostID ?>" method="POST">
    <fieldset>
      <div class="form-group col-md-6 mx-auto">
        <label for="InputTitle">Title</label>
        <div style="color:red;"><?php echo form_error('Title'); ?></div>
        <input type="text" class="form-control " id="InputTitle" name="Title" placeholder="Enter Title" value="<?php echo $Title; ?>">
      </div>

      <div class="form-group col-md-10 mx-auto">
        <label for="editor">Content</label>
        <div style="color:red;"><?php echo form_error('Content'); ?></div>
        <textarea id="editor" class="form-control" id="myTextarea" name="Content">
          <?php echo $Content; ?>
        </textarea>
      </div>

      <div class="center-block" style="color:blue;">NOTE: To Add a category, select UPDATE CATEGORY. </div>
      <div class="center-block" style="color:red;"><?php echo form_error('NewCategory'); ?></div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for=Select2">Change to an existing Category.</label>
          <select class="form-control" id="Select2" name="Category" value="<?php echo set_value('Category'); ?>">
            <option value="<?php echo $Category; ?>" selected><?php echo $Category; ?></option>
            <?php
            foreach ($cat as $key => $value) {
              if ($value['Category'] != $Category) {
                echo "<option value = '";
                echo "'" . set_select('Category',  $value['Category']) . ">";
                echo $value['Category'];
                echo "</option>";
              }
            }
            ?>
            <option value= "">UPDATE CATEGORY</option>
          </select>
        </div>



        <div class="form-group col-md-6 <?php if (!empty($category)) {
                                          echo "offset-2";
                                        } ?> mx-auto">
          <label for="InputNewCategory">Change to a new Category</label>
          <input type="text" class="form-control" id="InputNewCategory" name="NewCategory" placeholder="Enter New Category" value="<?php echo set_value('NewCategory'); ?>">
        </div>
      </div>













    </fieldset>

    <div class=" row justify-content-center">
      <button name="register" type="submit" class="btn btn-primary">Update Post</button>
    </div>
  </form>
</div>

<br />