<?php
require "../includes/connection.php";
require "../includes/functions.php";
$output['status']=FALSE;
set_time_limit(0);
if(!isset($_SESSION) || !isset($_SESSION['valid']))
{
	$output['error']="Unauthorized Access!";
	echo json_encode($output);
	die;
}

foreach($_FILES as $key=>$value)
{
	$GLOBALS['id']=$key;
}

/*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_MEDIUM_DIR', '../images/pics/');
define('IMAGE_MEDIUM_SIZE', 250);
/*defined settings - end*/

if($key!="")
{
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	if ($_FILES[$key]["error"] > 0) {
		$output['error']= "Error in File";
	}
	elseif (!in_array($_FILES[$key]["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	elseif (round($_FILES[$key]["size"] / 1024) > 4096) {
		$output['error']= "You can upload file size up to 4 MB";
	} else {
		/*create directory with 777 permission if not exist - start*/
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES[$key]['tmp_name'];
		$file = pathinfo($_FILES[$key]['name']);
		$fileType = $file["extension"];
		$desiredExt='png';
		$fileNameNew = $key . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = "images/pics/" . $fileNameNew;
		
		if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) 
		{
			$output['status']=TRUE;
			$output['image_medium']= $path[1];
		}
		$query=mysqli_query($conn,"update students set student_photo='".$path[2]."' where adm_no=$key ");
	}
	echo json_encode($output);
}
?>	