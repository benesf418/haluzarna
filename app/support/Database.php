<?php

namespace app\support;

use SQLite3;

class Database {

    const DB_FILE = 'db.db';
    const CREATE_DB_QSL_FILE = 'createDb.sql';

    static $db;

    public static function getDb(): SQLite3 {
        if (self::$db == null) {
            self::$db = new SQLite3('db.db');
        }
        return self::$db;
    }

    /**
     * Creates / resets the database to baseline
     */
    public static function createDb() {
        $query = file_get_contents(self::CREATE_DB_QSL_FILE);
        self::getDb()->exec($query);
        echo 'databaze byla stvorena/resetovana';
    }
}