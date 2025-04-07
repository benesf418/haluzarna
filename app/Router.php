<?php

namespace app;

class Router {
    static function route(string $path) {
        switch ($path) {
            case '':
                require 'app/frontend/homepage.php';
                break;
            default:
                require 'app/frontend/errors/404.php';
                break;
        }
    }
}