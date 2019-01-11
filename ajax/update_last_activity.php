<?php 
session_start();
require '../config/database.php';

$query = "UPDATE login_details SET last_activity = now() 
          WHERE login_details_id = '".$_SESSION["login_details_id"]."'";

$statement = $db->prepare($query);

$statement->execute();
