var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames        = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
    Lang.Fullcalendar.monthNamesShort   = ['jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nov','dec'];
    Lang.Fullcalendar.dayNames          = ['zondag','maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag'];
    Lang.Fullcalendar.dayNamesShort     = ['zon','maa','din','woe','don','vri','zat'];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today  = 'vandaag';
    Lang.Fullcalendar.buttonText.month  = 'maand';
    Lang.Fullcalendar.buttonText.week   = 'week';
    Lang.Fullcalendar.buttonText.day    = 'dag';
	Lang.Fullcalendar.buttonText.agendaList    = 'agenda';

    // DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd                 = 'Item toevoegen';
    Lang.Popup.TitleView                	= 'View an event';
    Lang.Popup.TitleEdit                = 'Item wijzigen';

    // DIALOG BUTTONS
    Lang.Popup.closeButtonText          = 'Sluiten';
    Lang.Popup.saveButtonText          	= 'Opslaan';
    Lang.Popup.editButtonText           = 'Edit';
    Lang.Popup.deleteButtonText         = 'Verwijderen';
    Lang.Popup.saveAndRefreshButtonText = 'Opslaan en verversen';
    Lang.Popup.updateButtonText			    = 'Update';
    Lang.Popup.addUserAndSendMailButtonText	= 'Gebruiker toevoegen en e-mail versturen';
    Lang.Popup.emailText                    = 'E-mail de admin';

    // FORM LABELS
    Lang.Popup.allDayLabel              = 'Hele dag';
    Lang.Popup.MonthLabel               = 'Datum';
    Lang.Popup.TimeLabel                = 'Tijd';
    Lang.Popup.StartdateLabel           = 'Startdatum';
    Lang.Popup.EnddateLabel             = 'Einddatum';
    Lang.Popup.SimpleStartTimeLabel 	= 'van';
    Lang.Popup.SimpleEndTimeLabel 		= 'tot';
    Lang.Popup.EventTitle		        = 'Titel';
    Lang.Popup.EventLocation		    = 'Locatie';
    Lang.Popup.EventDescription		    = 'Omschrijving';
	Lang.Popup.EventPhone		    		= 'Telefoon';
    Lang.Popup.EventUrl                     = 'Url';
    Lang.Popup.ProfileEventColor			= 'Events kleur';
    Lang.Popup.EventColor					= 'Kleur';
    Lang.Popup.EventColorUseForAllEvents	= 'Gebruik voor alle events';
    
    Lang.Popup.DayOfMonth					= 'Dag van de maand';
	Lang.Popup.DayOfWeek					= 'Dag van de week';
	Lang.Popup.MonthlyOnDay					= 'Maandelijks op';
	Lang.Popup.MonthlyOn					= 'Maandelijks op';
	Lang.Popup.Starting						= 'start op';
	Lang.Popup.WeeklyOn						= 'Wekelijks op';
    Lang.Popup.YearlyOn                     = 'Jaarlijks op';
    Lang.Popup.Until                        = 'Tot';
    
	Lang.Popup.EventInterval				= 'Interval';
	Lang.Popup.EventRecurrence				= 'Herhaling';
	
    Lang.Popup.LabelTabMain		    		= 'Main';
	Lang.Popup.LabelTabFiles		    	= 'Files';
	Lang.Popup.LabelActive		    		= 'Actief';
	Lang.Popup.LabelName		    		= 'Naam';
	Lang.Popup.LabelEmail		    		= 'E-mail';
	Lang.Popup.LabelUsername		    	= 'Gebruikersnaam';
	Lang.Popup.LabelLogin                   = 'Login';
    Lang.Popup.LabelBirthdate		    	= 'Geboortedatum';
	Lang.Popup.LabelCountry		    		= 'Land';
	Lang.Popup.LabelLanguage		    	= 'Taal';
	Lang.Popup.DefaultView			    	= 'Default view';
	Lang.Popup.LabelPassword		    	= 'Wachtwoord';
	Lang.Popup.LabelPasswordAgain		    = 'Nogmaals wachtwoord';
	Lang.Popup.LabelNewPassword		    	= 'Nieuw wachtwoord';
	Lang.Popup.LabelNewPasswordAgain		= 'Nogmaals nieuw wachtwoord';
	Lang.Popup.AddUserPasswordText			= 'Er wordt een wachtwoord gegenereerd en in de e-mail gezet';
	Lang.Popup.AddUserActivationMailText	= 'The user can activate with the activation link included in the email.';
	Lang.Popup.LabelCopyToAdmin				= 'Kopie naar admin';
    Lang.Popup.LabelCalendar	    		= 'Kalender';
	
	// FORM PLACEHOLDERS
	Lang.Popup.Placeholder = {};
	Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Alleen invullen bij wijzigen wachtwoord';
	Lang.Popup.Placeholder.Firstname 			= 'Voornaam';
	Lang.Popup.Placeholder.Lastname 			= 'Achternaam';

    // TIMEPICKER
    Lang.Popup.TimepickerHourtext             = 'Uur';
    Lang.Popup.TimepickerMinutetext           = 'Minuut';
    Lang.Popup.TimepickercloseButtonText      = 'Klaar';
    Lang.Popup.TimepickernowButtonText        = 'Nu';

	Lang.Popup.MycalendarTitle			= 'Mijn kalender';

	// MENU
	Lang.Menu = {};
	Lang.Menu.TitleProfile				= 'Profiel';
	Lang.Menu.TitleAdduser				= 'Gebruiker toevoegen';
	Lang.Menu.TitleQuickAdduser				= 'Snel gebruiker toevoegen';
	Lang.Menu.TitleAddAdmin				= 'Admin toevoegen';
	Lang.Menu.TitleLogout				= 'Uitloggen';
	Lang.Menu.TitleUsers                    = 'Gebruikers';
    Lang.Menu.TitleAdmins                   = 'Admins';
    Lang.Menu.TitleCalendars                = 'Kalenders';
    Lang.Menu.TitleHourCalculation          = 'Urenberekening';
    Lang.Menu.TitleSettings					= 'Instellingen';
	Lang.Menu.TitleAdminArea				= 'Admin dashboard';

    Lang.Button = {};
    Lang.Button.addCalendar                 = 'Add calendar';
    Lang.Button.forgottenPassword           = 'Forgotten password';
    Lang.Button.register                    = 'Register';
    
    // ALERTS
    Lang.Alert = {};
    Lang.Alert.NotAllowedToAdd			= 'Je hebt geen rechten om een event aan te maken!';
    Lang.Alert.NotAllowedToEdit			= 'Je hebt geen rechten om dit event te bewerken!';
    Lang.Alert.NotAllowedToEditGoogleEvent		= 'Je hebt geen rechten om dit event te bewerken!, je wordt doorgezonden naar Google';
    Lang.Alert.NotAllowedToAddOnThisDate    = 'Deze datum is uitgesloten';
    
    Lang.Alert.DatesNotCorrect			= 'Startdatum moet v&ograve;&ograve;r de einddatum!.';
    Lang.Alert.TimesNotCorrect			= 'De tijden kloppen niet!';
    Lang.Alert.EventTitleRequired		= 'Titel kan niet leeg zijn.';
	Lang.Alert.ErrorSaving				= 'Opslaan mislukt.';
	Lang.Alert.NotLoggedIn				= 'Je bent niet ingelogd. Je wordt doorgestuurd naar de loginpagina.';
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
    Lang.Database.ConnectFailed			= 'Database verbinding mislukt';

    // PROMPTS
    Lang.Prompt = {};
    Lang.Prompt.Update = {};
    Lang.Prompt.Update.repairText		= 'Wil je het herhaalpatroon herstellen?';

  	Lang.Prompt.Delete = {};
  	Lang.Prompt.Delete.RemoveBtn	  		= 'Remove';
  	Lang.Prompt.Delete.CancelBtn			= 'Cancel';
  	Lang.Prompt.Delete.ConfirmTitle  		= 'Remove item';
  	Lang.Prompt.Delete.ConfirmText 			= 'Are you sure you want to remove this item?';
  	Lang.Prompt.Delete.chooseOneOrAllTitle 	= 'Item(s) verwijderen';
  	Lang.Prompt.Delete.chooseOneOrAllText 	= 'Wil je alleen dit item verwijderen of de hele reeks?';
  	Lang.Prompt.Delete.thisItemBtn			= 'Dit item';
  	Lang.Prompt.Delete.allItemsBtn			= 'Hele reeks';
    
    Lang.Settings = {};
    Lang.Settings.Legend                    = 'Instellingen';
    Lang.Settings.Infotext                  = 'Deze instellingen worden alleen gebruikt als er iemand is ingelogd, zo niet dan worden de instellingen uit config.php gebruikt.';
    Lang.Settings.DefaultView               = 'Standaard weergave';
    Lang.Settings.LabelWeekViewType         = 'Type weekweergave';
    Lang.Settings.LabelDayViewType          = 'Type dagweergave';
    Lang.Settings.LabelLanguage             = 'Taal';
    Lang.Settings.LabelOtherLanguage        = 'Andere taal';
    Lang.Settings.LabelShowAmPm             = 'Toon AM/PM';
    Lang.Settings.LabelShowWeeknumbers      = 'Toon weeknummers';
    Lang.Settings.LabelShowNotAllowedMessages      = 'Toon "Niet toegestaan" berichten';
    Lang.Settings.LabelMouseoverPopup       = 'Mouseover popup';
    Lang.Settings.LabelTruncateTitle        = 'Titel inkorten';
    Lang.Settings.LabelTitleLength          = 'Titel lengte';
    Lang.Settings.LabelAmountOfCharacters   = 'Aantal tekens';
    Lang.Settings.LabelEditDialog           = 'Wijzig dialoog';
    Lang.Settings.LabelColorPickerType      = 'Colorpicker type';
    Lang.Settings.LabelTimePickerType       = 'Timepicker type';
    Lang.Settings.LabelMouseoverPopup       = 'Show mouseoverpopup';
    Lang.Settings.LabelTwoCapitals          = 'Twee hoofdletters';
    Lang.Settings.LabelShowDescription      = 'Toon omschrijving';
    Lang.Settings.LabelShowLocation         = 'Toon locatie';
    Lang.Settings.LabelShowPhone            = 'Toon telefoon';
    Lang.Settings.LabelShowDeleteConfirmDialog  = 'Show confirm dialog when deleting an item';
    Lang.Settings.LabelHourcalculation      = 'Urenberekening';
    Lang.Settings.LabelWorkdayHours         = 'Aantal uren';
    Lang.Settings.LabelDefaultPeriod        = 'Standaard periode';
    Lang.Settings.LabelWorkdayHoursInfo     = 'Aantal uren in een werkdag';
    Lang.Settings.LabelDefaultPeriodInfo    = 'Initiële periode in maanden';
    Lang.Settings.LabelRegistration         = 'Registratie';
    Lang.Settings.LabelRegistrationInfo     = 'instellen in config.php';
    Lang.Settings.LabelSendActivationMail   = 'Stuur activatiemail';
    
    Lang.Hourcalculation = {};
    Lang.Hourcalculation.legend             = 'Uren berekening';
    Lang.Hourcalculation.legendOfUser       = 'Uren berekening van ';
    
    Lang.ListView = {};
    Lang.ListView.descriptionLabel          = 'Info: ';
    Lang.ListView.locationLabel             = 'Location: ';
    Lang.ListView.phoneLabel                = 'Phone: ';
    Lang.ListView.urlLabel                  = 'Url: ';
