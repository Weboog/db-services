<?php


class Aparts extends Database {

    public $_aparts = [
        ['id' => '857124693', 'price' => 450],
        ['id' => '740256710', 'price' => 300],
        ['id' => '870312548', 'price' => 250],
        ['id' => '236884107', 'price' => 350]
    ];

    public function list() {
//        return parent::PDO();
        return $this->_aparts;
    }

}