<style type="text/css">
	.button-btn {
		background: #231f20;
		border: 1px solid #CCC;
		padding: 7px 15px 7px 15px;
		color: #ffffff;
		border-radius: 4px;
	}
</style>
<h2 align="center">Employee salary record</h2>
<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
			<form  role="form">
				<div class="form-group">
					<label for="email">Employee name </label>
					<select class="form-control" name="employee_id" id="employee_id">
						<option value="">Select one</option>
						<?php
						foreach ($query as $key)
						{
							?>
							<option value="<?php echo $key['id'];?>"><?php echo $key['first_name']." ".$key['last_name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="startdate">Start date </label>
						<input type="text" class="form-control" id="datepickerstart">
					</div>
					<div class="form-group">
						<label for="enddate">End date </label>
						<input type="text" class="form-control" id="datepickerend">
					</div>	
					<p align="center" style="margin-top:20px;">
						<input type="button" class="button-btn" name="show_date" id="show_date" value="Show">
					</p>
				</form>
			</div>
			<div class="col-sm-4">
			</div> 	      
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table align="center" class="table" width="100%">
						<thead>
							<tr>
								<th rowspan="2" style="text-align:center;">No</th>
								<th rowspan="2" style="text-align:left;">Month/Year</th>
								<th rowspan="2" style="text-align:right;">Base salary</th>
								<th rowspan="2" style="text-align:right;">Bonus</th>
								<th colspan="3" style="text-align:center;">Deductions</th>
								<th rowspan="2" style="text-align:right;">Total</th>
							</tr>
							<tr>
								<th style="text-align:right;">PT</th>
								<th style="text-align:right;">ESI</th>
								<th style="text-align:right;">TDS</th>
							</tr>
						</thead>
						<tbody id="tblData">
							<tr>
								<td colspan="8" align="center">There is no data in table</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>