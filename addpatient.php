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
		$name=$_POST['name'];
		$age=$_POST['age'];
		$phone=$_POST['phone'];
		$blood=$_POST['blood'];
		$gender=$_POST['gender'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$department=$_POST['department'];
		$pid=0;

		// insertion into user
		$sql="insert into patient(pname,page,pphone,pgender,pemail,pblood,address,department,bill,paid,total) values('$name',$age,$phone,'$gender','$email','$blood','$address','$department',300,0,300);";
		$result=mysqli_query($conn,$sql);
		if($result){
			echo "Data inserted";
		}
		else{
			die("Data insertion failed:".mysqli_error($conn));
		}

		// retrieving user id for foreign key
		$sql="select*from patient where pname='$name' and pphone=$phone;";
		$res=mysqli_query($conn,$sql);
		$sid=0;
		if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_assoc($res)){
				$pid=$row['pid'];
			}
		}

		$sql="insert into queue(pid,dept,status) values($pid,$department,'Waiting');";
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
		<table border=0>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name"></td>
			</tr>
            <tr>
				<td>Age:</td>
				<td><input type="number" name="age"></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input type="text" name="phone"></td>
			</tr>
			<tr>
				<td><label>Male</label> <input type="radio" name="gender"
				value="male"></td>
				<td><label>Female</label><input type="radio" name="gender" value="female"></td>
			</tr>
			<tr>
				<td>Department:</td>
				<td><select name="department" id="select">
					<option value="---">---</option>
					<option value='3'>General</option>
					<option value='2'>Orthopedic</option>
					<option value='4'>Xray</option>
				</select></td>
			</tr>
            <tr>
				<td>Email:</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type="text" name="address"></td>
			</tr>
			<tr>
				<td>Blood:</td>
				<td><input type="text" name="blood"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Add Patient"></td>
			</tr>
		</table>
	</form>
</div>