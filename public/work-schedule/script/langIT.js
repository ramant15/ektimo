var Lang = {};

Lang.Fullcalendar = {};
Lang.Fullcalendar.monthNames = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
Lang.Fullcalendar.monthNamesShort = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];
Lang.Fullcalendar.dayNames = ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];
Lang.Fullcalendar.dayNamesShort = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];

Lang.Fullcalendar.buttonText = {};
Lang.Fullcalendar.buttonText.today = 'Oggi';
Lang.Fullcalendar.buttonText.month = 'Mese';
Lang.Fullcalendar.buttonText.week = 'Settimana';
Lang.Fullcalendar.buttonText.day = 'Giorno';
Lang.Fullcalendar.buttonText.agendaList = 'Lista';

// DIALOG
Lang.Popup = {};
Lang.Popup.TitleAdd = 'Aggiungi evento';
Lang.Popup.TitleView = 'Visualizza evento';
Lang.Popup.TitleEdit = 'Aggiorna evento';

// DIALOG BUTTONS
Lang.Popup.closeButtonText = 'Chiudi';
Lang.Popup.saveButtonText = 'Salva';
Lang.Popup.editButtonText = 'Modifica';
Lang.Popup.deleteButtonText = 'Cancella';
Lang.Popup.saveAndRefreshButtonText = 'Salva e Aggiorna';
Lang.Popup.updateButtonText = 'Aggiorna';
Lang.Popup.addUserAndSendMailButtonText = 'Aggiungi utente e manda email';
Lang.Popup.emailText = 'Email a amministratore';

// FORM LABELS
Lang.Popup.allDayLabel = 'Tutto il giorno';
Lang.Popup.MonthLabel = 'Data';
Lang.Popup.TimeLabel = 'Ora';
Lang.Popup.StartdateLabel = 'Data inizio';
Lang.Popup.EnddateLabel = 'Data fine';
Lang.Popup.SimpleStartTimeLabel = '';
Lang.Popup.SimpleEndTimeLabel = ' - ';
Lang.Popup.EventTitle = 'Modello';
Lang.Popup.EventLocation = 'Località';
Lang.Popup.EventDescription = 'Note';
Lang.Popup.EventPhone = 'Tel.';
Lang.Popup.EventUrl = 'Url';
Lang.Popup.EventInterval = 'Intervallo';
Lang.Popup.EventRecurrence = 'Ricorrenza';

Lang.Popup.ProfileEventColor = 'Colori eventi';
Lang.Popup.EventColor = 'Colore';
Lang.Popup.EventColorUseForAllEvents = 'Utilizza per tutti i miei eventi';
Lang.Popup.DayOfMonth = 'Giorno del mese';
Lang.Popup.DayOfWeek = 'Giorno della settimana';
Lang.Popup.MonthlyOnDay = 'Giornaliero';
Lang.Popup.MonthlyOn = 'Mensile';
Lang.Popup.Starting = 'Inizio';
Lang.Popup.WeeklyOn = 'Settimanale';
Lang.Popup.YearlyOn = 'Annuale';
Lang.Popup.Until = 'Fino a';

Lang.Popup.LabelTabMain	= 'Main';
Lang.Popup.LabelTabFiles = 'Files';
Lang.Popup.LabelActive = 'Active';
Lang.Popup.LabelName = 'Nome';
Lang.Popup.LabelEmail = 'Email';
Lang.Popup.LabelUsername = 'Nome utente';
Lang.Popup.LabelLogin                   = 'Login';
Lang.Popup.LabelBirthdate = 'Compleanno';
Lang.Popup.LabelCountry = 'Nazione';
Lang.Popup.LabelLanguage = 'Lingua';
Lang.Popup.DefaultView = 'Visualizzazione predefinita';
Lang.Popup.LabelPassword = 'Password';
Lang.Popup.LabelPasswordAgain = 'Ripeti password';
Lang.Popup.LabelNewPassword = 'Nuova password';
Lang.Popup.LabelNewPasswordAgain = 'Ripeti nuova password';
Lang.Popup.AddUserPasswordText = 'La password sarà generata e inclusa nella mail.';
Lang.Popup.AddUserActivationMailText = 'Utente si può attivare cliccando nel link di attivazione presente nella mail.';
Lang.Popup.LabelCopyToAdmin = 'Copia a amministratore';
Lang.Popup.LabelCalendar = 'Calendario';

// FORM PLACEHOLDERS
Lang.Popup.Placeholder = {};
Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Lascia in bianco per nessuna modifica';
Lang.Popup.Placeholder.Firstname = 'Nome';
Lang.Popup.Placeholder.Lastname = 'Cognome';

// TIMEPICKER
Lang.Popup.TimepickerHourtext = 'Ora';
Lang.Popup.TimepickerMinutetext = 'Minuti';
Lang.Popup.TimepickercloseButtonText = 'OK';
Lang.Popup.TimepickernowButtonText = 'Adesso';

Lang.Popup.MycalendarTitle = 'Mio calendario';

// MENU
Lang.Menu = {};
Lang.Menu.TitleProfile = 'Profilo';
Lang.Menu.TitleAdduser = 'Aggiungi utente';
Lang.Menu.TitleQuickAdduser = 'Aggiungi utente velocemente';
Lang.Menu.TitleAddAdmin = 'Aggiungi amministratore';
Lang.Menu.TitleLogout = 'Esci';
Lang.Menu.TitleUsers = 'Utenti';
Lang.Menu.TitleAdmins = 'Amministratori';
Lang.Menu.TitleCalendars = 'Calendari';
Lang.Menu.TitleHourCalculation = 'Ora di calcolo';
Lang.Menu.TitleSettings = 'Impostazioni';
Lang.Menu.TitleAdminArea = 'Area amministratore';

Lang.Button = {};
Lang.Button.addCalendar = 'Aggiungi calendario';
Lang.Button.forgottenPassword           = 'Forgotten password';
Lang.Button.register                    = 'Register';
    
// ALERTS
Lang.Alert = {};
Lang.Alert.NotAllowedToAdd = 'Non puoi aggiungere un evento.';
Lang.Alert.NotAllowedToEdit = 'Non puoi modificare questo evento.';
Lang.Alert.NotAllowedToEditGoogleEvent = 'Non puoi modificare questo evento, sarai reindirizzato a Google';
Lang.Alert.NotAllowedToAddOnThisDate = 'È esclusa questa data';

Lang.Alert.DatesNotCorrect = 'Errore nella data.';
Lang.Alert.TimesNotCorrect = 'Errore nel calendario.';
Lang.Alert.EventTitleRequired = 'Il campo Titolo è obbligatorio.';
Lang.Alert.ErrorSaving = 'Errore nel salvataggio dei dati.';
Lang.Alert.NotLoggedIn = 'La tua sessione è scaduta. Sarai reindirizzato alla pagina login.';
Lang.Alert.Error = 'Errore';
Lang.Alert.ChooseCalendarFirst = 'Devi scegliere una tipologia di calendario';
Lang.Alert.DoNotForgetToSave = 'Non dimenticarti di salvare evento!';
Lang.Alert.SettingsSavedSuccess = 'Impostazioni sono state salvate con successo';

Lang.Alert.FileTooBig                   = 'The file you are trying to upload is too big';
Lang.Alert.PartiallyUploaded            = 'The file you are trying upload was only partially uploaded.';
Lang.Alert.NoFileSelected               = 'You must select a file for upload.';
Lang.Alert.ProblemWithUpload            = 'There was a problem with your upload.';
Lang.Alert.LogInToUpload                = 'You have to be logged in to upload files';
Lang.Alert.FileNotAllowed               = 'This type of file is not allowed';
      
Lang.Database = {};
Lang.Database.ConnectFailed = 'Connessione al database fallita';

// PROMPTS
Lang.Prompt = {};
Lang.Prompt.Update = {};
Lang.Prompt.Update.repairText = 'Ripetere?';

Lang.Prompt.Delete = {};
Lang.Prompt.Delete.RemoveBtn = 'Rimuovere';
Lang.Prompt.Delete.CancelBtn = 'Cancella';
Lang.Prompt.Delete.ConfirmTitle = 'Rimuovere elemento';
Lang.Prompt.Delete.ConfirmText = 'Sei sicuro che vuoi rimuovere elemento?';
Lang.Prompt.Delete.chooseOneOrAllTitle = 'Rimuovi elemento';
Lang.Prompt.Delete.chooseOneOrAllText = 'Vuoi rimuovere solo questo elemento o intero modello?';
Lang.Prompt.Delete.thisItemBtn = 'Questo elemento';
Lang.Prompt.Delete.allItemsBtn = 'Modello intero';

Lang.Settings = {};
Lang.Settings.Legend = 'Impostazioni';
Lang.Settings.Infotext = 'Verranno applicate solo queste impostazioni quando qualcuno è connesso, altrimenti verranno utilizzate le impostazioni del file di configurazione.';
Lang.Settings.DefaultView = 'Visualizzazione default';
Lang.Settings.LabelWeekViewType = 'Tipo visualizzazione settimanale';
Lang.Settings.LabelDayViewType = 'Tipo visualizzazione giornaliera';
Lang.Settings.LabelLanguage = 'Lingua';
Lang.Settings.LabelOtherLanguage = 'Altre lingue';
Lang.Settings.LabelShowAmPm = 'Mostra AM/PM';
Lang.Settings.LabelShowWeeknumbers = 'Mostra N. settimana';
Lang.Settings.LabelShowNotAllowedMessages = 'Mostra messaggio "non ammesso"';
Lang.Settings.LabelMouseoverPopup = 'Mouseover popup';
Lang.Settings.LabelTruncateTitle = 'Titolo corto';
Lang.Settings.LabelTitleLength = 'Tiolo lungo';
Lang.Settings.LabelAmountOfCharacters = 'Quantità di caratteri';
Lang.Settings.LabelEditDialog = 'Modifica finestra';
Lang.Settings.LabelColorPickerType = 'Tipo colore';
Lang.Settings.LabelTimePickerType = 'TipoTimepicker';
Lang.Settings.LabelMouseoverPopup = 'Mostra mouseoverpopup';
Lang.Settings.LabelTwoCapitals = 'Due capitali';
Lang.Settings.LabelShowDescription = 'Mostra descrizione';
Lang.Settings.LabelShowLocation = 'Mostra località';
Lang.Settings.LabelShowPhone = 'Mostra telefono';
Lang.Settings.LabelShowDeleteConfirmDialog = 'Mostra finestra conferma quando stai cancellando un elemento';
Lang.Settings.LabelHourcalculation = 'Calcolo ora';
Lang.Settings.LabelWorkdayHours = 'Ore giorno lavorativo';
Lang.Settings.LabelDefaultPeriod = 'Periodo default';
Lang.Settings.LabelWorkdayHoursInfo = 'Quantità di ore in una giornata lavorativa';
Lang.Settings.LabelDefaultPeriodInfo = 'Periodo iniziale in mesi';
Lang.Settings.LabelRegistration = 'Registrazione';
Lang.Settings.LabelRegistrationInfo = 'può essere impostato nel file config.php';
Lang.Settings.LabelSendActivationMail = 'Invia activationmail';

Lang.Hourcalculation = {};
Lang.Hourcalculation.legend = 'Calcolo ora';
Lang.Hourcalculation.legendOfUser = 'Calcolo ora di ';

Lang.ListView = {};
Lang.ListView.descriptionLabel = 'Info: ';
Lang.ListView.locationLabel = 'Località: ';
Lang.ListView.phoneLabel = 'Telefono: ';
Lang.ListView.urlLabel = 'Url: ';
    
    
    