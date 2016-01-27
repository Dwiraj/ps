<?php 
	include("application/views/pdf_header.php");
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
<h2 align="center">TDS record</h2>
	<h3 align="center"> Month: <?php echo $mon;?>, Year: <?php echo $year;?></h3>
<table align="center" width="70%">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Gross salary</th>
			<th>TDS</th>

		</tr>
	</thead>
	<tbody>
		<?php 
			$n = 0 ;
			$total_gross = 0 ;
			$total_tds  = 0 ;
			foreach ($result as $key) 
			{
				$n++;
				$gross_salary = $key['base_salary'] + $key['bonus'];
		?>
		<tr>
			<td style="text-align:center;"><?php echo $n; ?></td>
			<td><?php echo $key['first_name']." ".$key['last_name']; ?></td>
			<td style="text-align:right;"><?php echo $gross_salary; ?></td>
			<td style="text-align:right;"><?php echo $key['tds']; ?></td>
		</tr>
		<?php
			$total_gross += $gross_salary; 
			$total_tds += $key['tds'];
			}
		?>
		<tr>
			<td colspan="2" style="text-align:right;"><b>Total</b></td>
			<td style="text-align:right;"><b><?php echo $total_gross; ?></b></td>
			<td style="text-align:right;"><b><?php echo $total_tds; ?></b></td>
		</tr>
	</tbody>
</table>