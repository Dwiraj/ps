
<h1 align="center">Update salary register</h1>
<p align="center">
<?php 
	switch ($month) 
	{
		case '1':
			$mon = "January";
			break;
		case '2':
			$mon = "February";
			break;
		case '3':
			$mon = "March";
			break;
		case '4':
			$mon = "April";
			break;
		case '5':
			$mon = "May";
			break;
		case '6':
			$mon = "June";
			break;
		case '7':
			$mon = "July";
			break;
		case '8':
			$mon = "August";
			break;
		case '9':
			$mon = "September";
			break;
		case '10':
			$mon = "October";
			break;
		case '11':
			$mon = "November";
			break;
		case '12':
			$mon = "December";
			break;
	}
?>
	Month: <?php  echo $mon; ?>, Year: <?php echo $year;?>	
</p>
<form name="update_salary_register" method="POST" action="edit-salary-register">
<table class="table" id="tblData">
	<thead>
		<tr>
			<th style="display:none;"><input type="checkbox" name="selectall" id="selectall"></th>
			<th>No</th>
			<th>Name</th>
			<th>Working days</th>
			<th>Base salary</th>
			<th>Bonus</th>
			<th>PT</th>
			<th>ESI</th>
			<th>TDS</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$n=0; 
		if($query == false)
		{
			?>
			<tr>
				<td align="center" colspan="10">There Is no data in table to show</td>
			</tr>
			<?php
		}
		else
		{
		foreach ($query as $key) 
		{
			$n++;
			?>
			<tr><input type="hidden" name="uid<?php echo $n; ?>" value="<?php echo $key['employee_id']; ?>">
					<input type="hidden" name="created_by<?php echo $n; ?>" value="<?php echo $key['created_by']; ?>">
					<input type="hidden" name="created_date<?php echo $n; ?>" value="<?php echo $key['created_date']; ?>">
					<input type="hidden" name="salary<?php echo $n; ?>" id="salary<?php echo $n; ?>" value="<?php echo round($key['salary']); ?>">
				<td style="display:none;"><input type="checkbox" checked name="autoload<?php echo $n; ?>" id="autoload<?php echo $n; ?>" value=""></td>
				<td><?php echo $n; ?></td>
				<td><?php echo $key['first_name'].' '.$key['last_name']; ?></td>
				<td><input type="text" class="numbersOnly" size="10px" name="working_days<?php echo $n; ?>" id="working_days<?php echo $n; ?>" value="<?php echo $key['working_days']; ?>"></td>
				<td><input type="text" class="numbersOnly" size="10px" onblur="get_total(<?php echo $n; ?>);" name="base_salary<?php echo $n; ?>" id="base_salary<?php echo $n; ?>" value="<?php echo round($key['base_salary']); ?>"></td>
				<td><input type="text" class="numbersOnly" size="10px" onblur="get_total(<?php echo $n; ?>);" name="bonus<?php echo $n; ?>" id="bonus<?php echo $n; ?>" value="<?php echo round($key['bonus']); ?>"></td>
				<td><input type="text" class="numbersOnly" size="10px" onblur="manual_total(<?php echo $n; ?>);" name="pt<?php echo $n; ?>" id="pt<?php echo $n; ?>" value="<?php echo round($key['pt']); ?>"></td>
				<td><input type="text" class="numbersOnly" size="10px" onblur="manual_total(<?php echo $n; ?>);" name="esi<?php echo $n; ?>" id="esi<?php echo $n; ?>" value="<?php echo round($key['esi']); ?>"></td>
				<td><input type="text" class="numbersOnly" size="10px" onblur="manual_total(<?php echo $n; ?>);" name="tds<?php echo $n; ?>" id="tds<?php echo $n; ?>" value="<?php echo round($key['tds']); ?>"></td>
				<td><input type="text" class="numbersOnly" size="10px" name="total<?php echo $n; ?>" id="total<?php echo $n; ?>" placeholder="0" value="<?php echo round($key['total']); ?>"></td>
			</tr>
			<?php	} ?>
		</tbody>
		<tbody>
			<tr>
				<td colspan="3" align="right" style="color:red; font-size:18px; "><b>Total </b>:</td>
				<td><input type="text" class="numbersOnly" size="10px" name="total_bs" id="total_bs"></td>
				<td><input type="text" class="numbersOnly" size="10px" name="total_bonus" id="total_bonus"></td>
				<td><input type="text" class="numbersOnly" size="10px" name="total_pt" id="total_pt"></td>
				<td><input type="text" class="numbersOnly" size="10px" name="total_esi" id="total_esi"></td>
				<td><input type="text" class="numbersOnly" size="10px" name="total_tds" id="total_tds"></td>
				<td><input type="text" class="numbersOnly" size="10px" name="total_t" id="total_t"></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<input type="hidden" name="index" id="index" value="<?php echo $n; ?>">
	<input type="hidden" name="month" value="<?php echo $month; ?>">
	<input type="hidden" name="year" value="<?php echo $year; ?>">
	<p align="center">
		<input type="submit" onclick="return check_validation();" class="button-btn" value="Save" >
	</p>
</form>
