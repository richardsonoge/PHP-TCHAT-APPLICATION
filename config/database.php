<?php


// Connexion a la base de donnee
// define('DB_HOST', 'fdb17.your-hosting.net');
// define('DB_NAME', '2401067_boom');
// define('DB_USER', '2401067_boom');
// define('DB_CHARSET', 'utf8');
// define('DB_PASSWORD', '1997080620oge');


// try {
// 	$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD);
// 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);	
// } 
// catch (PDOException $e) {
// 	echo "Impossible de se connecter a la base de donnee<br>";
// 	die('Erreur: '.$e->getMessage());
// }


//Connexion a la base de donnee
// $db = new PDO("mysql:host=127.0.0.1;dbname=tchat_application", "root", "");
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'tchat_application');
define('DB_USER', 'root');
define('DB_CHARSET', 'utf8mb4');
define('DB_PASSWORD', '');


try {
	$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);	
	$db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");	
	// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);	
} 
catch (PDOException $e) {
	echo "Impossible de se connecter a la base de donnee<br>";
	die('Erreur: '.$e->getMessage());
}

