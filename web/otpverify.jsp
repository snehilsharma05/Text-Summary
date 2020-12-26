

<!DOCTYPE html>
<html>
<head>
<title>QBS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title>Admin Panel</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootbox.min.js"></script>
<script>
jQuery(document).ready(function($)
{  
	/* Prevent Back Navigation */
	window.history.pushState(null, "", window.location.href);        
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
		
	/* Prevent Back Navigation  Ends */
	$(window).load(function(){
		$('#preloader').fadeOut('slow',function(){$(this).remove();});
		//$('#preloader').fadeOut('slow');
	});
	window.history.forward(1);
});
</script>
</head>
<body>

<div id="preloader"></div>
<div class="mask" style="display:none">
  <div class="loader circle"></div> 
</div>

<div class="row" style="margin-top:100px;">
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<form action="OtpGenerator" method="post" >	
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Forgot Password</div>
				<div class="panel-body">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Enter Otp" name="Otp" type="text" autofocus="" />
							</div>
							
							<input type="submit" class="btn btn-primary" value="Send Otp" />
                                                       
                                                     
                                                       
                                                        
						</fieldset>
				</div>
			</div>
			<div class="row">
				<div id="display_error" class="alert alert-danger fade in" style="display:none"></div><!-- Display Error Container -->
			</div>
		</form>
	</div><!-- /.col-->
</div><!-- /.row -->

<%  String status=(String) request.getAttribute("status");
if(status !=null)
        {
        %>
        <script>
            alert( "<%=status%>");     </script>
        
        
        
        
        
        <%
        }
        
        
        
        %>
   <% String error=(String) request.getAttribute("error");
    if(error!=null)
    {
    %>
    
    <script>
                  iziToast.show({

            					theme: 'dark', // dark

            					color: 'green', // blue, red, green, yellow

            					title: 'success',

            					position:'topRight',

                					overlay:true,

            					message: ' User Approved  Successfully....'

            				});

            				setTimeout(function() 

            				{

            					//window.location.href="index.php";

            				}, 3000); 
            
            
            
            
           
    
    
    </script>
    
    <%
    }
    %>

</body>
</html>




<script>		
$(document).ready(function()
{		
	$("#login_form").on("submit",function(e)
	{
		e.preventDefault();
		$(".mask").css("display","block");
		var obj = $(this), action_name = obj.attr('name'); /*Define variables*/
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&Action="+action_name,
			cache: false,
			success: function (result) 
			{
				//alert(JSON.stringify(result));
				if (result.error != '') 
				{
					$("#"+action_name+" #display_error").show().html(result.error);
					$(".mask").fadeOut(3000);
				} 
				else 
				{
					window.location.href="index.php";
				}
			}
		});
	});
});
</script>