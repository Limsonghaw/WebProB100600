<?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <link rel="stylesheet" href="RegisterEmployee.css"/>
</html>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <main>
    <br><br><br><br><br>
    <h1>Employee Registration</h1>

    <div class="container">

      <figure>
        <img src="registerImage.png" width=100% height=100%  alt="employeeImage">
      </figure>

    <form  method="POST" action="DRegisterEmployees.php" enctype="multipart/form-data">
        <label ><b>Department</b></label>
        <select name="dptID" id="dptID" >
            <option value=""></option>
            <option value="IT">ICT01</option>
            <option value="Accounting">ACC02</option>
            <option value="Marketing">MKT03</option>
            <option value="Finance">FIN04</option>
          </select> 

          <label><b>Department Name: </b> <span id="dptName"></span></label><br>

        <label for="EmployeeID"><b>EmployeeID</b></label>
        <input type="text" placeholder="Enter EmployeeID(Example:EMP01)" name="EmployeeID" id="empID" required>

          <label for="name"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" id="name" required>


            <label for="position"><b>Position</b></label>

            <select name="position" id="position">
            <option value=""></option>
          </select>

            <p></p>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            
            <label for="SupervisorID"><b>SupervisorID</b></label>
            <input type="text" placeholder="Enter SupervisorID" name="SupervisorID" id="SupervisorID" >


          <button type="submit" class="registerbtn" id="submit" name="submit">Register</button>

    </form>
</div>
<script type="text/Javascript" src="registerEmployee.js"></script>
</main>


</body>

<footer>
  &copy; FlexIS 2023
</footer>

<!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>