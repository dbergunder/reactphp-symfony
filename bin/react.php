<?php

ini_set('memory_limit', '1G');

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;

require __DIR__.'/../vendor/autoload.php';

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

$env = $_SERVER['APP_ENV'] ?? 'dev';
$debug = (bool) ($_SERVER['APP_DEBUG'] ?? ('prod' !== $env));

if ($debug) {
    umask(0000);
    Debug::enable();
}

// Initialize kernel
$kernel = new Kernel($env, $debug);

$httpFoundationFactory = new HttpFoundationFactory();
$psr7Factory = new DiactorosFactory();

// Callback for the loop
$callback = function(Psr\Http\Message\ServerRequestInterface $request) use ($kernel, $httpFoundationFactory, $psr7Factory) {
    // Convert the Psr Request to Symfony Request
    $response = $kernel->handle($httpFoundationFactory->createRequest($request));

    // Convert the Symfony response to Psr response
    return $psr7Factory->createResponse($response);
};

$loop = React\EventLoop\Factory::create();

$server = new React\Http\Server($callback);

$socket = new React\Socket\Server(8080, $loop);
$server->listen($socket);

$loop->run();