<?php


class Apart extends Controller {


    public function index(string $id = '') {
        if (empty($id)) {
            Response::send($this->model()->list());
        } else {
            Response::send($this->model()->get($id));
        }
    }

}