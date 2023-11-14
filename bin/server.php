#!/usr/local/opt/php@7.4/bin/php -q
<?php
declare(strict_types=1);

use josegonzalez\Dotenv\Loader;

require dirname(__DIR__) . '/vendor/autoload.php';

$envFile = dirname(__DIR__) . '/.env';
$dotenv = new Loader([$envFile]);
$dotenv->parse()->toEnv()->toServer();

$serverPort = env('DEV_PORT');

$case = $argv[1] ?? null;
$cmd = '';

switch ($case) {
    case 'start':
        $cmd = './bin/cake server -p ' . $serverPort;
        exec($cmd);
        break;

    case 'open':
        $cmd = 'open http://localhost:' . $serverPort;
        exec($cmd);
        break;

    default:
        echo "Invalid server command. Commands are 'start' or 'open'" . PHP_EOL;
}
