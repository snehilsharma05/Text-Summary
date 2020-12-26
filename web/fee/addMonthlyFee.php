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
<title>Add Monthly Fees</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/datepicker3.css" rel="stylesheet" />
<link href="../css/styles.css" rel="stylesheet" />
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<script src="../js/bootstrap-datepicker.js"></script>	
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />
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

</head>

<body>
	<?php
		include "../menu.php";
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Add Monthly Fees</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Please fill out all the fields and double check before submitting</div>
				<div class="panel-body">
					<form action="requestPages/Handle_requests.php" method="post" name="add_monthly_fee_form" id="add_monthly_fee_form">	
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Admission Number" name="adm_no" id="adm" type="text" autofocus="" autocomplete="off" maxlength="5" onkeypress="number_test(this.id, event)" required/>
							</div>
							<span><p id="notify"></p></span>
							<span id="note"></span>
							
							<div class="form-group">
								<label for="class">Students Name</label>
								<input class="form-control" placeholder="Student's Name" name="name" type="text" id="name"/>
							</div>
							
							<div class="form-group" style="display:block;" id="instalmentdiv">
								<b style="font-size:15px;">Instalment to be given :</b>
								<span id="notice" style="font-size:20px;color:red"></span>							
								<input class="form-control" placeholder="Instalment" name="instalment" value="" id="instalment" type="text" readonly="readonly" style="background-color:rgba(255, 255, 255, .1)" autofocus="" autocomplete="off" required />
							</div>
							
							<div class="form-group">
								<label for="class">Class </label>
								<input class="form-control" placeholder="Class" name="current_class" value="" id="current_class" type="text" readonly="readonly" style="background-color:rgba(255, 255, 255, .1)" autofocus="" autocomplete="off" required />
							</div>
							
							<div class="form-group" style="display:none;" id="streem">
								<label for="class">Stream </label>								
								<input class="form-control" placeholder="Stream" name="stream" value="" id="stream" type="text" readonly="readonly" style="background-color:rgba(255, 255, 255, .1)" autofocus="" autocomplete="off" required />		
							</div>
							
							<div class="form-group" id="tutiondiv">
								<label for="class">Tution Fee</label>
								<input class="form-control" placeholder="Tution Fee" name="tutionfee" value="" id="tution" type="text" style="background-color:rgba(255, 255, 255, .1)" autofocus="" autocomplete="off" required  onkeypress="number_test(this.id, event)" maxlength="7"/>
							</div>
							<div class="form-group" id="annual_span">
								<label for="class">Annual Charges</label>
								<input class="form-control" placeholder="Annual Charges" id="annulfee" value="0" name="annualcharge" type="text" style="background-color:rgba(255, 255, 255, .1)"  autofocus="" autocomplete="off"  />
							</div>
							<div class="form-group" id="smart" >
								<label for="class">Smart Classes</label>
								<input class="form-control" placeholder="Smart Classes" id="smartfee"  value="" name="smartfee"  type="text"  style="background-color:rgba(255, 255, 255, .1)" autofocus="" autocomplete="off" required  onkeypress="number_test(this.id, event)" maxlength="7"/>
							</div>
							
							<div class="form-group" id="date_div">
								<label for="day" style="color:white;">Date of Fee Submission </label>
								<input class="form-control" placeholder="dd/mm/yyyy" name="dateofsub" id="day" maxlength="10" type="text" onkeypress="number_test(this.id, event)" style="background-color:rgba(255, 255, 255, .1);">
							</div>
							
							<div class="form-group" id="date_div">
								<label for="day" style="color:white;">Session Year </label>
								<input class="form-control" placeholder="Session Year" name="session_year" id="session" onkeypress="number_test(this.id, event)" maxlength="4" type="text" required/>
							</div>
							
							<div class="form-group" id="finediv">
								<label for="class">Fine</label>
								<input class="form-control" placeholder="Fine" name="fine" id="fine" value="0" style="background-color:rgba(255, 255, 255, .1)" type="text" autofocus="" autocomplete="off" onkeypress="number_test(this.id, event)" maxlength="5" />
								<span id="fine_reason"></span>
							</div>
							<div class="form-group" id="finediv">
								<label for="class">Fine Reason</label>
								<input class="form-control" placeholder="Fine Reason" name="fine_reason" id="finereason" style="background-color:rgba(255, 255, 255, .1)" type="text" autofocus="" autocomplete="off" />
							</div>
							<div class="form-group" id="totaldiv">
								<label for="class">Total ( Click below to know about full payment each time you make any changes) </label>
								<input class="form-control" placeholder="Full payment" name="total"  id="total" type="text"  style="background-color:rgba(255, 255, 255, .1)" onclick="sum()" autofocus="" autocomplete="off" readonly/>
							</div>
							<input type="hidden" name="payment_mode" value="monthly">
							<input type="submit" class="btn btn-primary" value="Submit Details" id="submitbtn"/>
						</fieldset>
						<div style="margin-top:10px;" class="row">
							<div id="display_error" class="alert alert-danger fade in" style="display:none"></div><!-- Display Error Container -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	 

<script type="text/javascript">	
//only numeric
	function number_test(id, event)
	{
		var element = $("#" + id);
		var len = element.val().length + 1;
		var max = element.attr("maxlength");

		var cond = (46 < event.which && event.which < 58) || (46 < event.keyCode && event.keyCode < 58);

		if (!(cond && len <= max)) {
			event.preventDefault();
			return false;
		}
	}	
	
	function sum()
	{
		var tution_charge=$("#tution").val();
		var smart_class_charge=$("#smartfee").val();
		var annualfee=$("#annulfee").val();
		var fine=$("#fine").val();
		var instalment=$('#instalment').val();
						
		if(instalment=="Seventh Instalment" ||  instalment=="Eighth Instalment" || instalment=="Ninth Instalment")
		{
			tution_charge=2*tution_charge;
			smart_class_charge=2*smart_class_charge;
		}
		
		// Grand Total
		var total=parseInt(tution_charge)+parseInt(smart_class_charge)+parseInt(fine)+parseInt(annualfee);
		
		if(!isNaN(total)) 
		{
			$("#total").val(total);
			$("#display_error").css("display","none");
		}
		else
		{
			$("#display_error").css("display","block");
			$("#display_error").html("There is a non number entity in amount fields");
		}
	}
</script>
<script>
$(document).ready(function () 
{
	$('#session').datepicker({
		format: "yyyy",
		viewMode: 'years',
		minViewMode: 'years'
	});  
	$('#session').on('change', function(){
		$('.datepicker').hide();
	});

	$('#day').datepicker({
		format: "dd/mm/yyyy",
	}); 
	$('#day').on('change', function(){
		$('.datepicker').hide();
	});
	
	// check For admission number
	$("#adm").keyup(function (e) 
	{
		var adm = $(this).val();
		if(adm.length < 3){$("#notify").html('Checking...');return;}
		if(adm.length >= 3)
		{
			$("#notify").html('Checking...');
		
			var path="requestPages/validateAdm.php";
			var data= {'adm_no':adm};
			$.ajax
			({
				type: 'post',
				url: path, 
				data:data,
				success : function(response)
				{
					if(response.status==0)
					{
						$("#notify").html(response.msg);
					}
					else
					{	
						if(response.msg=="")
						{
							$("#notify").html("");
							$("#submitbtn").css("display","block");
						}
						else if(response.msg=="Full Fee Paid")
						{
							$("#notify").html(response.msg);
							$("#submitbtn").css("display","none");
						}
						else
						{
							$("#notify").html(response.msg);
							$("#submitbtn").css("display","block");
						}
						$("#name").val(response.name);  
						$("#current_class").val(response.current_class);  
						$("#stream").val(response.stream);  
						
						$('#instalment').val(response.instalment);
						
						if(response.fine!=0)
						{
							$("#fine_reason").html(response.fine_reason+" ( "+response.fine +" )");
							$("#fine").val(response.fine);
							$("#finereason").val(response.fine_reason);
						}
						else
						{
							$("#fine_reason").html("");
							$("#fine").val(0);
							$("#finereason").val("");
						}
						
						if(response.instalment!="First Instalment")
						{
							$("#annual_span").css("display","none");
						}
						else
						{
							$("#annual_span").css("display","block");
						}
						
					}
				}
			});
		}
	});

	// submit form 
	$("#add_monthly_fee_form").on("submit",function(e)
	{
		e.preventDefault();
		
		$("#total").click(); // Refresh total
		$(".mask").css("display","block");
		var obj = $(this), action_name = obj.attr('name'); 
		$.ajax
		({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&Action="+action_name,
			cache: false,
			success: function (response) 
			{
				//alert(JSON.stringify(response));
				if (response.error != '') 
				{
					$("#"+action_name+" #display_error").show().html(response.error);
					$(".mask").fadeOut(3000);
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
</body>
</html>