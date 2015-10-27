
var Lang = {};

    Lang.Fullcalendar = {};
    Lang.Fullcalendar.monthNames = ['leden','únor','březen','duben','květen','červen','červenec','srpen','září','říjen','listopad','prosinec'];
    Lang.Fullcalendar.monthNamesShort = ['led', "úno", "bře", "dub", "můž", "čer", "čer", "srp", "zář", "říj","lis", "pro"];
    Lang.Fullcalendar.dayNames = ['nedělní', 'pondělní','úterní', 'středeční','čtvrtku','páteční', 'sobotní'];
    Lang.Fullcalendar.dayNamesShort = ['ned', "pon", "úte", "stř", "čtv", "pát", "sob"];

    Lang.Fullcalendar.buttonText = {};
    Lang.Fullcalendar.buttonText.today = 'dnes';
    Lang.Fullcalendar.buttonText.month = 'měsíc';
    Lang.Fullcalendar.buttonText.week = 'týden';
    Lang.Fullcalendar.buttonText.day = "den";
    Lang.Fullcalendar.buttonText.agendaList = 'seznam';

// DIALOG
    Lang.Popup = {};
    Lang.Popup.TitleAdd = 'Přidat událost';
    Lang.Popup.TitleView = 'Zobrazit událost';
    Lang.Popup.TitleEdit = 'Upravit událost';

    // DIALOG TLAČÍTKA
    Lang.Popup.closeButtonText = "Zavřít";
    Lang.Popup.saveButtonText = 'Save';
    Lang.Popup.editButtonText               = 'Edit';
    Lang.Popup.deleteButtonText = 'Delete';
    Lang.Popup.saveAndRefreshButtonText = 'Uložit a refresh';
    Lang.Popup.updateButtonText = 'Aktualizovat';
    Lang.Popup.addUserAndSendMailButtonText = 'Přidat uživatele a odesílat e-maily';
    Lang.Popup.emailText                    = 'Email to admin';
    
    // FORMA ŠTÍTKY
    Lang.Popup.allDayLabel = 'Celý den';
    Lang.Popup.MonthLabel = 'Datum';
    Lang.Popup.TimeLabel = 'Čas';
    Lang.Popup.StartdateLabel = 'StartDate';
    Lang.Popup.EnddateLabel = 'EndDate';
    Lang.Popup.SimpleStartTimeLabel = 'Z';
    Lang.Popup.SimpleEndTimeLabel = 'Do';
    Lang.Popup.EventTitle = "hlava";
    Lang.Popup.EventLocation = 'Umístění';
    Lang.Popup.EventDescription = 'Popis';
    Lang.Popup.EventPhone = 'Phone';
    Lang.Popup.EventUrl = 'url';
    Lang.Popup.EventInterval = 'Interval';
    Lang.Popup.EventRecurrence = 'Opakování';

    Lang.Popup.ProfileEventColor = 'Akce color';
    Lang.Popup.EventColor = 'Color';
    Lang.Popup.EventColorUseForAllEvents = 'Používá se pro al mé události';
    Lang.Popup.DayOfMonth = "Den v měsíci";
    Lang.Popup.DayOfWeek = "Den v týdnu";
    Lang.Popup.MonthlyOnDay = 'Měsíční den';
    Lang.Popup.MonthlyOn = 'Měsíční na';
    Lang.Popup.Starting = "výchozí";
    Lang.Popup.WeeklyOn = 'Weekly na';
    Lang.Popup.YearlyOn = 'Roční na';
    Lang.Popup.Until = 'Do';
    
    Lang.Popup.LabelTabMain = 'Hlavní';
    Lang.Popup.LabelTabFiles = 'Soubory';
    Lang.Popup.LabelActive = 'Aktivní';
    Lang.Popup.LabelName = 'name';
    Lang.Popup.LabelEmail = 'Email';
    Lang.Popup.LabelUsername = 'Uživatelské jméno';
    Lang.Popup.LabelLogin = 'Přihlášení';
    Lang.Popup.LabelBirthdate = 'Datum narození';
    Lang.Popup.LabelCountry = "Země";
    Lang.Popup.LabelLanguage = 'jazyk';
    Lang.Popup.DefaultView = 'Výchozí zobrazení';
    Lang.Popup.LabelPassword = 'Heslo';
    Lang.Popup.LabelPasswordAgain = 'Heslo znovu';
    Lang.Popup.LabelNewPassword = 'nové heslo';
    Lang.Popup.LabelNewPasswordAgain = 'znovu nové heslo';
    Lang.Popup.AddUserPasswordText = 'Heslo bude vygenerováno a jsou zahrnuty v e-mailu.';
    Lang.Popup.AddUserActivationMailText = 'Uživatel může aktivovat s aktivačním odkazem zahrnuty v e-mailu.';
    Lang.Popup.LabelCopyToAdmin = 'Kopírovat admin';
    Lang.Popup.LabelCalendar	    		= 'kalendář';
    
    // FORMA zástupné symboly
    Lang.Popup.Placeholder = {};
    Lang.Popup.Placeholder.LeaveBlankForNoChange = 'Nechte prázdné pro změnu';
    Lang.Popup.Placeholder.Firstname = 'Jméno';
    Lang.Popup.Placeholder.Lastname = 'příjmení';

// TIMEPICKER
    Lang.Popup.TimepickerHourtext = 'Hour';
    Lang.Popup.TimepickerMinutetext = 'Minuta';
    Lang.Popup.TimepickercloseButtonText = 'OK';
    Lang.Popup.TimepickernowButtonText = 'Now';

    Lang.Popup.MycalendarTitle = "Můj kalendář";

    // MENU
    Lang.Menu = {};
    Lang.Menu.TitleProfile = 'Profil';
    Lang.Menu.TitleAdduser = 'Přidat uživatele';
    Lang.Menu.TitleAddAdmin = 'Přidat admin';
    Lang.Menu.TitleQuickAdduser = 'Rychle přidat uživatele';
    Lang.Menu.TitleLogout = 'Odhlásit';
    Lang.Menu.TitleUsers                    = 'Users';
    Lang.Menu.TitleAdmins                   = 'Admins';
    Lang.Menu.TitleCalendars                = 'Calendars';
    Lang.Menu.TitleHourCalculation          = 'Hour Calculation';
    Lang.Menu.TitleSettings = "Nastavení";
    Lang.Menu.TitleAdminArea = 'administrativní oblasti';

    Lang.Button = {};
    Lang.Button.addCalendar = 'Přidat kalendáře';
    Lang.Button.forgottenPassword = 'Zapomenuté heslo';
    Lang.Button.register = 'Registrace';
    
    // ZÁZNAMY
    Lang.Alert = {};
    Lang.Alert.NotAllowedToAdd = "Nemůžeš přidat událost.";
    Lang.Alert.NotAllowedToEdit = 'Nemůžete měnit tuto událost.';
    Lang.Alert.NotAllowedToEditGoogleEvent = 'Nemůžete měnit tuto událost, budete přesměrováni na Google';
    Lang.Alert.NotAllowedToAddOnThisDate    = 'This date is excluded';
    
    Lang.Alert.DatesNotCorrect = 'Chyba v datech.';
    Lang.Alert.TimesNotCorrect = 'Chyba v listinách';
    Lang.Alert.EventTitleRequired = 'je zapotřebí v názvu'; 
    Lang.Alert.ErrorSaving = 'Chyba při ukládání.';
    Lang.Alert.NotLoggedIn = 'Vaše přihlášení vypršela. Budete přesměrováni na přihlašovací stránku. ';
    Lang.Alert.ChooseCalendarFirst			= 'Choose one calendar first';
    Lang.Alert.DoNotForgetToSave			= 'Do not forget to save the event !';
    Lang.Alert.Error = 'Chyba';
    Lang.Alert.SettingsSavedSuccess = 'Nastavení úspěšně uloženo, aktualizujte vidět změny';
    
    Lang.Alert.FileTooBig = 'Soubor, který se pokoušíte nahrát, je příliš velký';
    Lang.Alert.PartiallyUploaded = 'Soubor, který se pokoušíte nahrát byl nahrán jen částečně.';
    Lang.Alert.NoFileSelected = 'Musíte vybrat soubor k nahrání.';
    Lang.Alert.ProblemWithUpload = "Došlo k potížím s upload.";
    Lang.Alert.LogInToUpload = "Musíte být přihlášeni právo vkládat";
    Lang.Alert.FileNotAllowed = "Tento typ souboru není povolen";
    
    Lang.Database = {};
    Lang.Database.ConnectFailed = 'Připojení k databázi se nezdařilo';

    // Vyzve
    Lang.Prompt = {};
    Lang.Prompt.Update = {};
    Lang.Prompt.Update.repairText = 'Oprava opakování vzoru?';

    Lang.Prompt.Delete = {};
    Lang.Prompt.Delete.RemoveBtn = 'Odstranit';
    Lang.Prompt.Delete.CancelBtn = 'Zrušit';
    Lang.Prompt.Delete.ConfirmTitle = 'odebrat';
    Lang.Prompt.Delete.ConfirmText = 'Jste si jisti, že chcete odstranit tuto položku?';
    Lang.Prompt.Delete.chooseOneOrAllTitle = 'Odstranit položku (y)';
    Lang.Prompt.Delete.chooseOneOrAllText = "Přejete si odstranit pouze tuto položku nebo celou vzor?";
    Lang.Prompt.Delete.thisItemBtn = 'Tato položka';
    Lang.Prompt.Delete.allItemsBtn = 'Celý vzor';

    Lang.Settings = {};
    Lang.Settings.Legend = "Nastavení";
    Lang.Settings.Infotext = 'Tato nastavení budou použita pouze tehdy, když je někdo přihlášen, jinak bude použito nastavení z config.php.';
    Lang.Settings.DefaultView = 'Výchozí zobrazení';
    Lang.Settings.LabelWeekViewType = 'Weekview typ';
    Lang.Settings.LabelDayViewType = 'typ denním pohledem';
    Lang.Settings.LabelLanguage = 'jazyk';
    Lang.Settings.LabelOtherLanguage = 'Jiný jazyk';
    Lang.Settings.LabelShowAmPm = 'Zobrazit AM / PM';
    Lang.Settings.LabelShowWeeknumbers = 'Ukázat weeknumbers';
    Lang.Settings.LabelShowNotAllowedMessages = 'Zobrazit "není povoleno" zprávy';
    Lang.Settings.LabelMouseoverPopup = 'přejetí myší pop-up';
    Lang.Settings.LabelTruncateTitle = 'Zkraťte název';
    Lang.Settings.LabelTitleLength = 'délka hlava';
    Lang.Settings.LabelAmountOfCharacters = 'Počet znaků';
    Lang.Settings.LabelEditDialog = 'Edit dialog';
    Lang.Settings.LabelColorPickerType = 'typ ColorPicker';
    Lang.Settings.LabelTimePickerType = 'Timepicker typ';
    Lang.Settings.LabelMouseoverPopup = 'Ukázat mouseoverpopup';
    Lang.Settings.LabelTwoCapitals = "Dva kapitály";
    Lang.Settings.LabelShowDescription = 'Ukázat popis';
    Lang.Settings.LabelShowLocation = 'Show location';
    Lang.Settings.LabelShowPhone = 'Zobrazit telefon';
    Lang.Settings.LabelShowDeleteConfirmDialog = 'Zobrazit Potvrdit dialog při mazání položky';
    Lang.Settings.LabelHourcalculation = 'výpočet Hour';
    Lang.Settings.LabelWorkdayHours = 'pracovní den hodiny';
    Lang.Settings.LabelDefaultPeriod = 'Výchozí období';
    Lang.Settings.LabelWorkdayHoursInfo = 'Počet hodin v pracovní den';
    Lang.Settings.LabelDefaultPeriodInfo = "Počáteční doba v měsících,";
    Lang.Settings.LabelRegistration = 'Registrace';
    Lang.Settings.LabelRegistrationInfo = 'lze nastavit v config.php';
    Lang.Settings.LabelSendActivationMail = 'Odeslat activationmail';
    
    Lang.Hourcalculation = {};
    Lang.Hourcalculation.legend             = 'Hour calculation';
    Lang.Hourcalculation.legendOfUser       = 'Hour calculation of ';
   
    Lang.ListView = {};
    Lang.ListView.descriptionLabel = 'Upozornění:';
    Lang.ListView.locationLabel = 'Umístění:';
    Lang.ListView.phoneLabel = 'Telefon:';
    Lang.ListView.urlLabel = 'url';
    
    
    
    
