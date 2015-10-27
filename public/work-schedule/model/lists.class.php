<?php

class Lists {

	private $cal_id;

	function __construct ($cal_id) {
		$this->cal_id = $cal_id;
	}

    public static function getList($frm_submitted) {
		global $obj_db;

        $arr_list = array();
        $calendar_id = $frm_submitted['cid'];
        $user_id = $frm_submitted['uid'];
        
        $arr_user 		= User::getUser();
            
        $default_period = Settings::getSetting('hourcalculation_default_period', $arr_user['user_id']);
        $workday_hours = Settings::getSetting('hourcalculation_workday_hours', $arr_user['user_id']);
                   
        
        if(!is_numeric($default_period) || $default_period < 0 || $default_period > 100) {
            $default_period = 6;
        }
         if($workday_hours < 0 || $workday_hours > 24) {
            $workday_hours = 8;
        }
        
		
        $period_startdate = date('Y-m-d', strtotime('-'.$default_period.' MONTHS'));
        $period_enddate = date('Y-m-d');
            
        if(!empty($frm_submitted['st'])) {
            $arr_startdate = explode('/', $frm_submitted['st']);
            $arr_enddate = explode('/', $frm_submitted['end']);

            if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
                $period_startdate = $arr_startdate[2].'-'.$arr_startdate[0].'-'.$arr_startdate[1];
                $period_enddate = $arr_enddate[2].'-'.$arr_enddate[0].'-'.$arr_enddate[1];
            } else {
                $period_startdate = $arr_startdate[2].'-'.$arr_startdate[1].'-'.$arr_startdate[0];
                $period_enddate = $arr_enddate[2].'-'.$arr_enddate[1].'-'.$arr_enddate[0];
            }
        }       
       
		$total_day_count = 0;
		$total_hour_count = 0;
			
		// find how many days
		
		$str_query = 'SELECT * FROM events e LEFT JOIN `calendars` c ON(c.calendar_id = e.calendar_id) ';
		
		$str_query .= ' WHERE user_id = ' . $user_id.
						' AND date_start >= "' . $period_startdate . '" AND date_end <= "' . $period_enddate . '"';
						
		
		if($calendar_id == 'all') {
                    
        } else if($calendar_id > 0) {
			$str_query .= ' AND e.`calendar_id` = '.$calendar_id;
		}
	
		$obj_result = mysqli_query($obj_db, $str_query);

		if($obj_result !== false) {
			while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
				$cnt_days = 0;
				$cnt_hours = 0;
		
				if($arr_line['date_start'] == $arr_line['date_end']) {
					// oneday event
					if($arr_line['allDay']) {
						$cnt_hours += $workday_hours;
					} else {
					
						$cnt_hours += (strtotime($arr_line['date_end'].' '.$arr_line['time_end']) - strtotime($arr_line['date_start'].' '.$arr_line['time_start'])) / 3600;
					}
					$cnt_days ++;
				
				} else {
					// moredays event
					$days_in_between = Utils::getDaysBetween($arr_line['date_start'], $arr_line['date_end']);
			
					foreach($days_in_between as $event_date) {
						if($arr_line['allDay']) {
							$cnt_hours += $workday_hours;
						} else {
							// ignore the nights
							$cnt_hours += (strtotime($event_date.' '.$arr_line['time_end']) - strtotime($event_date.' '.$arr_line['time_start'])) / 3600;
						
							// else 
							//$cnt_hours += (strtotime($arr_line['date_end'].' '.$arr_line['time_end']) - strtotime($arr_line['date_start'].' '.$arr_line['time_start'])) / 3600;
						}
						
						$cnt_days ++;
					}
				}
				
				$total_day_count += $cnt_days;
				$total_hour_count += $cnt_hours;
				
				$arr_line['days'] = $cnt_days;
				$arr_line['hours'] = round($cnt_hours,2);
			
				$arr_list[] = $arr_line;
				
			}
		}

        $arr_startdate_tmp = explode('-', $period_startdate);
        $arr_enddate_tmp = explode('-', $period_enddate);

        if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
            $arr_startdate_in_correct_format = $arr_startdate_tmp[1].'/'.$arr_startdate_tmp[2].'/'.$arr_startdate_tmp[0];
            $arr_enddate_in_correct_format = $arr_enddate_tmp[1].'/'.$arr_enddate_tmp[2].'/'.$arr_enddate_tmp[0];
        } else {
            $arr_startdate_in_correct_format = $arr_startdate_tmp[2].'/'.$arr_startdate_tmp[1].'/'.$arr_startdate_tmp[0];
            $arr_enddate_in_correct_format = $arr_enddate_tmp[2].'/'.$arr_enddate_tmp[1].'/'.$arr_enddate_tmp[0];
        }
            
        return array('list' => $arr_list, 
                    'total_day_count' => $total_day_count, 
                    'total_hour_count' => $total_hour_count,
                    'startdate' => $arr_startdate_in_correct_format,
                    'enddate' => $arr_enddate_in_correct_format);
    }

	public static function getLists($frm_submitted) {
		global $obj_db;

        $default_period = -1;
        $workday_hours = -1;
        
        $calendar_id = $frm_submitted['cid'];
        
		if(User::isLoggedIn()) {
    	   	$arr_user 		= User::getUser();
            
            $default_period = Settings::getSetting('hourcalculation_default_period', $arr_user['user_id']);
            $workday_hours = Settings::getSetting('hourcalculation_workday_hours', $arr_user['user_id']);
        
            if(!is_numeric($default_period) || $default_period < 0 || $default_period > 100) {
                $default_period = 6;
            }
            if($workday_hours < 0 || $workday_hours > 24) {
                $workday_hours = 8;
            }
    	}
    	  
		$arr_users = array();
		$arr_list = array();
	   
        if($workday_hours < 0) {
            if(!defined('HOURCALCULATION_WORKDAY_HOURS') || HOURCALCULATION_WORKDAY_HOURS < 0 || HOURCALCULATION_WORKDAY_HOURS > 24) {
                define('HOURCALCULATION_WORKDAY_HOURS', 8);
            }
            $workday_hours = HOURCALCULATION_WORKDAY_HOURS;
            if($workday_hours < 0 || $workday_hours > 24) {
                $workday_hours = 8;
            }
        }
        if($default_period < 0) {
            if(!defined('HOURCALCULATION_DEFAULT_PERIOD')) {
                define('HOURCALCULATION_DEFAULT_PERIOD', 6);
            }   
            $default_period = HOURCALCULATION_DEFAULT_PERIOD;
            if(!is_numeric($default_period) || $default_period < 0 || $default_period > 100) {
                $default_period = 6;
            }
        }
        
        
        $period_startdate = date('Y-m-d', strtotime('-'.$default_period.' MONTHS'));
        $period_enddate = date('Y-m-d');
            
        if(!empty($frm_submitted['st'])) {
            $arr_startdate = explode('/', $frm_submitted['st']);
            $arr_enddate = explode('/', $frm_submitted['end']);

            if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
                $period_startdate = $arr_startdate[2].'-'.$arr_startdate[0].'-'.$arr_startdate[1];
                $period_enddate = $arr_enddate[2].'-'.$arr_enddate[0].'-'.$arr_enddate[1];
            } else {
                $period_startdate = $arr_startdate[2].'-'.$arr_startdate[1].'-'.$arr_startdate[0];
                $period_enddate = $arr_enddate[2].'-'.$arr_enddate[1].'-'.$arr_enddate[0];
            }
        }   
        
		$str_query = '';
       
        
        if(User::isSuperAdmin()) {
            $str_query = 'SELECT user_id, active, concat_ws(" ",firstname,infix,lastname) as fullname FROM users WHERE `usertype` = "user" ';

        } else if(User::isAdmin()) {
            $str_query = 'SELECT user_id, active, concat_ws(" ",firstname,infix,lastname) as fullname FROM users WHERE `usertype` = "user" AND `admin_group` = '.$arr_user['user_id'];

        }
		
        if(!empty($str_query)) {
            $obj_result = mysqli_query($obj_db, $str_query);

            if($obj_result !== false) {
                while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {
                    $arr_users[] = $arr_line;
                }
            }

            foreach($arr_users as &$user) {
                $cnt_days = 0;
                $cnt_hours = 0;

                // find how many days
                $str_query = 'SELECT * FROM events WHERE user_id = ' . $user['user_id'].
                                ' AND date_start >= "' . $period_startdate . '" AND date_end <= "' . $period_enddate . '"';

                if($calendar_id == 'all') {
                    
                } else if($calendar_id > 0) {
                    $str_query .= ' AND `calendar_id` = '.$calendar_id;
                }

                $obj_result = mysqli_query($obj_db, $str_query);

                if($obj_result->num_rows > 0) {
                    if($obj_result !== false) {
                        while ($arr_line = mysqli_fetch_array($obj_result, MYSQLI_ASSOC)) {

                            if($arr_line['date_start'] == $arr_line['date_end']) {
                                // oneday event
                                if($arr_line['allDay']) {
                                    $cnt_hours += $workday_hours;
                                } else {

                                    $cnt_hours += (strtotime($arr_line['date_end'].' '.$arr_line['time_end']) - strtotime($arr_line['date_start'].' '.$arr_line['time_start'])) / 3600;
                                }
                                $cnt_days ++;

                            } else {
                                // moredays event
                                $days_in_between = Utils::getDaysBetween($arr_line['date_start'], $arr_line['date_end']);

                                foreach($days_in_between as $event_date) {
                                    if($arr_line['allDay']) {
                                        $cnt_hours += $workday_hours;
                                    } else {
                                        // ignore the nights
                                        $cnt_hours += (strtotime($event_date.' '.$arr_line['time_end']) - strtotime($event_date.' '.$arr_line['time_start'])) / 3600;

                                        // else 
                                        //$cnt_hours += (strtotime($arr_line['date_end'].' '.$arr_line['time_end']) - strtotime($arr_line['date_start'].' '.$arr_line['time_start'])) / 3600;
                                    }

                                    $cnt_days ++;
                                }
                            }


                        }

                        $user['days'] = $cnt_days;
                        $user['hours'] = round($cnt_hours,2);

                    }
                    //return $arr_users;
                } 
            }
        }
		
        $arr_startdate_tmp = explode('-', $period_startdate);
        $arr_enddate_tmp = explode('-', $period_enddate);

        if(substr(DATEPICKER_DATEFORMAT,0,2) == 'mm') {
            $arr_startdate_in_correct_format = $arr_startdate_tmp[1].'/'.$arr_startdate_tmp[2].'/'.$arr_startdate_tmp[0];
            $arr_enddate_in_correct_format = $arr_enddate_tmp[1].'/'.$arr_enddate_tmp[2].'/'.$arr_enddate_tmp[0];
        } else {
            $arr_startdate_in_correct_format = $arr_startdate_tmp[2].'/'.$arr_startdate_tmp[1].'/'.$arr_startdate_tmp[0];
            $arr_enddate_in_correct_format = $arr_enddate_tmp[2].'/'.$arr_enddate_tmp[1].'/'.$arr_enddate_tmp[0];
        }
            
        return array('users' => $arr_users, 
                    'startdate' => $arr_startdate_in_correct_format,
                    'enddate' => $arr_enddate_in_correct_format);
		//return array();

	  	
    }

	
	
    
}
?>