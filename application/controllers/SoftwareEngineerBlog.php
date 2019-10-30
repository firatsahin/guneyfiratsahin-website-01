<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoftwareEngineerBlog extends CI_Controller {

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
            "isBlog" => true
        ));
    }

}
