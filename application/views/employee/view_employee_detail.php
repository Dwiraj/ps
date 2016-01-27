<style type="text/css">
	.plain-text
	{
		background-color: #ffffff;
		border: 0;
		border-radius: 0;
		font-size: 14px;
	}
</style>
<div class="container">
	<div class="row">
		
		<h2 align="center">Employee detail</h2><br/>

		<div class="col-sm-6">
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="control-label col-sm-3" for="name">Name:</label>
					<div class="col-sm-8">
						<pre class="plain-text"><?php if(isset($query -> first_name)){ if(isset( $query1 -> salutation)){ echo $query1 -> salutation; } echo  $query -> first_name." ".$query -> last_name;}?></pre>
						<!-- <input type="text" class="form-control" id="name" readonly="true" value=""> -->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address">Father name:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> father_name)){ echo $query1 -> father_name;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address">Mother name:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> mother_name)){ echo $query1 -> mother_name;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address">Address:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> address)){ echo $query1 -> address;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Email</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query -> email)){ echo $query -> email;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="phone_no">Mobile no:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> phone_no)){ echo $query1 -> phone_no;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="alternate_no">Alternate no:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> alternate_no)){ echo $query1 -> alternate_no;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="dob">Birth date:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> dob) && $query1 -> dob != '0000-00-00'){ echo $query1 -> dob;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="pan_no">Education detail</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> qualification)){ echo $query1 -> qualification;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="bank_account_no">Bank account:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> bank_account_no)){ echo $query1 -> bank_account_no;}?></pre>
					</div>
				</div>
			</form>
		</div>

		<div class="col-sm-6">
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<img style="margin-left:200px;margin-top:-45px" alt="Profile picture" src="<?php if(isset($query1 -> profile_picture)){ echo base_url('assets/image/'.$query1 -> profile_picture); } else{ echo base_url('assets/image/logo.ico'); } ?>" height="200px" width="200px">
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="position">Position:</label>
					<div class="col-sm-8">
						<pre class="plain-text"><?php if(isset($query1 -> position)){ echo $query1 -> position;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="salary">Salary</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> salary) && $query1 -> salary != '0	'){ echo $query1 -> salary;}?></pre>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="start_date">Start date</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> start_date) && $query1 -> start_date != '0000-00-00'){ echo $query1 -> start_date;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="current_status">Current status:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> current_status)){ echo $query1 -> current_status;}?></pre>
					</div>
				</div>
				<?php if(isset($query1 -> current_status) && $query1 -> current_status == "Resigned")
				{
					?>
					<div class="form-group">
						<label class="control-label col-sm-3" for="end_date">End date:</label>
						<div class="col-sm-8"> 
							<pre class="plain-text"><?php if(isset($query1 -> end_date) && $query1 -> end_date != '0000-00-00'){ echo $query1 -> end_date;}?></pre>
						</div>
					</div>
					<?php 
				} 
				?>
				<div class="form-group">
					<label class="control-label col-sm-3" for="pan_no">PAN no:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> pan_no)){ echo $query1 -> pan_no;}?></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="bank_account_no">Comment</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"><?php if(isset($query1 -> comment)){ echo $query1 -> comment;}?></pre>
					</div>
				</div>
			</form>
		</div>

		<div align="center" class="col-sm-12">
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-8">
					<a href="<?php echo base_url('employee')?>"><button type="button" class="btn btn-info">Back</button></a>
				</div>
			</div>
		</div>

	</div>
</div>