<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>IncognitoServer - strona główna</title>
    <link rel="stylesheet" href="css/index.css?<?php echo time(); ?>" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar  navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Strona główna!</a>
        </div>
    </div>
</nav>


<div class="container-fluid text-center">
    Wyślij notyfikacje
    <form method="POST">
        Tytuł: <input type="text" name="title"><br>
        Zawartość: <input type="text" name="text"><br>
        <input type="submit" name="sendNotification" value="SEND NOTIFICATION" />
    </form>
</div>

<?php
//on localhost
require "vendor/autoload.php";
//on webhost
//require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";

    if (isset($_POST['sendNotification'])){
        if (!empty($_POST['title']) && !empty($_POST['text'])){

            echo '<div class="container-fluid bg-3 text-center">';
            try {
                $notification_sender = new \incognito\NotificationSender();
                $response = $notification_sender->sendNotification($_POST['title'], $_POST['text']);
                echo 'Notification is sent successfully: ". '.$response->getBody()->getContents();
            } catch (Exception $ex) {
                echo 'Error: ' .$ex->getMessage();
            }
            echo '</div>';
        }
        else {
            echo '<div class="container-fluid bg-3 text-center">';
            echo 'Title or text was not set, sending custom notification'.'</br>';

            $notification_sender = new \incognito\NotificationSender();
            $response = $notification_sender->sendNotification('default title', 'default body');
            echo 'Notification is sent successfully: ". '.$response->getBody()->getContents();
            echo '</div>';
        }
    }
?>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center" id="footer">
    <p>2017. Theme Made By IncognitoDevs (source: <a href="http://www.w3schools.com">www.w3schools.com</a>)</p>
</footer>

</body>
</html>

