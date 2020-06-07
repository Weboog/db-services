<?php


class ApartModel extends Database {

//    private $table = __CLASS__;

    public function list(array $criteria = []) {
        return $this->find($criteria);
    }
    public function get(string $id) {
        return $this->getApart($id); 
    }

    public function createApart(array $data) {
        return $this->addApart($data);
    }

    public function incrementViewCount(string $id){
        $this->increment(['id' => $id]);
    }

}