<?php


class PropertyModel extends Database {

    public function list() {
        return $this->find();
    }

}