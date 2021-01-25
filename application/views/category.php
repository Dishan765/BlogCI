<br />
<table class="table table-bordered mx-auto" style="width:50%;">
  <thead>
    <tr>
      <th scope="col" style="text-align:center;">Category</th>
    </tr>
  </thead>
  <tbody>
   
      <?php
      //var category;
      foreach ($category as $key => $value) {
        echo "<tr>";
        $category = '/SpecificCategory/'.rawurlencode($value['Category']);
        echo "<td>"."<a href ='".site_url($category)."'/>".$value['Category']."</td>";
        echo "</tr>";
      }
      ?>
  </tbody>
</table>

