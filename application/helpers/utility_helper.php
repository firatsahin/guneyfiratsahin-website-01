<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: FIRAT
 * Date: 20.10.2018
 * Time: 9:09 AM
 */
// helper with class
class utility_helper
{
    //protected $ci;

    public function __construct()
    {
        //Get an Instance of CodeIgniter
        //$this->ci =& get_instance();
    }

    // add single file reference with version info
    public static function includeVersionedReference($uri)
    {
        $serverPath = $_SERVER["DOCUMENT_ROOT"] . $uri;
        if (file_exists($serverPath)) {
            return $uri . '?v=' . filemtime($serverPath);
        } else return $uri;
    }

}