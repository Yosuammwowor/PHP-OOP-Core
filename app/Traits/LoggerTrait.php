<?php

namespace App\Traits;

trait LoggerTrait
{
    public function logActivity($msg)
    {
        $time = date("Y-m-d H:i:s");
        $logFormat = "[$time] - $msg\n";

        file_put_contents(__DIR__ . "/app.log", $logFormat, FILE_APPEND);
    }
}
