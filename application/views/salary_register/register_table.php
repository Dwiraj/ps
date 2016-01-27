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
if(isset($error))
{
	echo "<div align='center'><div><span style='color:red;font-size:20px;'>".$error."</span></div>";
	echo '<div><button onclick="viewregister('; echo "'".$month."'"; echo ', '; echo "'".$year."'"; echo');" class="btn btn-danger">View</button></div></div>';
}
else
{
		
	echo'
	<p align="center">
		Month: '.$mon.', Year: '.$year.'.	
	</p>
	<form name="add_salary_register" id="add_salary_register" method="POST" action="add-new-salary-register">
		<table class="table">
			<thead>
				<tr>
					<th><input type="checkbox" name="selectall" id="selectall"></th>
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
			<tbody>';
				$n=0; 
				foreach ($query as $key) 
				{
					$n++;
					echo'<tr><input type="hidden" name="uid'.$n.'" value="'.$key['employee_id'].'">
									<input type="hidden" name="salary'.$n.'" id="salary'.$n.'" value="'.$key['salary'].'">
					<td><input type="checkbox" checked name="autoload'.$n.'" id="autoload'.$n.'" value=""></td>
					<td>'.$n.'</td>
					<td>'.$key['first_name'].' '.$key['last_name'].'</td>
					<td><input type="text" size="10px" onblur="cal_workingday('.$n.');" name="working_days'.$n.'" id="working_days'.$n.'" value="26"></td>
					<td><input type="text" size="10px" onblur="get_total('.$n.');" name="base_salary'.$n.'" id="base_salary'.$n.'" value="'.$key['salary'].'"></td>
					<td><input type="text" size="10px" onblur="get_total('.$n.');" name="bonus'.$n.'" id="bonus'.$n.'" value="0"></td>
					<td><input type="text" size="10px" onblur="manual_total('.$n.');" name="pt'.$n.'" id="pt'.$n.'" value="0"></td>
					<td><input type="text" size="10px" onblur="manual_total('.$n.');" name="esi'.$n.'" id="esi'.$n.'" value="0"></td>
					<td><input type="text" size="10px" onblur="manual_total('.$n.');" name="tds'.$n.'" id="tds'.$n.'" value="0"></td>
					<td><input type="text" size="10px" name="total'.$n.'" id="total'.$n.'" value="0"></td>
				</tr>';
			}
			echo'</tbody>
				<tbody>
				<tr>
					<td colspan="4" align="right" style="color:red; font-size:18px; "><b>Total </b>:</td>
					<td><input type="text" readonly size="10px" name="total_bs" id="total_bs"></td>
					<td><input type="text" readonly size="10px" name="total_bonus" id="total_bonus"></td>
					<td><input type="text" readonly size="10px" name="total_pt" id="total_pt"></td>
					<td><input type="text" readonly size="10px" name="total_esi" id="total_esi"></td>
					<td><input type="text" readonly size="10px" name="total_tds" id="total_tds"></td>
					<td><input type="text" readonly size="10px" name="total_t" id="total_t"></td>
				</tr>
			</tbody>
			</table>
			<input type="hidden" name="index" id="index" value="'.$n.'">
			<input type="hidden" name="month" value="'.$month.'">
			<input type="hidden" name="year" value="'.$year.'">
			<p align="center">
				<input type="submit" onclick="return check_validation();" class="button-btn" value="Save" >
			</p>
		</form>';
	}
	?>