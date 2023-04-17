<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="sycFWA.css">

    <title>Submit FWA</title>
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
                        <a href="homeE.php" class="list-group-item list-group-item-action" aria-current="true">
                          Dashboard
                        </a>
                        <a href="submitFWA.php" class="list-group-item list-group-item-action active">Submit FWA</a>
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
        <h1>FWA Request Confirmation </h1>

        <br>

        <div class="FWArequest">
        <?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "flexis";
            define('SITEURL', 'http://localhost/flexis');

            $conn = mysqli_connect($server, $username, $password, $dbname);

            //sql query to get the last row of fwarequest table (newest FWA request that the employee just submitted) from the database
            $sql = "SELECT * FROM fwarequest ORDER BY requestID DESC LIMIT 1";

            //Execute the sql query in the database
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);  //return the number of rows of the results return from the query

            if($count > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $requestID = $row['requestID'];
                    $prefix = $row['prefix'];
                    $date = $row['requestDate'];
                    $status = $row['status'];
                    $worktype = $row['workType'];
                    $comment = $row['comment'];
                    $description = $row['description'];
                    $reason = $row['reason'];

                    ?>
                    <div class="form-wrap max-width-700 mx-auto">
                        <h6 style="color:blue;">Request ID &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $prefix.$requestID; ?></h6>
                        <h6 style="color:blue;">Request Date : <?php echo $date; ?></h6>
                        <h6 style="color:blue;">Status &emsp;&emsp;&emsp;&nbsp;: <?php echo $status; ?></h6>
                        <br><hr>

                        <h5>FWA Request Details</h5>
                        <hr>
                        <h6 >Work Type </h6>
                        <p><?php echo $worktype; ?></p>

                        <h6>Description </h6>
                        <p><?php echo $description; ?></p>

                        <h6>Reason </h6>
                        <p><?php echo $reason; ?></p>
                        <hr>

                        <div class="text-end">
                        <button class="btnSubmit" onclick="window.location='submitFWA.php'">
                          Confirm
                        </button>
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

    <footer>
      &copy; FlexIS 2023
    </footer>


      <!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>