<?php 
require "../../includes/connection.php";
require "../../includes/functions.php";
if(!isset($_SESSION) || !isset($_SESSION['valid']))
{
	header('Refresh:2;url='.root.'login.php');
	echo "Unauthorized access! Redirecting to Login page please wait...";
	die;
}

$files= count($_FILES['image_upload_file']['name']);
/*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_MEDIUM_DIR', '../images/album/');
define('IMAGE_MEDIUM_SIZE', 500);
/*defined settings - end*/

for($i=0;$i<$files;$i++)
{
	$imageName="Image_".date("dmYhis").mt_rand(100,1000);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/jpeg",   "image/png",   "image/x-png"  );
	$Return = array('result'=>array(), 'error'=>'');
	if ($_FILES['image_upload_file']["error"][$i] > 0) {
		$Return['error']= "Error in File";
		output($Return);
	}
	elseif (!in_array($_FILES['image_upload_file']["type"][$i], $allowedImageType)) {
		$Return['error']= "You can only upload JPG, PNG and GIF file";
		output($Return);
	}
	elseif (round($_FILES['image_upload_file']["size"][$i] / 1024) > 4096) {
		$Return['error']= "You can upload file size up to 4 MB";
		output($Return);
	} 
	else 
	{
		/*create directory with 777 permission if not exist - start*/
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['image_upload_file']['tmp_name'][$i];
		$file = pathinfo($_FILES['image_upload_file']['name'][$i]);
		$fileType = $file["extension"];
		$desiredExt='png';
		$fileNameNew = $imageName . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = "images/album/". $fileNameNew;
		if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) 
		{
			$output['status']=TRUE;
			$output['image_medium']= $path[1];
		}
		$date=date("d-m-Y h:i:s");
		$query=mysqli_query($conn,"insert into school_album (imagepath,added_on) values('".$path[2]."','$date') ") or die(mysqli_error($conn)."Error");
	}
	
}
if($Return['error']!="")
{
	output($Return);
}
else
{
	$Return['result']=array("status"=>1,"msg"=>"Image Uploaded Succsessfully.");
	output($Return);
}



?>