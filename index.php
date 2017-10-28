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
    if (isset($_POST['sendNotification'])){
        if (!empty($_POST['title']) && !empty($_POST['text'])){
            require "vendor/autoload.php";

            $config = new incognito\Config\Configuration();
            $client = new incognito\PhpFirebaseCloudMessaging\FCMClient();
            $client->setApiKey($config->getApiKey());
            $client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

            $topic = 'notifications';

            $message = new incognito\PhpFirebaseCloudMessaging\Message();
            $message->setPriority('high');
            $message->addRecipient(new incognito\PhpFirebaseCloudMessaging\Recipient\Topic($topic));
            $message
                ->setNotification(new incognito\PhpFirebaseCloudMessaging\Notification($_POST['title'], $_POST['text']))
                ->setData(['key' => 'value'])
            ;

            echo '<div class="container-fluid bg-3 text-center">';
            try {
                $response = $client->send($message);
                echo 'Notification is sent successfully to topic "'.$topic. '". '.$response->getBody()->getContents();
            } catch (Exception $ex) {
                echo 'Error: ' .$ex->getMessage();
            }
            echo '</div>';
        }
        else {
            echo '<div class="container-fluid bg-3 text-center">';
            echo 'Title or text was not set, sending custom notification'.'</br>';
            $result = include 'src/Notify.php';
            echo $result;
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

