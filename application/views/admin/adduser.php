	<?php 
	$attributes = array('name' => 'myform');
	echo form_open('admin/adduser', $attributes);
	?>
	<h2 align="center">Add new user</h2>
	<table>
		<tr><th colspan="3">Add new user form</th></tr>
		<tr>
			<td></td>
			<td colspan="2">
				<div style="color:red;" id="error_massege">
					<?php 
					if(isset($error_msg))
					{
						echo $error_msg;
					}
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td><label>First name</label></td>
			<td><input type="text" name="first_name" class="form-control" value="<?php if(isset($first_name)) { echo $first_name; } ?>" placeholder="Enter user firstname"></td>
			<td><?php echo form_error('first_name'); ?></td>
		</tr>
		<tr>
			<td><label>Last name</label></td>
			<td><input type="text" name="last_name" class="form-control" value="<?php if(isset($last_name)) { echo $last_name; } ?>" placeholder="Enter user lastname"></td>
			<td><?php echo form_error('last_name');  ?></td>
		</tr>
		<tr>
			<td><label>Email</label></td>
			<td><input type="text" name="email" class="form-control" value="<?php if(isset($email)) { echo $email; } ?>" placeholder="Enter user email"></td>
			<td><?php echo form_error('email'); ?></td>
		</tr>
		<tr>
			<td><label>User type</label></td>
			<td><select name="user_level" class="form-control">
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
		</td>
		<td><?php echo form_error('user_level'); ?></td>
	</tr>
	<tr>
		<td><label>Password</label></td>
		<td><input type="password" name="password" class="form-control" value="" placeholder="Enter user password"></td>
		<td><?php echo form_error('password'); ?></td>
	</tr>
	<tr>
		<td><label>Confirm password</label></td>
		<td><input type="password" name="cpassword" class="form-control" value="" placeholder="Enter confirm password"></td>
		<td><?php echo form_error('cpassword');?>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="right"><input type="submit" name="submit" id="adduser" onclick="return adduser_validation();" value="Save" class="button-btn">
			<input type="reset" name="reset" value="Reset" class="button-btn">
		</td>
	</tr>
</table>
<?php 
echo form_close();
?>