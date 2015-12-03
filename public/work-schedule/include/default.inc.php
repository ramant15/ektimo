<?php
/*
 * Created on 17-okt-2011
 * author Paul Wolbers
 */

$current_path = dirname ( realpath ( __FILE__ ) );
$current_path = preg_replace('/\include/i', '', $current_path);

if(file_exists($current_path.'configs/config.php')) {
	require_once $current_path.'configs/config.php';
}

if(!defined('EXTERNAL_DIR')) {
	echo 'something wrong with the path "FULLCAL_DIR" or config.php not found, copy and rename config.example.php to config.php';exit;
}
require_once EXTERNAL_DIR.'/smarty/Smarty.class.php';
require_once CLASSES_DIR.'/calendar.class.php';
require_once CLASSES_DIR.'/lists.class.php';
require_once CLASSES_DIR.'/events.class.php';
require_once CLASSES_DIR.'/users.class.php';
require_once CLASSES_DIR.'/schedule.class.php';
require_once CLASSES_DIR.'/settings.class.php';
require_once LIB_DIR.'/utils.class.php';

if (!function_exists('json_encode')) {
	require_once LIB_DIR.'/jsonwrapper/jsonwrapper_inner.php';
}

if (session_id() == '') { session_start(); }    // moet altijd na de classes

require_once INCLUDE_DIR.'/validate_functions.php';
require_once CONFIG_DIR.'/db.config.php';
database_connect();

global $obj_smarty;
$obj_smarty = new Smarty();
$obj_smarty->compile_dir = FULLCAL_DIR.'/templates_c/';


if(defined('LANGUAGE')) {
	switch(LANGUAGE) {
		case 'EN';
			$locale = array('en_US.UTF-8', 'en_US', 'english', 'en_US.ISO_8859-1');
			break;
		case 'NL';
			$locale = array('nl_NL.UTF-8', 'nl_NL', 'nld_nld', 'dut', 'nla', 'nl', 'nld', 'dutch', 'nl_NL.ISO_8859-1');
			break;
		case 'DE';
			$locale = array('de_DE.UTF-8', 'de_DE', 'de', 'deutsch', 'deu_deu', 'de_DE.ISO_8859-1');
			break;
		case 'FR';
			$locale = array('fr_FR.UTF-8', 'fr_FR', 'french', 'fr_FR.ISO_8859-1');
			break;
		case 'ES';
			$locale = array('es_ES.UTF-8', 'es_ES', 'spanish', 'es_ES.ISO_8859-1');
			break;
		case 'PL';
			$locale = array('pl_PL.ISO_8859-1', 'pl_PL.UTF-8', 'pl_PL', 'polish');
			break;
        case 'NO';
			$locale = array('no_NO.UTF-8', 'no_NO', 'norwegian');
			break;
        case 'IT';
			$locale = array('it_IT.UTF-8', 'it_IT', 'italian');
			break;
        case 'CZ';
			$locale = array('cz_CZ.UTF-8', 'cz_CZ', 'czech');
			break;
	}

	setlocale(LC_ALL, $locale);
} else {
	setlocale(LC_ALL, '');
}

if(!IGNORE_TIMEZONE) {
	if(defined('TIMEZONE') && TIMEZONE != '' ) {
		$timezone_name = TIMEZONE;
	} else {
		$timezone_name = date_default_timezone_get();
	}
	date_default_timezone_set($timezone_name);
	$gettimezone = new DateTimeZone($timezone_name);
	$offset = ($gettimezone->getOffset(new DateTime) );
	define('TIME_OFFSET', $offset);
}
//if(User::isLoggedIn()) {
//	$arr_user = User::getUser();
//	$timezone = Settings::getTimezone($arr_user['user_id']);
//}
//if(!empty($timezone)) {
//	$timezone_name = $timezone;
//} else {
//	$timezone_name = date_default_timezone_get();
//}
//date_default_timezone_set($timezone_name);
//$gettimezone = new DateTimeZone($timezone_name);
//$offset = ($gettimezone->getOffset(new DateTime) );
//define('TIME_OFFSET', $offset);

?>