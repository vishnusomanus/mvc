

<div class="dashboard_body">
	<?php
$this->alert();
$select_array = $this->Admindb->table_full('Groups');
?>
	<h2>Add user</h2>

    <form role="Form" method="post" action="" class="admin_form" accept-charset="UTF-8" autocomplete="off">
		<div class="form-group">
			<label for="fname">Name</label>
			<input type="text" id="name" class="form-control" required name="name" placeholder="Enter Name">
		</div>
		<div class="form-group">
			<label for="emailaddr">Email Address</label>
			<input type="email" id="emailaddr" class="form-control" required name="email" placeholder="Example: john.doe@gmail.com">
        </div>
        <div class="form-group">
			<label for="group">User Type</label>
			<select id="group" class="form-control" required name="group_id">
				<option selected disabled>Choose Type</option>
				<?php 
				$sel = '';
					foreach ($select_array as $key => $value) {
						echo '<option value="'.$$value[id].'"  >'.$value['name'].'</option>';
					}
				 ?>
			</select>
		</div>        
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" id="password" required class="form-control" name="password" placeholder="Enter Password">
        </div>
		<div class="form-group ">
			<button type="submit" class="btn btn-primary " id="submitbtn" name="submit">Add User</button>
        </div>
    </form>





</div>