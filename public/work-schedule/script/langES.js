var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames        = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    Lang.Fullcalendar.monthNamesShort   = ['ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    Lang.Fullcalendar.dayNames          = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    Lang.Fullcalendar.dayNamesShort     = ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today  = 'hoy';
    Lang.Fullcalendar.buttonText.month  = 'mes';
    Lang.Fullcalendar.buttonText.week   = 'semana';
    Lang.Fullcalendar.buttonText.day    = 'dia';
	Lang.Fullcalendar.buttonText.agendaList    = 'listar';

	// DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd                 = 'Agregar cita';
    Lang.Popup.TitleView                	= 'View an event';
    Lang.Popup.TitleEdit                = 'Editar cita';

	// DIALOG BUTTONS
    Lang.Popup.closeButtonText          = 'Cerrar';
    Lang.Popup.saveButtonText          	= 'Guardar';
    Lang.Popup.editButtonText           = 'Edit';
    Lang.Popup.deleteButtonText         = 'Borrar';
    Lang.Popup.saveAndRefreshButtonText = 'Guardar & Actualizar';
    Lang.Popup.updateButtonText			    = 'Actualizar';
    Lang.Popup.addUserAndSendMailButtonText	= 'Agregar usuario y enviar correo';
    Lang.Popup.emailText                    = 'Email al admin';

    // FORM LABELS
    Lang.Popup.allDayLabel              = 'Todo el día';
    Lang.Popup.MonthLabel               = 'Fecha';
    Lang.Popup.TimeLabel                = 'Hora';
    Lang.Popup.StartdateLabel           = 'HoraInicio';
    Lang.Popup.EnddateLabel             = 'Horafin';
    Lang.Popup.SimpleStartTimeLabel 	= 'Desde';
    Lang.Popup.SimpleEndTimeLabel 		= 'Hasta';
    Lang.Popup.EventTitle		        = 'Titulo';
    Lang.Popup.EventLocation		    = 'Ubicaci&oacute;n';
    Lang.Popup.EventDescription		    = 'Descripci&oacute;n';
	Lang.Popup.EventPhone		    		= 'Tel&eacute;fono';
    Lang.Popup.EventUrl                     = 'Url';
    Lang.Popup.EventInterval				= 'Intervalo';
	Lang.Popup.EventRecurrence				= 'Recurrente';
	
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
	Lang.Popup.LabelName		    		= 'Nombre';
	Lang.Popup.LabelEmail		    		= 'Correo';
	Lang.Popup.LabelUsername		    	= 'Usuario';
	Lang.Popup.LabelLogin                   = 'Login';
    Lang.Popup.LabelBirthdate		    	= 'FechaNacimiento';
	Lang.Popup.LabelCountry		    		= 'Pa&iacute;s';
	Lang.Popup.LabelLanguage		    	= 'Language';
	Lang.Popup.DefaultView			    	= 'Default view';
	Lang.Popup.LabelPassword		    	= 'Contrase&ntilde;a';
	Lang.Popup.LabelPasswordAgain		    = 'Repetir Contrase&ntilde;a';
	Lang.Popup.LabelNewPassword		    	= 'Nueva Contrase&ntilde;a';
	Lang.Popup.LabelNewPasswordAgain		= 'Repetir Nueva Contrase&ntilde;a';
	Lang.Popup.AddUserPasswordText			= 'Se ha generado Contrase&ntilde;a e incluido en el correo.';
	Lang.Popup.AddUserActivationMailText	= 'The user can activate with the activation link included in the email.';
	Lang.Popup.LabelCopyToAdmin				= 'Copiar al admin';
    Lang.Popup.LabelCalendar	    		= 'Calendar';
	
	// FORM PLACEHOLDERS
	Lang.Popup.Placeholder = {};
	Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Dejar en blanco si no hay cambio';
	Lang.Popup.Placeholder.Firstname 			= 'Nombre';
	Lang.Popup.Placeholder.Lastname 			= 'Apellido';

	// TIMEPICKER
    Lang.Popup.TimepickerHourtext             = 'Hora';
    Lang.Popup.TimepickerMinutetext           = 'Minuto';
    Lang.Popup.TimepickercloseButtonText      = 'OK';
    Lang.Popup.TimepickernowButtonText        = 'Ahora';

    Lang.Popup.MycalendarTitle				= 'Mi calendario';

    // MENU
    Lang.Menu = {};
	Lang.Menu.TitleProfile					= 'Perfil';
	Lang.Menu.TitleAdduser					= 'Agregar usuario';
	Lang.Menu.TitleQuickAdduser				= 'Quickly add user';
	Lang.Menu.TitleAddAdmin					= 'Agregar admin';
	Lang.Menu.TitleLogout					= 'Salir';
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
    Lang.Alert.NotAllowedToAdd				= 'No se puede añadir este evento';
    Lang.Alert.NotAllowedToEdit				= 'No puedes modificar este evento';
    Lang.Alert.NotAllowedToEditGoogleEvent		= 'No puedes modificar este evento, serás redirigido a Google';
    Lang.Alert.NotAllowedToAddOnThisDate    = 'Se excluye de esta fecha';
    
    Lang.Alert.DatesNotCorrect			= 'Error en las fechas.';
    Lang.Alert.TimesNotCorrect			= 'Error en los intinerarios.';
    Lang.Alert.EventTitleRequired		= 'Texto es requerido.';
	Lang.Alert.ErrorSaving				= 'Error guardando.';
	Lang.Alert.NotLoggedIn				= 'Necesitas ingresar al sistema.';
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
    Lang.Database.ConnectFailed			= 'conexión con la DB fallado';

    // PROMPTS
    Lang.Prompt = {};
    Lang.Prompt.Update = {};
    Lang.Prompt.Update.repairText		= 'Reparar el patrón repetido?';

    Lang.Prompt.Delete = {};
  	Lang.Prompt.Delete.RemoveBtn	  		= 'Remove';
  	Lang.Prompt.Delete.CancelBtn			= 'Cancel';
  	Lang.Prompt.Delete.ConfirmTitle  		= 'Remove item';
  	Lang.Prompt.Delete.ConfirmText 			= 'Are you sure you want to remove this item?';
  	Lang.Prompt.Delete.chooseOneOrAllTitle  = 'Remover elemento(s)';
  	Lang.Prompt.Delete.chooseOneOrAllText = 'Desea remover solo este elemento o todo el patrón?';
  	Lang.Prompt.Delete.thisItemBtn			= 'Este elemento';
  	Lang.Prompt.Delete.allItemsBtn			= 'Todo el patrón';
    
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