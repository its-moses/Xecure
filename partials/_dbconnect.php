<?php





$servername = "localhost";
$username = "root";
$password = "";
$database = "users";



$con = mysqli_connect($servername , $username , $password , $database);

if($con)
{
    $insert =true;
}
else
{
    die("error" . mysqli_connect_error());
}

?>