<?php


class Period extends Controller {

    public function index() {
        Response::send($this->model()->list());
    }

}