<?php


class Controller
{

    public function model($controller = '') {


        if ($controller !== '') {
            $name = ucfirst($controller).'Model';
        } else {
            $name = get_class($this).'Model';
        }
        if (file_exists('../app/model/'.$name.'.php')) {
            require_once '../app/model/'.$name.'.php';
            return new $name;
        }

    }

}