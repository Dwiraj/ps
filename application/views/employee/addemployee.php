
<?php 
$attributes = array('name' => 'addemployee');
$uid = $this->input->get('id', TRUE);
echo form_open('employee/addemployee/?id='.$uid.'', $attributes);
?>
<table>
	<tr><th colspan="3">Add employee detail form</th></tr>
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
				<input type="hidden" name="uid" value="<?php echo $uid;?>">
			</div>
		</td>
	</tr>

	<tr>
		<td><label>Salutation</label></td>
		<td><input type="text" name="salutation" class="form-control" placeholder="Enter salutation of employee"></td>
		<td><?php echo form_error('salutation'); ?></td>
	</tr>

	<tr>
		<td><label>Father name</label></td>
		<td><input type="text" name="father_name" class="form-control" placeholder="Enter employee's father name"></td>
		<td><?php echo form_error('father_name'); ?></td>
	</tr>

	<tr>
		<td><label>Mother name</label></td>
		<td><input type="text" name="mother_name" class="form-control" placeholder="Enter employee's mother name"></td>
		<td><?php echo form_error('mother_name'); ?></td>
	</tr>

	<tr>
		<td><label>Date of Birth</label></td>
		<td><input type="text" name="dob" class="form-control" placeholder="Enter birthdate" id="datepickerdob"></td>
		<td><?php echo form_error('dob'); ?></td>
	</tr>
	<tr>
		<td><label>Address</label></td>
		<td><textarea name="address" class="form-control" style="height:170px; width:500px;" placeholder="Enter address"></textarea></td>
		<td><?php echo form_error('address'); ?></td>
	</tr>
	<tr>
		<td><label>Phone no.</label></td>
		<td><input type="text" name="phone_no" class="numbersOnly form-control" placeholder="Enter mobile number"></td>
		<td><?php echo form_error('phone_no'); ?></td>
	</tr>
	<tr>
		<td><label>Alternate no.</label></td>
		<td><input type="text" name="alternate_no" class="numbersOnly form-control" placeholder="Enter alternate number"></td>
		<td><?php echo form_error('alternate_no'); ?></td>
	</tr>
	<tr>
		<td><label>Salary</label></td>
		<td><input type="text" name="salary" class="numbersOnly form-control" alue="<?php if(isset($salary)) { echo $salary; } ?>" placeholder="0"></td>
		<td><?php echo form_error('salary'); ?></td>
	</tr>
	<tr>
		<td><label>Position</label></td>
		<td><select name="position" class="form-control">
			<option value="" >-Select One-</option>
			<option value="Accountant">Accountant</option>
			<option value="Business Development Executive">Business Development Executive</option>
			<option value="HR Executive">HR Executive</option>
			<option value="HR Manager">HR Manager</option>
			<option value="Mobile Developer">Mobile Developer</option>
			<option value="Project Manager">Project Manager</option>
			<option value="Receptionist">Receptionist</option>
			<option value="Senior Web Developer">Senior Web Developer</option>
			<option value="Software Engineer">Software Engineer</option>
			<option value="Senior UI Developer">Senior UI Developer</option>
			<option value="SEO Executive">SEO Executive</option>
			<option value="Trainee">Trainee</option>
			<option value="UI Developer">UI Developer</option>
			<option value="Web Developer">Web Developer</option>
		</select>
	</td>
	<td><?php echo form_error('position'); ?></td>
</tr>
<tr>
	<td><label>Start date</label></td>
	<td><input type="text" name="start_date" class="form-control" placeholder="Enter start date"  id="datepickerstart" value="<?php if(isset($start_date)) { echo $start_date; } ?>"></td>
	<td><?php echo form_error('start_date'); ?></td>
</tr>
<tr>
	<td><label>Current status</label></td>
	<td><select name="current_status" class="form-control" onchange="addEndDate();" id="current_status" value="<?php if(isset($current_status)) { echo $current_status; } ?>">
		<option value="">-Select One-</option>	
		<option value="Working">Working</option>
		<option value="Resigned">Resigned</option>
	</select>
</td>
<td><?php echo form_error('current_status'); ?></td>
</tr>
<tr id="enddate" style="display:none;">
	<td><label>End date</label></td>
	<td> 
		<input type="text" class="form-control" name="end_date" id="datepickerend" placeholder="Enter end date">	
	</td>
	<td><?php echo form_error('end_date'); ?></td>
</tr>
<tr>
	<td><label>PAN no.</label></td>
	<td><input type="text" name="pan_no" class="form-control" placeholder="Enter PAN card number"></td>
	<td><?php echo form_error('pan_no'); ?></td>
</tr>
<tr>
	<td><label>Bank Detail</label></td>
	<td><textarea name="bank_account_no" class="form-control" style="height:170px; width:500px;" placeholder="Employee Bank Detail"></textarea></td>
	<td><?php echo form_error('bank_account_no'); ?></td>
</tr>

<tr>
	<td><label>Education Qualification</label></td>
	<td><textarea name="qualification" class="form-control" style="height:170px; width:500px;" placeholder="Employee Qualification"></textarea></td>
	<td><?php echo form_error('qualification'); ?></td>
</tr>

<tr>
	<td><label>Comment</label></td>
	<td><textarea name="comment" class="form-control" style="height:170px; width:500px;" placeholder="Comment for employee"></textarea></td>
	<td><?php echo form_error('comment'); ?></td>
</tr>
<tr>
	<td colspan="3" align="right"><input type="submit" name="submit"  onclick="return addemployee_validation();" value="Save" class="button-btn">
		<input type="reset" name="reset" value="Reset" class="button-btn">
	</td>
</tr>
</table>
<?php 
echo form_close();
?>