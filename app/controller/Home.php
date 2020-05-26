<?php


class Home extends Controller {

    public function index() {
        header('Content-Type: application/json');
        echo json_encode(['id' => 1, 'name' => 'Abell']);
    }

}