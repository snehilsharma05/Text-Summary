
<%@page import="java.io.ByteArrayOutputStream"%>
<%@page import="javax.imageio.ImageIO"%>
<%@page import="java.awt.image.BufferedImage"%>
<%@page import="java.io.InputStream"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%>
<!-- Header ---->
<%@page import="controller.*" %>
<div id="preloader"></div>
<div class="mask" style="display:none">
  <div class="loader circle"></div> 
</div>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<a class="navbar-brand" href="#"><span>QBS</span></a>
			<ul class="nav navbar-right navbar-top-links">
				<!-- Begin Login -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
								<ul class="dropdown-menu">
                                                                   <li>
                                                                    <a href="Invalid"> Logout</a>
  
                                                                    </li>
								</ul>
						
					
				</li>
				<!-- End Login -->  
			</ul>
		</div>
	</div><!-- container-fluid -->
</nav>
<!-- Header Ends -->
 <%
                String uid=(String) session.getAttribute("id");
            
    Connection con= fac.Factory.getCon();
    Statement stmt= con.createStatement();
    ResultSet rs= stmt.executeQuery("select pic from users where id ='"+uid+"'");
   rs.next();
   
InputStream is= rs.getBinaryStream(1);
%>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <center>
            
            <%
                if(is!=null)
                {
                    
            BufferedImage bi= ImageIO.read(is);
         ByteArrayOutputStream baos = new ByteArrayOutputStream();
ImageIO.write( bi, "jpg", baos );
baos.flush();
byte[] imageInByteArray = baos.toByteArray();
baos.close();
String b64 = javax.xml.bind.DatatypeConverter.printBase64Binary(imageInByteArray);

            %>   
                    
            <img src="data:image/jpg;base64, <%=b64%>" style="border-radius:50%; height: 100px;">
                    
                   <% 
                }
                 else
{
            %>
            <img src="images/default_user.png" style="border-radius:50%; height: 100px;">
 
            <%
                }
                %>
        
        
            <form action="PicUploadAdmin" method="post" enctype = "multipart/form-data">
          
                <input type="file"  required name="file" class="btn btn-success" style="margin-top: 10px;"><br>
            
            
            <input type="hidden" name="uid" value="<%=uid%>"/>
                <input type="submit" value="Change Pic" class="btn-warning">
            </form>
            
            
            
            
        </center>
		<ul class="nav menu">
			<li role="presentation" class="divider"></li>
			
			
			<li class="parent">
				<a href="javascript:void(0)">
					<span class="glyphicon glyphicon-hdd"></span> Users Record <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span> 
				</a>
				<ul class="children " id="sub-item-1">
                                    <li>
						<a class="" href="approvedUsers.jsp">
							<span class="glyphicon glyphicon-folder-open"></span> Approved Users 
						</a>
                                    </li>
					<li>
						<a class="" href="pendingUsers.jsp">
							<span class="glyphicon glyphicon-folder-open"></span> Pending Users
						</a>
					</li>
                                        <li>
						<a class="" href="allUsers.jsp">
							<span class="glyphicon glyphicon-folder-open"></span> All Users
						</a>
					</li>
                                        <li>
						<a class="" href="declineUsers.jsp">
							<span class="glyphicon glyphicon-folder-open"></span> Declined Users
						</a>
					</li>
				</ul>
			</li>
			<li class="parent">
				<a href="javascript:void(0)">
					
				</a>
				<ul class="children collapse" id="sub-item-2">
							
				</ul>
			</li>
					
				
			<li role="presentation" class="divider"></li>
		</ul>
	</div>

<!--/.sidebar-->


