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

    private function getData()
    {
        $data = json_decode(file_get_contents('frt_data.json'));

        // fix social profile links
        foreach ($data->personalInfo->socialProfiles as $p) {
            $contactName = $p->name;
            $p->link = str_replace("{{username}}", $data->contactInfo->$contactName, $p->link);
        }
        return $data;
    }

	public function index()
    {
        $data = $this->getData();

        // get recent posts here
        $recentPosts = array_splice($data->blog->posts, 0, 4);

        //echo json_encode($data);return; // CHECK OBJECT

        $blogData = (object)[
            "blogViewName" => "index_view",
            "blogTitle" => "Recent Posts",
            "recentPosts" => $recentPosts
        ];

        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $data,
            "isBlog" => true,
            "blogData" => $blogData
        ));
    }

    public function showPost($id = -1)
    {
        $data = $this->getData();

        $requestedPost = null;
        foreach ($data->blog->posts as $post) {
            if ($post->id == $id) {
                $requestedPost = $post;
                break;
            }
        }

        $blogData = (object)[
            "blogViewName" => "show_post_view",
            "post" => $requestedPost
        ];

        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $data,
            "isBlog" => true,
            "blogData" => $blogData
        ));
    }

}
