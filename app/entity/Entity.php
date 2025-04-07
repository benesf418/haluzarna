<?php

namespace app\entity;

use app\support\Database;
use SQLite3;

abstract class Entity {
    
    protected function getDb(): SQLite3 {
        return Database::getDb();
    }

}