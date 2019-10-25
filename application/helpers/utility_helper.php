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

    public static function returnJson($obj)
    {
        header('Content-Type: application/json');
        echo json_encode($obj);
    }

    public static function getArrayItemById($array, $id, $idField = 'id')
    {
        foreach ($array as $item) {
            if ($item->$idField === $id) return $item;
        }
        return null;
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

}