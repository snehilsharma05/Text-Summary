<%@page import="java.util.List"%>
<!DOCTYPE html>
<html>
<head>
<title>QBS : PJC INfotech</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />

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
<div >
<div class="row" >
	<div class="col-xs-1 col-xs-offset-1 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-4" style="margin-left:300px; width:1000px;">
		<form action="RegisterServlet" method="post" name="login_form">	
			<div class="login-panel panel panel-default">
				<div class="panel-heading">User Registration</div>
				<div class="panel-body">
						<fieldset>
							      <p>Enter your personal details below</p>
     <%
List l=(List)request.getAttribute("error");
 %>
          <fieldset>
              <div class="row">
                  <div class="col-md-6">
    <div class="form-group">
        <h3>    <label>Name</label></h3> 
<input class="form-control" placeholder="Username" name="name" type="text" autofocus="" />
        
           
            <%
	if(l!=null)
	{
		if(l.contains("1"))
		{
	%>		
<font color="red">	
Enter Name First !
	</font>

<%	}
	}
	%>
            </div>
            <div class="form-group  ">
             <h3>    <label>Email</label></h3> 
<input class="form-control" placeholder="Email" name="email" type="email" autofocus="" />

           <%
	if(l!=null)
	{
		if(l.contains("2"))
		{
	%>		
<font color="red">	
Enter Email First !
	</font>

<%	}
	}
	%>
            </div>
            
           
           
           
            
            
            <div class="form-group">
              <h3> <label >Contact</label></h3> 
              <input class="form-control" placeholder="Contact" name="contact" type="number"  autofocus="" />
              <%
	if(l!=null)
	{
		if(l.contains("5"))
		{
	%>		
<font color="red">	
Enter Contact First !
	</font>

<%	}
	}
	%>
              <p class="help-block hint-block">Numeric values from 0-***</p>
            </div>
               <div class="form-group">
              <h3>   <label class="control-label">Gender &nbsp;&nbsp; </label></h3> 
              <div class="radio">
                  
                  <label ><input type="radio" name="gender"  checked value=" Male">Male<br></label>
                  <label ><input type="radio" name="gender" checked value=" Female">Female<br></label>
                
              </div>
            </div>
              
              
              
              </div>
              <div class="col-md-6">
                           <div class="form-group">
             <h3>  <label >Address</label></h3> 
    <input class="form-control" placeholder="Address" name="address" type="text" autofocus="" />          
           <%
	if(l!=null)
	{
		if(l.contains("4"))
		{
	%>		
<font color="red">	
Enter Address First !
	</font>

<%	}
	}
	%>
            </div>
                  
              <div class="form-group">
             <h3>  <label >Password</label></h3> 
              <input class="form-control" placeholder="Password" name="password" type="password" autofocus="" />
           <%
	if(l!=null)
	{
		if(l.contains("3"))
		{
	%>		
<font color="red">	
Enter Password First !
	</font>

<%	}
	}
	%>
            </div>
                  
                  
                  
            <div class="form-group">
              <h3> <label >Age</label></h3> 
              <input class="form-control" placeholder="Age" name="age" type="number" maxlength="2" autofocus="" />
              <%
	if(l!=null)
	{
		if(l.contains("6"))
		{
	%>		
<font color="red">	
Enter Age First !
	</font>

<%	}
	}
	%>
              <p class="help-block hint-block">Numeric values from 0-***</p>
            </div>
              
              
              
              
              
           
            <div class="form-group filled">
             <h3>  <label class="control-label">Stream</label></h3> 
              <select name="stream" value="select" required class="form-control ng-invalid ng-invalid-required" ng-model="model.select" ><option value="? undefined:undefined ?"></option>
                <option value="Agriculture">Agriculture</option>
                <option value="IT">IT</option>
                <option value="Science">Science</option>
                <option value="Psychology">Psychology</option>
                <option value="Literature">Literature</option>
                <option value="Law">Law</option>
                <option value="Others">Others</option>
              </select>
                           <%
	if(l!=null)
	{
		if(l.contains("8"))
		{
	%>		
<font color="red">	
select stream First !
	</font>

<%	}
	}
	%>
            </div>
              </div>
              </div>
                
              <div class="text-center">
              
              <button type="submit" class="btn btn-default">Submit</button>
              
      <div class="registration">
        <h3 class="control-label">  Already Registered. <a class="btn control-label" href="userLogin.jsp">Login</a></h3>
      </div>
              </div>
						</fieldset>
				</div>
			</div>
			<div class="row">
				<div id="display_error" class="alert alert-danger fade in" style="display:none"></div><!-- Display Error Container -->
			</div>
		</form>
	</div><!-- /.col-->
</div><!-- /.row -->
</div>


</body>
</html>
