<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $employeeID = $_POST['EmployeeID'];//get the value where the input name is 
  $password = $_POST['Password'];


  if (empty($employeeID) || empty($password)) {
    echo '<script>alert("Please enter both employee ID and password.");window.location="logIn.php";</script>';
  } else {
    // Check if user exists in database
    $query = "SELECT * FROM employee WHERE employeeID='$employeeID'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {//if found the user
        $row = mysqli_fetch_array($result);//get the all information
      

      if ($password == $row['password']){//if password match
        session_start();
        $_SESSION['employeeID'] = $employeeID;//use for successEmployee.php

        if($employeeID[0] == 'S'){//check the first work is S means is supervisor
          header('Location: homeS.php');
        }
        else if($employeeID[0] == 'H'){//check the first work is H means is HR Admin
          header('Location: homeH.php');
        }
        else{
          header('Location: homeE.php');//other is employee
        }

      } else {
        echo '<script>alert("Incorrect password.");window.location="logIn.php";</script>';// password not match then print this alert
      }
      
    } else {
      echo '<script>alert("Incorrect employee ID.");window.location="logIn.php";</script>';// employeeID not found then print this alert
    }
  }
}
?>