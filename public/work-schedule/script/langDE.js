var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames        = ["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"]
    Lang.Fullcalendar.monthNamesShort   = ["Jan","Feb","Mär","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"];
    Lang.Fullcalendar.dayNames          = ["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"];
    Lang.Fullcalendar.dayNamesShort     = ["So","Mo","Di","Mi","Do","Fr","Sa"];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today  = 'heute';
    Lang.Fullcalendar.buttonText.month  = 'Monat';
    Lang.Fullcalendar.buttonText.week   = 'Woche';
    Lang.Fullcalendar.buttonText.day    = 'Tag';
	Lang.Fullcalendar.buttonText.agendaList    = 'Agenda';

    // DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd                 = 'Item hinzufügen';
    Lang.Popup.TitleView                = 'Item ansehen';
    Lang.Popup.TitleEdit                = 'Item ändern';

    // DIALOG BUTTONS
    Lang.Popup.closeButtonText          = 'Schliessen';
    Lang.Popup.saveButtonText          	= 'Speichern';
    Lang.Popup.editButtonText           = 'Ändern';
    Lang.Popup.deleteButtonText         = 'Entfernen';
    Lang.Popup.saveAndRefreshButtonText = 'Speichern und erneuern';
    Lang.Popup.updateButtonText			= 'Update';
    Lang.Popup.addUserAndSendMailButtonText	= 'Add user and send email';
    Lang.Popup.emailText                    = 'Email an den Admin';

    // FORM LABELS
    Lang.Popup.allDayLabel              = 'Ganztägig';
    Lang.Popup.MonthLabel               = 'Datum';
    Lang.Popup.TimeLabel                = 'Zeit';
    Lang.Popup.StartdateLabel           = 'Startdatum';
    Lang.Popup.EnddateLabel             = 'Endedatum';
    Lang.Popup.SimpleStartTimeLabel 	= 'Von';
    Lang.Popup.SimpleEndTimeLabel 		= 'Bis';
    Lang.Popup.EventTitle		        = 'Titel';
    Lang.Popup.EventLocation		    = 'Ort';
    Lang.Popup.EventDescription		    = 'Beschreibung';
	Lang.Popup.EventPhone		    		= 'Telefon';
    Lang.Popup.EventUrl                     = 'Url';
    Lang.Popup.EventInterval				= 'Interval';
	Lang.Popup.EventRecurrence				= 'Wiederholung';

	Lang.Popup.ProfileEventColor			= 'Items farbe';
    Lang.Popup.EventColor					= 'Farbe';
    Lang.Popup.EventColorUseForAllEvents	= 'Verwenden für alle meine Items';
    Lang.Popup.DayOfMonth					= 'Tag des Monats';
	Lang.Popup.DayOfWeek					= 'Wochentag';
	Lang.Popup.MonthlyOnDay					= 'Monatlich am Tag';
	Lang.Popup.MonthlyOn					= 'Monatlich am ';
	Lang.Popup.Starting						= 'ab';
	Lang.Popup.WeeklyOn						= 'Wöchentlich am';
    Lang.Popup.YearlyOn                     = 'Jährlich am';
    Lang.Popup.Until                        = 'bis';
    
    Lang.Popup.LabelTabMain		    		= 'Main';
	Lang.Popup.LabelTabFiles		    	= 'Files';
	Lang.Popup.LabelActive		    		= 'Active';
	Lang.Popup.LabelName		    		= 'Name';
	Lang.Popup.LabelEmail		    		= 'Email';
	Lang.Popup.LabelUsername		    	= 'Benutzername';
	Lang.Popup.LabelLogin                   = 'Login';
    Lang.Popup.LabelBirthdate		    	= 'Geburtstag';
	Lang.Popup.LabelCountry		    		= 'Land';
	Lang.Popup.LabelLanguage		    	= 'Sprache';
	Lang.Popup.DefaultView			    	= 'Standard-Ansicht';
	Lang.Popup.LabelPassword		    	= 'Kennwort';
	Lang.Popup.LabelPasswordAgain		    = 'Nochmal Kennwort';
	Lang.Popup.LabelNewPassword		    	= 'Neues Kennwort';
	Lang.Popup.LabelNewPasswordAgain		= 'Nochmal Neues Kennwort';
	Lang.Popup.AddUserPasswordText			= 'A password will be generated and included in the email.';
	Lang.Popup.AddUserActivationMailText	= 'The user can activate with the activation link included in the email.';
	Lang.Popup.LabelCopyToAdmin				= 'Kopie nach admin';
    Lang.Popup.LabelCalendar	    		= 'Kalender';
	
    // FORM PLACEHOLDERS
	Lang.Popup.Placeholder = {};
	Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Leave blank for no change';
	Lang.Popup.Placeholder.Firstname 			= 'Vorname';
	Lang.Popup.Placeholder.Lastname 			= 'Nachname';

	// TIMEPICKER
	Lang.Popup.TimepickerHourtext             = 'Stunde';
    Lang.Popup.TimepickerMinutetext           = 'Minut';
    Lang.Popup.TimepickercloseButtonText      = 'Fertig';
    Lang.Popup.TimepickernowButtonText        = 'Jetzt';

	Lang.Popup.MycalendarTitle			= 'Mein Kalender';

	// MENU
	Lang.Menu = {};
	Lang.Menu.TitleProfile				= 'Profil';
	Lang.Menu.TitleAdduser				= 'Benutzer hinzufügen';
	Lang.Menu.TitleQuickAdduser			= 'Schnell benutzer hinzufügen';
	Lang.Menu.TitleAddAdmin				= 'Admin hinzufügen';
	Lang.Menu.TitleLogout				= 'Ausloggen';
	Lang.Menu.TitleUsers				= 'Benutzer';
    Lang.Menu.TitleAdmins				= 'Admins';
    Lang.Menu.TitleSettings				= 'Einstellungen';
    Lang.Menu.TitleCalendars			= 'Kalender';
    Lang.Menu.TitleHourCalculation  	= 'Stunden-Berechnung';
	Lang.Menu.TitleAdminArea			= 'Admin dashboard';

    Lang.Button = {};
    Lang.Button.addCalendar             = 'Kalender hinzufügen';
    Lang.Button.forgottenPassword           = 'Forgotten password';
    Lang.Button.register                    = 'Register';
    
    // ALERTS
    Lang.Alert = {};
    Lang.Alert.NotAllowedToAdd			= 'Sie haben keine Rechten um Items hinzufügen';
    Lang.Alert.NotAllowedToEdit			= 'Sie haben keine Rechten um dieses Item zu bewerken';
    Lang.Alert.NotAllowedToEditGoogleEvent		= 'Sie haben keine Rechten um dieses Item zu bewerken, Sie werden weiter geschickt zu Google';
    Lang.Alert.NotAllowedToAddOnThisDate = 'Dieses Datum ist ausgeschlossen';

    Lang.Alert.DatesNotCorrect			= 'Die Datums sind nicht correct!.';
    Lang.Alert.TimesNotCorrect			= 'Die Zeiten sind nicht correct!';
    Lang.Alert.EventTitleRequired		= 'Der Titel darf nicht leer sein';
	Lang.Alert.ErrorSaving				= 'Fehler weil speichern.';
	Lang.Alert.NotLoggedIn				= 'Ihr Login ist abgelaufen. Sie werden umgeleitet zur Login-Seite.';
	Lang.Alert.Error						= 'Error';
    Lang.Alert.ChooseCalendarFirst			= 'Choose one calendar first';
    Lang.Alert.DoNotForgetToSave			= 'Fergessen Sie nicht zu speichern !';
	Lang.Alert.SettingsSavedSuccess			= 'Einstellungen gespeichert';
    
    Lang.Alert.FileTooBig                   = 'The file you are trying to upload is too big';
    Lang.Alert.PartiallyUploaded            = 'The file you are trying upload was only partially uploaded.';
    Lang.Alert.NoFileSelected               = 'You must select a file for upload.';
    Lang.Alert.ProblemWithUpload            = 'There was a problem with your upload.';
    Lang.Alert.LogInToUpload                = 'You have to be logged in to upload files';
    Lang.Alert.FileNotAllowed               = 'This type of file is not allowed';
    
    Lang.Database = {};
    Lang.Database.ConnectFailed			= 'Verbindung zur Datenbank fehlgeschlagen';

    // PROMPTS
    Lang.Prompt = {};
    Lang.Prompt.Update = {};
    Lang.Prompt.Update.repairText		= 'Wollen Sie das Wiederholungspatron reparieren?';

  	Lang.Prompt.Delete = {};
  	Lang.Prompt.Delete.RemoveBtn	  		= 'Remove';
  	Lang.Prompt.Delete.CancelBtn			= 'Cancel';
  	Lang.Prompt.Delete.ConfirmTitle  		= 'Remove item';
  	Lang.Prompt.Delete.ConfirmText 			= 'Are you sure you want to remove this item?';
  	Lang.Prompt.Delete.chooseOneOrAllTitle 	= 'Eintrag(e) entfernen';
  	Lang.Prompt.Delete.chooseOneOrAllText 	= 'Wollen Sie nur dieses Eintrag entfernen oder dem ganzen Patron?';
  	Lang.Prompt.Delete.thisItemBtn			= 'Dieses Eintrag';
  	Lang.Prompt.Delete.allItemsBtn			= 'Ganzes Patron';
    
    Lang.Settings = {};
    Lang.Settings.Legend                    = 'Einstellungen';
    Lang.Settings.Infotext                  = 'Diese Einstellungen werden nur angewendet, wenn jemand angemeldet ist, da sonst die Einstellungen aus der config.php angewendet werden.';
    Lang.Settings.DefaultView               = 'Standard-Ansicht';
    Lang.Settings.LabelWeekViewType         = 'Wochenansicht Typ';
    Lang.Settings.LabelDayViewType          = 'Tagesansicht Typ';
    Lang.Settings.LabelLanguage             = 'Sprache';
    Lang.Settings.LabelOtherLanguage        = 'Andere Sprache';
    Lang.Settings.LabelShowAmPm             = 'Zeige AM/PM';
    Lang.Settings.LabelShowWeeknumbers      = 'Zeige Wochennummern';
    Lang.Settings.LabelShowNotAllowedMessages      = '"Nicht erlaubt" Meldungen anzeigen';
    Lang.Settings.LabelMouseoverPopup       = 'Mouseover Popup';
    Lang.Settings.LabelTruncateTitle        = 'Titel kürzen';
    Lang.Settings.LabelTitleLength          = 'Titellänge';
    Lang.Settings.LabelAmountOfCharacters   = 'Anzahl der Zeichen';
    Lang.Settings.LabelEditDialog           = 'Bearbeiten-Dialog';
    Lang.Settings.LabelColorPickerType      = 'Colorpicker-Typ';
    Lang.Settings.LabelTimePickerType       = 'Timepicker-Typ';
    Lang.Settings.LabelMouseoverPopup       = 'Zeige Mouseoverpopup';
    Lang.Settings.LabelTwoCapitals          = 'zwei Großbuchstaben';
    Lang.Settings.LabelShowDescription      = 'Zeige Beschreibung';
    Lang.Settings.LabelShowLocation         = 'Zeige Lokation';
    Lang.Settings.LabelShowPhone            = 'Zeige Telefon';
    Lang.Settings.LabelShowDeleteConfirmDialog  = 'Zeige Bestätigungsdialog vor dem Löschen';
    Lang.Settings.LabelHourcalculation      = 'Stunden-Berechnung';
    Lang.Settings.LabelWorkdayHours         = 'Tagesarbeitszeit';
    Lang.Settings.LabelDefaultPeriod        = 'Standardzeitraum';
    Lang.Settings.LabelWorkdayHoursInfo     = 'Anzahl der Stunden an einem Arbeitstag';
    Lang.Settings.LabelDefaultPeriodInfo    = 'Anfangszeitraum in Monaten';
    Lang.Settings.LabelRegistration         = 'Anmeldung';
    Lang.Settings.LabelRegistrationInfo     = 'kann in der config.php eingestellt werden';
    Lang.Settings.LabelSendActivationMail   = 'Sende Aktivierungsmail';
    
    Lang.Hourcalculation = {};
    Lang.Hourcalculation.legend             = 'Stunden-Berechnung';
    Lang.Hourcalculation.legendOfUser       = 'Stunden-Berechnung von ';
    
    Lang.ListView = {};
    Lang.ListView.descriptionLabel          = 'Info: ';
    Lang.ListView.locationLabel             = 'Location: ';
    Lang.ListView.phoneLabel                = 'Phone: ';
    Lang.ListView.urlLabel                  = 'Url: ';