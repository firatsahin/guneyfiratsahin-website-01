<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// default route / sitemap / 404 etc.
$route['default_controller'] = 'home';
$route['sitemap.xml'] = 'home/showSitemap';
$route['404_override'] = 'home/handle404';
$route['translate_uri_dashes'] = FALSE;

// routes that can be used in URL(link) generation logic inside the app (FRT TIP: Upper rule has priority)
global $linkableRoutes;
$linkableRoutes = [
    // example
    //(object)['routeName' => 'NAME', 'key' => 'KEY', 'value' => 'VAL'],

    // as a software engineer part
    (object)['routeName' => 'softwareEngineerHome', 'key' => 'as-a-software-engineer', 'value' => 'SoftwareEngineer'],
    (object)['routeName' => 'softwareEngineerBlogHome', 'key' => 'as-a-software-engineer/blog', 'value' => 'SoftwareEngineerBlog'],
    (object)['routeName' => 'softwareEngineerAny', 'key' => 'as-a-software-engineer/(:any)', 'value' => 'SoftwareEngineer/$1'],

    // as a software engineer > blog part
    (object)['routeName' => 'showBlogPostDetail', 'key' => 'as-a-software-engineer/blog-post/(:any)-(:num)', 'value' => 'SoftwareEngineerBlog/showPost/$2'],
    (object)['routeName' => 'listBlogCategories', 'key' => 'as-a-software-engineer/blog/categories', 'value' => 'SoftwareEngineerBlog/listCategories'],
    (object)['routeName' => 'listCategoryPosts', 'key' => 'as-a-software-engineer/blog-category/(:any)-(:num)', 'value' => 'SoftwareEngineerBlog/listCategoryPosts/$2'],
    (object)['routeName' => 'blogUploadImages', 'key' => 'as-a-software-engineer/blog/upload-images', 'value' => 'SoftwareEngineerBlog/uploadImages'],

    // as a musician part
    (object)['routeName' => 'musicianHome', 'key' => 'as-a-musician', 'value' => 'Musician'],
    (object)['routeName' => 'musicianAny', 'key' => 'as-a-musician/(:any)', 'value' => 'Musician/$1'],

    // as a human part
    (object)['routeName' => 'humanHome', 'key' => 'as-a-human', 'value' => 'Human'],
    (object)['routeName' => 'humanAny', 'key' => 'as-a-human/(:any)', 'value' => 'Human/$1'],
];

// add linkable routes to routes array too
foreach ($linkableRoutes as $lr) {
    $route[$lr->key] = $lr->value;
}

//die(json_encode($route));