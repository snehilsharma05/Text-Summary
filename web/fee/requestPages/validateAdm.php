<?php
//check if its ajax request, exit script if its not
if((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') or empty($_POST))
{
  exit("Unauthorized Access");
}
require "../../includes/connection.php";
if(isset($_POST["adm_no"]))
{
	$adm_no=$_POST["adm_no"];
	$query=mysqli_query($conn,"select * from current_session where adm_no=$adm_no");
	$count=mysqli_num_rows($query);
	if($count!=0)
	{	
		while($result=mysqli_fetch_array($query))
		{
			extract($result);
		}
		$library_fine=20;
		// Library Record Check  for Pending Fine 
		$query=mysqli_query($conn,"select * from issued_books where status='borrowed' and adm_no=$adm_no ") or die(mysqli_error($conn)."Error");
		$rows=mysqli_num_rows($query);
		$lib_fine=0;
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
				
				if($days_left>0)
				{
					$days=str_replace("+","",$days_left);
					$lib_fine=$lib_fine+$library_fine;
				}
			}
		}
		
		$y=date("Y");
		$today=date("m/d/Y");
		$query1=mysqli_query($conn,"select * from fee_record where adm_no=$adm_no and session_year=$y ");
		$sql_rows=mysqli_num_rows($query1);
		if($sql_rows==0)
		{
			$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=> 1,"msg"=>"Full Fee Pending","instalment" => "First Instalment","fine"=>$lib_fine);
		}
		else
		{
			while($result1=mysqli_fetch_array($query1))
			{
				extract($result1);
			}
			
			if($fee_status=="Fully Paid")
			{
				$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=> 1,"msg"=> "Full Fee Paid","instalment" =>"","fine"=>$lib_fine,"fine_reason"=>"Library fine" );
			}
			else
			{
				switch($sql_rows)
				{
					case "0":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=> 1,"msg"=>"Full Fee Pending","instalment" => "First Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"   );
					break;
					
					case "1";
					$json=array("name"=> $name,"current_class"=> $current_class ,"stream" => $stream,"status"=>1,"msg"=>"","instalment" => "Second Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine" );
					break;
					
					case "2";
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=>1,"msg"=> "","instalment" => "Third Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine" );
					break;
					
					case "3":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=>1,"msg"=> "","instalment" => "Fourth Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"   );
					break;
					
					case "4":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=>1,"msg"=> "","instalment" => "Fifth Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"  );
					break;
					
					case "5":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=> 1,"msg"=>"","instalment" => "Sixth Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"   );
					break;
					
					case "6":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=>1,"msg"=> "","instalment" => "Seventh Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"  );
					break;
					
					case "7":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=>1,"msg"=> "","instalment" => "Eighth Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"   );
					break;
					
					case "8":
					$json=array("name"=> $name,"current_class"=> $current_class,"stream" => $stream,"status"=>1,"msg"=> "","instalment" => "Ninth Instalment","fine"=>$lib_fine,"fine_reason"=>"Library fine"   );
					break;
					
					default:
					$json=array("name"=> $name,"current_class"=> $class,"stream" => $stream,"status"=> 1,"msg"=> "Full Fee Paid","instalment" => "" ,"fine"=>$lib_fine,"fine_reason"=>"Library fine"  );

				}
			}		
		}
	}
	else
	{
		$json=array("name"=> "","current_class"=> "","stream" => "","status"=>0,"msg"=> "No student registered with the Admission Number you entered.","instalment"=>"","fine"=>$lib_fine ,"fine_reason"=>"Library fine" );
	}
	header('Content-type: application/json');
	echo json_encode($json);
	
}
?>

