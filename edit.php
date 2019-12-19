<html>
    <head>
        <title>My First PHP Website</title>
    </head>
    <?php
        session_start();
        if ($_SESSION['user']) {
        }
        else {
            header("location: index.php");
        }

        $user = $_SESSION['user'];
        $id_exist = false;
    ?>

    <body>
        <h2>Home Page</h2>
        <p>Hello <?php Print "$user"?>!</p>
        <a href="logout.php">Click here to logout</a><br/><br/>
        <a href="home.php">Return to Home page</a><br/><br/>
        <h2 align="center">Currently Selected</h2>
        <table border="1px" width="60%" align="center">
            <tr>
                <th>ID</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Public Post</th>
            </tr>

            <?php
                $link = mysqli_connect("localhost","root","toor","first_db") 
                or die(mysqli_error($link));
                
                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $_SESSION['id'] = $id;
                    $id_exist = true;
                    $query = mysqli_query($link,"SELECT * FROM list WHERE id = '$id'");
                    $count = mysqli_num_rows($query);

                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            Print '<tr>';
                                Print '<td align="center">'. $row['id'].'</td>';
                                Print '<td align="center">'. $row['details'].'</td>';
                                Print '<td align="center">'. $row['date_posted']. "-" .$row['time_posted'].'</td>';
                                Print '<td align="center">'. $row['date_edited']. "-" .$row['time_edited'].'</td>';
                                Print '<td align="center">'. $row['public'].'</td>';                        }
                           Print '</tr>';
                    }
                }

                else {
                    $id_exist = false;
                }
            ?>
        </table>
        <br/>
        <?php
        if ($id_exist) {
            Print '
            <form action="edit.php" method="POST">
                Enter new detail: <input type="text" name="details"/><br/>
                public post? <input type="checkbox" name="public[]" value="yes"/><br/>
                <input type="submit" value="Update List"/>
            </form>
            ';
        }
        else {
            Print '<h2 align="center">There is no data to be edited.</h2>';
        }
        mysqli_close($link);
        ?>
    </body>
</html>

<?php
    $link = mysqli_connect("localhost","root","toor","first_db") 
    or die(mysqli_error($link));
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $details = mysqli_real_escape_string($link, $_POST['details']);
        $public = "no";
        $id = $_SESSION['id'];
        $time = strftime("%X");
        $date = strftime("%B %d %Y");

        foreach ($_POST['public'] as $list) {
            if ($list != null) {
                $public = "yes";
            }
        }
        mysqli_query($link, "UPDATE list SET details = '$details',
                                             public = '$public',
                                             date_edited = '$date',
                                             time_edited = '$time'
                             WHERE id = '$id'");
        
        header("location: home.php");
    }
    mysqli_close($link);
?>