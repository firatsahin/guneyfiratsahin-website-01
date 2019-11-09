<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoftwareEngineer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function index()
    {
        $data = json_decode(file_get_contents('frt_data.json'));

        // generate formatted date
        $data->personalInfo->birthDate->formatted = DateTime::createFromFormat('!m', $data->personalInfo->birthDate->month)->format('F') . ' ' . $data->personalInfo->birthDate->day . ', ' . $data->personalInfo->birthDate->year;

        // fix social profile links
        foreach ($data->personalInfo->socialProfiles as $p) {
            $contactName = $p->name;
            $p->link = str_replace("{{username}}", $data->contactInfo->$contactName, $p->link);
        }

        // get related things to projects
        foreach ($data->portfolio->projects as $p) {
            if (isset($p->relatedExperienceId) && $p->relatedExperienceId) $p->relatedExperience = utility_helper::getArrayItemById($data->resume->experience, $p->relatedExperienceId);
            if (isset($p->relatedEducationId) && $p->relatedEducationId) $p->relatedEducation = utility_helper::getArrayItemById($data->resume->education, $p->relatedEducationId);
            if (isset($p->images) && is_array($p->images)) {
                foreach ($p->images as $img) { // get thumb img from big img prop (if doesn't exist)
                    if ((!isset($img->thumbImg) || !$img->thumbImg) && isset($img->bigImg) && $img->bigImg) $img->thumbImg = $img->bigImg;
                }
            }
        }

        //echo json_encode($data);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $data,
            "isBlog" => false,
            "pageTitle" => $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local . ' | ' . $data->personalInfo->title . ' Personal Web Page'
        ));
    }

    public function contact()
    {
        $inObj = json_decode(file_get_contents('php://input'));
        $outObj = (object)['success' => false, 'message' => null, 'data' => null];

        foreach ($inObj as $key => $value) {
            if (gettype($value) == "string") $inObj->$key = trim($value);
        }

        $errors = [];
        if (!isset($inObj->name) || !$inObj->name) $errors[] = (object)["colname" => "name", "errorType" => "required"];
        if (!isset($inObj->email) || !$inObj->email) $errors[] = (object)["colname" => "email", "errorType" => "required"];
        else if (!filter_var($inObj->email, FILTER_VALIDATE_EMAIL)) $errors[] = (object)["colname" => "email", "errorType" => "invalid"];
        if (!isset($inObj->serviceTypes) || !is_array($inObj->serviceTypes) || count($inObj->serviceTypes) == 0) $errors[] = (object)["colname" => "serviceTypes", "errorType" => "required"];
        if (!isset($inObj->message) || !$inObj->message) $errors[] = (object)["colname" => "message", "errorType" => "required"];

        if (count($errors) == 0) {
            // send email to yourself here
            $mailBody = "<br />";
            $mailBody .= "<b>Sender's Name :</b> " . $inObj->name;
            $mailBody .= "<br /><br />";
            if (isset($inObj->companyName) && $inObj->companyName) {
                $mailBody .= "<b>Company Name :</b> " . $inObj->companyName;
                $mailBody .= "<br /><br />";
            }
            $mailBody .= "<b>Sender's Email Address :</b> " . $inObj->email;
            $mailBody .= "<br /><br />";
            $mailBody .= "<b>Desired Service Types :</b> " . implode(", ", $inObj->serviceTypes);
            $mailBody .= "<br /><br />";
            $mailBody .= "<b>Desired Employment Type :</b> " . $inObj->employType;
            $mailBody .= "<br /><br />";
            if (isset($inObj->budgetAmount) && $inObj->budgetAmount) {
                $mailBody .= "<b>Budget :</b> " . $inObj->budgetAmount . " " . $inObj->budgetCurrency . " " . $inObj->budgetPeriod;
                $mailBody .= "<br /><br />";
            }
            $mailBody .= "<b>Sender's Message :</b><br /><br />" . str_replace("\n", "<br />", $inObj->message);
            $mailBody .= "<br /><br /><i>Sent by guneyfiratsahin.com contact form.</i>";

            //echo $mailBody; return; // DEBUG: TEST HTML OUTPUT

            $outObj->success = utility_helper::sendMail("guneyfiratsahin@gmail.com", "Message from guneyfiratsahin.com Contact Form", $mailBody);
            if (!$outObj->success) $outObj->message = "An error occured while sending your message. Please try again later.";
        } else {
            $outObj->message = "Some form errors occured above. Please fix them and try again.";
        }
        $outObj->errors = $errors;
        utility_helper::returnJson($outObj);
    }

}
