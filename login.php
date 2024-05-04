<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="alert.css">
    <script src="alert.js"></script>
    <title>Login</title>
  </head>
  <body>


  <?php

  require 'partials/_nav.php'


  ?>
  
<h1 class="text-center mt-2">LOGIN</h1>
<div class="container mt-4 w-75"> 
    <form action="login.php" method="post" id="login_form" >
        <div class="mb-4 row align-items-end">
            <input type="text" class="form-control" id="username" name="username" placeholder="USERNAME" required>
            
            <!-- <input type="hidden" id="username_hidden" name="username_hidden"> -->
        </div>
        <div class="mb-4 row align-items-end">
            <input type="password" class="form-control" id="Password" name="Password" placeholder="PASSWORD" required >
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-outline-success" id="submit_btn" >LOGIN</button>
        </div>
    </form>
</div>

<?php
  $login = false;
  $showErr = false; 
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
      require 'partials/_dbconnect.php';
      $username = $_POST["username"];
      $password = $_POST["Password"];

      $sql = "SELECT * FROM users WHERE username = '$username'";
      $result = mysqli_query($con , $sql);
      $num = mysqli_num_rows($result);
      if ($num == 1 )
      {
        while($row=mysqli_fetch_assoc($result))
        {
          if(password_verify($password , $row['password']))
          {
          $login = true;
          session_start();
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          header("location: welcome.php");
          exit;
        }
        else 
        {
          $showErr = true; 
          echo ' <div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert">
          <strong>Error !</strong> Invalid Credentials
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
          // header("Location: login.php");
        }
      }
      }
      else 
      {
        $showErr = true; 
        echo ' <div class="alert alert-primary alert-dismissible fade show fixed-top" role="alert">
        <strong>Error !</strong> There is a problem in server
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        // header("Location: login.php");
      }
  }



?>






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    -->
  </body>
</html>