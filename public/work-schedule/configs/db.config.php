<?php
/*
 * Created on 17-okt-2011
 * author Paul Wolbers
 */

function database_connect() {
    global $obj_db;

    // get calendar database
    if($_SERVER["HTTP_HOST"] == 'localhost') {
    	// local webserver on your computer, like XAMPP
        DEFINE('DBHOST','localhost');
		DEFINE('DBUSER','root');
		DEFINE('DBPASS','');
    	DEFINE('DBNAAM','employee-work-schedule');
    } else {
        // online use, so when you have the calendar on the online website 
    	DEFINE('DBHOST','localhost');
		DEFINE('DBUSER','raman');
		DEFINE('DBPASS','cPuXtGrNbnP5RTEJac');
    	DEFINE('DBNAAM','work_schedule');

    }

    $obj_db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAAM);
    if($obj_db === FALSE) {
        $error= "Database connection failed";
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
	mysqli_set_charset( $obj_db , 'utf8' );
}
?>
