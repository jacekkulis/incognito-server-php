# IncognitoServer

Study project POWER that includes Raspberry Pi, Android and PHP WebServer. <br />

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposeses on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
Give examples
```

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

### Installing

A step by step series of examples that tell you have to get a development env running<br />

Say what the step will be<br />

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo

## Deployment

none for now

## Built With

* [Composer](https://getcomposer.org/) - Dependency Manager for PHP<br />
* [GuzzleHTTP](http://docs.guzzlephp.org/en/stable/) - PHP HTTP client

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


