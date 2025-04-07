<?php

namespace app\entity\user;

class UserAlreadyExistsException extends \Exception {
    public function __construct($msg = 'user already exists') {
        parent::__construct($msg);
    }
}