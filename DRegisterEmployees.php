<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);


//chck the button is clicked or not
if(isset($_POST['submit'])){
    //check the variable is not null
    if(!empty($_POST['EmployeeID']) && !empty($_POST['dptID']) && !empty($_POST['name']) 
    && !empty($_POST['position']) && !empty($_POST['email'])){
        $employeeID = $_POST['EmployeeID'];//get  the value from input name
        $Name = $_POST['name'];
        $Position = $_POST['position'];
        $Email = $_POST['email'];
        $SupervisorID = $_POST['SupervisorID'];
        $DepartmentID = $_POST['dptID'];

        $query3 = "SELECT * FROM employee WHERE employeeID = '$employeeID'";//find the employee already in the database
        $run3 = mysqli_query($conn, $query3);
        if (mysqli_num_rows($run3) > 0) {
            // Employee ID already exists, show an error message and stop the registration process
            echo '<script>alert("Employee ID already used. Please choose a different ID.");window.location="RegisterEmployee.php"</script>';
            exit();
        } else {
            //EmployeeID not exists , then insert into database
            $query = "INSERT into employee(employeeID, password, name, position, email, FWAStatus, departmentID, supervisorID) 
            values ('$employeeID', '123' , '$Name','$Position', '$Email' ,'New', '$DepartmentID','$SupervisorID')";
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            $query2 = "SELECT * FROM employee WHERE employeeID='$SupervisorID'";//check the supervisor is exist or not
            $run2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($run2)) 
            {
                $_SESSION['EmpID']=$employeeID;
            }
            
            $query3 = "SELECT * FROM employee WHERE supervisorID=' '";// supervisor have employeeID but not need fill in the supervisorID 
            $run3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($run3)) 
            {
                $_SESSION['EmpID']=$employeeID;// set the $_SESSION then can get this variable in other page
            }
    }
        if($run){
            //if the query run then show this alert
                echo'<script>alert("Employee Registeration submitted successfully!"); window.location="successEmployee.php";</script>';
        }
        else{
            //the query not run mean cannnot save into database. show this alert
            echo'<script>alert("Employee Registeration not submitted"); window.location="RegisterEmployee.php";</script>';
        }
    }
    else{
        //if the column are required not fill in will show this alert
        echo'<script>alert("All fields are required"); window.location="RegisterEmployee.php";</script>';
 }
}


?>