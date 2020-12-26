<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%><!DOCTYPE HTML>
<html>
<head>
<title>Query Based Text Summarization</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Appest Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
<!-- //end-smoth-scrolling -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
</head>
<body>
    
<!--header start here-->
  <div class="header">
	<div class="container">
		 <div class="header-main">
				<div class="logo">
                                    <img src="images/logo.png" >
					<!--a href="index.html">QBS</a-->
				</div>
				<div class="top-nav">
					<span class="menu"> <img src="images/icon.png" alt=""/></span>
				 <nav class="cl-effect-16">
					<ul class="res">
					   <li><a href="index.jsp" class="active"  data-hover="Home">Home</a></li> 
					   <li><a class="scroll" href="#howitworks"  data-hover="How it Works">How it Works</a></li> 
						<li><a class="scroll" href="#login"  data-hover="Login">Login</a></li> 
                                                <li><a class="scroll" href="#about"  data-hover="About">About</a></li>
						<li><a class="scroll" href="#features"  data-hover="Features">Features</a></li> 
						<li><a class="scroll" href="#contact"  data-hover="Contact">Contact </a></li> 
				   </ul>
				 </nav>
					<!-- script-for-menu -->
						 <script>
						   $( "span.menu" ).click(function() {
							 $( "ul.res" ).slideToggle( 300, function() {
							 // Animation complete.
							  });
							 });
						</script>
		        <!-- /script-for-menu -->
				</div>				
		 
                 </div>
   </div>
</div>
<div class="banner">

    <div class="banner-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="search-form">
                    
                

			
						<fieldset>
							
							<form action="index.jsp" method="post" name="login_form" autocomplete="off">	
		 
                                                            

                                                        <div class="form-group">           
                                                                 
                                                            <input list="browsers" id="no_name" class="form-control" placeholder="Search the file in our database " name="key" type="text" autofocus="" autocomplete="off" />
                                                               
<ul id="browsers" class="datalist">
                                                            <%
                                                                     Connection con1= fac.Factory.getCon();
                                                               Statement stmt1= con1.createStatement();
                                                              ResultSet rs1= stmt1.executeQuery("select * from uploaddata ");
                                                               while(rs1.next())
                                                               {
                                                                   %>
                                                                  
                                                                   <li><%= rs1.getString(2)%></li>
      <%
                                                               }
                                                               %>
                                                                 </ul>                                                                
                                                        </div>
                                                                 <div class="form-group text-center">           
                                                                <input type="submit" class="btn btn-primary" value="Use Public Search" />
                                                                
                                                               <a href="userLogin.jsp" class="btn btn-primary">Use Private Search</a>
                                                                </div>
                                                       </form>
                                                       
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
</div>
    </div>
</div>
<!-- FlexSlider -->
				  <script defer src="js/jquery.flexslider.js"></script>
				  <script type="text/javascript">
					$(function(){
					 
					});
					$(window).load(function(){
					  $('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					  });
					});
				  </script>
			<!-- FlexSlider -->

<!--header end here-->
<!--about start here-->

<div class="about" id="howitworks">
	<div class="container">
		<div class="about-main">
			<div class="about-top">
				<h2>How it Works</h2>
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <span class="glyphicon glyphicon-search"></span>
                                        <h3>Search</h3>
                                        <p>User can search the document from our database and can create a summary.
                                           If the file is not in our database , user have to register with us and after 
                                           registration user can upload the file and can create a summary. 
                                           
                                        </p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        <h3>Register</h3>
                                        <p>In the registration page , user will have to fill the required credentials and then unique Id is assigned to the user.
                                        If admin will approve user, only then account will become active otherwise user will get a declined email from admin.  
                                        </p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <h3>Login</h3>
                                        <p>If the admin approves the account of the user then user can login into his/her account by entering the email and password.
                                        If a user forgets his password then he/she can recover it by entering the registered email and password will be sent to the registered email.
                                        </p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="glyphicon glyphicon-list"></span>
                                        <h3>Summary</h3>
                                        <p>User can create summary of the documents having extensions .pdf/.txt/.docs/.dox . Moreover , user can create summary in any language.
                                        Our summary tool is efficient in English , French , Hindi , Urdu and many more. 
                                        </p>
                                    </div>
                                </div>
			</div>
		<!--	<div class="about-bottom">
				<div class="col-md-4 about-grid">
					<h3>Et harum quidem rerum</h3>
					<img src="images/a1.jpg" alt="" class="img-responsive">
					<p>cumque assumenda  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ounce with righteous indignation and dislike men beguiled</p>
				</div>
				<div class="col-md-4 about-grid">
					<h3>Libero tempore soluta</h3>
					<img src="images/a2.jpg" alt="" class="img-responsive">
					<p>cumque assumenda  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ounce with righteous indignation and dislike men beguiled</p>
				</div>
				<div class="col-md-4 about-grid">
					<h3>Temporibus quibusdam</h3>
					<img src="images/a3.jpg" alt="" class="img-responsive">
					<p>cumque assumenda  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ounce with righteous indignation and dislike men beguiled</p>
				</div>
			  <div class="clearfix"> </div>
			</div>-->
		</div>
	</div>
</div>




<!--gallery start here-->
<div class="gallery" id="login">
	<div class="container">
		<div class="gallery-top">
			<h3 >Login</h3>
                        <p>User or Admin can Login into their account by entering the required email and password.</p></div>
            <div class="row">
                <div class="col-md-6 admin-bg text-center">
                    <h3>Login By Admin</h3>
                    <a class="btn btn-primary" href="userLogin.jsp"> Login Here</a>
                </div>
                <div class="col-md-6 user-bg text-center">
                    <h3>Login By User</h3>
                     <a class="btn btn-primary" href="userLogin.jsp"> Login Here</a>
                </div>
            </div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
			<script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){
				    $('#nivo-lightbox-demo a').nivoLightbox({ effect: 'fade' });
				});
				</script>
<!--gallery end here-->
<!--features strat here-->
<!--about us-->
<div class="about" id="howitworks">
	<div class="container">
		<div class="about-main" id="about">
			<div class="about-top">
				<h2>About </h2>
                                <p class="lead">Query Based Text Summarization is the process of creating a shorter version of the text with only vital information and thus, helps the user to understand the text in a shorter amount of time. Query Based Text Summarization is one of the most challenging and interesting problems in the field of Natural Language Processing (NLP). It is a process of generating a concise and meaningful summary of text from multiple text resources such as books, news articles, blog posts, research papers, emails, and tweets. 
To take the appropriate action, we need the latest information.
 But on the contrary, the amount of information is more and more growing. There are many categories of information (economy, sports, health, technology?) and also there are many sources (news site, blog, SNS?).So to make an automatically & accurate summaries feature will helps us to understand the topics and shorten the time to do it.

</p>
                        </div>
                </div>
        </div>
</div>
				
<div class="features" id="features">
	<div class="container">
		<div class="features-main">
			<div class="features-top">
				<h3>Features</h3>
				<p></p>
			</div>
			<div class="features-bottom">
				<div class="feats-bot1">
				<div class="col-md-6 feat-grid">
					<div class="col-md-5 feat-img">
						<img src="images/pdf.jpg" alt="" class="img-responsive">
					</div>
					<div class="col-md-7 feat-text">
						<h4>Pdf Summary </h4>
						<p>We provide you the feature of pdf summary. Pdf can contain text in any language.
                                                We will provide the Summary of your pdf and helps you to save your time.
                                                </p>
					</div>
				  <div class="clearfix"> </div>
				</div>
				<div class="col-md-6 feat-grid">
					<div class="col-md-5 feat-img">
						<img src="images/docs.jpg" alt="" class="img-responsive">
					</div>
					<div class="col-md-7 feat-text">
						<h4>Document Summary</h4>
						<p>We provide you the feature of Document summary. Document can contain text in any language.
                                                We will provide the Summary of your document and helps you to save your time.
                                                </p>
					</div>
				</div>
			   <div class="clearfix"> </div>
			</div>
			<div class="feats-bot1">
				<div class="col-md-6 feat-grid">
					<div class="col-md-5 feat-img">
						<img src="images/notepad.jpg" alt="" class="img-responsive">
					</div>
					<div class="col-md-7 feat-text">
						<h4>Text File Summary</h4>
						<p>We provide you the feature of Text summary. Text File can contain text in any language.
                                                We will provide the Summary of your text file and helps you to save your time.
                                                </p>
					</div>
				  <div class="clearfix"> </div>
				</div>
				<div class="col-md-6 feat-grid">
					<div class="col-md-5 feat-img">
						<img src="images/articles.jpg" alt="" class="img-responsive">
					</div>
					<div class="col-md-7 feat-text">
						<h4>Article Summary</h4>
						<p>We provide you the feature of article summary. Articles can contain text in any language.
                                                We will provide the Summary of your articles(news,stories etc) and helps you to save your time.
                                                But for this feature User have to create his/her account first.
                                                </p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			  <div class="clearfix"> </div>
			</div>
			</div>
		</div>
	</div>
</div>
<!--features end here-->
<!--contact-starts--
	<div class="contact" id="contact">
		<div class="container">
			<div class="contact-head">
				<h3>Contact</h3>
				<p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque assumenda</p>
			</div>
			<div class="contact-top">
				<div class="col-md-4 contact-left">
					<div class="add1">
						<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
						<p><small class="con-bold">company name,</small> Glasglow 40 Fe 72.</p>
					</div>
					<div class="add1">
						<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
						<p>+755 265 8822 , +955 326 3695</p>
					</div>
					<div class="add1">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
						<p>Email: <a href="mailto:example@email.com">contact@example.com</a></p>
					</div>
				</div>	
				<div class="col-md-8 contact-right">
				   <form>
					<input type="text" placeholder="Name">
			        <input type="text" class="email" placeholder="Email">
					<textarea placeholder="Message" required=""></textarea>
			     	 <div class="submit">
			     	 	<input type="submit" value="Send Message">
			     	 </div>    
			     	</form>
				</div>	
				<div class="clearfix"> </div>	
			</div>
		</div>
	</div>-->
	<!--contact-end-->
<!--map start here--
<div class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127640.75918330808!2d103.8466694772479!3d1.3111268075660079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da11238a8b9375%3A0x887869cf52abf5c4!2sSingapore!5e0!3m2!1sen!2sin!4v1436965675589"> </iframe>
</div>-->
<!--map start here-->
<!--footer start here-->
<div class="footer" id="contact">
	<div class="container">
		<div class="footer-main">
			  <div class="col-md-4 ftr-grd">
			  	 <h3>Get in Touch</h3>
			  	 <p>34sector , near Indian Bank</p>
			  	 <p> Sco 14-15</p>
			  	 <p>Phone:9464479551</p>
			  </div>
			  <div class="col-md-4 ftr-grd">
			  	 <h3>Follow Us</h3>
			  	 <ul>
			  	 	<li><a href="#"><span class="fa"> </span></a></li>
			  	 	<li><a href="#"><span class="tw"> </span></a></li>
			  	 	<li><a href="#"><span class="g"> </span></a></li>
			  	 	<li><a href="#"><span class="in"> </span></a></li>
			  	 </ul>
			  </div>
			  <div class="col-md-4 ftr-grd">
			  	<h3>Join Our Newsletter</h3>
				<form>
			  	 	<input type="text" placeholder="Email">
			  	 	<input type="submit" value="Subscribe">
				</form>
			  </div>
			<div class="clearfix"> </div>
			<div class="copy-right">
			  <p>© 2019. All rights reserved | Design by Chitkara Student </p>
		   </div>
		</div>
		<script type="text/javascript">
										$(document).ready(function() {
											/*
											var defaults = {
									  			containerID: 'toTop', // fading element id
												containerHoverID: 'toTopHover', // fading element hover id
												scrollSpeed: 1200,
												easingType: 'linear' 
									 		};
											*/
											
											$().UItoTop({ easingType: 'easeOutQuart' });
											
										});
									</script>
						<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

	</div>
</div>
<!--//footer--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('#no_name').on('click', function(){
          $('.datalist').slideToggle();
    })
    $('.datalist li').on('click', function(){
        var listItem = $(this).html()
        $('#no_name').val(listItem);
        $('.datalist').slideUp();
    })
</script>
</body>
</html>