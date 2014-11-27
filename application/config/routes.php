<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['admin'] = "admin";
$route['admin/(:any)'] = "admin/$1";
$route['adminAdds'] = "adminAdds";
$route['adminAdds/(:any)'] = "adminAdds/$1";
$route['adminCategories'] = "adminCategories";
$route['adminCategories/(:any)'] = "adminCategories/$1";
$route['adminLocation'] = "adminLocation";
$route['adminLocation/(:any)'] = "adminLocation/$1";
$route['adminPolls'] = "adminPolls";
$route['adminPolls/(:any)'] = "adminPolls/$1";
$route['adminComments'] = "adminComments";
$route['adminComments/(:any)'] = "adminComments/$1";
$route['adminPosts'] = "adminPosts";
$route['adminPosts/(:any)'] = "adminPosts/$1";
$route['adminRoles'] = "adminRoles";
$route['adminRoles/(:any)'] = "adminRoles/$1";
$route['adminUsers'] = "adminUsers";
$route['adminUsers/(:any)'] = "adminUsers/$1";
$route['EMagazine'] = "EMagazine";
$route['EMagazine/(:any)'] = "EMagazine/$1";
$route['site_logout'] = "home/site_logout";
$route['site_login'] = "home/site_login";
$route['fb_login'] = "home/fb_login";
$route['site_signup'] = "home/site_signup";

$route['emagazine'] = "home/emagazine";
$route['emagazine/(:any)'] = "home/emagazine/$1";

$route['(:any)'] ='home/params_check/$1';
$route['(:any)/(:any)'] ='home/params_check/$1/$2';
$route['(:any)/(:any)/(:any)'] ='home/params_check/$1/$2/$3';
$route['(:any)/(:any)/(:any)/(:any)'] ='home/params_check/$1/$2/$3/$4';


/* End of file routes.php */
/* Location: ./application/config/routes.php */