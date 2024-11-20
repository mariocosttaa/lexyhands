<?php

function errorReporting($error): void
{
    if (isset($_ENV['ERROR_REPORTING'])) {
      
        if ($_ENV['ERROR_REPORTING'] == 'log') { 
            $logFile = dirname(__DIR__, 2) . '/logs/errorReporting/' . date('Ymd') . '.log';
            $message = date('H:i:s') . ' - ' . $error . PHP_EOL;
            file_put_contents($logFile, $message, FILE_APPEND);
        } else {
            echo $error;
        }

    } else {
        echo $error;
    }
}
