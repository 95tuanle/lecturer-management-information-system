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
    } else {
        require_once 'php/google-api-php-client/vendor/autoload.php';
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

        <div class="container text-dark">
            <h2>BigQuery of Lecturers</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Frequency</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $client = new Google_Client();
                    $client->useApplicationDefaultCredentials();
                    $client->addScope(Google_Service_Bigquery::BIGQUERY);
                    $bigquery = new Google_Service_Bigquery($client);
                    $projectId = 's3574983-asm1';
                    $request = new Google_Service_Bigquery_QueryRequest();
                    $dataAsArray = file('gs://s3574983-asm1-bucket/lecturers.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    for ($position = 0; $position < count($dataAsArray); $position++) {
                        $fields = explode(",", $dataAsArray[$position]);
                        $request->setQuery("SELECT name , SUM(count) as freq FROM [baby.baby_names] WHERE name = '$fields[1]' GROUP BY name ORDER BY freq;");
                        $response = $bigquery->jobs->query($projectId, $request);
                        $rows = $response->getRows();
                        $x = $rows[0]['f'][1]['v'];
                        echo "<tr>";
                        echo "<td>$fields[0]</td>";
                        echo "<td>$fields[1]</td>";
                        echo "<td>$fields[2]</td>";
                        echo "<td>$fields[3]</td>";
                        echo "<td>$fields[4]</td>";
                        echo "<td>$x</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <br>
        <footer class="page-footer font-small lighten-5"">
            <div class="footer-copyright text-center text-black-50 py-3">
                <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le</p>
            </div>
        </footer>
    </body>
</html>