<%@page import="converter.WordManager"%>
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
        
      //  response.setIntHeader("Refresh", 2);
    String id=(String)request.getAttribute("id");
    
        String path=(String) request.getParameter("path");
        //out.println(path);
        String words[]=path.split("\\.");
        String ext=words[1];
        %>
       
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				
                               <div class="row">
                                   <% 
                                       String    filePath = getServletContext().getInitParameter("file-upload"); 

                                       
                                       if(ext.equals("pdf"))
                                   {

                                   %>
                                         <form action="pdfConverter" method="post">
            <input type="hidden" value="<%=path%>" name="doc_path">
    <input type="submit" class="btn btn-danger abc" value="Create Summary">
        </form>

    <center><h2>PDF Viewer is showing your Selected Pdf. Now Your pdf is ready for summary</h2></center>
                                   <embed src="Documents/<%=path%>" type="application/pdf" width="800px" height="2100px" />
                                   
                                   
                                   
                                   <% }
                                    else if(ext.equals("docx"))
                                       { 
                                   
            WordManager word=new WordManager();
            word.setFilePath(filePath+path);
                       String text1=word.toText();

                                   %>
                                   
                                   <center><h2>You can view your selected Document.Now Your Document is ready for summary</h2></center>
                                        <form action="docConverter" method="post">
            <input type="hidden" value="<%=path%>" name="doc_path">
    <input type="submit" class="btn btn-danger abc" value="Create Summary">
        </form>
    <textarea rows="100" style="color:black" cols="130"><%=text1%></textarea>
    
<!--    <iframe src="Documents/temp.txt" style="background-color: #fff" width="800px" height="1500px"></iframe>
                                    -->
                                   <% out.println(path);}
                                 else
                                 {
                                    %>
                                    <center><h2>You can view your selected Text File.Now Your Document is ready for summary</h2></center>
                                      <form action="textConverter" method="post">
            <input type="hidden" value="<%=path%>" name="doc_path">
    <input type="submit" class="btn btn-danger abc" value="Create Summary">
        </form>

                                    <iframe src="Documents/<%=path%>" style="background-color: #FFF" width="800px" height="1500px"></iframe>
                                <% }  %>
        
        
        
        </div>
                    </div>
                </div>
</body>
</html>
