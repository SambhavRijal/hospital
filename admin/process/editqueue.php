

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

    $qid=$_GET['id'];
    $dept=0;
    $pid=0;
    $status="";

    if($_SERVER['REQUEST_METHOD']=='GET')
    {   
        $sql="select*from queue where qid=$qid;";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $pid=$row['pid'];
                $dept=$row['dept'];
                $status=$row['status'];
            }
        }
        
    }

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    // Retrieving form Data
    $qid=$_POST['qid'];
    $status=$_POST['status'];
    $dept=$_POST['department'];

    $sql="update queue set dept=$dept, status='$status' where qid=$qid;";
    $res=mysqli_query($conn,$sql);
    if(!$res){
        echo "eiofheifgehfiehgiehgiegegege0".mysqli_error($conn);
    }
    header("location:/hospital/admin/queue.php");
    
}


?>


<!-- HTML of page -->
<div style="margin-left:15%;padding:1px 16px;height:auto;">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table border=0>
        <tr>
            <td>Patient</td>
            <td><input type="number" name="patient" value="<?php echo $pid ?>" disabled></td>
        </tr>
        <tr>
            <td>Department</td>
            <td><input type="number" name="department" value="<?php echo $dept ?>"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type="text" name="status" value="<?php echo $status ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" value="<?php echo $qid; ?>" name="qid"></td>
            <td><button type="submit">Done</button></td>
        </tr>
    </table>

</form>
</div>
