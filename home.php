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
    ?>

    <body>
        <h2>Home Page</h2>
        <p>Hello <?php Print "$user"?>!</p>
        <a href="logout.php">Click here to logout</a><br/><br/>
        <form action="add.php" method="POST">
            Add more to list: <input type="text" name="detail" value="yes"/><br/>
            public post? <input type="checkbox" name="public[]" value="yes"/><br/>
            <input type="submit" value="Add to list"/>
        </form>
        <h2 align="center">My list</h2>
        <table border="1px" width="100%">
            <tr>
                <th>ID</th>
                <th>Details</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
    </body>
</html>


