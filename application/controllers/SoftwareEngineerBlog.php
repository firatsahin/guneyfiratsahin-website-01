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
            "blogViewName" => "list_posts_view",
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

        $editMode = (isset($_GET['edit_post_key']) && $_GET['edit_post_key'] === EDIT_POST_KEY); // for editing the post
        $isPreview = (isset($_GET['preview']) && $_GET['preview'] === "1");

        //$sortBy = $this->getSortByOf($postSet); // get sort by value by 'postSet' param

        // get post
        $posts = $this->db->query("select * from blogPost where id=" . $id)->result();
        if (count($posts) == 0 || (!$posts[0]->isPublished && !$editMode)) utility_helper::redirectAndExit(SOFTWARE_ENGINEER_ROOT_URI . SOFTWARE_ENGINEER_BLOG_SUFFIX . SOFTWARE_ENGINEER_BLOG_DEFAULT_PATH);

        $post = $posts[0];

        // correct URI if it's wrong
        uri_helper::correctMalformedURI(uri_helper::generateRouteLink("showBlogPostDetail", [$post->id, $post->title]));

        // get post details
        $post->contents = $this->getContentsOfPost($id);
        $post->images = $this->getImagesOfPost($id);
        $post->category = $this->getCategoryById($post->categoryId);
        $post->category->link = uri_helper::generateRouteLink('listCategoryPosts', [$post->category->id, $post->category->name, 'recent-posts', 1]);
        $post->comments = $this->getCommentsOfPost($post->id, (!$editMode || $isPreview));
        $post->commentsCount = count($post->comments, (!$editMode || $isPreview));
        $post->tags = $this->normalizeTags($post->tagsJson);

        // prev / next link generation here
        $prevNextLinks = $this->getPrevNextLinksOfPost($post, $postSet, $filter);

        // add +1 to post visit count here ....
        if (!$editMode) $this->db->query("update blogPost set seenCount=seenCount+1 where id=" . $id);

        $blogData = (object)[
            "blogViewName" => $editMode && !$isPreview ? "edit_post_view" : "show_post_view",
            "activeTabIndex" => 0,
            "post" => $post,
            "prevLink" => $prevNextLinks->prevLink,
            "nextLink" => $prevNextLinks->nextLink,
            "editMode" => $editMode && !$isPreview,
        ];
        if ($editMode && !$isPreview) { // edit mode specific additions
            $blogData->contentTypes = $this->db->query("select * from postContentType order by id asc")->result();
            $blogData->categories = $this->getRootCategories(true);
        }
        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => 'Post: ' . $blogData->post->title . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    public function editPost($editPostKey, $postId = -1)
    {
        $inObj = json_decode(file_get_contents('php://input'));
        $outObj = (object)['success' => false, 'message' => null, 'data' => null];

        if ($editPostKey !== EDIT_POST_KEY) { // edit post key check
            utility_helper::returnJsonAndExit($outObj);
        }

        if ($inObj->whatToDo == "post_updatePublishStatus") {
            $this->db->query("update blogPost set isPublished=" . ($inObj->post->isPublished ? '1' : '0') . " where id=$postId");
        }
        if ($inObj->whatToDo == "post_updateTitle") {
            $this->db->query("update blogPost set title='" . $inObj->post->title . "' where id=$postId");
        }
        if ($inObj->whatToDo == "post_updateTagsJson") {
            $this->db->query("update blogPost set tagsJson=" . utility_helper::nullableStrValForSql($inObj->post->tagsJson) . " where id=$postId");
        }
        if ($inObj->whatToDo == "post_updateCategoryId") {
            $this->db->query("update blogPost set categoryId=" . $inObj->post->categoryId . " where id=$postId");
        }

        if ($inObj->whatToDo == "image_add") {
            $this->db->query("insert into postImage (blogPostId) values ($postId)");
        }
        if ($inObj->whatToDo == "image_update") {
            $this->db->query("update postImage set src='" . $inObj->image->src . "', label=" . utility_helper::nullableStrValForSql($inObj->image->label) . ", text=" . utility_helper::nullableStrValForSql($inObj->image->text) . " where id=" . $inObj->image->id);
        }
        if ($inObj->whatToDo == "image_delete") {
            $this->db->query("delete from postImage where id=" . $inObj->image->id);
        }
        if ($inObj->whatToDo == "images_sort") {
            $sortNo = count($inObj->images) - 1;
            foreach ($inObj->images as $image) {
                $this->db->query("update postImage set sortNo='" . $sortNo . "' where id=" . $image->id);
                $sortNo--;
            }
        }

        if ($inObj->whatToDo == "content_add") {
            $this->db->query("insert into postContent (blogPostId,contentTypeId) values ($postId," . $inObj->content->typeId . ")");
        }
        if ($inObj->whatToDo == "content_update") {
            if ($inObj->content->typeId == "1") {
                $this->db->query("update postContent set content='" . str_replace("'", "''", $inObj->content->text) . "' where id=" . $inObj->content->id);
            }
        }
        if ($inObj->whatToDo == "content_delete") {
            $this->db->query("delete from postContent where id=" . $inObj->content->id);
        }
        if ($inObj->whatToDo == "contents_sort") {
            $sortNo = count($inObj->contents) - 1;
            foreach ($inObj->contents as $content) {
                $this->db->query("update postContent set sortNo='" . $sortNo . "' where id=" . $content->id);
                $sortNo--;
            }
        }

        if ($inObj->whatToDo == "comment_changePublishStatus") {
            $this->db->query("update postComment set isPublished=" . ($inObj->comment->isPublished ? '1' : '0') . " where id=" . $inObj->comment->id);
        }
        if ($inObj->whatToDo == "comment_replyToComment") {
            $this->db->query("insert into postComment (blogPostId,commenterFullName,commenterEmail,commentText,commentedDatetime,isPublished,repliedCommentId) values " .
                "($postId,'frt','frt'," . utility_helper::nullableStrValForSql($inObj->comment->commentText) . ",'" . utility_helper::getDateNow() . "',1," . $inObj->comment->repliedCommentId . ")");
        }

        $this->db->query("update blogPost set lastModifiedDate='" . utility_helper::getDateNow() . "' where id=$postId");
        $outObj->success = true;

        utility_helper::returnJson($outObj);
    }

    public function listCategories()
    {
        $categories = $this->getRootCategories(true);

        $editMode = (isset($_GET['edit_category_key']) && $_GET['edit_category_key'] === EDIT_CATEGORY_KEY); // for editing categories

        $blogData = (object)[
            "blogViewName" => "list_categories_view",
            "activeTabIndex" => 1,
            "blogTitle" => 'Blog: Categories',
            "categories" => $categories,
            "editMode" => $editMode
        ];
        //echo json_encode($blogData);return; // CHECK OBJECT

        $this->load->view('SoftwareEngineer/index_view', array(
            "data" => $this->data,
            "isBlog" => true,
            "pageTitle" => $blogData->blogTitle . ' | ' . $this->pageTitleBase,
            "blogData" => $blogData
        ));
    }

    public function editCategory($editCategoryKey)
    {
        $inObj = json_decode(file_get_contents('php://input'));
        $outObj = (object)['success' => false, 'message' => null, 'data' => null];

        if ($editCategoryKey !== EDIT_CATEGORY_KEY) { // edit post key check
            utility_helper::returnJsonAndExit($outObj);
        }

        if ($inObj->whatToDo == "category_update") {
            if (!$this->canXbeYsChild($inObj->category->id, $inObj->category->parentId)) {
                $outObj->message = $inObj->category->id . " cannot be " . $inObj->category->parentId . "'s child category.";
                utility_helper::returnJsonAndExit($outObj);
            }
            $this->db->query("update postCategory set name='" . $inObj->category->name . "', parentId=" . utility_helper::nullableStrValForSql($inObj->category->parentId) . ", sortNo=" . $inObj->category->sortNo . " where id=" . $inObj->category->id);
        }
        if ($inObj->whatToDo == "category_insert") {
            $this->db->query("insert into postCategory (name,isActive,parentId) values ('" . $inObj->category->name . "',1," . utility_helper::nullableStrValForSql($inObj->category->parentId) . ")");
        }
        if ($inObj->whatToDo == "category_delete") {
            $this->db->query("delete from postCategory where id=" . $inObj->category->id);
        }
        if ($inObj->whatToDo == "post_add") {
            $now = utility_helper::getDateNow();
            $this->db->query("insert into blogPost (categoryId,createDate,lastModifiedDate) values (" . $inObj->post->categoryId . ",'" . $now . "','" . $now . "')");
        }

        $outObj->success = true;
        utility_helper::returnJson($outObj);
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
            "blogViewName" => "list_posts_view",
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

    public function addCommentToPost($postId)
    {
        $inObj = json_decode(file_get_contents('php://input'));
        $outObj = (object)['success' => false, 'message' => null, 'data' => null];

        foreach ($inObj as $key => $value) {
            if (gettype($value) == "string") $inObj->$key = trim($value);
        }

        $errors = [];
        if (!isset($inObj->commenterFullName) || !$inObj->commenterFullName) $errors[] = (object)["colname" => "commenterFullName", "errorType" => "required"];
        if (!isset($inObj->commenterEmail) || !$inObj->commenterEmail) $errors[] = (object)["colname" => "commenterEmail", "errorType" => "required"];
        else if (!filter_var($inObj->commenterEmail, FILTER_VALIDATE_EMAIL)) $errors[] = (object)["colname" => "commenterEmail", "errorType" => "invalid"];
        if (!isset($inObj->commentText) || !$inObj->commentText) $errors[] = (object)["colname" => "commentText", "errorType" => "required"];

        if (count($errors) == 0) {
            $this->db->query("insert into postComment (blogPostId,commenterFullName,commenterEmail,commentText,commentedDatetime) values " .
                "($postId,'" . $inObj->commenterFullName . "','" . $inObj->commenterEmail . "'," . utility_helper::nullableStrValForSql($inObj->commentText) . ",'" . utility_helper::getDateNow() . "')");

            $outObj->success = true;
        } else {
            $outObj->message = "Some form errors occured above. Please fix them and try again.";
        }
        $outObj->errors = $errors;
        utility_helper::returnJson($outObj);
    }

    public function likePost($postId)
    {
        $inObj = json_decode(file_get_contents('php://input'));
        $outObj = (object)['success' => false, 'message' => null, 'data' => null];

        $this->db->query("update blogPost set likedCount=likedCount+1 where id=$postId");

        $outObj->success = true;
        utility_helper::returnJson($outObj);
    }

    // HELPER FUNCTIONS - BEGIN
    private function getSortByOf($postSet)
    {
        $sortBy = (object)["col" => "createDate", "direction" => "desc"]; // default
        switch ($postSet) {
            case "recent-posts": $sortBy->col = "createDate"; $sortBy->direction = "desc"; break;
            case "most-clicked-posts": $sortBy->col = "seenCount"; $sortBy->direction = "desc"; break;
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
            $post->commentsCount = $this->countCommentsOfPost($post->id);
            $post->tags = $this->normalizeTags($post->tagsJson);
        }

        return $returnObj;
    }

    private function getFirstParagraphContentOfPost($id)
    {
        $contents = $this->db->query("select * from postContent where blogPostId=$id and contentTypeId=1 order by sortNo desc,id limit 0,1")->result();
        return $contents;
    }

    private function getContentsOfPost($id)
    {
        $contents = $this->db->query("select * from postContent where blogPostId=$id order by sortNo desc,id")->result();
        return $contents;
    }

    private function getImagesOfPost($id)
    {
        $images = $this->db->query("select * from postImage where blogPostId=$id order by sortNo desc,id")->result();
        return $images;
    }

    private function getCommentsOfPost($id, $onlyPublished = true)
    {
        $comments = $this->db->query("select * from postComment where blogPostId=$id and repliedCommentId is null " . ($onlyPublished ? 'and isPublished=1' : '') . " order by commentedDatetime desc")->result();
        foreach ($comments as $comment) {
            $comment->replies = $this->getRepliesOfAComment($comment->id);
        }
        return $comments;
    }

    private function getRepliesOfAComment($commentId, $onlyPublished = true)
    {
        $replies = $this->db->query("select * from postComment where repliedCommentId=$commentId " . ($onlyPublished ? 'and isPublished=1' : '') . " order by commentedDatetime desc")->result();
        return $replies;
    }

    private function countCommentsOfPost($id, $onlyPublished = true)
    {
        $commentsCount = intval($this->db->query("select count(*) count from postComment where blogPostId=$id  and repliedCommentId is null " . ($onlyPublished ? 'and isPublished=1' : ''))->result()[0]->count);
        return $commentsCount;
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
        $subCats = $this->db->query("select * from postCategory where isActive=true and $filter order by sortNo desc,name")->result();
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
        $subCats = $this->db->query("select id from postCategory where isActive=true and parentId=$id order by sortNo desc,name")->result();
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

    private function normalizeTags($tagsJson)
    {
        $tagsArray = [];
        if ($tagsJson) $tagsArray = json_decode($tagsJson);
        return $tagsArray;
    }

    private function canXbeYsChild($xId, $yId)
    {
        if ($xId == $yId) return false;
        return array_search($xId, $this->getParentCategoryIdsOf($yId, true)) === false;
    }

    private function getParentCategoryIdsOf($id = null, $untilRootCategory = false)
    {
        $parentCatIds = [];
        if (!$id) return $parentCatIds;
        $this->addParentCategoryIdOf($id, $untilRootCategory, $parentCatIds);
        return $parentCatIds;
    }

    private function addParentCategoryIdOf($id = null, $untilRootCategory = false, &$addTo)
    {
        if (!$id) return;
        $cat = $this->getCategoryById($id);
        if ($cat == null || $cat->parentId == null) return;

        $addTo[] = $cat->parentId;
        if ($untilRootCategory) $this->addParentCategoryIdOf($cat->parentId, true, $addTo);
    }
    // HELPER FUNCTIONS - END

}
