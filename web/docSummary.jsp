      <%@page import="java.io.FileOutputStream"%>
<%@page import="java.io.File"%>
<%@page import="com.summary.CallApi"%>
<html>
<head>
<title>QBS </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title>Admin Panel - Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>	
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<script src="js/bootbox.min.js"></script>
<style>
   .abc{
    z-index:1000;   
width:auto;height:30px; 
position:fixed; 
border-radius:5px;
 bottom: 10px;
 right: 5px;
padding-bottom: 30px;
    
    
}
  .abcd{
    z-index:1000;   
width:auto;height:30px; 
position:fixed; 
border-radius:5px;
 bottom: 10px;
 left:  5px;
padding-bottom: 30px;
    
    
}
    
    
</style>
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
    <center><h2>Summary of your Document:-</h2></center>
   
   			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
                               <div class="row">
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            
		</div>	
	</div>
                    </div>
                </div>

     <%
                                                     
File f=new File("C:/Users/Snehil Sharma/Desktop/QBS2/web/Documents/temp.txt");
         CallApi ob=new CallApi();
                           StringBuilder builder=  ob.getSummary(f.getPath());
                                  out.println(builder);
                                   String s=builder.toString();
                                  File f1=new File("C://Users//Snehil Sharma//Desktop//QBS2//web//Documents//download.txt");
                                   FileOutputStream fos=new FileOutputStream(f1);
                                   byte[] b=s.getBytes();
                                   fos.write(b);
                                   fos.close();
                                  
if(f.exists())
{
f.delete();
System.out.println("Delete");
}
else
{
System.out.println("Can't Delete");

}


     
     
     
     
     %>
      <form action="index.jsp" method="post">
               <input type="submit" class="btn btn-warning abc" value="Click Here To Search Again!!">
        </form>
 <a  class="btn btn-danger abcd" href="Documents//download.txt" download>download this file</a>  
 
    </body>
</html>


