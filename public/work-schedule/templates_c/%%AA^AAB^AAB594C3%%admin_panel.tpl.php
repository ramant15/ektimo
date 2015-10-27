<?php /* Smarty version 2.6.18, created on 2015-09-29 08:44:10
         compiled from C:%5Cwamp%5Cwww%5Cemployee-work-schedule/view/admin_panel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'C:\\wamp\\www\\employee-work-schedule/view/admin_panel.tpl', 212, false),array('modifier', 'count', 'C:\\wamp\\www\\employee-work-schedule/view/admin_panel.tpl', 489, false),)), $this); ?>
<!DOCTYPE html>
<html lang="<?php echo @LANGUAGE; ?>
">
	<head>
		<meta charset="utf-8">
		<title><?php echo @CALENDAR_TITLE; ?>
</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo @CALENDAR_TITLE; ?>
">
		<meta name="author" content="">

		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link href="<?php echo @EXTERNAL_URL; ?>
/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css' />
		<link rel='stylesheet' type='text/css' href='<?php echo @EXTERNAL_URL; ?>
/fullcalendar-1.6.4/fullcalendar/fullcalendar.print.css' media='print' />

		<link rel="shortcut icon" href="/favicon.ico">

		<!-- Added library to header in order to load reports-->
		<script src="<?php echo @EXTERNAL_URL; ?>
/jquery/jquery.1.11.1.min.js"></script>
		<script src="<?php echo @EXTERNAL_URL; ?>
/jquery/jquery-ui.1.11.1.min.js" type="text/javascript" charset="utf-8"></script>

		<script src='<?php echo @EXTERNAL_URL; ?>
/bgrins-spectrum/spectrum.js'></script>
		<link rel='stylesheet' href='<?php echo @EXTERNAL_URL; ?>
/bgrins-spectrum/spectrum.css' />
		
		<script type='text/javascript' src='<?php echo @FULLCAL_URL; ?>
/script/listeners.js'></script>
		<script type='text/javascript' src='<?php echo @FULLCAL_URL; ?>
/script/lang<?php echo $this->_tpl_vars['language']; ?>
.js'></script>

		
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
			MyCalendar.sendActivationMail			= <?php if (@SEND_ACTIVATION_MAIL): ?>true<?php else: ?>false<?php endif; ?>;

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

					<a class="brand" href="<?php echo @FULLCAL_URL; ?>
/admin">Admin Dashboard</a>
					<a style="float:left;padding-top:17px;color:#777777;text-decoration: none;" href="<?php echo @FULLCAL_URL; ?>
">
                        <span class="dashboard_btn"><i class="icon-calendar"></i> Calendar</span></a>
                    <span style="float:right;padding-top:17px;">Logged in: <?php echo $this->_tpl_vars['name']; ?>
</span>
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
						<?php if ($this->_tpl_vars['is_super_admin']): ?>
                        
                        <?php else: ?>
                        
                        <?php endif; ?>
                        
                        <li <?php if ($this->_tpl_vars['active'] == 'users'): ?>class="active"<?php endif; ?>><a href="<?php echo @FULLCAL_URL; ?>
/admin/users"><i class="icon-user"></i> <?php if ($this->_tpl_vars['is_super_admin']): ?><span id="admin_admins_menu">Admins</span><?php else: ?><span id="admin_users_menu">Users</span><?php endif; ?></a></li>
                        <?php if ($this->_tpl_vars['active'] == 'new_user'): ?><li class="active"><a href="#new_user" data-toggle="tab"><i class="icon-user"></i> <span id="admin_add_user_menu">Add user</span></a></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['active'] == 'quick_new_user'): ?><li class="active"><a href="#quick_new_user" data-toggle="tab"><i class="icon-user"></i> <span id="admin_quick_add_user_menu">Quick add user</span></a></li><?php endif; ?>

                        <?php if ($this->_tpl_vars['active'] == 'profile'): ?><li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Profile</a></li><?php endif; ?>
						
                        <li <?php if ($this->_tpl_vars['active'] == 'calendars'): ?>class="active"<?php endif; ?>><a href="<?php echo @FULLCAL_URL; ?>
/admin/calendars"><i class="icon-list"></i> <span id="admin_calendars_menu">Calendars</span></a></li>
						<?php if ($this->_tpl_vars['active'] == 'calendar'): ?><li class="active"><a href="#calendar" data-toggle="tab"><i class="icon-calendar"></i> <?php if (isset ( $_GET['action'] ) && $_GET['action'] == 'new_calendar'): ?>Add calendar<?php else: ?>Edit calendar<?php endif; ?></a></li><?php endif; ?>
                         
                        <?php if ($this->_tpl_vars['is_admin'] && ! $this->_tpl_vars['is_super_admin']): ?>
                        <li <?php if ($this->_tpl_vars['active'] == 'lists'): ?>class="active"<?php endif; ?>><a href="<?php echo @FULLCAL_URL; ?>
/admin/lists"><i class="icon-time"></i> <span id="admin_hour_calculation_menu">Hour Calculation</span></a></li>
						<?php endif; ?>
                        
                        <?php if ($this->_tpl_vars['is_admin'] && ! $this->_tpl_vars['is_super_admin']): ?>
                        <li <?php if ($this->_tpl_vars['active'] == 'settings'): ?>class="active"<?php endif; ?>><a href="<?php echo @FULLCAL_URL; ?>
/<?php if ($this->_tpl_vars['is_user']): ?>user/?action=get_settings<?php else: ?>admin/settings<?php endif; ?>"><i class="icon-cog"></i> <span id="admin_settings_menu">Settings</span></a></li>
                        <?php endif; ?>
                    </ul>

					<div class="tab-content">

					<?php if ($this->_tpl_vars['active'] == 'admin'): ?>
						<div id="admin-current-events"  style="padding-top:20px;padding-left:20px;">
							<?php if (! empty ( $this->_tpl_vars['current_events'] )): ?>
                                <h4>Current events</h4>
                                <div class="dashboard_block">

                                    <?php $_from = $this->_tpl_vars['current_events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
                                        <?php echo $this->_tpl_vars['event']['title']; ?>
 - 
                                        <?php if ($this->_tpl_vars['event']['allDay']): ?>allDay<?php endif; ?>
                                        <?php if (! $this->_tpl_vars['event']['end_is_today']): ?>until <?php echo $this->_tpl_vars['event']['date_end']; ?>
 
                                            <?php if (! $this->_tpl_vars['event']['allDay']): ?> <?php echo $this->_tpl_vars['event']['time_end']; ?>
<?php endif; ?>
                                        <?php else: ?>
                                            <?php if (! $this->_tpl_vars['event']['allDay']): ?>until  <?php echo $this->_tpl_vars['event']['time_end']; ?>
<?php endif; ?>
                                        <?php endif; ?> <br />
                                    <?php endforeach; endif; unset($_from); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (! empty ( $this->_tpl_vars['last_added_events'] )): ?>
                                <h4>Last added events</h4>
                                <div class="dashboard_block">

                                    <?php $_from = $this->_tpl_vars['last_added_events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['event']):
?>
                                    <span style="font-weight:bold;<?php if (! empty ( $this->_tpl_vars['event']['calendar_color'] )): ?>color: <?php echo $this->_tpl_vars['event']['calendar_color']; ?>
;<?php endif; ?>"><?php echo $this->_tpl_vars['event']['name']; ?>
: &nbsp;</span> 
                                        <?php echo $this->_tpl_vars['event']['title']; ?>
 
                                        
                                         
                                        <span style="float:right;color:lightgrey;">(Added on <?php if (@SHOW_AM_PM): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['create_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y %r") : smarty_modifier_date_format($_tmp, "%m-%d-%Y %r")); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['create_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y %R") : smarty_modifier_date_format($_tmp, "%d-%m-%Y %R")); ?>
<?php endif; ?>)</span>
                                        <br />
                                    <?php endforeach; endif; unset($_from); ?>
                                </div>
                            <?php endif; ?>
                            
						</div>
                    

					<?php elseif ($this->_tpl_vars['active'] == 'users'): ?>
							<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
								<?php if (! empty ( $this->_tpl_vars['error'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
									<?php echo $this->_tpl_vars['error']; ?>

								</div>
								<?php endif; ?>

								<?php if (! empty ( $this->_tpl_vars['msg'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
									<?php echo $this->_tpl_vars['msg']; ?>

								</div>
								<?php endif; ?>

                                <?php if ($this->_tpl_vars['is_super_admin']): ?>
                                    <form style="float:right;" id="settings-form" action="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=new_admin" method="post" class="form-horizontal">
                                        <?php if (isset ( $_SESSION['add_user_error'] )): ?>
                                        <div style="position:absolute;left:400px;color:red;font-weight:bold;">
                                            <?php echo $_SESSION['add_user_error']; ?>

                                        </div>
                                        <?php endif; ?>

                                        <div>
                                            <button id="add-user-btn" class="btn btn-primary" name="add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add admin</button>
                                        </div>
                                    </form>
                                    <form style="float:right;padding-right:5px;" id="settings-quick-add-user-form" action="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=quick_new_admin" method="post" class="form-horizontal">

                                        <div>
                                            <button id="quick_add-user-btn" class="btn btn-primary" name="quick-add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Quick add admin</button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <form style="float:right;" id="settings-form" action="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=new_user" method="post" class="form-horizontal">
                                        <?php if (isset ( $_SESSION['add_user_error'] )): ?>
                                        <div style="position:absolute;left:400px;color:red;font-weight:bold;">
                                            <?php echo $_SESSION['add_user_error']; ?>

                                        </div>
                                        <?php endif; ?>

                                        <div>
                                            <button id="add-user-btn" class="btn btn-primary" name="add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Add user</button>
                                        </div>
                                    </form>
                                    <form style="float:right;padding-right:5px;" id="settings-quick-add-user-form" action="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=quick_new_user" method="post" class="form-horizontal">

                                        <div>
                                            <button id="quick_add-user-btn" class="btn btn-primary" name="quick-add-user" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Quick add user</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                                
								

								<legend><?php if ($this->_tpl_vars['is_super_admin']): ?><span class="admins_lable">Admins</span><?php else: ?><span class="users_lable">Users</span><?php endif; ?></legend>

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

										<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

											<tr>
												<td><?php echo $this->_tpl_vars['item']['username']; ?>
</a> <?php if ($this->_tpl_vars['item']['superadmin']): ?><span class="label label-important">superadmin</span><?php elseif ($this->_tpl_vars['item']['admin']): ?><span class="label label-important">admin</span><?php endif; ?></td>
												<td><?php echo $this->_tpl_vars['item']['firstname']; ?>
 <?php echo $this->_tpl_vars['item']['lastname']; ?>
</td>
												<td><?php echo $this->_tpl_vars['item']['email']; ?>
</td>
												<td><?php echo $this->_tpl_vars['item']['registration_date']; ?>
</td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['active']): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												
												<td class="not_print"><a class="edit_btn" href="<?php echo @FULLCAL_URL; ?>
/admin/users?action=get_profile&uid=<?php echo $this->_tpl_vars['item']['user_id']; ?>
">Edit</a></td>
												<td class="not_print"><a class="delete_btn" href="<?php echo @FULLCAL_URL; ?>
/admin/users?action=delete&uid=<?php echo $this->_tpl_vars['item']['user_id']; ?>
">Delete</a></td>
											</tr>
										<?php endforeach; endif; unset($_from); ?>

										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?php echo @FULLCAL_URL; ?>
/admin/users?to=<?php echo $this->_tpl_vars['from']; ?>
"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>


					<?php elseif ($this->_tpl_vars['active'] == 'new_user'): ?>
							<div id="admin-user-add-user" style="padding-top:20px;padding-left:20px;">
								<?php if (isset ( $this->_tpl_vars['error'] )): ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?php echo $this->_tpl_vars['error']; ?>

									</div>
								<?php endif; ?>

								<legend>Add user</legend>

                                <form action="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=add_<?php if ($this->_tpl_vars['is_super_admin']): ?>admin<?php else: ?>user<?php endif; ?>" method="POST" class="form-horizontal">
									<div class="control-group">
										<label for="admin_user_add_name" class="control-label">Name </label>
										<div class="controls">
											<input style="width:94px;" type="text" class="input-xlarge" id="adduser_firstname" name="firstname" placeholder="Firstname" value="">
											<?php if (@SHOW_INFIX_IN_USER_FRM): ?>
												<input style="width:30px;" type="text" class="input-xlarge" id="adduser_infix" name="infix" value="">
											<?php endif; ?>
											<input style="width:<?php if (@SHOW_INFIX_IN_USER_FRM): ?>110<?php else: ?>152<?php endif; ?>px;" type="text" class="input-xlarge" id="adduser_lastname" name="lastname" placeholder="Lastname" value="">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_email" class="control-label">Email </label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="adduser_email" name="email" value="">
										</div>
									</div>

									<?php if (@SHOW_USERNAME_IN_USER_FRM): ?>
									<div class="control-group">
										<label for="admin_user_add_username" class="control-label">Username </label>
										<div class="controls">
											<input type="text" autocomplete="off" class="input-xlarge" id="adduser_username" name="username" value="">
										</div>
									</div>
									<?php endif; ?>

                                    <?php if (! $this->_tpl_vars['is_super_admin']): ?>
                                        <?php if (@SHOW_CHECKBOX_COPY_TO_ADMIN): ?>
                                        <div class="control-group">
                                            <label id="adduser_copy_to_admin_label_id" class="control-label">Copy to admin </label>
                                            <div class="controls">
                                                <span style="position: relative;top: 5px;">
                                                    <input type="checkbox" id="adduser_copy_to_admin" name="copy_to_admin" style="width:0;" />
                                                </span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                     
									<?php if (@SEND_ACTIVATION_MAIL): ?>
										<p style="font-style:italic;color:#AFAFAF;font-size:0.9em;" id="adduser_activationlink_text">The user can activate with the activation link included in the email.</p>
									<?php else: ?>
										<p style="font-style:italic;color:#AFAFAF;font-size:0.9em;" id="adduser_password_text">A password will be generated and included in the email.</p>
									<?php endif; ?>

									<div class="form-actions">
										<button class="btn btn-primary" name="save-add-user" type="submit">Save user</button>
									</div>
								</form>
							</div>

					<?php elseif ($this->_tpl_vars['active'] == 'quick_new_user'): ?>
							<div id="admin-user-quick-add-user" style="padding-top:20px;padding-left:20px;">
								<?php if (isset ( $this->_tpl_vars['error'] )): ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?php echo $this->_tpl_vars['error']; ?>

									</div>
								<?php endif; ?>

								<legend>Quick add <?php if ($this->_tpl_vars['is_super_admin']): ?>admin<?php else: ?>user<?php endif; ?></legend>
                                <p style="font-size:14px;padding-bottom:10px;color:#AFAFAF;">With this form you can quickly add <?php if ($this->_tpl_vars['is_super_admin']): ?> an admin<?php else: ?>a user<?php endif; ?><br />No email is send to the user and the admin sets the password.<br /><span style="font-style:italic;">First name and prefix are optional.</span></p>
                                
                                <form action="<?php echo @FULLCAL_URL; ?>
/admin/users/?action=quick_add_<?php if ($this->_tpl_vars['is_super_admin']): ?>admin<?php else: ?>user<?php endif; ?>" method="POST" class="form-horizontal">
									<div class="control-group">
										<label for="admin_user_add_name" class="control-label">Name </label>
										<div class="controls">
                                            <input style="width:94px;" type="text" class="input-xlarge" id="adduser_firstname" name="firstname" placeholder="First name" value="<?php echo $this->_tpl_vars['values']['firstname']; ?>
">
											<?php if (@SHOW_INFIX_IN_USER_FRM): ?>
												<input style="width:30px;" type="text" class="input-xlarge" id="adduser_infix" name="infix" value="<?php echo $this->_tpl_vars['values']['infix']; ?>
">
											<?php endif; ?>
											<input style="width:<?php if (@SHOW_INFIX_IN_USER_FRM): ?>110<?php else: ?>152<?php endif; ?>px;" type="text" class="input-xlarge" id="adduser_lastname" name="lastname" placeholder="Last name" value="<?php echo $this->_tpl_vars['values']['lastname']; ?>
">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_email" class="control-label">Email </label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="adduser_email" name="email" value="<?php echo $this->_tpl_vars['values']['email']; ?>
">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_username" class="control-label">Username </label>
										<div class="controls">
											<input type="text" autocomplete="off" class="input-xlarge" id="adduser_username" name="username" value="<?php echo $this->_tpl_vars['values']['username']; ?>
">
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

					<?php elseif ($this->_tpl_vars['active'] == 'calendars'): ?>
							<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
								<?php if (! empty ( $this->_tpl_vars['error'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
									<?php echo $this->_tpl_vars['error']; ?>

								</div>
								<?php endif; ?>

								<?php if (! empty ( $this->_tpl_vars['msg'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
									<?php echo $this->_tpl_vars['msg']; ?>

								</div>
								<?php endif; ?>


								<form id="calendars-form" action="<?php echo @FULLCAL_URL; ?>
/admin/calendars/?action=new_calendar" method="post" class="form-horizontal">
									<?php if (isset ( $_SESSION['add_calendar_error'] )): ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?php echo $_SESSION['add_calendar_error']; ?>

									</div>
									<?php endif; ?>

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

										<?php $_from = $this->_tpl_vars['calendars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

											<tr>
												<td class="not_print" style="width:10px;background-color:<?php echo $this->_tpl_vars['item']['calendar_color']; ?>
;"></td>
												<td><?php echo $this->_tpl_vars['item']['name']; ?>
</a> <?php if ($this->_tpl_vars['item']['superadmin']): ?><span class="label label-important">superadmin</span><?php elseif ($this->_tpl_vars['item']['admin']): ?><span class="label label-important">admin</span><?php endif; ?></td>
												<td><?php echo count($this->_tpl_vars['item']['dditems']); ?>
</td>
												<td><?php if ($this->_tpl_vars['item']['can_dd_drag'] == 'only_owner'): ?>Only owner<?php elseif ($this->_tpl_vars['item']['can_dd_drag'] == 'only_loggedin_users'): ?>Only loggedin users<?php else: ?>Everyone<?php endif; ?></td>
												<td><?php if ($this->_tpl_vars['item']['share_type'] == 'private_group'): ?>Private (group)<?php elseif ($this->_tpl_vars['item']['share_type'] == 'private'): ?>Private<?php else: ?><?php echo $this->_tpl_vars['item']['share_type']; ?>
<?php endif; ?></td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['can_add']): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['can_edit']): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['can_delete']): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['can_change_color']): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['initial_show']): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												<td style="text-align:center;"><img src="<?php echo @FULLCAL_URL; ?>
/images/<?php if ($this->_tpl_vars['item']['active'] == 'yes'): ?>checked.png<?php else: ?>unchecked.png<?php endif; ?>" /></td>
												<td><?php echo $this->_tpl_vars['item']['creator_id']; ?>
</td>

                                                <?php if ($this->_tpl_vars['item']['deleted'] == 0): ?>
                                                    <td class="not_print"><a class="edit_btn" href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?action=get_calendar&cid=<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
">Edit</a></td>
                                                    <?php if ($this->_tpl_vars['user_id'] == $this->_tpl_vars['item']['creator_id']): ?><td class="not_print"><a class="delete_btn" href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?action=delete&cid=<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
">Delete</a></td><?php endif; ?>
                                                <?php else: ?>
                                                    <?php if ($this->_tpl_vars['user_id'] == $this->_tpl_vars['item']['creator_id']): ?><td class="not_print"><a class="undo_delete_btn" href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?action=undelete&cid=<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
">Undo delete</a></td><?php endif; ?>
                                                
                                                <?php endif; ?>
                                            </tr>
										<?php endforeach; endif; unset($_from); ?>

										</tbody>
									</table>
                                    <?php if ($this->_tpl_vars['cnt_deleted_calendars'] > 0 && $_GET['action'] != 'get_deleted'): ?>
                                    <div style="float:right;padding-top:20px;">
                                        <a id="deleted_cals_btn" href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?action=get_deleted">Deleted calendars</a>
                                    </div>
                                    <?php endif; ?>
                                    
								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?to=<?php echo $this->_tpl_vars['from']; ?>
"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>

					<?php elseif ($this->_tpl_vars['active'] == 'new_calendar'): ?>
							<div id="admin-calendar-add-calendar" style="padding-top:20px;padding-left:20px;">
								<?php if (isset ( $this->_tpl_vars['error'] )): ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?php echo $this->_tpl_vars['error']; ?>

									</div>
								<?php endif; ?>

								<legend>Add calendar</legend>

								<form action="<?php echo @FULLCAL_URL; ?>
/admin/calendars/?action=add_calendar" method="POST" class="form-horizontal">
									<div class="control-group">
										<label for="admin_user_add_name" class="control-label">Name </label>
										<div class="controls">
											<input style="width:94px;" type="text" class="input-xlarge" id="adduser_firstname" name="firstname" placeholder="Firstname" value="">
											<?php if (@SHOW_INFIX_IN_USER_FRM): ?>
												<input style="width:30px;" type="text" class="input-xlarge" id="adduser_infix" name="infix" value="">
											<?php endif; ?>
											<input style="width:<?php if (@SHOW_INFIX_IN_USER_FRM): ?>110<?php else: ?>152<?php endif; ?>px;" type="text" class="input-xlarge" id="adduser_lastname" name="lastname" placeholder="Lastname" value="">
										</div>
									</div>

									<div class="control-group">
										<label for="admin_user_add_email" class="control-label">Email </label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="adduser_email" name="email" value="">
										</div>
									</div>

									<?php if (@SHOW_USERNAME_IN_USER_FRM): ?>
									<div class="control-group">
										<label for="admin_user_add_username" class="control-label">Username </label>
										<div class="controls">
											<input type="text" autocomplete="off" class="input-xlarge" id="adduser_username" name="username" value="">
										</div>
									</div>
									<?php endif; ?>


									<p style="font-style:italic;color:#AFAFAF;font-size:0.9em;"><br /><br />A password will be generated and included in the email.</p>

									<div class="form-actions">
										<button class="btn btn-primary" name="save-add-user" type="submit">Save user</button>
									</div>
								</form>
							</div>


					<?php elseif ($this->_tpl_vars['active'] == 'profile'): ?>
						<div id="admin-user-profile" style="padding-top:20px;padding-left:20px;">
							<legend>Profile</legend>

							<?php if (! empty ( $this->_tpl_vars['save_profile_error'] )): ?>
							<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
								<?php echo $this->_tpl_vars['save_profile_error']; ?>

							</div>
							<?php endif; ?>

							<?php if (! empty ( $this->_tpl_vars['save_profile_success'] )): ?>
							<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
								<?php echo $this->_tpl_vars['save_profile_success']; ?>

							</div>
							<?php endif; ?>

							<form action="<?php echo @FULLCAL_URL; ?>
<?php if ($this->_tpl_vars['is_user']): ?>/user<?php else: ?>/admin/users<?php endif; ?>/?action=save_profile" method="post" class="form-horizontal">

                                <div class="control-group">
									<label for="admin_profile_useractive" class="control-label" id="admin_profile_user_active_label"> Active </label>
									<div class="controls">
										<input type="checkbox" id="admin_profile_user_active" name="active" <?php if ($this->_tpl_vars['profile']['active']): ?>checked="true"<?php endif; ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_user_profile_name" class="control-label">Name </label>
									<div class="controls">
										<input style="width:94px;" type="text" class="input-xlarge" id="profile_firstname" name="firstname" placeholder="Firstname" value="<?php echo $this->_tpl_vars['profile']['firstname']; ?>
">
										<?php if (@SHOW_INFIX_IN_USER_FRM): ?>
											<input style="width:30px;" type="text" class="input-xlarge" id="profile_infix" name="infix" value="<?php echo $this->_tpl_vars['profile']['infix']; ?>
">
										<?php endif; ?>
										<input style="width:<?php if (@SHOW_INFIX_IN_USER_FRM): ?>110<?php else: ?>152<?php endif; ?>px;" type="text" class="input-xlarge" id="profile_lastname" name="lastname" placeholder="Lastname" value="<?php echo $this->_tpl_vars['profile']['lastname']; ?>
">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_birthdate" class="control-label">Birthdate </label>
									<div class="controls">
									<?php if (@DATEPICKER_DATEFORMAT == 'dd/mm/yy'): ?>
										<input style="width:25px;" type="text" placeholder="DD" class="input-xlarge" id="profile_birthdate_day" name="birthdate_day" value="<?php echo $this->_tpl_vars['profile']['birthdate_day']; ?>
">
										<input style="width:25px;" type="text" placeholder="MM" class="input-xlarge" id="profile_birthdate_month" name="birthdate_month" value="<?php echo $this->_tpl_vars['profile']['birthdate_month']; ?>
">

									<?php else: ?>
										<input style="width:25px;" type="text" placeholder="MM" class="input-xlarge" id="profile_birthdate_month" name="birthdate_month" value="<?php echo $this->_tpl_vars['profile']['birthdate_month']; ?>
">
										<input style="width:25px;" type="text" placeholder="DD" class="input-xlarge" id="profile_birthdate_day" name="birthdate_day" value="<?php echo $this->_tpl_vars['profile']['birthdate_day']; ?>
">

									<?php endif; ?>
									<input style="width:45px;" type="text" placeholder="YYYY" class="input-xlarge" id="profile_birthdate_year" name="birthdate_year" value="<?php echo $this->_tpl_vars['profile']['birthdate_year']; ?>
">

									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_country" class="control-label">Country </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_country" name="country" value="<?php echo $this->_tpl_vars['profile']['country']; ?>
">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_email" class="control-label">Email </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_email" name="email" value="<?php echo $this->_tpl_vars['profile']['email']; ?>
">
									</div>
								</div>

								<div class="control-group">
									<label for="admin_user_profile_username" class="control-label">Username </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="profile_username" name="username" value="<?php echo $this->_tpl_vars['profile']['username']; ?>
">
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
                                        <textarea autocomplete="off" style="height:100px;" class="input-xlarge" id="profile_user_info" name="user_info"><?php echo $this->_tpl_vars['profile']['user_info']; ?>
</textarea>
									</div>
								</div>
                                
                                <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['profile']['user_id']; ?>
" />
									<div class="form-actions">
										<button id="save-profile" class="btn btn-primary" name="save-profile" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
									</div>

							</form>


							</div>

					<?php elseif ($this->_tpl_vars['active'] == 'calendar'): ?>
						<div id="admin-user-calendar" style="padding-top:20px;padding-left:20px;">
                            <legend><?php if (isset ( $_GET['action'] ) && $_GET['action'] == 'new_calendar'): ?>Add calendar<?php else: ?>Edit calendar: <strong><?php echo $this->_tpl_vars['calendar']['name']; ?>
</strong><?php endif; ?></legend>

							<?php if (! empty ( $this->_tpl_vars['save_calendar_error'] )): ?>
							<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
								<?php echo $this->_tpl_vars['save_calendar_error']; ?>

							</div>
							<?php endif; ?>

							<?php if (! empty ( $this->_tpl_vars['save_calendar_success'] )): ?>
							<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
								<?php echo $this->_tpl_vars['save_calendar_success']; ?>

							</div>
							<?php endif; ?>

							<form action="<?php echo @FULLCAL_URL; ?>
/admin/calendars/?action=save_calendar" method="post" class="form-horizontal">

                                <div class="control-group">
									<label for="admin_user_calendar_active" class="control-label">Active </label>
									<div class="controls"  style="padding-top:5px;">
                                        <span>
                                            <input type="radio" value="yes" name="active"  style="float:left;margin-right:5px;" id="admin_calendar_active_yes" <?php if ($this->_tpl_vars['calendar']['active'] == 'yes' || ! isset ( $this->_tpl_vars['calendar']['active'] ) || empty ( $this->_tpl_vars['calendar']['active'] )): ?>checked="true"<?php endif; ?> /><label for="admin_calendar_active_yes" style="padding-top:1px;width: 33px;float:left;padding-right:20px;">Yes </label>
                                            <input type="radio" value="no" name="active"  style="float:left;margin-right:5px;" <?php if ($this->_tpl_vars['calendar']['active'] == 'no'): ?>checked="true"<?php endif; ?> /><label for="admin_calendar_active_yes" style="padding-top:1px;width: 33px;float:left;padding-right:20px;">No </label>
                                            <input type="radio" value="period" id="radio_specific_period" name="active"  style="float:left;margin-right:5px;" <?php if ($this->_tpl_vars['calendar']['active'] == 'period'): ?>checked="true"<?php endif; ?> /><label for="admin_calendar_active_yes" style="padding-top:1px;width: 200px;float:left;padding-right:20px;">In specific period </label>
									    </span>
                                    </div>
								</div>
                               
                                <!-- active period -->
                                <div class="control-group">
                                    <label for="admin_calendar_active" class="control-label">Active period </label>
									<span class="simple_starttime_label" style="padding-left:20px;margin-bottom: 0;">From: </span>
                                    <input type="text" name="cal_startdate" id="active_period_datepicker_startdate" value="<?php echo $this->_tpl_vars['calendar']['cal_startdate']; ?>
" <?php if ($this->_tpl_vars['calendar']['active'] != 'period'): ?>disabled="disabled"<?php endif; ?> style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;z-index:9999;">
                                    <span class="simple_endtime_label">Until: </span>
                                        <input type="text" name="cal_enddate" id="active_period_datepicker_enddate" value="<?php echo $this->_tpl_vars['calendar']['cal_enddate']; ?>
" <?php if ($this->_tpl_vars['calendar']['active'] != 'period'): ?>disabled="disabled"<?php endif; ?> style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;" />
                                </div>
                                
                                <!-- alterable period restriction -->
                                <div class="control-group">
                                    <label for="admin_calendar_alterable" class="control-label">Alterable period </label>
									<span class="simple_starttime_label" style="padding-left:20px;margin-bottom: 0;">From: </span>
                                        <input type="text" name="alterable_startdate" id="alterable_period_datepicker_startdate" value="<?php echo $this->_tpl_vars['calendar']['alterable_startdate']; ?>
" style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;z-index:9999;">
                                    <span class="simple_endtime_label">To: </span>
                                        <input type="text" name="alterable_enddate" id="alterable_period_datepicker_enddate" value="<?php echo $this->_tpl_vars['calendar']['alterable_enddate']; ?>
" style="font-size:13px;margin-bottom: 0;width: 95px;padding:3px;" />
                                </div>
                                        
								<div class="control-group">
									<label for="admin_user_calendar_name" class="control-label">Name </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="calendar_name" name="name" placeholder="Name" value="<?php echo $this->_tpl_vars['calendar']['name']; ?>
">
									</div>
								</div>

								<!--<div class="control-group">
									<label for="admin_user_calendar_share_type" class="control-label">Type </label>
									<div class="controls">
										<input type="text" class="input-xlarge" id="calendar_type" name="country" value="<?php echo $this->_tpl_vars['calendar']['share_type']; ?>
">
									</div>
								</div>-->

								<div class="control-group">
									<label for="admin_user_calendar_dditems" class="control-label">DD-items </label>
									<div class="controls">
										<!--<textarea class="input-xlarge" id="calendar_dditems" name="dditems" ><?php echo $this->_tpl_vars['calendar']['dditems']; ?>
</textarea>-->
                                        <input type="hidden" id="calendar_dditems" name="dditems" value="<?php echo $this->_tpl_vars['str_dditems']; ?>
" />
									
                                        <table class="table" style="font-size:14px;width:510px;font-size:13px;margin-bottom:0;">
                                            <thead>
                                                <tr style="">
                                                    <th style="width:50px;border-top:0 none;">Title</th>
                                                    <th style="width:50px;border-top:0 none;">Info</th>
                                                    <th style="width:50px;border-top:0 none;">Color</th>
                                               </tr>
                                            </thead>
                                            <tbody>

                                            <?php $_from = $this->_tpl_vars['calendar']['dditems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                                <tr>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" name="title<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['title']; ?>
" class="admin-dditem-title" id="admin-spectrum-colorpicker-dditem-title-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
" /></td>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" name="info<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['info']; ?>
" class="admin-dditem-info" id="admin-dditem-info-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
" /></td>
                                                    <td style="width:50px;padding:1px;border:none;"><input type="text" class="input-xlarge admin-spectrum-colorpicker-dditems" id="admin-spectrum-colorpicker-dditem-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
" name="dditem_color[]" value="<?php echo $this->_tpl_vars['item']['color']; ?>
" data-title="<?php echo $this->_tpl_vars['item']['title']; ?>
" data-number="<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
"></td>
                                                </tr>
                                               
                                            <?php endforeach; endif; unset($_from); ?>

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
											<option value="only_owner" <?php if ($this->_tpl_vars['calendar']['can_dd_drag'] == 'only_owner'): ?>selected="selected"<?php endif; ?>>Only calendar owner</option>
											<option value="only_loggedin_users" <?php if ($this->_tpl_vars['calendar']['can_dd_drag'] == 'only_loggedin_users'): ?>selected="selected"<?php endif; ?>>Only loggedin users</option>
											<option value="everyone" <?php if ($this->_tpl_vars['calendar']['can_dd_drag'] == 'everyone'): ?>selected="selected"<?php endif; ?>>Everyone</option>
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_calendar_share_type" class="control-label" id="admin_settings_share_type_label">Share type </label>
									<div class="controls">
										<!--  -->
										<select name="share_type" id="admin_settings_share_type">
											<option value="public" <?php if ($this->_tpl_vars['calendar']['share_type'] == 'public'): ?>selected="selected"<?php endif; ?>>Public</option>
											<option value="private" <?php if ($this->_tpl_vars['calendar']['share_type'] == 'private'): ?>selected="selected"<?php endif; ?>>Private (only for me)</option>
											<option value="private_group" <?php if ($this->_tpl_vars['calendar']['share_type'] == 'private_group'): ?>selected="selected"<?php endif; ?>>Private (only group can view)</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_canadd" class="control-label" id="admin_settings_can_add_label"><?php if ($this->_tpl_vars['calendar']['share_type'] == 'private_group'): ?>Group<?php else: ?>Others<?php endif; ?> can add </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_add" name="can_add" <?php if ($this->_tpl_vars['calendar']['can_add'] && $this->_tpl_vars['calendar']['share_type'] != 'private'): ?>checked="true"<?php endif; ?> <?php if ($this->_tpl_vars['calendar']['share_type'] == 'private'): ?>disabled="disabled"<?php endif; ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_canedit" class="control-label" id="admin_settings_can_edit_label"><?php if ($this->_tpl_vars['calendar']['share_type'] == 'private_group'): ?>Group<?php else: ?>Others<?php endif; ?> can edit </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_edit" name="can_edit" <?php if ($this->_tpl_vars['calendar']['can_edit'] && $this->_tpl_vars['calendar']['share_type'] != 'private'): ?>checked="true"<?php endif; ?> <?php if ($this->_tpl_vars['calendar']['share_type'] == 'private'): ?>disabled="disabled"<?php endif; ?> />
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_calendar_candelete" class="control-label" id="admin_settings_can_delete_label"><?php if ($this->_tpl_vars['calendar']['share_type'] == 'private_group'): ?>Group<?php else: ?>Others<?php endif; ?> can delete </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_delete" name="can_delete" <?php if ($this->_tpl_vars['calendar']['can_delete'] && $this->_tpl_vars['calendar']['share_type'] != 'private'): ?>checked="true"<?php endif; ?> <?php if ($this->_tpl_vars['calendar']['share_type'] == 'private'): ?>disabled="disabled"<?php endif; ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_canchange_color" class="control-label" id="admin_settings_can_change_color_label"><?php if ($this->_tpl_vars['calendar']['share_type'] == 'private_group'): ?>Group<?php else: ?>Others<?php endif; ?> can change color </label>
									<div class="controls">
										<input type="checkbox" id="admin_settings_can_change_color" name="can_change_color" <?php if ($this->_tpl_vars['calendar']['can_change_color'] && $this->_tpl_vars['calendar']['share_type'] != 'private'): ?>checked="true"<?php endif; ?> <?php if ($this->_tpl_vars['calendar']['share_type'] == 'private'): ?>disabled="disabled"<?php endif; ?> />
									</div>
								</div>
								<div class="control-group">
									<label for="admin_calendar_default" class="control-label">Default </label>
									<div class="controls">
										<input type="checkbox" name="initial_show" <?php if ($this->_tpl_vars['calendar']['initial_show']): ?>checked="true"<?php endif; ?> />
									    <span id="admin_initial_show_checkbox_label" style="padding-top:5px;vertical-align:middle;">The calendar is shown initially</span>
                                    </div>
								</div>
                               

								<div class="control-group">
									<label for="admin_calendar_color" class="control-label">Color </label>
									<div class="controls" style="width:150px;">
										<input type="text" class="input-xlarge" id="admin-spectrum-colorpicker" name="calendar_color" value="<?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
">
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
										<input type="checkbox" name="users_can_email_event" <?php if ($this->_tpl_vars['calendar']['users_can_email_event']): ?>checked="true"<?php endif; ?> />
									    <span id="admin_users_can_email_event_checkbox_label" style="padding-top:5px;vertical-align:middle;">Users can mail an event to admin/employer</span>
                                    </div>
								</div>
                                <div class="control-group">
									<label for="all_event_mods_to_admin" class="control-label">Automatic </label>
									<div class="controls">
										<input type="checkbox" name="all_event_mods_to_admin" <?php if ($this->_tpl_vars['calendar']['all_event_mods_to_admin']): ?>checked="true"<?php endif; ?> />
									    <span id="admin_all_event_mods_to_admin_checkbox_label" style="padding-top:5px;vertical-align:middle;">Mail all event changes to admin/employer</span>
                                    </div>
								</div>
                                
                                <div class="control-group">
									<label for="admin_calendar_admin_email" class="control-label">Calendar admin email </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" id="admin_calendar_admin_email" name="calendar_admin_email" value="<?php echo $this->_tpl_vars['calendar']['calendar_admin_email']; ?>
"><span style="padding-left:5px;font-style:italic;">When empty MAIL_EVENT_MAILADDRESS from config.php is used</span>
                                    </div>
								</div>
                               
								<input type="hidden" name="calendar_id" value="<?php echo $this->_tpl_vars['calendar']['calendar_id']; ?>
" />
									<div class="form-actions">
										<button id="save-calendar" class="btn btn-primary" name="save-calendar" data-complete-text="Changes saved" data-loading-text="saving..." type="submit">Save changes</button>
									</div>

							</form>


							</div>


					<?php elseif ($this->_tpl_vars['active'] == 'settings'): ?>
						<div id="admin-settings" style="padding-top:20px;padding-left:20px;">
							<legend id="admin_settings_legend">Settings</legend>
                            
                            <p id="admin_settings_info_text" style="padding: 0 0 20px 180px;font-style: italic;">
                                These settings will only be applied when someone is logged in, otherwise the settings from config.php will be used.
                            </p>
                            
							<?php if (! empty ( $this->_tpl_vars['save_settings_error'] )): ?>
							<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
								<?php echo $this->_tpl_vars['save_settings_error']; ?>

							</div>
							<?php endif; ?>

							<?php if (! empty ( $this->_tpl_vars['save_settings_success'] )): ?>
							<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
								<?php echo $this->_tpl_vars['save_settings_success']; ?>

							</div>
							<?php endif; ?>


							<form action="<?php echo @FULLCAL_URL; ?>
/admin/settings/?action=save_settings" method="post" class="form-horizontal">

								<div class="control-group">
									<label for="admin_settings_default_view" class="control-label" id="admin_settings_defaultview_label">Default calendar view </label>
									<div class="controls">
										<!-- month, basicWeek, agendaWeek, basicDay, agendaDay , agendaList-->
										<select name="default_view">
											<option value="month" <?php if ($this->_tpl_vars['settings']['default_view'] == 'month'): ?>selected="selected"<?php endif; ?>>month</option>
											<option value="agendaWeek" <?php if ($this->_tpl_vars['settings']['default_view'] == 'agendaWeek'): ?>selected="selected"<?php endif; ?>>week</option>
											<option value="agendaDay" <?php if ($this->_tpl_vars['settings']['default_view'] == 'agendaDay'): ?>selected="selected"<?php endif; ?>>day</option>
											<option value="agendaList" <?php if ($this->_tpl_vars['settings']['default_view'] == 'agendaList'): ?>selected="selected"<?php endif; ?>>list</option>
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_week_view_type" class="control-label" id="admin_settings_week_view_type_label">Weekview type </label>
									<div class="controls">
										<!-- basicWeek, agendaWeek -->
										<select name="week_view_type">
											<option value="agendaWeek" <?php if ($this->_tpl_vars['settings']['week_view_type'] == 'agendaWeek'): ?>selected="selected"<?php endif; ?>>Agenda week</option>
											<option value="basicWeek" <?php if ($this->_tpl_vars['settings']['week_view_type'] == 'basicWeek'): ?>selected="selected"<?php endif; ?>>Basic week</option>
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_day_view_type" class="control-label" id="admin_settings_day_view_type_label">Dayview type </label>
									<div class="controls">
										<!-- basicDay, agendaDay -->
										<select name="day_view_type">
											<option value="agendaDay" <?php if ($this->_tpl_vars['settings']['day_view_type'] == 'agendaDay'): ?>selected="selected"<?php endif; ?>>Agenda day</option>
											<option value="basicDay" <?php if ($this->_tpl_vars['settings']['day_view_type'] == 'basicDay'): ?>selected="selected"<?php endif; ?>>Basic day</option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="admin_settings_language" class="control-label" id="admin_settings_language_label">Language </label>
									<div class="controls">
										<select name="language">
											<?php $_from = $this->_tpl_vars['current_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['current_languages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['current_languages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['current_languages']['iteration']++;
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['settings']['language'] == $this->_tpl_vars['key']): ?>selected="selected" checked="checked"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
									</div>
								</div>

								<div class="control-group">
									<label for="admin_settings_other_language_label_id" class="control-label" id="admin_settings_other_language_label">Other language </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="other_language" value="<?php echo $this->_tpl_vars['settings']['other_language']; ?>
" /> <span id="admin_settings_two_capitals_label">Two capital characters</span> (eg. EN, ES, DE) - <strong>Custom lang**.js is required in script folder</strong>
									</div>
								</div>

                                
                                <div class="control-group" id="admin_settings_show_am_pm" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_am_pm" <?php if ($this->_tpl_vars['settings']['show_am_pm'] == 'on'): ?>checked="checked"<?php endif; ?> />
										<span id="admin_show_am_pm_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show AM/PM</span>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_show_weeknumbers" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_weeknumbers" <?php if ($this->_tpl_vars['settings']['show_weeknumbers'] == 'on'): ?>checked="checked"<?php endif; ?> />
										<span id="admin_show_weeknumbers_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show weeknumbers</span>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_show_notallowed_messages" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="show_notallowed_messages" <?php if ($this->_tpl_vars['settings']['show_notallowed_messages'] == 'on'): ?>checked="checked"<?php endif; ?> />
										<span id="admin_show_notallowed_messages_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show "not allowed" messages</span>
									</div>
								</div>
                                
                                <div class="control-group">
									<label for="admin_settings_preview_type" class="control-label" id="admin_settings_mouseover_popup_label">Mouseover popup </label>
									<div class="controls">
										<select name="show_view_type">
											<option value="mouseover" <?php if ($this->_tpl_vars['settings']['show_view_type'] == 'mouseover'): ?>selected="selected"<?php endif; ?>>Mouseover</option>
											<option value="none" <?php if ($this->_tpl_vars['settings']['show_view_type'] == 'none'): ?>selected="selected"<?php endif; ?>>None</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_truncate_title" style="margin-bottom:1px;">
									<div class="controls" style="margin-left:20px;padding-bottom:5px;">
										<label id="" class="control-label"></label>
										<input type="checkbox" name="truncate_title" <?php if ($this->_tpl_vars['settings']['truncate_title'] == 'on'): ?>checked="checked"<?php endif; ?> />
										<span id="admin_truncate_title_checkbox_label" style="padding-top:5px;vertical-align:middle;">Truncate title</span>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_truncate_length_label_id" class="control-label" id="admin_settings_truncate_length_label">Title length </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="truncate_length" value="<?php echo $this->_tpl_vars['settings']['truncate_length']; ?>
" /> <span id="admin_settings_amount_of_characters_label">Amount of characters</span>
									</div>
								</div>
                                
                                                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:bold;" id="admin_settings_edit_dialog_label">Edit dialog:</h4>
                                
                                <div class="control-group">
									<label for="admin_settings_colorpicker_type" class="control-label" id="admin_settings_colorpicker_type_label">Colorpicker type </label>
									<div class="controls">
										<select name="editdialog_colorpicker_type">
											<option value="spectrum" <?php if ($this->_tpl_vars['settings']['editdialog_colorpicker_type'] == 'spectrum'): ?>selected="selected"<?php endif; ?>>Spectrum</option>
											<option value="simple" <?php if ($this->_tpl_vars['settings']['editdialog_colorpicker_type'] == 'simple'): ?>selected="selected"<?php endif; ?>>Simple</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_timepicker_type" class="control-label" id="admin_settings_timepicker_type_label">Timepicker type </label>
									<div class="controls">
										<select name="editdialog_timepicker_type">
											<option value="ui" <?php if ($this->_tpl_vars['settings']['editdialog_timepicker_type'] == 'ui'): ?>selected="selected"<?php endif; ?>>jQuery UI</option>
											<option value="simple" <?php if ($this->_tpl_vars['settings']['editdialog_timepicker_type'] == 'simple'): ?>selected="selected"<?php endif; ?>>Simple</option>
											
										</select>
									</div>
								</div>
                                <div class="control-group" id="admin_settings_show_description_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_description_field" <?php if ($this->_tpl_vars['settings']['show_description_field'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_show_description_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show description field</span>
                                    </div>
                                </div><div class="control-group" id="admin_settings_show_location_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_location_field" <?php if ($this->_tpl_vars['settings']['show_location_field'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_show_location_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show location field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="admin_settings_show_phone_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_phone_field" <?php if ($this->_tpl_vars['settings']['show_phone_field'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_show_phone_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show phone field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="admin_settings_show_url_in_edit_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_url_field" <?php if ($this->_tpl_vars['settings']['show_url_field'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_show_url_in_edit_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show url field</span>
                                    </div>
                                </div>
                                <div class="control-group" id="admin_settings_show_delete_confirm_dialog" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="show_delete_confirm_dialog" <?php if ($this->_tpl_vars['settings']['show_delete_confirm_dialog'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_show_delete_confirm_dialog_checkbox_label" style="padding-top:5px;vertical-align:middle;">Show confirm dialog when deleting an item</span>
                                    </div>
                                </div>
                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:bold;" id="admin_settings_hour_calculation_label">Hour calculation:</h4>
                                
                                <div class="control-group">
									<label for="admin_settings_workday_hours_label_id" class="control-label" id="admin_settings_workday_hours_label">Workday hours </label>
									<div class="controls">
                                        <input type="text" class="input-xlarge" style="width:30px;" name="hourcalculation_workday_hours" value="<?php echo $this->_tpl_vars['settings']['hourcalculation_workday_hours']; ?>
" /> <span id="admin_settings_amount_of_hours_label">Amount of hours in a workday</span>
									</div>
								</div>
                                <div class="control-group">
									<label for="admin_settings_default_period_label_id" class="control-label" id="admin_settings_default_period_label">Default period </label>
									<div class="controls">
										<input type="text" class="input-xlarge" style="width:30px;" name="hourcalculation_default_period" value="<?php echo $this->_tpl_vars['settings']['hourcalculation_default_period']; ?>
" /> <span id="admin_settings_initial_period_label">Initial period in months</span>
									</div>
								</div>
                                
                                <h4 style="padding:50px 0 10px 180px;font-weight:bold;" id="admin_settings_registration_label">Registration:</h4>
                                
                                <!--<div class="control-group" id="admin_settings_users_can_register" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="users_can_register" <?php if ($this->_tpl_vars['settings']['users_can_register'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_users_can_register_checkbox_label" style="padding-top:5px;vertical-align:middle;">Users can register</span>
                                    </div>
                                </div>-->
                                <p id="admin_settings_registration_info_label" style="padding-left: 180px;font-style: italic;">
                                    USERS_CAN_REGISTER can be set in config.php
                                </p>
                                <div class="control-group" id="admin_settings_send_activation_mail" style="margin-bottom:1px;">
                                    <div class="controls" style="margin-left:20px;padding-bottom:5px;">
                                        <label id="" class="control-label"></label>
                                        <input type="checkbox" name="send_activation_mail" <?php if ($this->_tpl_vars['settings']['send_activation_mail'] == 'on'): ?>checked="checked"<?php endif; ?> />
                                        <span id="admin_send_activation_mail_checkbox_label" style="padding-top:5px;vertical-align:middle;">Send activation mail</span>
                                    </div>
                                </div>
                                
                                
                                
								<input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
								<div class="form-actions">
									<button id="save-settings" class="btn btn-primary" name="save-settings" data-complete-text="Changes saved" data-loading-text="saving..." type="submit"><span id="save-settings-btn">Save changes</span></button>
								</div>
                                
                                
                                
							</form>
						</div>

					<?php elseif ($this->_tpl_vars['active'] == 'lists'): ?>
						<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
								<?php if (! empty ( $this->_tpl_vars['error'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
									<?php echo $this->_tpl_vars['error']; ?>

								</div>
								<?php endif; ?>

								<?php if (! empty ( $this->_tpl_vars['msg'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
									<?php echo $this->_tpl_vars['msg']; ?>

								</div>
								<?php endif; ?>

                                <span style="float:right;padding-top: 17px;" id="lists_to_excel_btn" class="not_print">
                                    <span class="dashboard_btn not_print">
                                        <i class="icon-th"></i> To Excel
                                    </span>
                                </span>	
                                
								<form id="calendars-form" action="<?php echo @FULLCAL_URL; ?>
/admin/calendars/?action=new_calendar" method="post" class="form-horizontal">
									<?php if (isset ( $_SESSION['add_calendar_error'] )): ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?php echo $_SESSION['add_calendar_error']; ?>

									</div>
									<?php endif; ?>

								</form>
								
								<legend id="admin_settings_hour_calculation_legend">Hour calculation</legend>
								
								
                                <div class="control-group" style="padding: 20px 0 30px 0;">
									<span class="control-label" id="admin_settings_calendars_label" style="width:auto;padding-right:5px;">Calendar </span>
                                    <select id="calendar_selectbox" name="calendar" style="width:150px;margin-bottom: 0;">
                                        <option class="calendar_option" value="all" <?php if ($this->_tpl_vars['selected_calendar'] == 'all'): ?>selected="selected"<?php endif; ?>>All</option>
                                        <?php $_from = $this->_tpl_vars['calendars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                            <option class="calendar_option" value="<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
" <?php if ($this->_tpl_vars['selected_calendar'] == $this->_tpl_vars['item']['calendar_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
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

										<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

											<tr>
												<td><?php echo $this->_tpl_vars['item']['fullname']; ?>
 <?php if ($this->_tpl_vars['item']['superadmin']): ?><span class="label label-important">superadmin</span><?php elseif ($this->_tpl_vars['item']['admin']): ?><span class="label label-important">admin</span><?php endif; ?></td>
												<td><?php echo $this->_tpl_vars['item']['days']; ?>
</td>
												<td><?php echo $this->_tpl_vars['item']['hours']; ?>
</td>
												<td class="not_print"><a href="<?php echo @FULLCAL_URL; ?>
/admin/lists?action=get_list&uid=<?php echo $this->_tpl_vars['item']['user_id']; ?>
<?php if (isset ( $_GET['cid'] ) && ! empty ( $_GET['cid'] )): ?>&cid=<?php echo $_GET['cid']; ?>
<?php endif; ?>">View</a></td>
												
												
											</tr>
										<?php endforeach; else: ?>
											<tr>
												<td>No rows found</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										<?php endif; unset($_from); ?>

										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?to=<?php echo $this->_tpl_vars['from']; ?>
"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>
					<?php elseif ($this->_tpl_vars['active'] == 'list'): ?>
						<div id="admin-users"  style="padding-top:20px;padding-left:20px;">
								<?php if (! empty ( $this->_tpl_vars['error'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:red;font-weight:bold;">
									<?php echo $this->_tpl_vars['error']; ?>

								</div>
								<?php endif; ?>

								<?php if (! empty ( $this->_tpl_vars['msg'] )): ?>
								<div style="position:absolute;left:400px;top:60px;color:green;font-weight:bold;">
									<?php echo $this->_tpl_vars['msg']; ?>

								</div>
								<?php endif; ?>

								
								<!--<form id="calendars-form" action="" method="post" class="form-horizontal">-->
									<?php if (isset ( $_SESSION['add_calendar_error'] )): ?>
									<div style="position:absolute;left:400px;color:red;font-weight:bold;">
										<?php echo $_SESSION['add_calendar_error']; ?>

									</div>
									<?php endif; ?>

                                    <span style="float:right;" id="list_to_excel_btn">
                                        <span class="dashboard_btn">
                                            <i class="icon-th"></i> To Excel
                                        </span>
                                    </span>	
									
								
                                    <legend><span id="admin_settings_user_hour_calculation_legend">Hour calculation of</span> <strong><?php echo $this->_tpl_vars['user']['lastname']; ?>
, <?php echo $this->_tpl_vars['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['user']['infix']; ?>
</strong></legend>
								
								<div class="control-group" style="padding: 20px 0 30px 0;">
									<span class="control-label" id="admin_settings_calendars_label" style="width:auto;padding-right:5px;">Calendar </span>
                                    <select id="calendar_selectbox" name="calendar" style="width:150px;margin-bottom: 0;">
                                        <option class="calendar_option" value="all" <?php if ($this->_tpl_vars['selected_calendar'] == 'all'): ?>selected="selected"<?php endif; ?>>All</option>
                                        <?php $_from = $this->_tpl_vars['calendars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                            <option class="calendar_option" value="<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
" <?php if ($this->_tpl_vars['selected_calendar'] == $this->_tpl_vars['item']['calendar_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
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

										<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

											<tr>
												<td style="width:190px;"><?php echo $this->_tpl_vars['item']['date_start']; ?>
<?php if ($this->_tpl_vars['item']['date_end'] != $this->_tpl_vars['item']['date_start']): ?> - <?php echo $this->_tpl_vars['item']['date_end']; ?>
<?php endif; ?></td>
												<td><?php if ($this->_tpl_vars['item']['allDay']): ?>allday<?php else: ?><?php echo $this->_tpl_vars['item']['time_start']; ?>
 - <?php echo $this->_tpl_vars['item']['time_end']; ?>
<?php endif; ?></td>
												<td><?php echo $this->_tpl_vars['item']['days']; ?>
</td>
												<td><?php echo $this->_tpl_vars['item']['hours']; ?>
</td>
												<td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
											</tr>
										<?php endforeach; endif; unset($_from); ?>
										
										<tr style="border-top:2px solid #333333;">
											<td>Total</td>
											<td>&nbsp;</td>
											<td><?php echo $this->_tpl_vars['total_day_count']; ?>
</td>
											<td><?php echo $this->_tpl_vars['total_hour_count']; ?>
</td>
											<td>&nbsp;</td>
										</tr>
											
										</tbody>
									</table>

								<!--	<div class="pagination"><ul><li class="prev disabled"><a href="<?php echo @FULLCAL_URL; ?>
/admin/calendars?to=<?php echo $this->_tpl_vars['from']; ?>
"> Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next </a></li></ul></div>	</div>-->


							</div>
					
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		MyCalendar.datePickerDateFormat 		= '<?php echo @DATEPICKER_DATEFORMAT; ?>
';
		MyCalendar.last_dditem = '';
        MyCalendar.dditem_string = '';
        
		var current_user = '<?php if (isset ( $this->_tpl_vars['user'] ) && isset ( $this->_tpl_vars['user']['user_id'] )): ?><?php echo $this->_tpl_vars['user']['user_id']; ?>
<?php endif; ?>';
		
		$(document).ready(function() {
			MyCalendar.last_dditem = '<?php echo $this->_tpl_vars['last_dditem']; ?>
';
            
            $('#hourcalc_datepicker_startdate').val('<?php echo $this->_tpl_vars['startdate']; ?>
');
            $('#hourcalc_datepicker_enddate').val('<?php echo $this->_tpl_vars['enddate']; ?>
');
           
            
            $('#active_period_datepicker_startdate').val('<?php echo $this->_tpl_vars['calendar']['cal_startdate']; ?>
');
            $('#active_period_datepicker_enddate').val('<?php echo $this->_tpl_vars['calendar']['cal_enddate']; ?>
');
            
            $('#alterable_period_datepicker_startdate').val('<?php echo $this->_tpl_vars['calendar']['alterable_startdate']; ?>
');
            $('#alterable_period_datepicker_enddate').val('<?php echo $this->_tpl_vars['calendar']['alterable_enddate']; ?>
');
            
			$('.lists_calendar_option').click(function(t) {
				location.href = '<?php echo @FULLCAL_URL; ?>
/admin/lists/?cid='+$(this).val();
			});
            
            $('.calendar_option').click(function(t) {
				//location.href = '<?php echo @FULLCAL_URL; ?>
/admin/lists/?action=get_list&uid='+current_user+'&cid='+$(this).val();
			});
			
            
            $('#dates_clear_button').click(function(t) {
				$('#hourcalc_datepicker_startdate').val('');
                $('#hourcalc_datepicker_enddate').val('');
                
			});
            $('#dates_refresh_button').click(function(t) {
				var startdate = $('#hourcalc_datepicker_startdate').val();
                var enddate = $('#hourcalc_datepicker_enddate').val();
                var selected_cal = $('#calendar_selectbox').val();
                location.href = '<?php echo @FULLCAL_URL; ?>
/admin/lists/?cid='+selected_cal+'&st='+startdate+'&end='+enddate;
			});
            
             $('#user_dates_refresh_button').click(function(t) {
				var startdate = $('#hourcalc_datepicker_startdate').val();
                var enddate = $('#hourcalc_datepicker_enddate').val();
                var selected_cal = $('#calendar_selectbox').val();
                location.href = '<?php echo @FULLCAL_URL; ?>
/admin/lists/?action=get_list&uid='+current_user+'&cid='+selected_cal+'&st='+startdate+'&end='+enddate;
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
			$("#admin-spectrum-colorpicker").val('<?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
');
			$("#admin-spectrum-colorpicker").spectrum('set', '<?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
');
		
            // dditems colors
            <?php $_from = $this->_tpl_vars['calendar']['dditems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            $("#admin-spectrum-colorpicker-dditem-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
").spectrum({
			    showPaletteOnly: true,
				showPalette:true,
			    color: 'blanchedalmond',
			    palette: arr_palette,
			    change: function(color) {
				     // #ff0000
				    $("#admin-spectrum-colorpicker-dditem-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
").val(color.toHexString());
				    $("#admin-spectrum-colorpicker-dditem-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
").spectrum('hide');
				
                    MyCalendar.dditem_string = '';
                    $('.admin-spectrum-colorpicker-dditems').each(function(index,item) {
                        var number = $(item).data('number');                
                        MyCalendar.dditem_string += $('#admin-spectrum-colorpicker-dditem-title-'+number).val() + '|' + $('#admin-dditem-info-'+number).val() + '|' + $(item).val() + ',';
                    });
                    $('#calendar_dditems').val(MyCalendar.dditem_string);
                }
			});
            $("#admin-spectrum-colorpicker-dditem-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
").val('<?php if ($this->_tpl_vars['item']['color'] !== null && ! empty ( $this->_tpl_vars['item']['color'] )): ?><?php echo $this->_tpl_vars['item']['color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
<?php endif; ?>');
			$("#admin-spectrum-colorpicker-dditem-<?php echo $this->_tpl_vars['item']['dditem_id']; ?>
").spectrum('set', '<?php if ($this->_tpl_vars['item']['color'] !== null && ! empty ( $this->_tpl_vars['item']['color'] )): ?><?php echo $this->_tpl_vars['item']['color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
<?php endif; ?>');
            <?php endforeach; endif; unset($_from); ?>
            
            
            
            $('#add_dditem').click(function(t) {
                MyCalendar.last_dditem ++;
                $('.table').append('<tr>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" name="title'+MyCalendar.last_dditem+'" class="admin-dditem-title" id="admin-spectrum-colorpicker-dditem-title-'+MyCalendar.last_dditem+'" value="" /></td>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" name="info'+MyCalendar.last_dditem+'" class="admin-dditem-info" id="admin-dditem-info-'+MyCalendar.last_dditem+'" value="" /></td>'+
                                        '<td style="width:50px;border:none;padding:2px;"><input type="text" class="input-xlarge admin-spectrum-colorpicker-dditems" id="admin-spectrum-colorpicker-dditem-'+MyCalendar.last_dditem+'" name="dditem_color[]" value="<?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
" data-title="" data-number="'+MyCalendar.last_dditem+'"></td>'+
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
                $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).val('<?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
');
                $("#admin-spectrum-colorpicker-dditem-"+MyCalendar.last_dditem).spectrum('set', '<?php echo $this->_tpl_vars['calendar']['calendar_color']; ?>
');
           
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