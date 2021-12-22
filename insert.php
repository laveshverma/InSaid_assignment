<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("insaiddatabase.cnqhi9ontprj.us-east-1.rds.amazonaws.com", "adminlv", "password", "insaiddb");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Prepare an insert statement
$sql = "INSERT INTO student (student_id, first_name, last_name, current_job, location) VALUES (?, ?, ?, ?, ?)";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sssss", $student_id, $first_name, $last_name, $current_job, $location);

    // Set parameters
    $student_id = $_REQUEST['student_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $current_job = $_REQUEST['current_job'];
    $location =  $_REQUEST['location'];

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
	
	header("Location: select2.php?last_id=".$first_name);
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}


// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($link);

?>
