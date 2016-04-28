/**
* List of function in this file:
-------------------------------------------
*		1. checkdata()
*		2. checkdate()
*		3. getuser()
*		4. display_none()
*		5. viewbox()
*		6. deleteuser()
--------------------------------------------
*/

	$(document).ready(function()
	{
		$('#searchbtn').click(function(){
			$('#subsearch').css('display','');
		});
		/*$( "#search" ).click(function( event ) {
  		event.stopPropagation();
		});
		var clickControl = false;
		$(document).on('click', '.ui-datepicker-next, .ui-datepicker-prev, .ui-datepicker', function(){
			clickControl = true;
		});
		$(document).click(function(){
			if(clickControl == true)
			{
				clickControl = false;
				return;
			}
				$('#subsearch').hide();
				display_none();
				document.getElementById("searchby").selectedIndex = "0";
		});*/

		 $("#showsearch").click(function(event){
		 	event.preventDefault();
		 	var searchtype = $('#searchby').val();
		 	var searchkeyword = $('#searchkeyword').val();
			$.ajax({
              type    : "POST",
              url     : "employee/getsearch",
              data    : "searchtype="+searchtype+"&searchkeyword="+searchkeyword,
              success : function(data){
              data = $.parseJSON(data);
              	var n = 0;
              	var user_type = "";
              	var enddate = "";
              	var html = '';
              	var style ="";
              	$.each(data.query, function(i, item){
              		n++;
              		if(item.user_level == 1)
              		{
              			user_type = "Employee";
              		}
              		else
              		{
              			user_type = "Admin";
              		}
              		if(item.end_date == "0000-00-00" || item.end_date == null)
              		{
              			enddate = "None";
              		}
              		else
              		{
              			enddate = item.end_date;
              		}
              		if(item.current_status == "Resigned")
              		{
              			style = 'background:rgb(236, 185, 185)';
              		}
              		else
              		{
              			style ="";
              		}
    							html += "<tr style='"+style+";'><td>"+n+"</td><td>"+item.first_name+" "+item.last_name+"</td><td>"+item.email+"</td><td>"+user_type+"</td><td>"+item.salary+"</td><td>"+item.position+"</td><td>"+item.start_date+"</td><td>"+item.current_status+"</td><td>"+enddate+"</td><td><a style='padding:0px 5px 0px 0px;' href='#'><button style='width: 90px;background-color: #079655;' class='mybutton-view'>Increament</button></a><a style='padding:0px 5px 0px 0px;' href='employee/view_employee_detail/"+item.employee_id+"'><button class='mybutton-view'>View</button></a><a style='padding:0px 5px 0px 0px;' href='admin/update/"+item.employee_id+"'><button class='mybutton-update'>Edit</button></a><button onclick='deleteuser("+item.employee_id+");' class='mybutton-delete'>Delete</button></td></tr>";

              	});
								$('#getdata').html(html);
              }
          });
    	});
	});

	$(function() 
  {
 		$("#datepickerstart").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true,
      changeYear: true }).val();
 		$("#datepickerend").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true,
      changeYear: true }).val();
  });
/**
 * @function checkdata()
 * @param
 * @return boolean
 *
 * this function is use for validation of form search text field and get Ajax response
 * 
 */
	function checkdata() 
	{
		var searchtype = $('#searchby').val();
		var minsalary = $('#searchkeywordmin').val();
		var maxsalary = $('#searchkeywordmax').val();
		var numreg = /^(\d{1,3},)*(\d{1,3})+(\.\d{2})?$/;
		if(minsalary.trim() == "" && maxsalary.trim() == "")
		{
			alert('Please enter values...!!!');
			document.forms["searchfrm"]["searchkeywordmin"].focus();
			return false;	
		}
		else
		{
			if(minsalary.trim() == "")
			{
				alert('Please enter minimum value...!!!');
				document.forms["searchfrm"]["searchkeywordmin"].focus();
				return false;	
			}
			if( ! minsalary.trim().match(numreg)) 
			{
				alert('Please enter valid minimum value...!!!');
				document.forms["searchfrm"]["searchkeywordmin"].focus();
				return false;	
			}
			if(maxsalary.trim() == "")
			{
				alert('Please enter maximum value...!!!');
				document.forms["searchfrm"]["searchkeywordmax"].focus();
				return false;	
			}
			if( ! maxsalary.trim().match(numreg)) 
			{
				alert('Please enter valid maximum value...!!!');
				document.forms["searchfrm"]["searchkeywordmax"].focus();
				return false;	
			}
			if(parseFloat(minsalary.trim()) > parseFloat(maxsalary.trim())) 
			{
				alert('Maximum salary must be high...!!!');
				document.forms["searchfrm"]["searchkeywordmax"].focus();
				return false;	
			}
			else
			{
				$.ajax({
        	 	    type    : "POST",
          	 	  url     : "employee/getsearchsalary",
          	    data    : "searchtype="+searchtype+"&min="+minsalary+"&max="+maxsalary,
            	  success : function(data)
            	  {
									data = $.parseJSON(data);
	              	var n = 0;
	              	var user_type = "";
	              	var enddate = "";
	              	var html = '';
	              	var style ="";
              	$.each(data.query, function(i, item){
              		n++;
              		if(item.user_level == 1)
              		{
              			user_type = "Employee";
              		}
              		else
              		{
              			user_type = "Admin";
              		}
              		if(item.end_date == "0000-00-00" || item.end_date == null)
              		{
              			enddate = "None";
              		}
              		else
              		{
              			enddate = item.end_date;
              		}
              		if(item.current_status == "Resigned")
              		{
              			style = 'background:rgb(236, 185, 185)';
              		}
              		else
              		{
              			style ="";
              		}
    							html += "<tr style='"+style+";'><td>"+n+"</td><td>"+item.first_name+" "+item.last_name+"</td><td>"+item.email+"</td><td>"+user_type+"</td><td>"+item.salary+"</td><td>"+item.position+"</td><td>"+item.start_date+"</td><td>"+item.current_status+"</td><td>"+enddate+"</td><td><a style='padding:0px 5px 0px 0px;' href='#'><button style='width: 90px;background-color: #079655;' class='mybutton-view'>Increament</button></a><a style='padding:0px 5px 0px 0px;' href='employee/view_employee_detail/"+item.employee_id+"'><button class='mybutton-view'>View</button></a><a style='padding:0px 5px 0px 0px;' href='admin/update/"+item.employee_id+"'><button class='mybutton-update'>Edit</button></a><button onclick='deleteuser("+item.employee_id+");' class='mybutton-delete'>Delete</button></td></tr>";

              	});
								$('#getdata').html(html);
              	}
       	});
			}
		}
	}

/**
 * @function checkdate()
 * @param
 * @return boolean
 *
 * this function is use for validation of form search field of date and Ajax 
 * 
 */
	function checkdate() 
	{
		var searchtype = $('#searchby').val();
		var sdate = $('#datepickerstart').val();
		var edate = $('#datepickerend').val();
		var numreg = /^\d{4}-\d{2}-\d{2}$/;
		if(sdate.trim() == "" && edate.trim() == "")
		{
			alert('Please enter values...!!!');
			document.forms["searchfrm"]["datepickerstart"].focus();
			return false;	
		}
		else
		{
			if(sdate.trim() == "")
			{
				alert('Please enter start date...!!!');
				document.forms["searchfrm"]["datepickerstart"].focus();
				return false;	
			}
			if( ! sdate.trim().match(numreg)) 
			{
				alert('Please enter valid start date...!!!');
				document.forms["searchfrm"]["datepickerstart"].focus();
				return false;	
			}
			if(edate.trim() == "")
			{
				alert('Please enter end date...!!!');
				document.forms["searchfrm"]["datepickerend"].focus();
				return false;	
			}
			if( ! edate.trim().match(numreg)) 
			{
				alert('Please enter valid end date...!!!');
				document.forms["searchfrm"]["datepickerend"].focus();
				return false;	
			}
			if(sdate.trim() > edate.trim()) 
			{
				alert('End date must be greater than from start date...!!!');
				document.forms["searchfrm"]["datepickerend"].focus();
				return false;	
			}
			else
			{
				$.ajax({
        	 	    type    : "POST",
          	 	  url     : "employee/getsearchsalary",
          	    data    : "searchtype="+searchtype+"&min="+sdate+"&max="+edate,
            	  success : function(data)
            	  {
									data = $.parseJSON(data);
	              	var n = 0;
	              	var user_type = "";
	              	var enddate = "";
	              	var html = '';
	              	var style = "";
              	$.each(data.query, function(i, item){
              		n++;
									
              		if(item.user_level == 1)
              		{
              			user_type = "Employee";
              		}
              		else
              		{
              			user_type = "Admin";
              		}
              		if(item.end_date == "0000-00-00" || item.end_date == null)
              		{
              			enddate = "None";
              		}
              		else
              		{
              			enddate = item.end_date;
              		}
              		if(item.current_status == "Resigned")
              		{
              			style = 'background:rgb(236, 185, 185)';
              		}
              		else
              		{
              			style ="";
              		}
    							html += "<tr style='"+style+";'><td>"+n+"</td><td>"+item.first_name+" "+item.last_name+"</td><td>"+item.email+"</td><td>"+user_type+"</td><td>"+item.salary+"</td><td>"+item.position+"</td><td>"+item.start_date+"</td><td>"+item.current_status+"</td><td>"+enddate+"</td><td><a style='padding:0px 5px 0px 0px;' href='#'><button style='width: 90px;background-color: #079655;' class='mybutton-view'>Increament</button></a><a style='padding:0px 5px 0px 0px;' href='employee/view_employee_detail/"+item.employee_id+"'><button class='mybutton-view'>View</button></a><a style='padding:0px 5px 0px 0px;' href='admin/update/"+item.employee_id+"'><button class='mybutton-update'>Edit</button></a><button onclick='deleteuser("+item.employee_id+");' class='mybutton-delete'>Delete</button></td></tr>";

              	});
								$('#getdata').html(html);
              	}
       	});
			}
		}
	}

/**
 * @function getuser()
 * @param string str
 * @return boolean
 *
 * this function is use for get user detail from Ajax and response to html
 * 
 */
	function getuser(str) 
	{
		var searchtype = $('#searchby').val();
		var searchkeyword = $('#'+str+'').val();
		$.ajax({
             type    : "POST",
             url     : "employee/getsearch",
             data    : "searchtype="+searchtype+"&searchkeyword="+searchkeyword,
             success : function(data){
							data = $.parseJSON(data);
              	var n = 0;
              	var user_type = "";
              	var enddate = "";
              	var html = '';
              	var style = "";	
              	$.each(data.query, function(i, item){
              		n++;
              		if(item.user_level == 1)
              		{
              			user_type = "Employee";
              		}
              		else
              		{
              			user_type = "Admin";
              		}
              		if(item.end_date == "0000-00-00" || item.end_date == null)
              		{
              			enddate = "None";
              		}
              		else
              		{
              			enddate = item.end_date;
              		}
              		if(item.current_status == "Resigned")
              		{
              			style = 'background:rgb(236, 185, 185)';
              		}
              		else
              		{
              			style ="";
              		}
    							html += "<tr style='"+style+";' ><td>"+n+"</td><td>"+item.first_name+" "+item.last_name+"</td><td>"+item.email+"</td><td>"+user_type+"</td><td>"+item.salary+"</td><td>"+item.position+"</td><td>"+item.start_date+"</td><td>"+item.current_status+"</td><td>"+enddate+"</td><td><a style='padding:0px 5px 0px 0px;' href='#'><button style='width: 90px;background-color: #079655;' class='mybutton-view'>Increament</button></a><a style='padding:0px 5px 0px 0px;' href='employee/view_employee_detail/"+item.employee_id+"'><button class='mybutton-view'>View</button></a><a style='padding:0px 5px 0px 0px;' href='admin/update/"+item.employee_id+"'><button class='mybutton-update'>Edit</button></a><button onclick='deleteuser("+item.employee_id+");' class='mybutton-delete'>Delete</button></td></tr>";

              	});
								$('#getdata').html(html);
             }
         });
	}

/**
 * @function return display_none()
 * @param
 * @return void
 *
 * this function is use for hide other search option except user selected
 */
 	function display_none()
	{
		$('#searchtxt').hide()
		$('#searchstatus').hide()
		$('#searchpos').hide()
		$('#searchlevel').hide()
		$('#searchsalary').hide()
		$('#searchdate').hide()
	}

/**
 * @function viewbox()
 * @param
 * @return void
 *
 * this function is use for show only search field that user select  
 * 
 */
	function viewbox()
	{
		var searchtype = $('#searchby').val();
		display_none();
		switch(searchtype)
		{
			case 'first_name':
				$('#searchtxt').show();
				break;
			case 'email':
				$('#searchtxt').show();
				break;
			case 'user_level':
				$('#searchlevel').show();
				break;
			case 'salary':
				$('#searchsalary').show();
				break;
			case 'position':
				$('#searchpos').show();
				break;
			case 'start_date':
				$('#searchdate').show();
				break;
			case 'current_status':
				$('#searchstatus').show();
				break;
			case 'end_date':
				$('#searchdate').show();
				break;
		}
	}

/**
 * @function deleteuser()
 * @param string x
 * @return void
 *
 * this function is use for redirect to delete user
 * 
 */
	function deleteuser(x)
	{
		var didconfirm = confirm("Are you sure to delete this user...???");
		if (didconfirm == true) 
		{
		 	window.location.href = 'admin/deleteuser/'+x+'';
		}
	}
	