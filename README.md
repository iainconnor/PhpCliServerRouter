# PHP CLI Server Router

A simple library to expose the [PHP CLI Webserver](http://php.net/manual/en/features.commandline.webserver.php) via an Artisan command for use in [Laravel](https://www.laravel.com) and [Lumen](https://lumen.laravel.com) applications.

This implementation also enhances the default usage of the webserver by redirecting trailing slashes and allowing file requests to be handled by your application.

## Installation

From composer, `composer require iainconnor/php-cli-server-router`.

## Usage

1. Add the `PhpCliServerRouterServiceProvider` in [Laravel](https://laravel.com/docs/5.4/providers#registering-providers) or [Lumen](https://lumen.laravel.com/docs/5.4/providers#registering-providers).
2. Run `artisan php-cli-server:up`.
3. Open your browser to `http://localhost:8000`.