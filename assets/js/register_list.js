/**
* List of function in this file:
-------------------------------------------
*		1. check_validation()
*		2. get_total()
*		3. manual_total()
*		4. edit_list()
*		5. delete_list()
*		6. cal_pt()
*		7. cal_esi()
* 	8. cal_tds()
*   9. cal_workingday()
*	 10. getdata()
*  11. viewregister()
*  12. last_total()
*	 13. check_if_checked()
--------------------------------------------
*/
	jQuery('.numbersOnly').keyup(function () { this.value = this.value.replace(/[^0-9\.]/g,'');	});

	$(document).ready(function(){
		last_total();
		$('#selectall').change(function() {
			var index = $('#index').val();
		  if ($(this).is(':checked')) 
		  {
		  	for(i=1; i<=index; i++)
		  	{
		  		$('#autoload'+i+'').prop( "checked", true );
		  	}
		  }
		  else
		  {
		  	for(i=1; i<=index; i++)
		  	{
		  		$('#autoload'+i+'').prop( "checked", false );
		  	}
		  }
		});
	});

	$( document ).ajaxComplete(function() {
    last_total();
		$('#submit').hide();
		var index = $('#index').val();
    $('#selectall').change(function() {
		  if ($(this).is(':checked')) 
		  {
		  	for(i=1; i<=index; i++)
		  	{
		  		$('#autoload'+i+'').prop( "checked", true );
		  	}
		  	$('#back').hide();
				$('#submit').show();
		  }
		  else
		  {
		  	for(i=1; i<=index; i++)
		  	{
		  		$('#autoload'+i+'').prop( "checked", false );
		  	}
		  	$('#back').show();
				$('#submit').hide();
		  }
		});
	});

/**
 * @function return check_validation()
 * @return void
 *
 * this function is use for validation of form add_salary_regisater and update_salary_register
 * 
 */
 	function check_validation() 
	{
		//var rows = document.getElementById('tblData').getElementsByTagName("tr").length;
		var rows = $('#index').val();
 		for (var i = 1; i <= rows; i++) 
		{
			if($('#autoload'+i+'').is(':checked'))
			{
				var working_days 	= $('#working_days'+i+'').val();
				var base_salary 	= $('#base_salary'+i+'').val();
				var bonus 				= $('#bonus'+i+'').val();
				var pt 						= $('#pt'+i+'').val();
				var esi 					= $('#esi'+i+'').val();
				var tds 					= $('#tds'+i+'').val();
				var total 				= $('#total'+i+'').val();

				if(isNaN(working_days.trim()) == true || working_days.trim() == "" || working_days.trim() <= 0)
					{
						alert('Working Salary is empty or not valid...!!!' );
						$('#working_days'+i+'').focus();
						return false;
					}
				if(isNaN(base_salary.trim()) == true || base_salary.trim() == "" || base_salary.trim() <= 0)
					{
						alert('Base salary is empty or not valid...!!!' );
						$('#base_salary'+i+'').focus();
						return false;
					}
					if(isNaN(bonus.trim()) == true || bonus.trim() == "" || bonus.trim() < 0)
					{
						alert('Bonus is empty or not valid...!!!' );
						$('#bonus'+i+'').focus();
						return false;
					}
					if(isNaN(pt.trim()) == true || pt.trim() == "" || pt.trim() < 0)
					{
						alert('PT is empty or not valid...!!!' );
						$('#pt'+i+'').focus();
						return false;
					}
					if(isNaN(esi.trim()) == true || esi.trim() == "" || esi.trim() < 0)
					{
						alert('ESI is empty or not valid...!!!' );
						$('#esi'+i+'').focus();
						return false;
					}
					if(isNaN(tds.trim()) == true || tds.trim() == "" || tds.trim() < 0)
					{
						alert('TDS is empty or not valid...!!!' );
						$('#tds'+i+'').focus();
						return false;
					}
					if(isNaN(total.trim()) == true || total.trim() == "" || total.trim() <= 0)
					{
						alert('Total is empty or not valid...!!!' );
						$('#total'+i+'').focus();
						return false;
					}
			}
			return true;
		}
	}

/**
 * @function get_total()
 * @param int i
 * @return void
 * 
 * this function is use for calculate total from function in form add_salary_regisater and update_salary_register
 * 
 */
	function get_total(i)
	{
		var sum = 0;
		var base_salary = document.getElementById('base_salary'+i+'').value;
		var bonus 			= document.getElementById('bonus'+i+'').value;
		var pt 					= document.getElementById('pt'+i+'').value;
		var esi 				= document.getElementById('esi'+i+'').value;
		//var tds 				= document.getElementById('tds'+i+'').value;
		if ($('#autoload'+i+'').is(':checked')) 
		{
			if(base_salary.trim() == "")
			{
				base_salary = 0;
				$('#base_salary'+i+'').val(0);
			}
			if(bonus.trim() == "")
			{
				bonus = 0;
				$('#bonus'+i+'').val(0);
			}

			sum =  parseFloat(base_salary);
			sum += parseFloat(bonus);

			pt = cal_pt(sum);
			$('#pt'+i+'').val(pt.toFixed(0));

			esi = cal_esi(sum);
			$('#esi'+i+'').val(esi.toFixed(0));

			/*tds = cal_tds(sum);
			$('#tds'+i+'').val(tds.toFixed(0));*/

			sum -= parseFloat(pt);
			sum -= parseFloat(esi);
			//sum -= parseFloat(tds);
			$('#total'+i+'').val(sum.toFixed(0));
			last_total();
		}
 	}

/**
 * @function manual_total()
 * @param string x
 * @return void
 *
 * this function is use for user input total in form add_salary_regisater and update_salary_register
 * 
 */
 	function manual_total(x) 
 	{
 		var sum = 0;
		var base_salary = document.getElementById('base_salary'+x+'').value;
		var bonus 		 	= document.getElementById('bonus'+x+'').value;
		var pt 			 		= document.getElementById('pt'+x+'').value;
		var esi 			 	= document.getElementById('esi'+x+'').value;
		var tds 			 	= document.getElementById('tds'+x+'').value;
		if ($('#autoload'+x+'').is(':checked')) 
		{

			if(pt.trim() == "")
			{
				pt = 0;
				$('#pt'+x+'').val(0);
			}
			if(esi.trim() == "")
			{
				esi = 0;
				$('#esi'+x+'').val(0);
			}
			if(tds.trim() == "")
			{
				tds = 0;
				$('#tds'+x+'').val(0);
			}
	
			sum = parseFloat(sum) + parseFloat(base_salary) + parseFloat(bonus);
			sum = parseFloat(sum) - parseFloat(pt) - parseFloat(esi) - parseFloat(tds);
			$('#total'+x+'').val(Math.ceil(sum));
			last_total();
		}
 	}

/**
 * @function edit_list()
 * @param string month,
 * @param string year
 * @return void
 *
 * this function is use for redirect to update_salary_register with confirmation 
 * 
 */
 	function edit_list(month, year) 
	{
			window.location.href = 'update-salary-register?m='+month+'&y='+year+'';
	}

/**
 * @function view_list()
 * @param string month,
 * @param string year
 * @return void
 *
 * this function is use for redirect to update_salary_register with confirmation 
 * 
 */
 	function view_list(month, year) 
	{
			window.open('./report/createpdf?m='+month+'&y='+year+'');
	}

/**
 * @function view_tds()
 * @param string month,
 * @param string year
 * @return void
 *
 * this function is use for redirect to update_salary_register with confirmation 
 * 
 */
 	function view_tds(month, year) 
	{
			window.open('./report/create_tds_pdf?m='+month+'&y='+year+'');
	}

/**
 * @function delete_list()
 * @param string month,
 * @parame string year
 * @return void
 *
 * this function is use for redirect to delete_salary_register with confirmation 
 * 
 */
	function delete_list(month, year)
	{
		var didconfirm = confirm('Are you sure to delete this list...???');
		if(didconfirm == true)
		{
			window.location.href = 'salary_register/delete_salary_register?m='+month+'&y='+year+'';
		}
	}

/**
 * @function return cal_pt()
 * @param float
 * @return float
 *
 * this function is use for calculation of pt of each row of table in add_salary_regisater 
 * and update_salary_register
 */
	function cal_pt (sum) 
	{
		if(isNaN(sum))
		{
			return 0;
		}
		else
		{
			if(parseFloat(sum) < 5999)
			{
				return 0;
			}
			else if(parseFloat(sum) >= 6000 && parseFloat(sum) < 8999)
			{
				return 80;
			}
			else if(parseFloat(sum) >= 9000 && parseFloat(sum) < 12000)
			{
				return 150;
			}
			else if(parseFloat(sum) >= 12000)
			{
				return 200;
			}
		}
	}

/**
 * @function return cal_esi()
 * @param float
 * @return float
 *
 * this function is use for calculation of esi of each row of table in add_salary_regisater 
 * and update_salary_register
 */
	function cal_esi (sum) 
	{
		if(parseFloat(sum) < 15000 && parseFloat(sum) > 0)
		{
			var esi = 0.0175 * parseFloat(sum)
			return parseFloat(esi);
		}
		else
		{
			return 0;
		}
	}

/**
 * @function return cal_tds()
 * @param float
 * @return float
 *
 * this function is use for calculation of tds of each row of table in add_salary_regisater 
 * and update_salary_register
 */
	function cal_tds (sum)
	{
		if(isNaN(sum))
		{
			return 0;
		}
		else
		{
			var y = parseFloat(sum) * 12;
			if(parseFloat(y) <= 250000)
			{
				return 0;
			}
			else if(parseFloat(y) > 250000  && parseFloat(y) <= 500000 )
			{
				var tmp =parseFloat(y) - 250000;
				var tds = 0.10 * parseFloat(tmp);
				sec = parseFloat(tds) * 0.02;
				hsc = parseFloat(tds) * 0.01;
				tds += parseFloat(sec) + parseFloat(hsc) ;
			}
			else if(parseFloat(y) > 500000  && parseFloat(y) <= 1000000)
			{
				var tmp =parseFloat(y) - 500000;
				var tds = 0.20 * parseFloat(tmp);
				tds = parseFloat(tds) + 25000;
				sec = parseFloat(tds) * 0.02;
				hsc = parseFloat(tds) * 0.01;
				tds += parseFloat(sec) + parseFloat(hsc);
			}
			else if(parseFloat(y) >= 1000000)
			{
				var tmp =parseFloat(y) - 1000000;
				var tds = 0.20 * parseFloat(tmp);
				tds = parseFloat(tds) + 125000;
				sec = parseFloat(tds) * 0.02;
				hsc = parseFloat(tds) * 0.01;
				tds += parseFloat(sec) + parseFloat(hsc);
			}
			var total = parseFloat(tds) / 12;
			return parseFloat(total);
		}
	}

	/**
 * @function return cal_workingday()
 * @param float
 * @return float
 *
 * this function is use for calculation of tds of each row of table in add_salary_regisater 
 * and update_salary_register
 */
 function cal_workingday(i) 
 {
 		var working_days 	= $('#working_days'+i+'').val();
		var base_salary 	= $('#salary'+i+'').val();

		if ($('#autoload'+i+'').is(':checked')) 
		{
			var sum = parseFloat(base_salary) / 26;
			sum = parseFloat(sum) * parseFloat(working_days);
			$('#base_salary'+i+'').val(Math.ceil(sum));
			get_total(i);
		}
 }

/**
 * @function getdata()
 * @param
 * @return boolean
 * this function is use for show list of salary_register if month & year validate successfully
 */
	function getdata()
	{
		var month  = $('#month').val();
		var year   = $('#year').val();
		//alert(month+year);
		if(month.trim() == "" && year.trim() == "")
		{
			alert("Please select month and year...!!!");
			$('#month').focus();
			return false;
		}
		if(month.trim() == "")
		{
			alert("Please select month...!!!");
			$('#month').focus();
			return false;
		}
		if(year.trim() == "" || year.trim() <= "1999")
		{
			alert('Please select valid year above "2000"...!!!');
			$('#year').focus();
			return false;
		}
		else
		{
			$.ajax({
              type    : "POST",
              url     : "salary_register/getlist",
              data    : "month="+month+"&year="+year,
              success : function(data){
              	data = $.parseJSON(data);
              	var mon = "";
              	switch (data.month) 
								{
									case '1':
										mon = "January";
										break;
									case '2':
										mon = "February";
										break;
									case '3':
										mon = "March";
										break;
									case '4':
										mon = "April";
										break;
									case '5':
										mon = "May";
										break;
									case '6':
										mon = "June";
										break;
									case '7':
										mon = "July";
										break;
									case '8':
										mon = "August";
										break;
									case '9':
										mon = "September";
										break;
									case '10':
										mon = "October";
										break;
									case '11':
										mon = "November";
										break;
									case '12':
										mon = "December";
										break;
								}
								if(data.error != "")
								{
									var html = "<div align='center'><div><span style='color:red;font-size:20px;'>"+data.error+"</span></div><div><button onclick='viewregister("+data.month+", "+data.year+");' class='btn btn-danger'>View</button></div></div>"
								}
								else
								{
              		var html = '<p align="center">Month: '+mon+', Year: '+data.year+'</p><form name="add_salary_register" id="add_salary_register" method="POST" action="add-new-salary-register"><table class="table"><thead><tr><th><input type="checkbox" name="selectall" id="selectall"></th><th>No</th><th>Name</th><th>Working days</th><th>Base salary</th><th>Bonus</th><th>PT</th><th>ESI</th><th>TDS</th><th>Total</th></tr></thead><tbody>';
              	
              	var n = 0;
              	$.each(data.query, function(i, item){
              		n++;
              		var bsaeSalary = parseFloat(item.salary);
              		html += '<tr><input type="hidden" name="uid'+n+'" value="'+item.employee_id+'"><input type="hidden" name="salary'+n+'" id="salary'+n+'" value="'+item.salary+'"><td><input type="checkbox" name="autoload'+n+'" id="autoload'+n+'" onclick="return check_if_checked();" value="select"></td><td>'+n+'</td><td>'+item.first_name+' '+item.last_name+'</td><td><input type="text" maxlength="2" size="10px" class="numbersOnly" name="working_days'+n+'" id="working_days'+n+'" value="26"></td><td><input type="text" maxlength="8" size="10px" onblur="get_total('+n+');" name="base_salary'+n+'" id="base_salary'+n+'" value="'+bsaeSalary.toFixed(0)+'"></td><td><input type="text" maxlength="8" size="10px" onblur="get_total('+n+');" name="bonus'+n+'" id="bonus'+n+'" value="0"></td><td><input type="text" maxlength="8" size="10px" onblur="manual_total('+n+');" name="pt'+n+'" id="pt'+n+'" value="0"></td><td><input type="text" maxlength="8" size="10px" onblur="manual_total('+n+');" name="esi'+n+'" id="esi'+n+'" class="numbersOnly" value="0"></td><td><input type="text" size="10px" onblur="manual_total('+n+');" name="tds'+n+'" id="tds'+n+'" value="0"></td><td><input type="text" class="numbersOnly" size="10px" name="total'+n+'" id="total'+n+'" value="0"></td></tr>';
              	});
              	html += '</tbody><tbody><tr><td colspan="4" align="right" style="color:red; font-size:18px; "><b>Total </b>:</td><td><input type="text" size="10px" name="total_bs" id="total_bs"></td><td><input type="text" size="10px" name="total_bonus" id="total_bonus"></td><td><input type="text" size="10px" name="total_pt" id="total_pt"></td><td><input type="text" size="10px" name="total_esi" id="total_esi"></td><td><input type="text" size="10px" name="total_tds" id="total_tds"></td><td><input type="text" size="10px" name="total_t" id="total_t"></td></tr></tbody></table><input type="hidden" name="index" id="index" value="'+n+'"><input type="hidden" name="month" value="'+data.month+'"><input type="hidden" name="year" value="'+data.year+'"><p align="center"><input type="submit" onclick="return check_validation();" name="submit" id="submit" class="button-btn" value="Save" ><a name="back" id="back" href="<?php echo base_url();?>salary-register-list"><button class="button-btn">Back</button></a></p></form>'; 
								}
								$('#tblData').html(html);
              }
          });
		}
	}

/**
 * @function viewregister()
 * @param string month
 * @param string year
 * @return void
 *
 * this function is use for redirect to update_salary_register with confirmation 
 * 
 */
	function viewregister(month, year) 
	{
		window.location.href = 'update-salary-register?m='+month+'&y='+year+'';
	}

/**
 * @function last_total()
 * @param 
 * @return void
 *
 * this function is use for show last line total 
 * 
 */
 function last_total()
 {
 		var rows = $('#index').val();
 		var total_bs = 0;
 		var total_bonus = 0;
 		var total_pt = 0;
 		var total_esi = 0;
 		var total_tds = 0;
 		var total_t = 0;

 		for (var i = 1; i <= rows; i++) 
		{
			if ($('#autoload'+i+'').is(':checked')) 
			{
				//var working_days = $('#working_days'+i+'').val();
				var base_salary = $('#base_salary'+i+'').val();
				var bonus 		= $('#bonus'+i+'').val();
				var pt 			= $('#pt'+i+'').val();
				var esi 		= $('#esi'+i+'').val();
				var tds 		= $('#tds'+i+'').val();
				var total 		= $('#total'+i+'').val();

				total_bs = parseFloat(total_bs) + parseFloat(base_salary);
 				total_bonus = parseFloat(total_bonus) + parseFloat(bonus);
 				total_pt = parseFloat(total_pt) + parseFloat(pt);
 				total_esi = parseFloat(total_esi) + parseFloat(esi);
 				total_tds = parseFloat(total_tds) + parseFloat(tds);
 				total_t = parseFloat(total_t) + parseFloat(total);
 			}
		} 

		$('#total_bs').val(Math.ceil(total_bs));
		$('#total_bonus').val(Math.ceil(total_bonus));
		$('#total_pt').val(Math.ceil(total_pt));
		$('#total_esi').val(Math.ceil(total_esi));
		$('#total_tds').val(Math.ceil(total_tds));
		$('#total_t').val(Math.ceil(total_t));

 }

/**
 * @function check_if_checked()
 * @param 
 * @return boolean 
 *
 * this function is use for show save button on change in add salary register page
 * 
 */
 function check_if_checked() 
 {
 		var rows = $('#index').val();
 		for (var i = 1; i <= rows; i++) 
		{
			if($('#autoload'+i+'').is(':checked'))
			{
				$('#back').hide();
				$('#submit').show();
				return true;
			}
		}
		$('#back').show();
		$('#submit').hide();
 }