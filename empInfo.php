<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Request Information</title>
    <link rel="stylesheet" href="empInfo.css"/>
</html>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
  ?>

<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">

          <!-- logo -->
          <a class="navbar-brand" href="#">
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
                    <a href="homeS.php" class="list-group-item list-group-item-action " aria-current="true">
                          Dashboard
                        </a>
                        <a href="reviewFWA.php" class="list-group-item list-group-item-action ">Review FWA</a>
                        <a href="reviewS.php" class="list-group-item list-group-item-action active">Review Schedule</a>
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
    <h1>Employee Request Information</h1>
    <br><br>
  <body>

    <div id="dates-container">
    </div>
<?php


$server = "localhost";
$username = "root";
$password = "";
$dbname = "flexis";

$conn = mysqli_connect($server, $username, $password, $dbname);

        $empID=$_GET['employeeID'];//get value from reviewE.php
        $_SESSION['EmpID']=$empID;
        $Date =$_SESSION['SpvDate'];//get value form reviewS.php


        
        $query = "SELECT * FROM updatedailyschedule where employeeID='$empID' and Date='$Date'";
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
        while($employee_row = mysqli_fetch_assoc($run)){
        $workL = $employee_row['WorkLocation'];// get the value from row found
        $workH = $employee_row['WorkHours'];
        $workR = $employee_row['WorkReport'];

?>
    <div class="container">

    <form  method="POST" action="empInfoB.php" enctype="multipart/form-data">
        <!-- print information already in database -->
        <?php echo "<b>Work Location:</b> ".  $workL . "<br>" ;?>
        <?php echo "<b>Work Hours:</b> " . $workH . "<br>" ;?>
        <?php echo "<b>Work Report:</b> " .$workR . "<br>" ;?>
        <label for="Comment"><b>Comment:</b></label>
        <textarea id="Comment" name="Comment" rows="5" cols="50"></textarea>
        <br>
        <button type="submit" class="Commentbtn" id="submit" name="submit">OK</button>
        
    </form>
    </div>
    <?php
        }
?>
</main>

    
        
    
</body>

<footer class="fixed-bottom">
  &copy; FlexIS 2023
</footer>


<!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>