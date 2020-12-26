<?php
require "../includes/connection.php";
if(!isset($_SESSION) || !isset($_SESSION['valid']))
{
	header('Refresh:2;url=../login.php');
	echo "Unauthorized access! Redirecting to Login page please wait...";
	die;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Class Wise Fee Record </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<link rel="icon" href="../favicon.ico" type="image/x-icon" />

<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/bootstrap-table-filter.css" rel="stylesheet" />
<link href="../css/styles.css" rel="stylesheet" />
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>-->
<script src="../js/bootbox.min.js"></script>
<script>
jQuery(document).ready(function($)
{  
	$(window).load(function(){
		$('#preloader').fadeOut('slow',function(){$(this).remove();});
		//$('#preloader').fadeOut('slow');
	});
	
});
</script>

<script>
//To show the row counts in table
function runningFormatter(value, row, index) {
    return 1+index;
}
</script>


</head>

<body>		
	<?php
		include "../menu.php";
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Class Wise Fee Record</li>
			</ol>
		</div>
				
		
		<div class="row">
			<div class="login-panel panel panel-default">
				<div class="col-lg-12 panel-body">
						<div class="form-group">
							<label for="class" style="color:white;">Select Class to view the record. <i>(If class record does not changes according to the class selected, please REFRESH the page.)</i></label>
							<select class="form-control" id="class_name" name="class"  style="border:solid thin black;">
								<option value="#" disabled="true" selected>SELECT</option>
								<option value="Pre Nursery">Pre Nursery</option>
								<option value="Nursery">Nursery</option>
								<option value="Kindergarten">Kindergarten</option>
								<option value="1st">1st</option>
								<option value="2nd">2nd</option>
								<option value="3rd">3rd</option>
								<option value="4th">4th</option>
								<option value="5th">5th</option>
								<option value="6th">6th</option>
								<option value="7th">7th</option>
								<option value="8th">8th</option>
								<option value="9th">9th</option>
								<option value="10th">10th</option>
								<option value="10+1">10+1</option>
								<option value="10+2">10+2</option>
							</select>
						</div>
				</div>
			</div>
			<?php
			if(file_exists("requestPages/datafiles/classRecord.jsonp"))
			{
				$string = file_get_contents("requestPages/datafiles/classRecord.jsonp");
				if(empty(json_decode($string,1)))
				{
					if(isset($_SESSION) && isset($_SESSION['class_record']['class_selected']))
					{
						$selected_class=$_SESSION['class_record']['class_selected'];
					}
					else
					{
						$selected_class="Not Available";
					}
				}
				else
				{
					$json_decode = json_decode($string, true);
					$selected_class=$json_decode[0]['current_class'];
				}
			}
			else
			{
				$selected_class="( Not Available )";
			}
			?>
			<div class="col-lg-12" >
				<div class="panel panel-default">
					<div class="panel-heading" id="heading">Showing Class Record of <?php echo $selected_class ; ?> </div>
					<div class="panel-body table-responsive">
						<div id="printable" class="table-responsive">
							<div id="filter-bar"></div>
							<table id="table" data-toggle="table"  data-url="requestPages/datafiles/classRecord.jsonp"  data-sort-order="desc" data-show-filter="true"  data-toolbar="#filter-bar" data-search="true" data-filter-control="false"  data-show-export="true" data-click-to-select="true"  data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-pagination="true" >
								<thead>
								<tr>
									<th data-formatter="runningFormatter">#</th>
									<th data-field="adm_no"  data-sortable="true">Adm. No. </th>
									<th data-field="name"  data-sortable="true">Name </th>
									<th data-field="current_class" data-sortable="true">Class </th>
									<th data-field="stream" data-sortable="true">Stream </th>
									<th data-field="profile">Profile</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div style="margin-top:10px;" class="row">
					<div id="display_error" class="alert alert-danger fade in" style="display:none"></div><!-- Display Error Container -->
				</div>
			</div>
		</div><!--/.row-->	
	</div>
	<script src="../js/bootstrap-table1.js"></script>
	<script src="../js/bootstrap-table-filter.js"></script>
	<script src="../js/bootstrap-table-filter1.js"></script>
	<script src="../js/bs-table.js"></script>
</body>
</html>

<script>
$(document).ready(function()
{
	$("#class_name").on("change",function()
	{
		var class_name=$(this).val();
		$("#class_selected").html(class_name);
		$.ajax
		({
			url : 'requestPages/Handle_requests.php',
			type: 'post',
			data : 'class='+class_name+"&Action=fetch_class_record",
			success : function(response)
			{
				location.reload(true);
			}
		});
	});
});
</script>