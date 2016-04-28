/**
* List of function in this file:
-------------------------------------------
*		2. adduser_validation()
*		3. updateuser()
*		4. addemployee_validation()
*		5. addEndDate()
*		6. updateemployee_validation()
*		7. profile_validation()
*		8. change_password_validation()
--------------------------------------------
*/



$(function() {
	$("#datepickerstart").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }).val();
	$("#datepickerend").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }).val();
	$("#datepickerdob").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }).val();
});

jQuery('.numbersOnly').keyup(function () { this.value = this.value.replace(/[^0-9\.]/g,'');	});

if($('#number').is(':visible'))
{
	$('#number').onkeydown = function(n) {
		if(n.keyCode == 69 || n.keyCode == 109 || n.keyCode == 107 || n.keyCode == 187 || n.keyCode == 107 || n.keyCode == 189|| n.keyCode == 46|| n.keyCode == 190|| n.keyCode == 110 ) {
			return false;
		}
	};
}

/*
 * @function return adduser_validation()
 * @param
 * @return boolean
 *
 * this function is use for validation of form add user form
 *
 */
/*function adduser_validation()
{
	var reg 	   	= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var fname		= document.forms["myform"]["first_name"].value;
	var lname		= document.forms["myform"]["last_name"].value;
	var email 		= document.forms["myform"]["email"].value;
	var user_level	= document.forms["myform"]["user_level"].value;
	var password 	= document.forms["myform"]["password"].value;
	var cpassword 	= document.forms["myform"]["cpassword"].value;

	if(fname.trim() === "" && lname.trim() === "" && email.trim() === "" && user_level.trim() === "" && password.trim() === "" && cpassword.trim() === "")
	{
		$("#error_massege").show();
		$("#error_massege").html('Please fill appropriate details...!!!');
		document.forms["myform"]["first_name"].focus();
		return false;
	}
	else
	{
		if(fname.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('First name is required...!!!');
			document.forms["myform"]["first_name"].focus();
			return false;
		}
		if(lname.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Last name is required...!!!');
			document.forms["myform"]["last_name"].focus();
			return false;
		}
		if(email.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Email  is required...!!!');
			document.forms["myform"]["email"].focus();
			return false;
		}
		else
		{
			if( ! email.match(reg))
			{
				$("#error_massege").show();
				$("#error_massege").html('Email is not valid...!!!');
				document.forms["myform"]["email"].focus();
				return false;
			}
		}
		if(user_level.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('User type is required...!!!');
			document.forms["myform"]["user_level"].focus();
			return false;
		}
		if(password.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Password is required...!!!');
			document.forms["myform"]["password"].focus();
			return false;
		}
		if(cpassword.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Confirm password is required...!!!');
			document.forms["myform"]["cpassword"].focus();
			return false;
		}
		else
		{
			if(password.trim() == cpassword.trim())
			{
				return true;
			}
			else
			{
				$("#error_massege").show();
				$("#error_massege").html('Password does not match...!!!');
				document.forms["myform"]["cpassword"].focus();
				return false;
			}
		}
	}
}*/

/*
 * @function return updateuser()
 * @param
 * @return boolean
 *
 * this function is use for validation of form update form
 *
 */
/*function updateuser()
{
	var reg 	   	= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var fname		= document.forms["updatefrm"]["first_name"].value;
	var lname		= document.forms["updatefrm"]["last_name"].value;
	var email 		= document.forms["updatefrm"]["email"].value;
	var user_level	= document.forms["updatefrm"]["user_level"].value;

	if(fname.trim() === "" && lname.trim() === "" && email.trim() === "" && user_level.trim() === "")
	{
		$("#error_massege").show();
		$("#error_massege").html('Please fill appropriate details...!!!');
		document.forms["updatefrm"]["first_name"].focus();
		return false;
	}
	else
	{
		if(fname.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('First name is required...!!!');
			document.forms["updatefrm"]["first_name"].focus();
			return false;
		}
		if(lname.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Last name is required...!!!');
			document.forms["updatefrm"]["last_name"].focus();
			return false;
		}
		if(email.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Email  is required...!!!');
			document.forms["updatefrm"]["email"].focus();
			return false;
		}
		else
		{
			if( ! email.match(reg))
			{
				$("#error_massege").show();
				$("#error_massege").html('Email is not valid...!!!');
				document.forms["updatefrm"]["email"].focus();
				return false;
			}
		}
		if(user_level.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('User type is required...!!!');
			document.forms["updatefrm"]["user_level"].focus();
			return false;
		}
	}
}*/

/*
 * @function return addemployee_validation()
 * @param
 * @return boolean
 *
 * this function is use for validation of form add employee
 *
 */
/*function addemployee_validation()
{
	var numreg = /^(\d{1,3},)*(\d{1,3})+(\.\d{2})?$/;
	var salary = document.forms["addemployee"]["salary"].value;
	var position = document.forms["addemployee"]["position"].value;
	var start_date = document.forms["addemployee"]["start_date"].value;
	var current_status = document.forms["addemployee"]["current_status"].value;

	if(salary.trim() === "" && position.trim() === "" && start_date.trim() === "" && current_status.trim() === "")
	{
		$("#error_massege").show();
		$("#error_massege").html('Please fill appropriate details...!!!');
		document.forms["addemployee"]["salary"].focus();
		return false;
	}
	else
	{
		if(salary.trim() === "" )
		{
			$("#error_massege").show();
			$("#error_massege").html('Please enter salary...!!!');
			document.forms["addemployee"]["position"].focus();
			return false;
		}
		if( ! salary.match(numreg))
		{
			$("#error_massege").show();
			$("#error_massege").html('Salary is not valid please enter numbers...!!!');
			document.forms["addemployee"]["salary"].focus();
			return false;
		}
		if(position.trim() === "" )
		{
			$("#error_massege").show();
			$("#error_massege").html('Please select position...!!!');
			document.forms["addemployee"]["position"].focus();
			return false;
		}
		if(start_date.trim() === "" )
		{
			$("#error_massege").show();
			$("#error_massege").html('Please select start date...!!!');
			document.forms["addemployee"]["start_date"].focus();
			return false;
		}
		if(current_status.trim() === "")
		{
			$("#error_massege").show();
			$("#error_massege").html('Please enter current job status...!!!');
			document.forms["addemployee"]["current_status"].focus();
			return false;
		}
		else if(current_status == "Resigned")
		{
			var end_date = document.forms["addemployee"]["end_date"].value;
			if(end_date.trim() === "")
			{
				$("#error_massege").show();
				$("#error_massege").html('Please select end date...!!!');
				document.forms["addemployee"]["end_date"].focus();
				return false;
			}
		}
		else
		{
			return true;
		}
	}
}*/

/*
 * @function return addEndDate()
 * @param
 * @return
 *
 * this function is use for show end date if employee resigned
 *
 */
function addEndDate()
{
	var current_status = $('#current_status').val();
	if(current_status == "Resigned")
	{
		$('#enddate').css('display','');
	}
	else
	{
		$('#enddate').css('display','none');
	}
}

/*
 * @function return updateemployee_validation()
 * @param
 * @return boolean
 *
 * this function is use for validation of form update employee form
 *
 */
/*function updateemployee_validation()
{
 		var numreg 			= /^(\d{1,3},)*(\d{1,3})+(\.\d{2})?$/;
 		var salary 			= document.forms["updateemployee"]["salary"].value;
 		var position 		= document.forms["updateemployee"]["position"].value;
 		var start_date 		= document.forms["updateemployee"]["start_date"].value;
 		var current_status 	= document.forms["updateemployee"]["current_status"].value;

 		if(salary.trim() === "" && position.trim() === "" && start_date.trim() === "" && current_status.trim() === "")
 		{
 			$("#error_massege").show();
 			$("#error_massege").html('Please fill appropriate details...!!!');
 			document.forms["updateemployee"]["salary"].focus();
 			return false;
 		}
 		else
 		{
 			if(salary.trim() === "" )
 			{
 				$("#error_massege").show();
 				$("#error_massege").html('Please enter salary...!!!');
 				document.forms["updateemployee"]["position"].focus();
 				return false;
 			}
 			if( ! salary.match(numreg))
 			{
 				$("#error_massege").show();
 				$("#error_massege").html('Salary is not valid please enter numbers...!!!');
 				document.forms["updateemployee"]["salary"].focus();
 				return false;
 			}
 			if(position.trim() === "" )
 			{
 				$("#error_massege").show();
 				$("#error_massege").html('Please select position...!!!');
 				document.forms["updateemployee"]["position"].focus();
 				return false;
 			}
 			if(start_date.trim() === "" )
 			{
 				$("#error_massege").show();
 				$("#error_massege").html('Please select start date...!!!');
 				document.forms["updateemployee"]["start_date"].focus();
 				return false;
 			}
 			if(current_status.trim() === "")
 			{
 				$("#error_massege").show();
 				$("#error_massege").html('Please enter current job status...!!!');
 				document.forms["updateemployee"]["current_status"].focus();
 				return false;
 			}
 			if(current_status.trim() == "Resigned")
 			{
 				var end_date = document.forms["updateemployee"]["end_date"].value;
 				if(end_date.trim() === "" || end_date.trim() == '0000-00-00')
 				{
 					$("#error_massege").show();
 					$("#error_massege").html('Please select end date...!!!');
 					document.forms["updateemployee"]["end_date"].focus();
 					return false;
 				}
 				if(start_date.trin() > end_date.trim())
 				{
 					$("#error_massege").show();
 					$("#error_massege").html('Please select valid end date...!!!');
 					document.forms["updateemployee"]["end_date"].focus();
 					return false;
 				}
 				else
 				{
 					return true;
 				}
 			}
 			else
 			{
 				return true;
 			}
 		}
}*/

	function profile_validation()
	{
		//alert("hello");
		var address = $('#address').val().trim();
		var dob = $('#datepickerdob').val().trim();
		var mobile = $('#mobile').val().trim();
		var other = $('#other').val().trim();
		var pan = $('#pan').val().trim();
		var bank_acc = $('#bank_acc').val().trim();

		if(address === "" && dob === "" && mobile === "" )
		{
			alert("Please enter details...!!!");
			$('#address').focus();
			return false;
		}
		if(address === "")
		{
			alert("Please enter address");
			$('#address').focus();
			return false;
		}
		if(dob === "")
		{
			alert("Please enter birth date");
			$('#datepickerdob').focus();
			return false;
		}
		if(mobile === "")
		{
			alert("Please enter mobile number");
			$('#mobile').focus();
			return false;
		}
		if(isNaN(mobile))
		{
			alert("Please enter valid mobile number without adding  0 & +91");
			$('#mobile').focus();
			return false;
		}
		if(other !== "")
		{
			if(isNaN(other))
			{
				alert("Please enter valid other mobile number without adding  0 & +91");
				$('#other').focus();
				return false;
			}
		}
	}

	function change_password_validation()
	{

		var oldpsaaword = document.forms["change_password"]["oldpassword"].value;
		var newpsaaword = document.forms["change_password"]["newpassword"].value;
		var cpsaaword = document.forms["change_password"]["cpassword"].value;

		if(oldpsaaword.trim() === "")
		{
			alert("Please enter old password..!!!");
			$('#oldpassword').focus();
			return false;
		}
		if(newpsaaword.trim() === "")
		{
			alert("Please enter new password..!!!");
			$('#newpassword').focus();
			return false;
		}
		if(cpsaaword.trim() === "")
		{
			alert("Please enter confirm password..!!!");
			$('#cpassword').focus();
			return false;
		}
		if(newpsaaword.trim() != cpsaaword.trim())
		{
			alert("Confirm password does not match please enter same password..!!!");
			$('#cpassword').focus();
			return false;
		}
	}