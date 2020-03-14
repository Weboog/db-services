<?php


class Home extends Controller {

    public function index() {
        echo 'Home index';
    }

    public function aparts() {
        $modelObject = $this->model('aparts');
        print_r($modelObject->list());
    }

}