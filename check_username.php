<?php
// Assume you have a database connection established


$servername = "localhost";
$username = "root";
$password = "";
$database = "users";
$insert= false;



$con = mysqli_connect($servername , $username , $password , $database);

if($con)
{
    $insert =true;
}
else
{
    die("error" . mysqli_connect_error());
}


if(isset($_POST['username'])){
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Username exists
        echo 'not_available';
    } else {
        // Username is available
        echo 'available';
    }
}

$con->close();
?>
