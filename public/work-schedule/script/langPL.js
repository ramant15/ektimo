var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames        = ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzeń'];
    Lang.Fullcalendar.monthNamesShort   = ['Sty','Lut','Mar','Kwi','Maj','Czer','Lip','Sie','Wrz','Paź','Lis','Gru'];
    Lang.Fullcalendar.dayNames          = ['Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota'];
    Lang.Fullcalendar.dayNamesShort     = ['Nie','Pon','Wto','Śro','Czw','Pią','Sob'];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today  	= 'Dzisiaj';
    Lang.Fullcalendar.buttonText.month  	= 'Miesiąc';
    Lang.Fullcalendar.buttonText.week   	= 'Tydzień';
    Lang.Fullcalendar.buttonText.day    	= 'Dzień';
	Lang.Fullcalendar.buttonText.agendaList = 'Lista';

	// DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd                		= 'Add an event';
    Lang.Popup.TitleView                	= 'View an event';
    Lang.Popup.TitleEdit                	= 'Eytuj';

    // DIALOG BUTTONS
    Lang.Popup.closeButtonText         		= 'Zamknij';
    Lang.Popup.saveButtonText          		= 'zapisz';
    Lang.Popup.editButtonText               = 'Edit';
    Lang.Popup.deleteButtonText         	= 'Usunąć';
    Lang.Popup.saveAndRefreshButtonText 	= 'Zapisz i odśwież';
    Lang.Popup.updateButtonText			    = 'Aktualizacja';
	Lang.Popup.addUserAndSendMailButtonText	= 'Add user and send email';
    Lang.Popup.emailText                    = 'Email do admin';

    // FORM LABELS
    Lang.Popup.allDayLabel              	= 'Cały dzień';
    Lang.Popup.MonthLabel               	= 'Data';
    Lang.Popup.TimeLabel                	= 'Czas';
    Lang.Popup.StartdateLabel           	= 'Start';
    Lang.Popup.EnddateLabel             	= 'End';
    Lang.Popup.SimpleStartTimeLabel 		= 'od';
    Lang.Popup.SimpleEndTimeLabel 			= 'do';
    Lang.Popup.EventTitle		        	= 'Sprzedawca';
    Lang.Popup.EventLocation		    	= 'Location';
    Lang.Popup.EventDescription		    	= 'Opis';
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
    Lang.Popup.TimepickerHourtext           = 'Godzina';
    Lang.Popup.TimepickerMinutetext         = 'Minut';
    Lang.Popup.TimepickercloseButtonText    = 'OK';
    Lang.Popup.TimepickernowButtonText      = 'Teraz';

    Lang.Popup.MycalendarTitle				= 'Li PARIE';

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
    Lang.Alert.NotAllowedToAdd              = 'Nie wolno zmieniać Graf<br>prosimy o kontakt z Martyna';
    Lang.Alert.NotAllowedToEdit				= 'Nie można modyfikować Graf<br>prosimy o kontakt z Martyna';
    Lang.Alert.NotAllowedToEditGoogleEvent	= 'Nie można modyfikować Graf<br>prosimy o kontakt z Martyna';
    Lang.Alert.NotAllowedToAddOnThisDate    = 'Data ta jest wykluczona';
    
    Lang.Alert.DatesNotCorrect				= 'Error in the dates.';
    Lang.Alert.TimesNotCorrect				= 'Error in the schedules.';
    Lang.Alert.EventTitleRequired			= 'Title is required.';
	Lang.Alert.ErrorSaving					= 'Error while saving.';
	Lang.Alert.NotLoggedIn					= 'Twój login jest przedawnione. Zostaniesz przekierowany na stronę logowania.';
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