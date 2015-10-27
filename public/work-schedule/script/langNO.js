var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames        = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];
    Lang.Fullcalendar.monthNamesShort   = ['Jan','Feb','Mar','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Des'];
    Lang.Fullcalendar.dayNames          = ['Søndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag'];
    Lang.Fullcalendar.dayNamesShort     = ['Søn','Man','Tir','Ons','Tor','Fre','Lør'];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today  	= 'I dag';
    Lang.Fullcalendar.buttonText.month  	= 'Måned';
    Lang.Fullcalendar.buttonText.week   	= 'Uke';
    Lang.Fullcalendar.buttonText.day    	= 'dag';
	Lang.Fullcalendar.buttonText.agendaList = 'liste';

	// DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd                		= 'Legg til en hendelse';
    Lang.Popup.TitleView                	= 'Se på en hendelse';
    Lang.Popup.TitleEdit                	= 'Rediger en hendelse';

    // DIALOG BUTTONS
    Lang.Popup.closeButtonText         		= 'Lukk';
    Lang.Popup.saveButtonText          		= 'Lagre';
    Lang.Popup.editButtonText               = 'Rediger';
    Lang.Popup.deleteButtonText         	= 'Slett';
    Lang.Popup.saveAndRefreshButtonText 	= 'Lagre & oppdater';
    Lang.Popup.updateButtonText			    = 'Oppdater';
	Lang.Popup.addUserAndSendMailButtonText	= 'Legg til en bruker og send e-post';
    Lang.Popup.emailText                    = 'E-post til admin';

    // FORM LABELS
    Lang.Popup.allDayLabel              	= 'Hele dager';
    Lang.Popup.MonthLabel               	= 'Dato';
    Lang.Popup.TimeLabel                	= 'Tid';
    Lang.Popup.StartdateLabel           	= 'Start tidspunkt';
    Lang.Popup.EnddateLabel             	= 'Slutt dato';
    Lang.Popup.SimpleStartTimeLabel 		= 'Fra';
    Lang.Popup.SimpleEndTimeLabel 			= 'Til';
    Lang.Popup.EventTitle		        	= 'Navn';
    Lang.Popup.EventLocation		    	= 'Plassering';
    Lang.Popup.EventDescription		    	= 'Beskrivelse';
	Lang.Popup.EventPhone		    		= 'Telefon nr.';
    Lang.Popup.EventUrl                     = 'Url';
    Lang.Popup.EventInterval				= 'Interval';
	Lang.Popup.EventRecurrence				= 'Gjentagelse';

	Lang.Popup.ProfileEventColor			= 'Farge på hendelsen';
    Lang.Popup.EventColor					= 'Farger';
    Lang.Popup.EventColorUseForAllEvents	= 'Brukes på alle mine hendelser';
    Lang.Popup.DayOfMonth					= 'Dag og måned';
	Lang.Popup.DayOfWeek					= 'Dag og uke';
	Lang.Popup.MonthlyOnDay					= 'Monthly on day';
	Lang.Popup.MonthlyOn					= 'Monthly on';
	Lang.Popup.Starting						= 'starting';
	Lang.Popup.WeeklyOn						= 'Weekly on';
    Lang.Popup.YearlyOn                     = 'Yearly on';
    Lang.Popup.Until                        = 'Until';
    
	Lang.Popup.LabelTabMain		    		= 'Main';
	Lang.Popup.LabelTabFiles		    	= 'Files';
	Lang.Popup.LabelActive		    		= 'Active';
	Lang.Popup.LabelName		    		= 'Navn/tittel';
	Lang.Popup.LabelEmail		    		= 'E-post';
	Lang.Popup.LabelUsername		    	= 'Brukernavn';
	Lang.Popup.LabelLogin                   = 'Login';
    Lang.Popup.LabelBirthdate		    	= 'Birthdate';
	Lang.Popup.LabelCountry		    		= 'Land';
	Lang.Popup.LabelLanguage		    	= 'Språk';
	Lang.Popup.DefaultView			    	= 'standardvisning';
	Lang.Popup.LabelPassword		    	= 'Passord';
	Lang.Popup.LabelPasswordAgain		    = 'Gjenta passord';
	Lang.Popup.LabelNewPassword		    	= 'Nytt passord';
	Lang.Popup.LabelNewPasswordAgain		= 'Gjenta nytt passord';
	Lang.Popup.AddUserPasswordText			= 'Et passord vil bli generert og inkluderes i e-posten.';
	Lang.Popup.AddUserActivationMailText	= 'Brukeren kan aktivere aktiverings-linken i tilsendt e-post.';
	Lang.Popup.LabelCopyToAdmin				= 'Kopier til administrator';
    Lang.Popup.LabelCalendar	    		= 'Calendar';
	
	// FORM PLACEHOLDERS
	Lang.Popup.Placeholder = {};
	Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Ingen endring, la det stå tomt';
	Lang.Popup.Placeholder.Firstname 			= 'Navn';
	Lang.Popup.Placeholder.Lastname 			= 'Etternavn';

	// TIMEPICKER
    Lang.Popup.TimepickerHourtext           = 'Timer';
    Lang.Popup.TimepickerMinutetext         = 'Minutt';
    Lang.Popup.TimepickercloseButtonText    = 'OK';
    Lang.Popup.TimepickernowButtonText      = 'Nå';

    Lang.Popup.MycalendarTitle				= 'Min kalender';

	// MENU
	Lang.Menu = {};
	Lang.Menu.TitleProfile					= 'Profil';
	Lang.Menu.TitleAdduser					= 'Legg til bruker';
	Lang.Menu.TitleQuickAdduser				= 'Quickly add user';
	Lang.Menu.TitleAddAdmin					= 'Legg til administrator';
	Lang.Menu.TitleLogout					= 'Logg ut';
	Lang.Menu.TitleUsers                    = 'Bruker';
    Lang.Menu.TitleAdmins                   = 'Admins';
    Lang.Menu.TitleCalendars                = 'Kalendere';
    Lang.Menu.TitleHourCalculation          = 'Time beregning';
    Lang.Menu.TitleSettings					= 'Innstillinger';
	Lang.Menu.TitleAdminArea				= 'Admin område';

    Lang.Button = {};
    Lang.Button.addCalendar                 = 'Legg til en kalender';
    Lang.Button.forgottenPassword           = 'Forgotten password';
    Lang.Button.register                    = 'Register';
    
	// ALERTS
    Lang.Alert = {};
    Lang.Alert.NotAllowedToAdd				= 'Du kan ikke legge til en hendelse før du er legget inn.';
    Lang.Alert.NotAllowedToEdit				= 'Du kan ikke endre denne hendelsen.';
    Lang.Alert.NotAllowedToEditGoogleEvent	= 'Du kan ikke endre denne hendelsen, vil du bli omdirigert til Google';
    Lang.Alert.NotAllowedToAddOnThisDate    = 'Denne datoen er utelukket';
    
    Lang.Alert.DatesNotCorrect				= 'Feil i datoene.';
    Lang.Alert.TimesNotCorrect				= 'Feil i tidsplaner.';
    Lang.Alert.EventTitleRequired			= 'Tittel er påkrevet.';
	Lang.Alert.ErrorSaving					= 'Feil under lagring. Prøv igjen senere';
	Lang.Alert.NotLoggedIn					= 'Påloggingen er utløpt. Du vil bli omdirigert til påloggingssiden.';
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
    Lang.Database.ConnectFailed				= 'Databasetilkobling mislyktes';

	// PROMPTS
    Lang.Prompt = {};
    Lang.Prompt.Update = {};
    Lang.Prompt.Update.repairText			= 'Reparasjon av gjentagende mønster?';

    Lang.Prompt.Delete = {};
  	Lang.Prompt.Delete.RemoveBtn	  		= 'Fjern';
  	Lang.Prompt.Delete.CancelBtn			= 'Avbryt';
  	Lang.Prompt.Delete.ConfirmTitle  		= 'Fjern element';
  	Lang.Prompt.Delete.ConfirmText 			= 'Er du sikker på at du vil fjerne dette elementet?';
  	Lang.Prompt.Delete.chooseOneOrAllTitle  = 'Fjern element(er)';
  	Lang.Prompt.Delete.chooseOneOrAllText 	= 'Ønsker du å fjerne bare dette elementet eller hele mønsteret?';
  	Lang.Prompt.Delete.thisItemBtn			= 'dette element';
  	Lang.Prompt.Delete.allItemsBtn			= 'Alt sammen';
    
    Lang.Settings = {};
    Lang.Settings.Legend                    = 'Settings';
    Lang.Settings.Infotext                  = '.These settings will only be applied when someone is logged in, otherwise the settings from config.php will be used.';
    Lang.Settings.DefaultView               = 'Default view';
    Lang.Settings.LabelWeekViewType         = 'Visningstype, uke';
    Lang.Settings.LabelDayViewType          = 'Visningstype, dag';
    Lang.Settings.LabelLanguage             = 'Språk';
    Lang.Settings.LabelOtherLanguage        = 'Andre Språk';
    Lang.Settings.LabelOtherLanguageInfo    = 'To store tegn ';
    Lang.Settings.LabelShowAmPm             = 'Vis AM/PM';
    Lang.Settings.LabelShowWeeknumbers      = 'Vis ukenummer';
    Lang.Settings.LabelShowNotAllowedMessages      = 'Vis "ikke tillatt" -meldinger';
    Lang.Settings.LabelMouseoverPopup       = 'Mouseover popup';
    Lang.Settings.LabelTruncateTitle        = 'Avkortet tittel';
    Lang.Settings.LabelTitleLength          = 'Title length';
    Lang.Settings.LabelAmountOfCharacters   = 'Antall tegn';
    Lang.Settings.LabelEditDialog           = 'Rediger dialogboksen';
    Lang.Settings.LabelColorPickerType      = 'Colorpicker type';
    Lang.Settings.LabelTimePickerType       = 'Timepicker type';
    Lang.Settings.LabelMouseoverPopup       = 'Show mouseoverpopup';
    Lang.Settings.LabelTwoCapitals          = 'To store tegn';
    Lang.Settings.LabelShowDescription      = 'Vis rubrikk for beskrivelse';
    Lang.Settings.LabelShowLocation         = 'Vis rubrikk for tilholdssted';
    Lang.Settings.LabelShowPhone            = 'Vis rubrikk for telefon';
    Lang.Settings.LabelShowDeleteConfirmDialog  = 'Vis dialogboksen Bekreft når du sletter et element';
    Lang.Settings.LabelHourcalculation      = 'Time beregning';
    Lang.Settings.LabelWorkdayHours         = 'Workday hours';
    Lang.Settings.LabelDefaultPeriod        = 'Default period';
    Lang.Settings.LabelWorkdayHoursInfo     = 'Amount of hours in a workday';
    Lang.Settings.LabelDefaultPeriodInfo    = 'Initial period in months';
    Lang.Settings.LabelRegistration         = 'Registration';
    Lang.Settings.LabelRegistrationInfo     = 'can be set in config.php';
    Lang.Settings.LabelSendActivationMail   = 'Send activationmail';
    
    Lang.Hourcalculation = {};
    Lang.Hourcalculation.legend             = 'Time beregning';
    Lang.Hourcalculation.legendOfUser       = 'Time beregning av ';
    
    Lang.ListView = {};
    Lang.ListView.descriptionLabel          = 'Info: ';
    Lang.ListView.locationLabel             = 'Plassering: ';
    Lang.ListView.phoneLabel                = 'Phone: ';
    Lang.ListView.urlLabel                  = 'Url: ';