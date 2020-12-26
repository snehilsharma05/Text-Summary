<?php 
if((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') or empty($_POST))
{
  exit("Unauthorized Access");
}
require "../../includes/connection.php";
require "../../includes/functions.php";

// Add New Record To database
if(!empty($_POST) && $_POST['Action']=='add_new_books_form')
{
	// Define return | here result is used to return user data and error for error message 
    $Return = array('result'=>array(), 'error'=>'');
    $isbn = $_POST['isbn'];
    $book_id = $_POST['book_id'];
    $title = safe_input($conn,$_POST['title']);
    $author = safe_input($conn,$_POST['author']);
    $publisher = safe_input($conn,$_POST['publisher']);
    $publication_year = $_POST['publication_year'];
    $genre = safe_input($conn,$_POST['genre']);
    $no_of_copies = $_POST['no_of_copies'];
    $remarks = safe_input($conn,$_POST['remarks']);

	$status="Active";
	$date=date("d-m-Y");
	$month=date("m");
	$year=date("Y");
	
	// Insert data into Main Record Table
	$query1=mysqli_query($conn,"insert into  library_record(isbn,book_id,title,author_name,publisher,publication_year,genre,no_of_copies,added_on,year,month,status,remarks)
	values($isbn,'$book_id','".ucfirst($title)."','".ucfirst($author)."','".ucfirst($publisher)."',$publication_year,'".ucfirst($genre)."',$no_of_copies,'$date',$year,$month,'$status','$remarks')");
	
	if($query1)
	{
		$Return['result']=array("status"=>1,"msg"=>"Books Added Successfully.");
	}
	else
	{
		$Return['error']="Something went wrong. Please Try Again.";
	}
	output($Return);
}
// Issue Books to students
if(!empty($_POST) && $_POST['Action']=='issue_books_form')
{
	// Define return | here result is used to return user data and error for error message 
    $Return = array('result'=>array(), 'error'=>'');
    $adm_no = $_POST['adm_no'];
    $book_id = $_POST['book_id'];
    $title = safe_input($conn,$_POST['title']);
    $author = safe_input($conn,$_POST['author']);
    $publisher = safe_input($conn,$_POST['publisher']);
    $publication_year = $_POST['publication_year'];
    $genre = safe_input($conn,$_POST['genre']);
    $issued_on = $_POST['issued_on'];
	$time_period=strtotime("+2 Weeks"); // returning Book time Period
	$returning_date= date("d/m/Y h:i:sa", $time_period);
	$month=date("m");
	$year=date("Y");
	$status="borrowed";
	$due_days=0;
	
	//Get adm id of students
	$query=mysqli_query($conn,"select adm_id from students where adm_no=$adm_no ");
	$result=mysqli_fetch_assoc($query);
	$adm_id=$result['adm_id'];
	
	// Insert data into Main Record Table
	$query1=mysqli_query($conn,"insert into issued_books(adm_id,adm_no,book_id,title,author_name,publisher,publication_year,genre,issued_on,time_period,returning_date,month,year,status,due_days)
	values($adm_id,$adm_no,'$book_id','".ucfirst($title)."','".ucfirst($author)."','".ucfirst($publisher)."',$publication_year,'".ucfirst($genre)."','$issued_on','$time_period','$returning_date',$month,$year,'$status',$due_days)");
	
	if($query1)
	{
		
		$Return['result']=array("status"=>1,"msg"=>"Book issued  Successfully.");
	}
	else
	{
		$Return['error']="Something went wrong. Please Try Again.";
	}
	output($Return);
}


// Get Books Records of current month
elseif(!empty($_POST) && $_POST['Action']=='recentMonthAdditions')
{
	$Return = array('result'=>array(), 'error'=>'');
	$query=mysqli_query($conn,"select * from library_record where month='".date("m")."' ");
	$rows=mysqli_num_rows($query);
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		$record[]=$result;
	}
	if($rows<=1)
	{
		$msg="$rows Record found";
	}
	else
	{
		$msg="$rows Records were found";
	}
	$Return['result']=array("status"=>1,"msg"=>$msg,"rows"=>$rows,$record);
	$myfile = fopen("datafiles/recentMonthAdditions.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
	output($Return);
}

// Get Books Records of current year
elseif(!empty($_POST) && $_POST['Action']=='recentYearAdditions')
{
	$Return = array('result'=>array(), 'error'=>'');
	$query=mysqli_query($conn,"select * from library_record where year='".date("Y")."' ");
	$rows=mysqli_num_rows($query);
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		$record[]=$result;
	}
	if($rows<=1)
	{
		$msg="$rows Record found";
	}
	else
	{
		$msg="$rows Records were found";
	}
	$Return['result']=array("status"=>1,"msg"=>$msg,"rows"=>$rows,$record);
	
	$myfile = fopen("datafiles/recentYearAdditions.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
	output($Return);
}
// Get All Books Records of current year
elseif(!empty($_POST) && $_POST['Action']=='allAvailableBooks')
{
	$Return = array('result'=>array(), 'error'=>'');
	$query=mysqli_query($conn,"select * from library_record ");
	$rows=mysqli_num_rows($query);
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		$record[]=$result;
	}
	if($rows<=1)
	{
		$msg="$rows Record found";
	}
	else
	{
		$msg="$rows Records were found";
	}
	$Return['result']=array("status"=>1,"msg"=>$msg,"rows"=>$rows,$record);
	
	$myfile = fopen("datafiles/allAvailableBooks.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
	output($Return);
}

// Get All Books Records of current year
elseif(!empty($_POST) && $_POST['Action']=='allIssuedBooks')
{
	$Return = array('result'=>array(), 'error'=>'');
	$query=mysqli_query($conn,"select * from issued_books where status='borrowed'  order by issue_id desc ");
	$rows=mysqli_num_rows($query);
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		extract($result);
		
		$adm_id=$adm_id;
		$adm_no=$adm_no;
		$today=date("d-m-Y");
		$returning_date=str_replace("/","-",$returning_date);
		$date1=date_create($returning_date); //last date
		$date2=date_create($today); //current date
		$diff=date_diff($date1,$date2);
		$days_left= $diff->format("%R%a ");
		if($days_left<0)
		{
			$days=str_replace("-","",$days_left);
			if($days==1) $due_days= $days." Day Left";
			else $due_days= $days." Day's Left";
		}
		else
		{
			$days=str_replace("+","",$days_left);
			if($days==1) $due_days= "Plus ".$days." Day";
			else $due_days= "Plus". $days." Day's";
		}
		
		$query1=mysqli_query($conn,"select name,current_class,gender from current_session where adm_id=$adm_id and adm_no=$adm_no ");
		$results=mysqli_fetch_assoc($query1);
		$result['name']=$results['name'];
		$result['current_class']=$results['current_class'];
		$result['gender']=$results['gender'];
		$result['due_days']=$due_days;
		$result['action']="<button data-toggle='modal' data-target='#sendsms' class='btn btn-primary smsbtn' id=$adm_no > Send Message </button>
							<input type='hidden' name='book_id' value=$book_id />
						   <button class='btn btn-primary returnbtn' id=$adm_no > UnIssue Book </button>";
		
		$record[]=$result;
	}
	if($rows<=1)
	{
		$msg="$rows Record found";
	}
	else
	{
		$msg="$rows Records were found";
	}
	$Return['result']=array("status"=>1,"msg"=>$msg,"rows"=>$rows,$record);
	
	$myfile = fopen("datafiles/allIssuedBooks.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
	output($Return);
}

// Delete Gallery Images
elseif(!empty($_POST) && $_POST['Action']=='delete_gallery_images')
{
	$Return = array('result'=>array(), 'error'=>'');
	$imageId=$_POST['imageId'];
	$query=mysqli_query($conn,"delete from school_album where image_id=$imageId ");
	if($query)
	{
		$Return['result']=array("status"=>1,"msg"=>"Image Deleted Successfully");
	}
	else
	{
		$Return['error']="Something Went Wrong. Image not Deleted";
	}
	output($Return);
}


// Send Sms To single Student 
elseif(!empty($_POST) && $_POST['Action']=='sendsms_single_form')
{
	$adm_no=safe_input($conn,$_POST['adm_no']);
	$message=safe_input($conn,$_POST['sms']);
	$Return = array('result'=>array(), 'error'=>'');
	$query=mysqli_query($conn,"select name,father_phn_no,mother_phn_no from students where adm_no=$adm_no " );
	$result=mysqli_fetch_assoc($query);
	$father_phn_no=$result['father_phn_no'];
	$mother_phn_no=$result['mother_phn_no'];
	$name=$result['name'];
	
	$father_phn_no_length =strlen($father_phn_no);
	$mother_phn_no_length =strlen($mother_phn_no);
	if($father_phn_no_length>=10)
	{
		$phone_no=$father_phn_no;
	}
	elseif($mother_phn_no_length >=10)
	{
		$phone_no=$mother_phn_no;
	}
	else
	{
		$Return['error']="Sorry! Parents Phone No. is either invalid or not available.";
		output($Return);
	}
	$mobileNumber=$phone_no;
	$message=$message;
	$senderId="BSHSMS";
	$routeId="1";
	$serverUrl="167.114.117.218";
	$authKey="f6648254123c4af7c56b81ddd256848";
	
	$postData = array(
	'mobileNumbers' => $mobileNumber,        
	'smsContent' => $message,
	'senderId' => $senderId,
	'routeId' => $routeId,		
	"smsContentType" =>'english'
	);

	$data_json = json_encode($postData);
	$url="http://".$serverUrl."/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey;
	// init the resource
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_HTTPHEADER => array('Content-Type: application/json','Content-Length: ' . strlen($data_json)),
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $data_json,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0
	));
	$buffer = curl_exec($ch);
	if(empty ($buffer))
	{
		$Return['error']="Buffer is Empty. Message delivery failed ";
	}
	else
	{
		$Return['result']=array("status"=>0,"msg"=>"Message Sent successfully.") ;
	} 
	curl_close($ch);
	$sent_on= date("d-m-Y h:i:s a");
	$txt="## Message ## Message Sent To : $name , adm.no: $adm_no , Phone no. :  $mobileNumber , Message : $message , sent-on : $sent_on ## Message Ends ##" ;
	$myfile = fopen("datafiles/smsLog_bookFine.txt", "a+");
	fwrite($myfile, $txt);
	fclose($myfile);
	output($Return);
}

// Get All Books Records 
elseif(!empty($_POST) && $_POST['Action']=='scrapBooks')
{
	$Return = array('result'=>array(), 'error'=>'');
	$query=mysqli_query($conn,"select * from library_record ");
	$rows=mysqli_num_rows($query);
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		$result['action']="<button data-toggle='modal' data-target='#scrapBook' class='btn btn-primary smsbtn' id=$book_id > Delete Book </button>";
		$record[]=$result;
	}
	if($rows<=1)
	{
		$msg="$rows Record found";
	}
	else
	{
		$msg="$rows Records were found";
	}
	$Return['result']=array("status"=>1,"msg"=>$msg,"rows"=>$rows,$record);
	
	$myfile = fopen("datafiles/scrapBooks.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
	output($Return);
}
// Delete Book From Records 
elseif(!empty($_POST) && $_POST['Action']=='delete_book_form')
{
	$Return = array('result'=>array(), 'error'=>'');
	$book_id=$_POST['book_id'];
	$delete_copies=$_POST['copies'];
	
	$query=mysqli_query($conn,"select no_of_copies from library_record where book_id=$book_id ");
	$result=mysqli_fetch_assoc($query);
	$old_copies=$result['no_of_copies'];
	if($delete_copies<=$old_copies)
	{
		$new_copies=$old_copies-$delete_copies;
	}
	else
	{
		$Return['error']="Sorry! No. of copies are not valid";
		output($Return);
	}
	
	if($new_copies==0)
	{
		$sql=mysqli_query($conn,"delete from library_record where book_id=$book_id");
		if($sql)
		{
			$Return['result']=array("status"=>0,"msg"=>"Book Record Deleted") ;
		}
		else
		{
			$Return['error']="Something Went Wrong";
		}
	}
	else
	{
		$sql=mysqli_query($conn,"update library_record set no_of_copies=$new_copies where book_id=$book_id");
		if($sql)
		{
			$Return['result']=array("status"=>0,"msg"=>"Book Record updated ") ;
		}
		else
		{
			$Return['error']="Something Went Wrong";
		}
	}
	
	output($Return);
}

// Return Book Form
elseif(!empty($_POST) && $_POST['Action']=='Return_book')
{
	$Return = array('result'=>array(), 'error'=>'');
	$adm_no=$_POST['adm_no'];
	$book_id=$_POST['book_id'];
	$query=mysqli_query($conn,"update issued_books set status='Returned' where adm_no=$adm_no and book_id=$book_id ");
	if($query)
	{
		$Return['result']=array("status"=>1,"msg"=>"Book Unissued Successfully");
	}
	else
	{
		$Return['error']="Something Went Wrong";
	}
	output($Return);
}

?>