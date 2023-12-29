<?php
/**
 * Created by PhpStorm.
 * User: tuanle
 */
session_start();

use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

$user = UserService::getCurrentUser();

if (isset($user)) {
    header("Location: home.php");
} else {
    echo sprintf('<a href="%s">Sign in with your Google account or register</a>', UserService::createLoginUrl('/'));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>LMIS - Tuan Le</title>
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
</html>