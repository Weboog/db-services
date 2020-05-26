<?php


class City extends Controller {

    public function index() {
       Response::send($this->model()->list());
    }

}