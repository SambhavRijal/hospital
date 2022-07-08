<?php include "nav.php"; ?>


<?php

    $id=$_GET['id'];
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



    if($_SERVER['REQUEST_METHOD']=='GET'){

        $fname="";
		$lname="";
		$uname="";
		$role="";
		$password="";
		$dept="";
		$phone="";
		$gender="";
		$address="";
		$shift="";

        $sql="select*from staff join user on staff.sid=user.uid where staff.sid=$id;";
        $res=mysqli_query($conn,$sql);

        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $fname=$row['first_name'];
                $lname=$row['last_name'];
                $uname=$row['uname'];
                $password=$row['password'];
                $role=$row['role'];
                $dept=$row['department_id'];
                $phone=$row['phone'];
                $gender=$row['gender'];
                $address=$row['address'];
                $shift=$row['shift'];
            }
        }
    }

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		// Updating Data
        $id=$_POST['id'];
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



        // updaating into staff
		$sql="update staff set first_name='$fname',last_name='$lname',gender='$gender',phone='$phone',address='$address',shift='$shift' where sid=$id;";
		$result=mysqli_query($conn,$sql);
		if($result){
			echo "staff updated";
		}
		else{
			die("staff updating failed:".mysqli_error($conn));
		}


		// insertion into user
		$sql="update user set uname='$uname',password='$password',role='$role',department_id=$dept where uid=$id";
		$result=mysqli_query($conn,$sql);
		if($result){
			echo "user updated";
		}
		else{
			die("user update failed:".mysqli_error($conn));
		}


			header("location:/hospital/admin/staff.php");
	}
?>

<div style="margin-left:15%;padding:1px 16px;height:auto;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<table border=0>
			<tr>
				<td>FirstName:</td>
				<td><input type="text" name="fname" value="<?php echo $fname; ?>"></td>
			</tr>
			<tr>
				<td>Lastname:</td>
				<td><input type="text" name="lname" value="<?php echo $lname; ?>"></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="uname" value="<?php echo $uname; ?>"></td>
			</tr>
			<tr>
				<td>Role:</td>
				<td><select name="urole" id="select">
					<option value="---">---</option>
					<option value='receptionist' <?php if($role=='receptionist'){ echo "selected";} ?>>Receptionist</option>
					<option value='doctor'  <?php if($role=='doctor'){ echo "selected";} ?>>Doctor</option>
					<option value='tester'  <?php if($role=='tester'){ echo "selected";} ?>>Tester</option>
					<option value='staff'  <?php if($role=='staff'){ echo "selected";} ?>>Staff</option>
				</select></td>
			</tr>
			<tr>
				<td>Department:</td>
				<td><select name="dselect" id="select">
					<option value="---">---</option>
					<option value=1 <?php if($dept==1){ echo "selected";} ?>>Counter</option>
					<option value=2 <?php if($dept==2){ echo "selected";} ?>>Orthopedic</option>
					<option value=3 <?php if($dept==3){ echo "selected";} ?>>General</option>
					<option value=4 <?php if($dept==4){ echo "selected";} ?>>Xray</option>
					<option value=8 <?php if($dept==5){ echo "selected";} ?>>MRI</option>
				</select></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input type="text" name="uphone" value="<?php echo $phone; ?>"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="upass" value="<?php echo $password; ?>"></td>
			</tr>
			<tr>
				<td><label>Male</label> <input type="radio" name="gender"
				value="male" <?php if($gender=='male'){ echo "checked";} ?>></td>
				<td><label>Female</label><input type="radio" name="gender" value="female" <?php if($gender=='female'){ echo "checked";} ?>></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type="text" name="uaddress" value="<?php echo $address; ?>"></td>
			</tr>
			<tr>
				<td>Shift:</td>
				<td><input type="text" name="ushift" value="<?php echo $shift; ?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" value="<?php echo $id ?>" name="id"></td>
				<td><input type="submit" value="Edit"></td>
			</tr>
		</table>
	</form>
</div>