<?php 
ob_start();
session_start(); // Start Session

// Connecting to server 
// $conn=mysqli_connect("localhost","root","");
// mysqli_select_db($conn,"student_management") or die("Error in establishing connection with server.");

$conn=mysqli_connect("mysql1003.mochahost.com","crownkar_school","school@pjc");
mysqli_select_db($conn,"crownkar_school") or die("Error in establishing connection with server.");


// Declaring Global items and variables
date_default_timezone_set("Asia/Calcutta");
// define("root","http://localhost/StudentManagement/",true);
define("root","http://school.pjcinfotech.com/",true);

$query=mysqli_query($conn,"select * from issued_books where status='borrowed' ") or die(mysqli_error($conn)."Error");
$rows=mysqli_num_rows($query);
if($rows>0)
{
	while($result=mysqli_fetch_assoc($query))
	{
		extract($result);
		$today=date("d-m-Y");
		$returning_date=str_replace("/","-",$returning_date);
		$date1=date_create($returning_date); //last date
		$date2=date_create($today); //current date
		$diff=date_diff($date1,$date2);
		$days_left= $diff->format("%R%a ");
		$query1=mysqli_query($conn,"update issued_books set due_days=$days_left where issue_id=$issue_id");
	}
}

?>