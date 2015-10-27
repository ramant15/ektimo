<?php

/*
 * Created on 17-okt-2011
 * author Paul Wolbers
 */

$current_path = dirname ( realpath ( __FILE__ ) );

require_once '../include/default.inc.php';


if(isset($_GET['action'])) {
  	switch($_GET['action']) {
		case 'register':
			register();
			break;
		case 'activate':
			activate();
			break;
		case 'change_password':
			changePassword();
			break;
  	}

} else {

	$letters = 'ABCDEFGHKLMNPRSTUVWYZ';
	$_SESSION['cptch'] = rand(10,99).substr($letters,rand(1,20),1).substr($letters,rand(1,20),1).rand(10,99);
	$_SESSION['c_s_id'] = md5($_SESSION['cptch']);

	$obj_smarty->assign('active', 'register');
	$obj_smarty->display(FULLCAL_DIR.'/register/index.tpl');

	exit;
}

function register() {
	global $error;
	$use_captcha = true;
	global $obj_smarty;
	$bln_success = false;

	$arr_submit 		= array(
		array('firstname',    		'textonly',   	true, 	''),
		array('infix',    			'textonly',   	false, 	''),
		array('lastname',    		'textonly',   	true, 	''),
		array('email',    			'email',   		true, 	''),
		array('year',    			'int',   		true, 	''),
		array('month',    			'int',   		true, 	''),
		array('day',    			'int',   		true, 	''),
		array('username',    		'string',   	true, 	''),
		array('password',    		'string',   	false, 	''),
		array('agree_conditions',   'on',   		true, 	'You have to agree to the terms of use'),
	);

	if($use_captcha) {
		$arr_submit[] = array('captchacode',    	'captcha',   	true, 	'');
	}

   	$frm_submitted      = validate_var($arr_submit);

	if(!$error)	 {

		global $obj_db;
		$arr_user = null;

		// check if username does not exist
		$str_query = 'SELECT * FROM `users` ' .
				' WHERE `username` = "' .$frm_submitted['username'] .'"';

		$res1 = mysqli_query($obj_db, $str_query);

		if($res1 !== false) {
			$arr_user_username = mysqli_fetch_array($res1, MYSQLI_ASSOC);
		}

		// check if email does not exist
		$str_query = 'SELECT * FROM `users` ' .
				' WHERE `email` = "' .$frm_submitted['email'] .'"';

		$res2 = mysqli_query($obj_db, $str_query);

		if($res2 !== false) {
			$arr_user_email = mysqli_fetch_array($res2, MYSQLI_ASSOC);
		}

		if((!is_null($arr_user_username) && !empty($res1)) || (!is_null($arr_user_email) && !empty($res2))) {
			if(!is_null($arr_user_username) && !empty($res1)) {
				$obj_smarty->assign('msg', 'Username already exists');
			} else {
				$obj_smarty->assign('msg', 'Email already exists');
			}

			$obj_smarty->assign('form', $frm_submitted);

		} else {
			$added_user = -1;
            $bln_success = User::register($frm_submitted, $added_user);
		}

	} else {
		$obj_smarty->assign('msg', $error);
		$obj_smarty->assign('form', $frm_submitted);

	}

	if($bln_success) {
		if($added_user > 0) {
            
        }
        // TODO ? the user is not added to an admingroup
                    
        if(SEND_ACTIVATION_MAIL) {
			$obj_smarty->assign('msg', 'You received an email to activate your account');
		} else {
			header('location:'.FULLCAL_URL);
			exit;
		}

		$obj_smarty->assign('success', true);
	}
	$obj_smarty->display(FULLCAL_DIR.'/register/index.tpl');
	exit;
}

function changePassword() {
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
}

?>
