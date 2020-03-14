<?php


class Apart extends Controller {


    public function index(string $id = '') {
        if (empty($id)) {
            $apartObject = $this->model(__CLASS__.'s');
            print_r($apartObject->list());
        } else if (is_numeric($id) && $id !== 0) {
                echo $id;
        } else {
           echo $id;
        }
    }

}