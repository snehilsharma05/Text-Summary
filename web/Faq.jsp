<!doctype html>
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







<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  #d2,#d4,#d6,#d8,#d10,#d12,.d15{display:none;}
  hr{border-top: 1px solid black;}
a{text-decoration: none !important; color:black;}
.o{
  float: right;
  margin-top: 37px;
  list-style-type: none;
  font-size: 165%;
  font-weight: bold;
}
.o li{
  display: inline-block;
  margin-left:20px;
}
.o li a{
  color:black;

}

  </style>
  <script>
    $(document).ready(function(){
      $("#d1").click(function(){
        $("#d2").slideToggle();
      });
      $("#d3").click(function(){
        $("#d4").slideToggle();
      });
      $("#d5").click(function(){
        $("#d6").slideToggle();
      });
      $("#d7").click(function(){
        $("#d8").slideToggle();
      });
      $("#d9").click(function(){
        $("#d10").slideToggle();
      });
      $("#d11").click(function(){
        $("#d12").slideToggle();
      });
      $("#d1,#d3,#d5,#d7,#d9,#d11,.o1").mouseover(function(){
        $(this).css({"color":"#e67e22"});
      });
      $("#d1,#d3,#d5,#d7,#d9,#d11,.o1").mouseout(function(){
        $(this).css({"color":"black"});
        $("#o2").css({"color":"#e67e22"});
      });

        /*$(window).scroll(function(){
    var aTop = $('.ad').height()+$(".d20").height();
    if($(this).scrollTop()>=aTop){
        $("#d15").show();
       
    }
  });*/
    });
  </script>
</head>
<body>

<div class="container-fluid">
<div class="row" id="d20">
<div class="col-sm-1"></div>
<div class="col-sm-4" style="text-align:right;margin-top:25px;color:#e67e22;"><h2><b>How Can we Help You ?</b></h2></div>
  <div class="col-sm-6">
    
  </div>
  <div class="col-sm-1"></div>
</div><br>
  <div class="row ad" style="height:175px;background-color:#37718E;color:white;"><div class="col-sm-1"></div><div class="col-sm-10"><br><h1>Help & Support</h1><h3>Let's take a step ahead and help you better</h3></div><div class="col-sm-1"></div>
  </div>

  <div class="row">
    <div class="col-sm-1 k" style="background-color:#37718E;height:60vw;"> </div>
    <div class="col-sm-10" class="q">
      <h1 style="margin-left:40px;">FAQ's</h1><br>
        <div class="row">
        <div class="col-sm-1"></div>
          <div class="col-sm-10">

              <div style="margin" id="d1"><h2> Can I Upload more than one document ?<span class="glyphicon glyphicon-chevron-down" style="float:right;"></span></h2></div>
              <div id="d2"><h3>Yes, you can upload more than one document.<br> But you can only upload one at a time, once it get's into database, you can upload another document using same procedure.<br>Thank You</h3></div><hr><br>

              <div style="margin" id="d3"><h2> Can I delete/modify my document?<span class="glyphicon glyphicon-chevron-down" style="float:right;"></span></h2></div>
              <div id="d4"><h3>You can only modify document before uploading it in our database.<br>Once you have uploaded the document you can not modify the contents of the uploaded document or delete that particular document from database.</h3></div><hr><br>
              <div style="margin" id="d5"><h2>Can I recover/change my password?<span class="glyphicon glyphicon-chevron-down" style="float:right;"></span></h2></div>
              <div id="d6"><h3>You can recover your password in case you have forgotten your password by clicking on Forgot Password on the login page.<br>Clicking on Forgot password you need to enter your email to retrieve password on your registered email.<br>You can change password once you have logged-in to your account using Change Password from Sidebar .</h3></div><hr><br>
              <div style="margin" id="d7"><h2>What is the size of the document for which summary can be created?<span class="glyphicon glyphicon-chevron-down" style="float:right;"></span></h2></div>
              <div id="d8"><h3>You can create summary of the document with approximately 5000 words.</h3></div><hr><br>
               <div style="margin" id="d9"><h2>Which type of documents can be uploaded? <span class="glyphicon glyphicon-chevron-down" style="float:right;"></span></h2></div>
              <div id="d10"><h3>You can upload documents with extensions .pdf/.docs/.docx/.doc/.txt .</h3></div><hr><br>          
              <div style="margin" id="d11"><h2>Can I download the created summary ?<span class="glyphicon glyphicon-chevron-down" style="float:right;"></span></h2></div>
              <div id="d12"><h3>yes, you can view the summary and also download it . There is full support of downloading it.</h3></div><hr><br>
          </div>
          <div class="col-sm-1"></div>
        </div>
    </div>
    <div class="col-sm-1 k" style="background-color:#37718E;height:60vw;"> </div>
  </div>
  <div class="row" style="height:90px;background-color:#37718E;"></div>

</div>

</body>
  </html>