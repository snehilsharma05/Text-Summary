<%-- 
    Document   : userLogin
    Created on : 27 Apr, 2019, 1:58:19 PM
    Author     : KP
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%>
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

<div class="row" style="margin-top:10px;">
	<div class="container">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Search Document Here !</div>
				<div class="panel-body">
						<fieldset>
							<div class="form-group">
							<form action="search.jsp" method="post" name="login_form">	
		
                                                            <input class="form-control" placeholder="Search" name="key" type="text" autofocus="" />
                                                                <br>
                                                                <input type="submit" class="btn btn-danger" value="Search" style="float:right;" />
                                                       </form>
                                                        </div>
                                                        <%
                                                           String key=request.getParameter("key");
                                                           if(key!=null)
                                                           {
                                                               Connection con= fac.Factory.getCon();
                                                               Statement stmt= con.createStatement();
                                                              ResultSet rs= stmt.executeQuery("select * from uploaddata where main_category LIKE '"+key+"' OR sub_category LIKE '"+key+"'");
                                                               while(rs.next())
                                                               {
                                                                   %>
                                                                           
                                                                <div class="form-group">
		
                                                            <a href="">  <h3> <%=rs.getString(2)%>  </h3> </a>
                                                            <p><%=rs.getString(3)%></p>
                                                            
                                                               <form action="search.jsp" method="post" name="login_form">	
                                                                      <input type="submit" class="btn btn-success" value="Read Tutorial" style="float:right;" />
                                                             
                                                                  </form>
                                                        </div>   
                                                                   
                                                                   
                                                                   
                                                                   
                                                                   
                                                                   
                                                                   <%
                                                               }
                                                               
                                                               
                                                           }
                                                            %>
                                                        
                                                        
                                                        
                                                        
						</fieldset>
				</div>
			</div>
			<div class="row">
				<div id="display_error" class="alert alert-danger fade in" style="display:none"></div><!-- Display Error Container -->
			</div>
		
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