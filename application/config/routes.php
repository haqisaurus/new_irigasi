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

$route['default_controller'] = "frontend/page_controller";
$route['login'] = 'auth/login';
$route['login-action'] = 'auth/doLogin';
$route['logout'] = 'auth/doLogout';
// admin 
$route['dashboard'] = 'backend/dashboard';

$route['user'] = 'backend/user';
$route['user/(:num)'] = 'backend/user/index/$1';
$route['user/create'] = 'backend/user/create';
$route['user/update/(:num)'] = 'backend/user/update/$1';
$route['user/update-action'] = 'backend/user/doUpdate';
$route['user/delete-action/(:num)'] = 'backend/user/delete/$1';

$route['role'] = 'backend/user/role';

$route['region'] = 'backend/region';
$route['region/(:num)'] = 'backend/region/index/$1';
$route['region/create'] = 'backend/region/create';
$route['region/update/(:num)'] = 'backend/region/update/$1';
$route['region/update-action'] = 'backend/region/doUpdate';
$route['region/delete-action/(:num)'] = 'backend/region/delete/$1';

$route['wide'] = 'backend/wide';
$route['wide/(:num)'] = 'backend/wide/index/$1';
$route['wide/create'] = 'backend/wide/create';
$route['wide/update/(:num)'] = 'backend/wide/update/$1';
$route['wide/update-action'] = 'backend/wide/doUpdate';
$route['wide/delete-action/(:num)'] = 'backend/wide/delete/$1';

$route['water'] = 'backend/water';
$route['water/(:num)'] = 'backend/water/index/$1';
$route['water/create'] = 'backend/water/create';
$route['water/update/(:num)'] = 'backend/water/update/$1';
$route['water/update-action'] = 'backend/water/doUpdate';
$route['water/delete-action/(:num)'] = 'backend/water/delete/$1';

// frontend
$route['data-region/(:num)'] = 'frontend/page_controller/dataRegion/$1';
$route['data-detail/(:num)'] = 'frontend/page_controller/dataDetail/$1';
$route['user-login'] = 'frontend/page_controller/showLogin';
$route['account-detail'] = 'frontend/page_controller/accountDetail';


$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */