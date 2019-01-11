<?php 
session_start();
require 'includes/init.php';

$message = '';

if (get_session('user_id')) {
	redirect('messages.php');
}

if (isset($_POST['login'])) {
	extract($_POST);

	$query = "SELECT * FROM login
	          WHERE username = :username";
	$statement = $db->prepare($query);

	$statement->execute([
		':username' => eshapper($username)
	]);

	$count = $statement->rowCount();
	if ($count > 0) {
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			if (password_verify($password, $row["password"])) {
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];

				$sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['user_id']."')";
				$statement = $db->prepare($sub_query);
				$statement->execute();

				$_SESSION['login_details_id'] = $db->lastInsertId();
				
				redirect('messages.php');
			} else {
				$message = '<label>Wrong Password</label>';
			}
		}
	} else {
		$message = '<label>Wrong Username</label>';
	}
}

require 'views/login.view.php';