<?php 
// proteger le formulaire contre les codes
if (!function_exists('eshapper')) {
    function eshapper($string)
    {
        if ($string) {
            return htmlspecialchars($string);   
        }
    }
}

// proteger le formulaire contre les codes
if (!function_exists('fetch_group_chat_history')) {
    function fetch_group_chat_history()
    {
        global $db;

        $query = "SELECT * FROM chat_message WHERE to_user_id = '0' ORDER BY time_at ASC";

        $statement = $db->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();

        $output = '<ul class="list-unstyled">';
        foreach ($result as $row) {
            $user_name = '';
            $dynamic_background = '';
            $chat_message = '';
            if ($row["from_user_id"] == $_SESSION['user_id']) {
                if ($row["status"] == '2') {
                    $chat_message = '<em>This message has been removed</em>';
                    $user_name = '<b class="text-success">You</b>';
                } else {
                    $chat_message = $row["chat_message"];
                    $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">X</button>&nbsp;<b class="text-success">You</b>';
                }
                $dynamic_background = 'background-color: #ffe6e6;';
            } else {
                if ($row["status"] == '2') {
                    $chat_message = '<em>This message has been removed</em>';
                } else {
                    $chat_message = $row["chat_message"];
                }
                $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
                $dynamic_background = 'background-color: #ffffe6;';
            }
            $output .= '
            <li style="border-bottom: 1px dotted #ccc;">
               <p>'.$user_name.' - '.$chat_message.'
                   <div align="right">
                       - <small><em><i class="fa fa-clock-o"></i> <span class="time_date timeago" title="'.$row['time_at'].'">'.$row['time_at'].'</span></em></small>
                   </div>
               </p>
            </li>'; 
        }
        $output .= '</ul>';
        return $output;
    }
}

// proteger le formulaire contre les codes
if (!function_exists('fetch_is_type_status')) {
    function fetch_is_type_status($user_id)
    {
        global $db;

        $query = "SELECT is_type FROM login_details WHERE user_id = $user_id ORDER BY last_activity DESC LIMIT 1";

        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';

        foreach ($result as $row) {
            if ($row['is_type'] == 'yes') {
                $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
            } 
        }
        return $output;
    }
}

// proteger le formulaire contre les codes
if (!function_exists('count_unseen_message')) {
    function count_unseen_message($from_user_id, $to_user_id)
    {
        global $db;

        $query = "
        SELECT * FROM chat_message
        WHERE from_user_id = $from_user_id
        AND to_user_id = $to_user_id
        AND status = '1'
        ";

        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $output = '';
        if ($count > 0) {
            $output = '<span class="label label-success">'.$count.'</span>';
        } 
        return $output;
    }
}

// proteger le formulaire contre les codes
if (!function_exists('get_user_name')) {
    function get_user_name($user_id)
    {
        global $db;

        $query = "SELECT username FROM login WHERE user_id = '$user_id'";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $row) {
            return $row['username'];
        }
    }
}

// proteger le formulaire contre les codes
if (!function_exists('fetch_user_chat_history')) {
    function fetch_user_chat_history($from_user_id, $to_user_id)
    {
        global $db;
        
        $query = "SELECT * FROM chat_message
                  WHERE (from_user_id = $from_user_id AND to_user_id = $to_user_id)
                  OR (from_user_id = $to_user_id AND to_user_id = $from_user_id)
                  ORDER BY time_at ASC";

        $statement = $db->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();
        $output = '<ul class="list-unstyled">';

        foreach ($result as $row) {
            $user_name = '';
            $dynamic_background = '';
            $chat_message = '';
            if ($row["from_user_id"] == $from_user_id) {

                if ($row["status"] == '2') {
                    $chat_message = '<em>This message has been removed</em>';
                    $user_name = '<b class="text-success">You</b>';
                } else {
                    $chat_message = $row['chat_message'];
                    $user_name = '<button type="button" class="btn 
                                  btn-danger btn-xs remove_chat" 
                                  id="'.$row['chat_message_id'].'">X</button>&nbsp;
                                  <b class="text-success">You</b>';
                }

                $dynamic_background = 'background-color: #ffe6e6';
            } else {
                if ($row["status"] == '2') {
                    $chat_message = '<em>This message has been removed</em>';
                } else {
                    $chat_message = $row["chat_message"];
                }
                $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
                $dynamic_background = 'background-color: #ffffe6';
            }
            $output .= '
            <li style="border-bottom: 1px dotted #ccc; padding-top: 8px; padding-left: 8px; padding-right: 8px;'.$dynamic_background.'">
                <p>'.$user_name.' - '.$chat_message.'
                   <div align="right">
                        - <small><em><i class="fa fa-clock-o"></i> <span class="time_date timeago" title="'.$row['time_at'].'">'.$row['time_at'].'</span></em></small>
                   </div>
                </p>
            </li>';
        }
        $output .= '</ul>';
        $query = "
           UPDATE chat_message
           SET status = '0'
           WHERE from_user_id = $to_user_id
           AND to_user_id = $from_user_id
           AND status = '1'
        ";
        $statement = $db->prepare($query);
        $statement->execute();
        return $output;
    }
}

// Afficher la dernière connection de l'user
if (!function_exists('fetch_user_last_activity')) {
    function fetch_user_last_activity($user_id)
    {
        global $db;
        
        $query = "SELECT * FROM login_details
                  WHERE user_id = '$user_id'
                  ORDER BY last_activity DESC 
                  LIMIT 1";

        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $row) {
            return $row['last_activity'];
        }
    }
}


// protéger l'url de l'utilisateur
if (!function_exists('get_session')) {
    function get_session($key)
    {
        if ($key) {
            return !empty($_SESSION[$key]) ? eshapper($_SESSION[$key]) : null;
        }
    }
}

// Redirection de la page du formulaire, pour afficher le message set_flash
if (!function_exists('redirect')) {
	function redirect($page){
		header('Location: '.$page);
		exit();
	}
}