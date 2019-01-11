<?php 
session_start();
require 'includes/init.php';

$message = '';

// if (isset($_SESSION['user_id'])) {
// 	redirect('index.php');
// }

if (isset($_POST["register"])) {
	$username = trim(eshapper($_POST['username']));
	$password = trim(eshapper($_POST['password']));

	$check_query = "SELECT * FROM login WHERE username = :username";
	$statement = $db->prepare($check_query);

	$check_data = [
		':username' => $username
	];

	if ($statement->execute($check_data)) {
		if ($statement->rowCount() > 0) {
			$message .= '<p><label>Username already taken</label></p>';
		} else {
			if (empty($username)) {
				$message .= '<p><label>Username is required</label></p>';
			}
			if (empty($password)) {
				$message .= '<p><label>Password is required</label></p>';
			} else {
				if ($password != $_POST['confirm_password']) {
					$message .= '<p><label>Password not match</label></p>';
				}
			}
			if ($message == '') {
				$data = [
					':username' => $username,
					':password' => password_hash($password, PASSWORD_DEFAULT)
				];

				$query = "INSERT INTO login(username, password, connected) 
				          VALUES(:username, :password, NOW())";
				$statement = $db->prepare($query);
				if ($statement->execute($data)) {
					$message = "<label>Registration Completed</label>";
				}
			}
		}
	}
}

require 'views/index.view.php';