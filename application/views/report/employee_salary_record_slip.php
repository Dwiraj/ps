<?php 
	include("application/views/pdf_header.php");
	$start = date("F", mktime(null, null, null, $s_month, 1))." ".$s_year; 
	$end = date("F", mktime(null, null, null, $e_month, 1))." ".$e_year;
	if($start == $end)
	{
		$period = $start;
	}
	else
	{
		$period = $start." to ".$end;
	}
	?>

	<h2 align="center">Employee salary slip</h2>
	<div class="container">
		<div class="row">
				<p align="center" style="text-size:30px;margin-top:-10px;"><b>Period :- </b> <?php echo $period; ?>.<br/>
					This salary slip is for <b><?php echo $employee -> salutation." ".$user -> first_name." ".$user -> last_name; ?> </b>  for working as an employee at Professional Soft-Tech. 
				</p>
			<div class="col-sm-12">
				<div class="table-responsive">
				  <table align="center" width="100%">
						<thead>
							<tr>
								<th rowspan="2" style="text-align:right;padding:10px">No</th>
								<th rowspan="2" style="text-align:left;padding:10px">Month/Year</th>
								<th rowspan="2" style="text-align:right;padding:10px">Gross salary</th>
								<th colspan="3" style="text-align:center;padding:10px">Deductions</th>
								<th rowspan="2" style="text-align:right;padding:10px">Paid amount</th>
							</tr>
							<tr>
								<th style="text-align:right;padding:10px">PT</th>
								<th style="text-align:right;padding:10px">ESI</th>
								<th style="text-align:right;padding:10px">TDS</th>
							</tr>
						</thead>
						<tbody id="tblData">
						<?php 
								$n = 0;
								$deductions = 0;
								$t_gs = 0;
								$t_pt = 0;
								$t_esi = 0;
								$t_tds = 0;
								$t_total = 0;
								foreach ($result as $key) 
								{
									if(isset($key['0']))
									{
									$n++;
						?>
							<tr>
								<td align="right" style="padding:10px;"><?php echo $n; ?></td>
								<td align="left" style="padding:10px;"><?php echo date("F", mktime(null, null, null, $key['0'] -> month, 1)).", ".$key['0'] -> year; ?></td>
								<td align="right" style="padding:10px;"><?php echo $key['0'] -> base_salary + $key['0'] -> bonus; ?></td>
								<td align="right" style="padding:10px;"><?php echo $key['0'] -> pt;?></td>
								<td align="right" style="padding:10px;"><?php echo $key['0'] -> esi;?></td>
								<td align="right" style="padding:10px;"><?php echo $key['0'] -> tds;?></td>
								<td align="right" style="padding:10px;"><b><?php echo $key['0'] -> total; ?></b></td>
							</tr>
							<?php 
								$t_gs += $key['0'] -> base_salary + $key['0'] -> bonus ;
								$t_pt += $key['0'] -> pt ;
								$t_esi += $key['0'] -> esi ;
								$t_tds += $key['0'] -> tds ;
								$t_total += $key['0'] -> total ;
									}
								}
							?>
							<tr>
								<td style="text-align:right;padding:10px" colspan="2"><b>Total</b></td>
								<td style="text-align:right;padding:10px"><b><?php echo $t_gs;?></b></td>
								<td style="text-align:right;padding:10px"><b><?php echo $t_pt;?></b></td>
								<td style="text-align:right;padding:10px"><b><?php echo $t_esi;?></b></td>
								<td style="text-align:right;padding:10px"><b><?php echo $t_tds;?></b></td>
								<td style="text-align:right;padding:10px"><b><?php echo $t_total;?></b></td>
							</tr>
						</tbody>
				  </table>
				</div>
			</div>
		</div>
	</div>
	<p style="margin-left:15px;margin-top:-5px;"><h3><b>For Professional Soft-Tech,</b></h3><br/><br/>
	_____________________________________________
	</p>
<?php
	//include("application/views/pdf_footer.php");
?>