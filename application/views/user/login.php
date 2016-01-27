
	<h2 align="center">User Login Form</h2>
		<div class="table-responsive">
		<table>
			<form name="myfrm" action="<?php echo base_url();?>user/login" method="POST">
				<tr><th colspan="3"></th></tr>
				<tr>
					<td></td>
					<td colspan="2">
						<div style="color:red;" id="error_massege"><?php if(isset($error_msg)) { echo $error_msg; } ?></div>
					</td>
				</tr>
				<tr>
					<td><label>Email</label></td>
					<td><input type="text" name="email" id="email" class="form-txt" value="<?php if(isset($email)) { echo $email; } ?>"  placeholder="User Email"></td>
					<td><?php echo form_error('email', '<div class="error">', '</div>'); ?>
					</td>
				</tr>
					
				<tr>
					<td><label>Password</label></td>
					<td><input type="password" name="password" class="form-txt" placeholder="User Password"></td>
					<td><?php echo form_error('password', '<div class="error">', '</div>'); ?></td>
				</tr>
				<tr>
					<td></td><td colspan="2"><input type="checkbox" name="rememberme" value="remember" >&nbsp;&nbsp; Remember Me</td>
				</tr>
				<tr>
					<td colspan="3" align="right">
						<input type="submit" name="submit" value="Login" id="login" onclick="return Login_validation();" class="button-btn">
						<input type="reset" name="reset" value="Reset" class="button-btn">
					</td>
				</tr>
			</form>
		</table>	
		</div>