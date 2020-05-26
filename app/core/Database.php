<?php


class Database {

//    const SERVER = 'incoloriadesign19853.ipagemysql.com';
//    const DB = 'locatia_2c202877ba1e';
//    const USER = 'weboog_2c202877';
//    const PASS = 'Locatia-Dev27!';
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
        $this->where($criteria);
        $req = 'SELECT * FROM ' . $this->table() . self::$where;
        $stm = self::getInstance()->prepare($req);
        $stm->execute(self::$execArray);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    //Find all results matching criteria
    public function find($criteria = []) {
        $this->where($criteria);
        $req = 'SELECT * FROM ' . $this->table() . self::$where;
        $stm = self::getInstance()->prepare($req);
        $stm->execute(self::$execArray);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    //
    public function create(array $data) {
        $req = 'INSERT INTO ' . $this->table() . ' (';
        $keys = '';
        $values = '';
        $exec = [];
        foreach ($data as $key => $value) {
            $keys .= $key. ', ';
            $values .= '?, ';
            $exec[] = $value;
        }
        $keys = rtrim($keys, ', ');
        $values = rtrim($values, ', ');
        $req .= $keys;
        $req .= ') VALUES (';
        $req .= $values;
        $req .= ')';
        $stm = self::getInstance()->prepare($req);
        return $stm->execute($exec);
//        print_r($stm->errorInfo());
    }

    public function addApart(array $data): array {
        try {
            $id = bin2hex(random_bytes(17));
        } catch (Exception $e) {}
        $req = 'CALL build_human_id(' . $data['city'] . ', @hui); INSERT INTO ' . $this->table() . ' (';
        $keys = '';
        $values = '';
        foreach ($data as $key => $value) {
            $keys .= $key. ', ';
            $values .= "'$value'" . ', ';
        }
        //Extra adds for human id
        $keys .= 'human_id, id';
        $values .= '@hui, ' . "'$id'";
        ////////////////////////
        $keys = rtrim($keys, ', ');
        $values = rtrim($values, ', ');
        $req .= $keys;
        $req .= ') VALUES (';
        $req .= $values;
        $req .= ')';
        $stm = self::getInstance()->prepare($req);
        if ($stm->execute()) {
            return ['affected' => $stm->rowCount(), 'id' => $id ];
        } else {
            print_r($stm->errorInfo());
        }
//        echo $req;
    }

    private function table() {
        return strtolower(str_replace('Model', '', get_class($this)));
    }

    private function where(array $criteria) {
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