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

// routes that can be used in URL(link) generation logic inside the app
$GLOBALS['linkableRoutes'] = [];

// default route
$route['default_controller'] = 'home';

// as a software engineer part
$route['as-a-software-engineer/(:any).html'] = "SoftwareEngineer/$1";
$route['as-a-software-engineer/blog/(:any)/page-(:num).html'] = "SoftwareEngineerBlog/index/$1/$2";

// as a software engineer > blog part
$GLOBALS['linkableRoutes'] [] = (object)['routeName' => 'showBlogPostDetail', 'key' => 'as-a-software-engineer/blog/post-(:num)/(:any).html', 'value' => 'SoftwareEngineerBlog/showPost/$1'];
$route['as-a-software-engineer/blog/categories/index.html'] = "SoftwareEngineerBlog/listCategories";
$GLOBALS['linkableRoutes'] [] = (object)['routeName' => 'listCategoryPosts', 'key' => 'as-a-software-engineer/blog/category-(:num)/(:any)/(:any)/page-(:num).html', 'value' => 'SoftwareEngineerBlog/listCategoryPosts/$1/$3/$4'];
$route['as-a-software-engineer/blog/upload-images/index.html'] = "SoftwareEngineerBlog/uploadImages";

// as a musician part
$route['as-a-musician/(:any).html'] = "Musician/$1";

// as a human part
$route['as-a-human/(:any).html'] = "Human/$1";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// add linkable routes to routes array too
foreach ($GLOBALS['linkableRoutes'] as $lr) {
    $route[$lr->key] = $lr->value;
}

//echo json_encode($route);exit();