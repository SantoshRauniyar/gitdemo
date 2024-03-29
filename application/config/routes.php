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

$route['default_controller'] = "authentication/login";
$route['authentication']		 = "authentication/login";
$route['program_dashboard']		 = "dashboard/view_haspatal_dashboard";
$route['department_dashboard']		 = "dashboard/view_haspatal_dashboard";
$route['section_dashboard']		 = "dashboard/view_haspatal_dashboard";
$route['unit_dashboard']		 = "dashboard/view_haspatal_dashboard";
$route['section_taskboard']		 = "section/taskboard";
//task route
$route['created_task']		 = "task/created_by_task";
$route['assigned_task']		 = "task/assigned_by_task";




///department
$route['department/(:num)']		 = "groups/view_department/$1";
$route['department']		 = "groups/all";


//sub unit
$route['child-unit/(:num)']		 = "subunit/edit/$1";
$route['child-unit-view/(:num)']		 = "subunit/single_view/$1";
$route['child-unit/destroy/(:num)']		 = "subunit/destroy/$1";
$route['child-unit']		 = "subunit/all";
$route['create-child-unit']		 = "subunit/add_sub_unit";

$route['child-unit-deletelist']		 = "subunit/deletelist";
$route['child-unit-editlist']		 = "subunit/editlist";


$route['index']		 = "/authentication";
$route['404_override'] 		 = '';





/* End of file routes.php */
/* Location: ./application/config/routes.php */