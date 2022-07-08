<?php include "nav.php"; ?>


<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){


		// Validation

		if(empty($_POST['fname']) || empty($_POST['uname']) || empty($_POST['uname'])){
			echo "Name cannot be empty";
		}
		else if(!preg_match("/^[a-zA-Z]*$/",$_POST['uname']))
		{
			echo "Name should contain characters only";
		}
		else if(strlen($_POST['uname'])<5){
			echo "Name must be 8 characters or longer";
		}
		else if(!preg_match("/^[9][7][4][1][0-9]*$/",$_POST['uphone'])){
			echo "Phone number must start with 9741";
		}
		else if(empty($_POST['gender'])){
			echo "Gender must be selected";
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

		// Inserting Data
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$uname=$_POST['uname'];
		$role=$_POST['urole'];
		$password=$_POST['upass'];
		$dept=$_POST['dselect'];
		$phone=$_POST['uphone'];
		$gender=$_POST['gender'];
		$address=$_POST['uaddress'];
		$shift=$_POST['ushift'];

		// insertion into user
		$sql="insert into user(uname,password,role,department_id) values('$uname','$password','$role',$dept);";
		$result=mysqli_query($conn,$sql);
		if($result){
			echo "Data inserted";
		}
		else{
			die("Data insertion failed:".mysqli_error($conn));
		}


		// retrieving user id for foreign key
		$sql="select*from user where uname='$uname' and password='$password';";
		$res=mysqli_query($conn,$sql);
		$sid=0;
		if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_assoc($res)){
				$sid=$row['uid'];
			}
		}


		// insertion into staff
		$sql="insert into staff(sid,first_name,last_name,gender,phone,address,shift) values($sid,'$fname','$lname','$gender',$phone,'$address','$shift');";
		$result=mysqli_query($conn,$sql);
		if($result){
			echo "Data inserted";
		}
		else{
			die("Data insertion failed:".mysqli_error($conn));
		}


		if($_SESSION['name']=='admin'){
			header("location:admin/staff.php");
		}
	}
?>

<div style="margin-left:15%;padding:1px 16px;height:auto;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

				<label>FirstName:</label><br>
				<input type="text" name="fname"><br>


				<label>Lastname:</label><br>
				<input type="text" name="lname"><br>


				<label>Username:</label><br>
				<input type="text" name="uname"><br>


				<label>Role:</label><br>
					<select name="urole" id="select">
					<option value="---">---</option>
					<option value='receptionist'>Receptionist</option>
					<option value='doctor'>Doctor</option>
					<option value='tester'>Tester</option>
					<option value='staff'>Staff</option>
				</select><br>

				<label>Department:</label><br>
					<select name="dselect" id="select">
					<option value="---">---</option>
					<option value=1>Counter</option>
					<option value=2>Orthopedic</option>
					<option value=3>General</option>
					<option value=4>Xray</option>
					<option value=8>MRI</option>
				</select><br>

				<label>Phone:</label><br>
				<input type="text" name="uphone"><br>

				<label>Password:</label><br>
				<input type="password" name="upass"><br>

				<label>Male</label>
				<input type="radio" name="gender" value="male">

				<label>Female</label>
				<input type="radio" name="gender" value="female"><br>

				<label>Address</label><br>
				<input type="text" name="uaddress"><br>

				<label>Shift</label><br>
				<input type="text" name="ushift"><br>
	
				<input type="submit" value="Sign up">
	</form>
</div>