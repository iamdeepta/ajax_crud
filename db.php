<?php

//session_start();

/* for Local Server */

$host = 'localhost';

$user = 'root';

$pass = '';

$db = 'crudajax'; 



/* for Local Server 

$host = '192.168.253.15';

$user = 'root';

$pass = 'mysql@123';

$db = 'pwdweb';*/





//define('DBHR', 'db_hr');

/*define('DBPMS', 'pwdpms3');*/ 





/* for online server 

$host = 'localhost';

$user = 'pwdcdshelltechno_deepta';

$pass = ';AB7[-S[k+a_';

$db = 'pwdcdshelltechno_contractor';





define('DBHR', 'pwdcdshelltechno_contractor');

define('DBPMS', 'pwdcdshelltechno_contractor');*/



	/*$dblink = mysql_connect($host,$user,$pass)

	or

	die("Can't connect to database");

	mysql_select_db($db, $dblink)

	or

	die("Can't find the database");

	mysql_query('SET CHARACTER SET utf8');

mysql_query("SET SESSION collation_connection ='utf8_general_ci'") or die (mysql_error());*/



/*if(isset($_SESSION["OfficeID"]) && $_SESSION["OfficeID"]!=''){

$where="OfficeID=".$_SESSION["OfficeID"];

if($_SESSION["OfficeID"]==43 || $_SESSION["OfficeID"]==44 || $_SESSION["OfficeID"]==45 || $_SESSION["OfficeID"]==46 || $_SESSION["OfficeID"]==47 ||$_SESSION["OfficeID"]==55 || $_SESSION["OfficeID"]==56 || $_SESSION["OfficeID"]==57 || $_SESSION["OfficeID"]==58) {

$whereproject=" tbl_project_division.OfficeID=".$_SESSION["OfficeID"];

} else {

$whereproject='FIND_IN_SET('.$_SESSION["OfficeID"].',DivisionID)';

}

}

else {

	$where="OfficeID!=0";

	$whereproject='!FIND_IN_SET(0,DivisionID)';

}*/





// Create connection

$conn = mysqli_connect($host, $user, $pass, $db);
/* for retrieving bangla from database */
mysqli_query($conn,'SET CHARACTER SET utf8');
mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'") or die (mysql_error($conn));


// Check connection

if (!$conn) {

  die("Connection failed: " . mysqli_connect_error());

}

?>