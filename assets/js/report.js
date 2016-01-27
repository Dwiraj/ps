	$(function() 
  {
 		$("#datepickerstart").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true,
      changeYear: true }).val();
 		$("#datepickerend").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true,
      changeYear: true }).val();
  });

  $(document).ready(function(){

  	$('#show_date').click(function(){

  		var employee_id = $('#employee_id').val();
      var s_date = $('#datepickerstart').val();
  		var e_date = $('#datepickerend').val();
  		if(employee_id.trim() == "")
      {
        alert("Please select employee name..!!!");
        $('#employee_id').focus();
        return false;
      }
      if(s_date.trim() == "" || s_date.trim() == "0000-00-00")
      {
        alert("Please select start date...!!!");
        $('#datepickerstart').focus();
        return false;
      }
  		if(e_date.trim() == "" || e_date.trim() == "0000-00-00")
  		{
  			alert("Please select end date...!!!");
        $('#datepickerend').focus();
  			return false;
  		}
      if(e_date.trim() < s_date.trim())
      {
        alert('End date is not valid please select end date grater than start date');
        $('#datepickerend').focus();
        return false;
      }
      else
      {
        $.ajax({
                  type    : "POST",
                  url     : "employee-salary-report",
                  data    : "employee_id="+employee_id+"&s_date="+s_date+"&e_date="+e_date,
                  success : function(data){
                  data = $.parseJSON(data);
                  //console.log(data);
                  var n = 0;
                  var html = "";
                  var deductions = 0;
                  var t_bs = 0;
                  var t_bonus = 0;
                  var t_pt = 0;
                  var t_esi = 0;
                  var t_tds = 0;
                  var t_total = 0;
                  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    if(data.result == false)
                    {
                      html = "<tr><td style='color:red;' colspan='8' align='center'>There is no data in table</td></tr>"
                    }
                    else
                    {
                      $.each(data.result, function(i, item){
                          if (item['0'] != undefined)
                          {
                            n++;
                            html += "<tr><td style='text-align:center;'>"+n+"</td><td style='text-align:left;'>"+months[parseInt(item['0'].month) - 1]+", "+item['0'].year+"</td><td style='text-align:right;'>"+item['0'].base_salary+"</td><td style='text-align:right;'>"+item['0'].bonus+"</td><td style='text-align:right;'>"+item['0'].pt+"</td><td style='text-align:right;'>"+item['0'].esi+"</td><td style='text-align:right;'>"+item['0'].tds+"</td><td style='text-align:right;'><b>"+item['0'].total+"</b></td></tr>"
                            t_bs += parseFloat(item['0'].base_salary);
                            t_bonus += parseFloat(item['0'].bonus);
                            t_pt += parseFloat(item['0'].pt);
                            t_esi += parseFloat(item['0'].esi);
                            t_tds += parseFloat(item['0'].tds);
                            t_total += parseFloat(item['0'].total);
                            deductions = 0;
                          }
                      });
                      html += "<tr><td style='text-align:right;' colspan='2'><b>Total</b></td><td style='text-align:right;'><b>"+t_bs+"</b></td><td style='text-align:right;'><b>"+t_bonus+"</b></td><td style='text-align:right;'><b>"+t_pt+"</b></td><td style='text-align:right;'><b>"+t_esi+"</b></td><td style='text-align:right;'><b>"+t_tds+"</b></td><td style='text-align:right;'><b>"+t_total+"</b></td></tr><tr><td colspan='8' align='right'><a href='employee-salary-report-view/?id="+employee_id+"&s="+s_date+"&e="+e_date+"'><span class='glyphicon glyphicon-save'></span> PDF</a></td></tr>"
                    }
                    $('#tblData').html(html);
                  }
        });
      }
  	});

  });