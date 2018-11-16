<?php
/**
 * Created by PhpStorm.
 * User: tuanle
 * Date: 11/11/18
 * Time: 15:53
 */
    session_start();

    use google\appengine\api\users\User;
    use google\appengine\api\users\UserService;
    $user = UserService::getCurrentUser();

    if (!isset($user)) {
        header("Location: login.php");
    }
