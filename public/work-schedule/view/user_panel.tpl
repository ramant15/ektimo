<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?smarty $smarty.const.CALENDAR_TITLE ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?smarty $smarty.const.CALENDAR_TITLE ?>">
		<meta name="author" content="">

		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link href="<?smarty $smarty.const.EXTERNAL_URL ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css' />
		
		<link rel="shortcut icon" href="/favicon.ico">

		<!-- Added library to header in order to load reports-->
		<script src="<?smarty $smarty.const.EXTERNAL_URL ?>/jquery/jquery.1.11.1.min.js"></script>
		<script src="<?smarty $smarty.const.EXTERNAL_URL ?>/jquery/jquery-ui.1.11.1.min.js" type="text/javascript" charset="utf-8"></script>

		<script src='<?smarty $smarty.const.EXTERNAL_URL ?>/bgrins-spectrum/spectrum.js'></script>
		<link rel='stylesheet' href='<?smarty $smarty.const.EXTERNAL_URL ?>/bgrins-spectrum/spectrum.css' />
		
		<script type='text/javascript' src='<?smarty $smarty.const.FULLCAL_URL ?>/script/listeners.js'></script>
        <script type='text/javascript' src='<?smarty $smarty.const.FULLCAL_URL ?>/script/lang<?smarty if isset($settings.language) ?><?smarty $settings.language ?><?smarty else ?><?smarty $language ?><?smarty /if ?>.js'></script>


		<style>
			::-webkit-input-placeholder {
			    color: red;
			}
			:-moz-placeholder {
			    color: #acacac !important;
			}
			::-moz-placeholder {
			    color: #acacac !important;
			} /* for the future */
			:-ms-input-placeholder {
			    color: #acacac !important;
			}
		</style>

        <script type='text/javascript'>
			MyCalendar = {};
			
		</script>
	</head>

	<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">

                    <a class="brand" href="#">Dashboard</a>
					<a style="float:left;padding-top:17px;color:#777777;" href="<?smarty $smarty.const.FULLCAL_URL ?>">Calendar</a>
                    <span style="float:right;padding-top:17px;"><?smarty $name ?></span>
                 	
				</div>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">

			<div class="span12">
				<div class="tabbable tabs-left">

					<ul class="nav nav-tabs">

						<li <?smarty if $active == "profile" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/user/?action=get_profile&uid=<?smarty $user_id ?>" ><i class="icon-user"></i> Profile</a></li>

                        <?smarty if $smarty.const.USERS_CAN_ADD_CALENDARS ?>
                            <li <?smarty if $active == "calendars" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars"><i class="icon-list"></i> My calendars</a></li>
                            <?smarty if $active == "calendar" ?><li class="active"><a href="#calendar" data-toggle="tab"><i class="icon-calendar"></i> Calendar</a></li><?smarty /if ?>

                            <!--<li <?smarty if $active == "public_calendars" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars/public"><i class="icon-list"></i> Public calendars</a></li>-->
						<?smarty /if ?>
                        
						<li <?smarty if $active == "settings" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/<?smarty if $is_user ?>user/settings<?smarty /if ?>"><i class="icon-cog"></i> Settings</a></li>
					</ul>

					<div class="tab-content">


					<?smarty if $active == 'user' ?>
						<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
							User dashboard
						</div>

					<?smarty elseif $active == 'profile' ?>
						<div id="admin-user-profile" style="padding-top:20px;padding-left:20px;">
							<legend>Profile</legend>

							<?smarty if !empty($save_profile_error) ?>
							<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
								<?smarty $save_profile_error ?>
							</div>
							<?smarty /if ?>

							<?smarty if !empty($save_profile_success) ?>
							<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
								<?smarty $save_profile_success ?>
							</div>
							<?smarty /if ?>

							<form action="<?smarty $smarty.const.FULLCAL_URL ?><?smarty if $is_user ?>/user<?smarty else ?>/admin/users<?smarty /if ?>/?action=save_profile" method="post" class="form-horizontal">

								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">Name </label>
									<div class="controls">
										<input style="width:94px;" type="text" class="input-xlarge" id="profile_firstname" name="firstname" placeholder="Firstname" value="<?smarty $profile.firstname ?>">
										<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>
											<input style="width:30px;" type="text" class="input-xlarge" id="profile_infix" name="infix" value="<?smarty $profile.infix ?>">
										<?smarty /if ?>
										<input style="width:<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>110<?smarty else ?>152<?smarty /if ?>px;" type="text" class="input-xlarge" id="profile_lastname" name="lastname" placeholder="Lastname" value="<?smarty $profile.lastname ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_email" class="control-label">Birthdate </label>
									<div class="controls">
									<?smarty if $smarty.const.DATEPICKER_DATEFORMAT == 'dd/mm/yy' ?>
										<input style="width:25px;" type="text" placeholder="DD" class="input-xlarge" id="profile_birthdate_day" name="birthdate_day" value="<?smarty $profile.birthdate_day ?>">
										<input style="width:25px;" type="text" placeholder="MM" class="input-xlarge" id="profile_birthdate_month" name="birthdate_month" value="<?smarty $profile.birthdate_month ?>">

									<?smarty else ?>
										<input style="width:25px;" type="text" placeholder="MM" class="input-xlarge" id="profile_birthdate_month" name="birthdate_month" value="<?smarty $profile.birthdate_month ?>">
										<input style="width:25px;" type="text" placeholder="DD" class="input-xlarge" id="profile_birthdate_day" name="birthdate_day" value="<?smarty $profile.birthdate_day ?>">

									<?smarty /if ?>
									<input style="width:45px;" type="text" placeholder="YYYY" class="input-xlarge" id="profile_birthdate_year" name="birthdate_year" value="<?smarty $profile.birthdate_year ?>">

									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">Country </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_country" name="country" value="<?smarty $profile.country ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">Email </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_email" name="email" value="<?smarty $profile.email ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">Username </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_username" name="username" value="<?smarty $profile.username ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">New password </label>
									<div class="controls">
										<input type="password" autocomplete="off" class="input-xlarge" id="profile_password" name="password" placeholder="Leave blank for no change">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">New password again <a tabindex="99" ></label>
									<div class="controls">
										<input type="password" autocomplete="off" class="input-xlarge" id="profile_confirm" name="confirm" placeholder="Leave blank for no change">
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?smarty $profile.user_id ?>" />
									<div class="form-actions">
										<button id="save-profile" class="btn btn-primary" name="save-profile" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
									</div>

							</form>


							</div>

					<?smarty elseif $active == 'calendars' ?>
							<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
								<?smarty if !empty($error) ?>
								<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
									<?smarty $error ?>
								</div>
								<?smarty /if ?>

								<?smarty if !empty($msg) ?>
								<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
									<?smarty $msg ?>
								</div>
								<?smarty /if ?>


								<form id="calendars-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars/?action=new_calendar" method="post" class="form-horizontal">
									<?smarty if isset($smarty.session.add_calendar_error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $smarty.session.add_calendar_error ?>
									</div>
									<?smarty /if ?>

									<div style="float:right;">
										<button id="user-add-calendar-btn" class="btn btn-primary" name="add-calendar" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add calendar</button>
									</div>

								</form>

								<legend>My calendars</legend>

								<div id="calendar_list">
									<table class="table" style="font-size:14px;">
										<thead>
											<tr>
												<th colspan="4"></th>
												<th style="text-align:center;" colspan="4">Others can</th>
												<th colspan="2"></th>
											</tr>
										</thead>
                                        <thead>
											<tr>
												<th style="border-top:0 none;"></th>
												<th style="border-top:0 none;">Name</th>
												<th style="border-top:0 none;">DD-items</th>
												<th style="border-top:0 none;">Type</th>
												<th style="text-align:center;border-top:1px dotted lightgray;">Add</th>
												<th style="text-align:center;border-top:1px dotted lightgray;">Edit</th>
												<th style="text-align:center;border-top:1px dotted lightgray;">Delete</th>
												<th style="text-align:center;border-top:1px dotted lightgray;width:45px;">Change color</th>
												<th style="text-align:center;border-top:0 none;">Initial show</th>
												<th style="text-align:center;border-top:0 none;">Active</th>
												<th style="border-top:0 none;">CreatorID</th>

											</tr>
										</thead>
										<tbody>

										<?smarty foreach from=$calendars item=item ?>

											<tr>
												<td style="width:10px;background-color:<?smarty $item.calendar_color ?>;"></td>
												<td><?smarty $item.name ?></a></td>
												<td><?smarty $item.dditems|@count ?></td>
												<td><?smarty if $item.share_type == "private" ?>Private (only me)<?smarty else ?><?smarty $item.share_type ?><?smarty /if ?></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_add ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_edit ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_delete ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_change_color ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.initial_show ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.active == 'yes' ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td><?smarty $item.creator_id ?></td>

                                                <?smarty if $item.deleted == 0 ?>
                                                    <td class="not_print"><a class="edit_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars?action=get_calendar&cid=<?smarty $item.calendar_id ?>">Edit</a></td>
                                                    <?smarty if $user_id == $item.creator_id ?><td class="not_print"><a class="delete_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars?action=delete&cid=<?smarty $item.calendar_id ?>">Delete</a></td><?smarty else ?><td>&nbsp;</td><?smarty /if ?>
                                                <?smarty else ?>
                                                    <?smarty if $user_id == $item.creator_id ?><td class="not_print"><a class="undo_delete_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars?action=undelete&cid=<?smarty $item.calendar_id ?>">Undo delete</a></td><?smarty else ?><td>&nbsp;</td><?smarty /if ?>
                                                
                                                <?smarty /if ?>
                                                
												
											</tr>
										<?smarty /foreach ?>

										</tbody>
									</table>

                                    <?smarty if empty($calendars) ?>
                                        No calendars found
                                    <?smarty /if ?>
								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars?to=<?smarty $from ?>"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>

					<?smarty elseif $active == 'public_calendars' ?>
							<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
								<?smarty if !empty($error) ?>
								<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
									<?smarty $error ?>
								</div>
								<?smarty /if ?>

								<?smarty if !empty($msg) ?>
								<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
									<?smarty $msg ?>
								</div>
								<?smarty /if ?>


								<form id="calendars-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars/?action=new_calendar" method="post" class="form-horizontal">
									<?smarty if isset($smarty.session.add_calendar_error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $smarty.session.add_calendar_error ?>
									</div>
									<?smarty /if ?>

									<div style="float:right;">
										<button id="user-add-calendar-btn" class="btn btn-primary" name="add-calendar" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add calendar</button>
									</div>

								</form>

								<legend>Public calendars</legend>

								<div id="calendar_list">
									<table class="table" style="font-size:14px;">
										<thead>
											<tr>
												<th></th>
												<th>Name</th>
												<th>Active</th>
												

											</tr>
										</thead>
										<tbody>

										<?smarty foreach from=$calendars item=item ?>

											<tr>
												<td style="width:10px;background-color:<?smarty $item.calendar_color ?>;"></td>
												<td><?smarty $item.name ?></a></td>
												<td><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.active ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												

												<td><a href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars/public/?action=set_active&cid=<?smarty $item.calendar_id ?>">Set active</a></td>
												
											</tr>
										<?smarty /foreach ?>

										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars?to=<?smarty $from ?>"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>

					
                    <?smarty elseif $active == 'calendar' ?>
						<div id="admin-user-calendar" style="padding-top:20px;padding-left:20px;">
							<legend><?smarty if isset($smarty.get.action) && $smarty.get.action == 'new_calendar' ?>Add calendar<?smarty else ?>Edit calendar: <strong><?smarty $calendar.name ?></strong><?smarty /if ?></legend>

							<?smarty if !empty($save_calendar_error) ?>
							<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
								<?smarty $save_calendar_error ?>
							</div>
							<?smarty /if ?>

							<?smarty if !empty($save_calendar_success) ?>
							<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
								<?smarty $save_calendar_success ?>
							</div>
							<?smarty /if ?>

							<form action="<?smarty $smarty.const.FULLCAL_URL ?>/user/calendars/?action=save_calendar" method="post" class="form-horizontal">

								<div class="control-group">
									<label for="admin_user_calendar_active" class="control-label">Active </label>
									<div class="controls"  style="padding-top:5px;">
                                        <span>
                                            <input type="radio" value="yes" name="active"  style="float:left;margin-right:5px;" id="admin_calendar_active_yes" <?smarty if $calendar.active == 'yes' || !isset($calendar.active) || empty($calendar.active) ?>checked="true"<?smarty /if ?> /><label for="admin_calendar_active_yes" style="padding-top:1px;width: 33px;float:left;padding-right:20px;">Yes </label>
                                            <input type="radio" value="no" name="active"  style="float:left;margin-right:5px;" <?smarty if $calendar.active == 'no' ?>checked="true"<?smarty /if ?> /><label for="admin_calendar_active_yes" style="padding-top:1px;width: 33px;float:left;padding-right:20px;">No </label>
                                            <input type="radio" value="period" id="radio_specific_period" name="active"  style="float:left;margin-right:5px;" <?smarty if $calendar.active == 'period' ?>checked="true"<?smarty /if ?> /><label for="admin_calendar_active_yes" style="padding-top:1px;width: 200px;float:left;padding-right:20px;">In specific period </label>
									    </span>
                                    </div>
								</div>
                               
                                <!-- active period -->
                                <div class="control-group">
                                    <label for="admin_calendar_active" class="control-label">Active period </label>
									<span class="simple_starttime_label" style="padding-left:20px;margin-bottom: 0;">From: </span>
                                    <input type="text" name="cal_startdate" id="active_period_datepicker_startdate" value="<?smarty $calendar.cal_startdate ?>" <?smarty if $calendar.active != 'period' ?>disabled="disabled"<?smarty /if ?> style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;z-index:9999;">
                                    <span class="simple_endtime_label">Until: </span>
                                        <input type="text" name="cal_enddate" id="active_period_datepicker_enddate" value="<?smarty $calendar.cal_enddate ?>" <?smarty if $calendar.active != 'period' ?>disabled="disabled"<?smarty /if ?> style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;" />
                                </div>
                                
                                <!-- alterable period restriction -->
                                <div class="control-group">
                                    <label for="admin_calendar_alterable" class="control-label">Alterable period </label>
									<span class="simple_starttime_label" style="padding-left:20px;margin-bottom: 0;">From: </span>
                                        <input type="text" name="alterable_startdate" id="alterable_period_datepicker_startdate" value="<?smarty $calendar.alterable_startdate ?>" style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;z-index:9999;">
                                    <span class="simple_endtime_label">To: </span>
                                        <input type="text" name="alterable_enddate" id="alterable_period_datepicker_enddate" value="<?smarty $calendar.alterable_enddate ?>" style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;" />
                                </div>
                                
                                <div class="control-group">
									<label for="admin_user_calendar_name" class="control-label">Name </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="calendar_name" name="name" placeholder="Name" value="<?smarty $calendar.name ?>">
									</div>
								</div>

								<!--<div class="control-group">
									<label for="admin_user_calendar_share_type" class="control-label">Type </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="calendar_type" name="country" value="<?smarty $calendar.share_type ?>">
									</div>
								</div>-->

								<div class="control-group">
									<label for="user_calendar_dditems" class="control-label">DD-items </label>
									<div class="controls">
										<!--<textarea class="input-xlarge" id="calendar_dditems" name="dditems" ><?smarty $calendar.dditems ?></textarea>-->
                                        <input type="hidden" id="calendar_dditems" name="dditems" value="<?smarty $str_dditems ?>" />
									
                                        <table class="table" style="font-size:14px;width:510px;font-size:13px;margin-bottom:0;">
                                            <thead>
                                                <tr style="">
                                                    <th style="width:50px;border-top:0 none;">Title</th>
                                                    <th style="width:50px;border-top:0 none;">Info</th>
                                                    <th style="width:50px;border-top:0 none;">Color</th>
                                               </tr>
                                            </thead>
                                            <tbody>

                                            <?smarty foreach from=$calendar.dditems item=item ?>
                                                <tr>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" name="title<?smarty $item.dditem_id ?>" value="<?smarty $item.title ?>" class="user-dditem-title" id="user-spectrum-colorpicker-dditem-title-<?smarty $item.dditem_id ?>" /></td>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" name="info<?smarty $item.dditem_id ?>" value="<?smarty $item.info ?>" class="user-dditem-info" id="user-dditem-info-<?smarty $item.dditem_id ?>" /></td>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" class="input-xlarge user-spectrum-colorpicker-dditems" id="user-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>" name="dditem_color[]" value="<?smarty $item.color ?>" data-title="<?smarty $item.title ?>" data-number="<?smarty $item.dditem_id ?>"></td>
                                                </tr>
                                               
                                            <?smarty /foreach ?>

                                            </tbody>
                                        </table>
                                       <input type="button" id="add_dditem" value="Add a DD-item" />
                                    </div>
								</div>
                                <div class="control-group">
									<label for="user_settings_share_type" class="control-label" id="admin_settings_share_type_label">Share type </label>
									<div class="controls">
										
										<select name="share_type" id="user_settings_share_type">
											<option value="public" <?smarty if $calendar.share_type == "public" ?>selected="selected"<?smarty /if ?>>Public</option>
											<option value="private" <?smarty if $calendar.share_type == "private" ?>selected="selected"<?smarty /if ?>>Private (only for me)</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="user_calendar_canadd" class="control-label">Others can add </label>
									<div class="controls">
										<input type="checkbox" name="can_add" id="user_settings_can_add" <?smarty if $calendar.can_add && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="user_calendar_canedit" class="control-label">Others can edit </label>
									<div class="controls">
										<input type="checkbox" name="can_edit" id="user_settings_can_edit" <?smarty if $calendar.can_edit && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> />
									</div>
								</div>
                                <div class="control-group">
									<label for="user_calendar_candelete" class="control-label">Others can delete </label>
									<div class="controls">
										<input type="checkbox" name="can_delete" id="user_settings_can_delete" <?smarty if $calendar.can_delete && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> />
									</div>
								</div>
                                <div class="control-group">
									<label for="user_calendar_canchange_color" class="control-label">Others can change color </label>
									<div class="controls">
										<input type="checkbox" id="user_settings_can_change_color" name="can_change_color" <?smarty if $calendar.can_change_color && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> <?smarty if $calendar.share_type == "private" ?>disabled="disabled"<?smarty /if ?> />
									</div>
								</div>
                                
								<div class="control-group">
									<label for="admin_user_calendar_default" class="control-label">Default </label>
									<div class="controls">
										<input type="checkbox" name="initial_show" <?smarty if $calendar.initial_show ?>checked="true"<?smarty /if ?> /> 
                                        <span id="user_initial_show_checkbox_label" style="padding-top:5px;vertical-align:middle;">The calendar is shown initially</span>
                                    </div>
								</div>

								<div class="control-group">
									<label for="admin_user_calendar_color" class="control-label">Color </label>
									<div class="controls" style="width:150px;">
										<input type="text" class="input-xlarge" id="user-spectrum-colorpicker" name="calendar_color" value="<?smarty $calendar.calendar_color ?>">
									</div>
								</div>

								<div class="control-group" id="color_change_all_events" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="checkbox_use_color_for_all_events" />
										<span id="admin_color_use_for_all_events_checkbox_label" style="padding-top:5px;vertical-align:middle;">Use current color for all the events of this calendar</span>
									</div>
								</div>

								<input type="hidden" name="calendar_id" value="<?smarty $calendar.calendar_id ?>" />
									<div class="form-actions">
										<button id="save-calendar" class="btn btn-primary" name="save-calendar" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
									</div>

							</form>


							</div>


					<?smarty elseif $active == 'settings' ?>
						<div id="user-settings" style="padding-top:20px;padding-left:20px;">
							<legend>Settings</legend>

							<?smarty if !empty($save_settings_error) ?>
							<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
								<?smarty $save_settings_error ?>
							</div>
							<?smarty /if ?>

							<?smarty if !empty($save_settings_success) ?>
							<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
								<?smarty $save_settings_success ?>
							</div>
							<?smarty /if ?>


							<form action="<?smarty $smarty.const.FULLCAL_URL ?>/user/settings/?action=save_settings" method="post" class="form-horizontal">

								<div class="control-group">
									<label for="user_settings_default_view" class="control-label">Default calendar view </label>
									<div class="controls">
										<!-- month, basicWeek, agendaWeek, basicDay, agendaDay , agendaList-->
										<select name="default_view">
											<option value="month" <?smarty if $settings.default_view == "month" ?>selected="selected"<?smarty /if ?>>month</option>
											<option value="agendaWeek" <?smarty if $settings.default_view == "agendaWeek" ?>selected="selected"<?smarty /if ?>>week</option>
											<option value="agendaDay" <?smarty if $settings.default_view == "agendaDay" ?>selected="selected"<?smarty /if ?>>day</option>
											<option value="agendaList" <?smarty if $settings.default_view == "agendaList" ?>selected="selected"<?smarty /if ?>>list</option>
										</select>
									</div>
								</div>

                                <div class="control-group">
									<label for="user_settings_week_view_type" class="control-label" id="user_settings_week_view_type_label">Weekview type </label>
									<div class="controls">
										<!-- basicWeek, agendaWeek -->
										<select name="week_view_type">
											<option value="agendaWeek" <?smarty if $settings.week_view_type == "agendaWeek" ?>selected="selected"<?smarty /if ?>>Agenda week</option>
											<option value="basicWeek" <?smarty if $settings.week_view_type == "basicWeek" ?>selected="selected"<?smarty /if ?>>Basic week</option>
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="user_settings_day_view_type" class="control-label" id="user_settings_day_view_type_label">Dayview type </label>
									<div class="controls">
										<!-- basicDay, agendaDay -->
										<select name="day_view_type">
											<option value="agendaDay" <?smarty if $settings.day_view_type == "agendaDay" ?>selected="selected"<?smarty /if ?>>Agenda day</option>
											<option value="basicDay" <?smarty if $settings.day_view_type == "basicDay" ?>selected="selected"<?smarty /if ?>>Basic day</option>
										</select>
									</div>
								</div>
                                
								<div class="control-group">
									<label for="user_settings_language" class="control-label">Language </label>
									<div class="controls">
										<select name="language">
											<?smarty foreach from=$current_languages name="current_languages" item=item key=key ?>
                                            <option value="<?smarty $key ?>" <?smarty if $settings.language == $key ?>selected="selected" checked="checked"<?smarty /if ?>><?smarty $item ?></option>
                                            <?smarty /foreach ?>
										</select>
									</div>
								</div>

                                <div class="control-group">
									<label for="user_settings_other_language_label_id" class="control-label" id="user_settings_other_language_label">Other language </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="other_language" value="<?smarty $settings.other_language ?>" /> Two capital characters (eg. EN, ES, DE) - <strong>Custom lang**.js is required in script folder</strong>
									</div>
								</div>
                                
                                <div class="control-group" id="user_settings_show_am_pm" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_am_pm" <?smarty if $settings.show_am_pm == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="user_show_am_pm_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show AM/PM</span>
									</div>
								</div>
                                <div class="control-group" id="user_settings_show_weeknumbers" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_weeknumbers" <?smarty if $settings.show_weeknumbers == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="user_show_weeknumbers_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show weeknumbers</span>
									</div>
								</div>
                                <div class="control-group" id="user_settings_show_notallowed_messages" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_notallowed_messages" <?smarty if $settings.show_notallowed_messages == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="user_show_notallowed_messages_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show "not allowed" messages</span>
									</div>
								</div>
                                
                                <div class="control-group">
									<label for="user_settings_preview_type" class="control-label" id="user_settingsshow_view_type_label">Mouseover popup </label>
									<div class="controls">
										<select name="show_view_type">
											<option value="mouseover" <?smarty if $settings.show_view_type == "mouseover" ?>selected="selected"<?smarty /if ?>>Mouseover</option>
											<option value="none" <?smarty if $settings.show_view_type == "none" ?>selected="selected"<?smarty /if ?>>None</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group" id="user_settings_truncate_title" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="truncate_title" <?smarty if $settings.truncate_title == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="user_truncate_title_checkbox_label" style="padding-top:5px;vertical-align:middle;">Truncate title</span>
									</div>
								</div>
                                <div class="control-group">
									<label for="user_settings_truncate_length_label_id" class="control-label" id="user_settings_truncate_length_label">Title length </label>
									<div class="controls">
										<input type="text" class="input-xlarge" style="width:30px;" name="truncate_length" value="<?smarty $settings.truncate_length ?>" /> Amount of characters
									</div>
								</div>
                                <div class="control-group" id="user_settings_show_public_and_private_separately" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_public_and_private_separately" <?smarty if $settings.show_public_and_private_separately == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="user_show_public_and_private_separately_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show public and private calendarbuttons separately</span>
                                    </div>
                                </div>
                                
                                <?smarty if $smarty.const.USERS_CAN_ADD_CALENDARS ?>
                                                                
                                <?smarty /if ?>
                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:normal;">Edit dialog:</h4>
                                
                                <div class="control-group" id="user_settings_show_description_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_description_field" <?smarty if $settings.show_description_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="user_show_description_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show description field</span>
                                    </div>
                                </div><div class="control-group" id="user_settings_show_location_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_location_field" <?smarty if $settings.show_location_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="user_show_location_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show location field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="user_settings_show_phone_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_phone_field" <?smarty if $settings.show_phone_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="user_show_phone_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show phone field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="user_settings_show_url_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_url_field" <?smarty if $settings.show_url_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="user_show_url_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show url field</span>
                                    </div>
                                </div>
                                
								<input type="hidden" name="user_id" value="<?smarty $user_id ?>" />
								<div class="form-actions">
									<button id="user-save-settings" class="btn btn-primary" name="save-settings" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
								</div>
							</form>
						</div>

					<?smarty /if ?>

				</div>
			</div>
		</div>
	</div>

    <script type="text/javascript">
		MyCalendar.datePickerDateFormat 		= '<?smarty $smarty.const.DATEPICKER_DATEFORMAT ?>';
		MyCalendar.last_dditem = '';
        MyCalendar.dditem_string = '';
		
		var current_user = '<?smarty if isset($user) && isset($user.user_id) ?><?smarty $user.user_id ?><?smarty /if ?>';
		
        $(document).ready(function() {
			MyCalendar.last_dditem = '<?smarty $last_dditem ?>';
            
            $('#active_period_datepicker_startdate').val('<?smarty $calendar.cal_startdate ?>');
            $('#active_period_datepicker_enddate').val('<?smarty $calendar.cal_enddate ?>');
            
            $('#alterable_period_datepicker_startdate').val('<?smarty $calendar.alterable_startdate ?>');
            $('#alterable_period_datepicker_enddate').val('<?smarty $calendar.alterable_enddate ?>');
            
            $('input[name="active"]').change(function(t) {
                if($(this).val() == 'period') {
                    $('#active_period_datepicker_startdate').prop('disabled', false);
                    $('#active_period_datepicker_enddate').prop('disabled', false);
                } else {
                    $('#active_period_datepicker_startdate').prop('disabled', true);
                    $('#active_period_datepicker_enddate').prop('disabled', true);
                }
                
            });
            
            $('.simple_endtime_label').html(Lang.Popup.SimpleEndTimeLabel);
            $('.simple_starttime_label').html(Lang.Popup.SimpleStartTimeLabel );

            $('#user_settings_share_type').change(function(t) {
                if($(this).val() == 'private') {
                    // disable checkboxes
                    $('#user_settings_can_add').prop('disabled', true);
                    $('#user_settings_can_edit').prop('disabled', true);
                    $('#user_settings_can_delete').prop('disabled', true);
                    $('#user_settings_can_change_color').prop('disabled', true);
                    
                    $('#user_settings_can_add').attr('checked', false);
                    $('#user_settings_can_edit').attr('checked', false);
                    $('#user_settings_can_delete').attr('checked', false);
                    $('#user_settings_can_change_color').attr('checked', false);
                } else {
                    // enable checkboxes
                    $('#user_settings_can_add').prop('disabled', false);
                    $('#user_settings_can_edit').prop('disabled', false);
                    $('#user_settings_can_delete').prop('disabled', false);
                    $('#user_settings_can_change_color').prop('disabled', false);
                }
            });
		});
        
        $('.user-dditem-title').focusout(function(t) {
            MyCalendar.dditem_string = '';
            $('.user-spectrum-colorpicker-dditems').each(function(index,item) {
                var number = $(item).data('number');
                MyCalendar.dditem_string += $('#user-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#user-dditem-info-'+number).val() + '|' + $(item).val() + ',';
            });
            $('#calendar_dditems').val(MyCalendar.dditem_string);
        });
        
        $('.user-dditem-info').focusout(function(t) {
            MyCalendar.dditem_string = '';
            $('.user-spectrum-colorpicker-dditems').each(function(index,item) {
                var number = $(item).data('number');
                MyCalendar.dditem_string += $('#user-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#user-dditem-info-'+number).val() + '|' + $(item).val() + ',';
            });
            $('#calendar_dditems').val(MyCalendar.dditem_string);
        });
        
        var arr_palette = [
                ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
                ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
                ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
                ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
                ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
                ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
                ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
                ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
            ];
            
            $("#user-spectrum-colorpicker").spectrum({
			    showPaletteOnly: true,
				showPalette:true,
			    color: 'blanchedalmond',
			    palette: arr_palette,
			    change: function(color) {
				     // #ff0000
				    $("#user-spectrum-colorpicker").val(color.toHexString());
				    $("#user-spectrum-colorpicker").spectrum('hide');
				}
			});
			$("#user-spectrum-colorpicker").val('<?smarty $calendar.calendar_color ?>');
			$("#user-spectrum-colorpicker").spectrum('set', '<?smarty $calendar.calendar_color ?>');
		
        // dditems colors
            <?smarty foreach from=$calendar.dditems item=item ?>
            $("#user-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").spectrum({
			    showPaletteOnly: true,
				showPalette:true,
			    color: 'blanchedalmond',
			    palette: arr_palette,
			    change: function(color) {
				     // #ff0000
				    $("#user-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").val(color.toHexString());
				    $("#user-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").spectrum('hide');
				
                    MyCalendar.dditem_string = '';
                    $('.user-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');                
                        MyCalendar.dditem_string += $('#user-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#user-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                }
			});
            $("#user-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").val('<?smarty if $item.color !== null && !empty($item.color) ?><?smarty $item.color ?><?smarty else ?><?smarty $calendar.calendar_color ?><?smarty /if ?>');
			$("#user-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").spectrum('set', '<?smarty if $item.color !== null && !empty($item.color) ?><?smarty $item.color ?><?smarty else ?><?smarty $calendar.calendar_color ?><?smarty /if ?>');
            <?smarty /foreach ?>
            
            
            
            $('#add_dditem').click(function(t) {
                MyCalendar.last_dditem ++;
                $('.table').append('<tr>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" name="title'+MyCalendar.last_dditem+'" class="user-dditem-title" id="user-spectrum-colorpicker-dditem-title-'+MyCalendar.last_dditem+'" value="" /></td>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" name="info'+MyCalendar.last_dditem+'" class="user-dditem-info" id="user-dditem-info-'+MyCalendar.last_dditem+'" value="" /></td>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" class="input-xlarge user-spectrum-colorpicker-dditems" id="user-spectrum-colorpicker-dditem-'+MyCalendar.last_dditem+'" name="dditem_color[]" value="<?smarty $calendar.calendar_color ?>" data-title="" data-number="'+MyCalendar.last_dditem+'"></td>'+
                                    '</tr>');
                
            
                $('.user-dditem-title').focusout(function(t) {
                    MyCalendar.dditem_string = '';
                    $('.user-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');
                        MyCalendar.dditem_string += $('#user-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#user-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                });
                
                $('.user-dditem-info').focusout(function(t) {
                    MyCalendar.dditem_string = '';
                    $('.user-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');
                        MyCalendar.dditem_string += $('#user-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#user-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                });
            
                $("#user-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum({
                    showPaletteOnly: true,
                    showPalette:true,
                    color: 'blanchedalmond',
                    palette: arr_palette,
                    change: function(color) {
                         // #ff0000
                        $("#user-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).val(color.toHexString());
                        $("#user-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum('hide');

                        MyCalendar.dditem_string = '';
                        $('.user-spectrum-colorpicker-dditems').each(function(index,item) {
                            var number = $(item).data('number');
                            MyCalendar.dditem_string += $('#user-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $(item).val() + ',';
                        });
                        $('#calendar_dditems').val(MyCalendar.dditem_string);
                    }
                });
                $("#user-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).val('<?smarty $calendar.calendar_color ?>');
                $("#user-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum('set', '<?smarty $calendar.calendar_color ?>');
           
            });
    </script>
  </body>
</html>