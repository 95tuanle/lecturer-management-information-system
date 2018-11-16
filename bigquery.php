<?php
/**
 * Created by PhpStorm.
 * User: tuanle
 * Date: 11/11/18
 * Time: 14:52
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
        <title>BigQuery</title>
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
            <img src="assets/images/banner.png" class="img-fluid">
        </div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top justify-content-center">
            <a class="navbar-brand" href="home.php"><img src="assets/images/logo.png" width="30" height="30"></a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="add_lecturer.php">Add lecturer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_lecturers.php">Manage lecturers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="bigquery.php">BigQuery</a>
                </li>
                <li class="nav-item">
                    <?php
                        echo sprintf('<a href="%s" class="nav-link">Sign out</a>', UserService::createLogoutUrl('/'));
                    ?>
                </li>
            </ul>
        </nav>
        <br>

        <br>
        <footer class="page-footer font-small lighten-5"">
            <div class="footer-copyright text-center text-black-50 py-3">
                <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le</p>
            </div>
        </footer>
    </body>
</html>