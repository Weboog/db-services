<?php


class ActionModel extends Database {

    public function list() {
        return $this->find();
    }

}