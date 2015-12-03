<?php

class Calendar {

	private $cal_id;

	function __construct ($cal_id) {
		$this->cal_id = $cal_id;
	}
    
    public static function insertFirstCalendar() {
        global $obj_db;
        
        $str_query = "INSERT INTO `calendars` (`name`, `share_type`, `calendar_color`, `login_required`, `cal_startdate`, `cal_enddate`, `alterable_startdate`, `alterable_enddate`, `creator_id`, `can_view`, `can_add`, `can_edit`, `can_delete`, `can_change_color`, `can_dd_drag`, `initial_show`, `active`, `deleted`, `calendar_admin_email`, `users_can_email_event`, `all_event_mods_to_admin`) VALUES ".
                        "('Cal 1', 'public', '#FF5F3F', 0, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1, 0, 'everyone', 0, 'yes', 0, NULL, 0, 0)";
        
        $res = mysqli_query($obj_db, $str_query);
        
        
    }
    
    /**
     * 
     * @param type $arr_cal
     * @return boolean
     */
    public static function calCanMail($arr_cal) {
        if(User::isLoggedIn()) {
            if(isset($arr_cal['users_can_email_event']) && (bool)$arr_cal['users_can_email_event']) {
                if(isset($arr_cal['calendar_admin_email']) && !empty($arr_cal['calendar_admin_email'])) {
                    if(Utils::checkEmail($arr_cal['calendar_admin_email'])) {
                        return true;
                    }
                }
                if(defined('MAIL_EVENT_MAILADDRESS')) {
                    $mailaddress = MAIL_EVENT_MAILADDRESS;
                }
                if( !empty($mailaddress) ) {
                    if(Utils::checkEmail($mailaddress)) {
                        return true;
                    }
                }
            }
        }
             
        return false;
    }
    
    /**
     * 
     * @param type $arr_cal
     * @return boolean
     */
    public static function calMailEventModsToAdmin($arr_cal) {
        if(User::isLoggedIn()) {
            if(isset($arr_cal['all_event_mods_to_admin']) && (bool)$arr_cal['all_event_mods_to_admin']) {
                if(isset($arr_cal['calendar_admin_email']) && !empty($arr_cal['calendar_admin_email'])) {
                    if(Utils::checkEmail($arr_cal['calendar_admin_email'])) {
                        return true;
                    }
                }
                if(defined('MAIL_EVENT_MAILADDRESS')) {
                    $mailaddress = MAIL_EVENT_MAILADDRESS;
                }
                if( !empty($mailaddress) ) {
                    if(Utils::checkEmail($mailaddress)) {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
    
   
    
    /**
     * @param type $arr_cal
     * @return string 
     */
    public static function getCalendarAdminEmail($arr_cal) {
        if(isset($arr_cal['calendar_admin_email']) && !empty($arr_cal['calendar_admin_email'])) {
            if(Utils::checkEmail($arr_cal['calendar_admin_email'])) {
                return $arr_cal['calendar_admin_email'];
            }
        } else {
            if(defined('MAIL_EVENT_MAILADDRESS')) {
                $mailaddress = MAIL_EVENT_MAILADDRESS;
                if(!empty($mailaddress)) {
                    if(Utils::checkEmail($mailaddress)) {
                        return $mailaddress;
                    } 
                } 
            }
        }
        return '';
    }
    
    /**
     * 
     * @global type $obj_db
     * @param type $cal_id
     * @param type $dditems_as_string
     * @return type
     */
    public static function getCalendar($cal_id, $dditems_as_string=false) {
		global $obj_db;

        $arr_calendar = array();
        
       // if(!empty($cal_id)) {
            // get calendar
            $str_query = 'SELECT * FROM calendars WHERE calendar_id = '. $cal_id;
            $obj_result1 = mysqli_query($obj_db, $str_query);
    
            if($obj_result1 !== false) {
                 $arr_calendar = mysqli_fetch_array($obj_result1, MYSQLI_ASSOC);

                // get calendar drag and drop items
                $str_query = 'SELECT * FROM calendar_dditems WHERE calendar_id = ' .$cal_id;
                $obj_result = mysqli_query($obj_db, $str_query);

                $arr_dd_items = array();
                $str_dditems = '';

                while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
                    if($dditems_as_string) {
                        if(!is_null($arr_line['color']) && !empty($arr_line['color'])) {
                            $str_dditems .= $arr_line['title'].'|'.$arr_line['info'].'|'.$arr_line['color'].', ';
                        } else {
                            $str_dditems .= $arr_line['title'].'|'.$arr_line['info'].', ';
                        }
                   
                    } else {
                        $arr_dd_items[] = $arr_line;
                    }
                }
                if($dditems_as_string) {
                    $arr_calendar['dditems'] = $str_dditems;
                } else {
                    $arr_calendar['dditems'] = $arr_dd_items;
                }
                
                if(!empty($arr_calendar['cal_startdate']) && !empty($arr_calendar['cal_enddate'])) {
                    // put dates in format the datepicker understands
                    $arr_startdate_tmp = explode('-', $arr_calendar['cal_startdate']);
                    $arr_enddate_tmp = explode('-', $arr_calendar['cal_enddate']);

                    if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
                        $arr_calendar['cal_startdate'] = $arr_startdate_tmp[1].'/'.$arr_startdate_tmp[2].'/'.$arr_startdate_tmp[0];
                        $arr_calendar['cal_enddate'] = $arr_enddate_tmp[1].'/'.$arr_enddate_tmp[2].'/'.$arr_enddate_tmp[0];
                    } else {
                        $arr_calendar['cal_startdate'] = $arr_startdate_tmp[2].'/'.$arr_startdate_tmp[1].'/'.$arr_startdate_tmp[0];
                        $arr_calendar['cal_enddate'] = $arr_enddate_tmp[2].'/'.$arr_enddate_tmp[1].'/'.$arr_enddate_tmp[0];
                    }
                }
               
                if(!empty($arr_calendar['alterable_startdate']) && !empty($arr_calendar['alterable_enddate'])) {
                    // put dates in format the datepicker understands
                    $arr_startdate_tmp2 = explode('-', $arr_calendar['alterable_startdate']);
                    $arr_enddate_tmp2 = explode('-', $arr_calendar['alterable_enddate']);

                    if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
                        $arr_calendar['alterable_startdate'] = $arr_startdate_tmp2[1].'/'.$arr_startdate_tmp2[2].'/'.$arr_startdate_tmp2[0];
                        $arr_calendar['alterable_enddate'] = $arr_enddate_tmp2[1].'/'.$arr_enddate_tmp2[2].'/'.$arr_enddate_tmp2[0];
                    } else {
                        $arr_calendar['alterable_startdate'] = $arr_startdate_tmp2[2].'/'.$arr_startdate_tmp2[1].'/'.$arr_startdate_tmp2[0];
                        $arr_calendar['alterable_enddate'] = $arr_enddate_tmp2[2].'/'.$arr_enddate_tmp2[1].'/'.$arr_enddate_tmp2[0];
                    }
                }
                
            }
           
      //  }
		
	  	return $arr_calendar;
    }

    /**
     * 
     * @param type $arr_calendar
     * @param type $user_id
     * @return type
     */
    public static function UserInGroup($arr_calendar, $user_id) {
       
        $arr_user = User::getUserById($user_id);
        
        return (bool) $arr_calendar['creator_id'] == $arr_user['admin_group'];
    }
       
    /**
     * 
     * @global type $obj_db
     * @param type $cal_ids
     * @return type
     */
    public static function getCalendarsByIds($cal_ids) {
        global $obj_db;
        $arr_calendars = array();
        
        $str_query = 'SELECT * FROM calendars c '.
                ' WHERE calendar_id IN('.$cal_ids.')';
        
        $obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
				$arr_calendars[] = $arr_line;
			}
        }
        return $arr_calendars;
    }
    
    /**
     * 
     * @global type $obj_db
     * @param type $from_admin_area
     * @return type
     */
	public static function getCalendars($from_admin_area=false, $deleted=false) {
		global $obj_db;
		$arr_calendars = array();

		if(User::isLoggedIn()) {
    	   	$arr_user 		= User::getUser();

    	   	
            $is_admin = User::isAdmin();
            $is_superadmin = User::isSuperAdmin();
            
            if( ($is_superadmin && $from_admin_area)  ) {
                $str_query = 'SELECT * FROM calendars '.
                    ' WHERE 1 ';
            } else if($is_superadmin && ADMIN_HAS_FULL_CONTROL) {
                $str_query = 'SELECT * FROM calendars '.
                    ' WHERE 1';
            } else if($is_superadmin) {
                // only public calendars
                $str_query = 'SELECT * FROM calendars '.
                    ' WHERE `share_type` = "public"';
            } else if($is_admin) {
                $str_query = 'SELECT * FROM calendars ';
                
                if(ADMIN_HAS_FULL_CONTROL && !$from_admin_area) {
                    $str_query .= ' WHERE (`creator_id` = '. $arr_user['user_id'].' OR `share_type` = "public")'; 
                } else {
                    $str_query .= ' WHERE `creator_id` = '. $arr_user['user_id'];
                }
                                
            } else {
                $str_query = 'SELECT * FROM calendars '.
                    ' WHERE (`share_type` != "private" AND `share_type` != "private_group"'.
                        ' OR (`share_type` = "private" AND `creator_id` = '. $arr_user['user_id'] .' )'.
                        ' )';
                if(!empty($arr_user['admin_group'])) {
                    $str_query .= ' OR (`share_type` = "private_group" AND `creator_id` = '.$arr_user['admin_group'].')';
                } else {
                     $str_query .= ' AND `share_type` != "private_group"';
                }
            }
                    
		} else {
			if(ALLOW_ACCESS_BY == 'ip' && User::ipAllowed()) {  // show all the calendars
                $str_query = 'SELECT * FROM calendars '.
                    ' WHERE 1 ';
            } else {
                $str_query = 'SELECT * FROM calendars '.
                 //   ' LEFT JOIN `users` `u` ON ( u.admin_group = c.calendar_id ) '.
                    ' WHERE `share_type` != "private" '.
                    ' AND `share_type` != "private_group" '; //GROUP BY c.calendar_id';
            }
        }

        if($deleted) {
            $str_query .= ' AND `deleted` =1';
        } else {
            $str_query .= ' AND `deleted` =0 ';
            
            if(!$from_admin_area) {
                $str_query .= ' AND (`active` = "yes" '.
                                    ' OR (`active` = "period" AND `cal_startdate` <= CURDATE() AND `cal_enddate` >= CURDATE())'.
                                    ')';
            }
                            
        }
   // echo $str_query;
		$obj_result = mysqli_query($obj_db, $str_query);

        try{
       
            if($obj_result !== false) {
                while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {

                    $arr_calendars[] = $arr_line;
                }

                foreach($arr_calendars as &$cal) {
                    // get calendar drag and drop items
                    $str_query = 'SELECT * FROM calendar_dditems WHERE calendar_id = ' .$cal['calendar_id'];
                    $obj_result = mysqli_query($obj_db, $str_query);

                    $arr_dd_items = array();

                    while ($arr_line2 = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
                        $arr_dd_items[] = $arr_line2;
                    }
                    $cal['dditems'] = $arr_dd_items;

                    // if active == 'period', check if period is now
                    if($cal['active'] == 'period') {
                        if(strtotime($cal['cal_startdate'].' 00:00:01') < time() && (strtotime($cal['cal_enddate'].' 00:00:01') + 86400) > time()) {
                            $cal['active'] = 'yes';
                        } else {
                            $cal['active'] = 'no';
                        }
                    }
                }
            } else {
                throw new Exception('Something wrong with the "calendars" table, compare the table with the table in the file: calendar_complete_db_for_new_users.sql');
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();exit;
        }
	  	return $arr_calendars;
    }
    
    /**
     * 
     * @global type $obj_db
     * @param type $int_user_id
     * @return type
     */
    public static function getOtherPublicCalendars($int_user_id) {
        global $obj_db;
		$arr_calendars = array();

		$str_query = 'SELECT * FROM calendars WHERE `deleted` = 0 AND creator_id != '. $int_user_id. ' AND `share_type` = "public"';
		
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {

				$arr_calendars[] = $arr_line;
			}
		}
        return $arr_calendars;
    }
    
    /**
     * 
     * @global type $obj_db
     * @param type $int_admin_id
     * @return type
     */
    public static function getCalendarsOfAdmin($int_admin_id=-1, $deleted=false) {
		global $obj_db;
		$arr_calendars = array();

		$str_query = 'SELECT * FROM calendars WHERE `deleted` = '.($deleted ? '1' : '0').' AND creator_id = '. $int_admin_id;
		
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {

				$arr_calendars[] = $arr_line;
			}

			foreach($arr_calendars as &$cal) {
				// get calendar drag and drop items
				$str_query = 'SELECT * FROM calendar_dditems WHERE calendar_id = ' .$cal['calendar_id'];
				$obj_result = mysqli_query($obj_db, $str_query);

				$arr_dd_items = array();

			  	while ($arr_line2 = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
					$arr_dd_items[] = $arr_line2;
				}
				$cal['dditems'] = $arr_dd_items;
            
                 // if active == 'period', check if period is now
                if($cal['active'] == 'period') {
                    if(strtotime($cal['cal_startdate'].' 00:00:01') < time() && (strtotime($cal['cal_enddate'].' 00:00:01') + 86400) > time()) {
                        $cal['active'] = 'yes';
                    } else {
                        $cal['active'] = 'no';
                    }
                }
			}
		}

	  	return $arr_calendars;
    }

    /**
     * 
     * @global type $obj_db
     * @param type $int_user_id
     * @return type
     */
    public static function getCalendarsOfUser($int_user_id) {
		global $obj_db;
		$arr_calendars = array();

		$str_query = 'SELECT * FROM calendars WHERE `deleted` = 0 AND creator_id = '. $int_user_id;
		
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {

				$arr_calendars[] = $arr_line;
			}

			foreach($arr_calendars as &$cal) {
				// get calendar drag and drop items
				$str_query = 'SELECT * FROM calendar_dditems WHERE calendar_id = ' .$cal['calendar_id'];
				$obj_result = mysqli_query($obj_db, $str_query);

				$arr_dd_items = array();

			  	while ($arr_line2 = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
					$arr_dd_items[] = $arr_line2;
				}
				$cal['dditems'] = $arr_dd_items;
			}
		}

	  	return $arr_calendars;
    }
    
    /**
     * 
     * @param type $arr_calendars
     * @return type
     */
	public static function getDefaultCalendars($arr_calendars) {
		//if(User::isLoggedIn()) {
    	//   	$arr_user 		= User::getUser();
        //}
        
        $str_return = '';
		foreach($arr_calendars as $calendar) {
			if($calendar['initial_show']) {
				if(!empty($str_return)) {
					$str_return .= ',';
				}
				$str_return .= $calendar['calendar_id'];
			}
		}
		return $str_return;
	}

    /**
     * 
     * @global type $obj_db
     * @return type
     */
	public static function getCalendarId() {
		global $obj_db;
		$arr_calendars = array();

		$str_query = 'SELECT * FROM calendars WHERE `deleted` = 0';
		$obj_result = mysqli_query($obj_db, $str_query);

	  	while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {

			$arr_calendars[] = $arr_line;
		}
		if(isset($arr_calendars[0])) {
			return $arr_calendars[0]['calendar_id'];
		} else {
			return $arr_calendars['calendar_id'];
		}
	}

    /**
     * 
     * @global type $obj_db
     * @param type $user_id
     * @return type
     */
	public static function getCalendarsByUserId($user_id=-1) {
		global $obj_db;
		$arr_calendars = array();
		$arr_calendar_ids = array();
		
		$str_query = 'SELECT * FROM events e LEFT JOIN `calendars`c ON(e.calendar_id = c.calendar_id) WHERE user_id = '. $user_id ;
	
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			
				if(!in_array($arr_line['calendar_id'], $arr_calendar_ids) ) {
					$arr_calendar_ids[] = $arr_line['calendar_id'];
					$arr_calendars[] = $arr_line;
				}
			}
		}

	  	return $arr_calendars;
	}
    
    public static function getCalendarIdByEventId($event_id=-1) {
		global $obj_db;
		
		$str_query = 'SELECT calendar_id FROM events WHERE event_id = '. $event_id;
        $obj_result = mysqli_query($obj_db, $str_query);

        $arr_event = mysqli_fetch_row($obj_result);
        
	  	return $arr_event['calendar_id'];
	}
	
    /**
     * 
     * @global type $obj_db
     * @return type
     */
	public static function getCalendersOfAllUsers() {
		global $obj_db;
		$arr_calendars = array();
		$arr_calendar_ids = array();
		
		$str_query = 'SELECT * FROM `events` group by calendar_id' ;
	
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			
				if(!in_array($arr_line['calendar_id'], $arr_calendar_ids) ) {
					$arr_calendar_ids[] = $arr_line['calendar_id'];
					$arr_calendars[] = $arr_line;
				}
			}
		}

	  	return $arr_calendars;
	}
	
    /**
     * 
     * @global type $obj_db
     * @param type $frm_submitted
     * @return type
     */
	public static function saveCalendar($frm_submitted) {
		global $obj_db;

		if(substr($frm_submitted['calendar_color'], 0, 1) != '#') {
			$frm_submitted['calendar_color'] = '#'.$frm_submitted['calendar_color'];
		}
        
        if($frm_submitted['active'] == 'period') {
            // reformat the dates to mysql
            $arr_startdate = explode('/', $frm_submitted['cal_startdate']);
            $arr_enddate = explode('/', $frm_submitted['cal_enddate']);

            if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
                $period_startdate = $arr_startdate[2].'-'.$arr_startdate[0].'-'.$arr_startdate[1];
                $period_enddate = $arr_enddate[2].'-'.$arr_enddate[0].'-'.$arr_enddate[1];
            } else {
                $period_startdate = $arr_startdate[2].'-'.$arr_startdate[1].'-'.$arr_startdate[0];
                $period_enddate = $arr_enddate[2].'-'.$arr_enddate[1].'-'.$arr_enddate[0];
            }
        } else {
            $period_startdate = '';
            $period_enddate = '';
        }
      
        if(!empty($frm_submitted['alterable_startdate']) && !empty($frm_submitted['alterable_enddate'])) {
            // reformat the dates to mysql
            $arr_startdate = explode('/', $frm_submitted['alterable_startdate']);
            $arr_enddate = explode('/', $frm_submitted['alterable_enddate']);

            if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
                $alterable_startdate = $arr_startdate[2].'-'.$arr_startdate[0].'-'.$arr_startdate[1];
                $alterable_enddate = $arr_enddate[2].'-'.$arr_enddate[0].'-'.$arr_enddate[1];
            } else {
                $alterable_startdate = $arr_startdate[2].'-'.$arr_startdate[1].'-'.$arr_startdate[0];
                $alterable_enddate = $arr_enddate[2].'-'.$arr_enddate[1].'-'.$arr_enddate[0];
            }
        }
        
		if($frm_submitted['calendar_id'] > 0) {
			$str_query = 'UPDATE calendars SET `name` = "'.$frm_submitted['name'].'", ' .
						'`calendar_color` = "'.$frm_submitted['calendar_color']. '", '.
						'`can_add` = '.$frm_submitted['can_add']. ', '.
						'`can_edit` = '.$frm_submitted['can_edit']. ', '.
						'`can_delete` = '.$frm_submitted['can_delete']. ', '.
						'`can_change_color` = '.$frm_submitted['can_change_color']. ', '.
						'`can_dd_drag` = "'.$frm_submitted['can_dd_drag']. '", '.
                        '`calendar_admin_email` = "'.$frm_submitted['calendar_admin_email']. '", '.
						'`initial_show` = '.$frm_submitted['initial_show'].', '.
                        '`users_can_email_event` = '.$frm_submitted['users_can_email_event'].', '.
                        '`all_event_mods_to_admin` = '.$frm_submitted['all_event_mods_to_admin'].', '.
                        '`active` = "'.$frm_submitted['active'].'", ';
            
            if(!empty($period_startdate) && !empty($period_enddate)) {
                $str_query .= '`cal_startdate` = "'.$period_startdate.'", '.
                                '`cal_enddate` = "'.$period_enddate.'", ';
            } else {
                $str_query .= '`cal_startdate` = NULL, '.
                                '`cal_enddate` = NULL, ';
            }
            
            if(!empty($alterable_startdate) && !empty($alterable_enddate)) {
                $str_query .= '`alterable_startdate` = "'.$alterable_startdate.'", '.
                                '`alterable_enddate` = "'.$alterable_enddate.'", ';
            } else {
                $str_query .= '`alterable_startdate` = NULL, '.
                                '`alterable_enddate` = NULL, ';
            }
                        
            $str_query .= '`share_type` = "'.$frm_submitted['share_type'].'"'.
							' WHERE `calendar_id` = '.(int)$frm_submitted['calendar_id'];

			$res = mysqli_query($obj_db, $str_query);

			// delete dditems
			$str_query = 'DELETE FROM calendar_dditems ' .
	    		'WHERE `calendar_id` = '.(int)$frm_submitted['calendar_id'];

			$res = mysqli_query($obj_db, $str_query);

			if($frm_submitted['checkbox_use_color_for_all_events']) {
				self::setEventColor($frm_submitted['calendar_color'], $frm_submitted['calendar_id']);
			}
		} else {
			$arr_user = User::getUser();

			$str_query = 'INSERT INTO calendars SET `name` = "'.$frm_submitted['name'].'", ' .
							'`calendar_color` = "'.$frm_submitted['calendar_color'].'", ' .
							'`creator_id` = '.$arr_user['user_id'].', ' .
							'`can_add` = '.$frm_submitted['can_add']. ', '.
							'`can_edit` = '.$frm_submitted['can_edit']. ', '.
							'`can_delete` = '.$frm_submitted['can_delete']. ', '.
                            '`can_change_color` = '.$frm_submitted['can_change_color']. ', '.
                            '`can_dd_drag` = "'.$frm_submitted['can_dd_drag']. '", '.
                            '`calendar_admin_email` = "'.$frm_submitted['calendar_admin_email']. '", '.
                            '`initial_show` = '.$frm_submitted['initial_show'].', '.
                            '`users_can_email_event` = '.$frm_submitted['users_can_email_event'].', '.
                            '`all_event_mods_to_admin` = '.$frm_submitted['all_event_mods_to_admin'].', '.
                            '`active` = "'.$frm_submitted['active'].'", ';
            
            if(!empty($period_startdate) && !empty($period_enddate)) {
                $str_query .= '`cal_startdate` = "'.$period_startdate.'", '.
                                '`cal_enddate` = "'.$period_enddate.'", ';
            } else {
                $str_query .= '`cal_startdate` = NULL, '.
                                '`cal_enddate` = NULL, ';
            }
            
            if(!empty($alterable_startdate) && !empty($alterable_enddate)) {
                $str_query .= '`alterable_startdate` = "'.$alterable_startdate.'", '.
                                '`alterable_enddate` = "'.$alterable_enddate.'", ';
            } else {
                $str_query .= '`alterable_startdate` = NULL, '.
                                '`alterable_enddate` = NULL, ';
            }
                        
            $str_query .= '`share_type` = "'.$frm_submitted['share_type'].'"';

			$res = mysqli_query($obj_db, $str_query);

			$frm_submitted['calendar_id'] = mysqli_insert_id($obj_db);
		}

		// save dditems
		if(!empty($frm_submitted['dditems'])) {
             $arr_dditems = explode(',', $frm_submitted['dditems']);

            foreach($arr_dditems as $dd) {
                $dd = trim($dd);
                $dd = trim($dd, ',');
                if(!empty($dd)) {
                    if(substr($dd, 0,1) == '|') {
                        // no title given, do not save
                        continue;
                    }
                    $color = '';
                    if(strstr($dd, '|')) {
                        // also color defined
                        $arr_dditem = explode('|', $dd);
                        $info = $arr_dditem[1];
                        $color = $arr_dditem[2];
                        $dd = $arr_dditem[0];
                    }
                    $str_query = 'REPLACE INTO calendar_dditems (`title`, `calendar_id`, `info`, `color`) ' .
                        'VALUES ("'.$dd.'", '.(int)$frm_submitted['calendar_id'].', "'.$info.'", "'.$color.'") ';

                    $res2 = mysqli_query($obj_db, $str_query);
                }
            }
        }
       
		return $res;
	}

    /**
     * 
     * @global type $obj_db
     * @param type $str_color
     * @param type $int_calendar_id
     * @return boolean
     */
	private static function setEventColor($str_color, $int_calendar_id) {
		global $obj_db;

		if($int_calendar_id > 0) {
			if(User::isLoggedIn() && (User::isAdmin() || User::isSuperAdmin())) {

				$str_query = 'UPDATE events SET `color` = "'.$str_color.'" ' .
					' WHERE calendar_id = '.$int_calendar_id;

				$obj_result = mysqli_query($obj_db, $str_query);

				return $obj_result;
			}
		}
		return false;
	}

    /**
     * 
     * @global type $obj_db
     * @param type $int_calendar_id
     * @return type
     */
	public static function deleteCalendar($int_calendar_id) {
		global $obj_db;

		$str_query = 'UPDATE calendars SET `deleted` = 1 WHERE `calendar_id` = '.$int_calendar_id;

		$res = mysqli_query($obj_db, $str_query);

		return $res;
	}

    /**
     * 
     * @global type $obj_db
     * @param type $int_calendar_id
     * @return boolean
     */
	public static function undeleteCalendar($int_calendar_id) {
		global $obj_db;

		$str_query = 'UPDATE calendars SET `deleted` = 0 WHERE `calendar_id` = '.$int_calendar_id;

		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			return true;
		}
		return false;
	}

    /**
     * 
     * @param type $int_cal_id
     * @return type
     */
    public static function getPermissions($int_cal_id) {
        $arr_cal = Calendar::getCalendar($int_cal_id);
        
        $can_view   = (bool) $arr_cal['can_view']; // can view detail
        $can_add    = (bool) $arr_cal['can_add'];
        $can_edit   = (bool) $arr_cal['can_edit'];
        $can_delete = (bool) $arr_cal['can_delete'];
        $can_change_color = (bool) $arr_cal['can_change_color'];
        $can_see_dditems = $can_add && !ONLY_ADMIN_CAN_SEE_DRAG_DROP_ITEMS; // only_owner , only_loggedin_users of everyone
        
        
        /*
         * IF LOGGED IN
         */
        
        if(User::isLoggedIn()) {
            $arr_user = User::getUser();
    
            if(ONLY_ADMIN_CAN_SEE_DRAG_DROP_ITEMS) {
                if(User::isAdmin() || User::isSuperAdmin()) {
                    $can_see_dditems    = true;
                } else {
                    $can_see_dditems = false;
                }
                
            } else {
                if(Calendar::isOwner($arr_cal['calendar_id']) 
                        || $arr_cal['can_dd_drag'] == 'everyone' 
                        || $arr_cal['can_dd_drag'] == 'only_loggedin_users') {
                    $can_see_dditems    = true;
                } else {
                    if($arr_cal['can_dd_drag'] == 'only_owner' && !Calendar::isOwner($arr_cal['calendar_id'])) {
                        $can_see_dditems = false;
                    }
                }
            }
           
            // if admin with fullcontrol OR calendar owner (creator)
            if( (ADMIN_HAS_FULL_CONTROL && (User::isAdmin() || User::isSuperAdmin())) 
                    || Calendar::isOwner($arr_cal['calendar_id']) ) {
                $can_view           = false; // not neccesary because admin can edit
                $can_add            = true;
                $can_edit           = true;
                $can_delete         = true;
                $can_see_dditems    = true;
            
            } else if($arr_cal['share_type'] == 'private_group' && !Calendar::UserInGroup($arr_cal, $arr_user['user_id'])) {
                // if share_type is private_group and user is not in that group (admingroup)
                $can_add            = false;
                $can_edit           = false;
                $can_delete         = false;
                $can_see_dditems    = false;
            }
        
        } else {
            /*
            * IF NOT LOGGED IN
            */

            if(ONLY_ADMIN_CAN_SEE_DRAG_DROP_ITEMS) {
                $can_see_dditems = false;
                
            } else if($arr_cal['can_dd_drag'] == 'everyone') {
                $can_see_dditems    = true;
                
            } else {
                $can_see_dditems = false;
            }
            
            // if public
            if($arr_cal['share_type'] == 'public') {
                // use the defaults from the calendar
            }

            // if access allowed by IP and IP mathces with IP in config.php
            if(ALLOW_ACCESS_BY == 'ip' && User::ipAllowed()) {
                // use the defaults from the calendar
            }
        }
        
        return array('can_view' => $can_view, 
                    'can_add' => $can_add,
                    'can_edit' => $can_edit,
                    'can_delete' => $can_delete,
                    'can_change_color' => $can_change_color,
                    'can_see_dditems' => $can_see_dditems);
    }

    /**
     * 
     * @global type $obj_db
     * @param type $cal_id
     * @return type
     */
    public static function isOwner($cal_id) {
        if(User::isLoggedIn()) {
            
            $arr_user = User::getUser();
            
            global $obj_db;

            $arr_calendar = array();
           
            if($cal_id > 0) {
                $str_query = 'SELECT calendar_id FROM calendars WHERE calendar_id = '. $cal_id . ' AND `creator_id` = '. $arr_user['user_id'];
                $obj_result = mysqli_query($obj_db, $str_query);

                $arr_calendar = mysqli_fetch_row($obj_result);
            }
            
            return !empty($arr_calendar);
        }
    }
    
    /**
     * 
     * @global type $obj_db
     * @param type $cal_id
     * @return type
     */
    public static function getColor($cal_id) {
		global $obj_db;

		$str_query = 'SELECT calendar_color FROM calendars WHERE calendar_id = '. $cal_id;
		$obj_result = mysqli_query($obj_db, $str_query);

	  	$arr_calendar = mysqli_fetch_row($obj_result);

	  	return $arr_calendar[0];
    }

    /**
     * 
     * @global type $obj_db
     * @param type $frm_submitted
     * @return boolean
     */
    public static function updateCalendar($frm_submitted) {
		global $obj_db;

		$str_query = 'UPDATE calendars SET '.($frm_submitted['bln_color_future_events'] ? 'events_color = "'.$frm_submitted['color'].'",' : '').' calendar_color = "'.$frm_submitted['color'].'", name = "'.$frm_submitted['title'].'" WHERE calendar_id = '. $frm_submitted['cal_id'];
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {

			return true;
		}
		return false;

    }

    /**
     * 
     * @global type $obj_db
     * @return type
     */
    public static function hasOneCalendar() {
		global $obj_db;

		$str_query = 'SELECT * FROM calendars WHERE `deleted` = 0';
		$obj_result = mysqli_query($obj_db, $str_query);

		$arr_calendars = array();

	  	while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			$arr_calendars[] = $arr_line;
		}

	  	return count($arr_calendars) == 1;
    }
    
    /**
     * 
     * @global type $obj_db
     * @return type
     */
    public static function noCalendarsCreated() {
		global $obj_db;

		$str_query = 'SELECT * FROM calendars WHERE `deleted` = 0';
		$obj_result = mysqli_query($obj_db, $str_query);

        if($obj_result !== false) {
            $arr_calendars = array();

            while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
                $arr_calendars[] = $arr_line;
            }

            return count($arr_calendars) == 0;
        } else {
            echo 'something wrong with the calendars table, check hte structure'; exit;
        }
		
    }
}
?>