  <div class="container">
    <div class="row">
      <?php 
      if($query1 != "Not Set")
      {
        ?>
        <div class="col-sm-3">
         <img style="margin-top:30px; margin-left:50px;" src="<?php echo image_path($profile_picture);?>" class="img-rounded" alt="<?php echo $query -> first_name." ".$query -> last_name;?>" title="<?php echo $query -> first_name." ".$query -> last_name;?>" width="150" height="190">
         <button style="margin-top:35px; margin-left:75px;" data-toggle="modal" data-target="#myModal">Change photo</button>

         <!-- Modal -->
         <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change profile picture</h4>
              </div>
              <div class="modal-body">
                <form action="<?php echo base_url();?>user/photo_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <div class="form-group">
                    <label for="photo">Choose image:</label>
                    <input type="file" class="form-control" id="userfile" name="userfile">
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

      <div class="col-sm-6">
       <span class="h2"><b><?php echo $query -> first_name." ".$query -> last_name;?></b></span><br/><br/>
       <span class="h4"><b>Position</b></span>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<span class="h4"> <?php echo $position ;?></span><br/><br/>
       <span class="h4"><b>Joining date</b></span>&emsp;&emsp;&emsp;&emsp;&nbsp;<span class="h4"><?php echo $start_date; ;?></span><br/><br/>
       <span class="h4"><b>Contact detail</b></span>&emsp;&emsp;&emsp;&nbsp;<span class="h4"><?php echo $contact;?></span><br/><br/>
       <span class="h4"><b>Email address</b></span>&emsp;&emsp;&emsp;<span class="h4"><?php echo $query -> email;?></span><br/><br/>
       <span class="h4"><b>Postal address</b></span>&emsp;&emsp;&ensp;<span class="h4"><?php echo $address;?></span><br/><br/>
       <span class="h4"><b>Date of birth</b></span>&emsp;&emsp;&emsp;&emsp;<span class="h4"><?php echo $dob;?></span><br/><br/>
       <span class="h4"><b>Current status</b></span>&emsp;&emsp;&emsp;<span class="h4"><?php echo $current_status;?></span><br/><br/>
     </div>

     <div class="col-sm-3">
     </div>

     <div class="col-sm-12">
       <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1"><b>Education Detail</b></a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <ul class="list-group">
              <li class="list-group-item"><pre><?php if(isset($query1 -> qualification)) {echo $query1 -> qualification; } else { echo "There is no educational details added for ".$query -> first_name;} ?></pre></li>
            </ul>
            <!-- <div class="panel-footer">Footer</div> -->
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
     <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse2"><b>Salary Detail</b></a>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item">One</li>
            <li class="list-group-item">Two</li>
            <li class="list-group-item">Three</li>
          </ul>
          <div class="panel-footer">Footer</div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse3"><b>Leave Detail</b></a>
          </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item">One</li>
            <li class="list-group-item">Two</li>
            <li class="list-group-item">Three</li>
          </ul>
          <div class="panel-footer">Footer</div>
        </div>
      </div>
    </div>
  </div>

  <?php 
}
else
{
  ?>
  <div class="col-sm-12">
    <p align="center"><span class="h2"><b><?php echo $query -> first_name;?> </b></span><span class="h4"> your profile is not created</span><br/><br/>
     <!--  <a href="<?php //echo base_url('user/createprofile');?>" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> Create profile</a><br/><br/> --></p>
   </div>
   <?php
 }
 ?>
</div>
</div>