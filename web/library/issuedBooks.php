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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<link rel="icon" href="../favicon.ico" type="image/x-icon" />
<title>Issued Books </title>
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
<style>
.modal-body .form-control
{
	border:solid thin black;
	color:black;
} 
</style>
</head>
<body>		
	<?php
		include "../menu.php";
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Issued Books</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12" >
				<div class="panel panel-default">
					<div class="panel-heading" id="heading">Showing Books Issued    </div>
					<div class="panel-body table-responsive">
						<div id="printable" class="table-responsive">
							<div id="filter-bar"></div>
							<table id="table" data-toggle="table" data-url="requestPages/datafiles/allIssuedBooks.jsonp"  data-sort-order="desc" data-show-filter="true"  data-toolbar="#filter-bar" data-search="true" data-filter-control="false"  data-show-export="true" data-click-to-select="true"  data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-pagination="true"  >
								<thead>
								<tr>
									<th data-formatter="runningFormatter">#</th>
									<th data-field="book_id"  data-sortable="true" data-visible="false">Book Id</th>
									<th data-field="adm_no"  data-sortable="true">Adm. No</th>
									<th data-field="name"  data-sortable="true">Student Name</th>
									<th data-field="current_class" data-sortable="true">Class</th>
									<th data-field="title" data-sortable="true" >Title</th>
									<th data-field="author_name" data-sortable="true" data-visible="false" >Author Name</th>
									<th data-field="publisher"  data-sortable="true"data-visible="false" >Publisher</th>
									<th data-field="publication_year" data-sortable="true" data-visible="false">Publication Year</th>
									<th data-field="genre" data-sortable="true" data-visible="false" >Genre </th>
									<th data-field="issued_on" data-sortable="true" >Issued On</th>
									<th data-field="returning_date" data-sortable="true">Returning_date</th>
									<th data-field="due_days" data-sortable="true">Due Days</th>
									<th data-field="action" data-sortable="true">Action</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>
	
	<div class="modal fade" id="sendsms" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title" style="color:black">Send Sms </h4>
			</div>
			<form role="form" action="requestPages/Handle_requests.php" method="post" name="sendsms_single_form" id="sendsms_single_form">
			<div class="modal-body">
				<fieldset>
					<input type="hidden" name="adm_no" id="adm_no">
					<div class="form-group">
						<label>Message </label> 
						<textarea class="form-control" id="sms" placeholder="Type SMS here" name="sms" required ></textarea>
					</div>
				<fieldset>
			</div>
			<div class="modal-footer" style="border:none;">
			  <button type="submit" class="btn btn-primary" >Submit</button>
			</div>
			</form>
		  </div>
		  
		</div>
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
	$.ajax
	({
		url : 'requestPages/Handle_requests.php',
		type: 'post',
		data : "Action=allIssuedBooks",
		success : function(response)
		{
			//alert(JSON.stringify(response));
			if(!window.location.hash) 
			{
				window.location = window.location + '#loaded';
				window.location.reload();
			}
		}
	});
	
	$("#table").on("click",".smsbtn",function()
	{
		var id=$(this).attr("id");
		$("#adm_no").val(id);
	});	
	
	$("#table").on("click",".returnbtn",function()
	{
		var adm_no=$(this).attr("id");
		var book_id=$(this).prev("input").val();
		$.ajax({
			type: "POST",
			url: "requestPages/Handle_requests.php",
			data: {"adm_no":adm_no,"book_id":book_id,"Action":"Return_book"},
			cache: false,
			success: function (response) 
			{
				//alert(JSON.stringify(response));
				if (response.error != '') 
				{
					$(".mask").fadeOut(3000);
					bootbox.dialog({
					message: response.error,
					closeButton: false
					});
					setTimeout(function() {
							$(".mask").fadeOut(3000);
							bootbox.hideAll();
						}, 2000);
				} 
				else 
				{
					bootbox.dialog({
					message: response.result.msg,
					closeButton: false
					});
					setTimeout(function() {
							location.reload(true);
							bootbox.hideAll();
						}, 2000);
				}
			}
		});
	});
	
	$('#sms').keyup(function ()
	{
		var max = 160;
		var len = $(this).val().length;
		if (len >= max) {
		$('#sms-alert').text('you have reached the 160 characters limit.');
		} else {
		var char = max - len;
		$('#sms-alert').text(char + ' characters left');
		}
	});
	
	// submit form 
	$("#sendsms_single_form").on("submit",function(e)
	{
		e.preventDefault();
		$(".mask").css("display","block");
		$('#sendsms').modal('hide');
		var obj = $(this), action_name = obj.attr('name'); /*Define variables*/
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&Action="+action_name,
			cache: false,
			success: function (response) 
			{
				//alert(JSON.stringify(response));
				if (response.error != '') 
				{
					
					bootbox.dialog({
					message: response.error,
					closeButton: false
					});
					setTimeout(function() {
							$(".mask").fadeOut(3000);
							bootbox.hideAll();
						}, 2000);
				} 
				else 
				{
					bootbox.dialog({
					message: response.result.msg,
					closeButton: false
					});
					setTimeout(function() {
							location.reload(true);
							bootbox.hideAll();
						}, 2000);
				}
			}
		});
	});
	
});
</script>