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
$route['default_controller'] = 'Home/landing';
$route['profile'] = 'Home/profile';
$route['player'] = 'Home/player';
$route['priority'] = 'Home/priority';
$route['view-post'] = 'Home/post_by_post_id';
$route['banned'] = 'Home/banned';
$route['staff-management'] = 'Home/staff_management';
$route['cars'] = 'Home/cars';
$route['rules'] = 'Home/rules';
$route['timeline'] = 'Home/timeline';

$route['404_override'] = '';
$route['user-data'] = 'Steam/user_data';
$route['login'] = 'Steam/login';
$route['logout'] = 'Steam/logout';

$route['get-staff-token'] = 'User/get_staff_token';
$route['set-staff-token'] = 'User/set_staff_token';
$route['update-staff-token'] = 'User/update_staff_token';
$route['delete-staff-token'] = 'User/delete_staff_token';
$route['irps-mama'] = 'User/irps_mama';
$route['my-api-response'] = 'User/my_data';
$route['plate-avail'] = 'User/plate_avail';
$route['phone-avail/(:any)'] = 'User/phone_avail/$1';
$route['get-players'] = 'User/get_players/';
$route['get-players/(:any)'] =  function ($player){
    return 'User/get_players/'.str_replace("%20"," ",$player);
};


$route['banlist'] = 'User/get_banlist';

$route['house-invertory/(:any)'] = 'Inventory/get_house_inventory/$1';
$route['invertory/(:any)'] = 'Inventory/get_inventory/$1';
$route['trunk-invertory/(:any)'] = function ($plate){
    return 'Inventory/get_trunk_inventory/'.str_replace("%20"," ",$plate);
};
$route['set-dead-or-alive'] = 'User/set_dead_or_alive';
$route['set-plate-avail'] = 'User/set_plate_avail';
$route['change-mobile'] = 'User/change_mobile';
$route['set-vehicle-money'] = 'User/set_vehicle_money';
$route['delete-car'] = 'User/delete_car';
$route['delete-house'] = 'User/delete_house';
$route['user-properties/(:any)'] = 'User/get_user_properties/$1';
$route['user-vehicles/(:any)'] = 'User/get_user_vehicles/$1';
$route['vehicles-lists/(:any)'] = 'User/get_vehicles_list/$1/';
$route['vehicles-lists/(:any)/(:any)'] = function ($cat,$q){
    return 'User/get_vehicles_list/'.$cat.'/'.str_replace("%20"," ",$q);
};

$route['check-priority'] = 'User/check_priority';
$route['delete-priority'] = 'User/delete_priority';
$route['steam64'] = 'User/steam64';
$route['priority-info'] = 'User/get_priority_info';
$route['set-priority'] = 'User/set_priority';
$route['priority-check/(:any)'] = 'User/priority_check/$1';
$route['foregin-whitelist/(:any)'] = 'User/foregin_whitelist/$1';

$route['steam-details/(:any)'] = 'User/steam_details/$1';

$route['vehicles-categories/(:any)'] = 'User/get_vehicles_categories/$1';
$route['is-staff'] = 'User/is_staff';
//chand
$route['check-exc/(:any)'] = 'User/check_exc/$1';
$route['is-owned'] = 'User/is_owned';
$route['get-priority'] = 'User/get_priority';
$route['get-datastore'] = 'User/get_datastore';
$route['translate_uri_dashes'] = FALSE;
