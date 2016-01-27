<h2 align="center">View admin</h2>
<!-- <p align="center">
	<label for="search">
		<strong>Search </strong>
	</label>
	<input type="text" id="search"/>
</p> -->
<table id="tblData" class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>First name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>User Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$n=0;
		foreach ($query as $key) 
		{
			$n++;
			?>
			<tr>
				<td><?php echo $n; ?></td>
				<td><?php echo $key['first_name']; ?></td>
				<td><?php echo $key['last_name']; ?></td>
				<td><?php echo $key['email']; ?></td>
				<td><?php if($key['user_level']==1){ echo "Employee"; }else{ echo "Admin"; }  ?></td>
				<td>
					<a href="<?php echo base_url();?>admin/update/<?php echo $key['id']; ?>"><button class="mybutton-update">Edit</button></a>
					<a href="<?php echo base_url();?>admin/deleteuser/<?php echo $key['id']; ?>"><button class="mybutton-delete">Delete</button></a>
				</td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>