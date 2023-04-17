<!-- This page is to insert the value entered by user into the FWA request database -->

<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);


if(isset($_POST['submit'])){

    //check if all required fields are entered
    if(!empty($_POST['workType']) && !empty($_POST['description']) && !empty($_POST['reason'])){
        //get the values of the fields entered
        $workType = $_POST['workType'];
        $description = $_POST['description'];
        $reason = $_POST['reason'];
        session_start();
        $employeeID = $_SESSION['employeeID']; //get the logged in employee ID

        //query to insert the new FWA request as a new row in the database
        $query = "INSERT into fwarequest(workType, description, reason, employeeID) values ('$workType', '$description' , '$reason', '$employeeID')";

        //perform the query on the database or return error if fail to access to database
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($run){
            echo'<script>alert("FWA request submitted successfully!"); window.location="confirmFWA.php";</script>';
        }
        else{
            echo'<script>alert("FWA request not submitted"); window.location="submitFWA.php";</script>';
        }

    }
    else{
        echo'<script>alert("All fields are required"); window.location="submitFWA.php";</script>';
   }
}
else{
    echo'<script>alert("All fields are required"); window.location="submitFWA.php";</script>';
}
?>

