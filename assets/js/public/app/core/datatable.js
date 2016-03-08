/**
 * Created by Dwiraj on 07-Mar-16.
 */
$(document).ready(function() {
   /* $('#tblDataAdmin').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin/get_admin_list"
        }
    });*/

    var table = $('#tblDataAdmin').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin/get_admin_list"
        }
    });
    var tt = new $.fn.DataTable.TableTools( table );

    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
});