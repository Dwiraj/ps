<?php 
if(!empty($query -> id))
{
	$attribute = array('name' => 'updatefrm' );
	echo form_open(''.base_url().'admin/update/'.$query -> id, $attribute);
	?>
	<h2 align="center">Update user detail</h2>
	<table>
		<tr><th colspan="3">Update user form<input type="hidden" name="uid" value="<?php echo $query -> id; ?>"></th></tr>
		<tr><td></td><td colspan="2"><div style="color:red;" id="error_massege">
			<?php
			if(isset($error_msg))
			{
				echo $error_msg;
			}
			?>
		</div></td></tr>
		<tr><td><label>First name</label></td>
			<td><input type="text" name="first_name" class="form-control" value="<?php  echo $query -> first_name; ?>" placeholder="Enter user firstname"></td>
			<td><?php echo form_error('first_name', '<div class="error">', '</div>'); ?></td>
		</tr>
		
		<tr><td><label>Last name</label></td>
			<td><input type="text" name="last_name" class="form-control" value="<?php  echo $query -> last_name;  ?>" placeholder="Enter user lastname"></td>
			<td><?php echo form_error('last_name', '<div class="error">', '</div>'); ?></td>
		</tr>
		
		<tr><td><label>Email</label></td>
			<td><input type="text" name="email" class="form-control" value="<?php  echo $query -> email;  ?>" placeholder="Enter user email"></td>
			<td><?php echo form_error('email', '<div class="error">', '</div>'); ?></td>
		</tr>
		
		<tr><td><label>User type</label></td>
			<td><select name="user_level"	class="form-control">
				<?php 
				$select_e = "";
				$select_a = "";
				switch ($query -> user_level) 
				{
					case '1':
					$select_e = "selected";
					break;
					case '2':
					$select_a = "selected";
					break;
				}
				?>
				<option <?php echo $select_e; ?> value="1">Employee</option>
				<option <?php echo $select_a; ?> value="2">Admin</option>
			</select>
		</td>
		<td><?php echo form_error('user_level', '<div class="error">', '</div>'); ?></td>
	</tr>
	<tr>
		<td><?php $level = $query -> user_level; if($level != 2) { ?> <a href="<?php echo base_url();?>employee/addedit/?id=<?php echo $query -> id; ?>"><input type="button" name="view_detail" value="View more" class="button-btn"></a><?php }?></td>
		<td colspan="2" align="right"><input type="submit" name="submit" value="Update" onclick="return updateuser();" class="button-btn">
			<a href="<?php echo base_url();?>employee"><input type="button" name="back" value="Back" class="button-btn"></a>
		</td>
	</tr>
</table>
<?php 
echo form_close();
}
else
{
?>
	<h2 align="center">There is some problem to load data</h2>
<?php

}
?>