<?php
session_start();
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../classes/Guide.php';
require_once '../classes/User.php';

if(!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Nicht angemeldet']);
    exit;
}

$database = new Database();
$db = $database->getConnection();
$guide = new Guide($db);
$user = new User($db);
$user->id = $_SESSION['user_id'];

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch($method) {
    case 'GET':
        if(isset($_GET['id'])) {
            $guide_data = $guide->getById($_GET['id']);
            if($guide_data) {
                $guide->incrementViews();
                echo json_encode(['success' => true, 'data' => $guide_data]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Anleitung nicht gefunden']);
            }
        } else {
            $published_only = !$user->hasPermission('manage_guides');
            $guides = $guide->getAll($published_only);
            echo json_encode(['success' => true, 'data' => $guides]);
        }
        break;

    case 'POST':
        if(!$user->hasPermission('create_guides')) {
            echo json_encode(['success' => false, 'message' => 'Keine Berechtigung']);
            exit;
        }

        $guide->title = $input['title'];
        $guide->description = $input['description'];
        $guide->content = $input['content'];
        $guide->category = $input['category'];
        $guide->author_id = $_SESSION['user_id'];
        $guide->is_published = $input['is_published'] ?? false;

        // Handle file upload if present
        if(isset($_FILES['file'])) {
            $upload_dir = '../uploads/guides/';
            if(!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_name = time() . '_' . $_FILES['file']['name'];
            $file_path = $upload_dir . $file_name;
            
            if(move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                $guide->file_path = 'uploads/guides/' . $file_name;
            }
        }

        if($guide->create()) {
            echo json_encode(['success' => true, 'message' => 'Anleitung erfolgreich erstellt']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler beim Erstellen der Anleitung']);
        }
        break;

    case 'PUT':
        if(!$user->hasPermission('manage_guides')) {
            echo json_encode(['success' => false, 'message' => 'Keine Berechtigung']);
            exit;
        }

        $guide->id = $input['id'];
        $guide->title = $input['title'];
        $guide->description = $input['description'];
        $guide->content = $input['content'];
        $guide->category = $input['category'];
        $guide->is_published = $input['is_published'];

        if($guide->update()) {
            echo json_encode(['success' => true, 'message' => 'Anleitung erfolgreich aktualisiert']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler beim Aktualisieren der Anleitung']);
        }
        break;

    case 'DELETE':
        if(!$user->hasPermission('manage_guides')) {
            echo json_encode(['success' => false, 'message' => 'Keine Berechtigung']);
            exit;
        }

        $guide->id = $input['id'];
        if($guide->delete()) {
            echo json_encode(['success' => true, 'message' => 'Anleitung erfolgreich gelöscht']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler beim Löschen der Anleitung']);
        }
        break;
}
?>