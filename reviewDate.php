<?php

session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);
$employeeID = $_SESSION['employeeID'];

if(isset($_POST['day'])){
    $selectedDate = $_POST['day']; //get the value from reviewS.php where button name = day
    $_SESSION['SpvDate'] = $selectedDate;// pass the value to reviewE.php

    //find user in database
    $query = "SELECT * FROM updatedailyschedule natural join employee where Date='$selectedDate' and supervisorID = '$employeeID'";
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($run);// number of row found

if($count > 0){//if found then print this alert
    echo'<script>alert("Employee found on this date."); window.location="reviewE.php";</script>';
}
else{//not found the row then print this alert
    echo'<script>alert("No employee submit daily schedule on this date."); window.location="reviewS.php";</script>';
}
}



?>
