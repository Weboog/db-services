<?php


class Response {


    private static $DATA = [];

    public static function send($data): void {
        header('Content-Type: application/json');
        if (!is_null($data) && is_array($data)) {
            self::$DATA = json_encode(array_merge(self::$DATA, ['data' => $data]));
            echo self::$DATA;
        } else {
            self::$DATA = json_encode(['error' => ['message' => 'ERROR_NOT_FOUND']]);
            echo self::$DATA;
        }

    }

}