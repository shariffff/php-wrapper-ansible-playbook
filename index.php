<?php

use PHPPlay\Plays\Ping;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

require 'vendor/autoload.php';

define('ABSPATH', __DIR__ . '/');

$process = new Process((new Ping)->play('ping.yml')
    ->inventory('165.22.247.194,')
    ->remoteUser('root')
    ->run());

try {
    $process->mustRun();
    echo $process->getOutput();
} catch (ProcessFailedException $exception) {
    echo $exception->getMessage();
}
