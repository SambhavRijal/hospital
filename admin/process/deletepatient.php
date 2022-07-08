<?php

    $server="localhost";
	$user="root";
	$password="Fireballgoal0";
	$db="hospital";
	$conn=mysqli_connect($server,$user,$password,$db);
	// mysqli_sqlect_db("db_name");  -> To use a database
	if(!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}

    $id=$_GET['id'];
    
    $sql="delete from treatment where pid=$id";
    $res=mysqli_query($conn,$sql);

    $sql="delete from patient where pid=$id";
    $res=mysqli_query($conn,$sql);

    header("location: /hospital/admin/patient.php");



?>