<?php 
session_start();
require '../config/database.php';
require '../includes/functions.php';

if ($_POST["action"] == "insert_data") {
	$data = [
		':from_user_id' => $_SESSION['user_id'],
		':to_user_id' => '0',
		':chat_message' => $_POST['chat_message'],
		':status' => '1'
	];

	$query = "
	INSERT INTO chat_message
	(from_user_id, to_user_id, chat_message, status, time_at)
	VALUES(:from_user_id, :to_user_id, :chat_message, :status, now())
    ";

	$statement = $db->prepare($query);

	if ($statement->execute($data)) {
		echo fetch_group_chat_history();
	} 
} 

if ($_POST["action"] == "fetch_data") {
	echo fetch_group_chat_history();
} 