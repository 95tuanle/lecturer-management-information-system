<?php
/**
 * Created by PhpStorm.
 * User: tuanle
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
  <title>Manage Lecturers</title>
  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <link rel="icon" href="assets/logo.png" type="image/png"
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
    <li class="nav-item active">
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
<div class="container text-dark">
  <h2>Lecturers</h2>
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Gender</th>
      <th>Age</th>
      <th>Update or Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $dataAsArray = file('gs://s3574983-asm1-bucket/lecturers.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    for ($position = 0; $position < count($dataAsArray); $position++) {
        $fields = explode(",", $dataAsArray[$position]);
        echo "<tr>";
        echo "<td>$fields[0]</td>";
        echo "<td>$fields[1]</td>";
        echo "<td>$fields[2]</td>";
        echo "<td>$fields[3]</td>";
        echo "<td>$fields[4]</td>";
        echo "<td><a type='button' class='btn btn-warning text-dark' href='update_lecturer.php?position=$position'>Update</a><a type='button' class='btn btn-danger text-dark' href='actions/delete_lecturer_action.php?position=$position'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
  </table>
</div>
<br>
<footer class="page-footer font-small lighten-5"
">
<div class="footer-copyright text-center text-black-50 py-3">
  <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le</p>
</div>
</footer>
</body>
</html>