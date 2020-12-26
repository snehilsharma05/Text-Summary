<?php
require "../includes/connection.php";
if(!isset($_SESSION) || !isset($_SESSION['valid']))
{
	header('Refresh:2;url=../login.php');
	echo "Unauthorized access! Redirecting to Login page please wait...";
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gallery</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/styles.css" rel="stylesheet" />
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>	
<link href="../css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="../js/fileinput.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />
<script src="../js/bootbox.min.js"></script>
<script>
jQuery(document).ready(function($)
{  
	$(window).load(function(){
		$('#preloader').fadeOut('slow',function(){$(this).remove();});
		//$('#preloader').fadeOut('slow');
	});
});
</script>
<link href="../dist/css/lightgallery.css" rel="stylesheet">
<style type="text/css">
	.demo-gallery{ margin-top:10px;}
	.demo-gallery > ul {
	  margin-bottom: 0;
	}
	.demo-gallery > ul > li {
		float: left;
		margin-bottom: 15px;
		margin-right: 20px;
		width: 200px;
	}
	.demo-gallery > ul > li a {
	  border: 3px solid #FFF;
	  border-radius: 3px;
	  display: block;
	  overflow: hidden;
	  position: relative;
	  float: left;
	}
	.demo-gallery > ul > li a > img {
	  -webkit-transition: -webkit-transform 0.15s ease 0s;
	  -moz-transition: -moz-transform 0.15s ease 0s;
	  -o-transition: -o-transform 0.15s ease 0s;
	  transition: transform 0.15s ease 0s;
	  -webkit-transform: scale3d(1, 1, 1);
	  transform: scale3d(1, 1, 1);
	  height: 100%;
	  width: 100%;
	}
	.demo-gallery > ul > li a:hover > img {
	  -webkit-transform: scale3d(1.1, 1.1, 1.1);
	  transform: scale3d(1.1, 1.1, 1.1);
	}
	.demo-gallery > ul > li a:hover .demo-gallery-poster > img {
	  opacity: 1;
	}
	.demo-gallery > ul > li a .demo-gallery-poster {
	  background-color: rgba(0, 0, 0, 0.1);
	  bottom: 0;
	  left: 0;
	  position: absolute;
	  right: 0;
	  top: 0;
	  -webkit-transition: background-color 0.15s ease 0s;
	  -o-transition: background-color 0.15s ease 0s;
	  transition: background-color 0.15s ease 0s;
	}
	.demo-gallery > ul > li a .demo-gallery-poster > img {
	  left: 50%;
	  margin-left: -10px;
	  margin-top: -10px;
	  opacity: 0;
	  position: absolute;
	  top: 50%;
	  -webkit-transition: opacity 0.3s ease 0s;
	  -o-transition: opacity 0.3s ease 0s;
	  transition: opacity 0.3s ease 0s;
	}
	.demo-gallery > ul > li a:hover .demo-gallery-poster {
	  background-color: rgba(0, 0, 0, 0.5);
	}
	.demo-gallery .justified-gallery > a > img {
	  -webkit-transition: -webkit-transform 0.15s ease 0s;
	  -moz-transition: -moz-transform 0.15s ease 0s;
	  -o-transition: -o-transform 0.15s ease 0s;
	  transition: transform 0.15s ease 0s;
	  -webkit-transform: scale3d(1, 1, 1);
	  transform: scale3d(1, 1, 1);
	  height: 100%;
	  width: 100%;
	}
	.demo-gallery .justified-gallery > a:hover > img {
	  -webkit-transform: scale3d(1.1, 1.1, 1.1);
	  transform: scale3d(1.1, 1.1, 1.1);
	}
	.demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
	  opacity: 1;
	}
	.demo-gallery .justified-gallery > a .demo-gallery-poster {
	  background-color: rgba(0, 0, 0, 0.1);
	  bottom: 0;
	  left: 0;
	  position: absolute;
	  right: 0;
	  top: 0;
	  -webkit-transition: background-color 0.15s ease 0s;
	  -o-transition: background-color 0.15s ease 0s;
	  transition: background-color 0.15s ease 0s;
	}
	.demo-gallery .justified-gallery > a .demo-gallery-poster > img {
	  left: 50%;
	  margin-left: -10px;
	  margin-top: -10px;
	  opacity: 0;
	  position: absolute;
	  top: 50%;
	  -webkit-transition: opacity 0.3s ease 0s;
	  -o-transition: opacity 0.3s ease 0s;
	  transition: opacity 0.3s ease 0s;
	}
	.demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
	  background-color: rgba(0, 0, 0, 0.5);
	}
	.demo-gallery .video .demo-gallery-poster img {
	  height: 48px;
	  margin-left: -24px;
	  margin-top: -24px;
	  opacity: 0.8;
	  width: 48px;
	}
	.demo-gallery.dark > ul > li a {
	  border: 3px solid #04070a;
	}
	.home .demo-gallery {
	  padding-bottom: 80px;
	}
	 .btn-lg, .btn-group-lg>.btn{
		font-size:10px;
		height:auto;
		
	}
</style>
</head>
<body>
	<?php
		include "../menu.php";
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Image Gallery</li>
			</ol>
		</div>
		<div class="row">
			<div class="login-panel panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form action="requestPages/gallery_upload.php" method="post" name="upload_images_form" id="upload_images_form" enctype="multipart/form-data">
								<div class="form-group">
									<label>Upload Images To Gallery</label>
									<input id="file-3" name="image_upload_file[]" accept="image/*" type="file" multiple="true" class="form-control btn-small-md " style="height:45px">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="panel-heading"> Gallery </div>
					<div class="demo-gallery">
						<?php 
						$limit = 8;  
						$disabled=$disabled1="";
						if (isset($_GET["page"])) 
						{ 
							$page  = $_GET["page"]; 
							if($page==1)
							{
								$disabled="disabled";
								$prev_link="#";
								$next_link="manageGallery.php?page=".($page+1);
							}
							else
							{
								$disabled="";
								$prev_link="manageGallery.php?page=".($page-1);
								$next_link="manageGallery.php?page=".($page+1);
							} 
						}
						else 
						{ 
							$page=1; 
							$disabled="disabled";
							$prev_link="#";
						}  
						$start_from = ($page-1) * $limit;  
						$query=mysqli_query($conn,"select * from school_album ORDER BY image_id desc LIMIT $start_from, $limit");
						$rows=mysqli_num_rows($query);
						if($rows==0)
						{
						 echo "<center> Photos Not Available </center>";		
						 $disabled1="disabled";
						 $next_link="#";
						}
						else
						{
							echo '<ul id="lightgallery" class="list-unstyled row">';
							while($result=mysqli_fetch_assoc($query))
							{		
								extract($result);
							?>
						
							<li class="col-xs-6 col-sm-4 col-md-3 text-center textgallery" data-responsive="<?php echo $imagepath;?>" data-src="<?php echo $imagepath;?>" data-sub-html="Album Pictures">
								<a href="">
									<img class="img-responsive" src="<?php echo $imagepath;?>">
								</a>
								<input type="hidden" name="image_id" id="image_id" value="<?php echo $image_id;?>" >
								<button type="button" class="btn btn-primary  deleteImg"  style="margin-top:10px;" ><i class="glyphicon glyphicon-trash"></i> Delete</button>
							</li>
							<?php 
							}
							echo '</ul>';
						}
						?>
					</div>
					<?php  
					$query=mysqli_query($conn,"select COUNT(image_id) from school_album");
					$total_rows = mysqli_fetch_row($query);  
					$total_records = $total_rows[0];  
					$total_pages = ceil($total_records / $limit);  
					$pagLink = '<nav aria-label="Page navigation example">
								  <ul class="pagination justify-content-center">
									<li class="page-item '.$disabled.'">
									  <a class="page-link " href="'.$prev_link.'"  tabindex="-1">Previous</a>
									</li>';  
					for ($i=1; $i<=$total_pages; $i++) 
					{  
						$pagLink .= "<li class='page-item'><a class='page-link' href='manageGallery.php?page=".$i."'>".$i."</a></li>";  
					};  
					echo $pagLink .=
						'<li class="page-item '.$disabled1.'">
						  <a class="page-link" href="'.$next_link.'">Next</a>
						</li>
					  </ul>
					</nav>';  
					?> 
				</div>
			</div>
		</div>
	</div>	 
</body>
</html>
<script>
$("#file-3").fileinput({
		showUpload: true,
		showCaption: true,
		browseClass: "btn btn-primary btn-lg",
		allowedFileExtensions : ['jpg', 'png','jpeg','JPG','JPEG','PNG'],
		//fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
	});
</script> 

<script type="text/javascript">
$(document).ready(function(){
	$('#lightgallery').lightGallery();
	$('.deleteImg').on("click",function(e)
	{
		if (confirm("Are You Sure you want to Delete This Image?") == true) 
		{
			$(".mask").css("display","block");
			e.stopPropagation(); // Stop Parent Default Function ( Lightbox )
			var imageId=$(this).closest('.textgallery').find('#image_id').val();
			var data =
			{
				"imageId" : imageId,
				"Action" : "delete_gallery_images",
			}
			$.ajax
			({
				url : 'requestPages/Handle_requests.php',
				type: 'post',
				data: data,
				success:function(response)
				{
					//alert(JSON.stringify(response));
					if(response.status=="0")
					{
						bootbox.dialog({
						message: response.error,
						closeButton: false
						});
						setTimeout(function() {
							$(".mask").css("display","none");
								bootbox.hideAll();
							}, 2000);
					}
					else
					{
						bootbox.dialog({
						message: response.result.msg,
						closeButton: false
						});
						setTimeout(function() {
								location.reload(true);
								bootbox.hideAll();
							}, 2000);
					}
				}
			});
		} 
		else 
		{
			$(".mask").css("display","none");
		   return false;
		}		
	});
	
	
	$("#upload_images_form").on("submit",function(e)
	{
		e.preventDefault();
		$(".mask").css("display","block");
		var obj = $(this), action_name = obj.attr('name'); /*Define variables*/
		var form = $('#upload_images_form')[0];
		var data = new FormData(form);
		data.append("Action", action_name);
		$.ajax({
			type: "POST",
            enctype: 'multipart/form-data',
            url:  e.target.action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
			success: function (response) 
			{
				//alert(JSON.stringify(response));
				if(response.status=="0")
				{
					bootbox.dialog({
					message: response.error,
					closeButton: false
					});
					setTimeout(function() {
						$(".mask").css("display","none");
							bootbox.hideAll();
						}, 2000);
				}
				else
				{
					bootbox.dialog({
					message: response.result.msg,
					closeButton: false
					});
					setTimeout(function() {
							location.reload(true);
							bootbox.hideAll();
						}, 2000);
				}
			}
		});
	});
});
</script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="../dist/js/lightgallery.js"></script>
<script src="../dist/js/lg-fullscreen.js"></script>
<script src="../dist/js/lg-thumbnail.js"></script>
<script src="../lib/jquery.mousewheel.min.js"></script>
