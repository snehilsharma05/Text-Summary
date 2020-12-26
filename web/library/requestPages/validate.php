<?php
//check if its ajax request, exit script if its not
if((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') or empty($_POST))
{
  exit("Unauthorized Access");
}
require "../../includes/connection.php";
if(isset($_POST["book_id"]))
{
	$book_id=$_POST["book_id"];
	//check book_id in db
	$query=mysqli_query($conn,"select * from  issued_books where book_id=$book_id");
	$rows=mysqli_num_rows($query);
	if($rows==0)
	{
		$results = mysqli_query($conn,"SELECT book_id FROM library_record WHERE book_id='$book_id' ") or die (mysqli_error($conn)."error");
		$book_id_exist = mysqli_num_rows($results); //total records
		if($book_id_exist>0) {
			die('<script>$("[type=submit]").show();</script>');
			
		}else{
			die('<p>Book Id you entered Does not Exists!</p><script>$("[type=submit]").hide();</script>');
		}
	}
	else
	{
		$no_of_copies_issued=$rows;
		$query = mysqli_query($conn,"SELECT book_id,no_of_copies FROM library_record WHERE book_id='$book_id' ") or die (mysqli_error($conn)."error");
		$book_id_exist = mysqli_num_rows($query); //total records
		$result=mysqli_fetch_array($query);
		$no_of_copies=$result['no_of_copies'];
		if($no_of_copies_issued==$no_of_copies)
		{
			die('<p>Book with this Id are Already Issued to other students!</p><script>$("[type=submit]").hide();</script>');
		}
		else
		{
			if($book_id_exist>0) {
				die('<script>$("[type=submit]").show();</script>');
				
			}else{
				die('<p>Book Id you entered Does not Exists!</p><script>$("[type=submit]").hide();</script>');
			}
		}
	}
	//close db connection
	mysqli_close($conn);
}
?>

