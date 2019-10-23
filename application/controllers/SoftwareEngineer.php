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

        //echo json_encode($data);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $data,
        ));
    }

    public function contact()
    {
        $outputs = [];

        if (!isset($_POST['name']) || !$_POST['name']) $outputs[] = "error-name";
        if (!isset($_POST['email']) || !$_POST['email']) $outputs[] = "error-email";
        if (!isset($_POST['message']) || !$_POST['message']) $outputs[] = "error-message";

        if (count($outputs) == 0) {
            // do something here
            $outputs[] = "success";
        }

        echo implode(",", $outputs);
    }

}
