<?php 
session_start();
require '../config/database.php';
require '../includes/functions.php';

echo fetch_user_chat_history(eshapper(get_session('user_id')), eshapper($_POST['to_user_id']));