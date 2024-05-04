<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="./styleFile.css">

<title>signup</title>

</head>

<body>

    <?php

    require 'partials/_nav.php'


    ?>
    <h3 class="text-center mt-2">SIGNUP</h3>
        <div class="container mt-4 w-75">

            <form action="signup.php" method="post" id="signup_form">
                <div class="mb-4 row align-items-end">
                    <input type="text" maxlength="35" class="form-control" placeholder="Enter Your Username"
                        id="username" name="username" required>
                    <span class="d-flex justify-content-end" id="username_msg"></span>

                    <!-- <input type="hidden" id="username_hidden" name="username_hidden"> -->
                </div>
                <div class="mb-4 row align-items-end">
                    <input type="password" maxlength="25" class="form-control" placeholder="Enter Your Password"
                        id="Password" name="Password" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" id="reset_btn" >Reset</button>
                    <button type="submit" class="btn btn-outline-success" id="submit_btn" >Sign Up</button>
                </div>
            </form>

        </div>

<?php

require 'partials/_dbconnect.php';

$found = false; // Initialize the variable

if(isset($_POST['username']) && isset($_POST['Password']) )
{
    $username = $_POST['username'];
    $password = $_POST['Password'];

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Username exists
        $found = true;
    } else {
        // Username is available
        $found = false;}

    if($username !== '' && $password !== '' && $found ==false)
    {

    // Insert new user
    $hash = password_hash($password , PASSWORD_DEFAULT );
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
    $result = mysqli_query($con , $query);
    if($result)
    {
        echo'<div class="toast-container bottom-0 start-0">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header d-flex">
                        <strong class="ms-auto text-success-emphasis">SUCCESS</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Heyyy ! Your Account has been created <a class="text-primary" href="login.php">LOGIN NOW</a>
                    </div>
                </div>
            </div>';

        
    }
    else  {
        echo ' <div class="alert alert-primary alert-dismissible fade show fixed-top" role="alert">
        <strong>ERROR !</strong> Record cannot be inserted .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        
    }
}
else if($found ==true)
{
    echo ' <div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert">
    <strong>Error !</strong> Fill Out Your form Properly
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}
}

?>
                
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="./script.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastEl);

            toastEl.querySelector('.btn-close').addEventListener('click', function() {
                toast.hide();
            });

            toast.show();
        });
    </script>

</body>

</html>