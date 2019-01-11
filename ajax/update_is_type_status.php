<?php 
session_start();
require '../config/database.php';
require '../includes/functions.php';

$is_type = eshapper($_POST["is_type"]);
$login_details_id = eshapper($_SESSION["login_details_id"]);

$query = "
   UPDATE login_details
   SET is_type = '".eshapper($_POST["is_type"])."'
   WHERE login_details_id = '".eshapper($_SESSION["login_details_id"])."'";

$statement = $db->prepare($query);

$statement->execute();   