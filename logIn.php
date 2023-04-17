<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    
</html>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="logIn.css"/>
</head>

<body>
    
  <header>
     <!-- Navbar -->
     <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">

      <a class="navbar-brand" href="#">
        <img
          src="Flexis.png"
          height="50"
          alt="FlexIS Logo"
          loading="lazy"
        />
      </a>
      <h2>FlexIS</h2>

    </div>
    </nav>
  
    </header>
    <main>
    <br><br><br><br><br>
    <h1>FlexIS Login</h1>
    <br><br>
    <div class="container">


    <form  method="POST" action="loginCheck.php" enctype="multipart/form-data">
        <label for="EmployeeID"><b>EmployeeID</b></label>
        <input type="text" placeholder="Enter EmployeeID(Example:EMP01)" name="EmployeeID" id="empID" required>

        <label for="Password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="Password" id="Password" required>

          <button type="submit" class="registerbtn" id="submit" name="submit">Log in</button>

    </form>
</div>
<script type="text/Javascript" src="registerEmployee.js"></script>
</main>

</body>

<footer class="fixed-bottom">
  &copy; FlexIS 2023
</footer>

<!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>