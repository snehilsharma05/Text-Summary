<%@page  import="com.summary.*" %>
<!DOCTYPE html>
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
<script>
jQuery(document).ready(function($)
{  
	$(window).load(function(){
		$('#preloader').fadeOut('slow',function(){$(this).remove();});
		//$('#preloader').fadeOut('slow');
	});
});
</script>
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
    
    
</style>
</head>

<body id="login" class="container-fluid">
    <%
  	  String ext=(String) request.getAttribute("ext");
        String path=(String) request.getAttribute("path");
        %>
       
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				
                               <div class="row">
	
                                   
                                      <%                              
                                if(ext.equalsIgnoreCase("pdf")){       
	                   CallApi ob=new CallApi();
                           StringBuilder builder=  ob.getSummary("c:/temp/temp.txt");
                                   out.println(builder);
                                }
                                else if(ext.equalsIgnoreCase("txt"))
                                {
                                CallApi ob=new CallApi();
                           StringBuilder builder=  ob.getSummary(path);
                                   out.println(builder);
                                 }
                               // else if(ext.equalsIgnoreCase("docx")){
                               // CallApi ob=new CallApi();
                           //StringBuilder builder=  ob.getSummary("C://Users//HP//Desktop//QBS2//web//Documents//out1.txt");
                             //      out.println(builder);}
                                //else{
                                //CallApi ob=new CallApi();
                           //StringBuilder builder=  ob.getSummary("C://Users//HP//Desktop//QBS2//web//Documents//outss.txt");
                                   //out.println(builder);}
                                
                               %>    
                                   
                                   

	</div>
                    </div>
                </div>
</body>
</html>
