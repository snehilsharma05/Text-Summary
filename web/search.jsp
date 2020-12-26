

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
<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<style>
    body{
        font-family: 'Poppins', sans-serif;
        background-image:url('images/banner_new.jpg');
    }
</style>
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
<div style="background:red">
    <ul style="display:inline-block;text-decoration: none">
        <li><a href="">Home</a></li>
        <li><a href="">Home</a></li>
        <li><a href="">Home</a></li>
    </ul> 
</div>
<div class="row" style="margin-top:10px;">
	<div class="container">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Search Document Here !</div>
				<div class="panel-body">
						<fieldset>
							<div class="form-group clearfix">
							<form action="search.jsp" method="post" name="login_form">	
		
                                                            <input class="form-control" placeholder="Search the file in our database " name="key" type="text" autofocus="" />
                                                                <br>
                                                                <input type="submit" class="btn btn-danger" value="Use Public Search" style="float:right;" />
                                                                
                                                               <a href="userLogin.jsp" class="btn btn-success"  style="float:left;">Use Private Search</a>
                                                                
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
                                                                           
                                                                <div class="form-group content-view panel clearfix">
                                                                    
                                                             <div class="panel-heading">       
                                                            <a href="">  <h2> <%=rs.getString(2)%>  </h2> </a>
                                                             </div>
                                                            <div class="panel-body">
                                                            <h3><%=rs.getString(3)%></h3>
                                                            <p><%=rs.getString(7)%></p>
                                                            <form action="pdfviewer.jsp" method="get" name="login_form">	
                                                                   <input type="hidden" name="path" value="<%=rs.getString(5)%>">
                                                                  
                                                                      <input type="submit" class="btn btn-success" value="Read Tutorial" style="float:right;" />
                                                             
                                                                  </form>
                                                                    </div>
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