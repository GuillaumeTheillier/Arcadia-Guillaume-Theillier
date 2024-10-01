<?php

require __DIR__ . 'vendor/autoload.php';

$client = new MongoDB\Client('mongodb://mongodb-deployment:27017');

$database = $client->selectDatabase('Arcadia');

$database->selectCollection('arcadia');
