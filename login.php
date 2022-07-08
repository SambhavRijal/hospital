<?php session_start(); ?>
<?php include "nav.php"; ?>


<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){

		// Validation
		if(empty($_POST['uname']) || empty($_POST['upass'])){
			echo "Please fill all fields cannot be empty";
		}
		else{
			echo "Form submitted";
		}


		// Database insertion

		// Creating connection
		$server="localhost";
		$user="root";
		$password="Fireballgoal0";
		$db="hospital";
		$conn=mysqli_connect($server,$user,$password,$db);
		// mysqli_sqlect_db("db_name");  -> To use a database
		if(!$conn){
			die("Connection failed: ".mysqli_connect_error());
		}

		// Retrieving form Data
		$uname=$_POST['uname'];
		$password=$_POST['upass'];
		echo "Name set  before";
		// retrieving user id from database
		$sql="select*from user where uname='$uname' and password='$password';";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)==1){
				$_SESSION['name']=$uname;
				while($row=mysqli_fetch_assoc($res)){
					$_SESSION['role']=$row['role'];
					$_SESSION['department']=$row['department_id'];
				}
				if($_SESSION['role']=='admin'){
					header("location:/hospital/admin/");
				}
				else{
					header("location:index.php");
				}
		}
	}

	
?>


<!-- HTML of page -->
<div style="margin-left:15%;padding:1px 16px;height:auto;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" style="width:40%; margin-left:25%; margin-top:10%;">
	
				<label>Username</label><br>
				<input type="text" name="uname" class="form-control"><br>
	
				<label>Password</label>
				<input type="password" name="upass" class="form-control"><br>
		
				<button type="submit" class="btn btn-primary mb-2">Log in</button><br>

		<p> Dont have an account? <a href="signup.php">Create one</a> </p>
	</form>
</div>
