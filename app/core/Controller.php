<?php


class Controller
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';

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