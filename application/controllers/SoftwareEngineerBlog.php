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

    private $data;
    private $pageTitleBase;

    public function __construct()
    {
        parent::__construct();

        $this->data = json_decode(file_get_contents('frt_data.json'));

        // fix social profile links
        foreach ($this->data->personalInfo->socialProfiles as $p) {
            $contactName = $p->name;
            $p->link = str_replace("{{username}}", $this->data->contactInfo->$contactName, $p->link);
        }

        $this->pageTitleBase = $this->data->personalInfo->name->local . ' ' . $this->data->personalInfo->surname->local . ' - ' . $this->data->personalInfo->title . ' | Personal Blog';

        $this->load->database();
    }

    public function index($whatKind = 'recent-posts')
    {
        $sortBy = $this->getSortByOf($whatKind); // get sort by value by 'whatKind' param

        // get posts here
        $posts = $this->db->query("select * from blogPost where isPublished=true order by $sortBy->col $sortBy->direction limit 0,5")->result();
        foreach ($posts as $post) {
            $post->contents = $this->getFirstParagraphContentOfPost($post->id);
            $post->images = $this->getImagesOfPost($post->id);
        }

        //echo json_encode($this->data);return; // CHECK OBJECT

        $blogData = (object)[
            "blogViewName" => "index_view",
            "blogTitle" => 'Blog: ' . ($whatKind == 'recent-posts' ? "Recent Posts" : ""),
            "posts" => $posts
        ];

        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => $blogData->blogTitle . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    public function showPost($id = -1, $whatKind = 'recent-posts')
    {
        /////$postSet= // check set param from get array

        $sortBy = $this->getSortByOf($whatKind); // get sort by value by 'whatKind' param

        // add +1 to post visit count here ....

        $post = $this->db->query("select * from blogPost where id=" . $id)->result()[0];
        $post->contents = $this->getContentsOfPost($id);
        $post->images = $this->getImagesOfPost($id);

        // prev / next link generation here
        $prevNextLinks = $this->getPrevNextLinksOfPost($post, $whatKind);

        $blogData = (object)[
            "blogViewName" => "show_post_view",
            "post" => $post,
            "prevLink" => $prevNextLinks->prevLink,
            "nextLink" => $prevNextLinks->nextLink,
        ];

        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => 'Post: ' . $blogData->post->title . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    private function getSortByOf($whatKind)
    {
        $sortBy = (object)["col" => "createDate", "direction" => "desc"]; // default
        switch ($whatKind) {
            case "recent-posts": $sortBy->col = "createDate"; $sortBy->direction = "desc"; break;
            // other cases here..
        }
        return $sortBy;
    }

    private function getFirstParagraphContentOfPost($id)
    {
        $contents = $this->db->query("select * from postContent where blogPostId=$id and contentTypeId=1 order by sortNo,id limit 0,1")->result();
        return $contents;
    }

    private function getContentsOfPost($id)
    {
        $contents = $this->db->query("select * from postContent where blogPostId=$id order by sortNo,id")->result();
        return $contents;
    }

    private function getImagesOfPost($id)
    {
        $images = $this->db->query("select * from postImage where blogPostId=$id order by sortNo,id")->result();
        return $images;
    }

    private function getPrevNextLinksOfPost($post, $whatKind)
    {
        $returnObj = (object)["prevLink" => null, "nextLink" => null];
        $sortBy = $this->getSortByOf($whatKind); // get sort by value by 'whatKind' param
        $colname = $sortBy->col;
        $val = $post->$colname;

        $prevPost = $this->db->query("select * from blogPost where $sortBy->col = (select " . ($sortBy->direction == "desc" ? "min" : "max") . "($sortBy->col) from blogPost where isPublished=true and $sortBy->col" . ($sortBy->direction == "desc" ? ">" : "<") . "'$val')")->result();
        $nextPost = $this->db->query("select * from blogPost where $sortBy->col = (select " . ($sortBy->direction == "desc" ? "max" : "min") . "($sortBy->col) from blogPost where isPublished=true and $sortBy->col" . ($sortBy->direction == "desc" ? "<" : ">") . "'$val')")->result();
        if (count($prevPost) > 0) $returnObj->prevLink = uri_helper::generateRouteLink("showBlogPostDetail", [$prevPost[0]->id, $prevPost[0]->title]);
        if (count($nextPost) > 0) $returnObj->nextLink = uri_helper::generateRouteLink("showBlogPostDetail", [$nextPost[0]->id, $nextPost[0]->title]);

        return $returnObj;
    }

}