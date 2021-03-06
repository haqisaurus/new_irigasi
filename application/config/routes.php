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
$route['account-detail'] = 'auth/accountDetail';
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
$route['data-water'] = 'frontend/page_controller/dataWater';
$route['entri-water'] = 'frontend/page_controller/inputWater';
$route['action-entri-water'] = 'frontend/page_controller/doInputWater';
$route['edit-water/(:num)'] = 'frontend/page_controller/editWater/$1';
$route['action-edit-water'] = 'frontend/page_controller/doEditWater';
$route['user-login'] = 'frontend/page_controller/showLogin';

// pula tanam usulan
$route['plant-view'] = 'frontend/page_controller/plantView';
$route['plant-entry'] = 'frontend/page_controller/plant';
$route['plant-edit/(:num)'] = 'frontend/page_controller/plantEdit/$1';
$route['action-plant-entry'] = 'frontend/page_controller/plantEntry';
$route['action-plant-edit'] = 'frontend/page_controller/plantUpdate';

$route['water-view'] = 'frontend/page_controller/dataViewCommon';
$route['ajax-by-region-id'] = 'frontend/page_controller/ajaxGetYearsByRegion';

$route['debit-andalan'] = 'frontend/page_controller/dataDebitAndalan';
$route['get-andalan'] = 'frontend/page_controller/ajaxGetDataDebitAndalan';
$route['get-water-demand'] = 'frontend/page_controller/ajaxGetWaterDemand';


// new integrated system
$route['default_controller'] 	= "integrated/guest_page";

$route['/'] 					= 'integrated/guest_page';


$route['login'] 				= 'auth/login';
$route['login-action'] 			= 'auth/doLogin';
$route['logout'] 				= 'auth/doLogout';


/* ADMIN */
$route['admin'] 				= 'integrated/admin_page';

// users
$route['user'] 					= 'integrated/admin_page/viewUser';
$route['user-add'] 				= 'integrated/admin_page/createUser';
$route['user-add-action']		= 'integrated/admin_page/createUserAction';
$route['user-edit/(:num)'] 		= 'integrated/admin_page/editUser/$1';
$route['user-edit-action'] 		= 'integrated/admin_page/editUserAction';
$route['user-delete/(:num)'] 	= 'integrated/admin_page/deleteUser/$1';

// role
$route['role'] 					= 'integrated/admin_page/viewRole';

// juru access
$route['juru-access'] 					= 'integrated/admin_page/viewJuru';
$route['juru-access-edit/(:num)'] 		= 'integrated/admin_page/editJuru/$1';
$route['juru-access-edit-action'] 		= 'integrated/admin_page/editJuruAction';

//data master/
// region
$route['region'] 					= 'integrated/admin_page/viewRegion';
$route['region-add'] 				= 'integrated/admin_page/createRegion';
$route['region-add-action']			= 'integrated/admin_page/createRegionAction';
$route['region-edit/(:num)'] 		= 'integrated/admin_page/editRegion/$1';
$route['region-edit-action'] 		= 'integrated/admin_page/editRegionAction';
$route['region-delete/(:num)'] 		= 'integrated/admin_page/deleteRegion/$1';

// wide
$route['wide'] 						= 'integrated/admin_page/viewWide';
$route['wide-add'] 					= 'integrated/admin_page/createWide';
$route['wide-add-action']			= 'integrated/admin_page/createWideAction';
$route['wide-edit/(:num)'] 			= 'integrated/admin_page/editWide/$1';
$route['wide-edit-action'] 			= 'integrated/admin_page/editWideAction';
$route['wide-delete/(:num)'] 		= 'integrated/admin_page/deleteWide/$1';

// water debit
$route['water'] 					= 'integrated/admin_page/viewWater';
$route['water-add'] 				= 'integrated/admin_page/createWater';
$route['water-add-action']			= 'integrated/admin_page/createWaterAction';
$route['water-edit/(:num)'] 		= 'integrated/admin_page/editWater/$1';
$route['water-edit-action'] 		= 'integrated/admin_page/editWaterAction';
$route['water-delete/(:num)'] 		= 'integrated/admin_page/deleteWater/$1';

// data analys
$route['view-debit-andalan']		= 'integrated/admin_page/getDebitAndalan';
$route['ajax-debit-andalan'] 		= 'integrated/admin_page/getDebitAndalanData';

$route['view-water-demand']			= 'integrated/admin_page/getWaterDemand';
$route['add-data-plan']				= 'integrated/admin_page/plan';
$route['get-plan-calc']				= 'integrated/admin_page/planDataCalc';
$route['save-plan'] 				= 'integrated/admin_page/savePlan';
$route['list-plan'] 				= 'integrated/admin_page/listPlan';
$route['view-plan/(:num)'] 			= 'integrated/admin_page/viewPlan/$1';
$route['region-wide-ajax'] 			= 'integrated/ajax_req/ajaxGetWide';

// mobile access
$route['login-mobile'] 				= 'welcome/mobile';
$route['login-action-ajax'] 		= 'auth/ajaxLogin';

$route['get-water-ajax'] 			= 'integrated/ajax_req/getAjaxWaterData';
$route['get-region-ajax'] 			= 'integrated/ajax_req/getAjaxRegionData';
$route['get-year-ajax'] 			= 'integrated/ajax_req/getAjaxYearsData';
$route['add-water-ajax']			= 'integrated/ajax_req/addAjaxWaterData';

$route['constant'] 					= 'integrated/admin_page/constant';
$route['constant-save'] 			= 'integrated/admin_page/constantSave';
$route['allocation'] 				= 'integrated/admin_page/allocation';
$route['kinerja'] 					= 'integrated/admin_page/kinerja';
$route['kinerja-calc/(:num)'] 					= 'integrated/admin_page/kinerjaCalc/$1';
/* END : ADMIN */


// JURU
$route['juru'] 							= 'integrated/juru_page';
$route['juru-debit-view'] 				= 'integrated/juru_page/viewWater';
$route['juru-debit-add'] 				= 'integrated/juru_page/createWater';
$route['juru-debit-add-action'] 		= 'integrated/juru_page/createWaterAction';
$route['juru-debit-edit/(:num)'] 		= 'integrated/juru_page/editWater/$1';
$route['juru-debit-edit-action'] 		= 'integrated/juru_page/editWaterAction';
// END : JURU

// PENGAMAT
$route['pengamat'] 							= 'integrated/pengamat_page';
$route['pengamat-debit-andalan'] 			= 'integrated/pengamat_page/getDebitAndalan';
$route['pengamat-debit-view'] 				= 'integrated/pengamat_page/viewWater';
$route['pengamat-debit-andalan-ajax'] 		= 'integrated/pengamat_page/ajaxGetDebitAndalan';
$route['pengamat-rencana-tanam'] 			= 'integrated/pengamat_page/plan';
$route['pengamat-kalkulasi-rencana']		= 'integrated/pengamat_page/planDataCalc';
$route['pengamat-kalkulasi-rencana-ajax']	= 'integrated/pengamat_page/ajaxGetDataWaterDemand';
$route['pengamat-rencana-save'] 			= 'integrated/pengamat_page/savePlan';
$route['pengamat-rencana-list'] 			= 'integrated/pengamat_page/listPlan';
$route['pengamat-rencana-view/(:num)'] 		= 'integrated/pengamat_page/viewPlan/$1';
$route['pengamat-allocation'] 				= 'integrated/pengamat_page/allocation';
// END: PENGAMAT

// PEMIMPIN
$route['pimpinan'] 							= 'integrated/pimpinan_page';
$route['pimpinan-debit-andalan'] 			= 'integrated/pimpinan_page/getDebitAndalan';
$route['pimpinan-debit-view'] 				= 'integrated/pimpinan_page/viewWater';
$route['pimpinan-debit-add'] 				= 'integrated/pimpinan_page/createWater';
$route['pimpinan-debit-add-action'] 		= 'integrated/pimpinan_page/createWaterAction';
$route['pimpinan-debit-edit/(:num)'] 		= 'integrated/pimpinan_page/editWater/$1';
$route['pimpinan-debit-edit-action'] 		= 'integrated/pimpinan_page/editWaterAction';
$route['pimpinan-debit-delete-action/(:num)'] 	= 'integrated/pimpinan_page/deleteWater/$1';
$route['pimpinan-debit-andalan-ajax'] 		= 'integrated/pimpinan_page/ajaxGetDebitAndalan';
$route['pimpinan-rencana-tanam'] 			= 'integrated/pimpinan_page/plan';
$route['pimpinan-kalkulasi-rencana']		= 'integrated/pimpinan_page/planDataCalc';
$route['pimpinan-kalkulasi-rencana-ajax']	= 'integrated/pimpinan_page/ajaxGetDataWaterDemand';
$route['pimpinan-rencana-save'] 			= 'integrated/pimpinan_page/savePlan';
$route['pimpinan-rencana-list'] 			= 'integrated/pimpinan_page/listPlan';
$route['pimpinan-rencana-view/(:num)'] 		= 'integrated/pimpinan_page/viewPlan/$1';

// END : PEMIMPIN

$route['404_override'] = '';


/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/water'] 		= 'integrated/ajax_req/apiWater';
$route['api/water/(:num)'] 	= 'integrated/ajax_req/apiWater/$1';

$route['api/allocation'] 	= 'integrated/ajax_req/ajaxAddAllocation';
$route['api/allocation/(:num)'] 	= 'integrated/ajax_req/ajaxRegionAllocation/$1';
$route['api/ajaxCalcAlloc/(:num)'] 	= 'integrated/ajax_req/ajaxAllocationCalc/$1';
$route['api/region-wide'] 			= 'integrated/ajax_req/ajaxGetWide';

/* End of file routes.php */
/* Location: ./application/config/routes.php */