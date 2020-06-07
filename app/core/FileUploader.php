<?php


class FileUploader {

    const TYPE_JPG = 'jpg';
    const IMG_MAX_SIZE = 5242880;
    private $_upload_folder = '';
    private $_file_directory = '';
    private $_files = [];

    public function __construct(string $folder, array $files) {
        $this->_upload_folder = '../../locatia/assets/media/' . $folder;
        $this->_files = array_merge($files);
        $this->_file_directory = $this->createFileDirectory();
    }

    public function save(): array {
        foreach ($this->_files as $file) {
            $basename =  $file['name'][0];
            $extension =  pathinfo($basename, PATHINFO_EXTENSION);
            $size = $file['size'][0];
            if ( $extension === self::TYPE_JPG && $size <= self::IMG_MAX_SIZE) {
                // Verify for file existence
                $new_file = $this->_file_directory.'/'.$basename;
                $i = 0;
                while (file_exists($new_file)) {
                    $new_file = preg_replace('/-[0-9]/', '-'.$i, $new_file);
                    $i++;
                }
                // Move uploaded file with new name
                if (move_uploaded_file($file['tmp_name'][0], $new_file)) {
                    return ['saved' => true];
                } else {
                    return ['saved' => false];
                }
            } else {
                return ['error' => 'not allowed type or size'];
            }
        }
    }

    private function createFileDirectory(): string {
        $filename = pathinfo($this->_files['gallery']['name'][0], PATHINFO_FILENAME);
        $directory = $this->_upload_folder . '/' . preg_replace('/-[0-9]$/', '', $filename);
        if (!file_exists($directory)) {
            mkdir($directory);
        }
        return $directory;
    }

}