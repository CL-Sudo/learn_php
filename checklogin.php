<?php
    session_start();
    
    $link = mysqli_connect("localhost","root","toor","first_db") or die(mysqli_error($link));

    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    $query = mysqli_query($link, "SELECT * FROM users WHERE username
    = '$username'");

    $exist = mysqli_num_rows($query);
    $table_users = "";
    $table_password = "";

    if($exist > 0) {
            $row = mysqli_fetch_assoc($query);
            $table_users = $row['username'];
            $table_password = $row['password'];
        
        if (($username == $table_users) && ($password == $table_password)) {                  
                $_SESSION['user'] = $username;
                header("location: home.php");           
        }
        else {
            Print '<script>alert("Incorrect Password!");</script>';
            Print '<script>window.location.assign("login.php");</script>';
        }
    }

    else {
        Print '<script>alert("Incorrect Username!");</script>';
        Print '<script>window.location.assign("login.php");</script>';
    }

    mysqli_close($link);
?>