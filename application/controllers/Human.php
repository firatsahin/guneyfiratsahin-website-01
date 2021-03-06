<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Human extends CI_Controller {

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

        $socialProfileToGo = 'instagram';

        // redirect to profile
        foreach ($data->landingPageInfo->sections as $s) {
            if ($s->id == "as-a-human") { // select musician section
                foreach ($s->socialLinks as $sl) {
                    if ($sl->name == $socialProfileToGo) { // select youtube link
                        $sl->link = str_replace("{{username}}", $data->contactInfo->$socialProfileToGo, $sl->link);
                        header("Location: $sl->link");
                        exit();
                    }
                }
            }
        }
    }

}
