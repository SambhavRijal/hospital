<?php include "nav.php"; ?>


<?php

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


	
?>

<div style="margin-left:15%;padding:1px 16px;height:auto;">
    <table  class="table table-hover">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Department</th>
				<th>Gender</th>
				<th>Phone</th>
                <th>Address</th>
                <th>Shift</th>	
                <th><a class='btn btn-primary' href='/hospital/signup.php' role='button'>New Staff</a></th>
            </tr>
</thead>
<tbody>

<?php 

            $uname="";
            $role="";
            $password="";
            $department;


            

			$sql2="select*from staff join user on staff.sid=user.uid;";
            $res2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($res2)>0){
                while($row=mysqli_fetch_assoc($res2)){
					echo "<tr>";
                    echo "<td>".$row['first_name']."</td>";
                    echo "<td>".$row['last_name']."</td>";
                    echo "<td>".$row['uname']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "<td>".$row['role']."</td>";
                    echo "<td>".$row['department_id']."</td>";
                    echo "<td>".$row['gender']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "<td>".$row['shift']."</td>";
					echo "<td><a class='btn btn-primary' href='process/editstaff.php?id=".$row['uid']."' role='button'>Edit</a>  <a class='btn btn-danger' href='process/deletestaff.php?id=".$row['uid']."' role='button'>Delete</a></td>";
					echo "</tr>";
                }
            }
?>
</tbody>



