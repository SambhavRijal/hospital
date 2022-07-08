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
                <th>Patient</th>
                <th>Department</th>
				<th>Diagnosisw</th>
				<th>Treatment</th>
                <th>Feedback</th>
                <th>Tests</th>	
            </tr>
</thead>
<tbody>

<?php 
			$sql2="select*from treatment;";
            $res2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($res2)>0){
                while($row=mysqli_fetch_assoc($res2)){
					echo "<tr>";
                    $id=$row['pid'];
                    echo "<td>".$row['pid']."</td>";
                    echo "<td>".$row['did']."</td>";
                    echo "<td>".$row['diagnosis']."</td>";
                    echo "<td>".$row['treatment']."</td>";
                    echo "<td>".$row['feedback']."</td>";
                    echo "<td>".$row['tests']."</td>";
					echo "<td><a class='btn btn-primary' href='process/editpatient.php?id=".$row['pid']."' role='button'>Edit</a>  <a class='btn btn-danger' href='process/deletepatient.php?id=".$row['pid']."' role='button'>Delete</a></td>";
					echo "</tr>";
                }
            }
?>
</tbody>



