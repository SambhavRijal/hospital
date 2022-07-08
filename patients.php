<?php include "nav.php"; ?>

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
                <th>Gender</th>
                <th>Phone</th>
                <th>Blood</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
</thead>
<tbody>
    <?php
        // retrieving user id for foreign key
	$sql="select*from patient;";
	$res=mysqli_query($conn,$sql);
	$sid=0;
	if(mysqli_num_rows($res)>0){
		while($row=mysqli_fetch_assoc($res)){
            echo "<tr>";
            echo "<td><a href='patient.php?id=".$row['pid']."'>".$row['pname']."</a></td>";
            echo "<td>".$row['page']."</td>";
            echo "<td>".$row['pgender']."</td>";
            echo "<td>".$row['pphone']."</td>";
            echo "<td>".$row['pblood']."</td>";
            echo "<td>".$row['pemail']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "</tr>";
		}
	}
    ?>
</tbody>
    </table>
</div>