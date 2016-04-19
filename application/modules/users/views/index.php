<!DOCTYPE html>
<html>
<head>
	

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/jquery-1.8.2.min.js"></script>

        <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
       
     <!-- date picker-->
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
			$(document).ready(function() {

				ajaxCall();
				$('#startDate').on('change',function() {ajaxCall();});
                $('#endDate').on('change',function() {ajaxCall();});
                $('#gender').on('change',function() {ajaxCall();});
			} );


				function ajaxCall() {
					
					var startDate = $("#startDate").val();
					var endDate = $("#endDate").val();
					var gender = $("#gender").val();

					var oTable = $('#example').DataTable( {
					destroy: true,
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?php echo site_url('users/getUsers'); ?>",
						"type": "POST",
						"data" : {'startDate' : startDate, 'endDate' : endDate, 'gender' : gender}
					}
				} );
				}

	</script>
</head>
<body class="dt-example">
	<div class="container">
		<section>
			<h1>DataTables example </h1>

			<table>
			   <thead>
			      <tr>
			        <th><p>Start Date: <input type="text" id="startDate"></p></th>
			        <th><p>End Date: <input type="text" id="endDate"></p></th>
			        <th><p>Select Gender: <select id="gender"><option value="">Select Gender</option><option value="male">Male</option><option value="female">Female</option></select></p></th>
			      </tr>
			   </thead>
			</table>

			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>CityName</th>
						<th>cityDistrict</th>
						<th>CityPopulation</th>
						<th>code</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>CityName</th>
						<th>cityDistrict</th>
						<th>CityPopulation</th>
						<th>code</th>
					</tr>
				</tfoot>
			</table>
			
		</section>
	</div>
	
</body>
</html>