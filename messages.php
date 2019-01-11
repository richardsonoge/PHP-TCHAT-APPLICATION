<?php 
session_start();
require 'includes/init.php';

$message = '';

// if (!get_session('user_id')) {
// 	redirect('login.php');
// }

require 'views/messages.view.php';