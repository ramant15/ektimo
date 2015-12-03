<!DOCTYPE html>
<html lang="<?smarty $smarty.const.LANGUAGE ?>">
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
		<link rel='stylesheet' type='text/css' href='<?smarty $smarty.const.EXTERNAL_URL ?>/fullcalendar-1.6.4/fullcalendar/fullcalendar.print.css' media='print' />

		<link rel="shortcut icon" href="/favicon.ico">

		<!-- Added library to header in order to load reports-->
		<script src="<?smarty $smarty.const.EXTERNAL_URL ?>/jquery/jquery.1.11.1.min.js"></script>
		<script src="<?smarty $smarty.const.EXTERNAL_URL ?>/jquery/jquery-ui.1.11.1.min.js" type="text/javascript" charset="utf-8"></script>

		<script src='<?smarty $smarty.const.EXTERNAL_URL ?>/bgrins-spectrum/spectrum.js'></script>
		<link rel='stylesheet' href='<?smarty $smarty.const.EXTERNAL_URL ?>/bgrins-spectrum/spectrum.css' />
		
		<script type='text/javascript' src='<?smarty $smarty.const.FULLCAL_URL ?>/script/listeners.js'></script>
		<script type='text/javascript' src='<?smarty $smarty.const.FULLCAL_URL ?>/script/lang<?smarty $language ?>.js'></script>

		
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

			#admin-colpick-colorpicker {
				border:0;
				width:70px;
				border-right:20px solid green;
				border-image: none;
    			border-style: solid;
    			border-width: 1px 20px 1px 1px;
			}

			
            
            fieldset {
                display: block;
                margin-left: 2px;
                margin-right: 2px;
                padding-top: 0.35em;
                padding-bottom: 0.625em;
                padding-left: 0.75em;
                padding-right: 0.75em;
                border: 2px groove (internal value);
            } 
            
            .dashboard_btn {
                padding:4px;
                border:1px solid #D4D4D4;
                border-radius: 3px;
                cursor: pointer;
                text-decoration: none;
            }
            
            .dashboard_block {
                border: 1px solid #DCDCDC;
                background-color: #f9f9f9;
                padding: 15px;
                border-radius: 15px;
            }
    
            h4 {
                margin: 5px 0;
                padding-top: 10px;
            }
		</style>
		<script type='text/javascript'>
			MyCalendar = {};
			MyCalendar.sendActivationMail			= <?smarty if $smarty.const.SEND_ACTIVATION_MAIL ?>true<?smarty else ?>false<?smarty /if ?>;

            var tableToExcel = (function() {
                var uri = 'data:application/vnd.ms-excel;base64,'
                  , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                  , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                  , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
                return function(table, name) {
                  if (!table.nodeType) table = document.getElementById(table)
                  var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                  window.location.href = uri + base64(format(template, ctx))
                }
            })();
            
            $(document).ready(function() {
                $('#print_btn2').click(function() {
                    window.print();
                });
                
                $('#lists_to_excel_btn').click(function(t) {
                    tableToExcel('lists_table', 'Hour calculation');
                });
                $('#list_to_excel_btn').click(function(t) {
                    tableToExcel('list_table', 'Hour calculation of');
                });
            });
            
            
		</script>
	</head>

	<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">

					<a class="brand" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin">Admin Dashboard</a>
					<a style="float:left;padding-top:17px;color:#777777;text-decoration: none;" href="<?smarty $smarty.const.FULLCAL_URL ?>">
                        <span class="dashboard_btn"><i class="icon-calendar"></i> Calendar</span></a>
                    <span style="float:right;padding-top:17px;">Logged in: <?smarty $name ?></span>
					<span style="float:right;margin-right: 10px;padding-top: 17px;" class="button-fc-like" id="print_btn2">
                        <span class="dashboard_btn">
                            <i class="icon-print"></i> Print
                        </span>
                    </span>
                    
				
				</div>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">

			<div class="span12">
				<div class="tabbable tabs-left">

					<ul class="nav nav-tabs">
						<?smarty if $is_super_admin ?>
                        
                        <?smarty else ?>
                        
                        <?smarty /if ?>
                        
                        <li <?smarty if $active == "users" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users"><i class="icon-user"></i> <?smarty if $is_super_admin ?><span id="admin_admins_menu">Admins</span><?smarty else ?><span id="admin_users_menu">Users</span><?smarty /if ?></a></li>
                        <?smarty if $active == "new_user" ?><li class="active"><a href="#new_user" data-toggle="tab"><i class="icon-user"></i> <span id="admin_add_user_menu">Add user</span></a></li><?smarty /if ?>
                        <?smarty if $active == "quick_new_user" ?><li class="active"><a href="#quick_new_user" data-toggle="tab"><i class="icon-user"></i> <span id="admin_quick_add_user_menu">Quick add user</span></a></li><?smarty /if ?>

                        <?smarty if $active == "profile" ?><li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Profile</a></li><?smarty /if ?>
						
                        <li <?smarty if $active == "calendars" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars"><i class="icon-list"></i> <span id="admin_calendars_menu">Calendars</span></a></li>
						<?smarty if $active == "calendar" ?><li class="active"><a href="#calendar" data-toggle="tab"><i class="icon-calendar"></i> <?smarty if isset($smarty.get.action) && $smarty.get.action == 'new_calendar' ?>Add calendar<?smarty else ?>Edit calendar<?smarty /if ?></a></li><?smarty /if ?>
                         
                        <?smarty if $is_admin && !$is_super_admin ?>
                        <li <?smarty if $active == "lists" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/lists"><i class="icon-time"></i> <span id="admin_hour_calculation_menu">Hour Calculation</span></a></li>
						<?smarty /if ?>
                        
                        <?smarty if $is_admin && !$is_super_admin ?>
                        <li <?smarty if $active == "settings" ?>class="active"<?smarty /if ?>><a href="<?smarty $smarty.const.FULLCAL_URL ?>/<?smarty if $is_user ?>user/?action=get_settings<?smarty else ?>admin/settings<?smarty /if ?>"><i class="icon-cog"></i> <span id="admin_settings_menu">Settings</span></a></li>
                        <?smarty /if ?>
                    </ul>

					<div class="tab-content">

					<?smarty if $active == 'admin' ?>
						<div id="admin-current-events"  style="padding-top:20px;padding-left:20px;">
							<?smarty if !empty($current_events) ?>
                                <h4>Current events</h4>
                                <div class="dashboard_block">

                                    <?smarty foreach from=$current_events item=event ?>
                                        <?smarty $event.title ?> - 
                                        <?smarty if $event.allDay ?>allDay<?smarty /if ?>
                                        <?smarty if !$event.end_is_today ?>until <?smarty $event.date_end ?> 
                                            <?smarty if !$event.allDay ?> <?smarty $event.time_end ?><?smarty /if ?>
                                        <?smarty else ?>
                                            <?smarty if !$event.allDay ?>until  <?smarty $event.time_end ?><?smarty /if ?>
                                        <?smarty /if ?> <br />
                                    <?smarty /foreach ?>
                                </div>
                            <?smarty /if ?>
                            
                            <?smarty if !empty($last_added_events) ?>
                                <h4>Last added events</h4>
                                <div class="dashboard_block">

                                    <?smarty foreach from=$last_added_events item=event ?>
                                    <span style="font-weight:bold;<?smarty if !empty($event.calendar_color) ?>color: <?smarty $event.calendar_color ?>;<?smarty /if ?>"><?smarty $event.name ?>: &nbsp;</span> 
                                        <?smarty $event.title ?> 
                                        
                                        <?smarty* if $event.allDay ?>allDay<?smarty /if ?>
                                        <?smarty if !$event.end_is_today ?>until <?smarty $event.date_end ?> 
                                            <?smarty if !$event.allDay ?> <?smarty $event.time_end ?><?smarty /if ?>
                                        <?smarty else ?>
                                            <?smarty if !$event.allDay ?>until  <?smarty $event.time_end ?><?smarty /if ?>
                                        <?smarty /if *?> 
                                        <span style="float:right;color:lightgrey;">(Added on <?smarty if $smarty.const.SHOW_AM_PM ?><?smarty $event.create_date|date_format:"%m-%d-%Y %r" ?><?smarty else ?><?smarty $event.create_date|date_format:"%d-%m-%Y %R" ?><?smarty /if ?>)</span>
                                        <br />
                                    <?smarty /foreach ?>
                                </div>
                            <?smarty /if ?>
                            
						</div>
                    

					<?smarty elseif $active == 'users' ?>
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

                                <?smarty if $is_super_admin ?>
                                    <form style="float:right;" id="settings-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users/?action=new_admin" method="post" class="form-horizontal">
                                        <?smarty if isset($smarty.session.add_user_error) ?>
                                        <div style="position:absolute;left:400px;color:red;font-weight:bold;">
                                            <?smarty $smarty.session.add_user_error ?>
                                        </div>
                                        <?smarty /if ?>

                                        <div>
                                            <button id="add-user-btn" class="btn btn-primary" name="add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add admin</button>
                                        </div>
                                    </form>
                                    <form style="float:right;padding-right:5px;" id="settings-quick-add-user-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users/?action=quick_new_admin" method="post" class="form-horizontal">

                                        <div>
                                            <button id="quick_add-user-btn" class="btn btn-primary" name="quick-add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Quick add admin</button>
                                        </div>
                                    </form>
                                <?smarty else ?>
                                    <form style="float:right;" id="settings-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users/?action=new_user" method="post" class="form-horizontal">
                                        <?smarty if isset($smarty.session.add_user_error) ?>
                                        <div style="position:absolute;left:400px;color:red;font-weight:bold;">
                                            <?smarty $smarty.session.add_user_error ?>
                                        </div>
                                        <?smarty /if ?>

                                        <div>
                                            <button id="add-user-btn" class="btn btn-primary" name="add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add user</button>
                                        </div>
                                    </form>
                                    <form style="float:right;padding-right:5px;" id="settings-quick-add-user-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users/?action=quick_new_user" method="post" class="form-horizontal">

                                        <div>
                                            <button id="quick_add-user-btn" class="btn btn-primary" name="quick-add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Quick add user</button>
                                        </div>
                                    </form>
                                <?smarty /if ?>
                                
								

								<legend><?smarty if $is_super_admin ?><span class="admins_lable">Admins</span><?smarty else ?><span class="users_lable">Users</span><?smarty /if ?></legend>

								<div id="user_list">
									<table class="table" style="font-size:14px;">
										<thead>
											<tr>
												<th>Username</th>
												<th>Name</th>
												<th>Email</th>
												<th>Registration date</th>
												<th>Active</th>

											</tr>
										</thead>
										<tbody>

										<?smarty foreach from=$users item=item ?>

											<tr>
												<td><?smarty $item.username ?></a> <?smarty if $item.superadmin ?><span class="label label-important">superadmin</span><?smarty elseif $item.admin ?><span class="label label-important">admin</span><?smarty /if ?></td>
												<td><?smarty $item.firstname ?> <?smarty $item.lastname ?></td>
												<td><?smarty $item.email ?></td>
												<td><?smarty $item.registration_date ?></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.active ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												
												<td class="not_print"><a class="edit_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users?action=get_profile&uid=<?smarty $item.user_id ?>">Edit</a></td>
												<td class="not_print"><a class="delete_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users?action=delete&uid=<?smarty $item.user_id ?>">Delete</a></td>
											</tr>
										<?smarty /foreach ?>

										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users?to=<?smarty $from ?>"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>


					<?smarty elseif $active == 'new_user' ?>
							<div id="admin-user-add-user" style="padding-top:20px;padding-left:20px;">
								<?smarty if isset($error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $error ?>
									</div>
								<?smarty /if ?>

								<legend>Add user</legend>

                                <form action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users/?action=add_<?smarty if $is_super_admin ?>admin<?smarty else ?>user<?smarty /if ?>" method="POST" class="form-horizontal">
									<div class="control-group">
										<label for="admin_user_add_name" class="control-label">Name </label>
										<div class="controls">
											<input style="width:94px;" type="text" class="input-xlarge" id="adduser_firstname" name="firstname" placeholder="Firstname" value="">
											<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>
												<input style="width:30px;" type="text" class="input-xlarge" id="adduser_infix" name="infix" value="">
											<?smarty /if ?>
											<input style="width:<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>110<?smarty else ?>152<?smarty /if ?>px;" type="text" class="input-xlarge" id="adduser_lastname" name="lastname" placeholder="Lastname" value="">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_email" class="control-label">Email </label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="adduser_email" name="email" value="">
										</div>
									</div>

									<?smarty if $smarty.const.SHOW_USERNAME_IN_USER_FRM ?>
									<div class="control-group">
										<label for="admin_user_add_username" class="control-label">Username </label>
										<div class="controls">
											<input type="text" autocomplete="off" class="input-xlarge" id="adduser_username" name="username" value="">
										</div>
									</div>
									<?smarty /if ?>

                                    <?smarty if !$is_super_admin ?>
                                        <?smarty if $smarty.const.SHOW_CHECKBOX_COPY_TO_ADMIN ?>
                                        <div class="control-group">
                                            <label id="adduser_copy_to_admin_label_id" class="control-label">Copy to admin </label>
                                            <div class="controls">
                                                <span style="position: relative;top: 5px;">
                                                    <input type="checkbox" id="adduser_copy_to_admin" name="copy_to_admin" style="width:0;" />
                                                </span>
                                            </div>
                                        </div>
                                        <?smarty /if ?>
                                    <?smarty /if ?>
                                     
									<?smarty if $smarty.const.SEND_ACTIVATION_MAIL ?>
										<p style="font-style:italic;color:#AFAFAF;font-size:0.9em;" id="adduser_activationlink_text">The user can activate with the activation link included in the email.</p>
									<?smarty else ?>
										<p style="font-style:italic;color:#AFAFAF;font-size:0.9em;" id="adduser_password_text">A password will be generated and included in the email.</p>
									<?smarty /if ?>

									<div class="form-actions">
										<button class="btn btn-primary" name="save-add-user" type="submit">Save user</button>
									</div>
								</form>
							</div>

					<?smarty elseif $active == 'quick_new_user' ?>
							<div id="admin-user-quick-add-user" style="padding-top:20px;padding-left:20px;">
								<?smarty if isset($error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $error ?>
									</div>
								<?smarty /if ?>

								<legend>Quick add <?smarty if $is_super_admin ?>admin<?smarty else ?>user<?smarty /if ?></legend>
                                <p style="font-size:14px;padding-bottom:10px;color:#AFAFAF;">With this form you can quickly add <?smarty if $is_super_admin ?> an admin<?smarty else ?>a user<?smarty /if ?><br />No email is send to the user and the admin sets the password.<br /><span style="font-style:italic;">First name and prefix are optional.</span></p>
                                
                                <form action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/users/?action=quick_add_<?smarty if $is_super_admin ?>admin<?smarty else ?>user<?smarty /if ?>" method="POST" class="form-horizontal">
									<div class="control-group">
										<label for="admin_user_add_name" class="control-label">Name </label>
										<div class="controls">
                                            <input style="width:94px;" type="text" class="input-xlarge" id="adduser_firstname" name="firstname" placeholder="First name" value="<?smarty $values.firstname ?>">
											<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>
												<input style="width:30px;" type="text" class="input-xlarge" id="adduser_infix" name="infix" value="<?smarty $values.infix ?>">
											<?smarty /if ?>
											<input style="width:<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>110<?smarty else ?>152<?smarty /if ?>px;" type="text" class="input-xlarge" id="adduser_lastname" name="lastname" placeholder="Last name" value="<?smarty $values.lastname ?>">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_email" class="control-label">Email </label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="adduser_email" name="email" value="<?smarty $values.email ?>">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_username" class="control-label">Username </label>
										<div class="controls">
											<input type="text" autocomplete="off" class="input-xlarge" id="adduser_username" name="username" value="<?smarty $values.username ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="admin_user_add_password" class="control-label">Password </label>
										<div class="controls">
											<input type="password" autocomplete="off" class="input-xlarge" id="adduser_username" name="password" value="">
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-primary" name="save-quick-add-user" type="submit">Save user</button>
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


								<form id="calendars-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars/?action=new_calendar" method="post" class="form-horizontal">
									<?smarty if isset($smarty.session.add_calendar_error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $smarty.session.add_calendar_error ?>
									</div>
									<?smarty /if ?>

									<div style="float:right;">
										<button id="add-calendar-btn" class="btn btn-primary" name="add-calendar" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add calendar</button>
									</div>

								</form>

								<legend id="admin_settings_calendars_legend">Calendars</legend>

								<div id="calendar_list">
									<table class="table" style="font-size:14px;">
										<thead>
											<tr>
												<th colspan="5"></th>
												<th style="text-align:center;" colspan="4">Others/Group can</th>
												<th colspan="2"></th>
											</tr>
										</thead>
                                        <thead>
											<tr>
												<th class="not_print" style="border-top:0 none;"></th>
												<th style="border-top:0 none;">Name</th>
												<th style="border-top:0 none;">DD-items</th>
												<th style="border-top:0 none;">Can see DD-items</th>
												<th style="border-top:0 none;">Type</th>
												<th style="text-align:center;border-top:1px dotted lightgray;width:45px;">Add</th>
												<th style="text-align:center;border-top:1px dotted lightgray;width:45px;">Edit</th>
												<th style="text-align:center;border-top:1px dotted lightgray;width:45px;">Delete</th>
												<th style="text-align:center;border-top:1px dotted lightgray;width:45px;">Change color</th>
												<th style="text-align:center;border-top:0 none;">Initial show</th>
												<th style="text-align:center;border-top:0 none;">Active</th>
												<th style="border-top:0 none;">Owner</th>

											</tr>
										</thead>
										<tbody>

										<?smarty foreach from=$calendars item=item ?>

											<tr>
												<td class="not_print" style="width:10px;background-color:<?smarty $item.calendar_color ?>;"></td>
												<td><?smarty $item.name ?></a> <?smarty if $item.superadmin ?><span class="label label-important">superadmin</span><?smarty elseif $item.admin ?><span class="label label-important">admin</span><?smarty /if ?></td>
												<td><?smarty $item.dditems|@count ?></td>
												<td><?smarty if $item.can_dd_drag == "only_owner" ?>Only owner<?smarty elseif $item.can_dd_drag == "only_loggedin_users" ?>Only loggedin users<?smarty else ?>Everyone<?smarty /if ?></td>
												<td><?smarty if $item.share_type == "private_group" ?>Private (group)<?smarty elseif $item.share_type == "private" ?>Private<?smarty else ?><?smarty $item.share_type ?><?smarty /if ?></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_add ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_edit ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_delete ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.can_change_color ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.initial_show ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td style="text-align:center;"><img src="<?smarty $smarty.const.FULLCAL_URL ?>/images/<?smarty if $item.active == 'yes' ?>checked.png<?smarty else ?>unchecked.png<?smarty /if ?>" /></td>
												<td><?smarty $item.creator_id ?></td>

                                                <?smarty if $item.deleted == 0 ?>
                                                    <td class="not_print"><a class="edit_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?action=get_calendar&cid=<?smarty $item.calendar_id ?>">Edit</a></td>
                                                    <?smarty if $user_id == $item.creator_id ?><td class="not_print"><a class="delete_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?action=delete&cid=<?smarty $item.calendar_id ?>">Delete</a></td><?smarty /if ?>
                                                <?smarty else ?>
                                                    <?smarty if $user_id == $item.creator_id ?><td class="not_print"><a class="undo_delete_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?action=undelete&cid=<?smarty $item.calendar_id ?>">Undo delete</a></td><?smarty /if ?>
                                                
                                                <?smarty /if ?>
                                            </tr>
										<?smarty /foreach ?>

										</tbody>
									</table>
                                    <?smarty if $cnt_deleted_calendars > 0 && $smarty.get.action != 'get_deleted' ?>
                                    <div style="float:right;padding-top:20px;">
                                        <a id="deleted_cals_btn" href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?action=get_deleted">Deleted calendars</a>
                                    </div>
                                    <?smarty /if ?>
                                    
								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?to=<?smarty $from ?>"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>

					<?smarty elseif $active == 'new_calendar' ?>
							<div id="admin-calendar-add-calendar" style="padding-top:20px;padding-left:20px;">
								<?smarty if isset($error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $error ?>
									</div>
								<?smarty /if ?>

								<legend>Add calendar</legend>

								<form action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars/?action=add_calendar" method="POST" class="form-horizontal">
									<div class="control-group">
										<label for="admin_user_add_name" class="control-label">Name </label>
										<div class="controls">
											<input style="width:94px;" type="text" class="input-xlarge" id="adduser_firstname" name="firstname" placeholder="Firstname" value="">
											<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>
												<input style="width:30px;" type="text" class="input-xlarge" id="adduser_infix" name="infix" value="">
											<?smarty /if ?>
											<input style="width:<?smarty if $smarty.const.SHOW_INFIX_IN_USER_FRM ?>110<?smarty else ?>152<?smarty /if ?>px;" type="text" class="input-xlarge" id="adduser_lastname" name="lastname" placeholder="Lastname" value="">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_email" class="control-label">Email </label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="adduser_email" name="email" value="">
										</div>
									</div>

									<?smarty if $smarty.const.SHOW_USERNAME_IN_USER_FRM ?>
									<div class="control-group">
										<label for="admin_user_add_username" class="control-label">Username </label>
										<div class="controls">
											<input type="text" autocomplete="off" class="input-xlarge" id="adduser_username" name="username" value="">
										</div>
									</div>
									<?smarty /if ?>


									<p style="font-style:italic;color:#AFAFAF;font-size:0.9em;"><br /><br />A password will be generated and included in the email.</p>

									<div class="form-actions">
										<button class="btn btn-primary" name="save-add-user" type="submit">Save user</button>
									</div>
								</form>
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
									<label for="admin_profile_useractive" class="control-label" id="admin_profile_user_active_label"> Active </label>
									<div class="controls">
										<input type="checkbox" id="admin_profile_user_active" name="active" <?smarty if $profile.active ?>checked="true"<?smarty /if ?> />
									</div>
								</div>
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
									<label for="admin_user_profile_birthdate" class="control-label">Birthdate </label>
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
									<label for="admin_user_profile_country" class="control-label">Country </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_country" name="country" value="<?smarty $profile.country ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_email" class="control-label">Email </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_email" name="email" value="<?smarty $profile.email ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_username" class="control-label">Username </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_username" name="username" value="<?smarty $profile.username ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_password" class="control-label">New password </label>
									<div class="controls">
										<input type="password" autocomplete="off" class="input-xlarge" id="profile_password" name="password" placeholder="Leave blank for no change">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_new_password" class="control-label">New password again </label>
									<div class="controls">
										<input type="password" autocomplete="off" class="input-xlarge" id="profile_confirm" name="confirm" placeholder="Leave blank for no change">
									</div>
								</div>
                                
                                <div class="control-group">
									<label for="admin_user_profile_user_info" class="control-label">Info </label>
									<div class="controls">
                                        <textarea autocomplete="off" style="height:100px;" class="input-xlarge" id="profile_user_info" name="user_info"><?smarty $profile.user_info ?></textarea>
									</div>
								</div>
                                
                                <input type="hidden" name="user_id" value="<?smarty $profile.user_id ?>" />
									<div class="form-actions">
										<button id="save-profile" class="btn btn-primary" name="save-profile" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
									</div>

							</form>


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

							<form action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars/?action=save_calendar" method="post" class="form-horizontal">

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
									<label for="admin_user_calendar_dditems" class="control-label">DD-items </label>
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
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" name="title<?smarty $item.dditem_id ?>" value="<?smarty $item.title ?>" class="admin-dditem-title" id="admin-spectrum-colorpicker-dditem-title-<?smarty $item.dditem_id ?>" /></td>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" name="info<?smarty $item.dditem_id ?>" value="<?smarty $item.info ?>" class="admin-dditem-info" id="admin-dditem-info-<?smarty $item.dditem_id ?>" /></td>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" class="input-xlarge admin-spectrum-colorpicker-dditems" id="admin-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>" name="dditem_color[]" value="<?smarty $item.color ?>" data-title="<?smarty $item.title ?>" data-number="<?smarty $item.dditem_id ?>"></td>
                                                </tr>
                                               
                                            <?smarty /foreach ?>

                                            </tbody>
                                        </table>
                                       <input type="button" id="add_dditem" value="Add a DD-item" />
                                    </div>
								</div>
                                 <div class="control-group">
									<label for="admin_settings_share_type" class="control-label" id="admin_settings_share_type_label">Can see DD-items </label>
									<div class="controls">
										<!--  -->
										<select name="can_dd_drag">
											<option value="only_owner" <?smarty if $calendar.can_dd_drag == "only_owner" ?>selected="selected"<?smarty /if ?>>Only calendar owner</option>
											<option value="only_loggedin_users" <?smarty if $calendar.can_dd_drag == "only_loggedin_users" ?>selected="selected"<?smarty /if ?>>Only loggedin users</option>
											<option value="everyone" <?smarty if $calendar.can_dd_drag == "everyone" ?>selected="selected"<?smarty /if ?>>Everyone</option>
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_calendar_share_type" class="control-label" id="admin_settings_share_type_label">Share type </label>
									<div class="controls">
										<!--  -->
										<select name="share_type" id="admin_settings_share_type">
											<option value="public" <?smarty if $calendar.share_type == "public" ?>selected="selected"<?smarty /if ?>>Public</option>
											<option value="private" <?smarty if $calendar.share_type == "private" ?>selected="selected"<?smarty /if ?>>Private (only for me)</option>
											<option value="private_group" <?smarty if $calendar.share_type == "private_group" ?>selected="selected"<?smarty /if ?>>Private (only group can view)</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_canadd" class="control-label" id="admin_settings_can_add_label"><?smarty if $calendar.share_type == "private_group" ?>Group<?smarty else ?>Others<?smarty /if ?> can add </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_add" name="can_add" <?smarty if $calendar.can_add && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> <?smarty if $calendar.share_type == "private" ?>disabled="disabled"<?smarty /if ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_canedit" class="control-label" id="admin_settings_can_edit_label"><?smarty if $calendar.share_type == "private_group" ?>Group<?smarty else ?>Others<?smarty /if ?> can edit </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_edit" name="can_edit" <?smarty if $calendar.can_edit && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> <?smarty if $calendar.share_type == "private" ?>disabled="disabled"<?smarty /if ?> />
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_calendar_candelete" class="control-label" id="admin_settings_can_delete_label"><?smarty if $calendar.share_type == "private_group" ?>Group<?smarty else ?>Others<?smarty /if ?> can delete </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_delete" name="can_delete" <?smarty if $calendar.can_delete && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> <?smarty if $calendar.share_type == "private" ?>disabled="disabled"<?smarty /if ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_canchange_color" class="control-label" id="admin_settings_can_change_color_label"><?smarty if $calendar.share_type == "private_group" ?>Group<?smarty else ?>Others<?smarty /if ?> can change color </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_change_color" name="can_change_color" <?smarty if $calendar.can_change_color && $calendar.share_type != "private" ?>checked="true"<?smarty /if ?> <?smarty if $calendar.share_type == "private" ?>disabled="disabled"<?smarty /if ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_default" class="control-label">Default </label>
									<div class="controls">
										<input type="checkbox" name="initial_show" <?smarty if $calendar.initial_show ?>checked="true"<?smarty /if ?> />
									    <span id="admin_initial_show_checkbox_label" style="padding-top:5px;vertical-align:middle;">The calendar is shown initially</span>
                                    </div>
								</div>
                               

								<div class="control-group">
									<label for="admin_calendar_color" class="control-label">Color </label>
									<div class="controls" style="width:150px;">
										<input type="text" class="input-xlarge" id="admin-spectrum-colorpicker" name="calendar_color" value="<?smarty $calendar.calendar_color ?>">
									</div>
								</div>

								<div class="control-group" id="color_change_all_events" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="checkbox_use_color_for_all_events" />
										<span id="admin_color_use_for_all_events_checkbox_label" style="padding-top:5px;vertical-align:middle;">Use current color for all the events of this calendar</span>
									</div>
								</div>

                                <h4 style="padding: 50px 0 10px 180px;font-weight:bold;">
                                    Notifications (only when a user is logged in)
                                </h4>
                                <div class="control-group">
									<label for="users_can_email_event" class="control-label">Manually </label>
									<div class="controls">
										<input type="checkbox" name="users_can_email_event" <?smarty if $calendar.users_can_email_event ?>checked="true"<?smarty /if ?> />
									    <span id="admin_users_can_email_event_checkbox_label" style="padding-top:5px;vertical-align:middle;">Users can mail an event to admin/employer</span>
                                    </div>
								</div>
                                <div class="control-group">
									<label for="all_event_mods_to_admin" class="control-label">Automatic </label>
									<div class="controls">
										<input type="checkbox" name="all_event_mods_to_admin" <?smarty if $calendar.all_event_mods_to_admin ?>checked="true"<?smarty /if ?> />
									    <span id="admin_all_event_mods_to_admin_checkbox_label" style="padding-top:5px;vertical-align:middle;">Mail all event changes to admin/employer</span>
                                    </div>
								</div>
                                
                                <div class="control-group">
									<label for="admin_calendar_admin_email" class="control-label">Calendar admin email </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" id="admin_calendar_admin_email" name="calendar_admin_email" value="<?smarty $calendar.calendar_admin_email ?>"><span style="padding-left:5px;font-style:italic;">When empty MAIL_EVENT_MAILADDRESS from config.php is used</span>
                                    </div>
								</div>
                               
								<input type="hidden" name="calendar_id" value="<?smarty $calendar.calendar_id ?>" />
									<div class="form-actions">
										<button id="save-calendar" class="btn btn-primary" name="save-calendar" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
									</div>

							</form>


							</div>


					<?smarty elseif $active == 'settings' ?>
						<div id="admin-settings" style="padding-top:20px;padding-left:20px;">
							<legend id="admin_settings_legend">Settings</legend>
                            
                            <p id="admin_settings_info_text" style="padding: 0 0 20px 180px;font-style: italic;">
                                These settings will only be applied when someone is logged in, otherwise the settings from config.php will be used.
                            </p>
                            
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


							<form action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/settings/?action=save_settings" method="post" class="form-horizontal">

								<div class="control-group">
									<label for="admin_settings_default_view" class="control-label" id="admin_settings_defaultview_label">Default calendar view </label>
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
									<label for="admin_settings_week_view_type" class="control-label" id="admin_settings_week_view_type_label">Weekview type </label>
									<div class="controls">
										<!-- basicWeek, agendaWeek -->
										<select name="week_view_type">
											<option value="agendaWeek" <?smarty if $settings.week_view_type == "agendaWeek" ?>selected="selected"<?smarty /if ?>>Agenda week</option>
											<option value="basicWeek" <?smarty if $settings.week_view_type == "basicWeek" ?>selected="selected"<?smarty /if ?>>Basic week</option>
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_day_view_type" class="control-label" id="admin_settings_day_view_type_label">Dayview type </label>
									<div class="controls">
										<!-- basicDay, agendaDay -->
										<select name="day_view_type">
											<option value="agendaDay" <?smarty if $settings.day_view_type == "agendaDay" ?>selected="selected"<?smarty /if ?>>Agenda day</option>
											<option value="basicDay" <?smarty if $settings.day_view_type == "basicDay" ?>selected="selected"<?smarty /if ?>>Basic day</option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="admin_settings_language" class="control-label" id="admin_settings_language_label">Language </label>
									<div class="controls">
										<select name="language">
											<?smarty foreach from=$current_languages name="current_languages" item=item key=key ?>
                                            <option value="<?smarty $key ?>" <?smarty if $settings.language == $key ?>selected="selected" checked="checked"<?smarty /if ?>><?smarty $item ?></option>
                                            <?smarty /foreach ?>
                                        </select>
									</div>
								</div>

								<div class="control-group">
									<label for="admin_settings_other_language_label_id" class="control-label" id="admin_settings_other_language_label">Other language </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="other_language" value="<?smarty $settings.other_language ?>" /> <span id="admin_settings_two_capitals_label">Two capital characters</span> (eg. EN, ES, DE) - <strong>Custom lang**.js is required in script folder</strong>
									</div>
								</div>

                                
                                <div class="control-group" id="admin_settings_show_am_pm" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_am_pm" <?smarty if $settings.show_am_pm == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="admin_show_am_pm_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show AM/PM</span>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_show_weeknumbers" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_weeknumbers" <?smarty if $settings.show_weeknumbers == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="admin_show_weeknumbers_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show weeknumbers</span>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_show_notallowed_messages" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_notallowed_messages" <?smarty if $settings.show_notallowed_messages == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="admin_show_notallowed_messages_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show "not allowed" messages</span>
									</div>
								</div>
                                
                                <div class="control-group">
									<label for="admin_settings_preview_type" class="control-label" id="admin_settings_mouseover_popup_label">Mouseover popup </label>
									<div class="controls">
										<select name="show_view_type">
											<option value="mouseover" <?smarty if $settings.show_view_type == "mouseover" ?>selected="selected"<?smarty /if ?>>Mouseover</option>
											<option value="none" <?smarty if $settings.show_view_type == "none" ?>selected="selected"<?smarty /if ?>>None</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_truncate_title" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="truncate_title" <?smarty if $settings.truncate_title == "on" ?>checked="checked"<?smarty /if ?> />
										<span id="admin_truncate_title_checkbox_label" style="padding-top:5px;vertical-align:middle;">Truncate title</span>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_truncate_length_label_id" class="control-label" id="admin_settings_truncate_length_label">Title length </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="truncate_length" value="<?smarty $settings.truncate_length ?>" /> <span id="admin_settings_amount_of_characters_label">Amount of characters</span>
									</div>
								</div>
                                
                                                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:bold;" id="admin_settings_edit_dialog_label">Edit dialog:</h4>
                                
                                <div class="control-group">
									<label for="admin_settings_colorpicker_type" class="control-label" id="admin_settings_colorpicker_type_label">Colorpicker type </label>
									<div class="controls">
										<select name="editdialog_colorpicker_type">
											<option value="spectrum" <?smarty if $settings.editdialog_colorpicker_type == "spectrum" ?>selected="selected"<?smarty /if ?>>Spectrum</option>
											<option value="simple" <?smarty if $settings.editdialog_colorpicker_type == "simple" ?>selected="selected"<?smarty /if ?>>Simple</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_timepicker_type" class="control-label" id="admin_settings_timepicker_type_label">Timepicker type </label>
									<div class="controls">
										<select name="editdialog_timepicker_type">
											<option value="ui" <?smarty if $settings.editdialog_timepicker_type == "ui" ?>selected="selected"<?smarty /if ?>>jQuery UI</option>
											<option value="simple" <?smarty if $settings.editdialog_timepicker_type == "simple" ?>selected="selected"<?smarty /if ?>>Simple</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_show_description_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_description_field" <?smarty if $settings.show_description_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_show_description_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show description field</span>
                                    </div>
                                </div><div class="control-group" id="admin_settings_show_location_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_location_field" <?smarty if $settings.show_location_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_show_location_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show location field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="admin_settings_show_phone_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_phone_field" <?smarty if $settings.show_phone_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_show_phone_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show phone field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="admin_settings_show_url_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_url_field" <?smarty if $settings.show_url_field == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_show_url_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show url field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="admin_settings_show_delete_confirm_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_delete_confirm_dialog" <?smarty if $settings.show_delete_confirm_dialog == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_show_delete_confirm_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show confirm dialog when deleting an item</span>
                                    </div>
                                </div>
                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:bold;" id="admin_settings_hour_calculation_label">Hour calculation:</h4>
                                
                                <div class="control-group">
									<label for="admin_settings_workday_hours_label_id" class="control-label" id="admin_settings_workday_hours_label">Workday hours </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="hourcalculation_workday_hours" value="<?smarty $settings.hourcalculation_workday_hours ?>" /> <span id="admin_settings_amount_of_hours_label">Amount of hours in a workday</span>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_default_period_label_id" class="control-label" id="admin_settings_default_period_label">Default period </label>
									<div class="controls">
										<input type="text" class="input-xlarge" style="width:30px;" name="hourcalculation_default_period" value="<?smarty $settings.hourcalculation_default_period ?>" /> <span id="admin_settings_initial_period_label">Initial period in months</span>
									</div>
								</div>
                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:bold;" id="admin_settings_registration_label">Registration:</h4>
                                
                                <!--<div class="control-group" id="admin_settings_users_can_register" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="users_can_register" <?smarty if $settings.users_can_register == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_users_can_register_checkbox_label" style="padding-top:5px;vertical-align:middle;">Users can register</span>
                                    </div>
                                </div>-->
                                <p id="admin_settings_registration_info_label" style="padding-left: 180px;font-style: italic;">
                                    USERS_CAN_REGISTER can be set in config.php
                                </p>
                                <div class="control-group" id="admin_settings_send_activation_mail" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="send_activation_mail" <?smarty if $settings.send_activation_mail == "on" ?>checked="checked"<?smarty /if ?> />
                                        <span id="admin_send_activation_mail_checkbox_label" style="padding-top:5px;vertical-align:middle;">Send activation mail</span>
                                    </div>
                                </div>
                                
                                
                                
								<input type="hidden" name="user_id" value="<?smarty $user_id ?>" />
								<div class="form-actions">
									<button id="save-settings" class="btn btn-primary" name="save-settings" data-complete-text="Changes saved" data-loading-text="saving..." type="submit"><span id="save-settings-btn">Save changes</span></button>
								</div>
                                
                                
                                
							</form>
						</div>

					<?smarty elseif $active == 'lists' ?>
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

                                <span style="float:right;padding-top: 17px;" id="lists_to_excel_btn" class="not_print">
                                    <span class="dashboard_btn not_print">
                                        <i class="icon-th"></i> To Excel
                                    </span>
                                </span>	
                                
								<form id="calendars-form" action="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars/?action=new_calendar" method="post" class="form-horizontal">
									<?smarty if isset($smarty.session.add_calendar_error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $smarty.session.add_calendar_error ?>
									</div>
									<?smarty /if ?>

								</form>
								
								<legend id="admin_settings_hour_calculation_legend">Hour calculation</legend>
								
								
                                <div class="control-group" style="padding: 20px 0 30px 0;">
									<span class="control-label" id="admin_settings_calendars_label" style="width:auto;padding-right:5px;">Calendar </span>
                                    <select id="calendar_selectbox" name="calendar" style="width:150px;margin-bottom: 0;">
                                        <option class="calendar_option" value="all" <?smarty if $selected_calendar == "all" ?>selected="selected"<?smarty /if ?>>All</option>
                                        <?smarty foreach from=$calendars item=item ?>
                                            <option class="calendar_option" value="<?smarty $item.calendar_id ?>" <?smarty if $selected_calendar == $item.calendar_id ?>selected="selected"<?smarty /if ?>><?smarty $item.name ?></option>
                                        <?smarty /foreach ?>
                                    </select>


                                    <span id="month_label_id" style="padding-left:30px;margin-bottom: 0;">From: </span>
                                        <input type="text" id="hourcalc_datepicker_startdate" style="font-size:13px;margin-bottom: 0;width: 80px;padding:3px;z-index:9999;">
                                    <span id="time_label_id">To: </span>
                                        <input type="text" id="hourcalc_datepicker_enddate" style="font-size:13px;margin-bottom: 0;width: 80px;padding:3px;" />

                                    <button id="dates_clear_button" style="padding:3px 12px;" class="btn btn-secondary" name="clear-list" data-complete-text="fields cleared" data-loading-text="saving..." >Clear</button> 
                                    <button id="dates_refresh_button" style="float:right;margin-left:50px;padding:3px 12px;" class="btn btn-primary" name="refresh-list" data-complete-text="Changes saved" data-loading-text="saving..." >Refresh</button> 
								</div>

								<div id="calendar_list">
									<table class="table" id="lists_table" style="font-size:14px;">
										<thead>
											<tr>
												<th>Name</th>
												<th>Days</th>
												<th>Hours</th>
												
											</tr>
										</thead>
										<tbody>

										<?smarty foreach from=$list item=item ?>

											<tr>
												<td><?smarty $item.fullname ?> <?smarty if $item.superadmin ?><span class="label label-important">superadmin</span><?smarty elseif $item.admin ?><span class="label label-important">admin</span><?smarty /if ?></td>
												<td><?smarty $item.days ?></td>
												<td><?smarty $item.hours ?></td>
												<td class="not_print"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/lists?action=get_list&uid=<?smarty $item.user_id ?><?smarty if isset($smarty.get.cid) && !empty($smarty.get.cid) ?>&cid=<?smarty $smarty.get.cid ?><?smarty /if ?>">View</a></td>
												
												
											</tr>
										<?smarty foreachelse ?>
											<tr>
												<td>No rows found</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										<?smarty /foreach ?>

										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?to=<?smarty $from ?>"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>
					<?smarty elseif $active == 'list' ?>
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

								
								<!--<form id="calendars-form" action="" method="post" class="form-horizontal">-->
									<?smarty if isset($smarty.session.add_calendar_error) ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?smarty $smarty.session.add_calendar_error ?>
									</div>
									<?smarty /if ?>

                                    <span style="float:right;" id="list_to_excel_btn">
                                        <span class="dashboard_btn">
                                            <i class="icon-th"></i> To Excel
                                        </span>
                                    </span>	
									
								
                                    <legend><span id="admin_settings_user_hour_calculation_legend">Hour calculation of</span> <strong><?smarty $user.lastname ?>, <?smarty $user.firstname ?> <?smarty $user.infix ?></strong></legend>
								
								<div class="control-group" style="padding: 20px 0 30px 0;">
									<span class="control-label" id="admin_settings_calendars_label" style="width:auto;padding-right:5px;">Calendar </span>
                                    <select id="calendar_selectbox" name="calendar" style="width:150px;margin-bottom: 0;">
                                        <option class="calendar_option" value="all" <?smarty if $selected_calendar == "all" ?>selected="selected"<?smarty /if ?>>All</option>
                                        <?smarty foreach from=$calendars item=item ?>
                                            <option class="calendar_option" value="<?smarty $item.calendar_id ?>" <?smarty if $selected_calendar == $item.calendar_id ?>selected="selected"<?smarty /if ?>><?smarty $item.name ?></option>
                                        <?smarty /foreach ?>
                                    </select>


                                    <span id="month_label_id" style="padding-left:30px;margin-bottom: 0;">From: </span>
                                        <input type="text" id="hourcalc_datepicker_startdate" style="font-size:13px;margin-bottom: 0;width: 80px;padding:3px;z-index:9999;">
                                    <span id="time_label_id">To: </span>
                                        <input type="text" id="hourcalc_datepicker_enddate" style="font-size:13px;margin-bottom: 0;width: 80px;padding:3px;" />

                                    <button id="dates_clear_button" style="padding:3px 12px;" class="btn btn-secondary" name="clear-list" data-complete-text="fields cleared" data-loading-text="saving..." >Clear</button> 
                                    <button id="user_dates_refresh_button" style="float:right;margin-left:50px;padding:3px 12px;" class="btn btn-primary" name="refresh-list" data-complete-text="Changes saved" data-loading-text="saving..." >Refresh</button> 
								</div>
							

								<!--</form>-->
								
								<div id="calendar_list">
									<table class="table" id="list_table" style="font-size:14px;">
										<thead>
											<tr>
												<th>Date</th>
												<th>Time</th>
												<th>Days</th>
												<th>Hours</th>
												<th>Calendar</th>

											</tr>
										</thead>
										<tbody>

										<?smarty foreach from=$list item=item ?>

											<tr>
												<td style="width:190px;"><?smarty $item.date_start ?><?smarty if $item.date_end != $item.date_start ?> - <?smarty $item.date_end ?><?smarty /if ?></td>
												<td><?smarty if $item.allDay ?>allday<?smarty else ?><?smarty $item.time_start ?> - <?smarty $item.time_end ?><?smarty /if ?></td>
												<td><?smarty $item.days ?></td>
												<td><?smarty $item.hours ?></td>
												<td><?smarty $item.name ?></td>
											</tr>
										<?smarty /foreach ?>
										
										<tr style="border-top:2px solid #333333;">
											<td>Total</td>
											<td>&nbsp;</td>
											<td><?smarty $total_day_count ?></td>
											<td><?smarty $total_hour_count ?></td>
											<td>&nbsp;</td>
										</tr>
											
										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?smarty $smarty.const.FULLCAL_URL ?>/admin/calendars?to=<?smarty $from ?>"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


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
            
            $('#hourcalc_datepicker_startdate').val('<?smarty $startdate ?>');
            $('#hourcalc_datepicker_enddate').val('<?smarty $enddate ?>');
           
            
            $('#active_period_datepicker_startdate').val('<?smarty $calendar.cal_startdate ?>');
            $('#active_period_datepicker_enddate').val('<?smarty $calendar.cal_enddate ?>');
            
            $('#alterable_period_datepicker_startdate').val('<?smarty $calendar.alterable_startdate ?>');
            $('#alterable_period_datepicker_enddate').val('<?smarty $calendar.alterable_enddate ?>');
            
			$('.lists_calendar_option').click(function(t) {
				location.href = '<?smarty $smarty.const.FULLCAL_URL ?>/admin/lists/?cid='+$(this).val();
			});
            
            $('.calendar_option').click(function(t) {
				//location.href = '<?smarty $smarty.const.FULLCAL_URL ?>/admin/lists/?action=get_list&uid='+current_user+'&cid='+$(this).val();
			});
			
            
            $('#dates_clear_button').click(function(t) {
				$('#hourcalc_datepicker_startdate').val('');
                $('#hourcalc_datepicker_enddate').val('');
                
			});
            $('#dates_refresh_button').click(function(t) {
				var startdate = $('#hourcalc_datepicker_startdate').val();
                var enddate = $('#hourcalc_datepicker_enddate').val();
                var selected_cal = $('#calendar_selectbox').val();
                location.href = '<?smarty $smarty.const.FULLCAL_URL ?>/admin/lists/?cid='+selected_cal+'&st='+startdate+'&end='+enddate;
			});
            
             $('#user_dates_refresh_button').click(function(t) {
				var startdate = $('#hourcalc_datepicker_startdate').val();
                var enddate = $('#hourcalc_datepicker_enddate').val();
                var selected_cal = $('#calendar_selectbox').val();
                location.href = '<?smarty $smarty.const.FULLCAL_URL ?>/admin/lists/?action=get_list&uid='+current_user+'&cid='+selected_cal+'&st='+startdate+'&end='+enddate;
			});
            
            $('input[name="active"]').change(function(t) {
                if($(this).val() == 'period') {
                    $('#active_period_datepicker_startdate').prop('disabled', false);
                    $('#active_period_datepicker_enddate').prop('disabled', false);
                } else {
                    $('#active_period_datepicker_startdate').prop('disabled', true);
                    $('#active_period_datepicker_enddate').prop('disabled', true);
                }
                
            });
            
            $('#admin_settings_share_type').change(function(t) {
                if($(this).val() == 'private') {
                    // disable checkboxes
                    $('#admin_settings_can_add').prop('disabled', true);
                    $('#admin_settings_can_edit').prop('disabled', true);
                    $('#admin_settings_can_delete').prop('disabled', true);
                    $('#admin_settings_can_change_color').prop('disabled', true);
                    
                    $('#admin_settings_can_add').attr('checked', false);
                    $('#admin_settings_can_edit').attr('checked', false);
                    $('#admin_settings_can_delete').attr('checked', false);
                    $('#admin_settings_can_change_color').attr('checked', false);
                } else {
                    // enable checkboxes
                    $('#admin_settings_can_add').prop('disabled', false);
                    $('#admin_settings_can_edit').prop('disabled', false);
                    $('#admin_settings_can_delete').prop('disabled', false);
                    $('#admin_settings_can_change_color').prop('disabled', false);
                }
                if($(this).val() == 'private_group') {
                    $('#admin_settings_can_add_label').text('Group can add');
                    $('#admin_settings_can_edit_label').text('Group can edit');
                    $('#admin_settings_can_delete_label').text('Group can delete');
                    $('#admin_settings_can_change_color_label').text('Group can change color');
                } else {
                    $('#admin_settings_can_add_label').text('Others can add');
                    $('#admin_settings_can_edit_label').text('Others can edit');
                    $('#admin_settings_can_delete_label').text('Others can delete');
                    $('#admin_settings_can_change_color_label').text('Others can change color');
                }
            });
            
            
            
		});
        
        $('.admin-dditem-title').focusout(function(t) {
            MyCalendar.dditem_string = '';
            $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                var number = $(item).data('number');
                MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#admin-dditem-info-'+number).val() + '|' + $(item).val() + ',';
            });
            $('#calendar_dditems').val(MyCalendar.dditem_string);
        });
        
        $('.admin-dditem-info').focusout(function(t) {
            MyCalendar.dditem_string = '';
            $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                var number = $(item).data('number');
                MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#admin-dditem-info-'+number).val() + '|' + $(item).val() + ',';
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
                
			$("#admin-spectrum-colorpicker").spectrum({
			    showPaletteOnly: true,
				showPalette:true,
			    color: 'blanchedalmond',
			    palette: arr_palette,
			    change: function(color) {
				     // #ff0000
				    $("#admin-spectrum-colorpicker").val(color.toHexString());
				    $("#admin-spectrum-colorpicker").spectrum('hide');
				}
			});
			$("#admin-spectrum-colorpicker").val('<?smarty $calendar.calendar_color ?>');
			$("#admin-spectrum-colorpicker").spectrum('set', '<?smarty $calendar.calendar_color ?>');
		
            // dditems colors
            <?smarty foreach from=$calendar.dditems item=item ?>
            $("#admin-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").spectrum({
			    showPaletteOnly: true,
				showPalette:true,
			    color: 'blanchedalmond',
			    palette: arr_palette,
			    change: function(color) {
				     // #ff0000
				    $("#admin-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").val(color.toHexString());
				    $("#admin-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").spectrum('hide');
				
                    MyCalendar.dditem_string = '';
                    $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');                
                        MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#admin-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                }
			});
            $("#admin-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").val('<?smarty if $item.color !== null && !empty($item.color) ?><?smarty $item.color ?><?smarty else ?><?smarty $calendar.calendar_color ?><?smarty /if ?>');
			$("#admin-spectrum-colorpicker-dditem-<?smarty $item.dditem_id ?>").spectrum('set', '<?smarty if $item.color !== null && !empty($item.color) ?><?smarty $item.color ?><?smarty else ?><?smarty $calendar.calendar_color ?><?smarty /if ?>');
            <?smarty /foreach ?>
            
            
            
            $('#add_dditem').click(function(t) {
                MyCalendar.last_dditem ++;
                $('.table').append('<tr>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" name="title'+MyCalendar.last_dditem+'" class="admin-dditem-title" id="admin-spectrum-colorpicker-dditem-title-'+MyCalendar.last_dditem+'" value="" /></td>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" name="info'+MyCalendar.last_dditem+'" class="admin-dditem-info" id="admin-dditem-info-'+MyCalendar.last_dditem+'" value="" /></td>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" class="input-xlarge admin-spectrum-colorpicker-dditems" id="admin-spectrum-colorpicker-dditem-'+MyCalendar.last_dditem+'" name="dditem_color[]" value="<?smarty $calendar.calendar_color ?>" data-title="" data-number="'+MyCalendar.last_dditem+'"></td>'+
                                    '</tr>');
                
            
                $('.admin-dditem-title').focusout(function(t) {
                    MyCalendar.dditem_string = '';
                    $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');
                        MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#admin-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                });
                
                $('.admin-dditem-info').focusout(function(t) {
                    MyCalendar.dditem_string = '';
                    $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');
                        MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#admin-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                });
            
                $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum({
                    showPaletteOnly: true,
                    showPalette:true,
                    color: 'blanchedalmond',
                    palette: arr_palette,
                    change: function(color) {
                         // #ff0000
                        $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).val(color.toHexString());
                        $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum('hide');

                        MyCalendar.dditem_string = '';
                        $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                            var number = $(item).data('number');
                            MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $(item).val() + ',';
                        });
                        $('#calendar_dditems').val(MyCalendar.dditem_string);
                    }
                });
                $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).val('<?smarty $calendar.calendar_color ?>');
                $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum('set', '<?smarty $calendar.calendar_color ?>');
           
            });

		$('#admin_user_profile_name_label').html(Lang.Popup.LabelName);
		$('#admin_user_profile_email_label').html(Lang.Popup.LabelEmail);
		$('#admin_user_profile_username_label').html(Lang.Popup.LabelUsername);
		$('#admin_user_profile_birthdate_label').html(Lang.Popup.LabelBirthdate);
		$('#admin_user_profile_country_label').html(Lang.Popup.LabelCountry);
		$('#admin_user_profile_new_password_label').html(Lang.Popup.LabelNewPassword);
		$('#admin_user_profile_new_password2_label').html(Lang.Popup.LabelNewPasswordAgain);
		$('#admin_user_profile_color_label').html(Lang.Popup.ProfileEventColor);

		$('#admin_users_menu').html(Lang.Menu.TitleUsers);
        $('#admin_add_user_menu').html(Lang.Menu.TitleAddUser);
        $('#admin_quick_add_user_menu').html(Lang.Menu.TitleQuickAdduser);
        $('#admin_admins_menu').html(Lang.Menu.TitleAdmins);
        $('#admin_settings_menu').html(Lang.Menu.TitleSettings);
        $('#admin_calendars_menu').html(Lang.Menu.TitleCalendars);
        $('#admin_hour_calculation_menu').html(Lang.Menu.TitleHourCalculation);
     
        $('#admin_settings_calendars_legend').html(Lang.Menu.TitleCalendars);
        $('#admin_hour_calculation_menu').html(Lang.Menu.TitleHourCalculation);
        $('#admin_settings_legend').html(Lang.Settings.Legend);
        $('#admin_users_legend').html(Lang.Menu.TitleUsers);
		$('#admin_settings_hour_calculation_legend').html(Lang.Hourcalculation.legend);
        $('#admin_settings_user_hour_calculation_legend').html(Lang.Hourcalculation.legendOfUser);
        $('#admin_settings_info_text').html(Lang.Settings.Infotext);
		$('#admin_settings_language_label').html(Lang.Settings.LabelLanguage);
		$('#admin_settings_defaultview_label').html(Lang.Settings.DefaultView);
		$('#admin_settings_week_view_type_label').html(Lang.Settings.LabelWeekViewType);
		$('#admin_settings_day_view_type_label').html(Lang.Settings.LabelDayViewType);
		$('#admin_settings_other_language_label').html(Lang.Settings.LabelOtherLanguage);
        $('#admin_show_am_pm_checkbox_label').html(Lang.Settings.LabelShowAmPm);
        $('#admin_show_weeknumbers_checkbox_label').html(Lang.Settings.LabelShowWeeknumbers);
        $('#admin_show_notallowed_messages_checkbox_label').html(Lang.Settings.LabelShowNotAllowedMessages);
        $('#admin_settings_mouseover_popup_label').html(Lang.Settings.LabelMouseoverPopup);
        $('#admin_truncate_title_checkbox_label').html(Lang.Settings.LabelTruncateTitle);
        $('#admin_settings_truncate_length_label').html(Lang.Settings.LabelTitleLength);
        $('#admin_settings_edit_dialog_label').html(Lang.Settings.LabelEditDialog);
        $('#admin_settings_two_capitals_label').html(Lang.Settings.LabelTwoCapitals);
        $('#admin_settings_amount_of_characters_label').html(Lang.Settings.LabelAmountOfCharacters);
        $('#admin_settings_colorpicker_type_label').html(Lang.Settings.LabelColorPickerType);
        $('#admin_settings_timepicker_type_label').html(Lang.Settings.LabelTimePickerType);
        $('#admin_show_description_in_edit_dialog_checkbox_label').html(Lang.Settings.LabelShowDescription);
        $('#admin_show_location_in_edit_dialog_checkbox_label').html(Lang.Settings.LabelShowLocation);
        $('#admin_show_phone_in_edit_dialog_checkbox_label').html(Lang.Settings.LabelShowPhone);
        $('#admin_show_delete_confirm_dialog_checkbox_label').html(Lang.Settings.LabelShowDeleteConfirmDialog);
        $('#admin_settings_hour_calculation_label').html(Lang.Settings.LabelHourcalculation);
        $('#admin_settings_workday_hours_label').html(Lang.Settings.LabelWorkdayHours);
        $('#admin_settings_default_period_label').html(Lang.Settings.LabelDefaultPeriod);
        $('#admin_settings_amount_of_hours_label').html(Lang.Settings.LabelWorkdayHoursInfo);
        $('#admin_settings_initial_period_label').html(Lang.Settings.LabelDefaultPeriodInfo);
        $('#admin_settings_registration_label').html(Lang.Settings.LabelRegistration);
        $('#admin_settings_registration_info_label').html('USERS_CAN_REGISTER ' + Lang.Settings.LabelRegistrationInfo);
        $('#admin_send_activation_mail_checkbox_label').html(Lang.Settings.LabelSendActivationMail);
        
        
        
        $('.edit_btn').html(Lang.Popup.editButtonText);
        $('.delete_btn').html(Lang.Popup.deleteButtonText);
        $('.admins_lable').html(Lang.Menu.TitleAdmins);
        $('.users_lable').html(Lang.Menu.TitleUsers);
        
        $('#add-calendar-btn').html(Lang.Button.addCalendar);
        
        $('.simple_endtime_label').html(Lang.Popup.SimpleEndTimeLabel);
        $('.simple_starttime_label').html(Lang.Popup.SimpleStartTimeLabel );

        
		$('#save-settings-btn').html(Lang.Popup.saveButtonText);

	</script>

  </body>
</html>