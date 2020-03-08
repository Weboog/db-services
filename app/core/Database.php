<?php


class Database {

    const SERVER = 'incoloriadesign19853.ipagemysql.com';
    const DB = 'incoloria';
    const USER = 'pub';
    const PASS = 'Locatia_Devteam27';

    private $pdo = null;

    public static function PDO(): PDO {
        try {
            return $pdo = new PDO('mysql:host='.static::SERVER.';dbname='.static::DB, static::USER, static::PASS);
        } catch (PDOException $e) {
            throw new PDOException('Cannot connect to Database!');
        }
    }

}