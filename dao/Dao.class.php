<?php
abstract class Dao {
    private static $pdo = null;     // static only one connection by process!!

    public static function connect() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(DSN, USER, PASSW);
                self::$pdo->exec('SET NAMES UTF8');
            }
            catch (PDOexception $e) {
                throw new BlogException(0, $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function disconnect() {
        // todo
    }
        // specif!!! ces 4 methodes doivent être implémentées sur toutes les tables
    abstract public function get($option) : array; 
    abstract public function insert (Object $p) : bool;
    abstract public function delete () : bool;
    abstract public function update () : bool;

}