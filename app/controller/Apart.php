<?php


class Apart extends Controller {

    const ACTION_RENT = '1';
    const ACTION_BUY = '2';


    public function index(string $id = '') {

        if ($_SERVER['REQUEST_METHOD'] === self::METHOD_GET) {

            if (empty($id)) {
                $this->getAll();
            } else {
                $this->getDetails($id);
            }

        }

        if ($_SERVER['REQUEST_METHOD'] === self::METHOD_POST) {
            $this->create();
        }

    }

    public function rent(): void {
        if ($_SERVER['REQUEST_METHOD'] === self::METHOD_GET) {
            $this->getAll(['action' => self::ACTION_RENT]);
        }
    }

    public function buy(): void {
        if ($_SERVER['REQUEST_METHOD'] === self::METHOD_GET) {
            $this->getAll(['action' => self::ACTION_BUY]);
        }
    }

    public function increment($id){
        $this->model()->incrementViewCount($id);
    }

    //Get all aparts
    private function getAll(array $action = []): void {
        Response::send($this->model()->list($action));
//        echo json_encode(['what' => 'Show all aparts : '.$action_type]);
    }

    //Get apart by id
    private function getDetails($id) {
        $scan = scandir('../../locatia/assets/media/gallery/' . $id);
        unset($scan[0]);
        unset($scan[1]);
        $scan = array_values($scan);
        $data = $this->model()->get($id);
        $data['images'] = $scan;
        Response::send($data);
//        echo json_encode(['what' => 'Show apart id : '.$id]);
    }


    private function create() {
        if (!empty($_FILES)) {
            $uploader = new FileUploader('gallery', $_FILES);
            $status = $uploader->save();
            Response::send($status);
        } else {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $stm = $this->model()->createApart($data);
            echo json_encode($stm);
        }

    }

}