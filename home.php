<?php
/**
 * Created by PhpStorm.
 * User: tuanle
 * Date: 11/10/18
 * Time: 21:16
 */
    session_start();

    use google\appengine\api\users\User;
    use google\appengine\api\users\UserService;
    $user = UserService::getCurrentUser();

    if (!isset($user)) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lecturer Management Information System</title>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="jumpotron-fluid">
            <img src="assets/images/banner.jpg" class="img-fluid">
        </div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <a class="navbar-brand" href="home.php"><img src="assets/images/logo.png" width="50" height="50"></a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add lecturer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manage lecturers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">BigQuery</a>
                </li>
                <li class="nav-item">
                    <?php
                        echo sprintf('<a href="%s" class="nav-link">Sign out</a>', UserService::createLogoutUrl('/'));
                    ?>
                </li>
            </ul>
        </nav>

    </body>
</html>

