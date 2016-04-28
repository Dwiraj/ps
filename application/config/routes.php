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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] 			= 'User';
$route['404_override'] 					= '';
$route['salary-register-list'] 			= '/salary_register';
$route['new-salary-register'] 	        = '/salary_register/createregisterlist';
$route['add-new-salary-register'] 		= '/salary_register/add_salary_register';
$route['add-new-user'] 					= '/admin/adduser';
$route['admin-list'] 					= '/admin/viewadmin';
$route['employee-list'] 				= '/employee';
$route['update-salary-register'] 		= '/salary_register/registerlist';
$route['edit-salary-register'] 			= '/salary_register/update_salary_register';
$route['change-password'] 				= '/user/change_password';
$route['view-employee-detail/(:num)'] 	= 'employee/view_employee_detail/$1';
$route['employee-salary-record']		= '/report/employee_salary_record';
$route['employee-salary-report']		= '/report/employee_salary_report';
$route['employee-salary-report-view']	= '/report/employee_salary_report_view';
$route['translate_uri_dashes'] 			= FALSE;
