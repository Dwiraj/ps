<div class="login-wraper" xmlns="http://www.w3.org/1999/html">
	<div class="form-data">
		<h2 class="col-xs-offset-2 col-xs-12">Login</h2>
			<form class="form-horizontal" role="form" name="myfrm" id="login-form" action="<?php echo base_url();?>user/login" method="POST">
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-12">
						<div style="color:red;" id="error_massege"><?php if(isset($error_msg)) { echo $error_msg; } ?></div>
			 		</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-8">
						<input type="text" class="form-control" name="email" id="email" class="form-txt" value="<?php if(isset($email)) { echo $email; } ?>"  placeholder="User Email">
						<span class="glyphicon glyphicon-user user"></span>
					</div>
				</div>
				<?php echo form_error('email', '<div class="form-group"><div class="col-xs-offset-2 col-xs-12">', '</div></div>'); ?>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-8">
						<input type="password" class="form-control" name="password" class="form-txt" placeholder="User Password">
						<span class="glyphicon glyphicon-lock pass"></span>
					</div>
				</div>
				<?php echo form_error('password', '<div class="form-group"><div class="col-xs-offset-2 col-xs-12">', '</div></div>'); ?>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-8">
						<div class="checkbox">
							<label><input type="checkbox" name="rememberme" value="remember" > Remember me</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-8">
						<input type="submit" name="submit" value="Login" id="login" onclick="return Login_validation();" class="btn btn-info col-sm-12">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>