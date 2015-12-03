<?php
/*
 * Created on 17-okt-2014
 * author Paul Wolbers
 */

require_once 'include/default.inc.php';

if(!isset($_GET['action']) || (isset($_GET['action']) && ($_GET['action'] !== 'mobile_add' && $_GET['action'] !== 'mobile_addstoredtitles'))) {
    if(ALLOW_ACCESS_BY == 'ip') {
        if(defined('CAL_IP')) {
            if(($_SERVER['REMOTE_ADDR'] !== CAL_IP && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1')) {
                header('location: '.FULLCAL_URL.'/noaccess.html');  // fill in a website where you want to redirect
                exit;
            }
        } else {
            echo 'Check your config.php! When ALLOW_ACCESS_BY = ip, you have to define CAL_IP also';
            exit;
        }
    }
}

global $current_languages;
        
$arr_settings = Settings::getSettings();

$bln_found = false;
foreach($current_languages as $code => $lang) {
    if(strtoupper($arr_settings['language']) == $code) {
        $bln_found = true;
        $obj_smarty->assign('language', $code);
    }
}
if(!$bln_found) {
    if(!file_exists(FULLCAL_URL.'/script/lang'.strtoupper($arr_settings['language']).'.js')) {
        $obj_smarty->assign('language', 'EN');
    }
}
        
if(isset($_SESSION['ews_imported_users'])) {
      $_SESSION['ews_imported_users'] = array();
  }
  
if(isset($_GET['action'])) {
  	switch($_GET['action']) {
		case 'login':
		    login();
		    break;
		case 'logoff':
			logoff();
			break;
		case 'search':
		 	search();
		  	break;
		case 'get_tag':
		 	return getTag();
		  	break;
		case 'mobileadd':
			mobileAdd();
			break;
		case 'mobile_addstoredtitles':
			mobileAddStoredTitles();
			break;
		case 'admin_register':
			adminRegister();
			break;
		case 'activate':
			activate();
			break;
		case 'reset_password':
			resetPassword();
			break;
		case 'change_password':
			changePassword();
			break;
		case 'add_user':
			addUser();
			break;
		case 'get_profile':
			getProfile();
			break;
		case 'save_profile':
			saveProfile();
			break;
		case 'get_settings':
			getSettings();
			break;
		case 'save_settings':
			saveSettings();
			break;
        case 'get_current_event':
            return Events::getCurrentEvent(true);
            break;
        case 'new':
            newCalendarItem();
            break;
		case 'upload':
            upload();
            break;
		case 'get_files':
            getFiles();
            break;
		case 'remove_file':
            removeFile();
            break;
		default:
			die('no such action available');
  }

  exit;
} else {

	$arr_calendars = Calendar::getCalendars();
   
    // check if there is at least 1 calendar present
   // if(empty($arr_calendars) || !isset($arr_calendars[0])) {
    if(Calendar::noCalendarsCreated()) {
        Calendar::insertFirstCalendar();
        $arr_calendars = Calendar::getCalendars();
    }
 
	$str_default_calendars = Calendar::getDefaultCalendars($arr_calendars);
 
    $arr_user = User::getUser();
    
    $cnt_public = 0;
    $cnt_private = 0;
    $arr_movable_to = array();
    foreach($arr_calendars as $def) {
        if($def['share_type'] == 'public') {
            $cnt_public ++;
        }
        if($def['share_type'] == 'private' || $def['share_type'] == 'private_group') {
            $cnt_private ++;
        }
        $bln_owner = false;
        if(!is_null($arr_user)) {
            if($def['creator_id'] == $arr_user['user_id']) {
                // owner
                $bln_owner = true;
            }
        }
        if($def['can_add'] || $bln_owner) {
            $arr_movable_to[] = $def;
        }
    }
    
    $obj_smarty->assign('cnt_public', $cnt_public);
    $obj_smarty->assign('cnt_private', $cnt_private);
    
    $first_default_calendar = array();
    
    if(isset($arr_calendars[0])) {
        $obj_smarty->assign('default_calendar_color', $arr_calendars[0]['calendar_color']);
        
        $first_default_calendar = $arr_calendars[0];
        
        $arr_permissions = Calendar::getPermissions($first_default_calendar['calendar_id']);

        
    } else {
        $obj_smarty->assign('default_calendar_color', '#3366CC');
        
        $arr_permissions = array('can_edit' => false,
                                'can_delete' => false,
                                'can_see_dditems' => false,
                                'can_add' => false);
    }
	
	$obj_smarty->assign('my_active_calendars', $arr_calendars);
    $obj_smarty->assign('movable_to', $arr_movable_to);

	if(!empty($str_default_calendars)) {
		// one or more calendars have initial_show set to true
		$obj_smarty->assign('default_calendars', $str_default_calendars);

		if(!strstr($str_default_calendars, ',')) {
			$arr_cal = Calendar::getCalendar($str_default_calendars);
			$obj_smarty->assign('default_calendar_color', $arr_cal['calendar_color']);
		}
	} else {
		if(!empty($first_default_calendar)) {
            // no calendars have initial_show set to true, so use first calendar as default
            $first_default_calendar['initial_show'] = true;
            $obj_smarty->assign('default_calendars', $first_default_calendar['calendar_id']);
            $obj_smarty->assign('default_calendar_color', $first_default_calendar['calendar_color']);
        }
        
	}

	$obj_smarty->assign('default_calendar', $first_default_calendar);

    $arr_cal = $first_default_calendar;

    if(!empty($arr_cal)) {
        if(User::isLoggedIn()) {
            $arr_cal['isOwner'] = Calendar::isOwner($arr_cal['calendar_id']);
            $obj_smarty->assign('isOwner', $arr_cal['isOwner']);
        }

        $obj_smarty->assign('cal_can_edit', $arr_permissions['can_edit']);
        $obj_smarty->assign('cal_can_delete', $arr_permissions['can_delete']);
        $obj_smarty->assign('can_drag_dd_items', $arr_permissions['can_see_dditems']);
        $obj_smarty->assign('cal_can_change_color', (bool)$arr_cal['can_change_color']);
        $obj_smarty->assign('cal_alterable_startdate', $arr_cal['alterable_startdate']);
        $obj_smarty->assign('cal_alterable_enddate', $arr_cal['alterable_enddate']);
        $obj_smarty->assign('cal_can_mail', Calendar::calCanMail($arr_cal));
   
    }
    
    

    // determine how many intitial show 
    $arr_default_calendars = explode(',', $str_default_calendars);
    if(count($arr_default_calendars) > 1) {
        $obj_smarty->assign('cal_can_add', false);
	} else {
        $obj_smarty->assign('cal_can_add', $arr_permissions['can_add']);
	}
    
    //$obj_smarty->display(FULLCAL_DIR.'/view/cal.html');
    //exit;
}


Schedule::run();

global $current_languages;

$arr_submit 		= array(
	array('sq',  'string', false, 	''),
	array('sd', 'string', false, 	''),
	array('ft', 'string', false, 	''),
	array('cid',  'string', false, 	''),
);

$frm_submitted_initial      = validate_var($arr_submit);

if(!empty($frm_submitted_initial['sq'])) {
	if(!empty($frm_submitted_initial['sq'])) {
		$q = $frm_submitted_initial['sq'];
	}
	$obj_smarty->assign('sq', $q);
}

if(!empty($frm_submitted_initial['sd']) && !empty($frm_submitted_initial['ft'])) {

	$_SESSION['employee-work-schedule-sd'] = $frm_submitted_initial['sd'];
	$_SESSION['employee-work-schedule-ft'] = $frm_submitted_initial['ft'];

	$arr_goto_date = explode('-', $frm_submitted_initial['sd']);

	$month = $arr_goto_date[1]-1;
	if($month == -1) {
		$month = 11;
	}
	$obj_smarty->assign('gotoYear', $arr_goto_date[0]);
	$obj_smarty->assign('gotoMonth', $month);
	$obj_smarty->assign('gotoDay', $arr_goto_date[2]);


	if(!empty($frm_submitted_initial['cid'])) {
		if($frm_submitted_initial['cid'] == 'all') {
			$arr_calendars = Calendar::getCalendars();

			$cal_ids = array();

			foreach($arr_calendars as $cal) {
				$cal_ids[] = $cal['calendar_id'];
			}
			$obj_smarty->assign('default_calendars', 'all');//implode(',', $cal_ids));
		} else {
			$obj_smarty->assign('default_calendars', $frm_submitted_initial['cid']);
		}
	}
}
if(!User::isLoggedIn() && isset($_SESSION['calendar-uid'])) {
	unset($_SESSION['calendar-uid']);
}
if(User::isLoggedIn()) {
	header("Cache-Control: no-cache, must-revalidate");

	$arr_user 		= User::getUser();

	$obj_smarty->assign('name', $arr_user['firstname'].' '.(!empty($arr_user['infix']) ? $arr_user['infix'] : '').$arr_user['lastname']);
	$obj_smarty->assign('user', $_SESSION['calendar-uid']['username']);
	$obj_smarty->assign('user_id', $_SESSION['calendar-uid']['uid']);
	$obj_smarty->assign('is_admin', User::isAdmin());
	$obj_smarty->assign('is_super_admin', User::isSuperAdmin());
    
	
    $arr_settings = Settings::getSettings($arr_user['user_id']);
 
    $bln_found = false;
    foreach($current_languages as $code => $lang) {
        if(strtoupper($arr_settings['language']) == $code) {
            $bln_found = true;
        }
    }
    if(!$bln_found) {
        if(!file_exists(FULLCAL_URL.'/script/lang'.strtoupper($arr_settings['language']).'.js')) {
            $arr_settings['language'] = "EN";
        }
    }
    

    $obj_smarty->assign('settings', $arr_settings);
            
	// determine how many intitial show 
    $arr_default_calendars = explode(',', $str_default_calendars);
    if(count($arr_default_calendars) > 1) {
        $obj_smarty->assign('cal_can_add', false);
        $obj_smarty->assign('is_owner', false);
	} else {
        $obj_smarty->assign('cal_can_add', true);
        
        if(isset($arr_calendars[0])) {
            $obj_smarty->assign('is_owner', Calendar::isOwner($arr_calendars[0]['calendar_id']));
        } else {
            $obj_smarty->assign('is_owner', false);
        }
        
	}
    
//	$obj_smarty->assign('cal_can_edit', true);
//	$obj_smarty->assign('cal_can_delete', true);
	
	$obj_smarty->assign('cal_can_view', false);

	$obj_smarty->display(FULLCAL_DIR.'/view/cal.html');

} else if(ALLOW_ACCESS_BY == 'login') {
    $obj_smarty->display(FULLCAL_DIR.'/login.html');

} else {

	if(ADMIN_CAN_LOGIN_FROM_ADMIN_URL === true && ALLOW_ACCESS_BY == 'free' && !stristr($_SERVER['SCRIPT_NAME'], '/admin') && SHOW_SMALL_LOGIN_LINK === false) {
//		unset($_SESSION['calendar-uid']);
	}

	$obj_smarty->assign('is_admin', false);
	$obj_smarty->assign('is_super_admin', false);
    $obj_smarty->assign('is_owner', false);

    $arr_settings = Settings::getSettings();
    
    $bln_found = false;
    foreach($current_languages as $code => $lang) {
        if(strtoupper($arr_settings['language']) == $code) {
            $bln_found = true;
        }
    }
    if(!$bln_found) {
        if(!file_exists(FULLCAL_URL.'/script/lang'.strtoupper($arr_settings['language']).'.js')) {
            $arr_settings['language'] = "EN";
        }
    }

    $obj_smarty->assign('settings', $arr_settings);

   //print_r($arr_settings);exit; 
	if(!isset($_SESSION['calendar-uid'])) {
		if(defined('IP_AND_FREE_ACCESS_SAVED_USER_ID') && IP_AND_FREE_ACCESS_SAVED_USER_ID > 0 ) {
			$_SESSION['calendar-uid']['uid'] = IP_AND_FREE_ACCESS_SAVED_USER_ID;
	    } else {
	    	$_SESSION['calendar-uid']['uid'] = 1000000;
	    }
	}

	$obj_smarty->assign('user_id', $_SESSION['calendar-uid']['uid']);

    $obj_smarty->display(FULLCAL_DIR.'/view/cal.html');
}



exit;

function logoff() {
	unset($_SESSION['calendar-uid']);

	header('location: '.FULLCAL_URL);
	exit;
}

function login() {

	if((defined('ALLOW_ACCESS_BY') && ALLOW_ACCESS_BY == 'login') || (ALLOW_ACCESS_BY == 'free' && ADMIN_CAN_LOGIN_FROM_ADMIN_URL)) {
		global $error;
		global $obj_smarty;
                    
		$arr_submit 		= array(
			array('passw',    			'string',   	true, 	''),
			array('usern',    			'string',   	true, 	''),
		);

	   	$frm_submitted      = validate_var($arr_submit);

		if(SHOW_SMALL_LOGIN_LINK && !isset($frm_submitted['passw']) && !isset($frm_submitted['usern'])) {
			$obj_smarty->display(FULLCAL_DIR.'/login.html');
			exit;
		}

		if(!$error)	 {
			$msg = User::login($frm_submitted);
		}
		
		if(!empty($msg)) {
                
			$obj_smarty->assign('user', '');
			$obj_smarty->assign('msg', $msg);
			$obj_smarty->display(FULLCAL_DIR.'/login.html');
		} else {
			//$obj_smarty->display(CAL_DIR.'/view/cal.html');
			header('location:'.FULLCAL_URL);
		}

	} else {
		header('location:'.FULLCAL_URL);
	}
	exit;
}

function addUser() {
	User::checkLoggedIn();

	global $error;

	$arr_submit 		= array(
		array('firstname',    		'string',   	false, 	''),
		array('infix',    			'string',   	false, 	''),
		array('lastname',    		'string',   	true, 	''),
		array('username',    		'string',   	false, 	''),
		array('email',    			'email',   		true, 	''),
		array('copy_to_admin',    	'bool',   		false, 	false),
	);

   	$frm_submitted      = validate_var($arr_submit);

	if(!$error)	 {
		$mixed_success = User::addUser($frm_submitted);

		if(is_string($mixed_success)) {
			echo json_encode(array('success'=>false, 'error'=>$mixed_success));exit;
		} else {
			if($mixed_success['insert'] === false) {
				echo json_encode(array('success'=>false, 'error'=>'Failure while inserting the user'));exit;
			} else {
				$password = '';
				if(defined('SHOW_CREATED_PASSWORD_WHEN_ADMIN_ADDS_USER') && SHOW_CREATED_PASSWORD_WHEN_ADMIN_ADDS_USER) {
					if(isset($mixed_success['password'])) {
						$password = $mixed_success['password'];
					}
				}
				if($mixed_success['mail'] == 'notsend') {
					echo json_encode(array('success'=>false, 'password'=>$password, 'error'=>'User inserted succesfully, failure while sending email'));exit;
				} else {
					echo json_encode(array('success'=>true, 'password'=>$password, 'error'=>'User inserted succesfully and email send successfully'));exit;
				}
			}

			echo json_encode(array('success'=>$mixed_success));exit;
		}

	}

	echo json_encode(array('success'=>false, 'error'=>$error));exit;
}

function getProfile() {
	User::checkLoggedIn();

	$arr_user = User::getUserById($_SESSION['calendar-uid']['uid']);

	$arr_birthdate = explode('-', $arr_user['birth_date']);

	$arr_user['birthdate_month'] 	= $arr_birthdate[1];
	$arr_user['birthdate_day'] 		= $arr_birthdate[2];
	$arr_user['birthdate_year'] 	= $arr_birthdate[0];

	unset($arr_user['password']);
	unset($arr_user['birth_date']);

	echo json_encode(array('success'=>true, 'profile'=>$arr_user));exit;
}

function saveProfile() {
	User::checkLoggedIn();

	global $error;

	$arr_submit 		= array(
		array('firstname',    		'string',   	false, 	''),
		array('infix',    			'string',   	false, 	''),
		array('lastname',    		'string',   	true, 	''),
		array('country',    		'string',   	false, 	''),
		array('username',    		'string',   	false, 	''),
		array('email',    			'email',   		true, 	''),
		array('birthdate_day',    	'int',   		false, 	''),
		array('birthdate_month',    'int',   		false, 	''),
		array('birthdate_year',    	'int',   		false, 	''),
		array('password',    		'string',   	false, 	''),
		array('confirm',    		'string',   	false, 	''),
	);

   	$frm_submitted      = validate_var($arr_submit);

	if(!$error)	 {
		$bln_success = User::saveProfile($frm_submitted);

		if(!empty($frm_submitted['password']) && !empty($frm_submitted['confirm'])) {
			if($frm_submitted['password'] === $frm_submitted['confirm']) {

				$frm_submitted['passw1'] = $frm_submitted['password'];
				$frm_submitted['uid'] = $_SESSION['calendar-uid']['uid'];

				$bln_success = User::changePassword($frm_submitted);
	// TODO ? naar inlogpagina ?
			} else {
				echo json_encode(array('success'=>false, 'error'=>'Passwords do not match'));exit;
			}
		}
	}

	echo json_encode(array('success'=>$bln_success));exit;
}

function search() {
	global $error;
	global $obj_smarty;
	global $obj_db;

	$arr_return = array();

	$arr_submit 		= array(
		array('sq',    			'string',   	true, 	''),
		array('cal_id',    		'string',   	true, 	''),
	);

   	$frm_submitted      = validate_var($arr_submit);

	if(!empty($frm_submitted)) {
		if(isset($_SESSION['calendar-uid']) && $_SESSION['calendar-uid']['uid']) {
			$user_id = $_SESSION['calendar-uid']['uid'];
		} else {
			$user_id = 0;
		}

        $arr_calendars = array();
        
        if(!empty($frm_submitted['cal_id'])) {
            $arr_calendars = Calendar::getCalendars($frm_submitted['cal_id']);
        } 

        $arr_days = array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday');
		$arr_events = array();
        
        if(!empty($arr_calendars)) {
            foreach($arr_calendars as $calendar) {
                $str_query = 'SELECT e.*, re.rep_interval, re.weekdays, event_id as id, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end FROM events e' .
                                ' LEFT JOIN `repeating_events` re ON(re.rep_event_id = e.repeating_event_id)  WHERE title LIKE  "%'.$frm_submitted['sq'].'%" ' .
                                ($user_id > 0 && $calendar['share_type'] != "public" && ALLOW_ACCESS_BY !== 'free' && !Calendar::UserInGroup($calendar, $user_id) ? ' AND user_id = '.$user_id : '');


                $str_query .= ' AND calendar_id = '.$calendar['calendar_id'];

                $str_query .= ' ORDER BY date_start';

                $obj_result = mysqli_query($obj_db, $str_query);

                while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
                    $arr_events[] = $arr_line;
                }
            }
        }
        
		
        foreach($arr_events as $event) {
            $arr_weekdays = explode(',', $event['weekdays']);
			$str_weekdays = '';
			foreach($arr_weekdays as $day) {
				if(!empty($day)) {
					$str_weekdays .= $arr_days[$day].', ';
				}
			}
			$event['weekdays'] = $str_weekdays;
			$arr_return[] = $event;
        }
		$str_events = '';

		

	//	$_SESSION['employee-work-schedule-sq'] = $frm_submitted['sq'];
	} else {
		$arr_return = array();
		$frm_submitted['sq'] = '';
	}


	$obj_smarty->assign('results', $arr_return);
	$obj_smarty->assign('q', $frm_submitted['sq']);
	if(isset($frm_submitted['cal_id'])) {
		$obj_smarty->assign('cal_id', $frm_submitted['cal_id']);
	}


	$obj_smarty->display(FULLCAL_DIR.'/view/search_results.html');
}

function resetPassword() {
	if(defined('ALLOW_ACCESS_BY') && ALLOW_ACCESS_BY == 'login') {

		global $error;
		$use_captcha = true;

		$arr_submit 		= array(
			array('uid',    			'int',   	true, 	''),
			array('hash',    			'string',   		true, 	''),
		);

	   	$frm_submitted      = validate_var($arr_submit);

		if(!$error)	 {
			$bln_success = User::activate($frm_submitted, true);
		}
	} else {
		header('location:'.FULLCAL_URL);
		exit;
	}
}

function changePassword() {
	if(defined('ALLOW_ACCESS_BY') && (ALLOW_ACCESS_BY == 'login' || ALLOW_ACCESS_BY == 'free')) {
		global $error;
		$use_captcha = true;

		$arr_submit 		= array(
			array('passw1',    			'string',   	true, 	''),
			array('passw2',    			'string',   	true, 	''),
			array('uid',    			'int',   		true, 	''),
		);

	   	$frm_submitted      = validate_var($arr_submit);

		if(!$error)	 {
			$bln_success = User::changePassword($frm_submitted);
		}

		if($bln_success) {
			header('location:'.FULLCAL_URL);
			exit;
		}
	} else {
		header('location:'.FULLCAL_URL);
		exit;
	}
}

function activate() {
	global $error;
	$use_captcha = true;

	$arr_submit 		= array(
		array('uid',    			'int',   	true, 	''),
		array('hash',    			'string',   		true, 	''),
	);

   	$frm_submitted      = validate_var($arr_submit);

	if(!$error)	 {
		$bln_success = User::activate($frm_submitted);
	}
}

function adminRegister() {
	if(User::isLoggedIn() && (User::isAdmin() || User::isSuperAdmin())) {

		global $error;
		$use_captcha = true;
		global $obj_smarty;
		$bln_success = false;

		$arr_submit 		= array(
			array('lastname',    		'textonly',   	true, 	''),
			array('password',    		'string',   	true, 	''),
			array('username',    		'string',   	true, 	''),
			array('email',    			'string',   	true, 	'')
		);

	    $frm_submitted      = validate_var($arr_submit);

		if(!$error)	 {

			global $obj_db;
			$arr_user = null;

			// check if username does not exist
			$str_query = 'SELECT * FROM `users` ' .
					' WHERE `username` = "' .$frm_submitted['username'] .'"';

			$res1 = mysqli_query($obj_db, $str_query);

			if($res1 !== false) {
				$arr_user = mysqli_fetch_array($res1, MYSQLI_ASSOC);
			}

			if(!is_null($arr_user) && !empty($res1)) {
	        	echo 'Username already exists';

			} else {
				// check mailaddress
				$str_query = 'SELECT * FROM `users` ' .
						' WHERE `email` = "' .$frm_submitted['email'] .'"';

				$res2 = mysqli_query($obj_db, $str_query);

				if($res2 !== false) {
					$arr_user2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
				}
				if(!is_null($arr_user2) && !empty($res2)) {
		        	echo 'Email already exists';

				} else {
					$bln_success = User::adminRegister($frm_submitted, true);
				}
				if($bln_success === false) {
					echo 'Admin must be logged in';
				}

			}

		} else {
			echo $error;
		}

		if($bln_success) {
			echo 'User inserted successfully';
		}
	} else {
		echo 'No admin is logged in or you have no rights to do this';
	}
}

function getSettings() {
	global $obj_smarty;

	$arr_user 		= User::getUser();

	echo json_encode(array('success'=>true,
							'user_id'=>$arr_user['user_id'],
							'settings'=>Settings::getSettings($arr_user['user_id'])
							));
	exit;

}

function saveSettings() {
	global $error;
	User::checkLoggedIn();

	global $error;

	$arr_submit 		= array(
		array('language',    		'string',   	false, 	''),
		array('other_language',    	'string',   	false, 	''),
		array('default_view',    	'string',   	false, 	''),
		array('timezone',    		'string',   	false, 	''),
		array('user_id',    		'int',   		true, 	''),

	);

   	$frm_submitted      = validate_var($arr_submit);

	if(!$error)	 {

		$arr_user 		= User::getUser();

		if($frm_submitted['user_id'] == $arr_user['user_id']) {
			unset($frm_submitted['user_id']);

			Settings::saveSettings($frm_submitted, '', $arr_user['user_id']);

		} else {
			echo json_encode(array('success'=>false, 'error'=>'NO rights to do that'));exit;

		}

	} else {
		echo json_encode(array('success'=>false, 'error'=>$error));exit;
	}

	echo json_encode(array('success'=>true));exit;

	//$obj_smarty->assign('active', 'settings');
	//$obj_smarty->assign('settings', Settings::getSettings($arr_user['user_id']));
	//$obj_smarty->display(FULLCAL_DIR.'/view/user_panel.tpl');
	//exit;

}

function getFiles() {
    $arr_submit 		= array(
		array('event_id',    		'int',   	true, 	''),
		
	);

   	$frm_submitted      = validate_var($arr_submit);
    
    $arr_files = Events::getFiles($frm_submitted['event_id']);
    
    echo json_encode(array('success'=>true, 'files'=>$arr_files));exit;
}

function removeFile() {
    $arr_submit 		= array(
		array('event_id',    		'int',   	true, 	''),
		array('event_file_id',    	'int',   	true, 	''),
		
	);

   	$frm_submitted      = validate_var($arr_submit);
    
    Events::removeFile($frm_submitted['event_id'], $frm_submitted['event_file_id']);
    
    $arr_files = Events::getFiles($frm_submitted['event_id']);
    
    echo json_encode(array('success'=>true, 'files'=>$arr_files));exit;
}

function upload() {
    
    $arr_submit 		= array(
		array('upload_event_id',    		'int',   	true, 	''),
		
	);

   	$frm_submitted      = validate_var($arr_submit);
  
    $file_error = '';
    switch($_FILES['file']['error']){
        case 0: //no error; 
            
            break;
        case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
            $file_error = 'TOO_BIG';   //"The file you are trying to upload is too big.";
            break;
        case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
            $file_error = 'TOO_BIG';   //"The file you are trying to upload is too big.";
            break;
        case 3: //uploaded file was only partially uploaded
            $file_error = 'PARTIALLY_UPLOADED';   //"The file you are trying upload was only partially uploaded.";
            break;
        case 4: //no image file was uploaded
            $file_error = 'NO_FILE_SELECTED';   //"You must select a file for upload.";
            break;
        default: //a default error, just in case!  :)
            $file_error = 'PROBLEM_WITH_UPLOAD';   //"There was a problem with your upload.";
            break;
    }

    if(!empty($file_error)) {
        echo json_encode(array('success' => false,'error' => $file_error)); exit;
    }
    
    // get extension
    $arr_type = explode('/', $_FILES['file']['type']);
    
    $arr_file['extension'] = $arr_type[1];
    $arr_file['orig_filename'] = $_FILES['file']['name'];
    $arr_file['type'] = $_FILES['file']['type'];
    $arr_file['filename'] = sha1_file($_FILES['file']['tmp_name']);
    $arr_file['size'] = $_FILES['file']['size'];
    $arr_file['event_id'] = $frm_submitted['upload_event_id'];
    
    if($arr_file['extension'] == 'jpeg') {
        $arr_file['extension'] = 'jpg';
    }
    if($arr_file['extension'] == 'x-log') {
        $arr_file['extension'] = 'log';
    }   
    //rejects all .exe, .com, .bat, .zip, .doc and .txt files
    if(preg_match('/\\.(exe|com|bat|zip|apk|js|jsp)$/i', $arr_file['orig_filename'])){
        echo json_encode(array('success' => false,'error' => 'FILE_NOT_ALLOWED')); exit;
    }

    if((int)$arr_file['size'] <= 5000000) {
         if(move_uploaded_file($_FILES['file']['tmp_name'],FULLCAL_DIR. '/uploads/' . $arr_file['filename'] . '.' . $arr_file['extension'])) {
            // save the new file in the event_files table
            $bln_success = Events::insertUploadedFile($arr_file);

            if($bln_success) {
                $arr_file = Events::getEventFile($frm_submitted['upload_event_id'], $arr_file['filename']);
                $cnt_files = Events::getCntFiles($frm_submitted['upload_event_id']);
                
                echo json_encode(array('success' => true,'file' => $arr_file, 'cnt_files' => $cnt_files)); exit;
            } else {
                echo json_encode(array('success' => false,'error' => 'File is already uploaded')); exit;
            }
        }
    } else {
        echo json_encode(array('success' => false,'error' => 'The file is too big')); exit;
    }
   
}

function newCalendarItem() {
    global $obj_smarty;
    
   // $obj_smarty->assign('results', $arr_return);
	//$obj_smarty->assign('q', $frm_submitted['sq']);
	

	$obj_smarty->display(FULLCAL_DIR.'/view/new.tpl');
}

function mobileAdd() {

    global $error;

  	$arr_submit 		= array(
  		array('color',			'string',   	false, 	'#3366CC'),
  		array('date_end',		'int',   		false, 	''),
  		array('date_start',		'int',   		false, 	''),
  		array('title',			'string',   	true, 	''),
  		array('username',		'string',   	false, 	''),
  		array('password',		'string',   	false, 	''),
  		array('day',			'string',   	true, 	''),
  		array('allDay',			'bool',   	false, 	''),
  	);

    $frm_submitted      = validate_var($arr_submit);

    // check user
    $int_user_id = 0;
    if(User::UserAuthenticated($frm_submitted['username'], $frm_submitted['password'], $int_user_id)) {
		// returned by reference user_id
    } else {
      	echo 'username or password wrong';exit;
    }

    if(empty($frm_submitted['title'])) {
        echo 'Title can not be empty';exit;
    }

    $frm_submitted['title'] = str_replace('_',' ',$frm_submitted['title']);
    $frm_submitted['color'] = '#'.$frm_submitted['color'];

    if(isset($frm_submitted['day'])) {
        $today = date('Y-m-d');

        if($frm_submitted['day'] == 'today' || $frm_submitted['day'] == 'vandaag') {
            if($frm_submitted['allDay']) {
                $frm_submitted['date_start'] = strtotime($today .' '.'00:00:00');
            } else {
                $frm_submitted['date_start'] = time();
            }

        } else if($frm_submitted['day'] == 'yesterday') {
            if($frm_submitted['allDay']) {
                $frm_submitted['date_start'] = strtotime($today .' '.'00:00:00') - 86400;
            } else {
                $frm_submitted['date_start'] = time() - 86400;
            }


        } else if($frm_submitted['day'] == 'daybeforeyesterday') {
            if($frm_submitted['allDay']) {
                $frm_submitted['date_start'] = strtotime($today .' '.'00:00:00') - (2*86400);
            } else {
                $frm_submitted['date_start'] = time() - (2*86400);
            }

        } else if($frm_submitted['day'] == 'tomorrow') {
            if($frm_submitted['allDay']) {
                $frm_submitted['date_start'] = strtotime($today .' '.'00:00:00') + 86400;
            } else {
                $frm_submitted['date_start'] = time() + 86400;
            }
        }
    }

  	global $obj_db;
	if(empty($frm_submitted['date_end'])) {
		$frm_submitted['date_end'] = $frm_submitted['date_start'];
	}

	if(!isset($frm_submitted['color'])) {
		$frm_submitted['color'] = '';
	}
	$str_query = 'INSERT INTO events (title, user_id, color, date_start, time_start, date_end, time_end, allday) ' .
			'VALUES ("'.$frm_submitted['title'].'",'.
					$int_user_id.','.
					' "'.$frm_submitted['color'].'",'.
					' "'.date('Y-m-d', $frm_submitted['date_start']).'",'.
					' "'.date('H:i:s', $frm_submitted['date_start']).'",'.
					' "'.date('Y-m-d', $frm_submitted['date_end']).'",'.
					' "'.date('H:i:s', $frm_submitted['date_end']).'"'.
					( (date('H:i:s', $frm_submitted['date_start']) == '00:00:00' && date('H:i:s', $frm_submitted['date_end']) == '00:00:00') || $frm_submitted['allDay'] ? ' ,1' : ' ,0') .')';

	$obj_result = mysqli_query($obj_db, $str_query);


    if($obj_result !== false) {
        echo  'Saved succesfully';
    } else {
        echo 'failure';
    }
    exit;
}

function mobileAddStoredTitles() {
    global $error;

  	$arr_submit 		= array(
  		array('cal_id',			'int',   		false, 	''),
  		array('color',			'string',   	false, 	''),
  		array('date_end',		'int',   		false, 	''),
  		array('date_start',		'int',   		false, 	''),
  		array('title',			'string',   	true, 	''),
  		array('username',		'string',   	true, 	''),
  		array('password',		'string',   	true, 	''),
  		array('store',			'string',   	true, 	''),
  		array('allDay',			'bool',   		false, 	''),
  	);

    $frm_submitted      = validate_var($arr_submit);

    // check user
    $int_user_id = 0;
    if(User::UserAuthenticated($frm_submitted['username'], $frm_submitted['password'], $int_user_id)) {
		// returned by reference user_id
    } else {
      	echo 'username or password wrong';exit;
    }

    if(empty($frm_submitted['store'])) {
        echo 'No items where send';exit;
    }
    // setlocale(LC_ALL, 'nl_NL');
    global $obj_db;

    $str_store = str_replace(array('(',')'), '', $frm_submitted['store']);
    $arr_store = explode('|', $str_store);

    unset($arr_store[0]);

    $arr_maanden = array('jan'=>1,'feb'=>2,'mrt'=>3,'apr'=>4,'mei'=>5,'jun'=>6,'jul'=>7,'aug'=>8,'sep'=>9,'okt'=>10,'nov'=>11,'dec'=>12);

    foreach($arr_store as $title) {
        $arr_title      = explode(';', $title);
        $str_title      = str_replace('_', ' ', $arr_title[0]);
        $str_date       = str_replace('_', '', $arr_title[3]);
        $str_day        = str_replace('_', '', $arr_title[1]);
        $str_time       = str_replace('_', '', $arr_title[4]);
        $bln_allday     = str_replace('_', '', $arr_title[2]) == 'true' ? true : false;
        $arr_date_parts = date_parse_from_format("dMY", $str_date);//echo $arr_title[3];
        $monthname = preg_replace('/[0-9]/','',$str_date);
        $monthname = str_replace('.', '', $monthname);
        $monthnumber = $arr_maanden[$monthname];

        $inputday       = $arr_date_parts['year'].'-'.$monthnumber.'-'.$arr_date_parts['day'];

        if($str_day == 'today') {
            if($bln_allday) {
                $frm_submitted['date_start'] = strtotime($inputday .' '.'00:00:00');
            } else {
                $frm_submitted['date_start'] = strtotime($inputday .' '.$str_time);
            }

        } else if($str_day == 'yesterday') {
            if($bln_allday) {
                $frm_submitted['date_start'] = strtotime($inputday .' '.'00:00:00') - 86400;
            } else {
                $frm_submitted['date_start'] = strtotime($inputday .' '.$str_time) - 86400;
            }

        } else if($str_day == 'daybeforeyesterday') {
            if($bln_allday) {
                $frm_submitted['date_start'] = strtotime($inputday .' '.'00:00:00') - (2*86400);
            } else {
                $frm_submitted['date_start'] = strtotime($inputday .' '.$str_time) - (2*86400);
            }
        }
        if(!isset($frm_submitted['date_start']) ) {
            $frm_submitted['date_start'] = time();
        }

        $frm_submitted['date_end'] = $frm_submitted['date_start'];

        $str_query = 'INSERT INTO events (title, user_id, color, date_start, time_start, date_end, time_end, allday) ' .
        		'VALUES ("'.$str_title.'",'.
        			  $int_user_id.','.
        				' "#'.$frm_submitted['color'].'",'.
        				' "'.date('Y-m-d', $frm_submitted['date_start']).'",'.
        				' "'.date('H:i:s', $frm_submitted['date_start']).'",'.
        				' "'.date('Y-m-d', $frm_submitted['date_end']).'",'.
        				' "'.date('H:i:s', $frm_submitted['date_end']).'"'.
        				((date('H:i:s', $frm_submitted['date_start']) == '00:00:00' && date('H:i:s', $frm_submitted['date_end']) == '00:00:00') || $bln_allday ? ' ,1' : ' ,0').')';
        $obj_result = mysqli_query($obj_db, $str_query);

        if($obj_result !== false) {
            echo  'Saved succesfully';// echo json_encode(array('success'=>true, 'msg'=>'gelukt'	));exit;
        } else {
            echo 'failure';
        }
    }
}


function getTag() {
	global $obj_db;

	if(isset($_GET['uid'])) {
		$user_id = $_GET['uid'];
	} else if(isset($_SESSION['calendar-uid']) && isset($_SESSION['calendar-uid']['uid']) && $_SESSION['calendar-uid']['uid'] > 0) {
		    
        if(ALLOW_ACCESS_BY == 'free') {
			$user_id = 0;
		} else {
			$user_id = $_SESSION['calendar-uid']['uid'];
		}

	} else {
		$user_id = 0;
	}

	$str_query = 'SELECT *, event_id as id, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end FROM events ' .
					' WHERE title LIKE  "%'.$_POST['tag'].'%" ' .
					($user_id > 0 ? ' AND user_id = '.$user_id : '').
					' ORDER BY date_start';
	$obj_result = mysqli_query($obj_db, $str_query);

    $str_events = '<span style="font-family:lucida-handwriting;">';

  	while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
	//	$arr_line['title'] = str_replace('<br />', ' ', $arr_line['title']);
    //$arr_line['title'] = str_replace( "\n", ' ', $arr_line['title']);
    $arr_line['title'] = str_replace($_POST['tag'], '<strong>'.$_POST['tag'].'</strong>', $arr_line['title']);
	$arr_line['title'] = str_replace(ucfirst($_POST['tag']), '<strong>'.ucfirst($_POST['tag']).'</strong>', $arr_line['title']);

		if($arr_line['date_start'] == $arr_line['date_end']) {
			$str_events .= '<span style="background-color:#FEFFAF;">'.$arr_line['date_start'].'</span>:<br /><em>'.$arr_line['title'].'</em><br />';
		} else {
			$str_events .= '<span style="background-color:#FEFFAF;">'.$arr_line['date_start'].'</span> - '.$arr_line['date_end'].':<br /><em>'.$arr_line['title'].'</em><br />';
		}

	}
	$str_events .= '</span>';

	echo json_encode($str_events);exit;
	return $str_events;

}



function showExampleAgendaWidget($bln_google_like=false) {
    global $error;
    global $current_languages;
    
	$arr_submit 		= array(
		array('from',			'string',   	false, 	''),
		array('to',				'string',   	false, 	''),
		array('uid',			'int',   		false, 	''),
		array('c',				'string',   	false, 	''),
		array('w',				'int',   		false, 	200),
		array('hrs',			'int',   		false, 	24),
		array('ebc',			'string',   	false, 	'FFFFCC'),	// event background color
		array('bc',				'string',   	false, 	'FFFFCC'),	// background color
		array('showec',			'string',   	false, 	'no'),		// show event color
		array('lang',			'string',   	false, 	''),
		array('ics',			'string',   	false, 	'no'),
		array('period',			'int',   		false, 	''),
		array('google_calid',	'string',   	false, 	''),
		array('google_privatekey',	'string',   	false, 	''),
	);

	$frm_submitted      = validate_var($arr_submit);

	$obj_smarty = new Smarty();
	$obj_smarty->compile_dir = 'templates_c/';

	if(!empty($frm_submitted['lang'])) {
		$frm_submitted['lang'] = strtolower($frm_submitted['lang']);

        $bln_found = false;
        foreach($current_languages as $code => $lang) {
            if(strtoupper($frm_submitted['lang']) == $code) {
                $bln_found = true;
            }
        }
       
		if($bln_found) {
			Utils::setLocaleLanguage($frm_submitted['lang']);
		}
	}

	header("Content-Type: text/html;charset=UTF-8");

	$obj_smarty->assign('iframewidth', $frm_submitted['w']);
	$obj_smarty->assign('showeventcolor', $frm_submitted['showec']);
	$obj_smarty->assign('hrs', $frm_submitted['hrs']);

	$arr_res = array();

		$arr_res['results'] = array (

				 date('Y-m-d', strtotime('+2DAY')) => array(array (
			    'event_id' => 102,
			    'title' => 'Walking in the Belgian hills near Spa',
			    'date_start' => date('Y-m-d', strtotime('+2DAY')),
			    'time_start' => '12:16:58',
			    'date_end' => date('Y-m-d', strtotime('+2DAY')),
			    'time_end' => '17:27:45',
			    'allDay' => '1',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#FFBB00',
			  ))
			  ,
			   date('Y-m-d', strtotime('+3DAY')) => array(array (
			    'event_id' => 102,
			    'title' => 'Luxembourg',
			    'date_start' => date('Y-m-d', strtotime('+3DAY')),
			    'time_start' => '12:16:58',
			    'date_end' => date('Y-m-d', strtotime('+3DAY')),
			    'time_end' => '17:27:45',
			    'allDay' => '1',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#FFBB00',
			  ))
			  ,
			  date('Y-m-d', strtotime('+4DAY')) => array(array (
			    'event_id' => 102,
			    'title' => 'Stayed at the campingsite',
			    'date_start' => date('Y-m-d', strtotime('+4DAY')),
			    'time_start' => '12:16:58',
			    'date_end' => date('Y-m-d', strtotime('+4DAY')),
			    'time_end' => '17:27:45',
			    'allDay' => '1',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#3366cc',
			  ))
			  ,

			  date('Y-m-d', strtotime('+5DAY')) => array(array (
			    'event_id' => 104,
			    'title' => 'another event',
			    'date_start' => date('Y-m-d', strtotime('+5DAY')),
			    'time_start' => '6:59:52',
			    'date_end' => date('Y-m-d', strtotime('+5DAY')),
			    'time_end' => '14:50:36',
				'allDay' => '1',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#3366cc',
			  ))
			  ,

			  date('Y-m-d', strtotime('+6DAY')) => array(array (
			    'event_id' => 105,
			    'title' => 'yet another event',
			    'date_start' => date('Y-m-d', strtotime('+6DAY')),
			    'time_start' => '10:58:21',
			    'date_end' => date('Y-m-d', strtotime('+6DAY')),
			    'time_end' => '14:21:26',
			    'allDay' => '1',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#3366cc',
			  ),array (
			    'event_id' => 106,
			    'title' => 'Back home',
			    'date_start' => date('Y-m-d', strtotime('+6DAY')),
			    'time_start' => '11:35:28',
			    'date_end' => date('Y-m-d', strtotime('+6DAY')),
			    'time_end' => '18:15:41',
			    'allDay' => '0',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#3366cc',
			  ))
			  ,

			);

	$arr_return['hide_from'] = false;
	$arr_return['hide_to'] = false;

	if(defined('AGENDA_VIEW_AMOUNT_DAYS_TO_SHOW') && AGENDA_VIEW_AMOUNT_DAYS_TO_SHOW > 0) {
		$amount_days_to_show = AGENDA_VIEW_AMOUNT_DAYS_TO_SHOW;
	} else {
		$amount_days_to_show = 5;
	}

	if(!empty($frm_submitted['from'])) {
		$arr_res['hide_from'] = true;

	}
	if(!empty($frm_submitted['to'])) {
		$arr_res['results'] = array (
			date('Y-m-d', strtotime('-4DAY')) => array(array (
			    'event_id' => 99,
			    'title' => 'felisc',
			    'date_start' => date('Y-m-d', strtotime('-4DAY')),
			    'time_start' => '9:21:48',
			    'date_end' => date('Y-m-d', strtotime('-4DAY')),
			    'time_end' => '13:54:41',
			    'allDay' => '0',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#3366cc',
			  ))
			  ,

			date('Y-m-d', strtotime('-1DAY')) => array(array (
			    'event_id' => 100,
			    'title' => 'felisc',
			    'date_start' => date('Y-m-d', strtotime('-1DAY')),
			    'time_start' => '9:21:48',
			    'date_end' => date('Y-m-d', strtotime('-1DAY')),
			    'time_end' => '13:54:41',
			    'allDay' => '0',
			    'calendartype' => '',
			    'user_id' => '2',
			    'color' => '#3366cc',
			  ))
			  ,
		);
		if(count($arr_res['results']) < $amount_days_to_show) {
			$arr_res['hide_to'] = true;
		}
	}

	if(empty($frm_submitted['from']) && empty($frm_submitted['to'])) {
		$arr_res['hide_from'] = true;
	}

	$obj_smarty->assign('items', $arr_res['results']);
	$obj_smarty->assign('from', current(array_keys($arr_res['results'])));
	$obj_smarty->assign('to', end(array_keys($arr_res['results'])));
	$obj_smarty->assign('hide_from', $arr_res['hide_from']);
	$obj_smarty->assign('hide_to', $arr_res['hide_to']);


	if($bln_google_like) {
		$obj_smarty->display(FULLCAL_DIR.'/view/examples/agenda_widget_google_like.html');

	} else {
//		$frm_submitted['from'] = date('Y-m-d');
//		unset($frm_submitted['to']);
//		$frm_submitted['combine_moreday_events'] = false;
//
//		$arr_res = Events::getListviewEvents($frm_submitted);
//
//		if(isset($arr_res)) {
//		    $obj_smarty->assign('items', $arr_res['results']);
//			$obj_smarty->assign('from', $arr_res['results']);
//			$obj_smarty->assign('to', $arr_res['results']);
//		}

		$obj_smarty->display(FULLCAL_DIR.'/view/examples/agenda_widget_justtext.html');
	}
}
?>