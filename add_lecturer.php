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

    $idErr = $fnameErr = $lnameErr = $genderErr = $ageErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $count = 0;
        if (empty($_POST["id"])) {
            $idErr = "ID is required";
        } else {
            $count += 1;
        }
        if (empty($_POST["fname"])) {
            $fnameErr = "First name is required";
        } else {
            $count += 1;
        }
        if (empty($_POST["lname"])) {
            $lnameErr = "Last name is required";
        } else {
            $count += 1;
        }
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $count += 1;
        }
        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
        } else {
            $count += 1;
        }
        if ($count == 5) {
            header("Location: actions/add_lecturer_action.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Lecturer</title>
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
                    <a class="nav-link active" href="add_lecturer.php">Add lecturer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_lecturers.php">Manage lecturers</a>
                </li>
                <li class="nav-item">
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
        <div class="container-fluid">
            <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method="post">
                <div class="form-group">
                    <input placeholder="ID" class="form-control" type="number" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : '' ?>">
                    <span class="error">* <?php echo $idErr;?></span>
                </div>
                <div class="form-group">
                    <input placeholder="First name" class="form-control" type="text" name="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                    <span class="error">* <?php echo $fnameErr;?></span>
                </div>
                <div class="form-group">
                    <input placeholder="Last name" class="form-control" type="text" name="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
                    <span class="error">* <?php echo $lnameErr;?></span>
                </div>
                <div class="form-check">
                    <input type="radio" name="gender" value="F" <?php if ($_POST['gender']=="F") {echo "checked";} ?> id="F">
                    <label for="F">Female</label>
                    <input type="radio" name="gender" value="M" <?php if ($_POST['gender']=="M") {echo "checked";} ?> id="M">
                    <label for="M">Male</label>
                    <span class="error">* <?php echo $genderErr;?></span>
                </div>
                <div class="form-group">
                    <input placeholder="Age" class="form-control" type="number" name="age" value="<?php echo isset($_POST['age']) ? $_POST['age'] : '' ?>">
                    <span class="error">* <?php echo $ageErr;?></span>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
        <br>
        <footer class="page-footer font-small lighten-5"">
            <div class="footer-copyright text-center text-black-50 py-3">
                <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le</p>
            </div>
        </footer>
    </body>
</html>