<?php
class Database {
    public static function connect($database) {
        include("./../Db.php");
        Db::connect('localhost', $database, 'root', '');
    }
}
?>