<html>
    <head>
        <title>My First PHP website</title>
    </head>
        <body>
            <h2>Registration Page</h2>
            <a href="index.php">Click here to go back</a>
            <form action="register.php" method="POST">
                Enter Username: <input type="text" name="username"
                required="required"/></br>
                Enter Password: <input type="password" name="password"
                required="required" /></br>
                <input type="submit" value="Register"/>
            </form>
        </body>
</html>

<?php
$link = mysqli_connect("localhost","root","toor","first_db");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $bool = true;
    $query = mysqli_query($link,"SELECT * FROM users");

    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {

        $table_users = $row['username'];
        if($username == $table_users) {
            $bool = false;
            Print '<script>alert("Username has been taken");</script>';
            Print '<script>window.location.assign("register.php")</script>';
        }
    }

    if ($bool) {
        mysqli_query($link,"INSERT INTO users(username, password) VALUES ('$username','password')");
        Print '<script>alert("Successfully Registered");</script>';
        Print '<script>window.location.assign("register.php")</script>';
    }

    echo "Username entered is: ". $username . "</br>";
    echo "Password entered is: ". $password;   
}

?>