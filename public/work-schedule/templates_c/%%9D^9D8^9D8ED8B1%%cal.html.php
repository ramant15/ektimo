<?php /* Smarty version 2.6.18, created on 2015-10-21 20:37:55
         compiled from /home/www/html/public/work-schedule/view/cal.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtolower', '/home/www/html/public/work-schedule/view/cal.html', 2, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="<?php echo strtolower($this->_tpl_vars['settings']['language']); ?>
_<?php echo $this->_tpl_vars['settings']['language']; ?>
">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=740, initial-scale=1.0">

<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/Aristo/Aristo.css' />

<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/fullcalendar-1.6.4/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/fullcalendar-1.6.4/fullcalendar/agendalist.css' />
<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/fullcalendar-1.6.4/fullcalendar/fullcalendar.print.css' media='print' />

<?php if ($this->_tpl_vars['settings']['editdialog_timepicker_type'] == 'simple'): ?>
	<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/jquery-timepicker-1.3.2/jquery.timepicker.css'  />
<?php else: ?>
	<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/jquery/jquery-ui-timepicker-0.3.3/jquery.ui.timepicker.css'  />
<?php endif; ?>

<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/jquery/jqueryui/1.8.17/jquery-ui.css' />

<link rel='stylesheet' type='text/css' href='<?php echo @FULLCAL_URL; ?>
/style/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo @FULLCAL_URL; ?>
/style/customstyles.css' />

<script type="text/javascript" src="<?php echo @EXTERNAL_URL; ?>
/jquery/jquery.1.5.2.min.js"></script>
<script type='text/javascript' src='<?php echo @EXTERNAL_URL; ?>
/jquery/jquery-ui.1.8.16.min.js'></script>

<?php if (@TOUCHFRIENDLY_DRAG_EVENTS): ?>
    <script type='text/javascript' src="<?php echo @EXTERNAL_URL; ?>
/jquery/jquery.ui.touch-punch.js"></script>
<?php endif; ?>

<?php if (@TOUCHFRIENDLY_SELECT_DAYCELLS): ?>
    <script type='text/javascript' src="<?php echo @EXTERNAL_URL; ?>
/jquery/jquery.ui.touch.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['settings']['editdialog_colorpicker_type'] == 'spectrum'): ?>
	<script src='<?php echo @EXTERNAL_URL; ?>
/bgrins-spectrum/spectrum.js'></script>
	<link rel='stylesheet' href='<?php echo @EXTERNAL_URL; ?>
/bgrins-spectrum/spectrum.css' />
<?php endif; ?>

<!-- <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-lightness/jquery-ui.css"> -->


<script type='text/javascript'>
	MyCalendar = {};
  	MyCalendar.FULLCAL_URL					= '<?php echo @FULLCAL_URL; ?>
';
  	MyCalendar.timePickerMinHour 			= <?php echo @MINHOUR; ?>
;
	MyCalendar.timePickerMaxHour 			= <?php echo @MAXHOUR; ?>
;
	MyCalendar.timePickerMinuteInterval 	= <?php echo @MINUTE_INTERVAL; ?>
;
	
    MyCalendar.datePickerDateFormat 		= '<?php echo @DATEPICKER_DATEFORMAT; ?>
';

	MyCalendar.currentCalendar				= '<?php echo $this->_tpl_vars['default_calendar']['calendar_id']; ?>
';
	MyCalendar.currentCalendars				= <?php if (isset ( $this->_tpl_vars['default_calendars'] )): ?>'<?php echo $this->_tpl_vars['default_calendars']; ?>
'<?php else: ?>MyCalendar.currentCalendar<?php endif; ?>;
	MyCalendar.currentCalendarName			= '<?php echo $this->_tpl_vars['default_calendar']['name']; ?>
';
	MyCalendar.currentEventColor			= null;
	MyCalendar.currentCalendarColor			= '<?php echo $this->_tpl_vars['default_calendar_color']; ?>
';
	MyCalendar.calCanEdit 					= <?php if ($this->_tpl_vars['cal_can_edit']): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.calCanAdd 					= <?php if ($this->_tpl_vars['cal_can_add']): ?>true<?php else: ?>false<?php endif; ?>;
  	MyCalendar.calCanChangeColor			= <?php if ($this->_tpl_vars['cal_can_change_color']): ?>true<?php else: ?>false<?php endif; ?>;
  	MyCalendar.calCanMail                   = <?php if ($this->_tpl_vars['cal_can_mail']): ?>true<?php else: ?>false<?php endif; ?>;
  	MyCalendar.calAlterableStartdate		= '<?php echo $this->_tpl_vars['cal_alterable_startdate']; ?>
';
  	MyCalendar.calAlterableEnddate          = '<?php echo $this->_tpl_vars['cal_alterable_enddate']; ?>
';
  	MyCalendar.calCanDragDDItems 			= <?php if ($this->_tpl_vars['can_drag_dd_items']): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.calCanView 					= <?php if ($this->_tpl_vars['cal_can_view']): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.admin_has_full_control       = <?php if (@ADMIN_HAS_FULL_CONTROL): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.onlyAdminCanSeeDDItems       = <?php if (@ONLY_ADMIN_CAN_SEE_DRAG_DROP_ITEMS): ?>true<?php else: ?>false<?php endif; ?>;
    
    MyCalendar.showDescriptionInWDLview     = <?php if (@SHOW_DESCRIPTION_IN_WDL_VIEW): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.showLocationInWDLview        = <?php if (@SHOW_LOCATION_IN_WDL_VIEW): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.showPhoneInWDLview           = <?php if (@SHOW_PHONE_IN_WDL_VIEW): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.showUrlInWDLview             = <?php if (@SHOW_URL_IN_WDL_VIEW): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.maskUnalterableDays           = <?php if (@MASK_UNALTERABLE_DAYS): ?>true<?php else: ?>false<?php endif; ?>;
    
    
	MyCalendar.showWeeknumbers				= <?php if ($this->_tpl_vars['settings']['show_weeknumbers'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showNotAllowedMessages		= <?php if ($this->_tpl_vars['settings']['show_notallowed_messages'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.showDescriptionField			= <?php if ($this->_tpl_vars['settings']['show_description_field'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showLocationField			= <?php if ($this->_tpl_vars['settings']['show_location_field'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showPhoneField				= <?php if ($this->_tpl_vars['settings']['show_phone_field'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showUrlField                 = <?php if ($this->_tpl_vars['settings']['show_url_field'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showDeleteConfirmDialog		= <?php if ($this->_tpl_vars['settings']['show_delete_confirm_dialog'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.truncateTitle				= <?php if ($this->_tpl_vars['settings']['truncate_title'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showAMPM						= <?php if ($this->_tpl_vars['settings']['show_am_pm'] == 'on'): ?>true<?php else: ?>false<?php endif; ?>;
	
    MyCalendar.weekViewType					= '<?php echo $this->_tpl_vars['settings']['week_view_type']; ?>
';
	MyCalendar.dayViewType					= '<?php echo $this->_tpl_vars['settings']['day_view_type']; ?>
';
	MyCalendar.defaultView					= '<?php echo $this->_tpl_vars['settings']['default_view']; ?>
';
	MyCalendar.showViewType					= '<?php echo $this->_tpl_vars['settings']['show_view_type']; ?>
';
	MyCalendar.editdialogColorpickerType	= '<?php echo $this->_tpl_vars['settings']['editdialog_colorpicker_type']; ?>
';
	MyCalendar.truncateLength				= <?php echo $this->_tpl_vars['settings']['truncate_length']; ?>
;
	MyCalendar.editdialogTimepickerType		= '<?php echo $this->_tpl_vars['settings']['editdialog_timepicker_type']; ?>
';
    
    MyCalendar.showMonthViewButton			= <?php if (@SHOW_MONTH_VIEW_BUTTON): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showWeekViewButton			= <?php if (@SHOW_WEEK_VIEW_BUTTON): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showDayViewButton			= <?php if (@SHOW_DAY_VIEW_BUTTON): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showAgendaViewButton			= <?php if (@SHOW_AGENDA_VIEW_BUTTON): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showTitleFirst				= <?php if (@SHOW_TITLE_FIRST): ?>true<?php else: ?>false<?php endif; ?>;
	
	MyCalendar.defaultTimeForEvent			= '<?php echo @DEFAULT_TIME_FOR_EVENT; ?>
';
	MyCalendar.MouseoverWidth				= '<?php echo @MOUSEOVER_WIDTH; ?>
';
	MyCalendar.showPhoneInMouseover			= <?php if (@SHOW_PHONE_IN_MOUSEOVER): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showUrlInMouseover			= <?php if (@SHOW_URL_IN_MOUSEOVER): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.onlyShowMouseoverInMonthview	= <?php if (@ONLY_SHOW_MOUSEOVER_IN_MONTH_VIEW): ?>true<?php else: ?>false<?php endif; ?>;

	MyCalendar.showSearchBox				= <?php if (@SHOW_SEARCH_BOX): ?>true<?php else: ?>false<?php endif; ?>;
	
	MyCalendar.useHtmlEditor				= <?php if (@USE_HTML_EDITOR): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.loggedInUser					= <?php if ($this->_tpl_vars['user_id'] !== null): ?><?php echo $this->_tpl_vars['user_id']; ?>
<?php else: ?>''<?php endif; ?>;
	MyCalendar.isOwner						= <?php if ($this->_tpl_vars['is_owner']): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.isAdmin						= <?php if ($this->_tpl_vars['is_admin']): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.isSuperAdmin					= <?php if ($this->_tpl_vars['is_super_admin']): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.showMouseoverDeleteButton	= <?php if (@SHOW_MOUSEOVER_DELETE_BUTTON): ?>true<?php else: ?>false<?php endif; ?>;
	MyCalendar.dialogsResizable				= <?php if (@DIALOGS_RESIZABLE): ?>true<?php else: ?>false<?php endif; ?>;

	MyCalendar.gotoYear 					= '<?php echo $this->_tpl_vars['gotoYear']; ?>
';
	MyCalendar.gotoMonth 					= '<?php echo $this->_tpl_vars['gotoMonth']; ?>
';	// 0 based, jan = 0
	MyCalendar.gotoDay						= '<?php echo $this->_tpl_vars['gotoDay']; ?>
';

    MyCalendar.touchfriendly_drag_events    = <?php if (@TOUCHFRIENDLY_DRAG_EVENTS): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.touchfriendly_select_daycells = <?php if (@TOUCHFRIENDLY_SELECT_DAYCELLS): ?>true<?php else: ?>false<?php endif; ?>;
   
    MyCalendar.showFileUpload               = <?php if (@SHOW_FILE_UPLOAD): ?>true<?php else: ?>false<?php endif; ?>;
    MyCalendar.maxEventFileUpload           = <?php if (@MAX_EVENT_FILE_UPLOAD !== null): ?><?php echo @MAX_EVENT_FILE_UPLOAD; ?>
<?php else: ?>10<?php endif; ?>;
    
    MyCalendar.FCfirstDay                   = <?php echo @FIRSTDAY_OF_WEEK; ?>
;
    MyCalendar.FCfirstHour                  = <?php echo @FIRST_SCROLL_HOUR; ?>
;
    MyCalendar.FCminTime                    = <?php echo @MIN_VISIBLE_TIME; ?>
;
    
	function DropDown(el) {
		this.dd = el;
		this.initEvents();
	}
	DropDown.prototype = {
		initEvents : function() {
			var obj = this;

			$('#dd').click( function(event){
				$(this).toggleClass('active');
				event.stopPropagation();
			});
		}
	}

	$(function() {
		var dd = new DropDown( $('#dd') );
		$(document).click(function() {
			// all dropdowns
			$('.wrapper-dropdown-5').removeClass('active');
		});
	});

    $(document).ready(function() {
        $('#print_btn').click(function() {
           //$('#calendar').fullCalendar('render');
            window.print();
        });
       
    });
</script>

<script type='text/javascript' src='<?php echo @FULLCAL_URL; ?>
/script/script.js'></script>
<script type='text/javascript' src='<?php echo @FULLCAL_URL; ?>
/script/listeners.js'></script>
<script type='text/javascript' src='<?php echo @FULLCAL_URL; ?>
/script/lang<?php echo $this->_tpl_vars['settings']['language']; ?>
.js'></script>

<script type='text/javascript' src='<?php echo @EXTERNAL_URL; ?>
/dateformat.js'></script>

<script type='text/javascript' src='<?php echo @EXTERNAL_URL; ?>
/fullcalendar-1.6.4/fullcalendar/fullcalendar.js'></script>

<script type='text/javascript' src='<?php echo @EXTERNAL_URL; ?>
/simple_colorpicker.js'></script>

<?php if ($this->_tpl_vars['settings']['editdialog_timepicker_type'] == 'simple'): ?>
	<script type='text/javascript' src='<?php echo @EXTERNAL_URL; ?>
/jquery-timepicker-1.3.2/jquery.timepicker.min.js'></script>
<?php else: ?>
	<script type='text/javascript' src='<?php echo @EXTERNAL_URL; ?>
/jquery/jquery-ui-timepicker-0.3.3/jquery.ui.timepicker.js'></script>
<?php endif; ?>

<link type="text/css" rel="stylesheet" href="<?php echo @EXTERNAL_URL; ?>
/dropdown/css/style.css" />
<script type="text/javascript" src="<?php echo @EXTERNAL_URL; ?>
/dropdown/mo.js"></script>

</head>

<body style="margin: 0 auto;width:100%;">
<?php 

$_SESSION['order_id']  = $_GET['order_id']; ?>
<div class="container" style="">
	<div style="">
	<!--<span id="calendar-title"><?php echo @CALENDAR_TITLE; ?>
</span>
		<div style="float:left;width: 20%;padding-left:10px;max-width:140px;padding-top: 2px;">
			<?php if (isset ( $this->_tpl_vars['user'] ) && ! empty ( $this->_tpl_vars['user'] )): ?>

				<span id="dd" class="wrapper-dropdown-5" tabindex="1" style="line-height: 24px;"><?php echo $this->_tpl_vars['user']; ?>

				<ul class="dropdown">
                    <li><a href="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=get_profile&uid=<?php echo $this->_tpl_vars['user_id']; ?>
"><i class="icon-user"></i><span id="menu_to_profile">Profile</span></a></li>

				<?php if ($this->_tpl_vars['is_admin']): ?>
					<li><a href="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=new_user"><i class="icon-plus"></i><span id="menu_add_user">Add user</span></a></li>
					<li><a href="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=quick_new_user"><i class="icon-plus"></i><span id="menu_quick_add_user">Quickly add user</span></a></li>
					<li><a id="to_admin_area" href="<?php echo @FULLCAL_URL; ?>
/admin"><i class="icon-th-large"></i>Admin dashboard</a></li>
                    <li><a href="<?php echo @FULLCAL_URL; ?>
/admin/settings"><i class="icon-cog"></i><span id="menu_settings">Settings</span></a></li>
                <?php else: ?>
                    <li><a href="<?php echo @FULLCAL_URL; ?>
/user/settings"><i class="icon-cog"></i><span id="menu_settings">Settings</span></a></li>
                    <?php if (@USERS_CAN_ADD_CALENDARS): ?>
                        <li><a href="<?php echo @FULLCAL_URL; ?>
/user/calendars"><i class="icon-list"></i><span id="menu_my_calendars">My calendars</span></a></li>
                    <?php endif; ?>
                <?php endif; ?>

				

				<li><a href="?action=logoff"><i class="icon-close"></i><span id="menu_logout">Log out</span></a></li>
				</ul>
				<span class="right-arrow"></span>
				</span>
			<?php else: ?>
				<?php if (@ALLOW_ACCESS_BY == 'login' || @ALLOW_ACCESS_BY == 'free'): ?>
					<?php if (@SHOW_SMALL_LOGIN_LINK): ?>
						<a style="line-height: 24px;" class="button-fc-like" href="<?php echo @FULLCAL_URL; ?>
?action=login">Log in</a>
						<?php if (@USERS_CAN_REGISTER): ?>
							<a href="<?php echo @FULLCAL_URL; ?>
/register">Register</a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
           			
		</div>
		
		<?php if (@SHOW_SEARCH_BOX): ?>
		<div id="searchbox_and_buttons">
			<a style="float:right;margin-right: 10px;line-height: 17px !important;" class="button-fc-like" id="print_btn" href="#"><i class="icon-print"></i> Print</a>
			<form method="POST" action="<?php echo @FULLCAL_URL; ?>
/?action=search" style="float:right;padding-right: 10px;">
				<input type="text" name="sq" style="height:19px;width:150px;" id="cal_q_field" class="rounded-left" value="<?php if (isset ( $this->_tpl_vars['q'] )): ?><?php echo $this->_tpl_vars['q']; ?>
<?php endif; ?>" />
				<input type="submit" onclick="if($('#cal_q_field').val() == '') {return false;}" class="rounded-right button-fc-like" unselectable="on" style="-moz-user-select: none;" value="Search" />
				<input type="submit" onclick="$('#cal_q_field').val('');return false;"  class="rounded button-fc-like" unselectable="on" style="-moz-user-select: none;" value="X" />
				<input type="hidden" id="searchbox_cal_id" name="cal_id" />
			</form>
             
		</div>-->
		<?php endif; ?>


	<div style="padding-bottom:30px;clear:both;">
		<div id='external-events'>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@FULLCAL_DIR)."/view/leftblocks/calendars.html", 'smarty_include_vars' => array('my_active_calendars' => $this->_tpl_vars['my_active_calendars'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if (isset ( $this->_tpl_vars['my_active_calendars'] ) && ! empty ( $this->_tpl_vars['my_active_calendars'] )): ?>
				<div id="dragdrop_events" >
					<?php $_from = $this->_tpl_vars['my_active_calendars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<div id="ext_item_<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
" style="display:none;padding-bottom:10px;" class="ext_item">
						<?php $_from = $this->_tpl_vars['item']['dditems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
                        <div style="border:1px solid #8f8f8f;background-color:<?php if (! empty ( $this->_tpl_vars['i']['color'] )): ?><?php echo $this->_tpl_vars['i']['color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['calendar_color']; ?>
<?php endif; ?>;" class="rightarrowdiv external-event" cal_id="<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
" color="<?php if (! empty ( $this->_tpl_vars['i']['color'] )): ?><?php echo $this->_tpl_vars['i']['color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['calendar_color']; ?>
<?php endif; ?>" alt="<?php echo $this->_tpl_vars['i']['info']; ?>
" title="<?php echo $this->_tpl_vars['i']['info']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</div>
						<?php endforeach; endif; unset($_from); ?>
						</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
			<?php endif; ?>

			
		</div>

		<div id='calendar' style="width:83%;position:absolute;top:80px;left:180px;padding-bottom:30px;min-width:520px;">
            <span id="cal_message"></span>
			<span id="cal_error"></span>

			<span id="loading">loading...</span>
		</div>

	</div>
     
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@FULLCAL_DIR)."/view/dialogs/dlg_event_edit.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@FULLCAL_DIR)."/view/dialogs/dlg_profile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php if ($this->_tpl_vars['is_admin'] || $this->_tpl_vars['is_super_admin']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@FULLCAL_DIR)."/view/dialogs/dlg_adduser.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@FULLCAL_DIR)."/view/dialogs/dlg_calendars.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php endif; ?>


	<div id="dialog-delete-prompt" title="" style="display: none;"><span id="delete_one_or_all_label_id">&nbsp;</span></div>
	<div id="dialog-update-prompt" title="" style="display: none;"><span id="update_repair_label_id">&nbsp;</span></div>

</div>
<script>
	localStorage.setItem('order_id',<?php echo $_GET['order_id']; ?>);
</script>
<style>
.fc-event-inner.current{
	background-color:green;
}
.fc-event-tech {
    color: #ffff1c;
}
</style>
</body>
</html>