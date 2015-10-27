<?php /* Smarty version 2.6.18, created on 2015-09-29 08:43:57
         compiled from C:%5Cwamp%5Cwww%5Cemployee-work-schedule/view/dialogs/dlg_event_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'C:\\wamp\\www\\employee-work-schedule/view/dialogs/dlg_event_edit.html', 207, false),)), $this); ?>
<style type="text/css">
    #dialog-message {
		height: 100%;
    }

    #form_container label {
        display:block;
		/*font-weight:bold;*/
		text-align:right;
		width:100px;
		float:left;
		padding-top:2px;
    }
    #form_container input[type="text"],textarea,select {
        float:left;
		font-size:12px;
		padding:3px 3px;
		border:solid 1px #aacfe4;
		width:250px;
		margin:2px 0 2px 5px;
    }
	#form_container select {
        float:left;
		font-size:12px;
		padding:3px 3px;
		border:solid 1px #aacfe4;
		width: 110px;
		margin:2px 0 2px 5px;
        background-color: #FFFFFF;
        border-radius: 3px;
        height: 28px;
    }

	.controls textarea {
		border-radius: 3px;
		font-size: 12px;
	}
	#editdialog-colpick-colorpicker {
		border:0;
		width:70px;
		border-right:20px solid green;
		border-image: none;
		border-style: solid;
		border-width: 1px 20px 1px 1px !important;
	}

	.sp-container {
		width:185px;
	}
    
    hr {
        border: none;
        height: 1px;
        /* Set the hr color */
        color: #acacac; /* old IE */
        background-color: #acacac; /* Modern Browsers */
    }
	
    </style>
    <div id="dialog-message" style="display: none;">
		<?php if (@SHOW_FILE_UPLOAD): ?>
        <ul>
            <li><a href="#tab1" id="edit_dialog_tab_info">Main</a></li>
            <li><a href="#tab2" id="edit_dialog_tab_files">Files</a></li>
        </ul>
        
        <div id="tab1">
        <?php endif; ?>
        
        <div id= "error_message" style="height:20px;font-size:10pt;color:#FF0004;" ></div>
		<form class="form-horizontal" >
			<div id="form_container" >
				
                
                <!-- in script.js it is determined if the colorpicker should be visible or not -->
					<?php if ($this->_tpl_vars['settings']['editdialog_colorpicker_type'] == 'spectrum'): ?>
						<div class="control-group" id="editdialog_colorpicker">
							<label id="color_label_id" class="control-label">Color: </label>
							<div class="controls" style="margin-left:100px !important;" >
								<input type="text" style="width:60px;" class="input-xlarge" id="togglePaletteOnly" name="event_color">

							</div>
						</div>
					<?php else: ?>
						<div style="padding: 10px;text-align:right;" id="editdialog_simple_colorpicker">
							<span class="dialog_formfield" id="ColorPicker1"></span>
							<span id="ColorSelectionTarget1">&nbsp;</span>
						</div>
					<?php endif; ?>

                    <?php if (@MOVE_EVENT_TO_OTHER_CALENDAR_POSSIBLE): ?>
                    <div class="control-group" id="calendar_id_change_field" style="margin-bottom:1px;">
						<label id="calendar_label_id" class="control-label">Calendar: </label>
						<div class="controls" style="margin-left:0;">
                            <select id="edit_dlg_calendar_selectbox" name="calendar_id" style="width:150px;margin-bottom: 0;" >
                                <?php $_from = $this->_tpl_vars['movable_to']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                    <option class="calendar_option" value="<?php echo $this->_tpl_vars['item']['calendar_id']; ?>
" ><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
						</div>
					</div>
                    <?php endif; ?>
                    
                <?php if ($this->_tpl_vars['settings']['show_description_field'] == 'on'): ?>
					<div class="control-group" style="margin-bottom:1px;">
						<label id="title_label_id" class="control-label">Title: </label>
						<div class="controls" style="margin-left:0;">
							<input type="text" class="input-xlarge" id="edited_title"  >
						</div>
					</div>
					<?php if ($this->_tpl_vars['settings']['show_location_field'] == 'on'): ?>
						<div class="control-group" style="margin-bottom:1px;">
							<label id="location_label_id" class="control-label">Location: </label>
							<div class="controls" style="margin-left:0;">
								<input type="text" class="input-xlarge" id="edited_location"  >
							</div>
						</div>

					<?php endif; ?>
						<div class="control-group" style="margin-bottom:1px;">
							<label id="description_label_id" class="control-label">Description: </label>
							<div class="controls" style="margin-left:0;">
								<textarea style="border-radius: 3px;font-size: 12px;" cols="30" rows="4" id="edited_description"></textarea>
							</div>
						</div>

				<?php else: ?>
					<div class="control-group" style="margin-bottom:1px;">
							<label id="title_label_id" class="control-label">Title: </label>
							<div class="controls" style="margin-left:0;">
								<textarea style="border-radius: 3px;font-size: 12px;" cols="30" rows="4" id="edited_title"></textarea>
							</div>
						</div>


					<?php if ($this->_tpl_vars['settings']['show_location_field'] == 'on'): ?>
						<div class="control-group" style="margin-bottom:1px;">
							<label id="location_label_id" class="control-label">Location: </label>
							<div class="controls" style="margin-left:0;">
								<input type="text" class="input-xlarge" id="edited_location" >
							</div>
						</div>

					<?php endif; ?>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['settings']['show_phone_field'] == 'on'): ?>
					<div class="control-group" style="margin-bottom:1px;">
						<label id="phone_label_id" class="control-label">Phone: </label>
						<div class="controls" style="margin-left:0;">
							<input type="text" class="input-xlarge" id="edited_phone" >
						</div>
					</div>


				<?php endif; ?>
                
                <?php if ($this->_tpl_vars['settings']['show_url_field'] == 'on'): ?>
					<div class="control-group" style="margin-bottom:1px;">
						<label id="myurl_label_id" class="control-label">Url: </label>
						<div class="controls" style="margin-left:0;">
							<input type="text" class="input-xlarge" id="edited_myurl" >
                            <span style="padding:5px;top:8px;position:relative;"><a href="#"style="text-decoration:none;" id="go_myurl_btn">---> </a></span>
						</div>
					</div>
				<?php endif; ?>

				<?php if (@SHOW_DATE_SELECTION): ?>
				<label id="month_label_id">Startdate: </label>
					<input type="text" id="datepicker_startdate" style="font-size:13px;width: 80px;padding:3px;z-index:9999;">
					<input type="text" id="timepicker_starttime" style="font-size:13px;width: 80px;padding:3px;">
					<input style="float:right;position: relative; top: 5px; left: -6px;" type="checkbox" id="allday_checkbox" /><span id="wholeday_label_id" style="left: -5px;float:right;position: relative; top: 5px;">Hele dag</span><br style="clear:both;" />
				<label id="time_label_id">Enddate: </label>
					<input type="text" id="datepicker_enddate" style="font-size:13px;width: 80px;padding:3px;" />
					<input type="text" id="timepicker_endtime" style="font-size:13px;width: 80px;padding:3px;" /><br /><br />
				<?php endif; ?>


				<div style="margin-bottom: 5px;" id="interval_container">
					<label id="interval_label_id">Interval: </label>
					<select name="interval" id="interval_div">
						<option value="D" <?php if ($this->_tpl_vars['interval'] == 'D'): ?>selected="true" <?php endif; ?>>Daily</option>
						<option value="W" <?php if ($this->_tpl_vars['interval'] == 'W'): ?>selected="true" <?php endif; ?>>Weekly</option>
						<option value="M" <?php if ($this->_tpl_vars['interval'] == 'M'): ?>selected="true" <?php endif; ?>>Monthly</option>
						<option value="Y" <?php if ($this->_tpl_vars['interval'] == 'Y'): ?>selected="true" <?php endif; ?>>Yearly</option>
					</select>
				</div>
				<div id="interval_day_div" style="margin-bottom: 5px;display:none;text-align:left;clear:left;padding-top:3px;">
					<label id="recurrence_label_id">Recurrence: </label>
					<div style="padding-top:3px;">
						<span class=""><input checked="true" type="checkbox" name="day_1" value="1" >M</span>
						<span class=""><input type="checkbox" name="day_2" value="2" >T</span>
						<span class=""><input type="checkbox" name="day_3" value="3" >W</span>
						<span class=""><input type="checkbox" name="day_4" value="4" >T</span>
						<span class=""><input type="checkbox" name="day_5" value="5" >F</span>
						<span class=""><input type="checkbox" name="day_6" value="6" >S</span>
						<span class=""><input type="checkbox" name="day_7" value="7" >S</span>
					</div>
				</div>
				<div id="interval_month_choice_div" style="margin-bottom: 5px;display:none;text-align:left;clear:left;">
					<label id="recurrence_label_id">Recurrence: </label>
					<span><input type="radio" name="monthday" id="monthly_dom" checked="true" value="dom" >Dag van maand</span>
					<span><input type="radio" name="monthday" id="monthly_dow" value="dow">Dag van week</span>
				</div>
                <div id="interval_year_choice_div" style="margin-bottom: 35px;display:none;text-align:left;clear:left;">
					<label id="recurrence_label_id">Recurrence: </label>
					<span><input type="text" style="width:20px;" name="yearday" id="yearly_dom" checked="true" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['yearday'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
" ></span>
					<span>
                        <select name="yearmonth" id="yearly_month">
                            <option value="0" <?php if ($this->_tpl_vars['yearmonth'] == '0'): ?>selected="true" <?php endif; ?>>January</option>
                            <option value="1" <?php if ($this->_tpl_vars['yearmonth'] == '1'): ?>selected="true" <?php endif; ?>>February</option>
                            <option value="2" <?php if ($this->_tpl_vars['yearmonth'] == '2'): ?>selected="true" <?php endif; ?>>March</option>
                            <option value="3" <?php if ($this->_tpl_vars['yearmonth'] == '3'): ?>selected="true" <?php endif; ?>>April</option>
                            <option value="4" <?php if ($this->_tpl_vars['yearmonth'] == '4'): ?>selected="true" <?php endif; ?>>May</option>
                            <option value="5" <?php if ($this->_tpl_vars['yearmonth'] == '5'): ?>selected="true" <?php endif; ?>>June</option>
                            <option value="6" <?php if ($this->_tpl_vars['yearmonth'] == '6'): ?>selected="true" <?php endif; ?>>July</option>
                            <option value="7" <?php if ($this->_tpl_vars['yearmonth'] == '7'): ?>selected="true" <?php endif; ?>>August</option>
                            <option value="8" <?php if ($this->_tpl_vars['yearmonth'] == '8'): ?>selected="true" <?php endif; ?>>September</option>
                            <option value="9" <?php if ($this->_tpl_vars['yearmonth'] == '9'): ?>selected="true" <?php endif; ?>>October</option>
                            <option value="10" <?php if ($this->_tpl_vars['yearmonth'] == '10'): ?>selected="true" <?php endif; ?>>November</option>
                            <option value="11" <?php if ($this->_tpl_vars['yearmonth'] == '11'): ?>selected="true" <?php endif; ?>>December</option>
                        </select>
                    </span>
                    
				</div>
                <div id="info_txt" style="text-align:center;color:blue;"></div>

                <div style="margin: 3px 0;">
					<input type="hidden" name="event_id" id="event_id" value="" />
				</div>
				<div id= "error_message" >

                </div>
			</div>
			<!--<br /><input style="float:left;" value="Item verwijderen" type="button" id="del_btn">-->
		</form>
        </div>
        
        <?php if (@SHOW_FILE_UPLOAD): ?>
        <div id="tab2">
            <div id="files_div" style="padding:10px;padding-bottom:20px;">
                
            </div>
            <?php if ($this->_tpl_vars['user_id'] !== null && $this->_tpl_vars['user_id'] !== 1000000): ?>
            
            <form id="file_upload_form">
                <table>

                    <tr>
                      <td colspan="2">Add a file</td>
                    </tr>
                    <hr />
                    <tr>
                      <th>Select File </th>
                      <td><input name="file" type="file" id="select_file_field" /></td>
                    </tr>
                    
                    <tr>
                      <td colspan="2">
                          <input type="hidden" name="upload_event_id" id="upload_event_id" value="" />
                        <input type="submit" value="submit"/> 
                      </td>
                    </tr>

                </table>
            </form>
            <div id="max_ten_files_div">
                Max. <?php if (@MAX_EVENT_FILE_UPLOAD !== null): ?><?php echo @MAX_EVENT_FILE_UPLOAD; ?>
<?php else: ?>10<?php endif; ?> files uploaded
            </div>
            <?php else: ?>
            <br /><div id="login_to_upload">You have to be logged in to upload files</div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
		<!--<b>Hint:</b><span style="font-size: 10px;"> There may have been an all day booking, or perhaps a conflicting booking. Try booking another time slot!</span>-->

		<script text="javascript">
			$(document).ready(function() {
				<?php if ($this->_tpl_vars['settings']['editdialog_colorpicker_type'] == 'spectrum'): ?>
					$("#togglePaletteOnly").spectrum({
					    showPaletteOnly: true,
    					showPalette:true,
					    color: 'blanchedalmond',
					    palette: [
					        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					    ],
					    change: function(color) {
						     // #ff0000
						    $("#togglePaletteOnly").val(color.toHexString());
						    $("#togglePaletteOnly").spectrum('hide');
						}
					});
					$("#togglePaletteOnly").val(MyCalendar.currentCalendarColor);
					$("#togglePaletteOnly").spectrum('set', MyCalendar.currentCalendarColor);
				<?php endif; ?>
                
                $("#file_upload_form").submit(function(evt){	
                    if($('#event_id').val() !== null && $('#event_id').val() !== '' && $('#event_id').val() > 0) {
                        evt.preventDefault();
                        evt.stopImmediatePropagation();

                        var formData = new FormData($(this)[0]); 

                        $.ajax({
                            url: MyCalendar.FULLCAL_URL +'/?action=upload',
                            type: 'POST',
                            data: formData,
                            async: false,
                            cache: false,
                            contentType: false,
                            enctype: 'multipart/form-data',
                            processData: false,
                            dataType: 'json',
                            success: function (response) {
                                if(response.success) {
                                    var row = response.file;
                                    //return true;
                                    $('#select_file_field').val('');

                                    var strFiles = '<span class="delete_file_btn" onClick="deleteFile('+row.event_id+','+row.event_file_id+');return false;" data-event_id="'+row.event_id+'" title="Delete file" alt="Delete file" style="padding-right:3px;vertical-align:top;"><img src="'+MyCalendar.FULLCAL_URL+'/images/error.png" /></span><a target="_blank" title="Open file" alt="Open file" href="'+MyCalendar.FULLCAL_URL+'/uploads/'+row.filename+'.'+row.extension+'">' + row.original_filename + '</a><br />';

                                    $('#files_div').append(strFiles);
                                    
                                    if(parseInt(response.cnt_files) >= MyCalendar.maxEventFileUpload) {
                                        // hide the upload form
                                        $('#file_upload_form').hide();
                                        $('#max_ten_files_div').show();
                                    } else {
                                        $('#file_upload_form').show();
                                        $('#max_ten_files_div').hide();
                                    }
                                } else {
                                    switch(response.error) {
                                        case 'TOO_BIG':
                                            alert(Lang.Alert.FileTooBig);
                                            break;
                                        case 'PARTIALLY_UPLOADED':
                                            alert(Lang.Alert.PartiallyUploaded);
                                            break;
                                        case 'NO_FILE_SELECTED':
                                            alert(Lang.Alert.NoFileSelected);
                                            break;
                                        case 'PROBLEM_WITH_UPLOAD':
                                            alert(Lang.Alert.ProblemWithUpload);
                                            break;
                                        case 'FILE_NOT_ALLOWED':
                                            alert(Lang.Alert.FileNotAllowed);
                                            break;
                                        default: 
                                            alert('Unknown error');
                                            break;
                                    }
                                }
                             }
                        });
                    } else {

                    }


                  //  return true;
                });
        
//                $(document).on('click', '.delete_file_btn', function () {
//                    var transaction_id = $(this).attr('id').replace('delete_', '');
//                    alert("Delete transaction #" + transaction_id);
//                    return false;
//                });
                deleteFile = function(event_id, event_file_id) {
                    
                    
              // $('.delete_file_btn').click(function(e) {console.log(e, $(this));
                    var data = {
                        event_id: event_id,
                        event_file_id: event_file_id
                    };

                    $.ajax({
                        type: "POST",
                        url: MyCalendar.FULLCAL_URL + '/?action=remove_file',
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
                }//);
                
                $('#login_to_upload').html(Lang.Alert.LogInToUpload);
			});
		</script>
	</div>