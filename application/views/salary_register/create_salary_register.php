<h2 align="center">Create new salary register</h2>
<h5 align="center">(Create new salary register by selecting month and year)</h5>
<table style="border-bottom:none;">
	<tr>
		<td style="padding: 0 0 0 25px;"><label>Month :</label></td>
		<td style="padding: 0 0 0 25px;"><select name="month" id="month">
			<option value="">Select Month</option>
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
	</td>
	<td style="padding: 0 0 0 25px;"><label>Year :</label></td>
	<td style="padding: 0 0 0 25px;"><input type="text" class="numbersOnly form-control" id="year" maxlength="4" size="10" placeholder="Enter Year" value="<?php echo date('Y');?>"></td>
	<td style="padding: 0 0 0 25px;"><button class="button-btn" onclick="return getdata();">Create</button></td>
</tr>
</table>
<div id="tblData">
	
</div>