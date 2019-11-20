<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: FIRAT
 * Date: 20.10.2018
 * Time: 9:09 AM
 */

// helper with class
class uri_helper
{
    //protected $ci;

    public function __construct()
    {
        //Get an Instance of CodeIgniter
        //$this->ci =& get_instance();
    }

    // function that creates URI string from real string
    public static function create_uri_string($string)
    {
        // for turkish chars
        $searchArray = array("ö", "ğ", "ı", "ç", "ü", "ş", "Ç", "Ğ", "İ", "Ö", "Ş", "Ü");
        $replaceArray = array("o", "g", "i", "c", "u", "s", "c", "g", "i", "o", "s", "u");
        $string = str_replace($searchArray, $replaceArray, $string);

        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $string);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

        if (!$clean) $clean = "unknown";

        return trim($clean, "-");
    }

    // LINK GENERATIONS - BEGIN
    public static function generateRouteLink($routeName, $params = [])
    { // FRT WARNING: Works for maximum 10 parameters (which means index range [0-9])
        $url = '';
        foreach ($GLOBALS['linkableRoutes'] as $lr) {
            if ($lr->routeName == $routeName) {
                $anyPositions = \utility_helper::findAllOccurenceIndexes($lr->key, '(:any)');
                $numPositions = \utility_helper::findAllOccurenceIndexes($lr->key, '(:num)');
                $positions = array_merge($anyPositions, $numPositions);
                sort($positions);

                if (count($positions) != count($params)) return $url; // same length validation

                $url = $lr->key;
                for ($i = 0; $i < count($positions); $i++) {
                    $url = substr_replace($url, "{{" . $i . "}}}", $positions[$i], 6);
                }
                for ($i = 0; $i < count($params); $i++) {
                    if (gettype($params[$i]) == "string") $params[$i] = self::create_uri_string($params[$i]);
                    $url = str_replace("{{" . $i . "}}}", $params[$i], $url);
                }
                return '/' . $url;
            }
        }
        return $url;
    }

    public static function correctMalformedURI($expectedURI)
    {
        if ($_SERVER["REDIRECT_URL"] != $expectedURI) { // correct malformed URI
            $queryString = $_SERVER["QUERY_STRING"] ? '?' . $_SERVER["QUERY_STRING"] : '';
            header("Location: " . $expectedURI . $queryString, true, 301); // 301: Moved Permanently
            exit();
        }
    }
    // LINK GENERATIONS - END
}