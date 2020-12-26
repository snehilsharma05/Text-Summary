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
	//check username in db
	$query = mysqli_query($conn,"SELECT name FROM students WHERE adm_no=$adm_no and status='Active' ");
	//return total count
	$adm_exist = mysqli_num_rows($query); //total records
	//if value is more than 0, username is not available
	if($adm_exist==1) 
	{
		$result=mysqli_fetch_assoc($query);
		if(isset($_POST['books_issued']))
		{
			$query2=mysqli_query($conn,"select title from issued_books WHERE adm_no=$adm_no ");
			$num_rows=mysqli_num_rows($query2);
			if($num_rows>0 && $num_rows<=3) //Books Issued Earlier
			{
				$record=array();
				while($rows=mysqli_fetch_assoc($query2))
				{
					$record[]=$rows['title'];
				}
				$title=implode(", ",$record);
				echo '<p>'.$result['name'].' ( Issued Books: '.$title.' )</p><script>$("[type=submit]").show();</script>';
			}
			elseif($num_rows>3) // If max limit reached
			{
				$record=array();
				while($rows=mysqli_fetch_assoc($query2))
				{
					$record[]=$rows['title'];
				}
				$title=implode(", ",$record);
				echo '<p>'.$result['name'].' ( Issued Books: '.$title.' ). Sorry! Max limit reached,no more books can be issued. </p><script>$("[type=submit]").hide();</script>';
			}
			elseif($num_rows==0) // No books Issued
			{
				echo '<p>'.$result['name'].' ( Issued Books: None )</p><script>$("[type=submit]").show();</script>';
			}
		}
		else
		{
			echo '<p>'.$result['name'].'</p><script>$("[type=submit]").show();</script>';
		}
	}
	else
	{
		die('<p>No student registered with the Admission Number you entered.</p><script>$("[type=submit]").hide();</script>');
	}
	
	//close db connection
	mysqli_close($conn);
}
?>

