<?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="sycHome.css">

    <title>Home</title>
</head>
<body>
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
                        <a href="homeE.php" class="list-group-item list-group-item-action active" aria-current="true">
                          Dashboard
                        </a>
                        <a href="submitFWA.php" class="list-group-item list-group-item-action ">Submit FWA</a>
                        <a href="UpdateDS.php" class="list-group-item list-group-item-action">Update Daily Schedule</a>
                        <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                    </div>
                </nav>
            </div>
          </div>
        </div>
    </nav>

    </header>

    <main>
    <div class="container-fluid">
        <br><br><br><br><br>
        <h1 class="text">Welcome to Flexis!</h1>
        <h4 class="text"><?php echo $employeeID?></h4>
        <br>
        <div class="container-fluid" id="home">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <button class="homeBtn" onclick='parent.location="#info"'> Profile </button> <br>
                <button class="homeBtn" onclick='location.href="submitFWA.php"'> FWA Request </button> <br>
                <button class="homeBtn" onclick='location.href="UpdateDS.php"'> Daily Schedule </button>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <img src="person.png" alt="Pic" id="pic"/>
              </div>
          </div>
        </div>

        <br>
            <div class="info" id="info">
                <h4>Profile</h4><br>

                <!-- function to get and show the logged in employee details -->
                <?php
                    $server = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "flexis";
                    define('SITEURL', 'http://localhost/flexis');

                    $conn = mysqli_connect($server, $username, $password, $dbname);

                    $sql = "SELECT * FROM employee where employeeID = '$employeeID'";

                    $run = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($run);

                    if($count > 0){
                        while($row = mysqli_fetch_assoc($run)){
                            $eid = $row['employeeID'];
                            $ename = $row['name'];
                            $position = $row['position'];
                            $email = $row['email'];
                            $status = $row['FWAStatus'];
                            ?>
                            <div class="container-fluid">
                            <div class="row">
                                <div id="empInfo" class="col-sm-6 col-md-6 col-lg-6">

                                    <h6>Employee ID : </h6>
                                    <p><?php echo $eid;?></p>

                                    <h6>Name : </h6>
                                    <p><?php echo $ename;?></p>

                                    <h6>Position : </h6>
                                    <p><?php echo $position;?></p>

                                    <h6>FWA Status :</h6>
                                    <p><?php echo $status;?></p>

                                    <h6>Email Address :</h6>
                                    <p><?php echo $email;?></p>

                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                      <form action="editEmpInfo.php" method="POST" enctype="multipart/form-data">

                                            <h5>
                                              Edit Personal Info
                                            </h5>

                                            <div class="form-group">
                                              <label>Name</label>
                                              <input class="form-control form-control-lg" type="text" name ="name" />
                                            </div><br>

                                            <div class="form-group">
                                              <label>Change Password</label>
                                              <input class="form-control form-control-lg" type="text" name = "password" />
                                            </div><br>

                                            <div class="form-group mb-0">
                                              <input
                                                type="submit"
                                                class="btn btn-primary"
                                                value="Update"
                                                name = "updateInfo"
                                              />
                                            </div>
                                      </form>
                                    </div>

                            </div>
                            </div>
                    <?php
                        }
                    }
                ?>
            </div>
    </div>



    </div>
    </main>
    <br><br><br>
    <footer class="fixed-bottom">
      &copy; FlexIS 2023
    </footer>


      <!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>