<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Daily Schedule</title>
    <link rel="stylesheet" href="UpdateDS.css"/>
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
      <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">

          <!-- logo -->
          <a class="navbar-brand" href="homeE.php">
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
                        <a href="homeE.php" class="list-group-item list-group-item-action" aria-current="true">
                          Dashboard
                        </a>
                        <a href="submitFWA.php" class="list-group-item list-group-item-action">Submit FWA</a>
                        <a href="UpdateDS.php" class="list-group-item list-group-item-action active">Update Daily Schedule</a>
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
    <h1>Update Daily Schedule</h1>
    <br>

    <div class="container">
  

    <form  method="POST" id="FDate" enctype="multipart/form-data">
        <label for="date"><b>Date</b></label>
        <!-- use the php limit the date at current date can't choose before today date -->
        <input class="form-control" type="date" id="Date" name="INPUTDATE"  min="<?php echo date('Y-m-d'); ?>">
        
        <button type="submit" id="buttonShowForm" name="SubmitDate" onclick="ShowForm()">CHECK</button>  


    </form>
        
    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "flexis";

        $conn = mysqli_connect($server, $username, $password, $dbname);
        

        if(isset($_POST["SubmitDate"])){
          $EmpD = $_POST["INPUTDATE"];//get the date employee choose
          $_SESSION['Date']=$EmpD;//get the employeeID from LogIn.php

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);//check the database is connected or not
        }
        //gst the information from database
        $query3 = "SELECT * FROM fwarequest JOIN updatedailyschedule USING (employeeID) where employeeID='$employeeID' and status='accepted' and Date='$EmpD'";
        $run3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
        $count = mysqli_num_rows($run3);

        if($count > 0){
          while($row = mysqli_fetch_assoc($run3)){
        ?>
          <!-- print the information found in database -->
          <div class="row" id="addedDS">
            <div id="empInfo" class="col-sm-6 col-md-6 col-lg-6">

            <h6>Daily schedule on : <?php echo $row['Date'];?></h6>

            <h6>Work Location : <?php echo $row['WorkLocation'];?></h6>

            <h6>Work Hours : <?php echo $row['WorkHours'];?></h6>

            <h6>Work Report : <?php echo $row['WorkReport'];?></h6>

            <h6>RequestID : <?php echo $row['requestID'];?></h6>


          </div>

        <?php
        }
      }else{ ?>
      <!-- not found the information in database will print this sentence. -->
        <h6>Notice </h6>
            <p><?php echo "No daily schedule on this date: ".$EmpD ."<br>". "Please fill in below form and submit."?></p>
       <?php
      }
}?>
      

<form action="SaveUpdateDS2.php" method="POST" >

        <label for="WorkLocation"><b>Work Location:</b></label>
        <select name="WorkLocation" id="WorkLocation" required>
            <option value=" "> </option>
            <option value="Office">Office</option>
            <option value="Home">Home </option>
        </select>

        <label for="WorkHours"><b>Work Hours:</b></label>
        <select name="WorkHours" id="WorkHours" required>
            <option value=" "> </option>
            <option value="8am – 4pm">8am – 4pm</option>
            <option value="9am – 5pm">9am – 5pm </option>
            <option value="10am – 6pm">10am – 6pm</option>
        </select>

        <label for="WorkReport"><b>Work Report:</b></label>
        <input type="text" placeholder="Enter Work Report" name="WorkReport" id="WorkReport" required>
       

            
          <button type="submit" class="registerbtn" id="submit" name="SubmitButton">Submit</button>  
    </form>


   







<script type="text/Javascript" src="UpdateDS.js"></script>
</main>

    
        
    
</body>

<br>
<footer>
  &copy; FlexIS 2023
</footer>


<!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>