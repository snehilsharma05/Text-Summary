
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.ResultSet"%>


<%
    
   String user=(String) request.getSession().getAttribute("admin_session2");
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
<title>QBS : PJC INFOTECH</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title> Admin Panel - Dashboard</title>
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

<body>
    <%@include file="menu.jsp" %>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Declined Users</h1>
       
                                
                                
                               
	<%
            String uid1=(String)request.getParameter("id");
	Class.forName("com.mysql.jdbc.Driver");
	con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                          stmt=con.createStatement();
                          int nore=stmt.executeUpdate("update users set status='-1'where id='"+uid1+"'");
			
							  
                                                           
%>
 <table id="table" border="2" data-toggle="table"  data-sort-order="desc" data-show-filter="true" data-toolbar="#filter-bar" data-search="true" data-filter-control="false" data-show-export="true" data-click-to-select="true" data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-pagination="true" class="table table-hover">
	<thead>
	<tr>
	<th>Name</th>
	<th>Email</th>
	
	<th>Address</th>
	<th>Contact</th>
	<th>Age</th>
        <th>Gender</th>
        <th>Stream</th>
        <th>Click here to View</th>
    
	
	</tr>
	</thead>
	<tbody>
	<%

						 rs=stmt.executeQuery("select * from users where status='-1' ");
						  while(rs.next())
						  {
							  %>
							  <tr>
							  <td> <%=rs.getString(2)%></td>
							  <td> <%=rs.getString(3)%></td>
							  <td> <%=rs.getString(5)%></td>
							  <td> <%=rs.getString(6)%></td>
                                                          <td> <%=rs.getString(7)%></td>
                                                          <td> <%=rs.getString(8)%></td>
                                                          <td> <%=rs.getString(9)%></td>
							  <td> 
							  <form action="viewUser.jsp">
							  <input type="hidden" value="<%=rs.getString(1)%>" name="id">
							  <input type="submit" class="btn btn-success" value="View"/>
							  
                                                          
                                                          
                                                          
                                                          
                                                          </form>
							  </td>
                                                          
                                                          
                                                          
                                                          
                                                          
							
							  
							  
							  <tr>
                                                              
							  <%
						  }
	
	
%>
	
	</tbody>
	</table>
                              
</body>
</html>
