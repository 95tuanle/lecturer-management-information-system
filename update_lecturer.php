<?php
/**
 * Created by PhpStorm.
 * User: tuanle
 * Date: 11/18/18
 * Time: 01:54
 */
    session_start();

    use google\appengine\api\users\User;
    use google\appengine\api\users\UserService;
    $user = UserService::getCurrentUser();

    if (!isset($user)) {
        header("Location: login.php");
    } else {
        $idErr = $fnameErr = $lnameErr = $genderErr = $ageErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $count = 0;
            if (empty($_POST["id"])) {
                $idErr = "ID is required";
                $_SESSION['id'] = $_POST['id'];
            } else {
                $count += 1;
                $_SESSION['id'] = $_POST['id'];
            }
            if (empty($_POST["fname"])) {
                $fnameErr = "First name is required";
                $_SESSION['fname'] = $_POST['fname'];
            } else {
                $count += 1;
                $_SESSION['fname'] = $_POST['fname'];
            }
            if (empty($_POST["lname"])) {
                $lnameErr = "Last name is required";
                $_SESSION['lname'] = $_POST['lname'];
            } else {
                $count += 1;
                $_SESSION['lname'] = $_POST['lname'];
            }
            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
                $_SESSION['gender'] = $_POST['gender'];
            } else {
                $count += 1;
                $_SESSION['gender'] = $_POST['gender'];
            }
            if (empty($_POST["age"])) {
                $ageErr = "Age is required";
                $_SESSION['age'] = $_POST['age'];
            } else {
                $count += 1;
                $_SESSION['age'] = $_POST['age'];
            }
            if ($count == 5) {
                header("Location: actions/update_lecturer_action.php");
            }
        }

        $dataAsArray = file('gs://s3574983-asm1-bucket/lecturers.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($_GET['position'] != null) {
            $_SESSION['position'] = $_GET['position'];
            $lecturer = explode(',',$dataAsArray[$_SESSION['position']]);
            $_SESSION["id"] = $_POST["id"] = $lecturer[0];
            $_SESSION["fname"] = $_POST["fname"] = $lecturer[1];
            $_SESSION["lname"] = $_POST["lname"] = $lecturer[2];
            $_SESSION["gender"] = $_POST["gender"] = $lecturer[3];
            $_SESSION["age"] = $_POST["age"] = $lecturer[4];
        } else {
            $_POST["id"] = $_SESSION["id"];
            $_POST["fname"] = $_SESSION["fname"];
            $_POST["lname"] = $_SESSION["lname"];
            $_POST["gender"] = $_SESSION["gender"];
            $_POST["age"] = $_SESSION["age"];
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Lecturer</title>
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
            <img src="assets/banner.png" class="img-fluid">
        </div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top justify-content-center">
            <a class="navbar-brand" href="home.php"><img src="assets/logo.png" width="30" height="30"></a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="add_lecturer.php">Add lecturer</a>
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
                <button type="submit" class="btn btn-primary">Update</button>
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