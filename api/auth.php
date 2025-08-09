<?php
session_start();
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch($method) {
    case 'POST':
        if(isset($input['action'])) {
            switch($input['action']) {
                case 'login':
                    if($user->login($input['username'], $input['password'])) {
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['username'] = $user->username;
                        $_SESSION['role'] = $user->role;
                        $_SESSION['first_name'] = $user->first_name;
                        $_SESSION['last_name'] = $user->last_name;
                        
                        echo json_encode([
                            'success' => true,
                            'message' => 'Login erfolgreich',
                            'user' => [
                                'id' => $user->id,
                                'username' => $user->username,
                                'first_name' => $user->first_name,
                                'last_name' => $user->last_name,
                                'role' => $user->role
                            ]
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Ungültige Anmeldedaten'
                        ]);
                    }
                    break;

                case 'logout':
                    session_destroy();
                    echo json_encode([
                        'success' => true,
                        'message' => 'Erfolgreich abgemeldet'
                    ]);
                    break;

                case 'check_session':
                    if(isset($_SESSION['user_id'])) {
                        echo json_encode([
                            'success' => true,
                            'user' => [
                                'id' => $_SESSION['user_id'],
                                'username' => $_SESSION['username'],
                                'first_name' => $_SESSION['first_name'],
                                'last_name' => $_SESSION['last_name'],
                                'role' => $_SESSION['role']
                            ]
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Nicht angemeldet'
                        ]);
                    }
                    break;
            }
        }
        break;
}
?>