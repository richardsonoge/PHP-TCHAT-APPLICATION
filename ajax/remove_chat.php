<?php 
session_start();
require '../config/database.php';
require '../includes/functions.php';

// remove_chat.php

if (isset($_POST["chat_message_id"])) {
	$query = "UPDATE chat_message SET status = '2' WHERE chat_message_id = '".$_POST["chat_message_id"]."'";

	$statement = $db->prepare($query);

	$statement->execute();
}