<div class="container">
	<?php
	$attributes = array('name' => 'myform', 'id' => 'adduser-form', 'class' => 'form-horizontal');
	echo form_open('admin/adduser', $attributes);
	?>
	<h2 align="center">Add new user</h2>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<div style="color:red;" id="error_massege">
				<?php
				if(isset($error_msg))
				{
					echo $error_msg;
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-4" for="first_name">First name</label>
		<div class="col-xs-6">
			<input type="text" name="first_name" class="form-control" value="<?php if(isset($first_name)) { echo $first_name; } ?>" placeholder="Enter user firstname">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<?php echo form_error('first_name'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-4" for="last_name">Last name</label>
		<div class="col-xs-6">
			<input type="text" name="last_name" class="form-control" value="<?php if(isset($last_name)) { echo $last_name; } ?>" placeholder="Enter user lastname">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<?php echo form_error('last_name');  ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-4" for="email">Email</label>
		<div class="col-xs-6">
			<input type="text" name="email" class="form-control" value="<?php if(isset($email)) { echo $email; } ?>" placeholder="Enter user email">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<?php echo form_error('email'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-4" for="user_type">User type</label>
		<div class="col-xs-6">
			<select name="user_level" class="form-control">
				<?php
				$select_e = "";
				$select_a = "";
				if(isset($type))
				{
					switch ($type)
					{
						case '1':
							$select_e = "selected";
							break;
						case '2':
							$select_a = "selected";
							break;
					}
				}
				else
				{
					?>
					<option value="" >-- Select one --</option>
					<?php
				}
				?>
				<option <?php echo $select_e; ?> value="1">Employee</option>
				<option <?php echo $select_a; ?> value="2">Admin</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<?php echo form_error('user_level'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-4" for="password">Password</label>
		<div class="col-xs-6">
			<input type="password" name="password" class="form-control" value="" placeholder="Enter user password">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<?php echo form_error('password'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-4" for="confirm_password">Confirm password</label>
		<div class="col-xs-6">
			<input type="password" name="cpassword" class="form-control" value="" placeholder="Enter confirm password">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<?php echo form_error('cpassword');?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-4 col-xs-6">
			<input type="submit" name="submit" id="adduser" onclick="return adduser_validation();" value="Save" class="btn btn-info">
			<button type="button" class="btn btn-default">Back</button>
		</div>
	</div>
	<?php
	echo form_close();
	?>
</div>
