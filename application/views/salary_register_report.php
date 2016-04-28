

<body>
	<?php
	include ('pdf_header.php'); 
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
	<h1 align="center">Salary register</h1>
	<h3 align="center"> Month: <?php echo $mon;?>, Year: <?php echo $year;?></h3>
	<table align="center" style="width:100%;">
		<thead>
			<tr>
				<th rowspan="2" style="width:5%;text-align: center; padding:20px;">Sr.</th>
				<th rowspan="2" style="width:20%;text-align: left; 	padding:20px;">Employee name</th>
				<th rowspan="2" style="width:8%;text-align: right; 	padding:20px;">Present days</th>
				<th rowspan="2" style="width:8%;text-align: right; 	padding:20px;">Gross salary</th>
				<th colspan="3" style="width:8%;text-align: center; padding:20px;">Deductions</th>
				<th rowspan="2" style="width:9%;text-align: right; 	padding:20px;">Net pay</th>
				<th rowspan="2" style="width:25%;text-align: center; padding:20px;">Signature</th>
			</tr>
			<tr>
				<th style="width:8%;text-align: right; 	padding:20px;">PT</th>
				<th style="width:8%;text-align: right; 	padding:20px;">ESI</th>
				<th style="width:8%;text-align: right; 	padding:20px;">TDS</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$n = 0;
			$t_gs = 0;
			$pt = 0;
			$esi = 0;
			$tds = 0;
			$total = 0;
			$gs = 0;
			foreach($query as $row)
			{
				$n++;
				$gs = $row['base_salary'] + $row['bonus'];

				?>
				<tr>
					<td style="width:5%; height:100px;text-align: center;padding:20px;"><?php echo $n; ?>.</td>
					<td style="width:20%;height:100px;text-align: left;padding:20px;"><?php echo $row['first_name']." ".$row['last_name'] ; ?></td>
					<td style="width:8%; height:100px;text-align:right;padding:20px;"><?php echo $row['working_days']; ?></td>
					<td style="width:8%; height:100px;text-align:right;padding:20px;"><?php echo round($gs); ?></td>
					<td style="width:8%; height:100px;text-align:right;padding:20px;"><?php echo round($row['pt']); ?></td>
					<td style="width:8%; height:100px;text-align:right;padding:20px;"><?php echo round($row['esi']); ?></td>
					<td style="width:8%; height:100px;text-align:right;padding:20px;"><?php echo round($row['tds']); ?></td>
					<td style="width:9%; height:100px;text-align:right;padding:20px;"><b><?php echo round($row['total']); ?></b></td>
					<td style="width:25%;height:100px;text-align: right; padding:20px;"></td>
				</tr>	
				<?php 
				$t_gs += $gs;
				$pt += $row['pt'];
				$esi += $row['esi'];
				$tds += $row['tds'];
				$total += $row['total'];
				$gs = 0;
			}
			?>
			<tr>
				<td colspan="3" style="text-align: right;padding:20px;"><b>Total</b></td>
				<td style="text-align: right;padding:20px;"><b><?php echo $t_gs ;?></b></td>
				<td style="text-align: right;padding:20px;"><b><?php echo $pt ;?></b></td>
				<td style="text-align: right;padding:20px;"><b><?php echo $esi ;?></b></td>
				<td style="text-align: right;padding:20px;"><b><?php echo $tds ;?></b></td>
				<td style="text-align: right;padding:20px;"><b><?php echo $total ;?></b></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>