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


	if($_SERVER['REQUEST_METHOD']=='POST'){

		$dep_name=$_POST['department_name'];

		$sql="insert into department(dname) values('$dep_name');";
		$res=mysqli_query($conn,$sql);
		header("location: /hospital/admin/department.php");
		

	}

	
?>

<div style="margin-left:15%;padding:1px 16px;height:auto;">
    <table  class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<th><input type="text" name="department_name" placeholder="New Department Name"> <button class='btn btn-primary' type="submit" >Add Department</a></th>
				</form>
				</tr>
</thead>
<tbody>

<?php 
			$sql2="select*from department;";
            $res2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($res2)>0){
                while($row=mysqli_fetch_assoc($res2)){
					echo "<tr>";
                    echo "<td>".$row['dname']."</td>";
					echo "<td><a class='btn btn-primary' href='process/editdepartment.php?id=".$row['did']."' role='button'>Edit</a>  <a class='btn btn-danger' href='process/deletedepartment.php?id=".$row['did']."' role='button'>Delete</a></td>";
					echo "</tr>";
                }
            }
?>
</tbody>



