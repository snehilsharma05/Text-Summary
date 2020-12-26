<?php
require "../../includes/connection.php";
require "../../includes/functions.php";

if (isset($_REQUEST['query'])) 
{
    $query = $_REQUEST['query'];
    $sql = mysqli_query ($conn,"SELECT title FROM library_record WHERE title LIKE '%{$query}%' ");
	$array = array();
    while ($row = mysqli_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['title'],
            'value' => $row['title'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>