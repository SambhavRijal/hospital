<?php //include "nav.php"; ?>

<style>
    #billstuff{
        width:70%; 
        margin-left:40%;
        padding:1px 16px;
        height:auto;
        padding-top:13%;
    }
</style>

<?php



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
        $patient=$_GET['id'];
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
    }


    if($_SERVER['REQUEST_METHOD']=='POST'){
        echo "Inside post";
        $patient=$_POST['patient'];
        $bill=$_POST['bill'];
        $paid=$_POST['paid'];
        $total=$bill-$paid;
        echo $bill."<br>";
        echo $paid."<br>";
        echo $total;

        $bill_sql="update patient set bill=$bill, paid=$paid, total=$total where pid=$patient";
		$bill_res=mysqli_query($conn,$bill_sql);
        if($bill_res){
            echo "Successful";
        }
        else{
            echo "there is a biggg error error".mysqli_error($conn);
        }


		header("location:billing.php");

    }
	
?>

    <form id="billstuff" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >	
        <label> Bill </label>
        <input type="number" value="<?php echo $bill; ?>" name="bill">
        <br><br>
        <label>Paid</label>
        <input type="number" value="<?php echo $paid; ?>" name="paid">
        <br><br>
        <label>Total</label>
        <input type="number"  value="<?php echo $total; ?>" disabled>
        <br><br>
        <input type="hidden" value="<?php echo $patient; ?>" name="patient">
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>