# IncognitoServer

Study project POWER that includes Raspberry Pi, Android and PHP WebServer. <br />

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development.

### Prerequisites

Programs and frameworks needed to run this server
```
[XAMPP](https://www.apachefriends.org/download.html) - XAMPP for PHP 7.1.*
```

```
[Composer](https://getcomposer.org/) - composer to get needed libraries for PHP
```

```
*OPTIONALLY* [NetBeans for PHP](https://netbeans.org/kb/docs/php/quickstart.html) - IDE for PHP
```


### Installing

Follow [this](https://netbeans.org/kb/docs/php/configure-php-environment-windows.html#installConfigureXAMPP) steps to sucessfully install XAMPP pack <br />
*OPTIONALLY* Follow [this](https://netbeans.org/kb/docs/php/quickstart.html) steps to install and configure Netbeans for PHP<br />

Firstly start Apache and MySQL services through XAMPP Control Panel<br />

Now clone repo to xampp/htdocs/ folder <br />
```
git clone https://github.com/jacekkulis/IncognitoServer
```

Open browser and check if server is accessible
```
Write url in browser: http://localhost/IncognitoServer
```


Server is now running and scripts can be accessed by Raspberry and Android

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

none for now

## Built With

* [Composer](https://getcomposer.org/) - Dependency Manager for PHP<br />
* [GuzzleHTTP](http://docs.guzzlephp.org/en/stable/) - PHP HTTP client<br />
* [XAMPP](https://www.apachefriends.org/download.html) - XAMPP WebServer

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


