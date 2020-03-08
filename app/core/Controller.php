<?php


class Controller
{

    public function model($name) {

        $name = ucfirst($name);
        if (file_exists('../app/model/'.$name.'.php')) {
            require_once '../app/model/'.$name.'.php';
            return new $name;
        }

    }

}