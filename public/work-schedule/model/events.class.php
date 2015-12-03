<?php
class Events {

    public static function updateEvents($cal_id, $color='') {
		global $obj_db;

		$str_query = 'UPDATE events SET '.(!empty($color) ? 'color = "'.$color.'"' : '').' WHERE calendar_id = '. $cal_id;
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			return true;
		}
		return false;
    }

    public static function getCurrentEvent($ajax=false) {
        global $obj_db;
	  	$arr_return = array();
	
		$str_query = 'SELECT title, time_end, date_end, allDay, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end FROM events WHERE "'.date('Y-m-d').'" BETWEEN `date_start` AND `date_end` ';

		$res = mysqli_query($obj_db, $str_query);
     
        if($res !== false && !empty($res)) {
            while ($arr_line = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                if($arr_line['allDay'] || (time() > strtotime($arr_line['start']) && time() < strtotime($arr_line['end']))) {
                    $arr_line['end_is_today'] = false;
                    if($arr_line['date_end'] == date('Y-m-d')) {
                        $arr_line['end_is_today'] = true;
                    }
                    $arr_return[] = $arr_line;
                   
                }
            }
            if($ajax) {
                echo json_encode(array('current' => $arr_return));exit;
            } else {
                return $arr_return;
            }
        }
	}
    
    
    public static function getLastAddedEvents($amount=5, $ajax=false) {
        global $obj_db;
	  	$arr_return = array();
	
        if(User::isLoggedIn()) {
            $arr_user = User::getUser();
            
            $arr_cal_ids = array();
            $arr_admin_calendars = Calendar::getCalendarsOfAdmin($arr_user['user_id']);
            foreach($arr_admin_calendars as $cal) {
                $arr_cal_ids[] = $cal['calendar_id'];
            }
            
            $str_query = 'SELECT e.*,c.*, concat_ws(" ",e.date_start,e.time_start) as start,concat_ws(" ",e.date_end,e.time_end) as end FROM events e LEFT JOIN calendars c ON(c.calendar_id = e.calendar_id) ';
            $str_query .= ' WHERE 1 ';
            
            if((User::isSuperAdmin() || User::isAdmin()) && ADMIN_HAS_FULL_CONTROL) {
                
            } else {
                
              // $str_query .= ' AND c.share_type = "public" OR c.creator_id = '. $arr_user['user_id'];
            }
            if(!User::isSuperAdmin()) {
                $str_query .= ' AND c.calendar_id IN('.implode(',', $arr_cal_ids).')';
            }
            
            
            $str_query .= ' ORDER BY e.`create_date` DESC LIMIT '. $amount;

            $res = mysqli_query($obj_db, $str_query);

            if($res !== false && !empty($res)) {
                while ($arr_line = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $arr_return[] = $arr_line;

                }
                if($ajax) {
                    echo json_encode(array('current' => $arr_return));exit;
                } else {
                    return $arr_return;
                }
            }
        }
	}
    
	public static function getEvents($frm_submitted) {
		global $obj_db;
	  	$arr_content = array();

		// get startdate and enddate from repeating_events table
		$arr_rep_events = array();

		$str_query_r = 'SELECT * FROM repeating_events ';

		$res1 = mysqli_query($obj_db, $str_query_r);

		while ($arr_line = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
			$arr_rep_events[$arr_line['rep_event_id']] = $arr_line;
		}

		$str_query = 'SELECT *, event_id as id, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end FROM events '.
		' WHERE ((date_start BETWEEN "'.date("Y-m-d", $frm_submitted['start']) .'" AND "'.date("Y-m-d", $frm_submitted['end']).'") OR ('.
							' date_end BETWEEN "'.date("Y-m-d", $frm_submitted['start']) .'" AND "'.date("Y-m-d", $frm_submitted['end']).'")) ';

		if(!empty($frm_submitted['cal_id'])) {
			$str_query .= ' AND calendar_id IN ( '.$frm_submitted['cal_id'] .')';
		}

		$str_query .= 'order by start';

	  	$obj_result = mysqli_query($obj_db, $str_query);

	  	while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			$arr_line['allDay'] 	= $arr_line['allDay'] == 0 ? false : true;
			$arr_line['allowEdit'] 	= User::canEdit($arr_line['user_id'], $arr_line['calendar_id']);
			$arr_line['editable'] 	= User::canEdit($arr_line['user_id'], $arr_line['calendar_id']);
			$arr_line['deletable'] 	= User::canDelete($arr_line['user_id'], $arr_line['calendar_id']);
            $arr_line['canChangeColor'] = User::canChangeColor($arr_line['user_id'], $arr_line['calendar_id']);
            
            $arr_cal = Calendar::getCalendar($arr_line['calendar_id']);
            $arr_line['canMail'] = Calendar::calCanMail($arr_cal);
			
			// get calendar name //
			$query = 'SELECT name FROM calendars WHERE calendar_id ='.$arr_line['calendar_id'];
			$cal_obj = mysqli_query($obj_db, $query);
			$cal_name = mysqli_fetch_array($cal_obj, MYSQLI_ASSOC);
			$arr_line['cal_name'] = $cal_name['name'];
			
			if(defined('SORT_ALL_CALENDARS_BY_CALENDARID') && SORT_ALL_CALENDARS_BY_CALENDARID) {
				$arr_line['sorter'] = $arr_line['calendar_id'];
			}

            // i already do this while opening an event
            // $arr_line['files'] = Events::getFiles($arr_line['event_id']);
            
			if($arr_line['repeating_event_id'] > 0) {
	  			// repeating events must have the same id
	  			$arr_line['id'] = $arr_line['repeating_event_id'];
	  			$arr_line['textColor'] = 'black';
	  			$arr_line['editable'] = false;	// to unable dragging
	  			if($arr_line['allowEdit']) {
	  				$arr_line['className'] = 'not-draggable cursorhand';
	  			}


	  			if(isset($arr_rep_events[$arr_line['repeating_event_id']])) {
	  				$arr_line['rep_start'] 	= $arr_rep_events[$arr_line['repeating_event_id']]['startdate'];
	  				$arr_line['rep_end'] 	= $arr_rep_events[$arr_line['repeating_event_id']]['enddate'];
	  				$arr_line['rep_event'] = $arr_rep_events[$arr_line['repeating_event_id']];
                    
                    if($arr_line['rep_event']['rep_interval'] == 'Y') {
                         // get 'until' year
                        $end_year = date('Y', strtotime($arr_line['rep_end']));

                        $recur_yearmonthday = str_pad($arr_line['rep_event']['yearmonthday'], 2, 0, STR_PAD_LEFT);
                        $recur_yearmonth = str_pad($arr_line['rep_event']['yearmonth'] + 1, 2, 0, STR_PAD_LEFT);

                        // recurring event in endyear
                        $endyear_recurring_date = $end_year.'-'.$recur_yearmonth.'-'.$recur_yearmonthday;

                        if(strtotime($endyear_recurring_date) <= strtotime($arr_line['rep_end'])) {
                            $arr_line['rep_event']['until'] = $end_year;
                        } else {
                            $arr_line['rep_event']['until'] = $end_year -1;
                        }
                    }
                }

	  			$arr_line['rep_start_day'] = (int) date('d', strtotime($arr_line['rep_start']));
	  		}

			if(isset($_SESSION['employee-work-schedule-sd']) && isset($_SESSION['employee-work-schedule-ft']) ) {
				if(substr($arr_line['start'], 0, 10) == $_SESSION['employee-work-schedule-sd'] && $arr_line['title'] == $_SESSION['employee-work-schedule-ft']) {
					$arr_line['textColor'] = 'red';
					$arr_line['backgroundColor'] = 'white';
					$arr_line['borderColor'] = 'red';
				}
			}

			$arr_content[] = $arr_line;
		}
		unset($_SESSION['employee-work-schedule-sd']);
		unset($_SESSION['employee-work-schedule-ft']);
		
		foreach($arr_content as $arr){
			if($arr['order_id'] == $_SESSION['order_id']){
				'<script>
				$(".fc-event fc-event-hori").addClass("current");
				</script>';
			}else{
			
			}
		
		}
		return $arr_content;
	}

    public static function getFiles($int_event_id, $current_user_id='') {
        $arr_return = array();
        global $obj_db;
       
        if(User::isLoggedIn()) {
            $arr_user = User::getUser();
        }
        
        $str_query = 'SELECT * FROM event_files WHERE `event_id` = ' . $int_event_id;

        $obj_result = mysqli_query($obj_db, $str_query);

        while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
            // only possible to delete your own files
            if(User::isLoggedIn() && $arr_line['create_id'] == $arr_user['user_id']) {
                $arr_line['loggedin_user_can_delete'] = true;
            } else {
                $arr_line['loggedin_user_can_delete'] = false;
            }
            
            $arr_return[] = $arr_line;
        }
        return $arr_return;
    }
    
    public static function removeFile($int_event_id, $int_event_file_id) {
        $arr_return = array();
        global $obj_db;
       
        if(User::isLoggedIn()) {
            $arr_user = User::getUser();
            
            $str_query1 = 'SELECT * FROM event_files WHERE `event_id` = ' . $int_event_id . ' AND `event_file_id` = ' . $int_event_file_id;


			$res1 = mysqli_query($obj_db, $str_query1);

			if($res1 !== false) {
				$arr_file = mysqli_fetch_array($res1, MYSQLI_ASSOC);
			}
       
            if(!is_null($arr_file)) {
                $str_query = 'DELETE FROM event_files WHERE `event_id` = ' . $int_event_id . ' AND `event_file_id` = ' . $int_event_file_id;

                $obj_result = mysqli_query($obj_db, $str_query);

                if($obj_result) {
                    // delete file from uploads folder
                    unlink(FULLCAL_DIR . '/uploads/' . $arr_file['filename'] . '.' . $arr_file['file_extension']);

                    return true;
                } 
            }
            
            
        } 
        return false;
    }
    
    public static function insertEvent($frm_submitted, $current_user_id='') {

		global $obj_db;

        $arr_calendar = array();
		if($frm_submitted['cal_id'] > 0) {
	       $arr_calendar = Calendar::getCalendar($frm_submitted['cal_id']);
	   	} 
        
        if(User::isLoggedIn() || ($arr_calendar['share_type'] == 'public' && $arr_calendar['can_add'])) {
            
			if(empty($current_user_id)) {
				$arr_user = User::getUser();
                if(!empty($arr_user) && is_array($arr_user)) {
                    $current_user_id = $arr_user['user_id'];                
                }
            }

			if(IGNORE_TIMEZONE) {
				$str_startdate = $frm_submitted['str_date_start'];
				$str_enddate = $frm_submitted['str_date_end'];
				$str_starttime = substr($frm_submitted['str_date_start'], 10);
				$str_endtime = substr($frm_submitted['str_date_end'], 10);
			} else {
				$str_startdate = date('Y-m-d', $frm_submitted['date_start']);
				$str_enddate = date('Y-m-d', $frm_submitted['date_end']);
				$str_starttime = date('H:i:s', $frm_submitted['date_start']);
				$str_endtime = date('H:i:s', $frm_submitted['date_end']);
			}
			
			$query = "select * from events where order_id=".$frm_submitted['order_id'];
			$assigned = mysqli_query($obj_db, $query);
			if(!empty($assigned)){
				mysqli_query($obj_db, "delete from events where order_id=".$frm_submitted['order_id']);
			}
			$str_query = 'INSERT INTO events ( title, description, calendar_id, location, phone, myurl, repeating_event_id, user_id, color, date_start, time_start, date_end, time_end, create_date, allday, order_id) ' .
				'VALUES ("'.mysqli_real_escape_string($obj_db, $frm_submitted['title']).'",' .
						'"'.mysqli_real_escape_string($obj_db, $frm_submitted['description']).'",'.
						'"'.$frm_submitted['cal_id'].'",' .
						'"'.mysqli_real_escape_string($obj_db, $frm_submitted['location']).'",' .
						'"'.mysqli_real_escape_string($obj_db, $frm_submitted['phone']).'",'.
						'"'.mysqli_real_escape_string($obj_db, $frm_submitted['myurl']).'",'.
						(!empty($frm_submitted['rep_event_id']) ? $frm_submitted['rep_event_id'] : 0).','.
						'"'.$current_user_id.'",'.
						'"'.$frm_submitted['color'].'",'.
						'"'.$str_startdate.'",'.
						'"'.$str_starttime.'",'.
						'"'.$str_enddate.'",'.
						'"'.$str_endtime.'",'.
						'"'.date('Y-m-d H:i:s').'"'.
						((date('H:i:s', $frm_submitted['date_start']) == '00:00:00' && date('H:i:s', $frm_submitted['date_end']) == '00:00:00') || $frm_submitted['allDay'] == 1 ? ' ,1' : ' ,0').','.$frm_submitted['order_id'].''.')';
				$obj_result = mysqli_query($obj_db, $str_query);

			if($obj_result !== false) {
				$str_query = 'SELECT *, event_id as id, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end ' .
	    			'FROM events WHERE event_id = '.mysqli_insert_id($obj_db);

		    	$obj_result2 = mysqli_query($obj_db, $str_query);

		    	$arr_event = mysqli_fetch_array($obj_result2, MYSQLI_ASSOC);

                if(empty($arr_calendar)) {
                    $arr_calendar = Calendar::getCalendar($arr_event['calendar_id']);
                }
		    	$arr_event['allDay'] 	= $arr_event['allDay'] == 0 ? false : true;
		    	$arr_event['allowEdit'] = true;//	= User::canEdit($arr_event['user_id']);
                $arr_event['editable'] 	= true; //= User::canEdit($arr_event['user_id']);
				$arr_event['deletable'] = User::canDelete($arr_event['user_id']);
                $arr_event['canChangeColor'] = User::canChangeColor($arr_event['user_id'], $arr_event['calendar_id']);
                $arr_event['canMail'] = Calendar::calCanMail($arr_calendar);

                // notification mail to admin
                if(Calendar::calMailEventModsToAdmin($arr_calendar)) {
                    $arr_user = User::getUserById($arr_event['user_id']);
                    
                    $to_mail = Calendar::getCalendarAdminEmail($arr_calendar);
                    if(!empty($to_mail)) {
                        $bln_send = Utils::sendMail('mail_event', $to_mail, '', $frm_submitted, $arr_user);
                    }
                   
                }
			} else {
				return false;
			}

			return $arr_event;
		} else {
			return false;
		}
    }

    public static function updateEvent($frm_submitted) {
		global $obj_db;
	  	$arr_event = array();
	
        $arr_calendar = array();
		if($frm_submitted['cal_id'] > 0) {
	       $arr_calendar = Calendar::getCalendar($frm_submitted['cal_id']);
	   	} else {
            $int_calendar_id = Calendar::getCalendarIdByEventId($frm_submitted['event_id']);
            $arr_calendar = Calendar::getCalendar($int_calendar_id);
        }
       
        $bln_change_cal_id = false;
        
        if(defined('MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE') && MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE === true) {
            if($frm_submitted['calendar_id'] > 0 && $frm_submitted['calendar_id'] != $frm_submitted['cal_id']) {
                $bln_change_cal_id = true;
            }
        }
        
		if(IGNORE_TIMEZONE) {
			$str_startdate = $frm_submitted['str_date_start'];
			$str_enddate = $frm_submitted['str_date_end'];
			$str_starttime = substr($frm_submitted['str_date_start'], 10);
			$str_endtime = substr($frm_submitted['str_date_end'], 10);
		} else {
			$str_startdate = date('Y-m-d', $frm_submitted['date_start']);
			$str_enddate = date('Y-m-d', $frm_submitted['date_end']);
			$str_starttime = date('H:i:s', $frm_submitted['date_start']);
			$str_endtime = date('H:i:s', $frm_submitted['date_end']);
		}
		
		$str_query = 'UPDATE events SET date_start = "'.$str_startdate.'" ' .
				($bln_change_cal_id ? ', calendar_id = "'.$frm_submitted['calendar_id'].'"' : '').
                (!empty($frm_submitted['title']) ? ', title = "'.$frm_submitted['title'].'"' : '').
				(!empty($frm_submitted['location']) ? ', location = "'.$frm_submitted['location'].'"' : '').
				(!empty($frm_submitted['phone']) ? ', phone = "'.$frm_submitted['phone'].'"' : '').
				(!empty($frm_submitted['myurl']) ? ', myurl = "'.$frm_submitted['myurl'].'"' : '').
                (!empty($frm_submitted['description']) ? ', description = "'.addslashes($frm_submitted['description']).'"' : '').
				(isset($frm_submitted['color']) && $frm_submitted['color'] != 'undefined' ? ', color = "'.$frm_submitted['color'].'"' : '').
				', date_end = "'.$str_enddate.'" ' .
				', time_start = "'.(isset($frm_submitted['allDay']) && $frm_submitted['allDay'] ? '00:00:00' : $str_starttime).'" ' .
				', time_end = "'.(isset($frm_submitted['allDay']) && $frm_submitted['allDay'] ? '00:00:00' : $str_endtime).'" ' .
				', create_date = "'.date('Y-m-d H:i:s').'" ' .
				((isset($frm_submitted['allDay']) && $frm_submitted['allDay']) || ($str_starttime == '00:00:00' && $str_endtime == '00:00:00') ? ' ,allDay = 1' : ' ,allDay = 0').
					' WHERE event_id = '.$frm_submitted['event_id'];

//        if(isset($_SESSION['calendar-uid']['uid']) && $_SESSION['calendar-uid']['uid'] > 0) {
//            $bln_users_can_change_items_from_others = Settings::getAdminSetting('users_can_change_items_from_others', $_SESSION['calendar-uid']['uid']);
//        } else {
//            $bln_users_can_change_items_from_others = USERS_CAN_CHANGE_ITEMS_FROM_OTHERS;
//        }
    
		//if(($bln_users_can_change_items_from_others) || (User::isLoggedIn() && (User::isAdmin() || User::isSuperAdmin()))) {
		$bln_admin_and_full_control = ADMIN_HAS_FULL_CONTROL && (User::isAdmin() || User::isSuperAdmin());
        $bln_public_cal_and_edit_allowed = $arr_calendar['share_type'] == 'public' && $arr_calendar['can_edit'];
        if(User::isLoggedIn() && $bln_admin_and_full_control) {
			// don't check on user_id
		} else if($bln_public_cal_and_edit_allowed) {
            // don't check on user_id
        } else {
			$str_query .= ' AND user_id = '. $_SESSION['calendar-uid']['uid'];
		}

		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			$str_query = 'SELECT *, event_id as id, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end ' .
					'FROM events WHERE event_id = '.$frm_submitted['event_id'];
			$obj_result = mysqli_query($obj_db, $str_query);
			$arr_event = mysqli_fetch_array($obj_result, MYSQLI_ASSOC);

			$arr_event['allDay'] 	= $arr_event['allDay'] == 0 ? false : true;
			$arr_event['allowEdit'] 	= User::canEdit($arr_event['user_id']);
			$arr_event['deletable'] = User::canDelete($arr_event['user_id']);
            
            if(empty($arr_calendar)) {
                $arr_calendar = Calendar::getCalendar($arr_event['calendar_id']);
            }
            
            // notification mail to admin
            if(Calendar::calMailEventModsToAdmin($arr_calendar)) {
                $arr_user = User::getUserById($arr_event['user_id']);
                
                $to_mail = Calendar::getCalendarAdminEmail($arr_calendar);
                if(!empty($to_mail)) {
                    $bln_send = Utils::sendMail('mail_event', $to_mail, '', $frm_submitted, $arr_user);
                }
            }
		}
		return $arr_event;
	}

	public static function resizeEvent($frm_submitted) {
		global $obj_db;

        $arr_calendar = array();
		if($frm_submitted['cal_id'] > 0) {
	       $arr_calendar = Calendar::getCalendar($frm_submitted['cal_id']);
	   	} else {
            $int_calendar_id = Calendar::getCalendarIdByEventId($frm_submitted['event_id']);
            $arr_calendar = Calendar::getCalendar($int_calendar_id);
        }
        
		if(IGNORE_TIMEZONE) {
			$str_startdate = $frm_submitted['str_date_start'];
			$str_enddate = $frm_submitted['str_date_end'];
			$str_starttime = substr($frm_submitted['str_date_start'], 10);
			$str_endtime = substr($frm_submitted['str_date_end'], 10);
		} else {
			$frm_submitted['date_start'] -= TIME_OFFSET;
	  		$frm_submitted['date_end'] -= TIME_OFFSET;
	  		
	  		$str_startdate = date('Y-m-d', $frm_submitted['date_start']);
			$str_enddate = date('Y-m-d', $frm_submitted['date_end']);
			$str_starttime = date('H:i:s', $frm_submitted['date_start']);
			$str_endtime = date('H:i:s', $frm_submitted['date_end']);
		}
		$str_query = 'UPDATE events SET date_start = "'.$str_startdate.'" ' .
				', date_end = "'.$str_enddate.'" ' .
				', time_start = "'.$str_starttime.'" ' .
				', time_end = "'.$str_endtime.'" ' .
					' WHERE event_id = '.$frm_submitted['event_id'];

//        if(isset($_SESSION['calendar-uid']['uid']) && $_SESSION['calendar-uid']['uid'] > 0) {
//            $bln_users_can_change_items_from_others = Settings::getAdminSetting('users_can_change_items_from_others', $_SESSION['calendar-uid']['uid']);
//        } else {
//            $bln_users_can_change_items_from_others = USERS_CAN_CHANGE_ITEMS_FROM_OTHERS;
//        }
        
		//if($bln_users_can_change_items_from_others) {
               
        $bln_admin_and_full_control = ADMIN_HAS_FULL_CONTROL && (User::isAdmin() || User::isSuperAdmin());
        $bln_public_cal_and_edit_allowed = $arr_calendar['share_type'] == 'public' && $arr_calendar['can_edit'];
        
        if(User::isLoggedIn() && $bln_admin_and_full_control) {
			// don't check on user_id
		} else if(!User::isLoggedIn() && $bln_public_cal_and_edit_allowed) {
            // don't check on user_id
        } else {
			$str_query .= ' AND user_id = '. $_SESSION['calendar-uid']['uid'];
		}

		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			$str_query = 'SELECT *, event_id as id, concat_ws(" ",date_start,time_start) as start,concat_ws(" ",date_end,time_end) as end ' .
					'FROM events WHERE event_id = '.$frm_submitted['event_id'];
			$obj_result = mysqli_query($obj_db, $str_query);
			$arr_event = mysqli_fetch_array($obj_result, MYSQLI_ASSOC);

			$arr_event['allDay'] 	= $arr_event['allDay'] == 0 ? false : true;
			$arr_event['allowEdit'] 	= User::canEdit($arr_event['user_id']);
			$arr_event['deletable'] 	= User::canDelete($arr_event['user_id']);

			return $arr_event;
		}
		return false;
	}

//	public static function deleteEvent($int_event_id) {
//		global $obj_db;
//
//		$str_query = 'DELETE FROM events WHERE event_id = '.$int_event_id;
//
//		if(defined('USERS_CAN_DELETE_ITEMS_FROM_OTHERS') && USERS_CAN_DELETE_ITEMS_FROM_OTHERS) {
//			// don't check on user_id
//		} else {
//			$str_query .= ' AND user_id = '. $_SESSION['calendar-uid']['uid'];
//		}
//
//		$obj_result = mysqli_query($obj_db, $str_query);
//
//		if($obj_result !== false) {
//			return true;
//		}
//		return false;
//	}

	public static function deleteEvent($frm_submitted) {
		global $obj_db;
		if(isset($frm_submitted['delete_all']) && $frm_submitted['delete_all'] === true && isset($frm_submitted['rep_event_id']) && $frm_submitted['rep_event_id'] > 0) {

			// part of repeat , delete all items
			$str_query = 'DELETE FROM events WHERE repeating_event_id = '.$frm_submitted['rep_event_id'].' AND user_id = '. $_SESSION['calendar-uid']['uid'];
			$obj_result = mysqli_query($obj_db, $str_query);

			if($obj_result !== false) {

				// delete row from repeating_events
				$str_query = 'DELETE FROM repeating_events WHERE rep_event_id = '.$frm_submitted['rep_event_id'];
				$obj_result = mysqli_query($obj_db, $str_query);
				if($obj_result !== false) {
					return true;
				}


			}

		} else if($frm_submitted['rep_event_id'] > 0) {

			// part of repeat , delete only this one
			$str_query = 'DELETE FROM events WHERE event_id = '.$frm_submitted['event_id'].' AND user_id = '. $_SESSION['calendar-uid']['uid'];
			$obj_result = mysqli_query($obj_db, $str_query);

			// the pattern is broken, put bln_broken in db,
			// so that we know it that we have to show the repair pattern button
			$str_update_query = 'UPDATE repeating_events SET bln_broken = 1 WHERE rep_event_id = ' . $frm_submitted['rep_event_id'];
			$res = mysqli_query($obj_db, $str_update_query);


			if($obj_result !== false) {

				// check if there is only one item left in this repeat,
				// if yes then delete row in repeating_events table and set repeating_event_id to 0 in events table
				if(self::OneHasLeftOfThisRepeat($frm_submitted['rep_event_id'])) {
					$str_query = 'DELETE FROM repeating_events WHERE rep_event_id = '.$frm_submitted['rep_event_id'];
					$obj_result = mysqli_query($obj_db, $str_query);
					if($obj_result !== false) {

						// update row
						//$str_update_query = 'UPDATE events SET repeating_event_id = 0 WHERE event_id = '.$frm_submitted['event_id'];
						$str_update_query = 'UPDATE events SET repeating_event_id = 0 WHERE repeating_event_id = '.$frm_submitted['rep_event_id'];
						$obj_result = mysqli_query($obj_db, $str_query);
						if($obj_result !== false) {
							return true;
						}
					} else {
						echo 'Error while trying to delete the row in repeating_events table';
					}
				}
				return true;

			} else {
				echo 'Error while trying to delete the event';
			}
		} else {

			/*
			 * normal event
			 */
			$str_query = 'DELETE FROM events WHERE event_id = '.$frm_submitted['event_id'];
            
            $bln_admin_and_full_control = ADMIN_HAS_FULL_CONTROL && (User::isAdmin() || User::isSuperAdmin());
        
            if(User::isOwner() || $bln_admin_and_full_control) {
                // dont need to search on user_id
            } else {
                $str_query.= ' AND user_id = '. $_SESSION['calendar-uid']['uid'];
            }
            
			$obj_result = mysqli_query($obj_db, $str_query);

			if($obj_result !== false) {


				return true;
			}
		}

		return false;
	}

	public static function OneHasLeftOfThisRepeat($rep_event_id) {
		global $obj_db;
		$arr_content = array();

		$str_query = 'SELECT * FROM events WHERE repeating_event_id = '.$rep_event_id;
		$obj_result = mysqli_query($obj_db, $str_query);

		while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			$arr_content[] = $arr_line;
		}
		if(count($arr_content) == 1) {
			return true;
		} else {
			return false;
		}
	}

	public static function insertRepeatingEvent($arr_dates, $frm_submitted) {
		global $obj_db;

		// set the first date as source

		if(IGNORE_TIMEZONE) {
			$str_startdate = $frm_submitted['str_date_start'];
			$str_enddate = $frm_submitted['str_date_end'];
			$str_starttime = substr($frm_submitted['str_date_start'], 10);
			$str_endtime = substr($frm_submitted['str_date_end'], 10);
		} else {
			$str_startdate = date('Y-m-d', $frm_submitted['date_start']);
			$str_enddate = date('Y-m-d', $frm_submitted['date_end']);
			$str_starttime = date('H:i:s', $frm_submitted['date_start']);
			$str_endtime = date('H:i:s', $frm_submitted['date_end']);
		}
		
		$str_query = 'INSERT INTO repeating_events ( rep_interval, weekdays, monthday, yearmonthday, yearmonth, startdate, enddate) VALUES '.
					'("'.$frm_submitted['interval'].'",'.
					'"'.$frm_submitted['weekdays'].'",'.
					'"'.$frm_submitted['monthday'].'",'.
                    '"'.$frm_submitted['yearmonthday'].'",'.
                    '"'.$frm_submitted['yearmonth'].'",'.
					'"'.$str_startdate.'",'.
					'"'.$str_enddate.'")';

		$res = mysqli_query($obj_db, $str_query);

		$int_rep_event_id = mysqli_insert_id($obj_db);

        // check if moved to another calendar
        $bln_change_cal_id = false;
        
        if(defined('MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE') && MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE === true) {
            if(isset($frm_submitted['calendar_id']) && $frm_submitted['calendar_id'] > 0 && $frm_submitted['calendar_id'] != $frm_submitted['cal_id']) {
                $bln_change_cal_id = true;
            }
        }
        
		$str_query_r = 'INSERT INTO events ( title, location, description, phone, myurl, calendar_id, repeating_event_id, user_id, color, date_start, time_start, date_end, time_end, create_date, allday) VALUES ';

		foreach($arr_dates as $key=>$date) {
			if($key != 0) {
				$str_query_r .= ',';
			}
			$str_query_r .= '("'.$frm_submitted['title'].'",' .
					'"'.$frm_submitted['location'].'",' .
					'"'.$frm_submitted['description'].'",'.
					'"'.$frm_submitted['phone'].'",'.
					'"'.$frm_submitted['myurl'].'",'.
                    ($bln_change_cal_id ? $frm_submitted['calendar_id'] : $frm_submitted['cal_id']).','.
					$int_rep_event_id.','.
					$_SESSION['calendar-uid']['uid'].','.
					'"'.$frm_submitted['color'].'",'.
					'"'.$date.'",'.
					'"'.$str_starttime.'",'.
					'"'.$date.'",'.
					'"'.$str_endtime.'",'.
					'"'.date('Y-m-d H:i:s').'"'.
					(($str_starttime == '00:00:00' && $str_endtime == '00:00:00') || $frm_submitted['allDay'] == 1 ? ' ,1' : ' ,0').')';

		}

		$res = mysqli_query($obj_db, $str_query_r);
        
        if($res) {
            $arr_calendar = array();
            if($frm_submitted['cal_id'] > 0) {
               $arr_calendar = Calendar::getCalendar($frm_submitted['cal_id']);
            }     
            if(!empty($arr_calendar)) {
                // notification mail to admin
                if(Calendar::calMailEventModsToAdmin($arr_calendar)) {
                    $arr_user = User::getUserById($_SESSION['calendar-uid']['uid']);

                    $to_mail = Calendar::getCalendarAdminEmail($arr_calendar);
                    if(!empty($to_mail)) {
                        $bln_send = Utils::sendMail('mail_event', $to_mail, '', $frm_submitted, $arr_user);
                    }
                }
            }
            
        }
	}

	public static function updateRepeatingEvent($arr_dates, $frm_submitted) {
		global $obj_db;

		if(IGNORE_TIMEZONE) {
			$str_startdate = $frm_submitted['str_date_start'];
			$str_enddate = $frm_submitted['str_date_end'];
			$str_starttime = substr($frm_submitted['str_date_start'], 10);
			$str_endtime = substr($frm_submitted['str_date_end'], 10);
		} else {
			$str_startdate = date('Y-m-d', $frm_submitted['date_start']);
			$str_enddate = date('Y-m-d', $frm_submitted['date_end']);
			$str_starttime = date('H:i:s', $frm_submitted['date_start']);
			$str_endtime = date('H:i:s', $frm_submitted['date_end']);
		}
		
		/*
		 * check if interval or weekdays have changed
		 */

		//TODO other intervals 2weeks 


		// get the pattern
		$str_select_repeating_query = 'SELECT * FROM repeating_events WHERE rep_event_id = ' . $frm_submitted['rep_event_id'];
		$obj_result1 = mysqli_query($obj_db, $str_select_repeating_query);
		$arr_repeat_pattern = mysqli_fetch_array($obj_result1, MYSQLI_ASSOC);

		// update repeating_events table
		$str_update_query = 'UPDATE repeating_events SET rep_interval = "'.$frm_submitted['interval'].'", ' .
								'weekdays = "'.$frm_submitted['weekdays'].'",' .
								'monthday = "'.$frm_submitted['monthday'].'",' .
								'yearmonthday = "'.$frm_submitted['yearmonthday'].'",' .
								'yearmonth = "'.$frm_submitted['yearmonth'].'",' .
								'startdate = "'.$str_startdate.'",' .
								'enddate = "'.$str_enddate.'" ' .
							'WHERE rep_event_id = ' . $frm_submitted['rep_event_id'];


		$res = mysqli_query($obj_db, $str_update_query);

         // check if moved to another calendar
        $bln_change_cal_id = false;
        
        if(defined('MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE') && MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE === true) {
            if($frm_submitted['calendar_id'] > 0 && $frm_submitted['calendar_id'] != $frm_submitted['cal_id']) {
                $bln_change_cal_id = true;
            }
        }
        
		// update events
		$str_update_events_query = 'UPDATE `events` SET title = "'.$frm_submitted['title'].'", ' .
										'`color` = "'.$frm_submitted['color'].'", ' ;
        if($bln_change_cal_id) {
            $str_update_events_query .= '`calendar_id` = "'.$frm_submitted['calendar_id'].'", ';
        }
        
		$str_update_events_query .= 	'`location` = "'.$frm_submitted['location'].'", ' .
										'`description` = "'.$frm_submitted['description'].'", ' .
										'`phone` = "'.$frm_submitted['phone'].'", ' .
										'`myurl` = "'.$frm_submitted['myurl'].'", ' .
										'`time_start` = "'.$str_starttime.'", '.
										'`time_end` = "'.$str_endtime.'", '.
										'`allDay` = '.(($str_starttime == '00:00:00' && $str_endtime == '00:00:00') || $frm_submitted['allDay'] == 1 ? '1 ' : '0 ').
									'WHERE `repeating_event_id` = ' . $frm_submitted['rep_event_id'];
		$res2 = mysqli_query($obj_db, $str_update_events_query);
        
        
		/*
		 * get all existing items in this pattern
		 */
		$arr_events_from_this_pattern = array();

		$str_events_query = 'SELECT * FROM events WHERE repeating_event_id = '. $frm_submitted['rep_event_id'];
		$obj_result1 = mysqli_query($obj_db, $str_events_query);
		while ($arr_line = mysqli_fetch_array($obj_result1, MYSQLI_ASSOC)) {
			$arr_events_from_this_pattern[] = $arr_line;

		}

		/*
		 * find deleted weekdays
		 */
		 $current_user_id = '';
		foreach($arr_events_from_this_pattern as $event) {
			if(!in_array($event['date_start'], $arr_dates)) {
				// delete
				$obj_result_del = mysqli_query($obj_db, 'DELETE FROM events WHERE event_id = '.$event['event_id']);

			} else {
				$search = array_search($event['date_start'], $arr_dates);
				unset($arr_dates[$search]);
			}
			$time_start = $event['time_start'];
			$time_end = $event['time_end'];
			$current_user_id = $event['user_id'];
            $current_calendar_id = $event['calendar_id'];
		}

		/*
		 * added/changed weekdays
		 */

		if($frm_submitted['repair_pattern']
			|| $arr_repeat_pattern['weekdays'] != $frm_submitted['weekdays']
			|| $arr_repeat_pattern['startdate'] != $str_startdate
			|| $arr_repeat_pattern['enddate'] != $str_enddate
			// || $arr_event['rep_interval'] != $frm_submitted['interval']
			) {
			// add new items to pattern
			foreach($arr_dates as $day) {
                if(IGNORE_TIMEZONE) {
                    $frm_submitted['str_date_start'] = $day .' '. $time_start;
                    $frm_submitted['str_date_end'] = $day .' '. $time_end;
                } else {
                    $frm_submitted['date_start'] = strtotime($day .' '. $time_start);
                    $frm_submitted['date_end'] = strtotime($day .' '. $time_end);
                }
                
				self::insertEvent($frm_submitted, $current_user_id);
			}
		}

		if($frm_submitted['repair_pattern']) {
			// set bln_broken to 0
			$str_update_query = 'UPDATE repeating_events SET bln_broken = 0 WHERE rep_event_id = ' . $frm_submitted['rep_event_id'];
			$res3 = mysqli_query($obj_db, $str_update_query);

		}
        
        $current_calendar_id = 0;
        
        if(!$frm_submitted['repair_pattern']) {
            // because then the mail is already send in the insertEevent function
            
            // notification mail to admin
            if($current_calendar_id > 0 && !empty($current_user_id)) {
                $arr_calendar = Calendar::getCalendar($current_calendar_id);
                               
                if(Calendar::calMailEventModsToAdmin($arr_calendar)) {
                    $arr_user = User::getUserById($current_user_id);
                    
                    $to_mail = Calendar::getCalendarAdminEmail($arr_calendar);
                    if(!empty($to_mail)) {
                        $bln_send = Utils::sendMail('mail_event', $to_mail, '', $frm_submitted, $arr_user);
                    }
                }
            }
        }
        

	}

	public static function deleteRepeatingEvent($rep_event_id) {
		global $obj_db;

		// delete row from repeating_events
		$str_query = 'DELETE FROM repeating_events WHERE rep_event_id = '.$rep_event_id;
		$obj_result = mysqli_query($obj_db, $str_query);
		if($obj_result !== false) {
			return true;
		}
	}

	public static function setEventToNotRepeating($rep_event_id) {
		global $obj_db;

		$str_update_query = 'UPDATE events SET repeating_event_id = 0 WHERE repeating_event_id = '.$rep_event_id;
		$obj_result = mysqli_query($obj_db, $str_update_query);
		if($obj_result !== false) {
			return true;
		}
	}

	public static function isTimeAvailable($frm_submitted) {
		global $obj_db;

//		$str_query = 'SELECT * FROM events WHERE user_id = '. $_SESSION['mylogbook-uid']['uid'].
//				'AND '.$frm_submitted['date_start'].' BETWEEN date_start AND date_end';
		$str_query = 'SELECT * FROM events WHERE user_id = '. $_SESSION['calendar-uid']['uid'].
						' AND "'.date('Y-m-d H:i:s', $frm_submitted['date_start']).'" BETWEEN concat_ws(" ",date_start,time_start) AND concat_ws(" ",date_end,time_end)';
		$obj_result = mysqli_query($obj_db, $str_query);

		$arr_event = mysqli_fetch_array($obj_result, MYSQLI_ASSOC);
		if(!empty($arr_event)) {
			return false;
		}

		return true;
	}

	public static function getSmallCalEvents($cal_id, $year=null, $month=null, $day=null) {
		global $obj_db;
		$arr_content = array();

		$str_query = 'SELECT * , concat_ws( " ", date_start, time_start ) AS START , concat_ws( " ", date_end, time_end ) AS END FROM events as e
						WHERE 1 '.

						($year !== null && $month !== null ? ' and ((MONTH(date_start) = "'.$month.'" AND YEAR(date_start) = "'.$year.'"  ) OR (MONTH(date_end) = "' .$month.'" AND YEAR(date_end) = "'.$year.'" ))' : '').
						($day !== null ? ' and ("'.$year.'-'.$month.'-'.$day.'" BETWEEN date_start and date_end)' : '').
						' 	group by e.event_id ORDER BY date_start ';
		$obj_result = mysqli_query($obj_db, $str_query);

	  	while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			$arr_content[] = $arr_line;

		}
		return $arr_content;
	}

	public static function getSmallCalItems($arr_content) {
		$arr_result = array();

		foreach($arr_content as $event) {
			if(!isset($arr_result[substr($event['date_start'],8,2)])) {
				$arr_result[ltrim(substr($event['date_start'],8,2), '0')] = array();
			}
			// meerdaags event
			if($event['date_end'] != $event['date_start']) {
				$days_in_between = Utils::getDaysBetween($event['date_start'], $event['date_end']);
				foreach($days_in_between as $day) {
					$arr_result[ltrim(substr($day,8,2), '0')][] = $event;
				}

			} else {
				$arr_result[ltrim(substr($event['date_start'],8,2), '0')][] = $event;
			}

		}
		return $arr_result;
	}


	public static function getListviewEvents($frm_submitted, $bln_widget=true) {
		global $obj_db;
		$arr_content = array();

		if(defined('AGENDA_VIEW_AMOUNT_DAYS_TO_SHOW') && AGENDA_VIEW_AMOUNT_DAYS_TO_SHOW > 0) {
			$amount_days_to_show = AGENDA_VIEW_AMOUNT_DAYS_TO_SHOW;
		} else {
			$amount_days_to_show = 5;
		}

		$str_query = 'SELECT * ,event_id AS id, concat_ws( " ", date_start, time_start ) AS START , concat_ws( " ", date_end, time_end ) AS END ' .
				'FROM events as e WHERE 1 ';

		if(!empty($frm_submitted['from'])) {
			$date_to = date('Y-m-d', strtotime('+6 MONTH', strtotime($frm_submitted['from'])));
			$date_from = $frm_submitted['from'];

			$str_query .= ' AND ((date_start > "'.$date_from.'" AND date_start <= "'.$date_to.'")
							OR (
							date_start < "'.$date_from.'"
							AND (date_end BETWEEN "'.$date_from.'" AND "'.$date_to.'")
							))';
			$str_query .= '	ORDER BY date_start ASC';
		} else if(!empty($frm_submitted['to'])) {
			$date_from = date('Y-m-d', strtotime('-6 MONTH', strtotime($frm_submitted['to'])));
			$date_to = $frm_submitted['to'];

			$str_query .= ' AND (date_end < "'.$date_to.'" AND date_start >= "'.$date_from.'"	)';
			$str_query .= '	ORDER BY date_start DESC';
		} else {
			$date_from = date('Y-m-d');
			$date_to = date('Y-m-d', strtotime('+6 MONTH', strtotime($date_from)));

			$str_query .= ' AND (date_start >= DATE( NOW( ) )
							OR (
							date_start < DATE( NOW( ) )
							AND date_end >= DATE( NOW( ) )
							))';
			$str_query .= '	ORDER BY date_start ASC';
		}

		// if you want to show a specific amount of items
		//$str_query .= '	LIMIT '.$amount_days_to_show;


		$obj_result = mysqli_query($obj_db, $str_query);

	  	while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
			$arr_content[] = $arr_line;
		}

		$arr_result = self::getAgendaItems($arr_content, $frm_submitted);

		// if you want to show a specific amount of days
		$arr_result = array_slice($arr_result, 0, $amount_days_to_show);

		// when ->to the order is desc
		// after array_slice we want to sort normal again (asc)
		ksort($arr_result);

		$arr_return = array();
		$arr_return['results'] = $arr_result;
		$arr_return['hide_from'] = false;
		$arr_return['hide_to'] = false;

		//$arr_result = Utils::sortTwodimArrayByKey($arr_result, 'date_start');

		if(!empty($frm_submitted['from'])) {
			if(count($arr_result) < $amount_days_to_show) {
				$arr_return['hide_from'] = true;
			}
		}
		if(!empty($frm_submitted['to'])) {
			if(count($arr_result) < $amount_days_to_show) {
				$arr_return['hide_to'] = true;
			}
		}

		return $arr_return;
	}


	public static function getAgendaItems($arr_content, $frm_submitted=array()) {
		$arr_result = array();

		foreach($arr_content as $event) {

			// moreday event
			if($event['date_end'] != $event['date_start']) {

				if((defined('COMBINE_MOREDAYS_EVENTS') && COMBINE_MOREDAYS_EVENTS) && $frm_submitted['combine_moreday_events'] !== false) {
					if(defined('ENDDATE_OF_COMBINED_MOREDAYS_EVENTS_TEXT')) {
						$str_enddate_and_title = str_replace('%ENDDATE%', strftime("%A, %d %B", strtotime($event['date_end'])), ENDDATE_OF_COMBINED_MOREDAYS_EVENTS_TEXT);	// example: 'to %ENDDATE% ,inclusive'
						$event['title'] = $str_enddate_and_title.': '.$event['title'];
					} else {
						$event['title'] = '-> '.date('D, d M', strtotime($event['date_end'])).': '.$event['title'];
					}

					$arr_result[$event['date_start']][] = $event;
				} else {
					$days_in_between = Utils::getDaysBetween($event['date_start'], $event['date_end']);
					foreach($days_in_between as $day) {
						$arr_result[$day][] = $event;
				    }
				}

			} else {
				$arr_result[$event['date_start']][] = $event;
			}
		}
		return $arr_result;
	}
    
    public static function insertUploadedFile($arr_file) {

		global $obj_db;

        if(User::isLoggedIn()) {
            
            $arr_user = User::getUser();
            if(!empty($arr_user) && is_array($arr_user)) {
                $current_user_id = $arr_user['user_id'];                
            }
           	
            if($arr_file['type'] == 'jpeg') {
                $arr_file['type'] = 'jpg';
            }
            if($arr_file['type'] == 'x-log') {
                $arr_file['type'] = 'log';
            } 
			$str_query = 'INSERT INTO event_files ( filename, original_filename, event_id, file_extension, type, upload_date, create_id) ' .
				'VALUES ("'.mysqli_real_escape_string($obj_db, $arr_file['filename']).'",' .
						'"'.mysqli_real_escape_string($obj_db, $arr_file['orig_filename']).'",'.
						$arr_file['event_id'].','.
						'"'.mysqli_real_escape_string($obj_db, $arr_file['extension']).'",' .
						'"'.mysqli_real_escape_string($obj_db, $arr_file['type']).'",'.
						'"'.date('Y-m-d H:i:s').'",'.
						$current_user_id.')';
            $obj_result = mysqli_query($obj_db, $str_query);

			if($obj_result !== false) {
				return true;
			} else {
				// probably duplicate entry
                return false;
			}
	
		} else {
			header('location:'.FULLCAL_URL);exit;
		}
    }
    
    public static function getEventFile($int_event_id, $new_filename) {
        global $obj_db;
        
        $str_query1 = 'SELECT * FROM event_files WHERE `event_id` = ' . $int_event_id . ' AND `filename` = "' . $new_filename . '"';


        $res1 = mysqli_query($obj_db, $str_query1);

        if($res1 !== false) {
            $arr_file = mysqli_fetch_array($res1, MYSQLI_ASSOC);
            
            return $arr_file;
        }
    }
    
    public static function getCntFiles($int_event_id=-1) {
         global $obj_db;
         
        if($int_event_id > 0) {
            $str_query = 'SELECT count( `event_file_id` ) as cnt_files'.
                            ' FROM `event_files`'.
                            ' WHERE `event_id` ='. $int_event_id;

            $res1 = mysqli_query($obj_db, $str_query);

            if($res1 !== false) {
                $arr_file = mysqli_fetch_assoc($res1);
           
                return $arr_file['cnt_files'];
            }
        }
        
    }
}
?>