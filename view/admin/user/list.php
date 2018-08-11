<div class="dashboard_body">
  <?php
$this->alert();
//print_r($user_list['results']);
?>
  <h2>User</h2>
  <div class="p-b-15 float-left">
    <div  class="col-md-8">
    <a href="<?=SITE_URL?>/admin/add_user"><button class="btn btn-primary ">Add User</button></a>
  </div>
   <form action="" method="GET" accept-charset="utf-8" class="">
  
    <div class="col-md-4">
          <div class="input-group">
 <input type="text" class="form-control" placeholder="Search" name="key"> <span class="input-group-btn"> <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i></button> </span> </div>
   </div>
          
</form>
</div>
   <br>


<div class="admin_table">  
  <table class="admin">
  <thead>
    <tr>
      <th>S.No.</th>
      <th>Name</th>
      <th>Email</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

<?php
if(isset($_GET['page'])) $page = $_GET['page']; else $page = 1;
 foreach ($user_list['results'] as $key => $value) { ?>
      <tr>
      <td data-label="S.No."><?php echo ($key+1)+(($page-1) * 10); ?></td>
      <td data-label="Name"><?=$value['name'] ?></td>
      <td data-label="Email"><?=$value['email'] ?></td>
      <td data-label="Date"><?=date("F d,Y", strtotime($value['created'])) ?></td>
      <td data-label="Action" class="text-center">
        <a href="<?=SITE_URL.'/admin/user?edit='.$value['id'] ?>" class="edit_link"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
        <a href="<?=SITE_URL.'/admin/user?delete='.$value['id'] ?>" class="delete_link"><i class="fa fa-trash" aria-hidden="true"></i></a>

      </td>
    
    </tr>
<?php  } ?>



        </tbody>
</table>
</div>
<div class="col-md-12">
  <?=$user_list['pagination'] ?>
</div>



</div>