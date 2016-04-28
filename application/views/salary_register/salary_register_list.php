
<h2 align="center">Salary register list</h2>
<div align="center">
	<a href="<?php echo base_url()?>new-salary-register">
		<button class="button-btn">Create new</button>
	</a>
</div>
<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th style="width:175px;">Month</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$n=0;
		if(empty($query))
		{
		?>
			<tr>
				<td colspan="3" style="text-align:center;">There is no data in table</td>
			</tr>
		<?php
		}
		else
		{
			foreach ($query as $key)
			{
				switch ($key['month'])
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
				$n++;
			?>
			<tr>
				<td><?php echo $n; ?></td>
				<td style="width:175px;"><?php echo $mon." ".$key['year']; ?></td>
				<td>
					<button onclick="view_list('<?php echo $key['month'];?>', '<?php echo $key['year']; ?>');" class="mybutton-view"><span class="glyphicon glyphicon-save"></span> PDF</button>&nbsp;&nbsp;
					<button onclick="view_tds('<?php echo $key['month'];?>', '<?php echo $key['year']; ?>');" class="mybutton-view"><span class="glyphicon glyphicon-save"></span> TDS</button>&nbsp;&nbsp;
					<button onclick="edit_list('<?php echo $key['month'];?>', '<?php echo $key['year']; ?>');" class="mybutton-update">Edit</button>&nbsp;&nbsp;
					<button onclick="delete_list('<?php echo $key['month'];?>', '<?php echo $key['year']; ?>');" class="mybutton-delete">Delete</button>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>