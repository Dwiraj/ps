/**
 * Created by Dwiraj <dwiraj.k.chauhan25@gmail.com> on 07-Mar-16.
 */

var save_method; //for save method string
var table = '12454';
$(document).ready(function() {
    if($('#tblEmployee').is(':visible'))
        table = set_table('#tblEmployee', 1);
    else
        table = set_table('#tblDataAdmin', 2);

});

function set_table(id, level) {
    table = $(id).DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "admin/ajax_list",
            "type": "POST",
            "data": {'level': level}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
        ],

    });
    return table;
}

function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add admin'); // Set Title to Bootstrap modal title
}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    //Ajax Load data from ajax
    $.ajax({
        url : "admin/edit//" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="first_name"]').val(data.first_name);
            $('[name="last_name"]').val(data.last_name);
            $('[name="email"]').val(data.email);
            $('[name="user_level"]').val(data.user_level);
            $('[name="father_name"]').val(data.father_name);
            $('[name="mother_name"]').val(data.mother_name);
            $('[name="address"]').val(data.address);
            $('[name="salary"]').val(data.salary);
            $('[name="position"]').val(data.position);
            $('[name="start_date"]').val(data.start_date);
            $('[name="current_status"]').val(data.current_status);
            $('[name="phone_no"]').val(data.phone_no);
            $('[name="alternate_no"]').val(data.alternate_no);
            $('[name="salutation"]').val(data.salutation);
            $('[name="qualification"]').val(data.qualification);
            $('[name="pan_no"]').val(data.pan_no);
            $('[name="password"]').val();
            $('[name="cpassword"]').val();

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit admin'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function save()
{
    var url;
        if(save_method == 'add')
        {
            url = "admin/admin_add";
        }
        else
        {
            url = "admin/admin_update";
        }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            console.log(data.errors);
            if(data.status === false) {
                $('#error_massege').html(data.errors);
            } else {
                //if success close modal and reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function delete_user(id)
{
    bootbox.confirm("Are you sure delete this user?", function(result) {

        if(result) {
            // ajax delete data to database
            $.ajax({
                url : "admin/ajax_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status === false) {
                        bootbox.alert(data.errors);
                    }
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
        }
    });
}
