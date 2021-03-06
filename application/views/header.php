<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	foreach ($css as $key) 
	{
		echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/'.$key.'.css">';
		echo "\n\t\t";
	}
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo base_url();?>assets/image/shortcut.png" rel="shortcut icon">
	<title><?php echo $title;  ?></title>
</head>
<body>
	<?php 
	if ($userset == 'set') 
	{
		?>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<?php 
						if($user_level == 1)
						{
							?>
							<li><a href="<?php echo base_url();?>user">Home</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<?php				
						} 
						else 
						{
							?>	
							<li><a href="<?php echo base_url();?>user">Home</a></li>
							<li class="dropdown" style="cursor:pointer"><a class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>admin-list">View admin</a></li>
									<li><a href="<?php echo base_url();?>add-new-user">Add admin</a></li>
								</ul>
							</li>
							<li class="dropdown" style="cursor:pointer"><a class="dropdown-toggle" data-toggle="dropdown">Employee <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>employee-list">View employee</a></li>
									<li><a href="<?php echo base_url();?>add-new-user">Add employee</a></li>
								</ul>
							</li>
							<li><a href="<?php echo base_url();?>salary-register-list">Salary register</a></li>
							<li class="dropdown" style="cursor:pointer"><a class="dropdown-toggle" data-toggle="dropdown">Reports <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>employee-salary-record">Employee salary record</a></li>
									<li><a href="<?php echo base_url();?>user/development">Employee leave record</a></li>
									<li><a href="<?php echo base_url();?>user/development">Employee detail</a></li>
								</ul>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
						<?php 
						} 
						?>
						<li><a><?php echo  $footer;	?></a></li>
						<li class="dropdown" style="cursor:pointer"><a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-out"></span> <?php echo  $user; ?></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>user/profile">View profile</a></li>
								<li><a href="<?php echo base_url();?>change-password">Change password</a></li>
								<li><a href="<?php echo base_url();?>user/logout">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}
	?>