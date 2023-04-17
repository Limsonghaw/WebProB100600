

<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);



if(isset($_POST['submit'])){
        $Comment  = $_POST['Comment'];//get the value where the textarea name
        $employeeID = $_SESSION['EmpID'];//get the employeeID from reveiwE.php
        $Date=$_SESSION['SpvDate'];
  
        $query = "SELECT * FROM updatedailyschedule where employeeID='$employeeID' and Date='$Date'";
        $run= mysqli_query($conn, $query) or die(mysqli_error($conn));
        $count = mysqli_num_rows($run);//count how many how found 

        if($count > 0){//the row found
        while($row = mysqli_fetch_array($run)){
            $dateFound= true;
        }}else{
            $dateFound = false;
        }
        if(empty($Comment)){
            $employeeID = $_SESSION['EmpID'];
            $query = "UPDATE updatedailyschedule set Comment='none' where employeeID='$employeeID' and Date='$Date'";
            //if the comment not insert any valuesprint alert
            echo'<script>alert("Update successfully!"); window.location="homeS.php";</script>';
    }else{
        if($dateFound){//if true run this and print alert
            $employeeID = $_SESSION['EmpID'];
            $query = "UPDATE updatedailyschedule set Comment='$Comment' where  employeeID='$employeeID' and Date='$Date'";
            echo'<script>alert("Update successfully!"); window.location="homeS.php";</script>';
        }else{
            //if false print alert
            echo'<script>alert("Not found! Update not successfully!"); window.location="empInfo.php";</script>';
    }
        }
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));//use for row 36
    }

?>