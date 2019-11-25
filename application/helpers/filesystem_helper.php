<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: FIRAT
 * Date: 20.10.2018
 * Time: 9:09 AM
 */

// helper with class
class filesystem_helper
{
    //protected $ci;

    public function __construct()
    {
        //Get an Instance of CodeIgniter
        //$this->ci =& get_instance();
    }

    public static function getFolderContents($dirPath, $excluded = [])
    {
        $result = (object)["success" => false, "data" => null, "message" => null];
        try {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') $dirPath .= '/';
            // FRT NOTE: glob() doesn't read .htaccess files, so used readdir()
            $items = [];
            foreach (scandir($dirPath, SORT_DESC) as $file) {
                if (($file == '.') || ($file == '..') || in_array($file, $excluded)) continue;
                $items[] = (object)[
                    "name" => $dirPath . $file,
                    "type" => filetype($dirPath . $file),
                    "extension" => pathinfo($dirPath . $file, PATHINFO_EXTENSION)
                ];
            }
            $result->data = $items;
            $result->success = true;
        } catch (Exception $e) {
            $result->message = $e->getMessage();
        }
        return $result;
    }

    public static function copyFolderToAnother($src, $dst)
    {
        $result = (object)["success" => false, "data" => null, "message" => null];
        try {
            if (substr($src, strlen($src) - 1, 1) != '/') $src .= '/';
            if (substr($dst, strlen($dst) - 1, 1) != '/') $dst .= '/';
            $dir = opendir($src);
            if (!is_dir($dst)) mkdir($dst);
            while (false !== ($file = readdir($dir))) {
                if (($file == '.') || ($file == '..')) continue;
                if (is_dir($src . $file)) {
                    self::copyFolderToAnother($src . $file, $dst . $file);
                } else {
                    copy($src . $file, $dst . $file);
                }
            }
            closedir($dir);
            $result->success = true;
        } catch (Exception $e) {
            $result->message = $e->getMessage();
        }
        return $result;
    }

    public static function deleteDir($dirPath)
    {
        $result = (object)["success" => false, "data" => null, "message" => null];
        try {
            if (!is_dir($dirPath)) {
                throw new InvalidArgumentException("$dirPath must be a directory");
            }
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') $dirPath .= '/';
            $gfc = self::getFolderContents($dirPath);
            if (!$gfc->success) {
                $result->message = $gfc->message;
                return $result;
            }
            foreach ($gfc->data as $item) {
                if (is_dir($item->name)) {
                    self::deleteDir($item->name);
                } else {
                    unlink($item->name);
                }
            }
            rmdir($dirPath);
            $result->success = true;
        } catch (Exception $e) {
            $result->message = $e->getMessage();
        }
        return $result;
    }

}