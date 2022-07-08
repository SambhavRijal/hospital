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

        // Retreieving Data
		$name="";
		$age="";
		$phone="";
		$blood="";
		$gender="";
		$email="";
		$address="";
		$department="";
		$pid=$id;
        $dept=0;
        $bill=0;
        $paid=0;
        $total=0;
        $diagnosis="";
        $treatment="";
        $feedback="";


        $sql2="select*from patient where pid=$id;";
        $res2=mysqli_query($conn,$sql2);
        if(mysqli_num_rows($res2)>0){
            while($row=mysqli_fetch_assoc($res2)){
                $name=$row['pname'];
                $age=$row['page'];
                $phone=$row['pphone'];
                $gender=$row['pgender'];
                $email=$row['pemail'];
                $blood=$row['pblood'];
                $address=$row['address'];
				$bill=$row['bill'];
                $paid=$row['paid'];
				$total=$row['total'];
                }
            }

        
            $sql3="select*from treatment where pid=$id;";
            $res3=mysqli_query($conn,$sql3);
            if(mysqli_num_rows($res3)>0){
                while($row=mysqli_fetch_assoc($res3)){
                    $dept=$row['did'];
                    $diagnosis=$row['diagnosis'];
                    $treatment=$row['treatment'];
                    $feedback=$row['feedback'];
                    }
                }
        }


        if($_SERVER['REQUEST_METHOD']=='POST'){

            echo "inside post";
		
            // Updating Data
            $id=$_POST['id'];
            $name=$_POST['name'];
            $age=$_POST['age'];
            $phone=$_POST['phone'];
            $gender=$_POST['gender'];
            $dept=$_POST['department'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $blood=$_POST['blood'];
            $diagnosis=$_POST['diagnosis'];
            $treatment=$_POST['treatment'];
            $feedback=$_POST['feedback'];
            
            $bill=$_POST['bill'];
            $paid=$_POST['paid'];
            $total=0;
            
            if($bill){
                $total=$bill-$paid;
            }
            
            echo $total;
    
    
    
    
            // insertion into treatment
            $sql1="update treatment set diagnosis='$diagnosis', treatment='$treatment', feedback='$feedback' where pid=$id;";
            $result1=mysqli_query($conn,$sql1);
            if($result1){
                echo "Treatment updated";
            }
            else{
                die("Treatment update failed:".mysqli_error($conn));
            }


            // updaating into patient
            echo "<br> Phone is:".$phone;
            $sql="update patient set pname='$name',page=$age,pphone=$phone,pgender='$gender',pemail='$email', pblood='$blood', address='$address', department=$dept, bill=$bill, paid=$paid, total=$total where pid=$id;";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "Patient updated";
            }
            else{
                die("patient updating failed:".mysqli_error($conn));
            }
    
            header("location:/hospital/admin/patient.php");
        }



?>





<div style="margin-left:15%;padding:1px 16px;height:auto;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<table border=0>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
			</tr>
            <tr>
				<td>Age:</td>
				<td><input type="number" name="age" value="<?php echo $age; ?>"></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input type="text" name="phone" value="<?php echo $phone; ?>"></td>
			</tr>
			<tr>
				<td><label>Male</label> <input type="radio" name="gender"
				value="male" <?php if($gender=='male'){ echo "checked";} ?>></td>
				<td><label>Female</label><input type="radio" name="gender" value="female" <?php if($gender=='female'){ echo "checked";} ?>></td>
			</tr>
			<tr>
				<td>Department:</td>
				<td><select name="department" id="select">
					<option value="---">---</option>
					<option value='3' <?php if($dept==3){ echo "selected";} ?> >General</option>
					<option value='2' <?php if($dept==2){ echo "selected";} ?>>Orthopedic</option>
					<option value='4' <?php if($dept==4){ echo "selected";} ?>>Xray</option>
				</select></td>
			</tr>
            <tr>
				<td>Email:</td>
				<td><input type="email" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type="text" name="address" value="<?php echo $address; ?>"></td>
			</tr>
			<tr>
				<td>Blood:</td>
				<td><input type="text" name="blood" value="<?php echo $blood; ?>"></td>
			</tr>
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
            <tr>
                <td>Bill</td>
                <td><input type="number" value="<?php echo $bill; ?>" name="bill"></td>
            </tr>
                <td><label>Paid</label></td>
                <td><input type="number" value="<?php echo $paid; ?>" name="paid"></td>
            <tr>
                <td><label>Total</label></td>
                <td><input type="number"  value="<?php echo $total; ?>" disabled></td>
            </tr>
			<tr>
				<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
				<td><input type="submit" value="Finish Editing"></td>
			</tr>
		</table>
	</form>
</div>