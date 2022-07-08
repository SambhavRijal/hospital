

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

        $dept=$_GET['id'];
        $dname="";

        if($_SERVER['REQUEST_METHOD']=='GET')
        {   
            $sql="select*from department where did=$dept;";
            $res=mysqli_query($conn,$sql);
            if(mysqli_num_rows($res)>0){
				while($row=mysqli_fetch_assoc($res)){
					$dname=$row['dname'];
				}
		    }
            
        }

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		// Retrieving form Data
		$newname=$_POST['nname'];
        $dept=$_POST['department'];

        echo "ewiohefihefiehfiehfiehfiehfiehfie: ".$newname;
		$sql="update department set dname='$newname' where did=$dept;";
		$res=mysqli_query($conn,$sql);
        if(!$res){
            echo "eiofheifgehfiehgiehgiegegege0".mysqli_error($conn);
        }
        header("location:/hospital/admin/department.php");
		
	}

	
?>


<!-- HTML of page -->
<div style="margin-left:15%;padding:1px 16px;height:auto;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<table border=0>
			<tr>
				<td>Old Name</td>
				<td><input type="text" name="oname" value="<?php echo $dname ?>" disabled></td>
			</tr>
			<tr>
				<td>New Name:</td>
				<td><input type="text" name="nname"></td>
			</tr>
			<tr>
				<td><input type="hidden" value="<?php echo $dept; ?>" name="department"></td>
				<td><button type="submit">Done</button></td>
			</tr>
		</table>
	</form>
</div>
