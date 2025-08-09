<?php
session_start();
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../classes/User.php';

// Check if user is logged in and has permission
if(!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Nicht angemeldet']);
    exit;
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->id = $_SESSION['user_id'];

if(!$user->hasPermission('manage_users')) {
    echo json_encode(['success' => false, 'message' => 'Keine Berechtigung']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch($method) {
    case 'GET':
        $users = $user->getAll();
        echo json_encode(['success' => true, 'data' => $users]);
        break;

    case 'POST':
        $new_user = new User($db);
        $new_user->username = $input['username'];
        $new_user->email = $input['email'];
        $new_user->password_hash = password_hash($input['password'], PASSWORD_DEFAULT);
        $new_user->first_name = $input['first_name'];
        $new_user->last_name = $input['last_name'];
        $new_user->role = $input['role'];

        if($new_user->create()) {
            echo json_encode(['success' => true, 'message' => 'Benutzer erfolgreich erstellt']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler beim Erstellen des Benutzers']);
        }
        break;

    case 'PUT':
        $update_user = new User($db);
        $update_user->id = $input['id'];
        $update_user->username = $input['username'];
        $update_user->email = $input['email'];
        $update_user->first_name = $input['first_name'];
        $update_user->last_name = $input['last_name'];
        $update_user->role = $input['role'];
        $update_user->is_active = $input['is_active'];

        if($update_user->update()) {
            echo json_encode(['success' => true, 'message' => 'Benutzer erfolgreich aktualisiert']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler beim Aktualisieren des Benutzers']);
        }
        break;

    case 'DELETE':
        $delete_user = new User($db);
        $delete_user->id = $input['id'];

        if($delete_user->delete()) {
            echo json_encode(['success' => true, 'message' => 'Benutzer erfolgreich gelöscht']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler beim Löschen des Benutzers']);
        }
        break;
}
?>