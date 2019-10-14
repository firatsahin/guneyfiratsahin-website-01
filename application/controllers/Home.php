<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $data = json_decode(file_get_contents('as-a-software-engineer/frt_data.json'));

        // fix social profile links
        foreach ($data->landingPageInfo->sections as $s) {
            foreach ($s->socialLinks as $sl) {
                $contactName = $sl->name;
                $sl->link = str_replace("{{username}}", $data->contactInfo->$contactName, $sl->link);
            }
        }

        $this->load->view('home/index_view', array(
            "data" => $data,
        ));
        return;

        require_once 'User.php';
        $user = new User(23, 'user23');

        echo $user->setId(211);
        echo $user->getId();
        $user->age = 56;
        echo "<br />" . json_encode(get_object_vars($user));
        echo "<br />" . $user->toJSON();

        echo "<br /><br />";

        echo 'My Local IP: <b style="color: darkblue;">' . $_SERVER['REMOTE_ADDR'] . '</b><br />';
        //echo '<pre>'.json_encode($_SERVER).'</pre><br />';
    }

}
