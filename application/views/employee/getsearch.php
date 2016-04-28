<?php
echo'<thead>
<tr>
	<th>No</th>
	<th>First name</th>
	<th>Email</th>
	<th>User Type</th>
	<th>Salary</th>
	<th>Position</th>
	<th>Start date</th>
	<th>Current status</th>
	<th>End date</th>
	<th>Action</th>
</tr>
</thead>
<tbody>';
	$n=0;
	foreach ($query as $key) 
	{
		$n++;
		echo'<tr>
		<td>'.$n.'</td>
		<td>'.$key['first_name'].' '.$key['last_name'].'</td>
		<td>'.$key['email'].'</td>
		<td>'; if($key['user_level']==1){ echo "Employee"; }else{ echo "Admin"; }  echo'</td>
		<td>'.$key['salary'].'</td>
		<td>'.$key['position'].'</td>
		<td>'.$key['start_date'].'</td>
		<td>'.$key['current_status'].'</td>
		<td>'; if($key['end_date']=='0000-00-00'){ echo "None"; }else{ echo $key['end_date']; }  echo'</td>
		<td><a href="'.base_url().'admin/update/'.$key['employee_id'].'"><button class="mybutton-update">Update</button></a>
			<button onclick="deleteuser('.$key['employee_id'].');" class="mybutton-delete">Delete</button></td>
		</tr>';
	}
	echo '</tbody>';
	?>