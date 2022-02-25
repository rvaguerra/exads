<?php

use Rodrigo\Exads\Database;
use Rodrigo\Exads\ABTesting;
use Rodrigo\Exads\Multiples;
use Rodrigo\Exads\AsciiArray;
use Rodrigo\Exads\TVSeriesExercise\TVSeriesExercise;

require 'vendor/autoload.php';

// Prime Numbers Exercise
Multiples::exercise();

// ASCII Array Exercise
AsciiArray::exercise();

//
// TV Series Exercise
//
// Create a PDO instance and pass it to the Database class.
//
// Default settings for PDO connection:
// dsn          => mysql:host=localhost
// username     => root
// password     => root
//
// It can be overridden by specifying a new PDO instance:
Database::setInstance(new \PDO(
    'mysql:host=localhost',
    'root',
    'root'
));

$databaseName = 'exads_tv_series';
TVSeriesExercise::setup($databaseName);
TVSeriesExercise::exercise();

// A/B Testing Exercise
ABTesting::exercise();
