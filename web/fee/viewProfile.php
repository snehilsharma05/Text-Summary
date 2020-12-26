<?php
require "../includes/connection.php";
if(!isset($_SESSION) || !isset($_SESSION['valid']))
{
	header('Refresh:2;url=../login.php');
	echo "Unauthorized access! Redirecting to Login page please wait...";
	die;
}

if(!isset($_GET['adm_id']) && strlen($_GET['adm_id'])==0)
{
	$location=$_SERVER['HTTP_REFERER'];
	header('Refresh:2;url='.$location.'');
	echo "Sorry! Invalid Request. Redirecting Please Wait...";
	die;
}
else
{
	$adm_id=$_GET['adm_id'];
	$query=mysqli_query($conn,"select students.adm_no,students.name,students.student_photo from students  where students.adm_id=$adm_id ");
	while($result=mysqli_fetch_assoc($query))
	{
		extract($result);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $name;?>'s Fee Record </title>
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
				<li><a href="classWiseFeeRecord.php">Classwise Record</a></li>
				<li class="active"><?php echo $name;?>'s Fee Record</li>
			</ol>
		</div>
				
		
		<div class="row">
			
			<div class="col-lg-12" >
				<div class="panel panel-default">
					<div class="panel-heading" id="heading">Showing Fee Record of <?php echo $name ; ?> </div>
					<div class="panel-body table-responsive">
						<div id="printable" class="table-responsive">
							<div id="filter-bar"></div>
							<table id="table" data-toggle="table"  data-url="requestPages/datafiles/studentFeeRecord.jsonp"  data-sort-order="desc" data-show-filter="true"  data-toolbar="#filter-bar" data-search="true" data-filter-control="false"  data-show-export="true" data-click-to-select="true"  data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-pagination="true" >
								<thead>
								<tr>
									<!--<th data-field="state" data-checkbox="true" >ID</th>-->
									<th data-formatter="runningFormatter">#</th>
									<th data-field="adm_no"  data-sortable="true">Adm. No. </th>
									<th data-field="name" data-sortable="true">Name</th>
									<th data-field="current_class" data-sortable="true">Class</th>
									<th data-field="stream" data-sortable="true">Stream</th>
									<th data-field="payment_mode" data-sortable="true">Payment mode</th>
									<th data-field="instalment" data-sortable="true" >Instalment</th>
									<th data-field="tutionfee" data-sortable="true" >Tution Fees</th>
									<th data-field="annualfee" data-sortable="true">Annual Fees </th>
									<th data-field="smartfee" data-sortable="true">Smart Fees</th>
									<th data-field="fine" data-sortable="true" >Fine</th>
									<th data-field="total_payment" data-sortable="true">Total Payment</th>
									<th data-field="date" data-sortable="true">Date</th>
									<th data-field="month" data-sortable="true" data-visible="false">Month</th>
									<th data-field="session_year" data-sortable="true" data-visible="false">Session Year</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
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
	var adm_no='<?php echo $adm_no;?>';
	$.ajax
	({
		url : 'requestPages/Handle_requests.php',
		type: 'post',
		data : 'adm_no='+adm_no+"&Action=studentFee_record",
		success : function(response)
		{
			//alert(response);
			if(!window.location.hash) 
			{
				window.location = window.location + '#loaded';
				window.location.reload();
			}
		}
	});
});
</script>