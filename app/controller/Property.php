<?php


class Property extends Controller {

    public function index() {
        Response::send($this->model()->list());
    }

}