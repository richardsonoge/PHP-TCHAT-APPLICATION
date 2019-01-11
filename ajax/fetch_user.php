<?php 
session_start();
require '../config/database.php';
require '../includes/functions.php';

$query = "SELECT * FROM login WHERE user_id != '".$_SESSION['user_id']."'";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '
<table class="table table-bordered table-striped">
	<tr>
	   <td>Username</td>
	   <td>Status</td>
	   <td>Action</td>
	</tr>
';

foreach ($result as $row) {
	$status = '';
	$current_timestamp = strtotime(date('Y-m-d H:i:s'). '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['user_id']);

	if ($user_last_activity > $current_timestamp) {
		$status = '<span class="label label-success">Online</span>';
	} else {
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	    <tr>
	       <td>'.$row['username'].' '.count_unseen_message(eshapper($row['user_id']), eshapper(get_session('user_id'))).' '.fetch_is_type_status(eshapper($row['user_id'])).'</td>
	       <td>'.$status.'</td>
	       <td>
	         <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button>
	       </td>
	    </tr>
	';
}

$output .= '</table>';

echo $output;