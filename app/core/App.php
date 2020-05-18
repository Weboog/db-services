<?php


class App {

    protected $controller = 'Home';
    protected $action = 'index';
    protected $params = [];

    public function __construct() {

        $url = $this->parseUrl();
        $query = $this->parseQuery();

//        var_dump($query);

        if (file_exists('../app/controller/'.ucfirst($url[0]).'.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        require_once '../app/controller/'.ucfirst($this->controller).'.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->action = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ?  array_values($url) : [];
        call_user_func_array([$this->controller, $this->action], array_merge($this->params, $query));
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', rtrim($_GET['url'], '/'));
        }
    }

    private function parseQuery() {
        if (isset($_GET)) {
            unset($_GET['url']);
            return $_GET;
        }
    }

}