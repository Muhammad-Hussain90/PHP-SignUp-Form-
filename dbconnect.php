<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "geeks";

$conn = mysqli_connect($servername, $username, $password, $database);

if($conn)
{
    echo "success";
}
else{
    echo "error";
}

?>
