<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: FIRAT
 * Date: 20.10.2018
 * Time: 9:09 AM
 */

// helper with class
class image_helper
{
    //protected $ci;

    public function __construct()
    {
        //Get an Instance of CodeIgniter
        //$this->ci =& get_instance();
    }

    // save uploaded image directly to a folder
    public static function saveUploadedImage($file, $pathToSave)
    {
        $result = (object)['success' => false, 'message' => null, 'data' => null];
        $nowStr = DateTime::createFromFormat('U.u', microtime(true))->setTimezone(new DateTimeZone('Europe/Istanbul'))->format("Ymd_His_u");
        $fileNameToSave = substr($nowStr, 0, strlen($nowStr) - 2) . "_" . $file['name'];
        move_uploaded_file($file['tmp_name'], $pathToSave . $fileNameToSave); // directly copy to folder (without processing)
        $result->success = true;
        return $result;
    }

    // process blog image
    public static function processUploadedImage_forBlog($file, $pathToSave, $convertTo = "")
    {
        require_once 'application/third_party/ImageUpload/class.upload.php';
        $result = (object)['success' => false, 'message' => '', 'data' => null];
        $nowStr = DateTime::createFromFormat('U.u', microtime(true))->setTimezone(new DateTimeZone('Europe/Istanbul'))->format("Ymd_His_u");
        ini_set('memory_limit', '256M');
        $handle = new \Verot\Upload\Upload($file);
        if ($handle->uploaded) {
            $handle->file_new_name_body = substr($nowStr, 0, strlen($nowStr) - 2) . "_thumb_" . $handle->file_src_name_body;
            $handle->image_resize = true;
            $handle->image_x = 260;
            $handle->image_y = 260;
            $handle->image_ratio = true;
            $handle->image_no_enlarging = true;
            if ($convertTo) $handle->image_convert = $convertTo;
            $handle->process($pathToSave);
            $result->success = $handle->processed;
            if ($result->success) {
                $result->message .= 'thumb created\n';
            } else {
                $result->message .= 'error while thumb creation: ' . $handle->error . '\n';
            }
        }
        if ($result->success) { // if thumb creation succeeded > then create big one
            $handle->file_new_name_body = substr($nowStr, 0, strlen($nowStr) - 2) . "_big_" . $handle->file_src_name_body;
            $handle->image_resize = true;
            $handle->image_x = 1080;
            $handle->image_y = 1080;
            $handle->image_ratio = true;
            $handle->image_no_enlarging = true;
            if ($convertTo) $handle->image_convert = $convertTo;
            $handle->process($pathToSave);
            $result->success = $handle->processed;
            if ($result->success) {
                $result->message .= 'big created\n';
                $handle->clean();
            } else {
                $result->message .= 'error while big creation: ' . $handle->error . '\n';
            }
        }
        return $result;
    }

}