# IncognitoServer

Study project POWER that includes Raspberry Pi, Android and PHP WebServer. <br />

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development.

### Prerequisites

Programs and frameworks needed to run this server
* [XAMPP](https://www.apachefriends.org/download.html) - XAMPP WebServer for PHP 7.1.*<br />
* [Composer](https://getcomposer.org/) - Dependency Manager for PHP


### Installing

1. Follow [this](https://netbeans.org/kb/docs/php/configure-php-environment-windows.html#installConfigureXAMPP) steps to install XAMPP pack for **Windows**.<br />
Follow [this](https://ubuntuforums.org/showthread.php?t=223410) steps to install XAMPP pack for **Linux**.<br />
2. Start Apache and MySQL services through XAMPP Control Panel or console<br />
3. Now clone repo to xampp/htdocs/ folder
```
git clone https://github.com/jacekkulis/IncognitoServer
```
4. Open browser and check if server is accessible
```
Write url in browser: http://localhost/IncognitoServer
```
5. Install composer https://getcomposer.org/download/<br />
6. Use composer download dependencies [link](https://getcomposer.org/doc/01-basic-usage.md) 
```
go to composer.json directory
composer install
composer update
```
7. Server is now setup and running,scripts can be accessed by Raspberry and Android.

### POST request format

Send HTTP POST with format like:
```
"keyName" : "value"
```
We need few info send through post:<br />

Identificator:
```
"id" : "generated id"
```

Info about client (who wants anything) for example:
```
"client" : "raspberry"
"client" : "android"
```

Info about what client needs for example:
```
"request" : "notification"
"request" : "cameraPreview"
```

It can be send with JSON format.

## Deployment

Access scripts from Android using local adress http://10.0.2.2/directory/scriptName.php.<br />
From Raspberry Pi use 

## Built With

* [GuzzleHTTP](http://docs.guzzlephp.org/en/stable/) - PHP HTTP client<br />
* [name](link) - info

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


