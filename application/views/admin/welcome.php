
	<h1 align="center">
		Welcome
	</h1>
	<?php
		if($event != false)
		{
	?>
	<div class="container">
    <div class="row">
     <div class="col-sm-12">
       <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1"><b>Today's events</b></a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <ul class="list-group">
              <li class="list-group-item"><?php foreach ($event as $key) { echo "<b>".$key['first_name']." ".$key['last_name']."</b>, "; } ?> have birthday today<span style="color:red;" class="glyphicon glyphicon-gift"></span></li>
            </ul>
            <!-- <div class="panel-footer">Footer</div> -->
          </div>
        </div>
      </div>
    </div>
    <?php 
        } 
      if($month_event != false)
      {
    ?>
      <div class="col-sm-12">
       <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse2"><b>Events on this month</b></a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <ul class="list-group">
              <li class="list-group-item"><?php foreach ($month_event as $key) { echo "<b>".$key['first_name']." ".$key['last_name']."</b>, "; } ?> have birthday in this month<span style="color:red;" class="glyphicon glyphicon-gift"></span></li>
            </ul>
            <!-- <div class="panel-footer">Footer</div> -->
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
   </div>
  </div> 
