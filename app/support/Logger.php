<?php

namespace app\support;

use DateTime;

class Logger {
    static function log(string $message) {
        $now = new DateTime();
        $nowFormatted = $now->format('Y-m-d H:i:s');
        file_put_contents('temp/log.txt', "\n[$nowFormatted] $message", FILE_APPEND);
    }
}