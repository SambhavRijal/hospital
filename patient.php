<?php //include "nav.php"; ?>
<?php session_start(); ?>
<?php
		$patient=$_GET['id'];
		$dept=0;
		$current_department=$_SESSION['department'];
		echo "Current Department is :".$current_department;

		$name="";
		$age="";
		$phone="";
		$gender="";
		$email="";
		$address="";
		$blood="";
	
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


		if($_SERVER['REQUEST_METHOD']=='GET')
		{
			// retrieving patient name
			$sql2="select*from patient where pid=$patient;";
			$res2=mysqli_query($conn,$sql2);
			if($res2){
				echo "Patient Data Retrieved";
			}
			else{
				echo "Patient Data not retrieved".mysqli_error($conn);
			}
			
			if(mysqli_num_rows($res2)>0){
				while($row2=mysqli_fetch_assoc($res2)){
					$name=$row2['pname'];
					$age=$row2['page'];
					$phone=$row2['pphone'];
					$gender=$row2['pgender'];
					$email=$row2['pemail'];
					$address=$row2['address'];
					$blood=$row2['pblood'];
					
				}
			}
		}

		echo "before post ";

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$patient=$_POST['patient'];
		echo "Patient id is:".$patient;

		echo "inside post ";
		$diagnosis=$_POST['diagnosis'];
		$treatment=$_POST['treatment'];
		$feedback=$_POST['feedback'];
		$tests="";

		if(!empty($_POST['test'])) 
		{
			echo "inside checkbox";
			print_r($_POST['test']);
			foreach($_POST['test'] as $value)
			{
				echo $value;
				$tests=$tests.",".$value;
				echo $tests;
				$sql="select*from department where tname='$value';";
				$res=mysqli_query($conn,$sql);
				if($res)
				{
					echo "department retrieved";
				}
				else
				{
					die("department retrieving failed:".mysqli_error($conn));
				}

				if(mysqli_num_rows($res)>0)
				{
					while($row=mysqli_fetch_assoc($res))
					{
						$dept=$row['did'];
						echo "department is:".$dept;
					}
				}


				echo "Patient is=".$patient;

				$sql8="insert into queue(pid,dept,status) values($patient,$dept,'Waiting');";
				$res8=mysqli_query($conn,$sql8);
				if($res8){
					echo "Queue inserted";
				}
				else{
					die("Queue insertion failed:".mysqli_error($conn));
				}
			}
	
		}

		$sql7="select*from treatment where pid=$patient;";
		$res7=mysqli_query($conn,$sql7);
		if($res7){
			echo "Check if treatment exists";
		}
		else{
			echo "checking treatment existence failed".mysqli_error($conn);
		}

		$rowamt=mysqli_num_rows($res7);
		echo $rowamt;
		$sql3="";

		if(mysqli_num_rows($res7)>0){
			echo "<br> Treatment data exists";
			$sql3="update treatment set diagnosis='$diagnosis', treatment='$treatment', feedback='$feedback', tests='$tests' where pid=$patient;";
		}
		else{
			echo "<br> Treatment data doesnt exist";
			$sql3="insert into treatment(pid,did,diagnosis,treatment,feedback,tests) values($patient,$current_department,'$diagnosis','$treatment','$feedback','$tests');";
		}
		echo "<br>".$sql3."<br>";
		$res3=mysqli_query($conn,$sql3);
		if($res3){
			echo "Data inserted in treatment";
		}
		else{
			die("Data insertion in treatment failed:".mysqli_error($conn));
		}

		$sql4="update queue set status='treated' where pid=$patient and dept=$current_department;";
		$res4=mysqli_query($conn,$sql4);
		if($res4){
			echo "Patient queue status changed";
		}
		else{
			die("Data insertion failed:".mysqli_error($conn));
		}

		$bill_sql="select*from patient where pid=$patient";
		$bill_res=mysqli_query($conn,$bill_sql);
		$bill=0;
		$paid=0;
		$total=0;
		if(mysqli_num_rows($bill_res)>0){
			while($bill_row=mysqli_fetch_assoc($bill_res)){
				$bill=$bill_row['bill'];
				$paid=$bill_row['paid'];
				$total=$bill_row['total'];
			}
		}

		$bill=$bill+500;
		$total=$bill-$paid;
		$bill_sql="update patient set bill=$bill, total=$total where pid=$patient";
		$bill_res=mysqli_query($conn,$bill_sql);


		header("location:queue.php");

		
	}
   

    
	
?>

<div style="margin-left:15%;padding:1px 16px;height:auto;">
	<table border=1 style="width:30%;" >
		<tr>
			<td>Name:</td>
			<td><?php echo $name ?></td>
		</tr>
        <tr>
			<td>Age:</td>
			<td><?php echo $age ?></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><?php echo $phone ?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><?php echo $gender ?></td>
		</tr>
        <tr>
			<td>Email:</td>
			<td><?php echo $email ?></td>
		</tr>
		<tr>
			<td>Address:</td>
			<td><?php echo $address ?></td>
		</tr>
		<tr>
			<td>Blood:</td>
			<td><?php echo $blood ?></td>
		</tr>
	</table>
	
	<div id="diagnosis">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">	
			<table border=1 style="width:70%; margin-top:40px;" >

			<?php
				$info_sql="select*from treatment where pid=$patient;";
				echo "inside form data part";
				$info_res=mysqli_query($conn,$info_sql);
				if($info_res){
					echo "Check if treatment exists";
				}
				else{
					echo "checking treatment existence failed".mysqli_error($conn);
				}

				
				$diagnosis="";
				$treatmemt="";
				$feedback="";

				if(mysqli_num_rows($info_res)>0){
					echo "<br>before while";
					while($row=mysqli_fetch_assoc($info_res)){
						echo '<br>'.$row['diagnosis'];
						echo '<br>'.$row['treatment'];
						echo '<br>'.$row['feedback'];
						$diagnosis=$row['diagnosis'];
						$treatment=$row['treatment'];
						$feedback=$row['feedback'];
					}

					?>

					<tr>
					<td>Diagnosis </td>
					<td><textarea rows=5 cols=30 name='diagnosis' > <?php echo $diagnosis; ?> </textarea></td>
					</tr>
					<tr>
						<td>Treatment</td>
						<td><textarea rows=5 cols=30 name='treatment'><?php echo $treatment; ?> </textarea></td>
					</tr>
					<tr>
						<td>Feedback</td>
						<td><textarea rows=5 cols=30 name='feedback'><?php echo $feedback; ?> </textarea></td>
					</tr>

					<?php

				}

				else{
					echo "<tr>
					<td>Diagnosis</td>
					<td><textarea rows=5 cols=30 name='diagnosis'></textarea></td>
					</tr>
					<tr>
						<td>Treatment</td>
						<td><textarea rows=5 cols=30 name='treatment'></textarea></td>
					</tr>
					<tr>
						<td>Feedback</td>
						<td><textarea rows=5 cols=30 name='feedback'></textarea></td>
					</tr>
					";

				}
			?>
				<tr>
					<td>Tests</td>
					<td> <input type="checkbox" name='test[]' value="Xray"> Xray <br/>
						<input type="checkbox" name='test[]' value="Orthopedic"> Orthopedic <br/>
						<input type="checkbox" name='test[]' value="Blood Test"> Blood Test <br/>
						<input type="checkbox" name='test[]' value="Urine Test"> Urine Test <br/>
						<input type="checkbox" name='test[]' value="MRI"> MRI <br/></td>
				</tr>
				<tr>
					<td><input type="hidden" value="<?php echo $patient ?>" name="patient"></td>
					<td><input type="submit" value="Next"></td>
				</tr>
			</table>
		</form>	
	</div>
</div>
