<?php 
session_start();
require '../config/database.php';
require '../includes/functions.php';

$data = [
	':to_user_id' => eshapper($_POST['to_user_id']),
	':from_user_id' => eshapper(get_session('user_id')),
	':chat_message' => eshapper($_POST['chat_message']),
	':status' => '1'
];

$query = "INSERT INTO chat_message(from_user_id, to_user_id, chat_message, status, time_at)
VALUES(:from_user_id, :to_user_id, :chat_message, :status, now())";

$statement = $db->prepare($query);

if ($statement->execute($data)) {
     echo fetch_user_chat_history(get_session('user_id'), eshapper($_POST['to_user_id']));
}