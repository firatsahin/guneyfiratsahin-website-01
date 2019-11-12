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
    private $postFilterBase;
    private $defaultPageSize = 3;

    public function __construct()
    {
        parent::__construct();

        $this->data = json_decode(file_get_contents('frt_data.json'));

        // fix social profile links
        foreach ($this->data->personalInfo->socialProfiles as $p) {
            $contactName = $p->name;
            $p->link = str_replace("{{username}}", $this->data->contactInfo->$contactName, $p->link);
        }

        $this->pageTitleBase = $this->data->personalInfo->name->local . ' ' . $this->data->personalInfo->surname->local . ' ' . $this->data->personalInfo->title . ' | Personal Blog';

        $this->postFilterBase = "isPublished=true";

        $this->load->database();
    }

    public function index($postSet = 'recent-posts', $page = 1)
    {
        $sortBy = $this->getSortByOf($postSet); // get sort by value by 'postSet' param

        if ($page < 1) utility_helper::redirectAndExit("page-1.html");

        $getPageResult = $this->getPagePosts($page, $this->defaultPageSize, $sortBy, "");

        $blogData = (object)[
            "blogViewName" => "index_view",
            "activeTabIndex" => 0,
            "blogTitle" => 'Blog: ' . ($postSet == 'recent-posts' ? "Recent Posts" : ($postSet == 'most-clicked-posts' ? "Most Clicked Posts" : "")),
            "postSet" => $postSet,
            "page" => $page,
            "pageCount" => $getPageResult->pageCount,
            "posts" => $getPageResult->posts
        ];
        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => $blogData->blogTitle . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    public function showPost($id = -1, $postSet = 'recent-posts')
    {
        $filter = "";

        // get values from get array's from param
        if (isset($_GET['from']) && $_GET['from']) {
            $fromUriSegments = explode("/", $_GET['from']);
            $postSet = $fromUriSegments[count($fromUriSegments) - 2];

            if (strpos($fromUriSegments[0], "category-") === 0) {
                $catId = intval(str_replace("category-", "", $fromUriSegments[0]));
                $catIds = [$catId];
                $this->addSubCategoryIdsOf($catId, true, $catIds);
                $filter = "categoryId in (" . implode(",", $catIds) . ")";
            }
        }

        //$sortBy = $this->getSortByOf($postSet); // get sort by value by 'postSet' param

        // get post
        $post = $this->db->query("select * from blogPost where id=" . $id)->result()[0];

        // correct URI if it's wrong
        uri_helper::correctMalformedURI(uri_helper::generateRouteLink("showBlogPostDetail", [$post->id, $post->title]));

        // get post details
        $post->contents = $this->getContentsOfPost($id);
        $post->images = $this->getImagesOfPost($id);
        $post->category = $this->getCategoryById($post->categoryId);
        $post->category->link = uri_helper::generateRouteLink('listCategoryPosts', [$post->category->id, $post->category->name, 'recent-posts', 1]);

        // prev / next link generation here
        $prevNextLinks = $this->getPrevNextLinksOfPost($post, $postSet, $filter);

        // add +1 to post visit count here ....
        $this->db->query("update blogPost set readCount=readCount+1 where id=" . $id);

        $blogData = (object)[
            "blogViewName" => "show_post_view",
            "activeTabIndex" => 0,
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

    public function listCategories()
    {
        $categories = $this->getRootCategories(true);

        $blogData = (object)[
            "blogViewName" => "list_categories_view",
            "activeTabIndex" => 1,
            "blogTitle" => 'Blog: Categories',
            "categories" => $categories,
        ];
        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => $blogData->blogTitle . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    public function listCategoryPosts($categoryId, $postSet = 'recent-posts', $page = 1)
    {
        $sortBy = $this->getSortByOf($postSet); // get sort by value by 'postSet' param

        if ($page < 1) utility_helper::redirectAndExit("page-1.html");

        $categoryName = $this->getCategoryById($categoryId)->name;

        // correct URI if it's wrong
        uri_helper::correctMalformedURI(uri_helper::generateRouteLink('listCategoryPosts', [$categoryId, $categoryName, $postSet, $page]));

        $categoryIds = [$categoryId];
        $this->addSubCategoryIdsOf($categoryId, true, $categoryIds);
        $filter = "categoryId in (" . implode(",", $categoryIds) . ")";

        $getPageResult = $this->getPagePosts($page, $this->defaultPageSize, $sortBy, $filter);

        $blogData = (object)[
            "blogViewName" => "index_view",
            "activeTabIndex" => 0,
            "blogTitle" => 'Blog Category: ' . $categoryName,
            "categoryName" => $categoryName,
            "postSet" => $postSet,
            "page" => $page,
            "pageCount" => $getPageResult->pageCount,
            "posts" => $getPageResult->posts
        ];
        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => $blogData->blogTitle . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    // HELPER FUNCTIONS - BEGIN
    private function getSortByOf($postSet)
    {
        $sortBy = (object)["col" => "createDate", "direction" => "desc"]; // default
        switch ($postSet) {
            case "recent-posts": $sortBy->col = "createDate"; $sortBy->direction = "desc"; break;
            case "most-clicked-posts": $sortBy->col = "readCount"; $sortBy->direction = "desc"; break;
            // other cases here..
        }
        return $sortBy;
    }

    private function getPagePosts($page, $pageSize, $sortBy, $filter)
    {
        $returnObj = (object)[];

        $filter = $this->postFilterBase . ($filter ? ' and ' . $filter : '');

        $returnObj->postsCount = intval($this->db->query("select count(*) count from blogPost where $filter")->result()[0]->count);
        $returnObj->pageCount = ceil($returnObj->postsCount / $pageSize);
        if ($returnObj->pageCount == 0) $returnObj->pageCount = 1;

        if ($page > $returnObj->pageCount) utility_helper::redirectAndExit("page-$returnObj->pageCount.html");

        // get posts here
        $returnObj->posts = $this->db->query("select * from blogPost where $filter order by $sortBy->col $sortBy->direction limit " . (($page - 1) * $pageSize) . ",$pageSize")->result();
        foreach ($returnObj->posts as $post) {
            $post->contents = $this->getFirstParagraphContentOfPost($post->id);
            $post->images = $this->getImagesOfPost($post->id);
            $post->category = $this->getCategoryById($post->categoryId);
            $post->category->link = uri_helper::generateRouteLink('listCategoryPosts', [$post->category->id, $post->category->name, 'recent-posts', 1]);
        }

        return $returnObj;
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

    private function getPrevNextLinksOfPost($post, $postSet, $filter)
    {
        $returnObj = (object)["prevLink" => null, "nextLink" => null];
        $sortBy = $this->getSortByOf($postSet); // get sort by value by 'postSet' param
        $colname = $sortBy->col;
        $val = $post->$colname;

        $filter = $this->postFilterBase . ($filter ? ' and ' . $filter : '');

        $prevPost = $this->db->query("select * from blogPost where $sortBy->col = (select " . ($sortBy->direction == "desc" ? "min" : "max") . "($sortBy->col) from blogPost where $filter and $sortBy->col" . ($sortBy->direction == "desc" ? ">" : "<") . "'$val')")->result();
        $nextPost = $this->db->query("select * from blogPost where $sortBy->col = (select " . ($sortBy->direction == "desc" ? "max" : "min") . "($sortBy->col) from blogPost where $filter and $sortBy->col" . ($sortBy->direction == "desc" ? "<" : ">") . "'$val')")->result();
        if (count($prevPost) > 0) $returnObj->prevLink = uri_helper::generateRouteLink("showBlogPostDetail", [$prevPost[0]->id, $prevPost[0]->title]);
        if (count($nextPost) > 0) $returnObj->nextLink = uri_helper::generateRouteLink("showBlogPostDetail", [$nextPost[0]->id, $nextPost[0]->title]);

        return $returnObj;
    }

    private function getRootCategories($withAllChildren = false)
    {
        return $this->getSubCategoriesOf(null, $withAllChildren);
    }

    private function getSubCategoriesOf($id = null, $withInnerChildren = false)
    {
        $filter = $id ? "parentId=$id" : "parentId is null";
        $subCats = $this->db->query("select * from postCategory where isActive=true and $filter order by sortNo,name")->result();
        if ($withInnerChildren) {
            foreach ($subCats as $c) {
                $c->subCategories = $this->getSubCategoriesOf($c->id, true);
                $c->postCount = $this->getPostCountOfCategory($c->id, true);
            }
        }
        return $subCats;
    }

    private function addSubCategoryIdsOf($id = null, $withInnerChildren = false, &$addTo)
    {
        if (!$id) return;
        $subCats = $this->db->query("select id from postCategory where isActive=true and parentId=$id order by sortNo,name")->result();
        foreach ($subCats as $c) {
            $addTo[] = $c->id;
            if ($withInnerChildren) {
                $this->addSubCategoryIdsOf($c->id, true, $addTo);
            }
        }
    }

    private function getPostCountOfCategory($categoryId, $withInnerChildren = false)
    {
        $categoryIds = [$categoryId];
        if ($withInnerChildren) {
            $this->addSubCategoryIdsOf($categoryId, true, $categoryIds);
        }
        $postCount = intval($this->db->query("select count(*) count from blogPost where $this->postFilterBase and categoryId in(" . implode(",", $categoryIds) . ")")->result()[0]->count);
        return $postCount;
    }

    private function getCategoryById($id)
    {
        $result = $this->db->query("select * from postCategory where id=$id")->result();
        if (count($result) == 0) return null;
        return $result[0];
    }
    // HELPER FUNCTIONS - END

}
