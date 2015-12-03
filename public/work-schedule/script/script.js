
	//var Calendar = {};
	MyCalendar.defaultEventColor = '#3366CC';

	$('#info_txt').html('');

	Date.prototype.getDayFull = function(){
        var days_full = [
                            'Sunday',
                            'Monday',
                            'Tuesday',
                            'Wednesday',
                            'Thursday',
                            'Friday',
                            'Saturday'
                        ];
        return days_full[this.getDay()];
    };
    
   	$(document).ready(function() {
		$.support.touch = 'ontouchend' in document;
        
        var hour_notation = MyCalendar.showAMPM ? 'h:MM TT' : 'HH:MM';
        var now = new Date();
           
		var date_notation = 'mmmm d, yyyy';
		var short_date_notation = 'mm/dd/yyyy';
		if(MyCalendar.datePickerDateFormat.indexOf('mm/dd/') >= 0) {
			date_notation = 'mmmm d, yyyy';
			short_date_notation = 'mm/dd/yyyy';
		} else if(MyCalendar.datePickerDateFormat.indexOf('dd/mm/') >= 0) {
			date_notation = 'd mmmm yyyy';
			short_date_notation = 'dd/mm/yyyy';
		}

		var showMessage = function(message, type) {
			if(type === undefined) {
                type = 'warning';
            }
            	//$('#cal_message').css('background-color', 'red');
            $('#cal_message').removeClass('warning');
            $('#cal_message').removeClass('error');
            $('#cal_message').removeClass('success');
            $('#cal_message').addClass(type);
            $('#cal_message').html('<span style="font-weight:bold;text-transform:uppercase;">'+type+': </span>'+message);
            $('#cal_message').show();
			
			setTimeout(function() {
				$('#cal_message').html('');
				$('#cal_message').hide();
			},3000);
		};

		if(MyCalendar.currentEventColor === '') {
			MyCalendar.currentEventColor = MyCalendar.defaultEventColor;
		}
		if(MyCalendar.currentCalendars === undefined || MyCalendar.currentCalendars == '') {
			MyCalendar.currentCalendars = MyCalendar.currentCalendar;
		}

		var hideDDArea = function() {
			$('#dragdrop_events').hide();
			$('#booking').hide();
			$('#dateplanner').hide();
		}
		hideDDArea();

		if((MyCalendar.admin_has_full_control && (MyCalendar.isAdmin || MyCalendar.isSuperAdmin)) || (MyCalendar.isOwner) || MyCalendar.calCanDragDDItems) {
			//$('#dragdrop_events .external-event').css('background-color',MyCalendar.currentCalendarColor);
			//$('#dragdrop_events .external-event').attr('color',MyCalendar.currentCalendarColor);
			$('#dragdrop_events').show();
			$('#ext_item_'+ MyCalendar.currentCalendar).show();
		}

		var applyToObject = function(event, result) {
			event.start 		= result.start;
			event.end 			= result.end;
			event._start 		= result.start;
			event._end 			= result.end;
			event._id 			= result.id;
			event.time_start  	= result.time_start;
			event.time_end  	= result.time_end;
			event.color		  	= result.color;
       		event.allDay		= result.allDay;

       		return event;
		};

		if(MyCalendar.editdialogTimepickerType == 'simple') {
			$('#timepicker_starttime').timepicker({
				zindex:9999,
				interval: MyCalendar.timePickerMinuteInterval,
				timeFormat: MyCalendar.showAMPM ? 'hh:mm p' : 'HH:mm'
			});
			$('#timepicker_endtime').timepicker({
				zindex:9999,
				interval: MyCalendar.timePickerMinuteInterval,
				timeFormat: MyCalendar.showAMPM ? 'hh:mm p' : 'HH:mm'
			});
		} else {
			$('#timepicker_starttime').timepicker({
				showPeriodLabels: MyCalendar.showAMPM,
				showPeriod: MyCalendar.showAMPM,
    			showLeadingZero: true,
				hourText: Lang.Popup.TimepickerHourtext,
	    		minuteText: Lang.Popup.TimepickerMinutetext,
	    		showCloseButton: true,       						// shows an OK button to confirm the edit
			    closeButtonText: Lang.Popup.TimepickercloseButtonText,      // Text for the confirmation button (ok button)
			    showNowButton: true,         						// Shows the 'now' button
			    nowButtonText: Lang.Popup.TimepickernowButtonText,
	    		hours: {
			        starts: MyCalendar.timePickerMinHour,                		// First displayed hour
			        ends: MyCalendar.timePickerMaxHour                  		// Last displayed hour
			    },
			    minutes: {
			        starts: 0,                					// First displayed minute
			        ends: 55,                 					// Last displayed minute
			        interval: MyCalendar.timePickerMinuteInterval               // Interval of displayed minutes
			    }
			});
			$('#timepicker_endtime').timepicker({
				showPeriodLabels: MyCalendar.showAMPM,
				showPeriod: MyCalendar.showAMPM,
    			showLeadingZero: true,
				hourText: Lang.Popup.TimepickerHourtext,
	    		minuteText: Lang.Popup.TimepickerMinutetext,
	    		showCloseButton: true,       						// shows an OK button to confirm the edit
			    closeButtonText: Lang.Popup.TimepickercloseButtonText,      // Text for the confirmation button (ok button)
			    showNowButton: true,         						// Shows the 'now' button
			    nowButtonText: Lang.Popup.TimepickernowButtonText,
	    		hours: {
			        starts: MyCalendar.timePickerMinHour,                		// First displayed hour
			        ends: MyCalendar.timePickerMaxHour                  		// Last displayed hour
			    },
			    minutes: {
			        starts: 0,                					// First displayed minute
			        ends: 55,                 					// Last displayed minute
			        interval: MyCalendar.timePickerMinuteInterval               // Interval of displayed minutes
			    }
			});
		}

		$( "#datepicker_startdate" ).datepicker({
			dateFormat: MyCalendar.datePickerDateFormat || 'dd/mm/yy',
			onSelect: function(dateText, inst) {
				var dp_enddate 	= $( "#datepicker_enddate" ).datepicker('getDate');

				if(MyCalendar.datePickerDateFormat === null || MyCalendar.datePickerDateFormat == 'dd/mm/yy') {
					var arr_startdate = dateText.split('/');
					var dp_startdate = new Date(arr_startdate[1] + '/' + arr_startdate[0] + '/' + arr_startdate[2]);
				} else if(MyCalendar.datePickerDateFormat == 'mm/dd/yy') {
					var dp_startdate = new Date(dateText);
				}

				if(dp_startdate.getTime() > dp_enddate.getTime()) {
					$('#error_message').html(Lang.Alert.DatesNotCorrect);
					$( "#datepicker_enddate" ).datepicker('setDate', dp_startdate);
					//return true;
				}

				if(((dp_enddate.getTime() - dp_startdate.getTime()) / 3600 / 1000 / 24) > 7) {
                    
                    $('#interval_container').show();
                    //var n = dp_startdate.getDay();console.log('day'.n);

                    // if monthly recurring
                    if($('#interval_div').val() == 'M') {
                        if ($('#monthly_dom').is(':checked')) {
                            $('#info_txt').html(Lang.Popup.MonthlyOnDay + ' ' + $( "#datepicker_startdate" ).datepicker('getDate').getDate());
                        } else {
                            var arr_date = MyCalendar.datePickerDateFormat.split('/');

                            $('#info_txt').html(Lang.Popup.MonthlyOn + ' ' + Lang.Fullcalendar.dayNames[$( "#datepicker_startdate" ).datepicker('getDate').getDay()] + ', ' + Lang.Popup.Starting + ' ' + (arr_date[0] == 'dd' ? $( "#datepicker_startdate" ).datepicker('getDate').format('dd/mm') : $( "#datepicker_startdate" ).datepicker('getDate').format('mm/dd')) );
                        }
                    }
					
				} else {
					$('#interval_container').hide();
					$('#interval_day_div').hide();
					$('#interval_month_choice_div').hide();
                    $('#interval_year_choice_div').hide();
					$('#info_txt').html('');
				}

				return true;
			}
		});

		$( "#datepicker_enddate" ).datepicker({
			dateFormat: MyCalendar.datePickerDateFormat || 'dd/mm/yy',
			onSelect: function(dateText, inst) {
				var dp_startdate 	= $( "#datepicker_startdate" ).datepicker('getDate');

				if(MyCalendar.datePickerDateFormat === null || MyCalendar.datePickerDateFormat == 'dd/mm/yy') {
					var arr_enddate = dateText.split('/');
					var dp_enddate = new Date(arr_enddate[1] + '/' + arr_enddate[0] + '/' + arr_enddate[2]);
				} else if(MyCalendar.datePickerDateFormat == 'mm/dd/yy') {
					var dp_enddate = new Date(dateText);
				}

				if(dp_startdate.getTime() > dp_enddate.getTime()) {
					$('#error_message').html(Lang.Alert.DatesNotCorrect);
					$( "#datepicker_enddate" ).datepicker('setDate', dp_startdate);
					return false;
				}
				if(dp_startdate.getTime() == dp_enddate.getTime()) {
					$('#info_txt').html('');
				}
				if(((dp_enddate.getTime() - dp_startdate.getTime()) / 3600 / 1000 / 24) > 7) {
					$('#interval_container').show();
        
                    if($('#interval_div').val() === 'Y') {
                        var ts_endyear_recurring_date = Date.parse($( "#yearly_month" ).val() + '/' + $( "#yearly_dom" ).val() + '/' + $( "#datepicker_enddate" ).datepicker('getDate').getFullYear() );  
                        
                        var until = '';

                        if(ts_endyear_recurring_date <= dp_enddate.getTime()) {
                            until = $( "#datepicker_enddate" ).datepicker('getDate').getFullYear();
                        } else {
                            until = $( "#datepicker_enddate" ).datepicker('getDate').getFullYear() -1;
                        }
                        
                        var yearly_month = Lang.Fullcalendar.monthNames[$( "#yearly_month" ).val()];
                        
                        $('#info_txt').html(Lang.Popup.YearlyOn + ' ' + $( "#yearly_dom" ).val() + ' ' + yearly_month + ' ' + Lang.Popup.Until + ' ' + until);
                    }
				} else {
					$('#interval_container').hide();
					$('#interval_day_div').hide();
					$('#interval_month_choice_div').hide();
                    $('#interval_year_choice_div').hide();
					$('#info_txt').html('');
				}
				return true;
			}
		});

		$('#ColorPicker1').empty().addColorPicker({
			clickCallback: function(elem,c) {
				$('#ColorSelectionTarget1').css('background-color',c);
				//MyCalendar.defaultEventColor = elem.attr('color');
				MyCalendar.currentEventColor = elem.attr('color');
			}
		});
		$('#ColorSelectionTarget1').css('background-color',MyCalendar.defaultEventColor);

		$('#searchbox_cal_id').val(MyCalendar.currentCalendars);

		doAjaxGetCal = function(cal_id, bln_set_tick) {
			$.ajax({
				type: "POST",
				url: MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=get_cal",
				data: "cal_id=" + cal_id,
				dataType: 'json',
				success:function(result){
					$('.ext_item').hide();
					//$('#booking').hide();
					//$('#dateplanner').hide();
					hideDDArea();

          			MyCalendar.currentCalendarColor = result.calendar_color;

					if($('#calendar').fullCalendar('getView').name != 'agendaList') {

                        //var adminCanSeeDDItems = (MyCalendar.onlyAdminCanSeeDDItems || MyCalendar.admin_has_full_control)  && (MyCalendar.isAdmin || MyCalendar.isSuperAdmin);
                        //var ownerCanSeeDDItems = result.isOwner;    
                       
						if(result.can_drag_dd_items) {
							//$('#dragdrop_events .external-event').css('background-color',MyCalendar.currentCalendarColor);
							//$('#dragdrop_events .external-event').attr('color',MyCalendar.currentCalendarColor);

							$('#dragdrop_events').show();
							$('#ext_item_'+result.calendar_id).show();
						}
					}
					
					if(bln_set_tick) {
						$('#calgroup' + cal_id).addClass('tick_on');
					}

					MyCalendar.currentCalendar = cal_id;

					MyCalendar.currentCalendarType			= result.calendar_type;

					MyCalendar.calCanEdit = result.can_edit;
					MyCalendar.calCanAdd = result.can_add;
          			MyCalendar.calCanDragDDItems = result.can_drag_dd_items;
                    MyCalendar.calCanChangeColor = result.can_change_color;
                    MyCalendar.calCanMail = result.can_mail;
                    
                    if(result.alterable_startdate !== null && result.alterable_startdate !== '') {
                        MyCalendar.calAlterableStartdate = result.alterable_startdate;
                        MyCalendar.calAlterableEnddate = result.alterable_enddate;
                    } else {
                        MyCalendar.calAlterableStartdate = '';
                        MyCalendar.calAlterableEnddate = '';
                    }
                    
                    if(MyCalendar.maskUnalterableDays) {
                        $('#calendar').fullCalendar('render');
                    }
				}
	        });
		};

		MyCalendar.openCalendar = function(cal_id, cal_name, feedtype, feedurl) {
			
            if(MyCalendar.currentCalendars.indexOf(',') != -1) {
                // there were several calendars with initial_show
                $('#calendar').fullCalendar('removeEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id="+MyCalendar.currentCalendars);

                $('.tick_on').each(function(index, item) {
                    $('#calendar').fullCalendar('removeEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + $(item).attr('cal_id'));
                    $('#calgroup' + $(item).attr('cal_id')).removeClass('tick_on').addClass('tick_off');
                });
            }    
            
            // check all calendars if you chose 'all'
            if(cal_id == 'all') {
                $('.tick_off').each(function(index, item) {
                    $('#calendar').fullCalendar('addEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + $(item).attr('cal_id') );

                    $('#calgroup' + $(item).attr('cal_id')).removeClass('tick_off').addClass('tick_on');
                });

                MyCalendar.currentCalendars = 'all';
                MyCalendar.calCanAdd =  false;
                hideDDArea();
            } else {
                $('#calendar').fullCalendar('removeEvents');

                // uncheck all calendars that are currently checked, except when you chose 'all'
                $('.tick_on').each(function(index, item) {

                    $('#calendar').fullCalendar('removeEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + $(item).attr('cal_id'));

                    //if(cal_id !== 'all') {
                        $('#calgroup' + $(item).attr('cal_id')).removeClass('tick_on').addClass('tick_off');
                    //}
                });

                $('#calgroup' + cal_id).removeClass('tick_off').addClass('tick_on');

                $('#calendar').fullCalendar('addEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + cal_id );

                MyCalendar.currentCalendars = cal_id;
                MyCalendar.currentCalendar = cal_id;
                
                doAjaxGetCal(cal_id, true);
                
                setTimeout(function() {},100);
            }
            $('#searchbox_cal_id').val(MyCalendar.currentCalendars);
		};

		MyCalendar.addCalendar = function(cal_id, cal_name, feedtype, feedurl) {
			// if we are in agendaview disable addcalendar, otherwise the rendering will be wrong if we switch back to monthview
			if($('.fc-header-title h2').html() != 'Agenda') {

				MyCalendar.currentCalendars = MyCalendar.currentCalendars.toString();
				//var duplicates = '';

				if($('#calgroup' + cal_id).hasClass('tick_off')) {

                    if(MyCalendar.currentCalendar == 'all') {
						MyCalendar.currentCalendars = '';
					}

					// only add cal_id if not already in the cal_id string
					if(MyCalendar.currentCalendars.indexOf(cal_id) == -1) {
						if(MyCalendar.currentCalendars == '') {
							MyCalendar.currentCalendars = cal_id;
						} else {
							MyCalendar.currentCalendars = MyCalendar.currentCalendars + ','+cal_id;
						}
					}
                    if(MyCalendar.maskUnalterableDays) {
                        $('#calendar').fullCalendar('render');
                    }
                
					// add to current view
					if(feedtype == 'google') {
						$('#calendar').fullCalendar('addEventSource', {url: feedurl,color: '#9A9CFF', textColor: 'white'} ); // 1d1d1d

					} else {
						$('#calendar').fullCalendar('addEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + cal_id );
					}


					//$('#calendar').fullCalendar('addEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + cal_id );
					$('#calgroup' + cal_id).removeClass('tick_off').addClass('tick_on');

					

				} else {
					//$('#calendar').fullCalendar('removeEvents');
					$('#calendar').fullCalendar('removeEventSource', {url: feedurl,color: '#9A9CFF', textColor: 'white'} );

					// remove from current view
					$('#calendar').fullCalendar('removeEventSource', MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + cal_id );
					$('#calgroup' + cal_id).removeClass('tick_on').addClass('tick_off');

					if(MyCalendar.currentCalendars == 'all') {
						// alle cal_ids opzoeken en achter elkaar plakken, behalve huidige aangeklikte cal_id
						//MyCalendar.currentCalendars = MyCalendar.activeCalendarsString;
						MyCalendar.currentCalendars = '';
						$('.colorchooser').each(function(index, item) {
							if(MyCalendar.currentCalendars == '') {
								MyCalendar.currentCalendars = MyCalendar.currentCalendars + $(item).attr('cal_id');
							} else {
								MyCalendar.currentCalendars = MyCalendar.currentCalendars + ','+$(item).attr('cal_id');
							}
						});
					}

					//remove cal_id
					MyCalendar.currentCalendars = ','+MyCalendar.currentCalendars;
					MyCalendar.currentCalendars = MyCalendar.currentCalendars.replace(','+cal_id, '');

					// get rid of extra commas
					if(MyCalendar.currentCalendars.substring(0,1) == ',') {
						MyCalendar.currentCalendars = MyCalendar.currentCalendars.substring(1);
					}
					if(MyCalendar.currentCalendars == ',') {
						MyCalendar.currentCalendars = '';
					}


					// check how many calendars are selected now, if 1 is selected then open div with drag&drop items
					if($('.tick_on').length == 1) {
						doAjaxGetCal($('.tick_on').attr('cal_id'), false);
					} 
				}
				$('#searchbox_cal_id').val(MyCalendar.currentCalendars);

			}
			hideDDArea();
		};

		if(MyCalendar.currentCalendars == 'all') {
			setTimeout(function() {
				MyCalendar.openCalendar('all');
			},100);

		} else if(MyCalendar.currentCalendars.indexOf(',') != -1) {
			hideDDArea();
		} else {
			MyCalendar.openCalendar(MyCalendar.currentCalendars);
		}

		

		var calAlert = function() {
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
			$( "#dialog-message" ).dialog({
				modal: true,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		};
		var disableTimeCombos = function() {
			//$('#timepicker_starttime').attr('disabled', 'disabled');
			//$('#timepicker_endtime').attr('disabled', 'disabled');
			$('#timepicker_starttime').hide();
			$('#timepicker_endtime').hide();

		};
		var enableTimeCombos = function() {
			$('#timepicker_starttime').removeAttr('disabled');
			$('#timepicker_endtime').removeAttr('disabled');
			$('#timepicker_starttime').show();
			$('#timepicker_endtime').show();
		};

        var mailEvent = function(me) {
			if(MyCalendar.loggedInUser > 0 && MyCalendar.loggedInUser !== '1000000') {
                var title = $('#edited_title').val();

                if($('#edited_location') !== undefined) {
                    var location = $('#edited_location').val();
                }
                if($('#edited_description') !== undefined) {
                    var description = $('#edited_description').val();
                }
                if($('#edited_phone') !== undefined) {
                    var phone = $('#edited_phone').val();
                }
                if($('#edited_myurl') !== undefined) {
                    var myurl = $('#edited_myurl').val();
                }
                
                var start 	= $( "#datepicker_startdate" ).datepicker('getDate');
                var end 		= $( "#datepicker_enddate" ).datepicker('getDate');

                var str_date_start = start.format('yyyy-mm-dd')+ ' ' + $('#timepicker_starttime')[0].value +':00';
                var str_date_end = end.format('yyyy-mm-dd')+ ' ' + $('#timepicker_endtime')[0].value +':00';

                var data = {
                    title: title,
                    location: location,
                    description: description,
                    phone: phone,
                    myurl: myurl,
                    str_date_start: str_date_start,
                    str_date_end: str_date_end,

                };
                if(MyCalendar.currentCalendar > 0) {
                    data.cal_id = MyCalendar.currentCalendar;
                }
                $.ajax({
                    type:"POST",
                    url: MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=mail_event",
                    data: data,
                    dataType: 'json',
                    success:function(result){
                        if(result.success) {
                            showMessage(result.msg, 'success');
                            $('#error_message').html(Lang.Alert.DoNotForgetToSave);
                        } else {
                            $('#error_message').html(Lang.Alert.Error + ': ' + result.error);
                        }
                    }
                });
            } else {
                showMessage('Log in to send the mail', 'warning');
            }
            
            
                    
        };
        
		var addEvent = function(start, end, me) {
		
		    
			var title = $('#edited_title').val();

			if($('#edited_location') !== undefined) {
				var location = $('#edited_location').val();
			}
			if($('#edited_description') !== undefined) {
				var description = $('#edited_description').val();
			}
			if($('#edited_phone') !== undefined) {
				var phone = $('#edited_phone').val();
			}
            if($('#edited_myurl') !== undefined) {
				var myurl = $('#edited_myurl').val();
			}
            
			var color = MyCalendar.currentCalendarColor !== undefined ? MyCalendar.currentCalendarColor : MyCalendar.eventColor;
			if(MyCalendar.calCanChangeColor) {
				if(MyCalendar.editdialogColorpickerType == 'spectrum') {
					color = $("#togglePaletteOnly").val();
				} else {
					color = MyCalendar.currentEventColor;
				}
			}

			if (title) {
				var interval = $('#interval_div').val();
				//var interval_day = $('#interval_day_div').val();

                var weekdays = '';
                var monthday = '';
                var yearmonthday = '';
                var yearmonth = '';

                if(interval == 'W') {
                    // put the checked weekdays in a string to send to php
                    $('#interval_day_div input:checkbox').each(function(index, item) {
                        if($(item).is(':checked')) {
                            weekdays +=  ',' + $(item).val() ;
                        }
                    });
                } else if(interval == 'M') {
                    $('#interval_month_choice_div input:radio["name=monthday"]').each(function(index, item) {
                        if($(item).is(':checked')) {
                            monthday =  $(item).val() ;
                        }
                    });
                } else if(interval == 'Y') {
                    yearmonthday = $('#yearly_dom').val();
                    yearmonth = $('#yearly_month').val();
                }
				
				// is a date selected in the datepickers, then use those dates
				var dp_startdate 	= $( "#datepicker_startdate" ).datepicker('getDate');
				var dp_enddate 		= $( "#datepicker_enddate" ).datepicker('getDate');

				if(dp_startdate !== null && dp_enddate !== null) {
					start = dp_startdate;
					end = dp_enddate;
				}

				/*

				var startTime = start.getTime();
			    var localOffset = (-1) * start.getTimezoneOffset() * 60000;
			    start = new Date(startTime + localOffset);

			    var endTime = end.getTime();
			    var localOffset = (-1) * end.getTimezoneOffset() * 60000;
			    end = new Date(endTime + localOffset);
*/
				if($('#allday_checkbox').is(':checked')) {
					var startdate 	= Date.parse(start) / 1000;
					var enddate 	= Date.parse(end) / 1000;
					var allDay = 1;

				} else {
					var startdate 	= Date.parse(start.format('mm/dd/yyyy')+ ' ' + $('#timepicker_starttime')[0].value + ':00') / 1000;
				    var enddate 	= Date.parse(end.format('mm/dd/yyyy')+ ' ' + $('#timepicker_endtime')[0].value + ':00') / 1000;
					var allDay = 0;
				}

                if(MyCalendar.showAMPM) {
                    var str_date_start_tmp = start.format(short_date_notation) + ' ' + $('#timepicker_starttime')[0].value;
                    var str_date_start = new Date(str_date_start_tmp).format('yyyy-mm-dd HH:MM:00');
                    var str_date_end_tmp = end.format(short_date_notation)+ ' ' + $('#timepicker_endtime')[0].value;
                    var str_date_end = new Date(str_date_end_tmp).format('yyyy-mm-dd HH:MM:00');
                } else {
                    var str_date_start = start.format('yyyy-mm-dd')+ ' ' + $('#timepicker_starttime')[0].value +':00';
                    var str_date_end = end.format('yyyy-mm-dd')+ ' ' + $('#timepicker_endtime')[0].value +':00';
                }
                
				var offsetClientToGMT = new Date().getTimezoneOffset() * 60;
		        startdate = startdate - offsetClientToGMT;
		        enddate = enddate - offsetClientToGMT;

				if(startdate <= enddate  ) {
				    // opslaan in db
					var data = {
		            	interval: interval,
		            	title: title,
		            	location: location,
		            	description: description,
						phone: phone,
		            	myurl: myurl,
		            	allDay: allDay,
		            	date_start: startdate,
						date_end: enddate,
						str_date_start: str_date_start,
						str_date_end: str_date_end,
						time_start: $('#timepicker_starttime')[0].value + ':00',
						time_end: $('#timepicker_endtime')[0].value + ':00',
						color: color,
						weekdays: weekdays,
						monthday: monthday,
                        yearmonthday: yearmonthday,
                        yearmonth: yearmonth
		            };
		            if(MyCalendar.currentCalendar > 0) {
		            	data.cal_id = MyCalendar.currentCalendar;
		            }
		            $.ajax({
						type:"POST",
						url: MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=add",
						data: data,
						dataType: 'json',
						success:function(result){
							if(result.success) {
								me.dialog( "close" );
								if(result.event === undefined || result.event === null || (result.event.repeating_event_id !== null && result.event.repeating_event_id > 0)) {
									$('#calendar').fullCalendar('refetchEvents');
								} else {
									$('#calendar').fullCalendar('renderEvent', result.event);
								}

							} else {
								$('#error_message').html(Lang.Alert.Error + ': ' + result.error);
							}
						}
			        });
			    } else {
					$('#error_message').html(Lang.Alert.TimesNotCorrect);
			    }
			}
		};

		var updateEvent = function(event, bln_repair_pattern, me) {

			var title = $('#edited_title')[0].value;

			if($('#edited_location') !== undefined) {
				var location = $('#edited_location').val();
			}
			if($('#edited_description') !== undefined) {
				var description = $('#edited_description').val();
			}
			if($('#edited_phone') !== undefined) {
				var phone = $('#edited_phone').val();
			}
            if($('#edited_myurl') !== undefined) {
				var myurl = $('#edited_myurl').val();
            }
            
			if(title != null && title != '') {
				event.title = title;
				event.location = location;
				event.description = description;
				event.phone = phone;
                event.myurl = myurl;

				var interval = $('#interval_div').val();
				//var interval_day = $('#interval_day_div').val();

                var weekdays = '';
                var monthday = '';
                var yearmonthday = '';
                var yearmonth = '';
                
                if(interval == 'W') {
                    // put the checked weekdays in a string to send to php
                    $('#interval_day_div input:checkbox').each(function(index, item) {
                        if($(item).is(':checked')) {
                            weekdays +=  ',' + $(item).val() ;
                        }
                    });
                } else if(interval == 'M') {
                    $('#interval_month_choice_div input:radio["name=monthday"]').each(function(index, item) {
                        if($(item).is(':checked')) {
                            monthday =  $(item).val() ;
                        }
                    });
                } else if(interval == 'Y') {
                    yearmonthday = $('#yearly_dom').val();
                    yearmonth = $('#yearly_month').val();
                    
                }
				
				

        // is a date selected in the datepickers, then use those dates
				var dp_startdate 	= $( "#datepicker_startdate" ).datepicker('getDate');
				var dp_enddate 		= $( "#datepicker_enddate" ).datepicker('getDate');

				if(dp_startdate !== null && dp_enddate !== null) {
					event.start = dp_startdate;
					event.end = dp_enddate;
				}

				if($('#allday_checkbox').is(':checked')) {
					var startdate = Date.parse(event.start) / 1000;
					var enddate = event.end !== null ? Date.parse(event.end) / 1000 : startdate;
					event.allDay = 1;
				} else {
					var startdate 	= Date.parse(event.start.format('mm/dd/yyyy')+ ' ' + $('#timepicker_starttime')[0].value + ':00') / 1000;
			    	var enddate 	= event.end === null ? Date.parse(event.start.format('mm/dd/yyyy')+ ' ' + $('#timepicker_endtime')[0].value + ':00') / 1000 : Date.parse(event.end.format('mm/dd/yyyy')+ ' ' + $('#timepicker_endtime')[0].value + ':00') / 1000;
					event.allDay = 0;
				}

				var color = MyCalendar.defaultEventColor;
				if(MyCalendar.calCanChangeColor || event.canChangeColor) {  // also check on event.canChangeColor in case admin ahd full control and is logged in
					if(MyCalendar.editdialogColorpickerType == 'spectrum') {
        				color = $("#togglePaletteOnly").val();
					} else {
						color = MyCalendar.currentEventColor !== null ? MyCalendar.currentEventColor : event.color;
					}
                    if(color.substring(0,1) !== '#') {
                        color = event.color;
                    }
				} else {
					color = event.color;
				}

                // if it is possible to change calendar_id
                var calendar_id = -1;
                if($('#edit_dlg_calendar_selectbox') !== undefined) {
                    var calendar_id = $('#edit_dlg_calendar_selectbox').val();
                }
                
		        var offsetClientToGMT = new Date().getTimezoneOffset() * 60;
		        startdate = startdate - offsetClientToGMT;
		        enddate = enddate - offsetClientToGMT;

                var str_date_start;
                var str_date_end;
                var starttime = $('#timepicker_starttime').val();
                var endtime = $('#timepicker_endtime').val();
                
                if(MyCalendar.showAMPM) {
                    var str_date_start_tmp = event.start.format(short_date_notation) + ' ' + starttime;
                    str_date_start = new Date(str_date_start_tmp).format('yyyy-mm-dd HH:MM:00');
                    var str_date_end_tmp = event.end.format(short_date_notation)+ ' ' + endtime;
                    str_date_end = new Date(str_date_end_tmp).format('yyyy-mm-dd HH:MM:00');
                } else {
                    str_date_start = event.start.format('yyyy-mm-dd')+ ' ' + starttime +':00';
                    str_date_end = event.end.format('yyyy-mm-dd')+ ' ' + endtime +':00';
                }
            
				if(startdate <= enddate  ) {
					// opslaan in db
					//var dataString = 'event_id='+ event.event_id + '&allDay=' + event.allDay  + '&title='+ event.title + '&date_start='+startdate+'&date_end='+enddate+ '&color=' + MyCalendar.defaultEventColor;
					var data = {
		            	event_id: event.event_id,
		            	rep_event_id: event.rep_event !== undefined ? event.rep_event.rep_event_id : 0,
		            	repair_pattern: bln_repair_pattern,
		            	allDay: event.allDay,
		            	interval: interval,
		            	title: event.title,
						location: event.location,
		            	description: event.description,
						phone: event.phone,
		            	myurl: event.myurl,
		            	date_start: startdate,
						date_end: enddate,
						str_date_start: str_date_start,
						str_date_end: str_date_end,
						time_start: starttime + ':00',
						time_end: endtime + ':00',
						color: color !== '' ? color : event.color,
						weekdays: weekdays,
						monthday: monthday,
                        yearmonthday: yearmonthday,
                        yearmonth: yearmonth,
						cal_id: event.calendar_id, //MyCalendar.currentCalendar
                        calendar_id: calendar_id
		            };

		            $.ajax({
			             type:"POST",
			             url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=update',
			             data: data,
			             dataType: 'json',
						 success:function(result){
						 	if(result.success) {
								if(event.rep_event !== undefined) {
									// repeating events where updated
									$('#calendar').fullCalendar('refetchEvents');
								} else {
									//if(result.event !== undefined) {
									//	event = applyToObject(event, result.event);
									//	if(result.event.remove_old_event) {
									//		$('#calendar').fullCalendar('refetchEvents');
									//	} else {
									//		$('#calendar').fullCalendar('updateEvent', event);
									//	}
									//} else {
										$('#calendar').fullCalendar('refetchEvents');
									//}
								}
								me.dialog( "close" );

							} else {
								if(result.notloggedin) {
									$('#calendar').fullCalendar('refetchEvents');
									alert('You are not logged in');
									window.location = MyCalendar.FULLCAL_URL ;
			             		} else {
			             			//alert(Lang.Alert.ErrorSaving);
			             			$('#error_message').html(Lang.Alert.Error + ': ' + result.error);
			             		}
							}

			            }
					});
			       // return true;
				} else {
				     $('#error_message').html(Lang.Alert.TimesNotCorrect);
	                    return false;
	             // 	alert(Lang.Alert.TimesNotCorrect);
				}

			}
		};

		// drag an item to another day
		var onEventDropEvent = function(event) {
			var currentView = $('#calendar').fullCalendar('getView').name;
			var startdate 	= Date.parse(event.start) / 1000;

			if(MyCalendar.showAMPM) {
	        	//var str_date_start_tmp = new Date(startdate*1000).format(short_date_notation+' hh:MM TT');
                var str_date_start = new Date(startdate*1000).format('yyyy-mm-dd hh:MM:TT');
                
	        } else {
	        	var str_date_start = new Date(startdate*1000).format('yyyy-mm-dd HH:MM:00');
	        }

            if(event.end === null && (currentView == 'agendaWeek' || currentView == 'agendaDay')) {
		        var enddate = startdate + (2 * 3600);	// 2 hours
		        var str_date_end = new Date(enddate*1000).format('yyyy-mm-dd HH:MM:00');
		   
		    } else if(event.end === null) {
	            var enddate = startdate;
	            var str_date_end = event.start.format('yyyy-mm-dd HH:MM:00');
		      
	        } else {
	            var enddate 	= Date.parse(event.end) / 1000;
	            var str_date_end = event.end.format('yyyy-mm-dd HH:MM:00');
		    }

	      	var offsetClientToGMT = new Date().getTimezoneOffset() * 60;
	      	startdate = startdate - offsetClientToGMT;
	     	enddate = enddate - offsetClientToGMT;

	      	event.allDay = event.allDay ? 1 : 0;
	            // opslaan in db
	     		
          	var data = {
            	event_id: event.id,
            	allDay: event.allDay,
            	date_start: startdate,
				date_end: enddate,
				title: event.title,
				str_date_start: str_date_start,
				str_date_end: str_date_end,
				color: event.color,
                cal_id: event.calendar_id
            };
		            
          	$.ajax({
              	type: "POST",
              	url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=update',
              	data: data,
              	dataType: 'json',
              	success: function(result) {
              		if(result.success) {
						if(result.event !== undefined) {
							event = applyToObject(event, result.event);
		       				$('#calendar').fullCalendar('updateEvent', event);
						} else {
							$('#calendar').fullCalendar('refetchEvents');
						}
					} else {
						if(result.notloggedin) {
							$('#calendar').fullCalendar('refetchEvents');
							alert(Lang.Alert.NotLoggedIn);
							window.location = MyCalendar.FULLCAL_URL ;
	             		} else {
	             			alert(Lang.Alert.ErrorSaving);
	             		}
					}
              	}
			});
		};

        var checkAlterable = function(date) {
            if(MyCalendar.calAlterableStartdate === undefined || MyCalendar.calAlterableEnddate === undefined) {
                return true;
            }   
            
            if(MyCalendar.currentCalendars.indexOf(',') >= 0 || MyCalendar.currentCalendars == 'all') {
                // more than 1 calendar selected
                
                return true;
            } else {
                var arr_startdate = MyCalendar.calAlterableStartdate.split('/');

                if(MyCalendar.datePickerDateFormat === null || MyCalendar.datePickerDateFormat == 'dd/mm/yy') {
                    var dp_startdate = new Date(arr_startdate[2] + '/' + arr_startdate[1] + '/' + arr_startdate[0]);
                } else if(MyCalendar.datePickerDateFormat == 'mm/dd/yy') {
                    var dp_startdate = new Date(arr_startdate[1] + '/' + arr_startdate[2] + '/' + arr_startdate[0]);
                }

                var arr_enddate = MyCalendar.calAlterableEnddate.split('/');

                if(MyCalendar.datePickerDateFormat === null || MyCalendar.datePickerDateFormat == 'dd/mm/yy') {
                    var dp_enddate = new Date(arr_enddate[2] + '/' + arr_enddate[1] + '/' + arr_enddate[0]);
                } else if(MyCalendar.datePickerDateFormat == 'mm/dd/yy') {
                    var dp_enddate = new Date(arr_enddate[1] + '/' + arr_enddate[2] + '/' + arr_enddate[0]);
                }

                if (date < dp_startdate || date > dp_enddate){
                    return false;
                } else {
                    return true;
                }
            }
        };
        
		/**
		*	dayclick
		*/
		var onSelectEvent = function(start, end, allDay) {
            if(!checkAlterable(start)) {
                showMessage(Lang.Alert.NotAllowedToAddOnThisDate, 'error');
                return false;
            }
            
			if(MyCalendar.calCanAdd === undefined || MyCalendar.calCanAdd === false || MyCalendar.currentCalendars.indexOf(',') >= 0) {
				if(MyCalendar.currentCalendars.indexOf(',') == -1 && MyCalendar.currentCalendars !== 'all') {
                    if(MyCalendar.showNotAllowedMessages) {
                        showMessage(Lang.Alert.NotAllowedToAdd, 'error');
                    }
                } else if(MyCalendar.currentCalendars.indexOf(',') >= 0 || MyCalendar.currentCalendars == 'all') {
                    showMessage(Lang.Alert.ChooseCalendarFirst, 'warning');
                    
                }
                
				return false;
			}

			$('#interval_container').hide();
			$('#interval_day_div').hide();
			$('#interval_month_choice_div').hide();
            $('#interval_year_choice_div').hide();
			$('#info_txt').html('');
			$("select[name='interval']").val('D');

			//$('#interval_day_div').show();
			$("#interval_day_div input[name='day_1']").attr('checked', false);
			$("#interval_day_div input[name='day_2']").attr('checked', false);
			$("#interval_day_div input[name='day_3']").attr('checked', false);
			$("#interval_day_div input[name='day_4']").attr('checked', false);
			$("#interval_day_div input[name='day_5']").attr('checked', false);
			$("#interval_day_div input[name='day_6']").attr('checked', false);
			$("#interval_day_div input[name='day_7']").attr('checked', false);

			if(dateFormat(Date.parse(start),'dd/mm/yy') == dateFormat(Date.parse(end),'dd/mm/yy')) {
				// oneday item
				$('#interval_container').hide();
				$('#interval_day_div').hide();
			} else {
				// when more than 8 days are selected
				// daterange must be at least 8 days to show interval (repeating) fields
				$('#interval_day_div').hide();
				if(((end.getTime() - start.getTime()) / 3600 / 1000 / 24) > 7) {
					$('#interval_container').show();
					//var n = start.getDay();
				} else {
					$('#interval_container').hide();
				}
			}

			if(MyCalendar.calCanChangeColor) {
				if(MyCalendar.editdialogColorpickerType == 'spectrum') {
					$('#editdialog_colorpicker').show();
                    $("#togglePaletteOnly").spectrum('set', MyCalendar.currentCalendarColor);
					$("#togglePaletteOnly").val(MyCalendar.currentCalendarColor);

				} else {
                    $('#editdialog_simple_colorpicker').show();

                }
			} else {
                // hide colorpicker
                if(MyCalendar.editdialogColorpickerType == 'spectrum') {
                    $('#editdialog_colorpicker').hide();
                } else {
                    $('#editdialog_simple_colorpicker').hide();

                }
            }
            
           
			$("#dialog:ui-dialog").dialog( "destroy" );

			$('#edited_title').val('');

			if(MyCalendar.showLocationField) {
				$('#edited_location').val('');
			}
			if(MyCalendar.showDescriptionField) {
				$('#edited_description').val('');
			}
			if(MyCalendar.showPhoneField) {
				$('#edited_phone').val('');
				$('#edited_phone').removeAttr('disabled');
			}
            if(MyCalendar.showUrlField) {
				$('#edited_myurl').val('');
				$('#edited_myurl').removeAttr('disabled');
                
                $('#go_myurl_btn').attr('href', '#');
			}
            
            $('#event_id').val('');
            $('#upload_event_id').val('');
            $('#select_file_field').val('');
            
			$('#error_message').html('');

	      	$( "#datepicker_startdate" ).datepicker('setDate', start);
	      	$( "#datepicker_enddate" ).datepicker('setDate', end);

			$('#datepicker_startdate').removeAttr('disabled');
			$('#datepicker_enddate').removeAttr('disabled');

			var curr_hour = start.getHours();
			var curr_min = start.getMinutes();

			if(curr_hour == 0 && curr_min == 0) {
				
				if(MyCalendar.showAMPM) {
					$('#timepicker_starttime').val(dateFormat(now,'hh:00 TT'));
					$('#timepicker_endtime').val(dateFormat(now,'hh:00 TT'));
				} else {
					$('#timepicker_starttime').val(dateFormat(now,'HH:00'));
					$('#timepicker_endtime').val(dateFormat(now,'HH:00'));
				}

			} else {
				if(MyCalendar.showAMPM) {
					$('#timepicker_starttime').val(dateFormat(start,'hh:MM TT'));
					$('#timepicker_endtime').val(dateFormat(end,'hh:MM TT'));
				} else {
					$('#timepicker_starttime').val(dateFormat(start,'HH:MM'));
					$('#timepicker_endtime').val(dateFormat(end,'HH:MM'));
				}
			}

			if(start.getTime() == end.getTime() || allDay) {
				$('#allday_checkbox').attr('checked', true);
				disableTimeCombos();
			} else {
				$('#allday_checkbox').attr('checked', false);
				enableTimeCombos();
			}

			$( "#dialog-message" ).dialog({
				modal: true,
				title: Lang.Popup.TitleAdd,
				//height: 'auto',
				//width: 'auto',
				height: 'auto',//MyCalendar.showLocationField ? 460 : 430,
				width: 450, 
				resizable: MyCalendar.dialogsResizable,
				create: function (evt, ui) {
                    if(MyCalendar.useHtmlEditor) {
	                    // ckeditor
                	}
                },
                open: function() {
                    if(MyCalendar.showFileUpload) {
                        $('#dialog-message').tabs({
                            selected:0, // for newer jquery versions use 'active'
                            disabled: [1],
                            create: function(e, ui) {
                               // $('#closeBtn').click(function() {
                                    //$('#dialog-movie-info').dialog('close');
                               // });

                            }
                        });
                    }
                    //$(this).parent().children('.ui-dialog-titlebar').remove();
                },
				buttons: [{
			        html: Lang.Popup.emailText,
                    class: "ui-button-left",
                    id: 'emailbtn',
                    //disabled: !MyCalendar.calCanMail,
			        click: function (a,b) {
			        	var title = $('#edited_title')[0].value;
						if(title != null && title != '') {
							mailEvent($(this));

						} else {
							$('#error_message').html(Lang.Alert.EventTitleRequired);
						}
			        }
			    }, {
			        html: Lang.Popup.saveButtonText,
			        click: function (a,b) {
			        	var title = $('#edited_title')[0].value;
						if(title != null && title != '') {
							addEvent(start, end, $(this));

						} else {
							$('#error_message').html(Lang.Alert.EventTitleRequired);
						}
			        }
			    }, {
			        html: Lang.Popup.closeButtonText,
			        click: function () {
			            $( this ).dialog( "close" );
			        }
			    }]
			});
			//$("#edited_title").attr("placeholder", Lang.Popup.EventTitle);
			//$("#edited_description").attr("placeholder", Lang.Popup.EventDescription);

			// FORM LABELS
			$('#wholeday_label_id').html(Lang.Popup.allDayLabel);
			$('#month_label_id').html(Lang.Popup.StartdateLabel);
	        $('#time_label_id').html(Lang.Popup.EnddateLabel );
	        $('#title_label_id').html(Lang.Popup.EventTitle);
	        $('#color_label_id').html(Lang.Popup.EventColor);
	        $('#location_label_id').html(Lang.Popup.EventLocation);
	        $('#description_label_id').html(Lang.Popup.EventDescription );
			$('#phone_label_id').html(Lang.Popup.EventPhone);
	        $('#myurl_label_id').html(Lang.Popup.EventUrl);
	        $('#interval_label_id').html(Lang.Popup.EventInterval );
			$('#recurrence_label_id').html(Lang.Popup.EventRecurrence );
			$('#recurrence_monthly_dom_label').html(Lang.Popup.DayOfMonth);
			$('#recurrence_monthly_dow_label').html(Lang.Popup.DayOfWeek);

			if(MyCalendar.calCanMail) {
                $('#emailbtn').show();
            } else {
                $('#emailbtn').hide();
            }
            
            $('#calendar_id_change_field').hide();
            
			$('#calendar').fullCalendar('unselect');

			if(MyCalendar.useHtmlEditor) {
				//
			}
            
            if(MyCalendar.showFileUpload) {
                $('#files_div').html('');
                $('#file_upload_form').show();
                $('#max_ten_files_div').hide();
            }
		};

		var getViewAreaHtml = function(event, mouseover) {
			startdate = dateFormat(event.start, short_date_notation);
			if(event.end === null) {
				enddate = startdate;
			} else {
				enddate = dateFormat(event.end, short_date_notation);
			}

			var view_startdate = startdate + (startdate != enddate ? ' - ' + enddate : '');

			if(event.time_end == event.time_start) {
				view_times = 'Allday';
			} else {
				var view_times = dateFormat(Date.parse(event.start),hour_notation) + ' - ' + dateFormat(Date.parse(event.end),hour_notation);
			}

                        
			var view_area_html = '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'">'+event.title+'</p>';

			if(event.rep_event !== undefined) {
				view_area_html += '<span class="view_area_label'+ (mouseover ? '_mo' : '') +'">Date: <span class="view_area'+ (mouseover ? '_mo' : '') +'">'+ event.rep_start +' - '+ event.rep_end +'</span></span>';
			} else {
				view_area_html += '<span class="view_area_label'+ (mouseover ? '_mo' : '') +'">Date: <span class="view_area'+ (mouseover ? '_mo' : '') +'">'+ view_startdate +'</span></span>';
			}

			view_area_html += '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'">Time: <span class="view_area'+ (mouseover ? '_mo' : '') +'">'+ view_times +'</span></p>';

			if(event.rep_event !== undefined) {
				if(event.rep_event.rep_interval === 'W') {
					//repeating_weekday		example:day_MO,day_WE
                    var arr_weekdays = event.rep_event.weekdays.split(',');
                    var rep_week_text = Lang.Popup.WeeklyOn + ' ';
                    var counter = 0;

                    $.each(arr_weekdays, function(key, value) {
                        if(value !== '') {
                            if(counter > 0) {
                                rep_week_text += ', ';
                            }
                            rep_week_text += Lang.Fullcalendar.dayNames[value == 7 ? 0 : value];
                            counter ++;
                        }

                    });
                    
                    view_area_html += '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'"><span class="view_area'+ (mouseover ? '_mo' : '') +'">'+rep_week_text+'</span></p>';

				} else if(event.rep_event.rep_interval === 'M') {
					if(event.rep_event.monthday === 'dom') {
						// info_txt
						rep_month_text = Lang.Popup.MonthlyOnDay + ' ' + event.rep_start_day;

					} else {
						var arr_enddate = event.rep_start.split('-');
						var arr_date = MyCalendar.datePickerDateFormat.split('/');
						if(MyCalendar.datePickerDateFormat === null || MyCalendar.datePickerDateFormat == 'dd/mm/yy') {
							
							var dp_startdate = new Date(arr_enddate[2] + '/' + arr_enddate[1] + '/' + arr_enddate[0]);
						} else if(MyCalendar.datePickerDateFormat == 'mm/dd/yy') {
							var dp_startdate = new Date(arr_enddate[1] + '/' + arr_enddate[2] + '/' + arr_enddate[0]);
						}
						var rep_start_dt = dp_startdate.getDay();
						rep_month_text = Lang.Popup.MonthlyOn + ' ' + Lang.Fullcalendar.dayNames[rep_start_dt] + ', ' + Lang.Popup.Starting + ' ' + (arr_date[0] == 'dd' ? dp_startdate.format('dd/mm') : dp_startdate.format('mm/dd'));

					}
					view_area_html += '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'"><span class="view_area'+ (mouseover ? '_mo' : '') +'">'+rep_month_text+'</span></p>';

				}
			}  else {

			}

			// description
			if(event.description !== undefined && event.description !== '') {
				view_area_html += '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'"><span class="view_area'+ (mouseover ? '_mo' : '') +'">'+event.description+'</span></p>';
			}
			
			// location
			if(event.location !== undefined && event.location !== '' && (!mouseover || (mouseover && MyCalendar.showLocationInMouseover))) {
				view_area_html += '<span class="view_area_label'+ (mouseover ? '_mo' : '') +'">Location: <span class="view_area'+ (mouseover ? '_mo' : '') +'">'+event.location+'</span></span>';
			}

			// phone
			if(event.phone !== undefined && event.phone !== '' && (!mouseover || (mouseover && MyCalendar.showPhoneInMouseover))) {
				view_area_html += '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'">Phone: <span class="view_area'+ (mouseover ? '_mo' : '') +'">'+event.phone+'</span></p>';
			}
            
            // myurl
			if(event.myurl !== undefined && event.myurl !== null && event.myurl !== '' && (!mouseover || (mouseover && MyCalendar.showUrlInMouseover))) {
				view_area_html += '<p class="view_area_label'+ (mouseover ? '_mo' : '') +'">Url: <span class="view_area'+ (mouseover ? '_mo' : '') +'">'+event.myurl+'</span></p>';
			}
            
			return view_area_html;
		};

		var onMouseoverEvent = function(me, event) {
	   		var currentView = $('#calendar').fullCalendar('getView').name;

	   		if(MyCalendar.showViewType == 'mouseover') {
		   		if((MyCalendar.onlyShowMouseoverInMonthview && currentView == 'month') || !MyCalendar.onlyShowMouseoverInMonthview) {

			   		var view_area_html = getViewAreaHtml(event, true);

			   		var layer =	'<div id="events-layer" class="fc-transparent arrow_box"  style="padding:7px;color:black;position:absolute; width:'+MyCalendar.MouseoverWidth+'px; height:auto; top:20px; left:40px;border-radius:5px;z-index:1000;">'
								 + '<span style="" id="mouseover'+event.event_id+'">';

					layer += view_area_html;

					layer += '</span></div>';

					me.append(layer);

					$("#mouseover"+event.event_id).hide();
					$("#mouseover"+event.event_id).fadeIn(200);
				}
			}

	   		if(event.allowEdit && !me.hasClass('fc-agendaList-item') && MyCalendar.showMouseoverDeleteButton) {

				 /*
				  *	SHOW DELETE ICON, ALSO POSSIBLE TO SHOW AN EDIT ICON HERE
				  */
				 var layer =	'<div id="events-layer" class="fc-transparent" style="position:absolute; width:100%; height:100%; top:-1px; text-align:right; z-index:100">'
							 + '<a><img src="images/delete.png" title="delete" width="14" id="delbut'+event.id+'" border="0" style="padding-right:5px; padding-top:1px;" /></a>'
							 + '</div>';

				 me.append(layer);
				 $("#delbut"+event.id).hide();
				 $("#delbut"+event.id).fadeIn(200);
				 $("#delbut"+event.id).click(function() {
					 if(event.id) {
					 // opslaan in db
						 var dataString = 'event_id='+ event.id ;
			             $.ajax({
				              type: "POST",
				              url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=del',
				              data: dataString,
				              success:function(html){}
				         });
						 $('#calendar').fullCalendar('removeEvents', event.id);
						return false;
					 }
				 });
			 }
		};

  		var deleteEvent = function(me,event, delete_all) {
			var delete_success = false;
			if(event.id) {
			// opslaan in db
				var dataString = 'event_id='+ event.id ;
	            $.ajax({
		             type: "POST",
		             url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=del',
		             data: {
		             	event_id: event.event_id,
		             	rep_event_id: event.rep_event !== undefined ? event.repeating_event_id : 0,
		             	delete_all: event.rep_event !== undefined && delete_all
		             },
		             dataType: 'json',
		             success:function(result){
		             	if(result.success) {
							if(event.rep_event === undefined) {
								$('#calendar').fullCalendar('removeEvents', event.id);	// goes wrong when 1 item of repeat is deleted
							} else {
								$('#calendar').fullCalendar('refetchEvents');
							}
							me.dialog( "close" );
		                    $('#error_message').html('');

		             	} else {
		             		if(result.notloggedin) {
								$('#calendar').fullCalendar('refetchEvents');
								alert(Lang.Alert.NotLoggedIn);
								window.location = MyCalendar.FULLCAL_URL ;
		             		} else {
		             			alert(Lang.Alert.ErrorSaving);
		             		}

		             	}
		             }
		        });
			}
		};

		/**
		* clicked on an event
		*/
		var onClickEvent = function(event) {
            	
			if(event.order_id != localStorage.getItem('order_id')){
				return false;
			}
			//if(!event.allowEdit || (MyCalendar.calCanEdit === undefined || MyCalendar.calCanEdit === false) && MyCalendar.calCanView === false) {
			if(!event.allowEdit && MyCalendar.calCanView === false) {
				if(MyCalendar.showNotAllowedMessages) {
					showMessage(Lang.Alert.NotAllowedToEdit, 'error');
				}
				return false;
			}

			//if(!event.allowEdit) {

			//	if(MyCalendar.showNotAllowedMessages) {
			//		showMessage(Lang.Alert.NotAllowedToEdit, 'red');
			//	}
			//} else {

            $('#event_id').val(event.event_id);
            $('#upload_event_id').val(event.event_id);
            
		        var startdate = event.start;
		        if(event.end === null) {
		        	var enddate = startdate;
		        } else {
		        	var enddate = event.end
		        }

				if(event.rep_start !== undefined) {
					$( "#datepicker_startdate" ).datepicker('setDate', dateFormat(Date.parse(event.rep_start), MyCalendar.datePickerDateFormat)); // or dateFormat(event._start,'dd/mm/yyyy')
					$( "#datepicker_enddate" ).datepicker('setDate', dateFormat(Date.parse(event.rep_end), MyCalendar.datePickerDateFormat));

				} else {
					$( "#datepicker_startdate" ).datepicker('setDate', startdate);//$( "#datepicker_startdate" ).datepicker('setDate', dateFormat(Date.parse(startdate),'dd/mm/yy')); // or dateFormat(event._start,'dd/mm/yyyy')
					$( "#datepicker_enddate" ).datepicker('setDate', enddate);//$( "#datepicker_enddate" ).datepicker('setDate', dateFormat(Date.parse(enddate),'dd/mm/yy'));

				}

                if(event.canChangeColor) {
                    // show colorpicker
                    if(MyCalendar.editdialogColorpickerType == 'spectrum') {
                        $('#editdialog_colorpicker').show();
                        setTimeout(function() {
                            $('#togglePaletteOnly').val(event.color);
                            
                            $("#togglePaletteOnly").spectrum('set', event.color);
                        },300);
                        
                    } else {
                        $('#editdialog_simple_colorpicker').show();
                       
                    }
                
                } else {
                    // hide colorpicker
                    if(MyCalendar.editdialogColorpickerType == 'spectrum') {
                        $('#editdialog_colorpicker').hide();
                    } else {
                        $('#editdialog_simple_colorpicker').hide();
                       
                    }
                }
                
				$("#interval_day_div input[name='day_1']").attr('checked', false);
				$("#interval_day_div input[name='day_2']").attr('checked', false);
				$("#interval_day_div input[name='day_3']").attr('checked', false);
				$("#interval_day_div input[name='day_4']").attr('checked', false);
				$("#interval_day_div input[name='day_5']").attr('checked', false);
				$("#interval_day_div input[name='day_6']").attr('checked', false);
				$("#interval_day_div input[name='day_7']").attr('checked', false);

				if(event.rep_event !== undefined) {
					// this is a repeating event
					startdate = event.repeating_startdate;
					enddate = event.repeating_enddate;
					$('#interval_container').show();

					// set interval
					//$('#interval_div').val(event.repeating_interval);
					$("select[name='interval']").val(event.rep_event.rep_interval);
					if(event.rep_event.rep_interval == 'W') {
						$('#interval_day_div').show();


						//repeating_weekday		example:day_MO,day_WE
						var arr_weekdays = event.rep_event.weekdays.split(',');

                        var rep_week_text = Lang.Popup.WeeklyOn + ' ';
                        var counter = 0;
                    
						$.each(arr_weekdays, function(key, value) {
                            if(value !== '') {
                                if(counter > 0) {
                                    rep_week_text += ', ';
                                }

                                rep_week_text += Lang.Fullcalendar.dayNames[value == 7 ? 0 : value];
                                counter ++;

                                $("#interval_day_div input[name='day_"+value+"']").attr('checked', true);
                          }

						});
                        
                        $('#info_txt').html(rep_week_text);

					} else if(event.rep_event.rep_interval == 'M') {

						$('#interval_month_choice_div').show();
						$('#interval_month_choice_div input:radio[name="monthday"]').each(function(index, item) {
							monthday =  $(item).val() ;
							if(monthday == event.rep_event.monthday) {
								$(item).attr('checked', true);
							}
						});

						if(event.rep_event.monthday == 'dom') {
							// info_txt
							$('#info_txt').html(Lang.Popup.MonthlyOnDay + ' ' + $( "#datepicker_startdate" ).datepicker('getDate').getDate());

						} else {
							var arr_date = MyCalendar.datePickerDateFormat.split('/');
                            var rep_start_dt = new Date(event.rep_start_day).getDay();
                            rep_month_text = Lang.Popup.MonthlyOn + ' ' + Lang.Fullcalendar.dayNames[rep_start_dt] + ', ' + Lang.Popup.Starting + ' ' + (arr_date[0] == 'dd' ? $( "#datepicker_startdate" ).datepicker('getDate').format('dd/mm') : $( "#datepicker_startdate" ).datepicker('getDate').format('mm/dd'));

						}

					} else if(event.rep_event.rep_interval == 'Y') {
                        var yearly_dom = event.rep_event.yearmonthday;    
                        var yearly_month = Lang.Fullcalendar.monthNames[event.rep_event.yearmonth];
                        var ts_endyear_recurring_date = Date.parse(event.rep_event.yearmonth + '/' + yearly_dom + '/' + $( "#datepicker_enddate" ).datepicker('getDate').getFullYear() );  
                        var ts_enddate = $( "#datepicker_enddate" ).datepicker('getDate').getTime();
                        
                        var until = event.rep_event.until !== undefined ? event.rep_event.until : '';
                        
//                        if(ts_endyear_recurring_date <= ts_enddate) {
//                            until = $( "#datepicker_enddate" ).datepicker('getDate').getFullYear();
//                        } else {
//                            until = $( "#datepicker_enddate" ).datepicker('getDate').getFullYear() -1;
//                        }
                        
                        $('#yearly_dom').val(yearly_dom);
                        $('#yearly_month').val(event.rep_event.yearmonth);
                        $('#interval_year_choice_div').show();
                        
                        $('#info_txt').html(Lang.Popup.YearlyOn + ' ' + yearly_dom + ' ' + yearly_month + ' ' + Lang.Popup.Until + ' ' + until);
                    }

				} else if( event.end != null && ((event.end.getTime() - event.start.getTime()) / 3600 / 1000 / 24) > 7) {
					$('#interval_container').show();
					//var n = start.getDay();

				} else {	//if(dateFormat(Date.parse(startdate),'dd/mm/yy') == dateFormat(Date.parse(enddate),'dd/mm/yy')) {
				// 1 day event, don't show the repeating stuff
					$('#interval_container').hide();
					$('#interval_day_div').hide();
					$('#interval_month_choice_div').hide();
                    $('#interval_year_choice_div').hide();
					$('#info_txt').html('');
					$("select[name='interval']").val('D');
				}


				// reset some things
				$( "#dialog:ui-dialog" ).dialog( "destroy" );

				// setvalues
				$('#edited_title').val(event.title);

				if(MyCalendar.showLocationField && event.location !== null) {
					$('#edited_location').val(event.location);
				}
				if(MyCalendar.showDescriptionField && event.description !== null) {
					$('#edited_description').val(event.description);
				}
				if(MyCalendar.showPhoneField && event.phone !== null) {
					$('#edited_phone').val(event.phone);
					$('#edited_phone').removeAttr('disabled');
				}
                $('#edited_myurl').val('');
                
                if(MyCalendar.showUrlField && event.myurl !== null) {
                    $('#edited_myurl').val(event.myurl);
                    $('#edited_myurl').removeAttr('disabled');
                }
            
				$('#error_message').html('');

				if(event.start !== null) {
					var starttime_to_set = null;
					
                    if(MyCalendar.showAMPM) {
                        var starttime_to_set = event.start.format('hh:MM TT');
                    } else {
                        var starttime_to_set = event.start.format('HH:MM');
                    }
                   
					$('#timepicker_starttime').val(starttime_to_set);
				} else {
                    if(MyCalendar.showAMPM) {
                        $('#timepicker_starttime').val(now.format('hh:MM TT'));
                    } else {
                        $('#timepicker_starttime').val(now.format('HH:MM'));
                    }    
                }
				
                var startdate = Date.parse(event.start) / 1000;
	
    
                if(event.end !== null) {
                    var endtime_to_set = null;
                    if(MyCalendar.showAMPM) {
                        endtime_to_set = event.end.format('hh:MM TT');
                    } else {
                        endtime_to_set = event.end.format('HH:MM');
                    }
                    $('#timepicker_endtime').val(endtime_to_set);
                } else {
                    if(MyCalendar.showAMPM) {
                        $('#timepicker_endtime').val(now.format('hh:MM TT'));
                    } else {
                        $('#timepicker_endtime').val(now.format('HH:MM'));
                    }    
                }
              

				if(event.allDay ) {
					$('#allday_checkbox').attr('checked', true);
					disableTimeCombos();
				} else {
					$('#allday_checkbox').attr('checked', false);
					enableTimeCombos();
				}


				$( "#dialog-message" ).dialog({
					modal: true,
					title: Lang.Popup.TitleEdit,
					//height: 'auto',
					//width: 'auto',
					height: 'auto',//MyCalendar.showLocationField ? 460 : 430,
					width: 450,
                    minHeight: 300,
					resizable: MyCalendar.dialogsResizable || false,
					create: function() {
				        if(MyCalendar.useHtmlEditor) {
				            // ckeditor
						}

					},
                    open: function() {
                        if(MyCalendar.showFileUpload) {
                            $('#dialog-message').tabs({
                                selected:0, // for newer jquery versions use 'active'
                                disabled: [],
                                create: function(e, ui) {
                                   // $('#closeBtn').click(function() {
                                        //$('#dialog-movie-info').dialog('close');
                                   // });
                                   
                                }
                            });
                        }
                        //$(this).parent().children('.ui-dialog-titlebar').remove();
                    },
					buttons: [{
                        html: Lang.Popup.emailText, // email to admin
                        class: "ui-button-left",
                        id: 'emaileditbtn',
                        //disabled: !MyCalendar.calCanMail,
                        click: function (a,b) {
                            var title = $('#edited_title')[0].value;
                            if(title != null && title != '') {
                                mailEvent($(this));

                            } else {
                                $('#error_message').html(Lang.Alert.EventTitleRequired);
                            }
                        }
                    },{
						text: 'Restore pattern',
						id: 'restorebtn',
						disabled: (event.rep_event === undefined || event.rep_event.bln_broken == 0 || event.rep_event.bln_broken == '0'),
						click: function() {
							var bln_correct = updateEvent(event, true, $(this));
							if(bln_correct) {
								 //var restoreButton=$('.ui-dialog-buttonpane button:first');
								//restoreButton.addClass('ui-state-hidden');
								$('#restorebtn').hide();
			                  	$( this ).dialog( "close" );
			                  	$('#error_message').html('&nbsp;');

			              }
						}
					},{
				        html: Lang.Popup.updateButtonText,
				        click: function () {
				            var title = $('#edited_title')[0].value;

                        	if(title != null && title != '') {
								var bln_correct = updateEvent(event, false, $(this));
								if(bln_correct) {
                                   // $( this ).dialog( "close" );
                                    $('#error_message').html('');
                                }
							} else {
							    $('#error_message').html(Lang.Alert.EventTitleRequired);
						    }
				        }
				    }, {
				        html: Lang.Popup.deleteButtonText,
				        disabled: !event.deletable,
				        click: function () {
                            var me = $(this);
                            if(event.rep_event !== undefined) {

                                $( "#dialog-delete-prompt" ).dialog({
                                    modal: true,
                                    title: Lang.Prompt.Delete.chooseOneOrAllTitle,
                                    buttons: [{
                                        text: Lang.Prompt.Delete.thisItemBtn,
                                        click: function() {
                                            $( this ).dialog( "close" );
                                            deleteEvent(me, event, false);
                                            //me.dialog("close");
                                        }},{
                                            text: Lang.Prompt.Delete.allItemsBtn,
                                            click: function() {
                                                $( this ).dialog( "close" );
                                                deleteEvent(me, event, true);
                                                //me.dialog("close");
                                            }
                                        }]

                                    });
							} else {
								if(MyCalendar.showDeleteConfirmDialog) {
                                    $( "#dialog-delete-prompt" ).dialog({
                                        modal: true,
                                        title: Lang.Prompt.Delete.ConfirmTitle,
                                        buttons: [{
                                            text: Lang.Prompt.Delete.RemoveBtn,
                                            click: function() {
                                                $( this ).dialog( "close" );
                                                deleteEvent(me, event, false);

                                            }},{
                                                text: Lang.Prompt.Delete.CancelBtn,
                                                click: function() {
                                                    $( this ).dialog( "close" );
                                                }
                                            }
                                        ]
                                    });
                                } else {
                                    deleteEvent(me, event, false);
                                    $( this ).dialog( "close" );
                                }
							}
				        }
				    },{
				        html: Lang.Popup.closeButtonText,
				        click: function () {
				            $( this ).dialog( "close" );
				        }
				    }]
				});

				// FORM LABELS
				$('#wholeday_label_id').html(Lang.Popup.allDayLabel);
               	$('#month_label_id').html(Lang.Popup.StartdateLabel );
               	$('#time_label_id').html(Lang.Popup.EnddateLabel );
				
				if(event.rep_event !== undefined) {
					$('#delete_one_or_all_label_id').html(Lang.Prompt.Delete.chooseOneOrAllText );
				} else {
					$('#delete_one_or_all_label_id').html(Lang.Prompt.Delete.ConfirmText );
				}
				
				$('#title_label_id').html(Lang.Popup.EventTitle);
	        	$('#color_label_id').html(Lang.Popup.EventColor);
				$('#location_label_id').html(Lang.Popup.EventLocation);
	        	$('#phone_label_id').html(Lang.Popup.EventPhone);
	        	$('#myurl_label_id').html(Lang.Popup.EventUrl);
                $('#description_label_id').html(Lang.Popup.EventDescription );
				$('#interval_label_id').html(Lang.Popup.EventInterval );
				$('#recurrence_label_id').html(Lang.Popup.EventRecurrence );
				$('#recurrence_monthly_dom_label').html(Lang.Popup.DayOfMonth);
				$('#recurrence_monthly_dow_label').html(Lang.Popup.DayOfWeek);
                $('#edit_dialog_tab_info').html(Lang.Popup.LabelTabMain);
	        	$('#edit_dialog_tab_files').html(Lang.Popup.LabelTabFiles);
	        	
				if(event.rep_event === null || event.rep_event === undefined || event.rep_event === 0 || event.rep_event.bln_broken == 0 || event.rep_event.bln_broken == '0') {
					$('#restorebtn').hide();
				} else {
					$('#restorebtn').css('font-weight','normal');
					$('#restorebtn').css('color','green');

				}
                if(MyCalendar.showUrlField) {
                    $('#go_myurl_btn').attr('href', '#');
                    
                    if(event.myurl !== undefined && event.myurl !== null && event.myurl !== '') {
                        if(event.myurl.indexOf('http://') == -1) {
                            event.myurl = 'http://' + event.myurl;
                        }
                        $('#go_myurl_btn').attr('target', '_blank');
                        $('#go_myurl_btn').attr('href', event.myurl);
                    }
                }

				if(MyCalendar.useHtmlEditor) {
					//
				}

               //if(MyCalendar.calCanMail) {
                if(event.canMail) {
                    $('#emaileditbtn').show();
                } else {
                    $('#emaileditbtn').hide();
                }
   
				if(event.color === '' || event.color === undefined || event.color.substring(0,1) !== '#') {
					event.color = MyCalendar.currentEventColor;
				}

				if(MyCalendar.calCanChangeColor) {
					//$('#checkbox_use_color_for_all_events').attr( "checked", false );

					if(MyCalendar.editdialogColorpickerType == 'spectrum') {
						$("#togglePaletteOnly").spectrum('set', event.color);
						$("#togglePaletteOnly").val(event.color);
					} else {
						$('#ColorSelectionTarget1').css('background-color',event.color);
						MyCalendar.currentEventColor = event.color;
					}
				}
                $('#calendar_id_change_field').show();
                $('#calendar_label_id').html(Lang.Popup.LabelCalendar);
	        	$('#edit_dlg_calendar_selectbox').val(event.calendar_id);
                
                if(MyCalendar.showFileUpload) {
                    // get files, otherwise a just added file is not visible
                    var data = {
                        event_id: event.event_id
                    };    
                    
                    $.ajax({
                        type: "POST",
                        url: MyCalendar.FULLCAL_URL + '/index.php?action=get_files',
                        data: data,
                        dataType: 'json',
                        success:function(result){
                            if(result.success) {
                                var strFiles = '';    
                                $('#select_file_field').val('');

                                $.each(result.files, function(k,row) {
                                    strFiles += (row.loggedin_user_can_delete ? '<span class="delete_file_btn" onClick="deleteFile('+row.event_id+','+row.event_file_id+');return false;" data-event_id="'+row.event_id+'" data-event_file_id="'+row.event_file_id+'" title="Delete file" alt="Delete file" style="padding-right:3px;vertical-align:top;"><img src="'+MyCalendar.FULLCAL_URL+'/images/error.png" /></span>' : '<span style="padding-right:3px;vertical-align:top;"><img src="'+MyCalendar.FULLCAL_URL+'/images/transparent.png" /></span>') + '<a target="_blank" title="Open file" alt="Open file" href="'+MyCalendar.FULLCAL_URL+'/uploads/'+row.filename+'.'+row.file_extension+'">' + row.original_filename + '</a><br />';
                                });

                                $('#files_div').html(strFiles);
                                
                                if(result.files.length >= MyCalendar.maxEventFileUpload) {
                                    // hide the upload form
                                    $('#file_upload_form').hide();
                                    $('#max_ten_files_div').show();
                                } else {
                                    $('#file_upload_form').show();
                                    $('#max_ten_files_div').hide();
                                }
                            } else {
//                                if(result.notloggedin) {
//                                    $('#calendar').fullCalendar('refetchEvents');
//                                    alert(Lang.Alert.NotLoggedIn);
//                                    window.location = MyCalendar.FULLCAL_URL ;
//                                } else {
//                                    alert(Lang.Alert.ErrorSaving);
//                                }
                            }
                        }
                    });
                
                    
                    
                }
                
                
			//}
		};

		var onResizeEvent = function(event) {
			var startdate = Date.parse(event.start) / 1000;
	
			var str_date_start = event.start.format('yyyy-mm-dd HH:MM:00');
	       
			var currentView = $('#calendar').fullCalendar('getView').name;
			
			if(event.end === null && (currentView == 'agendaWeek' || currentView == 'agendaDay' || currentView == 'basicWeek' || currentView == 'basicDay')) {
		        var enddate = startdate + (2 * 3600);	// 2 hours
		        var str_date_end = new Date(enddate*1000).format('yyyy-mm-dd HH:MM:00');
		       
		    } else if(event.end === null) {
	            var enddate = startdate;
	            var str_date_end = event.start.format('yyyy-mm-dd HH:MM:00');
		       
	        } else {
	            var enddate 	= Date.parse(event.end) / 1000;
	            var str_date_end = event.end.format('yyyy-mm-dd HH:MM:00');
		    }
	             
			var offsetClientToGMT = new Date().getTimezoneOffset() * 60;
			startdate = startdate - offsetClientToGMT;
			enddate = enddate - offsetClientToGMT;

	        var data = {
            	event_id: event.event_id,
            	date_start: startdate,
				date_end: enddate,
				str_date_start: str_date_start,
				str_date_end: str_date_end,
				cal_id: event.calendar_id
            };
		            
            $.ajax({
				type: "POST",
				url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=resize',
				data: data,
				dataType: 'json',
				success:function(result){
					if(result.success) {
						if(result.event !== undefined) {
							event = applyToObject(event, result.event);
		       				$('#calendar').fullCalendar('updateEvent', event);
						} else {
							$('#calendar').fullCalendar('refetchEvents');
						}

	             	} else {
						//$('#calendar').fullCalendar('refetchEvents');
						if(result.notloggedin) {
							$('#calendar').fullCalendar('refetchEvents');
							alert(Lang.Alert.NotLoggedIn);
							window.location = MyCalendar.FULLCAL_URL ;
	             		} else {
	             			alert(Lang.Alert.ErrorSaving);
	             		}
	             	}
	      	    }
			});
		};

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()), // use the element's text as the event title
                color: $(this).attr('color'),
                cal_id: $(this).attr('cal_id')
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});

		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				//right: 'list,month,agendaWeek,agendaDay,agendaList'
				right:  (MyCalendar.showMonthViewButton ? 'month' : '') + (MyCalendar.showWeekViewButton || MyCalendar.showDayViewButton || MyCalendar.showAgendaViewButton ? ',' : '') +
						(MyCalendar.showWeekViewButton ? MyCalendar.weekViewType : '') + (MyCalendar.showDayViewButton || MyCalendar.showAgendaViewButton ? ',' : '') +
						(MyCalendar.showDayViewButton  ? MyCalendar.dayViewType : '') + (MyCalendar.showAgendaViewButton ? ',' : '') +
						(MyCalendar.showAgendaViewButton  ? 'agendaList' : '')
			},
			year: MyCalendar.gotoYear ? MyCalendar.gotoYear : new Date().getFullYear(),
			month: MyCalendar.gotoMonth ? MyCalendar.gotoMonth : new Date().getMonth(),
			date: MyCalendar.gotoDay ? MyCalendar.gotoDay : new Date().getDate(),
			editable: true,
			//ignoreTimezone: true,
			selectable: true,
			firstDay: MyCalendar.FCfirstDay || 1,
            firstHour: MyCalendar.FCfirstHour || 6,
            minTime: MyCalendar.FCminTime || 0,
			timeFormat: MyCalendar.showAMPM ? 'h:mm TT{ - h:mm TT} ' : 'H:mm { - H:mm} ',
			axisFormat: MyCalendar.showAMPM ? 'h:mm TT' : 'H:mm',
			monthNames: 		Lang.Fullcalendar.monthNames,
			monthNamesShort: 	Lang.Fullcalendar.monthNamesShort,
			dayNames: 			Lang.Fullcalendar.dayNames,
			dayNamesShort: 		Lang.Fullcalendar.dayNamesShort,
			buttonText: {
				prev: '&nbsp;&#9668;&nbsp;',
				next: '&nbsp;&#9658;&nbsp;',
				//prev: '<',
				//next: '>',
				prevYear: 		'&nbsp;&lt;&lt;&nbsp;',
				nextYear: 		'&nbsp;&gt;&gt;&nbsp;',
				today: 			Lang.Fullcalendar.buttonText.today,
				month: 			Lang.Fullcalendar.buttonText.month,
				week: 			Lang.Fullcalendar.buttonText.week,
				day: 			Lang.Fullcalendar.buttonText.day,
				agendaList: 	Lang.Fullcalendar.buttonText.agendaList
			},
			showTitleFirst: MyCalendar.showTitleFirst || false,
            showDescription: MyCalendar.showDescriptionInWDLview || false,
            showLocation: MyCalendar.showLocationInWDLview || false,
            showPhone: MyCalendar.showPhoneInWDLview || false,
			showUrl: MyCalendar.showUrlInWDLview || false,
			timeline: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = Date.parse(date) / 1000;
				copiedEventObject.allDay = allDay;

		        if(copiedEventObject.title === undefined) {
		             return false;
		        }
				if(!MyCalendar.calCanDragDDItems) {
					return false;
				}
                if(!checkAlterable(date)) {
                    showMessage(Lang.Alert.NotAllowedToAddOnThisDate, 'error');
                    return false;
                }  
                
               //todo $('#saving').show();
                
		        var offsetClientToGMT = new Date().getTimezoneOffset() * 60;
		        var startdate = copiedEventObject.start - offsetClientToGMT;

				var start_date_date = new Date(startdate*1000);
			
                var currentView = $('#calendar').fullCalendar('getView').name;
			
                if(currentView == 'agendaWeek' || currentView == 'agendaDay' || currentView == 'basicWeek' || currentView == 'basicDay') {
                    var str_date_start = date.format('yyyy-mm-dd HH:MM:00');
                    var str_date_end = start_date_date.format('yyyy-mm-dd HH:MM:00');
                } else {
                    var str_date_start = date.format('yyyy-mm-dd 00:00:00');
                    var str_date_end = start_date_date.format('yyyy-mm-dd 00:00:00');
                }
		     
                var data = {
                    cal_id: copiedEventObject.cal_id,   //MyCalendar.currentCalendars,
                    date_start: startdate,
                    str_date_start: str_date_start,
                    str_date_end: str_date_end,
                    color: copiedEventObject.color,     //MyCalendar.currentCalendarColor
                    title: copiedEventObject.title

                };
                
                $.ajax({
					type: "POST",
					url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=add',
					data: data,
					dataType: 'json',
					success:function(result){
						if(result.success) {
							result.event._id = result.event.id;
							$('#calendar').fullCalendar('renderEvent', result.event);
							//$('#calendar').fullCalendar('refetchEvents');
						} else {
							if(result.notloggedin) {
								$('#calendar').fullCalendar('refetchEvents');
								alert(Lang.Alert.NotLoggedIn);
								window.location = MyCalendar.FULLCAL_URL ;
		             		} else {
		             			alert(Lang.Alert.ErrorSaving);
		             		}
						}
					}
		        });

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},
			//events: {
			//	url: MyCalendar.FULLCAL_URL + '/command/cal_events.php?action=start',
			//	success: function(a) {
			//		if(a.notloggedin) {
			//			alert(Lang.Alert.NotLoggedIn);
			//			window.location = MyCalendar.FULLCAL_URL ;
			//		}
		    //    }
			//},
			eventSources: [

				//'https://www.google.com/calendar/feeds/paul.wolbers%40gmail.com/private-4d64ac1eb16ed8d90f43ce99b33dce99/basic',
				//'https://www.google.com/calendar/ical/paul.wolbers%40gmail.com/private-4d64ac1eb16ed8d90f43ce99b33dce99/basic.ics', // dan moet er eerst net als gcal.js een ical.js gemaakt worden
				{color: '', url: MyCalendar.FULLCAL_URL+"/command/cal_events.php?action=start&cal_id=" + MyCalendar.currentCalendars,cache: false}
			],
			eventDrop: function(event, delta) {
				if(!event.allowEdit) {
                	$('#calendar').fullCalendar('refetchEvents');
					if(MyCalendar.showNotAllowedMessages) {
						showMessage(Lang.Alert.NotAllowedToEdit, 'error');
					}
				} else {
					onEventDropEvent(event);
				}
			},
	        selectHelper: true,
			select: function(start, end, allDay) {
				onSelectEvent(start, end, allDay);
			},
	        loading: function(bool) {
	            if (bool) {
	            	$('#loading').show();
	            } else {
	            	$('#loading').hide();
	            }
	        },
	        eventMouseover: function(event, jsEvent, view) {
				if (!$.support.touch) {
                    onMouseoverEvent($(this), event);
                }
                
			},
			eventMouseout: function(calEvent, domEvent) {
				$("#events-layer").remove();
			},
	        eventClick: function(event, element) {
				onClickEvent(event);
			},
	        eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
				if(!event.allowEdit) {
                //if(MyCalendar.calCanEdit === undefined || MyCalendar.calCanEdit === false) {
					if(MyCalendar.showNotAllowedMessages) {
						showMessage(Lang.Alert.NotAllowedToEdit, 'error');
					}

					revertFunc();
				} else {
					onResizeEvent(event);
				}

			 },
		    allDayDefault: false,
		    defaultView: MyCalendar.defaultView,
		    weekNumbers: MyCalendar.showWeeknumbers,
			eventRender: function (event, element) {
			  //  if(event.allowEdit) {
                    
            //    } 
                if(MyCalendar.touchfriendly_drag_events) {
                    if ($.support.touch) {	// && !$(element).hasClass('fc-event-draggable')
                        $(element).draggable();
                    }
                }
               
                var item_title = element.find('span.fc-event-title').text();

                   
                var currentView = $('#calendar').fullCalendar('getView').name;
                   
				if(currentView == 'month') {
                    var truncate_length = MyCalendar.truncateLength && MyCalendar.truncateLength > 0 ? MyCalendar.truncateLength : 50;

                    var truncated_text = MyCalendar.truncateTitle && item_title.length>truncate_length ? item_title.substr(0,truncate_length)+'...' : item_title;

                } else {
                    var truncated_text = item_title;
                }
                
                if(currentView == 'agendaWeek' || currentView == 'agendaDay' || currentView == 'basicWeek' || currentView == 'basicDay') {
                    var more_info = '';
                    if(MyCalendar.showDescriptionInWDLview && event.description !== '') {
                        more_info += 'Info: ' + event.description;
                    }
                    if(MyCalendar.showLocationInWDLview && event.location !== '') {
                        more_info += '<br />Location: ' + event.location;
                    }
                    if(MyCalendar.showPhoneInWDLview && event.phone !== '') {
                        more_info += '<br />Phone: ' + event.phone;
                    }
                    if(MyCalendar.showUrlInWDLview && event.myurl !== '') {
                        more_info += '<br />Url: <a class="myurl" href="'+event.myurl+'" target="_blank">' + event.myurl + '</a>';
                    }
                    if(more_info !== '') {
                        element.find('div.fc-event-description').html(more_info);
                    }
                }
                
				if(event.assigned_to_me) {
			    	element.find('span.fc-event-title').text(truncated_text  + ' *');
			    } else {
			    	element.find('span.fc-event-title').text(truncated_text);
                    //element.find('span.fc-event-title').html('<img src="'+MyCalendar.FULLCAL_URL + '/images/glyphicons/glyphicons-54-alarm.png'+ '" style="width:13px;padding-right:2px;vertical-align:middle;"/>' + truncated_text + '✔ ✗ ');
			    }

                  
                
			   // allow html in title
			   // element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());
			},
            dayRender: function(date, cell){
                if(MyCalendar.maskUnalterableDays) {
                    if(!checkAlterable(date)) {
                        $(cell).addClass('disabled');
                    }
                }
                if(MyCalendar.touchfriendly_select_daycells) {
                    cell.addTouch();
                }
            }

		});
	});