<?php
/**
 * Created by PhpStorm.
 * User: tuanle
 * Date: 11/18/18
 * Time: 01:55
 */
    session_start();

    use google\appengine\api\users\User;
    use google\appengine\api\users\UserService;
    $user = UserService::getCurrentUser();

    if (!isset($user)) {
        header("Location: login.php");
    } else {
        $dataAsArray = file('gs://s3574983-asm1-bucket/lecturers.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $dataAsArray[$_SESSION['position']] = "{$_SESSION['id']},{$_SESSION['fname']},{$_SESSION['lname']},{$_SESSION['gender']},{$_SESSION['age']}";
        $fp = fopen('gs://s3574983-asm1-bucket/lecturers.csv', 'w');
        fwrite($fp, implode("\n", $dataAsArray));
        fclose($fp);
        header("Location: ../manage_lecturers.php");
    }