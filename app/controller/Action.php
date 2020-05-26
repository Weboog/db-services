<?php


class Action extends Controller {

    public function index(): void {
        Response::send($this->model()->list());
    }

}