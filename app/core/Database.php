<?php


class Database {

//    const SERVER = 'incoloriadesign19853.ipagemysql.com';
//    const DB = 'incoloria';
//    const USER = 'pub';
//    const PASS = 'Locatia_Devteam27';
    const SERVER = 'localhost';
    const DB = 'locatid_db';
    const USER = 'root';
    const PASS = '';

    private static $pdo = null;
    private static $where;
    private static $execArray = [];

    private static function getInstance(): PDO {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host='.static::SERVER.';dbname='.static::DB, static::USER, static::PASS);
            } catch (PDOException $e) {
                throw new PDOException('Cannot connect to Database!');
            }
            return self::$pdo;
        } else {
            return self::$pdo;
        }
    }

    //Find one result matching criteria
    public function findOne(array $criteria) {
        $this->buildQuery($criteria);
        $table =  strtolower(str_replace('Model', '', get_class($this)));
        $req = 'SELECT * FROM ' . $table . self::$where;
        $stm = self::getInstance()->prepare($req);
        $stm->execute(self::$execArray);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    //Find all results matching criteria
    public function find($criteria = []) {
        $this->buildQuery($criteria);
        $table =  strtolower(str_replace('Model', '', get_class($this)));
        $req = 'SELECT * FROM ' . $table . self::$where;
        $stm = self::getInstance()->prepare($req);
        $stm->execute(self::$execArray);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    private function buildQuery(array $criteria) {
        if (empty($criteria)) {
            $req = '';
        } else {
            $req = ' WHERE ';
        }
        foreach ($criteria as $column => $value) {
            $req .= $column . ' = :' . $column . ' AND ';
            $key = ':'.$column;
            self::$execArray[$key] = $value;
        }
        self::$where = rtrim($req, ' AND ');
    }

}