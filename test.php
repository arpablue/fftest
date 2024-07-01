<?php
require_once 'vendor/autoload.php';

use ArpaBlue\FFTest\FileExecutor;


$run = new FileExecutor();

$run->setArguments( $argv );
$run->run();

/*
$vec = $run->getTargetFiles();
echo "...Directorio de ejecucion: " . getcwd() . "\n";
foreach ($vec as $file) {
    echo "... File -> ".$file."\n";
    include_once($file);
}
*/
