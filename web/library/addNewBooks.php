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
<title>Add New Books</title>
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
				<li class="active">Add New Books</li>
			</ol>
		</div>
		<div class="row">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Please fill out all the fields and double check before submitting</div>
				<div class="panel-body">
					<form action="requestPages/Handle_requests.php" method="post" name="add_new_books_form" id="add_new_books_form">	
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Book Id" name="book_id" type="text"  id="book_id" autofocus="" autocomplete="off" required/>
								<span id="notify"></span>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="ISBN" name="isbn" type="text"  id="isbn" autofocus="" autocomplete="off" maxlength="10" onkeypress="number_test(this.id, event)" required/>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Book Title" name="title" type="text" required/>
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
								<input class="form-control" placeholder="No. of Copies" name="no_of_copies" type="text" maxlength="2" id="no_of_copies" onkeypress="number_test(this.id, event)" required />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Remarks" name="remarks" type="text" />
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
	// Prevent Paste in Isbn Number
	var myInput = document.getElementById('isbn');
	 myInput.onpaste = function(e) {
	   e.preventDefault();
	 }
	
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
		if(book_id.length < 2){$("#notify").html('<p>Checking...</p>');return;}
		if(book_id.length >= 2)
		{
			$("#notify").html('<p>Checking...</p>');
			$.post('requestPages/validate.php', {'book_id':book_id}, function(data) {
			  $("#notify").html(data);
			});
		}
	});	
	
	// submit form 
	$("#add_new_books_form").on("submit",function(e)
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