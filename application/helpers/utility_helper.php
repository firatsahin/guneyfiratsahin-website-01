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

    public static function getDateNow($modify = '0 days')
    {
        return DateTime::createFromFormat('U.u', microtime(true))->setTimezone(new DateTimeZone('Europe/Istanbul'))->modify($modify)->format("Y-m-d H:i:s.u");
    }

    // add single file reference with version info
    public static function includeVersionedReference($uri)
    {
        $serverPath = $_SERVER["DOCUMENT_ROOT"] . $uri;
        if (file_exists($serverPath)) {
            return $uri . '?v=' . filemtime($serverPath);
        } else return $uri;
    }

    public static function returnJson($obj)
    {
        header('Content-Type: application/json');
        echo json_encode($obj);
    }

    public static function returnJsonAndExit($obj)
    {
        self::returnJson($obj);
        exit();
    }

    public static function getArrayItemById($array, $id, $idField = 'id')
    {
        foreach ($array as $item) {
            if ($item->$idField === $id) return $item;
        }
        return null;
    }

    // get full site domain (considering https too) (with a trailing slash)
    public static function getSiteUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        return $protocol . $domainName;
    }

    public static function getLastModOfAFile($filePath)
    {
        $serverPath = $_SERVER["DOCUMENT_ROOT"] . $filePath;
        if (file_exists($serverPath)) {
            return date('Y-m-d H:i:s.u', filemtime($serverPath));
        } else return null;
    }

    public static function sendMail($recipientAddress,$subject,$mailBody)
    {
        $result = false;

        //$ci =& get_instance();

        require_once 'application/third_party/PHPMailer/Exception.php';
        require_once 'application/third_party/PHPMailer/PHPMailer.php';
        require_once 'application/third_party/PHPMailer/SMTP.php';

        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                               // Enable verbose debug output (only for debug purpose)
            $mail->isSMTP();                                                    // Set mailer to use SMTP
            $mail->Host = SMTP_SETTINGS['host'];                                // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                             // Enable SMTP authentication
            $mail->Username = SMTP_SETTINGS['username'];                        // SMTP username
            $mail->Password = SMTP_SETTINGS['password'];                        // SMTP password (decode from encrypted value)
            $mail->Port = 587;                                                  // TCP port to connect to
            $mail->CharSet = \PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;      // necessary for Turkish chars to be fine

            //Sender
            $mail->setFrom(SMTP_SETTINGS['username'], 'guneyfiratsahin.com');

            //Recipients (can be multiple)
            $mail->addAddress($recipientAddress); // Name is optional

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $mailBody;

            $result = $mail->send();
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public static function findAllOccurenceIndexes($haystack, $needle)
    { // returns all occurence indexes of a needle string in another string | returns array containing all indexes
        $lastPos = 0;
        $positions = [];
        while (($lastPos = strpos($haystack, $needle, $lastPos)) !== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($needle);
        }
        return $positions;
    }

    public static function redirectAndExit($uri)
    {
        header("Location: $uri");
        exit();
    }

    public static function nullableStrValForSql($val)
    {
        $val = trim($val);
        $normalized = $val ? "'" . str_replace("'", "''", $val) . "'" : 'null';
        return $normalized;
    }

}