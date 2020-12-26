<%@page import="java.sql.Timestamp"%>
<%@page import="java.sql.Date"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Driver"%>
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
<title>MyProfile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title> Tracking</title>
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
    <%@include file="menuUser.jsp" %>
   
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
			</ol>
	
                </div><!--/.row--> <table class="table-bordered" style="margin-left:300px; width:900px;">
        <tr>
            <th style=" height:100px;font-size:90px; font-family:cursive;"><center>Date and Time</center></th>
        </tr>
                <div class="offset ml-5">
                    
   <%  String id=(String)session.getAttribute("id");
  int id1= Integer.parseInt(id);
            //Connection con=null;
     //Statement stmt=null;
   //ResultSet rs=null;
   
    try
{
    int count=0,kl;
    Timestamp d=null;
	Driver d1=new com.mysql.jdbc.Driver();
	DriverManager.registerDriver(d1);
		//Class.forName("com.mysql.jdbc.Driver");
		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                                stmt=con.createStatement();
					
                            rs=stmt.executeQuery("select * from userlogin where id='"+id1+"'" );
                                 // out.println("<form >");
                                 
                            while(rs.next())
                            {
                                d=rs.getTimestamp("date");
                                kl=rs.getInt("id");
                                if(id1==kl)
                                {
                                    count++;
                                }
                                
                             %>
                        
                             <tr>
                             <td style="height:60px; font-family:cursive; font-size:50px;"><center> <%out.println(d);%></td></center>
                             </tr>

                           
                             <%                                     
                                 
                                
                            }
                             %>
                            <h1><center><% out.println("No. of logged-in attempts ="+count);%></center></h1>        

                            <%
}
	catch(Exception e)
	{
		out.println(e);
	}

try{
stmt.close();	
con.close();
}
catch(Exception e)
{
	System.out.println(e);
}
   
   
   %>            
    
    
        </div>
        
   
    </body>
</html>
