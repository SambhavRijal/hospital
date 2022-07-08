<?php session_start(); 

if($_SESSION['role']=='receptionist'){
    header("location:counter.php");
}

if($_SESSION['role']=='doctor'){
    header("location:queue.php");
}

if(!isset($_SESSION['name'])){
    header("location:login.php");
}

?>

