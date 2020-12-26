

<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.ResultSet"%>





<%
    
   String user=(String) request.getSession().getAttribute("admin_session");
   if(user==null)
   {
   %>
   
   <script>
       
        window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'userLogin.jsp';

    }, 0);
       
    
  </script>
 
   
   
   <%
   }
    
    %>



<!DOCTYPE html>
<html>
<head>
<title>QBS </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title>User - Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>	
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<script src="js/bootbox.min.js"></script>
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

<body id="login" class="container-fluid">
    <%
    String id=(String)request.getAttribute("id");
    String name=(String)request.getSession().getAttribute("name");
    
    %> 
   
    <%@include file="menuUser.jsp" %>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
			</ol>
		</div>
            
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome <%=name%></h1>
                                
                               <div class="row">
                                   
                                                                       <%
                                                            String id3=(String)request.getSession().getAttribute("id");
 

                                                               con= fac.Factory.getCon();
                                                                stmt= con.createStatement();
                                                              rs= stmt.executeQuery("select * from uploaddata where userid='"+id3+"'");
                                                               while(rs.next())
                                                               {
                                                                   %>
                                                                           
                                                                <div class="form-group">
		
                                                           <div class="container-fluid">
  <div class="row">
  <div class="col-sm-2 col-lg-4">
  <div class="card ml-3" id="card1" style="width: 25rem;">
 
  <div class="card-body" style="background:rgba(0,0,0,0.3);">
    <h1 class="card-title">category:<br></h1><h2><%=rs.getString(2)%> </h2>
    <h3 class="card-text"><%=rs.getString(3)%></h3>
    
    <div class="card-body" style="background:#ffb53e;height:200px;overflow-y:scroll;padding:10px">
        <h3 style="color:#000">description:</h3><br><p style="color:#000"><%=rs.getString(7)%></p>
  </div>
  </div>
  </div>
  </div>
                                                            
   <%} 
   %> 
                                   
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            
            
			</div>
                                   
		</div>	
	</div>
                    </div>
                </div>
</body>
</html>
