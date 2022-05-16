<?php
declare(strict_types=1);

require_once('../vendor/autoload.php');

use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\Promise;

(function () {
    $promise = new FulfilledPromise(function () use (&$promise) {
        echo 'ah!';
        $promise->resolve(null);
    });

    $promise->then(function () {
        echo 'oi!';
        file_put_contents('output.txt', 'Hola!');
    });

    echo 'Something done';
})();
