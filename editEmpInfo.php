<!-- This page is to update the employee info (name or password) in the employee database-->

<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

session_start();
$employeeID = $_SESSION['employeeID'];

$conn = mysqli_connect($server, $username, $password, $dbname);


if(isset($_POST['updateInfo'])){

    //if-else statement to ensure only the entered fields are updated in the employee database
    if(!empty($_POST['name']) && !empty($_POST['password'])){

        $newName = $_POST['name'];
        $newPwd = $_POST['password'];

        $query = "UPDATE employee SET name='$newName', password ='$newPwd', FWAStatus = 'None' WHERE employeeID= '$employeeID'";

    }
    else if (!empty($_POST['password']) && empty($_POST['name'])){

        $newPwd = $_POST['password'];
        $query = "UPDATE employee SET password ='$newPwd', FWAStatus = 'None' WHERE employeeID= '$employeeID'";

    }
    else if (!empty($_POST['name']) && empty($_POST['password'])){

        $newName = $_POST['name'];
        $query = "UPDATE employee SET name='$newName' WHERE employeeID= '$employeeID'";

    }

    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if($run){
        if($employeeID[0] == 'S'){
            echo'<script>alert("Personal Info updated successfully!"); window.location="homeS.php";</script>';
        }
        else{
            echo'<script>alert("Personal Info updated successfully!"); window.location="homeE.php";</script>';
        }
    }
    else{
        echo'<script>alert("Personal Info failed to update!"); window.location="homeE.php";</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        {background-color:#05223e;}
    </style>
</head>
</html>

