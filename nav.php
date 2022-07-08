<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<style>
body {
  margin: 0;
}

ul {
  list-style-type: none;
  margin-left: -30px;
  padding: 0;
  width: 16%;
  background-color: #333;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: white;
  padding: 14px 20px;
  text-decoration: none;
}

li a.active {
  background-color: #8E44AD;
  color: white;
  font-size:18px;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}

.grid{
    display: grid;
    height:90vh;
    overflow:hidden;
    margin-left:40px;
    margin-right:40px;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 48% 48% 48%;
}

.grid div{
  border:2px solid #8E44AD;
  border-radius:20px;
  margin:10px;
  padding:10px
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li style="margin-top:10%"><a href="#about">About</a></li>
  <?php
	// modify the margin-top property fit needs plus research something else
	// set if role=this then provide the necessary link for those task modifying the navbar
	// to set active, echo variable instead of active and one variable will have a value depending on the page
  ?>


  <?php
	if(isset($_SESSION['name'])){

    if($_SESSION['role']=='receptionist'){
      echo "<li><a href='addpatient.php'>New Patient</a></li>";
      echo "<li><a href='addpatient'>Billing</a></li>";
      echo "<li><a href='queue.php'>Queue</a></li>";
      echo "<li><a href='patients.php'>Patient</a></li>";
      echo "<li><a href='signup.php'>Staff</a></li>";
      echo "<li><a href='profile.php'>Contact</a></li>";
    }

		echo "<li><a href='profile.php'>",$_SESSION['name'],"</a></li>";
		echo "<li><a href='profile.php'>",$_SESSION['role'],"</a></li>";
    echo "<li><a href='profile.php'>",$_SESSION['department'],"</a></li>";
		echo "<li><a href='logout.php'> logout</a></li>";

	}

	else{
		echo '<li><a href="login.php">Login </a></li>';
		echo '<li><a href="signup.php"> signup</a></li>';
	}
?>

</ul>


</html>

