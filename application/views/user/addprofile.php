<div class="container">
  <div class="row">
  	<div class="col-sm-12">
  		<p align="center"><span class="h2"><b>Create employee profile</b></span></p><br/>
  	</div>
  	<div class="col-sm-2"></div>
  	<div class="col-sm-10">
  		<form class="form-horizontal" role="form" method="POST" action="createprofile">
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="address">Address:</label>
			    <div class="col-sm-6">
			      <textarea class="form-control" id="address" name="address" placeholder="Enter postal address"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="dob">Birth date</label>
			    <div class="col-sm-6"> 
			      <input type="text" class="form-control" id="datepickerdob" name="dob" placeholder="Enter mobile number">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="mobileno">Mobile No:</label>
			    <div class="col-sm-6"> 
			      <input type="text" class="numbersOnly form-control" id="mobile" name="mobile" maxlength="10" placeholder="Enter mobile number">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="otherno">Other No:</label>
			    <div class="col-sm-6"> 
			      <input type="text" class="numbersOnly form-control" id="other" name="other" maxlength="10" placeholder="Enter alternate number">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="panno">PAN No:</label>
			    <div class="col-sm-6"> 
			      <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter pan card number">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="accounton">Bank account No:</label>
			    <div class="col-sm-6"> 
			      <input type="text" class="numbersOnly form-control" id="bank_acc" name="bank_acc" placeholder="Enter bank account number">
			    </div>
			  </div>
			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-6">
			      <button type="submit" onclick="return profile_validation();" name="submit" id="submit" class="btn btn-default">Create</button>
			      <button type="reset" name="reset" id="reset" class="btn btn-default">Reset</button>
			    </div>
			  </div>
			</form>
  	</div>
  </div>
</div>