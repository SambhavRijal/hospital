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
                <th>Name</th>
                <th>Age</th>
				<th>Phone</th>
				<th>Gender</th>
                <th>Email</th>
                <th>Blood</th>
                <th>Address</th>
                <th>Bill</th>	
                <th>Paid</th>	
                <th>Total</th>	
                <th><a class='btn btn-primary' href='/hospital/addpatient.php' role='button'>New Patient</a></th>
            </tr>
</thead>
<tbody>

<?php 
			$sql2="select*from patient;";
            $res2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($res2)>0){
                while($row=mysqli_fetch_assoc($res2)){
					echo "<tr>";
                    echo "<td>".$row['pname']."</td>";
                    echo "<td>".$row['page']."</td>";
                    echo "<td>".$row['pphone']."</td>";
                    echo "<td>".$row['pgender']."</td>";
                    echo "<td>".$row['pemail']."</td>";
                    echo "<td>".$row['pblood']."</td>";
                    echo "<td>".$row['address']."</td>";
					echo "<td>".$row['bill']."</td>";
                    echo "<td>".$row['paid']."</td>";
					echo "<td>".$row['total']."</td>";
					echo "<td><a class='btn btn-primary' href='process/editpatient.php?id=".$row['pid']."' role='button'>Edit</a>  <a class='btn btn-danger' href='process/deletepatient.php?id=".$row['pid']."' role='button'>Delete</a></td>";
					echo "</tr>";
                }
            }
?>
</tbody>



