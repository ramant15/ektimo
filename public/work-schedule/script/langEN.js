var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames        = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    Lang.Fullcalendar.monthNamesShort   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    Lang.Fullcalendar.dayNames          = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    Lang.Fullcalendar.dayNamesShort     = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today  	= 'today';
    Lang.Fullcalendar.buttonText.month  	= 'month';
    Lang.Fullcalendar.buttonText.week   	= 'week';
    Lang.Fullcalendar.buttonText.day    	= 'day';
	Lang.Fullcalendar.buttonText.agendaList = 'list';

	// DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd                		= 'Add an event';
    Lang.Popup.TitleView                	= 'View an event';
    Lang.Popup.TitleEdit                	= 'Edit an event';

    // DIALOG BUTTONS
    Lang.Popup.closeButtonText         		= 'Close';
    Lang.Popup.saveButtonText          		= 'Save';
    Lang.Popup.editButtonText               = 'Edit';
    Lang.Popup.deleteButtonText         	= 'Delete';
    Lang.Popup.saveAndRefreshButtonText 	= 'Save & refresh';
    Lang.Popup.updateButtonText			    = 'Update';
	Lang.Popup.addUserAndSendMailButtonText	= 'Add user and send email';
    Lang.Popup.emailText                    = 'Email to admin';

    // FORM LABELS
    Lang.Popup.allDayLabel              	= 'All day';
    Lang.Popup.MonthLabel               	= 'Date';
    Lang.Popup.TimeLabel                	= 'Time';
    Lang.Popup.StartdateLabel           	= 'Startdate';
    Lang.Popup.EnddateLabel             	= 'Enddate';
    Lang.Popup.SimpleStartTimeLabel 		= '';
    Lang.Popup.SimpleEndTimeLabel 			= ' - ';
    Lang.Popup.EventTitle		        	= 'Title';
    Lang.Popup.EventLocation		    	= 'Location';
    Lang.Popup.EventDescription		    	= 'Description';
	Lang.Popup.EventPhone		    		= 'Phone';
    Lang.Popup.EventUrl                     = 'Url';
    Lang.Popup.EventInterval				= 'Interval';
	Lang.Popup.EventRecurrence				= 'Recurrence';

	Lang.Popup.ProfileEventColor			= 'Events color';
    Lang.Popup.EventColor					= 'Color';
    Lang.Popup.EventColorUseForAllEvents	= 'Use for al my events';
    Lang.Popup.DayOfMonth					= 'Day of month';
	Lang.Popup.DayOfWeek					= 'Day of week';
	Lang.Popup.MonthlyOnDay					= 'Monthly on day';
	Lang.Popup.MonthlyOn					= 'Monthly on';
	Lang.Popup.Starting						= 'starting';
	Lang.Popup.WeeklyOn						= 'Weekly on';
    Lang.Popup.YearlyOn                     = 'Yearly on';
    Lang.Popup.Until                        = 'Until';
    
    Lang.Popup.LabelTabMain		    		= 'Main';
	Lang.Popup.LabelTabFiles		    	= 'Files';
	Lang.Popup.LabelActive		    		= 'Active';
	Lang.Popup.LabelName		    		= 'Name';
	Lang.Popup.LabelEmail		    		= 'Email';
	Lang.Popup.LabelUsername		    	= 'Username';
	Lang.Popup.LabelLogin                   = 'Login';
    Lang.Popup.LabelBirthdate		    	= 'Birthdate';
	Lang.Popup.LabelCountry		    		= 'Country';
	Lang.Popup.LabelLanguage		    	= 'Language';
	Lang.Popup.DefaultView			    	= 'Default view';
	Lang.Popup.LabelPassword		    	= 'Password';
	Lang.Popup.LabelPasswordAgain		    = 'Password again';
	Lang.Popup.LabelNewPassword		    	= 'New Password';
	Lang.Popup.LabelNewPasswordAgain		= 'New password again';
	Lang.Popup.AddUserPasswordText			= 'A password will be generated and included in the email.';
	Lang.Popup.AddUserActivationMailText	= 'The user can activate with the activation link included in the email.';
	Lang.Popup.LabelCopyToAdmin				= 'Copy to admin';
    Lang.Popup.LabelCalendar	    		= 'Calendar';
	
	// FORM PLACEHOLDERS
	Lang.Popup.Placeholder = {};
	Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Leave blank for no change';
	Lang.Popup.Placeholder.Firstname 			= 'Firstname';
	Lang.Popup.Placeholder.Lastname 			= 'Lastname';

	// TIMEPICKER
    Lang.Popup.TimepickerHourtext           = 'Hour';
    Lang.Popup.TimepickerMinutetext         = 'Minute';
    Lang.Popup.TimepickercloseButtonText    = 'OK';
    Lang.Popup.TimepickernowButtonText      = 'Now';

    Lang.Popup.MycalendarTitle				= 'My calendar';

	// MENU
	Lang.Menu = {};
	Lang.Menu.TitleProfile					= 'Profile';
	Lang.Menu.TitleAdduser					= 'Add user';
	Lang.Menu.TitleQuickAdduser				= 'Quickly add user';
	Lang.Menu.TitleAddAdmin					= 'Add admin';
	Lang.Menu.TitleLogout					= 'Log out';
	Lang.Menu.TitleUsers                    = 'Users';
    Lang.Menu.TitleAdmins                   = 'Admins';
    Lang.Menu.TitleCalendars                = 'Calendars';
    Lang.Menu.TitleHourCalculation          = 'Hour Calculation';
    Lang.Menu.TitleSettings					= 'Settings';
	Lang.Menu.TitleAdminArea				= 'Admin area';

    Lang.Button = {};
    Lang.Button.addCalendar                 = 'Add calendar';
    Lang.Button.forgottenPassword           = 'Forgotten password';
    Lang.Button.register                    = 'Register';
    
	// ALERTS
    Lang.Alert = {};
    Lang.Alert.NotAllowedToAdd				= 'You cannot add an event.';
    Lang.Alert.NotAllowedToEdit				= 'You cannot modify this event.';
    Lang.Alert.NotAllowedToEditGoogleEvent	= 'You cannot modify this event, you will be redirected to Google';
    Lang.Alert.NotAllowedToAddOnThisDate    = 'This date is excluded';
    
    Lang.Alert.DatesNotCorrect				= 'Error in the dates.';
    Lang.Alert.TimesNotCorrect				= 'Error in the schedules.';
    Lang.Alert.EventTitleRequired			= 'Title is required.';
	Lang.Alert.ErrorSaving					= 'Error while saving.';
	Lang.Alert.NotLoggedIn					= 'Your login is expired. You will be redirected to the login page.';
	Lang.Alert.Error						= 'Error';
    Lang.Alert.ChooseCalendarFirst			= 'Choose one calendar first';
    Lang.Alert.DoNotForgetToSave			= 'Do not forget to save the event !';
    Lang.Alert.SettingsSavedSuccess			= 'Settings saved successfully';
    
    Lang.Alert.FileTooBig                   = 'The file you are trying to upload is too big';
    Lang.Alert.PartiallyUploaded            = 'The file you are trying upload was only partially uploaded.';
    Lang.Alert.NoFileSelected               = 'You must select a file for upload.';
    Lang.Alert.ProblemWithUpload            = 'There was a problem with your upload.';
    Lang.Alert.LogInToUpload                = 'You have to be logged in to upload files';
    Lang.Alert.FileNotAllowed               = 'This type of file is not allowed';
    
    Lang.Database = {};
    Lang.Database.ConnectFailed				= 'Database connection failed';

	// PROMPTS
    Lang.Prompt = {};
    Lang.Prompt.Update = {};
    Lang.Prompt.Update.repairText			= 'Repair repeating pattern?';

    Lang.Prompt.Delete = {};
  	Lang.Prompt.Delete.RemoveBtn	  		= 'Remove';
  	Lang.Prompt.Delete.CancelBtn			= 'Cancel';
  	Lang.Prompt.Delete.ConfirmTitle  		= 'Remove item';
  	Lang.Prompt.Delete.ConfirmText 			= 'Are you sure you want to remove this item?';
  	Lang.Prompt.Delete.chooseOneOrAllTitle  = 'Remove item(s)';
  	Lang.Prompt.Delete.chooseOneOrAllText 	= 'Do you want to remove only this item or the whole pattern?';
  	Lang.Prompt.Delete.thisItemBtn			= 'This item';
  	Lang.Prompt.Delete.allItemsBtn			= 'Whole pattern';
    
    Lang.Settings = {};
    Lang.Settings.Legend                    = 'Settings';
    Lang.Settings.Infotext                  = 'These settings will only be applied when someone is logged in, otherwise the settings from config.php will be used.';
    Lang.Settings.DefaultView               = 'Default view';
    Lang.Settings.LabelWeekViewType         = 'Weekview type';
    Lang.Settings.LabelDayViewType          = 'Dayview type';
    Lang.Settings.LabelLanguage             = 'Language';
    Lang.Settings.LabelOtherLanguage        = 'Other language';
    Lang.Settings.LabelShowAmPm             = 'Show AM/PM';
    Lang.Settings.LabelShowWeeknumbers      = 'Show weeknumbers';
    Lang.Settings.LabelShowNotAllowedMessages      = 'Show "Not allowed" messages';
    Lang.Settings.LabelMouseoverPopup       = 'Mouseover popup';
    Lang.Settings.LabelTruncateTitle        = 'Shorten title';
    Lang.Settings.LabelTitleLength          = 'Title length';
    Lang.Settings.LabelAmountOfCharacters   = 'Amount of characters';
    Lang.Settings.LabelEditDialog           = 'Edit dialog';
    Lang.Settings.LabelColorPickerType      = 'Colorpicker type';
    Lang.Settings.LabelTimePickerType       = 'Timepicker type';
    Lang.Settings.LabelMouseoverPopup       = 'Show mouseoverpopup';
    Lang.Settings.LabelTwoCapitals          = 'Two capitals';
    Lang.Settings.LabelShowDescription      = 'Show description';
    Lang.Settings.LabelShowLocation         = 'Show location';
    Lang.Settings.LabelShowPhone            = 'Show phone';
    Lang.Settings.LabelShowDeleteConfirmDialog  = 'Show confirm dialog when deleting an item';
    Lang.Settings.LabelHourcalculation      = 'Hour calculation';
    Lang.Settings.LabelWorkdayHours         = 'Workday hours';
    Lang.Settings.LabelDefaultPeriod        = 'Default period';
    Lang.Settings.LabelWorkdayHoursInfo     = 'Amount of hours in a workday';
    Lang.Settings.LabelDefaultPeriodInfo    = 'Initial period in months';
    Lang.Settings.LabelRegistration         = 'Registration';
    Lang.Settings.LabelRegistrationInfo     = 'can be set in config.php';
    Lang.Settings.LabelSendActivationMail   = 'Send activationmail';
    
    Lang.Hourcalculation = {};
    Lang.Hourcalculation.legend             = 'Hour calculation';
    Lang.Hourcalculation.legendOfUser       = 'Hour calculation of ';
    
    Lang.ListView = {};
    Lang.ListView.descriptionLabel          = 'Info: ';
    Lang.ListView.locationLabel             = 'Location: ';
    Lang.ListView.phoneLabel                = 'Phone: ';
    Lang.ListView.urlLabel                  = 'Url: ';
    
    