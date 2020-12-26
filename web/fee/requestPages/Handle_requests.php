<?php 
if((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') or empty($_POST))
{
  exit("Unauthorized Access");
}
require "../../includes/connection.php";
require "../../includes/functions.php";

// Add Monthly fee Record
if(!empty($_POST) && $_POST['Action']=='add_monthly_fee_form')
{
	// Define return | here result is used to return user data and error for error message 
    $Return = array('result'=>array(), 'error'=>'');
    $adm_no = $_POST['adm_no'];
    $name = safe_input($conn,$_POST['name']);
    $instalment = safe_input($conn,$_POST['instalment']);
    $current_class= safe_input($conn,$_POST['current_class']);
    $stream = safe_input($conn,$_POST['stream']);
    $tutionfee = safe_input($conn,$_POST['tutionfee']);
    $annualcharge = safe_input($conn,$_POST['annualcharge']);
    $smartfee = safe_input($conn,$_POST['smartfee']);
    $dateofsub = $_POST['dateofsub'];
	$date_explode =explode("/",$dateofsub);
	$month=$date_explode[1];
    $session_year = safe_input($conn,$_POST['session_year']);
    $fine = safe_input($conn,$_POST['fine']);
    
    $total_payment = safe_input($conn,$_POST['total']);
    $payment_mode = safe_input($conn,$_POST['payment_mode']);
		
	if($_POST['fine_reason']=="")
	{
		$fine_reason="Not Available";
	}
	else
	{
		$fine_reason= safe_input($conn,$_POST['fine_reason']);
	}
	$query=mysqli_query($conn,"select adm_id from students where adm_no=$adm_no");
	$result=mysqli_fetch_array($query);
	$adm_id=$result['adm_id'];
	
	switch($instalment)
	{
		case "First Instalment":
		$fee_status="8 Instalment Left";
		break;
		case "Second Instalment":
		$fee_status="7 Instalment Left";
		break;
		case "Third Instalment":
		$fee_status="6 Instalment Left";
		break;
		case "Fourth Instalment":
		$fee_status="5 Instalment Left";
		break;
		case "Fifth Instalment":
		$fee_status="4 Instalment Left";
		break;
		case "Sixth Instalment":
		$fee_status="3 Instalment Left";
		break;
		case "Seventh Instalment":
		$fee_status="2 Instalment Left";
		break;
		case "Eighth Instalment":
		$fee_status="1 Instalment Left";
		break;
		case "Ninth Instalment":
		$fee_status="Fully Paid";
		break;
		default: 
		$fee_status="Unknown";
		break;
	}
	
	$query1=mysqli_query($conn,"insert into  fee_record(adm_id,adm_no,session_year,name,current_class,stream,payment_mode,instalment,tutionfee,annualfee,smartfee,fine,fine_reason,total_payment,date,month,fee_status)
	values($adm_id,$adm_no,$session_year,'".ucfirst($name)."','".ucfirst($current_class)."','".ucfirst($stream)."','$payment_mode','$instalment',$tutionfee,$annualcharge,$smartfee,$fine,'$fine_reason',$total_payment,'$dateofsub','$month','$fee_status')") or die(mysqli_error($conn)."error");
	
	if($query1)
	{
		$Return['result']=array("status"=>1,"msg"=>"Fee Added Successfully.");
	}
	else
	{
		$Return['error']="Something went wrong. Please Try Again.";
	}
	output($Return);
}

// Add Yearly Fee Record
if(!empty($_POST) && $_POST['Action']=='add_yearly_fee_form')
{
	// Define return | here result is used to return user data and error for error message 
    $Return = array('result'=>array(), 'error'=>'');
    $adm_no = $_POST['adm_no'];
    $name = safe_input($conn,$_POST['name']);
    $instalment = safe_input($conn,$_POST['instalment']);
    $current_class= safe_input($conn,$_POST['current_class']);
    $stream = safe_input($conn,$_POST['stream']);
    $tutionfee = safe_input($conn,$_POST['tutionfee']);
    $annualcharge = safe_input($conn,$_POST['annualcharge']);
    $smartfee = safe_input($conn,$_POST['smartfee']);
    $dateofsub = $_POST['dateofsub'];
	$date_explode =explode("/",$dateofsub);
	$month=$date_explode[1];
    $session_year = safe_input($conn,$_POST['session_year']);
    $fine = safe_input($conn,$_POST['fine']);
    $total_payment = safe_input($conn,$_POST['total']);
    $payment_mode = safe_input($conn,$_POST['payment_mode']);
		
	$query=mysqli_query($conn,"select adm_id from students where adm_no=$adm_no");
	$result=mysqli_fetch_array($query);
	$adm_id=$result['adm_id'];
	$fee_status="Fully Paid";
		
	$query1=mysqli_query($conn,"insert into  fee_record(adm_id,adm_no,session_year,name,current_class,stream,payment_mode,instalment,tutionfee,annualfee,smartfee,fine,total_payment,date,month,fee_status)
	values($adm_id,$adm_no,$session_year,'".ucfirst($name)."','".ucfirst($current_class)."','".ucfirst($stream)."','$payment_mode','$instalment',$tutionfee,$annualcharge,$smartfee,$fine,$total_payment,'$dateofsub','$month','$fee_status')") or die(mysqli_error($conn)."error");
	
	if($query1)
	{
		$Return['result']=array("status"=>1,"msg"=>"Fee Added Successfully.");
	}
	else
	{
		$Return['error']="Something went wrong. Please Try Again.";
	}
	output($Return);
}

// Get Class Record as Per  Request
elseif(!empty($_POST) && $_POST['Action']=='fetch_class_record')
{
	$class=$_POST['class'];
	$_SESSION['class_record']['class_selected']=$class;
	$Return = array('result'=>array(), 'error'=>'');

	// Select Students details from two tables using inner join ( primary key and foreign key as adm_id )
	$query=mysqli_query($conn,"select students.adm_id,students.adm_no,students.name,current_session.current_class,current_session.stream from students inner join current_session on students.adm_id=current_session.adm_id where current_session.session_year='".date("Y")."'  and current_session.current_class='$class' ");
	
	$rows=mysqli_num_rows($query);
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		$result['profile']="<a href='viewProfile.php?adm_id=".$result['adm_id']."'><button class='btn btn-primary'>View Fee Status</button></a>";
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
	
	$myfile = fopen("datafiles/classRecord.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
	//output($Return);
}


// Class Wise fee REcord
if(!empty($_POST) && $_POST['Action']=='studentFee_record')
{
	$adm_no=$_POST['adm_no'];
	$year=date("Y");
	// Select Students details from two tables using inner join ( primary key and foreign key as adm_id )
	$query=mysqli_query($conn,"select * from fee_record where session_year='$year' and adm_no=$adm_no ");
	$record=array();
	while($result=mysqli_fetch_assoc($query))
	{
		extract($result);
		$record[]=$result;
	}
	$myfile = fopen("datafiles/studentFeeRecord.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
}
// Monthly Fee Record 
if(!empty($_POST) && $_POST['Action']=='monthlyFee_record')
{
	$year=date("Y");
	$month=date("m");
	// Select Students details from two tables using inner join ( primary key and foreign key as adm_id )
	$query=mysqli_query($conn,"select * from fee_record where session_year='$year' and month='$month' ");
	$record=array();
	$total_payment_received=0;
	while($result=mysqli_fetch_assoc($query))
	{
		extract($result);
		$total_payment_received=$total_payment_received+$total_payment;
		$record[]=$result;
	}
	$record[]=array("total_payment_received"=>$total_payment_received);
	$myfile = fopen("datafiles/monthlyFeeRecord.jsonp", "w");
	$txt = json_encode($record);
	fwrite($myfile, $txt);
	fclose($myfile);
}
?>