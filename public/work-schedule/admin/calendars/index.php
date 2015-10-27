<?php
/*
 * Created on 14-sep-2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


require_once '../../include/default.inc.php';

if(isset($_SESSION['add_user_error'])) {
	$_SESSION['add_user_error'] = '';
}


if(User::isLoggedIn()) {
	header("Cache-Control: no-cache, must-revalidate");

	global $obj_smarty;

	$arr_user 		= User::getUser();
	$bln_user 		= User::isUser();
	$bln_admin 		= User::isAdmin();
	$bln_superadmin = User::isSuperAdmin();

	$obj_smarty->assign('name', $arr_user['firstname'].' '.(!empty($arr_user['infix']) ? $arr_user['infix'] : '').$arr_user['lastname']);
	$obj_smarty->assign('user', $_SESSION['calendar-uid']['username']);
	$obj_smarty->assign('user_id', $_SESSION['calendar-uid']['uid']);
	$obj_smarty->assign('is_user', $bln_user);
	$obj_smarty->assign('is_admin', $bln_admin);
	$obj_smarty->assign('is_super_admin', $bln_superadmin);

	$language = Settings::getLanguage($arr_user['user_id']);
	$obj_smarty->assign('language', $language);

	if($bln_superadmin) {
        $arr_calendars = Calendar::getCalendars(true);
        $obj_smarty->assign('calendars', $arr_calendars);
    } else if($bln_admin) {
		$arr_calendars = Calendar::getCalendarsOfAdmin($arr_user['user_id']);
		$obj_smarty->assign('calendars', $arr_calendars);
	} 

    $arr_calendars = Calendar::getCalendarsOfAdmin($arr_user['user_id'], true);
    
    $obj_smarty->assign('cnt_deleted_calendars', count($arr_calendars));
    
    
} else {
    $obj_smarty->display(FULLCAL_DIR.'/login.html');
    exit;
}

if(isset($_GET['action'])) {
  	switch($_GET['action']) {
		case 'get_calendar':
			getCalendar();
			break;
		case 'save_calendar':
			saveCalendar();
			break;
		case 'new_calendar':
			newCalendar();
			break;
		case 'add_calendar':
			addCalendar();
			break;
		case 'delete':
			deleteCalendar();
			break;
		case 'undelete':
			undeleteCalendar();
			break;
        case 'get_deleted':
			getDeletedCalendars();
			break;
		
		default:
			die('no such action available');
  }

  exit;
} else {
	$obj_smarty->assign('active', 'calendars');

	$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
	exit;
}


function getCalendars() {
	global $obj_smarty;
	$arr_users = array();

	$arr_user 		= User::getUser();
	$bln_admin 		= User::isAdmin();
	$bln_superadmin = User::isSuperAdmin();

	$obj_smarty->assign('name', $arr_user['firstname'].' '.(!empty($arr_user['infix']) ? $arr_user['infix'] : '').$arr_user['lastname']);
	$obj_smarty->assign('user', $_SESSION['calendar-uid']['username']);
	$obj_smarty->assign('user_id', $_SESSION['calendar-uid']['uid']);
	$obj_smarty->assign('is_admin', $bln_admin);
	$obj_smarty->assign('is_super_admin', $bln_superadmin);

	if($bln_admin) {
		$arr_calendars = Calendar::getCalendars();
	}
	return $arr_calendars;
}

function getCalendar() {
	$arr_submit 		= array(
		array('cid',    		'int',   	true, 	''),

	);

   	$frm_submitted      = validate_var($arr_submit);

	global $obj_smarty;

	//if(User::isAdminUser($frm_submitted['cid'])) {

		$arr_calendar = Calendar::getCalendar($frm_submitted['cid'], false);    // when dditems must be string -> true

        $str_dditems = '';
        foreach($arr_calendar['dditems'] as $dditem) {
            if(!is_null($dditem['color']) && !empty($dditem['color'])) {
                $str_dditems .= $dditem['title'].'|'.$dditem['info'].'|'.$dditem['color'].', ';
            } else {
                $str_dditems .= $dditem['title'].'|'.$dditem['info'].', ';
            }
        }
		//$arr_birthdate = explode('-', $arr_calendar['birth_date']);

		$obj_smarty->assign('active', 'calendar');
		$obj_smarty->assign('calendar', $arr_calendar);
        $obj_smarty->assign('cnt_dditems', count($arr_calendar['dditems']));
        $obj_smarty->assign('last_dditem', (int)$arr_calendar['dditems'][count($arr_calendar['dditems'])-1]['dditem_id']);
        $obj_smarty->assign('str_dditems', $str_dditems);
        
		$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
		exit;

//	} else {
//		$obj_smarty->assign('active', 'calendars');
//		$obj_smarty->assign('error', 'NO rights to change this calendar');
//
//		$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
//		exit;
//	}

}

function saveCalendar() {

	global $error;
	global $obj_smarty;

	$arr_submit 		= array(
		array('calendar_id',                'int',   		false, 	-1),
		array('name',                       'string',   	true, 	''),
		array('dditems',                    'string',   	false, 	''),
		array('calendar_color',             'string',   	true, 	''),
		array('can_add',                    'bool',   		false, 	0),
		array('can_edit',                   'bool',   		false, 	0),
		array('can_delete',                 'bool',   		false, 	0),
		array('can_change_color',           'bool',   		false, 	0),
		array('can_dd_drag',                'string',  		false, 	''),
		array('checkbox_use_color_for_all_events', 'bool',  false,  0),
		array('initial_show',               'bool',   		false, 	0),
        array('users_can_email_event',    	'bool',   		false, 	0),
        array('all_event_mods_to_admin',   	'bool',   		false, 	0),
        array('active',                     'string',   	true, 	''),
        array('cal_startdate',              'string',   	false, 	''),
        array('cal_enddate',                'string',   	false, 	''),
        array('alterable_startdate',        'string',   	false, 	''),
        array('alterable_enddate',          'string',   	false, 	''),
        array('share_type',                 'string',   	true, 	'private_group'),
		array('calendar_admin_email',       'email',        false, 	''),
        
	);

   	$frm_submitted      = validate_var($arr_submit);

	//if(User::isAdminUser($frm_submitted['user_id'])) {

		if(!$error || is_null($error))	 {
			$bln_success = Calendar::saveCalendar($frm_submitted);

			if(is_string($bln_success)) {
				echo json_encode(array('success'=>false, 'save_calendar_error'=>$bln_success));exit;
			}


		} else {
			$obj_smarty->assign('save_calendar_error', $error);
		}
	//} else {
	//	$obj_smarty->assign('error', 'NO rights to change this user');
	//}

    if(!is_null($error) && $error !== false) {
        // give feedback about the error
        $arr_calendar = Calendar::getCalendar($frm_submitted['calendar_id'], true);

		//$arr_birthdate = explode('-', $arr_calendar['birth_date']);

		$obj_smarty->assign('active', 'calendar');
		$obj_smarty->assign('calendar', $arr_calendar);

		$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
		exit;
    } else {
        header('location: '.FULLCAL_URL.'/admin/calendars');
        exit;
    }
   
}

function newCalendar() {
	global $obj_smarty;

	$arr_calendar = array('calendar_color'=>'#3366CC');
	$obj_smarty->assign('calendar', $arr_calendar);
	
	$obj_smarty->assign('active', 'calendar');

	$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
}

function addUser() {
	global $error;
	global $obj_smarty;

	$arr_submit 		= array(
		array('firstname',    		'string',   	false, 	''),
		array('infix',    			'string',   	false, 	''),
		array('lastname',    		'string',   	true, 	''),
		array('username',    		'string',   	false, 	''),
		array('email',    			'email',   		true, 	''),
	);

   	$frm_submitted      = validate_var($arr_submit);
	$_SESSION['add_user_error'] = '';

	if(!$error || is_null($error))	 {
		$mixed_success = User::addUser($frm_submitted);

		if(is_string($mixed_success)) {
			$_SESSION['add_user_error'] = $mixed_success;

		} else {
			if($mixed_success['insert'] === false) {
				$_SESSION['add_user_error'] = 'Failure while inserting the user';

			} else {
				if($mixed_success['mail'] == 'notsend') {
					$_SESSION['add_user_error'] = 'User inserted succesfully, failure while sending email';

				} else {
//					$obj_smarty->assign('active', 'users');
//					$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
//					exit;
				}

			}


		}

	} else {
		$obj_smarty->assign('active', 'new_user');
		$obj_smarty->assign('error', $error);
		$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
		exit;
	}
	header('location: '.FULLCAL_URL.'/admin/users');
	exit;
}

function deleteCalendar() {
	global $error;
	global $obj_smarty;

	$arr_submit 		= array(
		array('cid',    		'int',   	true, 	''),

	);

   	$frm_submitted      = validate_var($arr_submit);

	if(User::isAdmin() || User::isSuperAdmin()) {
		$bln_success = Calendar::deleteCalendar($frm_submitted['cid']);

		if($bln_success) {
			$obj_smarty->assign('msg', 'Calendar deleted succesfully - <a href="'.FULLCAL_URL.'/admin/calendars/?action=undelete&cid='.$frm_submitted['cid'].'">Undo</a>');
		}

		$arr_calendars = Calendar::getCalendars();
		$obj_smarty->assign('calendars', $arr_calendars);
		$obj_smarty->assign('active', 'calendars');
        
        $arr_user = User::getUser();
        $arr_calendars = Calendar::getCalendarsOfAdmin($arr_user['user_id'], true);
        $obj_smarty->assign('cnt_deleted_calendars', count($arr_calendars));

	} else {
		$obj_smarty->assign('error', 'NO rights to delete this calendar');
	}

	$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
	exit;
}

function undeleteUser() {
	global $error;
	global $obj_smarty;

	$arr_submit 		= array(
		array('uid',    		'int',   	true, 	''),

	);

   	$frm_submitted      = validate_var($arr_submit);

	if(User::isAdminUser($frm_submitted['uid'])) {
		$bln_success = User::undeleteUser($frm_submitted['uid']);

		if($bln_success) {
			$obj_smarty->assign('msg', 'User is back again');
		}

		$arr_users = getUsers();
		$obj_smarty->assign('users', $arr_users);
		$obj_smarty->assign('active', 'users');

	} else {
		$obj_smarty->assign('error', 'NO rights to undelete this user');
	}

	$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
	exit;
}

function undeleteCalendar() {
	global $error;
	global $obj_smarty;

	$arr_submit 		= array(
		array('cid',    		'int',   	true, 	''),

	);

   	$frm_submitted      = validate_var($arr_submit);

	if(User::isAdmin() || User::isSuperAdmin()) {
		$bln_success = Calendar::undeleteCalendar($frm_submitted['cid']);

		if($bln_success) {
			$obj_smarty->assign('msg', 'Calendar is back again');
		}

		$arr_calendars = Calendar::getCalendars();
		$obj_smarty->assign('calendars', $arr_calendars);
		$obj_smarty->assign('active', 'calendars');

	} else {
		$obj_smarty->assign('error', 'NO rights to undelete this calendar');
	}

	$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
	exit;
}

function getDeletedCalendars() {
    global $obj_smarty;
    
    if(User::isLoggedIn()) {
        $arr_user = User::getUser();
        
        if(User::isSuperAdmin()) {
            $arr_calendars = Calendar::getCalendars(true, true);
            $obj_smarty->assign('calendars', $arr_calendars);
        } else if(User::isAdmin()) {
            $arr_calendars = Calendar::getCalendarsOfAdmin($arr_user['user_id'], true);
            $obj_smarty->assign('calendars', $arr_calendars);
        } 
    
    }
    
    $obj_smarty->assign('active', 'calendars');

	$obj_smarty->display(FULLCAL_DIR.'/view/admin_panel.tpl');
	exit;
    
    
}
exit;

?>
