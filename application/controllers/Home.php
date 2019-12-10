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
        $data = json_decode(file_get_contents('frt_data.json'));

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

    public function showSitemap()
    {
        $this->load->database();
        header('Content-type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $siteUrl = trim(utility_helper::getSiteUrl(), "/");

        $postSets = ["recent-posts", "most-clicked-posts"];
        $posts = $this->db->query("select * from blogPost where isPublished=true order by createDate desc limit 0,10000")->result();
        $categories = $this->db->query("select * from postCategory where isActive=true order by sortNo desc,name limit 0,10000")->result();

        echo '<url>';
        echo '<loc>' . $siteUrl . '</loc>';
        $lastMod = utility_helper::getLastModOfAFile('/application/views/home/index_view.php');
        if ($lastMod) echo '<lastmod>' . substr($lastMod, 0, 10) . '</lastmod>';
        echo '</url>';

        echo '<url>';
        echo '<loc>' . $siteUrl . SOFTWARE_ENGINEER_ROOT_URI . 'index.html</loc>';
        $lastMod = utility_helper::getLastModOfAFile('/application/views/SoftwareEngineer/index_view.php');
        if ($lastMod) echo '<lastmod>' . substr($lastMod, 0, 10) . '</lastmod>';
        echo '</url>';

        foreach ($postSets as $postSet) {
            echo '<url>';
            echo '<loc>' . $siteUrl . SOFTWARE_ENGINEER_ROOT_URI . SOFTWARE_ENGINEER_BLOG_SUFFIX . $postSet . '/page-1.html</loc>';
            echo '<lastmod>' . substr($posts[0]->lastModifiedDate, 0, 10) . '</lastmod>';
            echo '</url>';
        }

        foreach ($posts as $post) {
            echo '<url>';
            echo '<loc>' . $siteUrl . uri_helper::generateRouteLink('showBlogPostDetail', [$post->id, $post->title]) . '</loc>';
            echo '<lastmod>' . substr($post->lastModifiedDate, 0, 10) . '</lastmod>';
            echo '</url>';
        }

        echo '<url>';
        echo '<loc>' . $siteUrl . SOFTWARE_ENGINEER_ROOT_URI . SOFTWARE_ENGINEER_BLOG_SUFFIX . 'categories/index.html</loc>';
        $lastMod = utility_helper::getLastModOfAFile('/application/views/SoftwareEngineer/blog/list_categories_view.php');
        if ($lastMod) echo '<lastmod>' . substr($lastMod, 0, 10) . '</lastmod>';
        echo '</url>';

        foreach ($categories as $category) {
            foreach ($postSets as $postSet) {
                echo '<url>';
                echo '<loc>' . $siteUrl . uri_helper::generateRouteLink('listCategoryPosts', [$category->id, $category->name, $postSet, 1]) . '</loc>';
                echo '</url>';
            }
        }

        echo '<url>';
        echo '<loc>' . $siteUrl . '/as-a-musician/index.html</loc>';
        echo '</url>';

        echo '<url>';
        echo '<loc>' . $siteUrl . '/as-a-human/index.html</loc>';
        echo '</url>';

        echo '</urlset>';
    }

}
