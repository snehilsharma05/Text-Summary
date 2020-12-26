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
<title>Issue Books</title>
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
<script src="https://netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
<style>

.tt-hint
{
	border: 1px solid rgba(255, 255, 255, .1);
    box-shadow: none;
    background: rgba(255, 255, 255, .1);
    color: rgb(5,220,193);
	display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
	-webkit-rtl-ordering: logical;
    user-select: text;
    cursor: auto;
	letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
	border-radius: 8px 8px 8px 8px;
}

.tt-dropdown-menu {
	width: 100%;
	margin-top: 5px;
	padding: 8px 12px;
	background-color: #76613c;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px 8px 8px 8px;
	font-size: 12px;
    color: white;
}
#book_name
{
	width:1054px;
}
</style>
</head>
<body>
	<?php
		include "../menu.php";
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Issue Books</li>
			</ol>
		</div>
		<div class="row">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Please fill out all the fields and double check before submitting</div>
				<div class="panel-body">
					<form action="requestPages/Handle_requests.php" method="post" name="issue_books_form" id="issue_books_form">	
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Admission No." name="adm_no" type="text"  id="adm_no" autofocus="" autocomplete="off" maxlength="10" onkeypress="number_test(this.id, event)" required/>
								<span id="notify"></span>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Book Id" name="book_id" type="text"  id="book_id" autofocus="" autocomplete="off" required/>
								<span id="notify1"></span>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Book Title" name="title" id="book_name" type="text" required/>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Author Name" name="author" type="text" required/>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Publisher Name" name="publisher" type="text" required/>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Year of Publication" name="publication_year" id="session" type="text" required/>
							</div>
							<div class="form-group">
								<label for="genre">Genre</label>
								<select class="form-control" id="genre" name="genre">
									<option value="Arts and recreation">Arts and recreation</option>
									<option value="Autobiographies">Autobiographies</option>
									<option value="Action and Adventure">Action and Adventure</option>
									<option value="Biographies">Biographies</option>
									<option value="Children's"> Children's </option>
									<option value="Comics">Comics</option>
									<option value="Computer science, information and general works">Computer science, information and general works</option>
									<option value="Cookbooks"> Cookbooks </option>
									<option value="Diaries">Diaries</option>
									<option value="Diaries">Drama</option>
									<option value="Dictionaries">Dictionaries</option>
									<option value="Encyclopedias">Encyclopedias</option>
									<option value="Guide">Guide</option>
									<option value="Health">Health</option>
									<option value="Hindi">Hindi</option>
									<option value="History and geography">History and geography</option>
									<option value="Horror">Horror</option>
									<option value="Journals">Journals</option>
									<option value="Language">Language</option>
									<option value="Mystery">Math</option>
									<option value="Mystery">Mystery</option>
									<option value="Poetry">Poetry</option>
									<option value="Prayer books">Prayer books</option>
									<option value="Religion">Religion</option>
									<option value="Romance">Romance</option>
									<option value="Religion, Spirituality & New Age">Religion, Spirituality & New Age</option>
									<option value="Satire">Satire</option>
									<option value="Science fiction">Science fiction</option>
									<option value="Self help">Self help</option>
									<option value="Series">Series</option>
									<option value="Social Sciences">Social Sciences</option>
									<option value="Social Sciences">Social Sciences</option>
									<option value="Technology and applied science">Technology and applied science</option>
									<option value="Trilogy">Trilogy</option>
									<option value="Travel">Travel</option>
								</select>
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Date of Issue" name="issued_on" id="issued_on" type="text" required />
							</div>
							
							<input type="submit" class="btn btn-primary" value="Submit Details" />
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
$(document).ready(function () 
{
	
	 $('input#book_name').typeahead
	 ({
		book_name: 'book_name',
		remote: 'requestPages/book_suggestions.php?query=%QUERY'
	});
	
	$('#issued_on').datepicker({
		format: "dd/mm/yyyy"
	});  
	$('#issued_on').on('change', function(){
		$('.datepicker').hide();
	});
	
	
	$('#session').datepicker({
		format: "yyyy",
		viewMode: 'years',
		minViewMode: 'years'
	});  
	$('#session').on('change', function(){
		$('.datepicker').hide();
	});

	// check For same book number
	$("#book_id").keyup(function (e) 
	{
		var book_id= $(this).val();
		if(book_id.length < 2){$("#notify1").html('<p>Checking...</p>');return;}
		if(book_id.length >= 2)
		{
			$("#notify1").html('<p>Checking...</p>');
			$.post('requestPages/validate.php', {'book_id':book_id}, function(data) {
			  $("#notify1").html(data);
			});
		}
	});

	// check For same admission number
	$("#adm_no").keyup(function (e) 
	{
		var adm_no= $(this).val();
		if(adm_no.length < 4){$("#notify").html('<p>Checking...</p>');return;}
		if(adm_no.length >= 4)
		{
			$("#notify").html('<p>Checking...</p>');
			$.post('requestPages/validate_admno.php', {'adm_no':adm_no,'books_issued':'books_issued'}, function(data) {
			  $("#notify").html(data);
			});
		}
	});
	
	// submit form 
	$("#issue_books_form").on("submit",function(e)
	{
		e.preventDefault();
		$(".mask").css("display","block");
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