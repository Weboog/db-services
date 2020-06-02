<?php


class FileUploader {

    const TYPE_JPG = 'jpg';
    const IMG_MAX_SIZE = 5242880;
    private $_upload_folder = '';
    private $_files = [];

    public function __construct(string $folder, array $files) {
        $this->_upload_folder = 'assets/' . $folder;
        $this->_files = array_merge($files);
    }

    public function save() {
        foreach ($this->_files as $file) {
            $basename =  $file['name'][0];
            $extension =  pathinfo($basename, PATHINFO_EXTENSION);
            $size = $file['size'][0];
            if ( $extension === self::TYPE_JPG && $size <= self::IMG_MAX_SIZE) {
                move_uploaded_file($file['tmp_name'][0], $this->_upload_folder . '/' .$basename);
            }
        }
    }

}