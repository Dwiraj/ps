<?php 
	$attributes = array('name' => 'updateemployee');
	echo form_open('employee/updateemployee/'.$query -> employee_id.'', $attributes);
	?>
	<h2 align="center">Update employee detail</h2>
	<table>
		<tr>
			<th colspan="3">Update employee detail form</th>
		</tr>
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
			<td><label>Salutation</label></td>
			<td><input type="text" name="salutation" class="form-control" placeholder="Enter salutation of employee" value="<?php echo $query -> salutation; ?>"></td>
			<td><?php echo form_error('salutation'); ?></td>
		</tr>

		<tr>
			<td><label>Father name</label></td>
			<td><input type="text" name="father_name" class="form-control" placeholder="Enter employee's father name" value="<?php echo $query -> father_name; ?>"></td>
			<td><?php echo form_error('father_name'); ?></td>
		</tr>

		<tr>
			<td><label>Mother name</label></td>
			<td><input type="text" name="mother_name" class="form-control" placeholder="Enter employee's mother name" value="<?php echo $query -> mother_name; ?>"></td>
			<td><?php echo form_error('mother_name'); ?></td>
		</tr>
		<tr>
			<td><label>Date of Birth</label></td>
			<td><input type="text" name="dob" class="form-control" placeholder="Enter birthdate"  id="datepickerdob" value="<?php if($query -> dob != "0000-00-00") { echo $query -> dob; } ?>"></td>
			<td><?php echo form_error('dob'); ?></td>
		</tr>
		<tr>
			<td><label>Address</label></td>
			<td><textarea name="address" class="form-control" style="height:170px; width:500px;" placeholder="Enter address"><?php echo $query -> address; ?></textarea></td>
			<td><?php echo form_error('address'); ?></td>
		</tr>
		<tr>
			<td><label>Phone no.</label></td>
			<td><input type="text" name="phone_no" class="numbersOnly form-control"  value="<?php echo $query -> phone_no; ?>" placeholder="Enter mobile number"></td>
			<td><?php echo form_error('phone_no'); ?></td>
		</tr>
		<tr>
			<td><label>Alternate no.</label></td>
			<td><input type="text" name="alternate_no" class="numbersOnly form-control"  value="<?php echo $query -> alternate_no; ?>" placeholder="Enter alternate number"></td>
			<td><?php echo form_error('alternate_no'); ?></td>
		</tr>
		<tr>
			<td><label>Salary</label></td>
			<td><input type="text" name="salary" class="numbersOnly form-control" value="<?php echo $query -> salary; ?>" placeholder="00.00"></td>
			<td><?php echo form_error('salary'); ?></td>
		</tr>
		<tr>
			<td><label>Position</label></td>
			<td><select name="position" class="form-control" value="<?php if(isset($position)) { echo $position; } ?>">
					<?php 
						$selectTr = "";
						$selectRE = "";
						$selectACC = "";
						$selectWD = "";
						$selectSWD = "";
						$selectMD = "";
						$selectUI = "";
						$selectSUI = "";
						$selectPR = "";
						$selectHRM = "";
						$selectHRE = "";
						$selectBDE = "";
						$selectSEO = "";
						$selectSE = "";
						switch ($query -> position) 
						{
							case 'Trainee':
							$selectTr = "selected";
							break;
							case 'Web Developer':
							$selectWD = "selected";
							break;
							case 'Senior Web Developer':
							$selectSWD = "selected";
							break;
							case 'Receptionist':
							$selectRE = "selected";
							break;
							case 'Accountant':
							$selectACC = "selected";
							break;
							case 'Mobile Developer':
							$selectMD = "selected";
							break;
							case 'UI Developer':
							$selectUI = "selected";
							break;
							case 'Senior UI Developer':
							$selectSUI = "selected";
							break;
							case 'Project Manager':
							$selectPR = "selected";
							break;
							case 'HR Manager':
							$selectHRM = "selected";
							break;
							case 'HR Executive':
							$selectHRE = "selected";
							break;
							case 'Business Development Executive':
							$selectBDE = "selected";
							break;
							case 'SEO Executive':
							$selectSEO = "selected";
							break;
							case 'Software Engineer':
							$selectSE = "selected";
							break;
						}
					?>
						<option value="">- Select one-</option>
						<option <?php echo $selectACC; ?> value="Accountant">Accountant</option>
						<option <?php echo $selectBDE; ?> value="Business Development Executive">Business Development Executive</option>
						<option <?php echo $selectHRE; ?> value="HR Executive">HR Executive</option>
						<option <?php echo $selectHRM; ?> value="HR Manager">HR Manager</option>
						<option <?php echo $selectMD; ?> value="Mobile Developer">Mobile Developer</option>
						<option <?php echo $selectPR; ?> value="Project Manager">Project Manager</option>
						<option <?php echo $selectRE; ?> value="Receptionist">Receptionist</option>
						<option <?php echo $selectSWD; ?> value="Senior Web Developer">Senior Web Developer</option>
						<option <?php echo $selectSUI; ?> value="Senior UI Developer">Senior UI Developer</option>
						<option <?php echo $selectSEO; ?> value="SEO Executive">SEO Executive</option>
						<option <?php echo $selectSE; ?> value="Software Engineer">Software Engineer</option>
						<option <?php echo $selectTr; ?> value="Trainee">Trainee</option>
						<option <?php echo $selectUI; ?> value="UI Developer">UI Developer</option>
						<option <?php echo $selectWD; ?> value="Web Developer">Web Developer</option>
					</select>
				</td>
				<td><?php echo form_error('position'); ?></td>
			</tr>
			<tr>
				<td><label>Start date</label></td>
				<td><input type="text" name="start_date" class="form-control" placeholder="Enter start date"  id="datepickerstart" value="<?php echo $query -> start_date; ?>"></td>
					<td><?php echo form_error('start_date'); ?></td>
				</tr>

				<tr>
					<td><label>Current status</label></td>
					<td><select name="current_status" class="form-control" onchange="addEndDate();" id="current_status" value="<?php echo $query -> current_status; ?>">
						<?php 
							switch ($query -> current_status) 
							{
								case 'Working':
								echo'<option selected value="Working">Working</option>
								<option value="Resigned">Resigned</option>';
								break;
								case 'Resigned':
								echo'<option value="Working">Working</option>
								<option selected value="Resigned">Resigned</option>';
								break;
							}			
						?>
						</select>
					</td>
					<td><?php echo form_error('current_status'); ?></td>
				</tr>
				<?php 
					if ($query -> current_status == "Working") 
					{
						echo '<tr id="enddate" style="display:none;">';
					}
					else
					{
						echo '<tr id="enddate">';
					}
				?>
				<td><label>End date</label></td>
				<td><input type="text" class="form-control" name="end_date" value="<?php echo $query -> end_date; ?>" id="datepickerend" placeholder="Enter end date"></td>
				<td><?php echo form_error('end_date'); ?></td>
			</tr>
		<tr>
			<td><label>PAN no.</label></td>
			<td><input type="text" name="pan_no" class="form-control"  value="<?php echo $query -> pan_no; ?>" placeholder="Enter PAN card number"></td>
			<td><?php echo form_error('pan_no'); ?></td>
		</tr>
		<tr>
			<td><label>Bank Detail</label></td>
			<td><textarea name="bank_account_no" class="form-control" style="height:170px; width:500px;" placeholder="Employee Bank Detail"><?php echo $query -> bank_account_no; ?></textarea></td>
			<td><?php echo form_error('bank_account_no'); ?></td>
		</tr>

		<tr>
			<td><label>Education Qualification</label></td>
			<td><textarea name="qualification" class="form-control" style="height:170px; width:500px;" placeholder="Employee Qualification"><?php echo $query -> qualification; ?></textarea></td>
			<td><?php echo form_error('qualification'); ?></td>
		</tr>

		<tr>
			<td><label>Comment</label></td>
			<td><textarea name="comment" class="form-control" style="height:170px; width:500px;" placeholder="Comment for employee"><?php echo $query -> comment; ?></textarea></td>
			<td><?php echo form_error('comment'); ?></td>
		</tr>
			<tr>
				<td colspan="3" align="right">
					<input type="submit" name="submit"  onclick="return updateemployee_validation();" value="Save" class="button-btn">
					<a href="<?php echo base_url();?>employee"><input type="button" name="back" value="Back" class="button-btn"></a>
				</td>
			</tr>
		</table>
		<?php 
		echo form_close();
	?>