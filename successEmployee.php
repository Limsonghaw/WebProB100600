<?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information</title>
    
</html>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="successEmployee.css"/>

</head>

<body>
    
<header>
      <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">

          <!-- logo -->
          <a class="navbar-brand" href="homeH.php">
            <img
              src="Flexis.png"
              height="50"
              alt="FlexIS Logo"
              loading="lazy"
            />
          </a>

          <!-- title -->
          <h2 style = "position:fixed; left:80px;">FlexIS</h2>
          <h4><?php echo $employeeID?></h4>

          <!-- menu -->
          <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#flexisMenu" aria-controls="flexisMenu">
            Menu
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="flexisMenu" aria-labelledby="menuLabel">
            <div class="offcanvas-header">
              <h4 class="offcanvas-title" id="menuLabel">FlexIS</h4>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <nav id="sidebarMenu">
                    <div class="list-group">
                        <a href="homeH.php" class="list-group-item list-group-item-action" aria-current="true">
                          Dashboard
                        </a>
                        <a href="RegisterEmployee.php" class="list-group-item list-group-item-action active">Register Employee</a>
                        <a href="viewAnalytics.php" class="list-group-item list-group-item-action">View FWA Analytics</a>
                        <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                    </div>
                </nav>
            </div>
          </div>
        </div>
    </nav>

    </header>

    <?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);

$regEmp = $_SESSION['EmpID'];//get employeeID form RegisterEmployee.php

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM employee where employeeID='$regEmp'";
$result = mysqli_query($conn, $query);


?>

<?php

  while($row = mysqli_fetch_assoc($result)) 
  {
    $superv=$row["supervisorID"];
    $query2 ="SELECT name FROM employee where employeeID='$superv'";
    $result2 = mysqli_query($conn, $query2);

?>

    <main>
    <br><br><br>
    <h1>Employee Information</h1>
    <br>
    <div class="container">

    <!-- print the employee information what fill in in RegisterEmployee.php -->
    <div id="form">
        <label for="EmployeeID"><b>EmployeeID: </b></label> &nbsp; <span><?php  echo  $row["employeeID"];?></span> <br>
        <label ><b>Department: </b></label> &nbsp; <?php  echo  $row["departmentID"];?></label> <br>
        <label for="name"><b>Name: </b></label> &nbsp; <?php  echo  $row["name"];?></label><br>
        <label for="position"><b>Position: </b> &nbsp; </label><?php  echo  $row["position"];?></label><br>
        <label for="email"><b>Email: </b></label> &nbsp; <?php  echo  $row["email"];?></label><br>
        <label for="SupervisorID"><b>SupervisorID: </b></label> &nbsp; <?php  echo  $row["supervisorID"];?></label><br>
        <label for="SupervisorID"><b>SupervisorName: </b></label> &nbsp; <?php while($row = mysqli_fetch_assoc($result2)){
        $Sname=$row["name"]; echo $Sname; }?></label>
        <br><br>

        <div class="text-center">
        <button style="width:100%" class="btn btn-success" onclick='location.href="RegisterEmployee.php"'>Confirm</button>
        </div>
<?php

}
?>


    </div>
</div>
</main>


</body>

<footer class="fixed-bottom">
  &copy; FlexIS 2023
</footer>

<!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>