<div class="container">
	<div class="row">
	<h2 align="center">Change password</h2>
    <div class="table-responsive">
    	<form name="change_password" method="post" action="<?php echo base_url();?>change-password">
				<table>
					<thead>
						<tr>
							<th colspan="3">
								<label>Change password form</label>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center" style="color:red;" colspan="3"><?php if(isset($error_msg)){ echo $error_msg;}?></td>
						</tr>
						<tr>
							<td><label>Old password</label></td>
							<td><input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Enter old password"></td>
							<td><?php echo form_error('oldpassword'); ?></td>
						</tr>
						<tr>
							<td><label>New password</label></td>
							<td><input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Enter new password"></td>
							<td><?php echo form_error('newpassword'); ?></td>
						</tr>
						<tr>
							<td><label>Confirm password</label></td>
							<td><input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter confirm password"></td>
							<td><?php echo form_error('cpassword'); ?></td>
						</tr>
						<tr>
							<td colspan="2" align="right"><input type="submit" onclick="return change_password_validation();" name="submit" value="Submit" class="button-btn"><a href="<?php echo base_url('user/welcome')?>"><input type="button" name="back" value="Back" class="button-btn"></a></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
  </div>
</div>