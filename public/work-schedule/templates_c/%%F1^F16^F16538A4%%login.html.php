<?php /* Smarty version 2.6.18, created on 2015-09-29 08:44:00
         compiled from C:%5Cwamp%5Cwww%5Cemployee-work-schedule/login.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="viewport" content="width=400, initial-scale=1.0">
  
  <meta name="generator" content="">
  <title></title>

<link rel="stylesheet" type="text/css" href="<?php echo @FULLCAL_URL; ?>
/style/style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo @FULLCAL_URL; ?>
/register/css/view.css" media="all">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo @FULLCAL_URL; ?>
/script/lang<?php echo $this->_tpl_vars['language']; ?>
.js'></script>

  <style>

    h3 span {
    	font-style: italic;
    }
    .register {
		padding-top: 20px;

    }
  </style>

  </head>
  <body>
  <div id="wrap">
		<div id="bodyPannel">
		  <form method="post" action="<?php echo @FULLCAL_URL; ?>
/?action=login" >

          	<div class="form_description">
				 <h3><?php echo @CALENDAR_TITLE; ?>
 <span id="login_label">login</span></h3>

				<?php if (isset ( $this->_tpl_vars['msg'] ) && ! empty ( $this->_tpl_vars['msg'] )): ?>
					<span style="color:red;position:relative;font-weight:bold;"><?php echo $this->_tpl_vars['msg']; ?>
</span>
				<?php endif; ?>
			</div>

			<ul >
				<li id="li_4" >
					<span>

          				<input type="text" value="" size="30" name="usern">
          				<label for="user_username" id="login_username_label">Username</label>
					</span>

				</li>
				<li id="li_4" >
					<span>

          				<input type="password" size="30" name="passw">
          				<label for="user_password" id="login_password_label">Password</label>
					</span>
				</li>
			</ul>


        <div class="input-group">
          <input name="login" type="submit" id="login" value="Log in" title="Login" class="submit" />
       </div>

        </form>
	</div>
        <div class="register">
	        <?php if (@USERS_CAN_REGISTER): ?>
	        	<a href="<?php echo @FULLCAL_URL; ?>
/register" id="register_btn">Register</a> |
	        <?php endif; ?>
       	 	<a href="<?php echo @FULLCAL_URL; ?>
/forgotten-password" id="forgotten_password_btn">Forgotten password</a>
        </div>
</div>
      
      <script type="text/javascript">
      $('#login_username_label').html(Lang.Popup.LabelUsername);
      $('#login_password_label').html(Lang.Popup.LabelPassword);
      $('#login').val(Lang.Popup.LabelLogin);
      $('#login_label').html(Lang.Popup.LabelLogin);
      $('#forgotten_password_btn').html(Lang.Button.forgottenPassword);
      $('#register_btn').html(Lang.Button.register);
      
    </script>
      
  </body>
</html>