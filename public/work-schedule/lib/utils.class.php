<?php

class Utils {

    public static function sendMail($type='', $email='', $password='', $frm_submitted=array(), $int_user_id=0, $hash_code='') {
		if(!empty($type) && !empty($email)) {
			switch($type) {
                case 'mail_event':
					if(is_array($int_user_id)) {
                        $arr_user = $int_user_id;
                    }
                   
                    $subject = defined('MAIL_EVENT_MAILSUBJECT') ? MAIL_EVENT_MAILSUBJECT : 'Event notification';
					$mailtext = defined('MAIL_EVENT_MAILBODY') ? MAIL_EVENT_MAILBODY : 
                                                'Employee: %FIRSTNAME% %INFIX% %LASTNAME%<br />'
                                                . 'Title: %TITLE%<br />'
                                                . '<p>Description: %DESCRIPTION%</p><br />'
                                                . 'Location: %LOCATION%<br />'
                                                . 'Phone: %PHONE%<br />'
                                                . 'Url: %URL%<br />'
                                                . 'Startdate: %STARTDATE%<br />'
                                                . 'Enddate: %ENDDATE%<br />';
                  
                    if(is_array($arr_user) && !empty($arr_user)) {
                        $mailtext = str_replace('%FIRSTNAME%', $arr_user['firstname'], $mailtext);
                        $mailtext = str_replace('%INFIX%', $arr_user['infix'], $mailtext);
                        $mailtext = str_replace('%LASTNAME%', $arr_user['lastname'], $mailtext);
                    } else {
                        // no user logged in
                        $mailtext = str_replace('%FIRSTNAME%', '', $mailtext);
                        $mailtext = str_replace('%INFIX%', '', $mailtext);
                        $mailtext = str_replace('%LASTNAME%', '', $mailtext);
                    }
                    
                    $mailtext = str_replace('%TITLE%', $frm_submitted['title'], $mailtext);
                    $mailtext = str_replace('%DESCRIPTION%', $frm_submitted['description'], $mailtext);
                    $mailtext = str_replace('%LOCATION%', $frm_submitted['location'], $mailtext);
                    $mailtext = str_replace('%PHONE%', $frm_submitted['phone'], $mailtext);
                    $mailtext = str_replace('%URL%', $frm_submitted['myurl'], $mailtext);
                    $mailtext = str_replace('%STARTDATE%', $frm_submitted['str_date_start'], $mailtext);
                    $mailtext = str_replace('%ENDDATE%', $frm_submitted['str_date_end'], $mailtext);
             
                    break;
				case 'assign_notify':
					$subject = 'Task assigned to you';
					$mailtext = '';
					break;
				case 'add_user':
					$subject = 'Your new account';
					$mailtext = 'The admin created an account for you. <br /><br />' ;

                    $send_activation_mail = Settings::getAdminSetting('send_activation_mail', $int_user_id);
                    $bln_send_activation_mail = $send_activation_mail == 'on';
            
					if($bln_send_activation_mail) {

						if(defined('ACTIVATION_MAIL_SUBJECT') && ACTIVATION_MAIL_SUBJECT !== '') {
							$subject = ACTIVATION_MAIL_SUBJECT;

							if(stristr($subject, '%USERNAME%')) {
								if(isset($frm_submitted['username']) && !empty($frm_submitted['username'])) {
									$subject = str_replace('%USERNAME%', $frm_submitted['username'], $subject);
								} else {
									$subject = str_replace('%USERNAME%', '', $subject);
								}
							}
						}

						$mailtext .= 'To confirm the registration click on this link: <br />' .
											'<a href="'.FULLCAL_URL.'/?action=activate&uid='.$int_user_id.'&hash='.$hash_code.'">'.FULLCAL_URL.'/?action=activate&uid='.$int_user_id.'&hash='.$hash_code.'</a><br /><br />'.
											'<br />If your browser doesn\'t automatically open, paste the link in your browser ';


					} else {
						if(!isset($frm_submitted['username']) || empty($frm_submitted['username'])) {
							$mailtext .= 'You can login with your emailaddress as username. ';
						}

						$mailtext .= '<br />Your password is: '.$password;
					}

					break;
				case 'add_admin':
					$subject = 'Your new admin account';
					$mailtext = 'The admin created an admin account for you. <br /><br />' ;

					if(!isset($frm_submitted['username']) || empty($frm_submitted['username'])) {
						$mailtext .= 'You can login with your emailaddress as username ';
					}

					$mailtext .= '<br />Your password is: '.$password;
					break;
				case 'copy_to_admin_admin_created':
					$subject = 'New account';
					$mailtext = 'You created a new admin account for: '.$frm_submitted['firstname'].' '.$frm_submitted['infix'].' '.$frm_submitted['lastname'].'. <br /><br />' .
								'Username: '.$frm_submitted['username'].'<br />Password: '.$password;
					break;
				case 'copy_to_admin_user_created':
					$subject = 'New account';
					$mailtext = 'You created a new user account for: '.$frm_submitted['firstname'].' '.$frm_submitted['infix'].' '.$frm_submitted['lastname'].'. <br /><br />' .
								'Username: '.$frm_submitted['username'].'<br />Password: '.$password;
					break;
			}

			$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' .
					'<html>' .
					'<head></head>' .
					'<body>' ;

			$message .= $mailtext;

			$message .= '</body></html>';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.FROM_EMAILADDRESS . "\r\n";

			if(mail($email, $subject, $message, $headers)){
				return true;
			} else {
				return false;
			}
		}
		return false;

	}

    public static function checkEmail($var_to_check) {
        $host = explode('@', $var_to_check);

        if (preg_match('/^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*$/',$var_to_check)) {

            if(function_exists('checkdnsrr')) {
                if(checkdnsrr($host[1] . '.', 'MX')) return true;
                if(checkdnsrr($host[1] . '.', 'A')) return true;
                
                return  false;
            } else{
                $result = array();
                @exec('nslookup -type=MX '.escapeshellcmd($host[1]).'.', $result);
                foreach ($result as $line) {
                    if(eregi("^$host[1].",$line)) {
                        return true;
                    }
                }

                return  false;
            }

         } else {
            return false;
         }
    }
    
	public static function getDaysBetween($sStartDate, $sEndDate){
		if(is_numeric($sStartDate) && is_numeric($sEndDate)) {
			$sStartDate 	= date("Y-m-d", $sStartDate);
	  		$sEndDate 		= date("Y-m-d", $sEndDate);
		} else {
			$sStartDate 	= date("Y-m-d", strtotime($sStartDate));
	  		$sEndDate 		= date("Y-m-d", strtotime($sEndDate));
		}

		$aDays[] 		= $sStartDate;
	  	$sCurrentDate 	= $sStartDate;

	  	while($sCurrentDate < $sEndDate){
			$sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
	    	$aDays[] = $sCurrentDate;
	  	}
	  	return $aDays;
	}
	

	public static function getDaysInPattern($frm_submitted) {
		$arr_return = array();

		//$days_in_between = Utils::getDaysBetween($frm_submitted['date_start'], $frm_submitted['date_end']);
        
        if(is_numeric($frm_submitted['date_start']) && is_numeric($frm_submitted['date_end'])) {
			$date_start 	= date("Y-m-d", $frm_submitted['date_start']);
	  		$date_end 		= date("Y-m-d", $frm_submitted['date_end']);
		} else {
			$date_start 	= date("Y-m-d", strtotime($frm_submitted['date_start']));
	  		$date_end 		= date("Y-m-d", strtotime($frm_submitted['date_end']));
		}

		$arr_weekdays = array();

		if($frm_submitted['interval'] == 'W') {
			// which days are selected
            $str_interval_days = substr($frm_submitted['weekdays'],1);	// trim first comma

			if(strstr($str_interval_days, ',')) {
				$arr_interval_days = explode(',', $str_interval_days);
			} else {
				$arr_interval_days = array($str_interval_days);
			}

			foreach($arr_interval_days as $day) {
				$arr_weekdays[$day] = $day;
			}

            /*
             * find days that are in the pattern
             */
               
            $current_date 	= $date_start;
        
            if(array_key_exists(date('N', strtotime($current_date)), $arr_weekdays)) {
                $arr_return[] = $current_date;
            }
                
            while($current_date <= $date_end){
                $current_date = date("Y-m-d", strtotime("+1 day", strtotime($current_date)));
             //   $aDays[] = $sCurrentDate;
                if(array_key_exists(date('N', strtotime($current_date)), $arr_weekdays)) {
					$arr_return[] = $current_date;
				}
            }

		} else if($frm_submitted['interval'] == 'M') {

            $current_date 	= $date_start;
        
			if($frm_submitted['monthday'] == 'dom') {

				/*
				 * dom: day of month
				 */

				// what day is startdate?
				$int_monthday = date('d', $frm_submitted['date_start']);
				$arr_return[] = date('Y-m-d', $frm_submitted['date_start']);

				$plus_four_weeks = self::getPlusOneMonthDate($frm_submitted['date_start'], $int_monthday);

                while($current_date <= $date_end){
                    $current_date = date("Y-m-d", strtotime("+1 day", strtotime($current_date)));
                    
                    if($current_date == $plus_four_weeks) {
						if(date('d', strtotime($plus_four_weeks)) == $int_monthday) {
							$arr_return[] = $current_date;
							$plus_four_weeks = self::getPlusOneMonthDate($current_date, $int_monthday);
						}
					}
                }
            
			} else if($frm_submitted['monthday'] == 'dow') {

				/*
				 * dow: day of week
				 */

				// what weekday is startdate?
				$int_weekday = self::getWeekdayFromDate($frm_submitted['date_start']);
				$arr_return[] = date('Y-m-d', $frm_submitted['date_start']);

				$plus_four_weeks = self::getPlusFourWeeksDate($frm_submitted['date_start'], $int_weekday);

                while($current_date <= $date_end){
                    $current_date = date("Y-m-d", strtotime("+1 day", strtotime($current_date)));
                    
                    if($current_date == $plus_four_weeks) {
						if(date('N', strtotime($plus_four_weeks)) == $int_weekday) {
							$arr_return[] = $current_date;
							$plus_four_weeks = self::getPlusFourWeeksDate($current_date, $int_weekday);
						}
					}
                }
            }
        } else if($frm_submitted['interval'] == 'Y') {
            // yearly
            $year = date('Y', strtotime($date_start));
            
            // yearmonthday and yearmonth
            $yearmonthday = str_pad($frm_submitted['yearmonthday'], 2, 0, STR_PAD_LEFT);
            $yearmonth = str_pad($frm_submitted['yearmonth'] + 1, 2, 0, STR_PAD_LEFT);
            
            $current_date 	= $year.'-'.$yearmonth.'-'.$yearmonthday;
       
            if($current_date >= $date_start) {
              $arr_return[] = $current_date;
            }        
   
            while($current_date <= $date_end){
                $year ++;
                $current_date 	= $year.'-'.$yearmonth.'-'.$yearmonthday;

                if($current_date <= $date_end) {
                    $arr_return[] = $current_date;
                }
            }
        }

		return $arr_return;
	}

	public static function getWeekdayFromDate($str_date, $bln_textual=false) {
		if(is_int($str_date)) {
			$ts_date = $str_date;
		} else {
			$ts_date = strtotime($str_date);
		}


		if(!$bln_textual) {
			return (int)date('w', $ts_date);;
		} else {
			$date = strftime('%A', $ts_date);
		}
		return $date;
	}

	public static function getNextWeekDate($start_date, $weekday) {
		//$oneweekfromnow = date('Y-m-d', strtotime("+1 week", strtotime($start_date)));
		$oneweekfromnow = strtotime("+1 week", strtotime($start_date));	//timestamp

		// extra check
		if(date('N', $oneweekfromnow) == $weekday) {
			return $oneweekfromnow;
		}
		return false;
	}

	public static function getPlusFourWeeksDate($start_date, $weekday) {
		//$oneweekfromnow = date('Y-m-d', strtotime("+1 week", strtotime($start_date)));

		if(is_int($start_date)) {
			$ts_date = $start_date;
		} else {
			$ts_date = strtotime($start_date);
		}

		$oneweekfromnow = strtotime("+4 week", $ts_date);	//timestamp

		// extra check
		if(date('N', $oneweekfromnow) == $weekday) {
			return date('Y-m-d', $oneweekfromnow);
		}
		return false;
	}

	public static function getPlusOneMonthDate($start_date, $monthday) {
		//$oneweekfromnow = date('Y-m-d', strtotime("+1 week", strtotime($start_date)));

		if(is_int($start_date)) {
			$ts_date = $start_date;
		} else {
			$ts_date = strtotime($start_date);
		}

		$onemonthfromnow = strtotime("+1 month", $ts_date);	//timestamp

		// extra check
		if(date('d', $onemonthfromnow) == $monthday) {
			return date('Y-m-d', $onemonthfromnow);
		}
		return false;
	}


	public static function generatePassword($length = 10){
	  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%*_+|';

	  $str = '';
	  $max = strlen($chars) - 1;

	  for ($i=0; $i < $length; $i++)
	    $str .= $chars[mt_rand(0, $max)];

	  return $str;
	}

	public static function setLocaleLanguage($lang = '') {

		if(!empty($lang)) {
			$language = $lang;
		} else {

			if(USE_CLIENTS_LANGUAGE) {
				$language = '';	// the clients language will be set
				$locale = setlocale(LC_ALL, '');


			} else {
				$language = strtolower(LANGUAGE);
			}

		}
//echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		if(!empty($language)) {
			switch($language) {
				case 'en':
					$locale = array('eng','en_EN.UTF-8');
					break;
				case 'de':
					$locale = array('deu','de_DE.UTF-8');
					break;
				case 'fr':
					$locale = array('fra','fr_FR.UTF-8','fr_FR');
					break;
				case 'nl':
					$locale = array('nld','nl_NL@euro, nl_NL.UTF-8, nl_NL, nld_nld, dut, nla, nl, nld, dutch');
					break;
				case 'pl':
					$locale = array('pol','de_DE.UTF-8');
					break;
				case 'es':
					$locale = array('esp','es_ES.UTF-8, spanish');
					break;
				case 'no':
					$locale = array('nor','no_NO.UTF-8, no_NO, Norwegian');
					break;
                case 'it':
					$locale = array('ita','it_IT.UTF-8, it_IT, Italian');
					break;
                case 'cz';
                    $locale = array('cze', 'cz_CZ.UTF-8', 'cz_CZ', 'czech');
                    break;
				default:
					$locale = array('eng','en_EN.UTF-8');
			}
		}

		//setlocale(LC_ALL, NULL);

		setlocale(LC_ALL, $locale);

		header("Content-Type: text/html;charset=UTF-8");
		header("Content-Language: $language");

	}

    public static function sortTwodimArrayByKey($two_dim_array, $key_to_sort_with, $dir='ASC', $case_sensitive=false) {

		if(!empty($two_dim_array)) {

			$arr_result 		= array();
			$arr_values 		= array();
			$bln_third_dim 		= false;

			if(strstr($key_to_sort_with, '/')) {
				$arr_dims 		= explode('/', $key_to_sort_with);
				$sec_dim_key 	= $arr_dims[0];
				$third_dim_key 	= $arr_dims[1];
				$bln_third_dim 	= true;
			}

			// array maken met de waardes waarop gesorteerd moet worden
			foreach($two_dim_array as $arr_second_dim) {
			    if(is_array($arr_second_dim[$key_to_sort_with])) {
			    	echo 'opgegeven key is een array. Gebruik key1/key2';break;
			    }
			   	$arr_values[] = $bln_third_dim ? $arr_second_dim[$sec_dim_key][$third_dim_key] : $arr_second_dim[$key_to_sort_with];
			}

			// sorteren ( de key's krijgen de nieuwe volgorde )
			if($case_sensitive) {
			    sort($arr_values);
			} else {
			    natcasesort($arr_values);
			}

			// nieuwe array maken met de juiste volgorde
			foreach($arr_values as $value) {
			    foreach($two_dim_array as $key=>$val) {
			       	if($value == ($bln_third_dim ? $val[$sec_dim_key][$third_dim_key] : $val[$key_to_sort_with])) {
				       	$arr_result[] = $two_dim_array[$key];
				        unset ($two_dim_array[$key]);
				    }
			    }
			}

			if($dir == 'DESC') {
			     $arr_result = array_reverse($arr_result);
			}

		    return $arr_result;
		} else {
		      return array();
		}
	}

	public static function getSubstring($string, $str_start,$start_plus_or_min=0, $str_end='', $end_plus_or_min=0) {

		$string_min_eerste_gedeelte = stristr($string, $str_start);
		//$str_start_pos = stripos($string, $str_start);

		$string_min_eerste_gedeelte_min_startstring = substr($string_min_eerste_gedeelte,strlen($str_start)+$start_plus_or_min);

		if(empty($str_end)) {
			return $string_min_eerste_gedeelte_min_startstring;
		}
		$eindpositie_karakter = stripos($string_min_eerste_gedeelte_min_startstring, $str_end);

		$str_result = substr($string_min_eerste_gedeelte_min_startstring,0 , $eindpositie_karakter+$end_plus_or_min);

		return $str_result;

	}

	public static function getLanguage() {
		$language = Settings::getSetting('language');
		if(empty($language)) {
			if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
				if (class_exists('Locale')) {
					$language = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
				} else {
					$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				}
			} else {
				$language = strtolower(LANGUAGE);
			}
		}
		return $language;
	}


	
	

	public static function strip_script($string) {
	    if(strstr($string, '<script')) {
			$str_part_after_scripttag = trim(strstr($string, '<script'));
			$str_result = substr($str_part_after_scripttag, 0, strpos($str_part_after_scripttag,'</script>')+9);
			$string = str_replace($str_result, '', $string);
			$string = self::strip_script($string);
		}
		return $string;
	}

    public static function importUsersFromCsv() {
        global $obj_db;
    
        if(User::isLoggedIn() && User::isAdmin()) {
            // you have to be admin to import users, so we have a userID to put in the admin_group
            $arr_user = User::getUser();
        } else {
            echo 'No rights to do that';exit;
        }
        
        $arr_columns = array('ID', 'user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url',
                                'user_registered', 'user_activation_key', 'user_status', 'display_name');
        
        // in the CSV only include users
        
        $row = 1;
        if (($handle = fopen(FULLCAL_DIR . "/system/wp_users.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                if($num !== 10) {
                    echo 'amount of columns must be 10';exit;
                }
                
                if($data[0] == 'ID') {
                    // first row are headers
                    // check if columns are as expected
                    
                    continue;
                }
                                
                echo 'row '.$row.': ';
                   
                $username = $data[1];
                $firstname = '';
                $infix = '';
                $lastname = $data[9];
                $password = $data[2];
                $email = $data[4];
                $admin_group = $arr_user['user_id'];
                $active = 1;
                $registration_date = $data[6];

                if(!isset($_SESSION['ews_imported_users'])) {
                    $_SESSION['ews_imported_users'] = array();
                }

                if(!in_array($lastname.'-'.$username.'-'.$registration_date, $_SESSION['ews_imported_users'])) {
                    echo 'row inserted';
                    // insert
                    $str_query2 = 'SELECT * FROM users WHERE username = "' . $username . '"';
                    $obj_result2 = mysqli_query($obj_db, $str_query2);
                    $arr_user2 = mysqli_fetch_array($obj_result2, MYSQLI_ASSOC);

                    if($obj_result2 !== false && !empty($arr_user2) && $arr_user2 !== false) {
                        if(SHOW_USERNAME_IN_FORM && !empty($username)) {
                            echo 'Username already exists';exit;
                        } else {
                            echo 'Username (emailaddress) already exists';exit;
                        }
                    }

                    $str_query3 = 'SELECT * FROM users WHERE registration_date = "'.$registration_date.'" AND username = "'.$username.'" AND lastname = "'.$lastname.'"';
                    $obj_result3 = mysqli_query($obj_db, $str_query3);
                    $arr_user3 = mysqli_fetch_array($obj_result3, MYSQLI_ASSOC);


                    $str_query = 'INSERT INTO users ( `firstname` ,`infix` ,`lastname` ,`username`,`password` ,`email` ,`registration_date` ,'.
                                        '`birth_date`, `active`, `ip`, `country`, `country_code`, `usertype`, `admin_group`) VALUES ('.
                            '"'.$firstname.'",'.
                            '"'.$infix.'",'.
                            '"'.$lastname.'",'.
                            '"'.$username.'",'.
                            '"'.User::getPasswordHashcode('temp-'.$username.'-123').'",'.
                            '"'.$email.'",'.
                            '"'.$registration_date.'",'.
                            '"",' .
                            '1, '.
                            '"",' .
                            '"",' .
                            '"",' .
                            '"user",'.
                            $admin_group.')';

                    $res = mysqli_query($obj_db, $str_query);

                    $_SESSION['ews_imported_users'][] = $lastname.'-'.$username.'-'.$registration_date;
                } else {
                    echo 'already inserted';
                }
                    
                 echo '<br />'."\n";   
            
               // }
            }
            fclose($handle);
        }
    }

}
?>