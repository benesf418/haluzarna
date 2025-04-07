<?php

namespace app\entity\user;

class InvalidUsernameException extends \Exception {
    public function __construct($msg = 'invlaid username') {
        parent::__construct($msg);
    }
}