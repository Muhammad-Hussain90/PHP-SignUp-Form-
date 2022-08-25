<?php

$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    include 'dbconnect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $sql = "SELECT * from USERS WHERE username = '$username' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 0) {
        if(($password == $cpassword) && $exists==false)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `date`)  VALUES ('$username', '$hash', current_timestamp())";
           
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }
                }
                else{
                    $showError = "Passwords do not match";
                }
    }

    if($num > 0){
        $exists = "Username not available";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

<?php
if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> Success! </strong> Your Account is now created now you can login.
    <button type = "button" class = "close"
    data-dismiss = "alert" aria-label = "Close">
    <span aria-hidden = "true">x</span>
    </button>
    </div>';
}

if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> Error! </strong> '. $showError.'
    <button type = "button" class = "close"
    data-dismiss = "alert" aria-label = "Close">
    <span aria-hidden = "true">x</span>
    </button>
    </div>';
}

if($exists) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert">
    <strong> Error! </strong> ' .$exists.'
    <button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
    <span aria-hidden = "true">x</span>
     </button>
     </div> ' ;
    }
?>

<div class="container my-4">
    <h1 class="text-center">SignUp Here</h1>
    <form action="sign-up.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword">

            <small id="emailHelp" class="form-text text-muted">
                Make sure to type the same password
            </small>
        </div>

        <button type="submit" class="btn btn-primary">
            Sign Up
        </button>
    </form>
</div>

<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
<!-- <script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous">
</script> -->
    
<!-- <script src="
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity=
"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
    crossorigin="anonymous">
</script> -->
    
</body>
</html>