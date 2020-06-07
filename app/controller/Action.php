<?php


class Action extends Controller {

    public function index() {
        Response::send($this->model()->list());
    }

}