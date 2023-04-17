<!-- This page is to update the FWA request status and employee's FWA status based on the form in reviewFWA2.php.-->
<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";
define('SITEURL', 'http://localhost/flexis');

$conn = mysqli_connect($server, $username, $password, $dbname);

session_start();
$employeeID = $_SESSION['employeeID'];  //get the logged in employeeID
$fwaID = $_SESSION['fwaID'];  //get the FWA requestID reviewed by supervisor

if(isset($_POST['confirmReview'])){

    if(!empty($_POST['decision']) ){
        $decision = $_POST['decision'];
        $comment = $_POST['comment'];

        //update the FWA request status based on the requestID
        $query = "UPDATE fwarequest SET status='$decision', comment='$comment' WHERE requestID='$fwaID'";
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($run){
            echo'<script>alert("Review submitted successfully"); window.location="reviewFWA.php";</script>';
                //get the employeeID and worktype based on the requestID to update the employee table
                $sql =  "SELECT employeeID, workType FROM fwarequest WHERE requestID = '$fwaID'";
                $run1 = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($run1);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($run1)){
                        $fwaEmployee = $row['employeeID'];
                        $fwaStatus = $row['workType'];
                    }

                    if($decision == "accepted"){
                        $sql2 = "UPDATE employee SET FWAStatus='$fwaStatus' WHERE employeeID ='$fwaEmployee'"; //update the employee FWA status
                        $run2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                    }
                    else{
                        $sql2 = "UPDATE employee SET FWAStatus='none' WHERE employeeID ='$fwaEmployee'";
                        $run2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                    }

                }
            }

        else{
            echo'<script>alert("Review not submitted"); window.location="reviewFWA.php";</script>';
        }
    }
    else{
        echo'<script>alert("Accept/Reject field is required"); window.location="reviewFWA.php";</script>';
   }
}
else{
    echo'<script>alert("Accept/Reject field is required"); window.location="reviewFWA.php";</script>';
}
?>

