#!/usr/bin/php -q
<?php
declare(strict_types=1);

use josegonzalez\Dotenv\Loader;

require dirname(__DIR__) . '/vendor/autoload.php';

$envFile = dirname(__DIR__) . '/.env';
$dotenv = new Loader([$envFile]);
$dotenv->parse()->toEnv()->toServer();

$subdomain = env('APP_PREFIX');
$port = env('DEV_PORT');

$case = $argv[1] ?? null;
$cmd = sprintf('ssh -R %s:80:localhost:%s serveo.net', $subdomain, $port);
echo "$cmd\n";
echo "Tunneling through https://{$subdomain}.serveo.net/\n";
exec($cmd);
