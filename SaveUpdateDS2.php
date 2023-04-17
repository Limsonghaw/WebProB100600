

<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);


if(isset($_POST['SubmitButton'])){//when click the button
    if  ( !empty($_POST['WorkLocation']) 
    && !empty($_POST['WorkHours']) && !empty($_POST['WorkReport'])){//check the input is not null
        $EmpD  = $_SESSION['Date'];//get the value from UpdateDS.php
        $EmpWL = $_POST['WorkLocation'];//get the value from name
        $EmpWH = $_POST['WorkHours'];
        $EmpWR = $_POST['WorkReport'];

        
        $logInEmp = $_SESSION['employeeID'];
        
        $query2 = "SELECT * FROM fwarequest where employeeID='$logInEmp' and status='accepted'";
        $run2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));


        while($row = mysqli_fetch_array($run2))
        {
            $Request_ID = $row['requestID'];
            

        }

        if(empty($Request_ID)){
            echo'<script>alert("You have not submitted FWA request or it is still pending"); window.location="UpdateDS.php";</script>';
        }
        else{
            $query3 = "SELECT * FROM updatedailyschedule where employeeID='$logInEmp' and requestID = '$Request_ID' and Date ='$EmpD'";
            $run3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
            $count = mysqli_num_rows($run3);
    
            if($count > 0){
            while($row = mysqli_fetch_array($run3)){
                $dateFound= true;
            }}else{
                $dateFound = false;
            }
    
            if($dateFound){
                $query = "UPDATE updatedailyschedule set WorkLocation='$EmpWL' , WorkHours='$EmpWH' , WorkReport='$EmpWR' where  employeeID='$logInEmp' and requestID = '$Request_ID' and Date ='$EmpD'";
            }else{
                $query = "INSERT into updatedailyschedule(Date, WorkLocation, WorkHours, WorkReport, requestID,employeeID) values ('$EmpD', '$EmpWL' , '$EmpWH', '$EmpWR','$Request_ID','$logInEmp')";
            }

            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
            if($run){
                echo'<script>alert("Update successfully!"); window.location="homeE.php";</script>';
            }
            else{
                echo'<script>alert("Update not successfully"); window.location="UpdateDS.php";</script>';
            }
        }

    }
    else{
        echo'<script>alert("All fields are required"); window.location="UpdateDS.php";</script>';
   }
}
else{
    echo'<script>alert("All fields are required"); window.location="UpdateDS.php";</script>';
}

?>