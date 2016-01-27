<div>
  	<div class="col-sm-12">
  		<p align="center"><span class="h2">Employee list</span></p><br/>
  	</div>
	<div id="search">
		<p align="center"><button id="searchbtn" class="button-btn">Search</button></p>
		<div id="subsearch" style="display:none; align:center;">
			<form name="searchfrm" method="post">
				<table align="center" style="border-bottom: none;">
					<tr>
						<td align="right"><label>Search by:</label></td>
						<td colspan="2">
							<select name="searchby" id="searchby" class="form-control" onchange="viewbox();">
								<option value="">Select one</option>
								<option value="first_name">Name</option>
								<option value="email">Email</option>
								<option value="user_level">User Type</option>
								<option value="salary">Salary</option>
								<option value="position">Position</option>
								<option value="start_date">Start date</option>
								<option value="current_status">Current status</option>
								<option value="end_date">End date</option>
							</select>
						</td>
					</tr>
					<tr id="searchlevel" style="display:none;">
						<td colspan="3">
							<select id="searchkeywordlevel" class="form-control" name="searchkeywordlevel">
								<option value="">Select one</option>
								<option value="1">Employee</option>
							</select>
						</td>
						<td><input type="button" value="Show" class="button-btn" onclick="getuser('searchkeywordlevel');"></td>
					</tr>
					<tr id="searchsalary" style="display:none;">
						<td><input type="txt" class="form-control"  id="searchkeywordmin" name="searchkeywordmin" placeholder="Enter Minimum salary"></td>
						<td><input type="txt" class="form-control"  id="searchkeywordmax" name="searchkeywordmax" placeholder="Enter Maximum salary"></td>
						<td><input type="button" value="Show" class="button-btn" onclick="return checkdata();"></td>
					</tr>
					<tr id="searchpos" style="display:none;">
						<td colspan="3">
							<select id="searchkeywordpos" class="form-control" name="searchkeywordpos">
								<option value="">Select one</option>
								<option value="Accountant">Accountant</option>
								<option value="Business Development Executive">Business Development Executive</option>
								<option value="HR Executive">HR Executive</option>
								<option value="HR Manager">HR Manager</option>
								<option value="Mobile Developer">Mobile Developer</option>
								<option value="Project Manager">Project Manager</option>
								<option value="Receptionist">Receptionist</option>
								<option value="Senior Web Developer">Senior Web Developer</option>
								<option value="Software Engineer">Software Engineer</option>
								<option value="Senior UI Developer">Senior UI Developer</option>
								<option value="SEO Executive">SEO Executive</option>
								<option value="Trainee">Trainee</option>
								<option value="UI Developer">UI Developer</option>
								<option value="Web Developer">Web Developer</option>
							</select>
						</td>
						<td><input type="button" value="Show" class="button-btn" onclick="getuser('searchkeywordpos');"></td>
					</tr>
					<tr id="searchtxt" style="display:none;">
						<td colspan="3">
							<input type="text" class="form-control" id="searchkeyword" name="searchkeyword" placeholder="Enter Keyword">
						</td>
						<td><input type="button" value="Show" class="button-btn" id="showsearch"></td>
					</tr>
					<tr id="searchstatus" style="display:none;">
						<td colspan="3">
							<select id="searchkeywordstatus" class="form-control" name="searchkeywordstatus">
								<option value="">Select one</option>
								<option value="Working">Working</option>
								<option value="Resigned">Resigned</option>
							</select>
						</td>
						<td><input type="button" value="Show" class="button-btn" onclick="getuser('searchkeywordstatus');"></td>
					</tr>
					<tr id="searchdate" style="display:none;">
						<td><input type="text" name="start_date" readonly="readonly" class="form-control"  placeholder="Enter start date"  id="datepickerstart"></td>
						<td><input type="text" name="end_date" readonly="readonly" class="form-control"  placeholder="Enter end date"  id="datepickerend"></td>
						<td><input type="button" value="Show" class="button-btn" onclick="return checkdate();"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div >
		<table id="tblData" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
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
			<tbody id="getdata">
				<?php
				if($query)
				{
				$n=0;
				foreach ($query as $key) 
				{
					$n++;
					if($key['current_status'] == "Resigned")
					{
						echo '<tr style="background:rgb(236, 185, 185);">';
					}
					else
					{
						echo '<tr>';
					}
					?>
						<td><?php echo $n; ?></td>
						<td><?php echo $key['first_name']." ".$key['last_name']; ?></td>
						<td><?php echo $key['email']; ?></td>
						<td><?php if($key['user_level']==1){ echo "Employee"; }else{ echo "Admin"; }  ?></td>
						<td><?php echo $key['salary']; ?></td>
						<td><?php echo $key['position']; ?></td>
						<td><?php echo $key['start_date']; ?></td>
						<td><?php echo $key['current_status']; ?></td>
						<td><?php if($key['end_date']=='0000-00-00' || $key['end_date']==""){ echo "None"; }else{ echo $key['end_date']; }  ?></td>
						<td>
							<a href="#"><button data-toggle="modal" data-target="#myModal" style="width: 90px;background-color: #079655;" class="mybutton-view">Increament</button></a>
							<a href="<?php echo base_url();?>view-employee-detail/<?php echo $key['id']; ?>"><button class="mybutton-view">View</button></a>
							<a href="<?php echo base_url();?>admin/update/<?php echo $key['id']; ?>"><button class="mybutton-update">Edit</button></a>
							<button onclick="deleteuser(<?php echo $key['id']; ?>);" class="mybutton-delete">Delete</button>
						</td>
					</tr>
					<?php
						}
					}
					else
					{
						?>
						<tr>
							<td align="center" colspan="10">There is no data in table to show</td>
						</tr>
						<?php
					}
					?>
			</tbody>
		</table>
         <!-- Modal -->
         <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add increament to employee</h4>
              </div>
              <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <div class="form-group">
					<label class="control-label col-sm-3" for="address">Employee name:</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address">Amount</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"></pre>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address">Apply date</label>
					<div class="col-sm-8"> 
						<pre class="plain-text"></pre>
					</div>
				</div>
                  <button style="float:right;" type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                  <button style="float:right;" type="submit" class="btn btn-default">Submit</button>
                </form>
              </div>
              <div class="modal-footer">

              </div>
            </div>

          </div>
        </div>

	</div>
</div>