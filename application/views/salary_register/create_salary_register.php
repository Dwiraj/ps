<div class="container">
	<h2 align="center">Create new salary register</h2>
	<h5 align="center">(Create new salary register by selecting month and year)</h5>
	<hr/>
	<div class="col-md-2"></div>
	<form class="form-inline col-md-8" role="form">
  		<div class="form-group col-md-4">
			<label for="month">Month :</label>
			<select name="month" class="form-control" id="month">
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
		</div>
  		<div class="form-group col-md-4">
			<label for="year">Year :</label>
			<input type="text" class="numbersOnly form-control" id="year" maxlength="4" size="10" placeholder="Enter Year" value="<?php echo date('Y');?>">
		</div>
		<div class="col-md-4">
			<button class="btn btn-primary button-btn" onclick="return getdata();">Create</button>
		</div>
	</form>
	<div class="col-md-2"></div>
	<div id="tblData">

	</div>
</div>