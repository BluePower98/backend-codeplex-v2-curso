<?php
/* @var Illuminate\Foundation\Application $app */

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

$services = include config_path("services.php");

$domains = $services['domains'];

if (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
    $domain = $_SERVER['HTTP_HOST'];

    $env = null;

    switch ($domain) {
        case $domains['develop']:
            $env = ".env.develop";
            break;

        case $domains['test']:
            $env = ".env.test";
            break;

        case $domains['production']:
            $env = ".env.production";
            break;
    }

    if ($env) {
        $dotenv = Dotenv::createImmutable(base_path(), $env);

        try {
            $dotenv->load();
        } catch (InvalidPathException $e) {

        }
    }
}

