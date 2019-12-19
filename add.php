<?php
    session_start();
    $link = mysqli_connect("localhost","root","toor","first_db");
    if($_SESSION['user']) {

    }
    else {
        header("location: index.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $details = mysqli_real_escape_string($link, $_POST['details']);
        $time = strftime("%X");
        $date = strftime("%B %d %Y");
        $decision = "no";

        foreach ($_POST['public'] as $each_check) {
            if ($each_check != null) {
                $decision = "yes";
            }
        }

        mysqli_query($link, "INSERT INTO list (details, date_posted, time_posted, public)
        VALUES ('$details','$date','$time','$decision')");

        header("location: home.php");
    }

    else {
        header("location: home.php");
    }

    mysqli_close($link);
?>