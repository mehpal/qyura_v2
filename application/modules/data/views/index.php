<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery.dataTables.min.css"/>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/jquery-1.8.2.min.js"></script>

        <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/jquery.dataTables.min.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/jquery.dataTables.delay.min.js"></script>

         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

     <script>
    $(function() {
    $( "#startDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });

    $(function() {
    $( "#endDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    </script>

        <script type="text/javascript">
            $(document).ready(function()
                {
                 
                var oTable =    $('#data').dataTable({
                            "sScrollY": "400px",
                            "bProcessing": true,
                            "iDisplayStart" : 0,
                            "bServerSide": true,
                            "bRegex" : true,
                            "sServerMethod": "GET",
                            "sAjaxSource": "<?php echo site_url('data/getTable'); ?>",
                            "iDisplayLength": 4,
                            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                            "aaSorting": [[0, 'asc']],
                            "aoColumns": [
                                { "sWidth": "10%" },
                                { "sWidth": "10%" },
                                { "sWidth": "10%" },
                                { "sWidth": "10%" },
                                { "sWidth": "10%" }
                            ],
                            "fnServerData": function ( sSource, aoData, fnCallback ) {
                            /* Add some extra data to the sender */
                           // alert(aoData);
                           //alert($(this).data(aoData).toSource() );
                            var iMin = document.getElementById('startDate').value;
                            var iMax = document.getElementById('endDate').value;
                            var gender = document.getElementById('gender').value;
                            aoData.push(
                                {"name": "start", "value": iMin},
                                {"name": "end", "value": iMax},
                                {"name": "gender", "value": gender}
                            );
                            $.getJSON( sSource, aoData, function (json) { 
                             // alert($(this).data(json).toSource());

                                fnCallback(json)
                            });
                         }
                    });
                        $('#startDate').change( function() {  oTable.fnDraw(); } );
                        $('#endDate').change( function() { oTable.fnDraw(); } );
                        $('#gender').change( function() { oTable.fnDraw(); } );
                });


          
        </script>


        
</head>
<body>
</body>
<table>
   <thead>
      <tr>
        <th><p>Start Date: <input type="text" id="startDate"></p></th>
        <th><p>End Date: <input type="text" id="endDate"></p></th>
        <th><p>Select Gender: <select id="gender"><option value="">Select Gender</option><option value="male">Male</option><option value="female">Female</option></select></p></th>
      </tr>
   </thead>
</table>
<table cellpadding="0" cellspacing="0" border="0" id="data" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot></tfoot>
</table>

</body>
</html>