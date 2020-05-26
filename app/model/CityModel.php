<?php


class CityModel extends Database {

    public function list() {
        return $this->find();
    }

    public function get(string $id) {
        return $this->findOne(['id' => $id]);
    }

}