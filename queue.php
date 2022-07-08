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
                <th>Department</th>
                <th>Status</th>
            </tr>
</thead>
<tbody>
    <?php
        // retrieving user id for foreign key
    if($_SESSION['role']=='receptionist'){
        $sql="select*from queue;";
    }

    if($_SESSION['role']=='doctor' || $_SESSION['role']=='staff'){
        $did=$_SESSION['department'];
        $sql="select*from queue where dept=$did and status='waiting'";
    }
	
	$res=mysqli_query($conn,$sql);
	$sid=0;
	if(mysqli_num_rows($res)>0){
		while($row=mysqli_fetch_assoc($res)){
            echo "<tr>";
            $id=$row['pid'];
            $did=$row['dept'];
            $name="";
            $dept="";

            // retrieving patient name
            $sql2="select*from patient where pid=$id;";
            $res2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($res2)>0){
                while($row2=mysqli_fetch_assoc($res2)){
                    $name=$row2['pname'];
                    
                }
            }

            // retrieving department name
            $sql2="select*from department where did=$did;";
            $res2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($res2)>0){
                while($row2=mysqli_fetch_assoc($res2)){
                    $dept=$row2['dname'];
                    
                }
            }


            echo "<td><a href='patient.php?id=".$row['pid']."'>".$name."</a></td>";
            echo "<td>".$dept."</td>";
            echo "<td>".$row['status']."</td>";
            echo "</tr>";
		}
	}
    ?>
</tbody>
    </table>
</div>