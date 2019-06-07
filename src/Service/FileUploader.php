<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class FileUploader
 * @package App\Service
 */
class FileUploader
{
    /**
     * @var String
     */
    private $directory;

    /**
     * FileUploader constructor.
     * @param $directory
     */
    public function __construct(String $directory)
    {
        $this->directory = $directory;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
            $file->move($this->getDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        return $fileName;
    }

    /**
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }
}
