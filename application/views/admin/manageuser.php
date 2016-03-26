<h2 align="center">View admin</h2>
<!-- <p align="center">
	<label for="search">
		<strong>Search </strong>
	</label>
	<input type="text" id="search"/>
</p> -->
<div class="container-fluid">
	<div class="row">
		<div class="add-button col-sm-12">
			<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add new</button>
		</div>
	</div>
	<table id="tblDataAdmin" class="table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>First name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Last login</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
	<div class="row">
		<div class="modal fade" id="modal_form" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title">Add new user</h3>
					</div>
					<div class="modal-body form">
						<form action="#" id="form" class="form-horizontal">
							<input type="hidden" value="" name="id"/>
							<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-3">First Name</label>
									<div class="col-md-9">
										<input type="text" name="first_name" class="form-control" placeholder="Enter user firstname">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Last Name</label>
									<div class="col-md-9">
										<input type="text" name="last_name" class="form-control" placeholder="Enter user lastname">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Email</label>
									<div class="col-md-9">
										<input type="text" name="email" class="form-control" placeholder="Enter user email">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">User type</label>
									<div class="col-md-9">
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
												echo "<option value='' >-- Select one --</option>";
											}
											?>
											<option <?php echo $select_e; ?> value="1">Employee</option>
											<option <?php echo $select_a; ?> value="2">Admin</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Password</label>
									<div class="col-md-9">
										<input type="password" name="password" id="password" class="form-control" value="" placeholder="Enter user password">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Confirm cassword</label>
									<div class="col-md-9">
										<input type="password" name="cpassword" class="form-control" value="" placeholder="Enter confirm password">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- End Bootstrap modal -->
	</div>
</div>