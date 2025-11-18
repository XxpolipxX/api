<?php

use App\Controller\UserController;

    require __DIR__ . '/../vendor/autoload.php';

    header('Content-Type: application/json');

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    if($uri === '/api/v1/register' && $method === 'POST') {
        // rejestracja
        $data = json_decode(file_get_contents('php://input'), true);
        $response = UserController::register($data);
        echo json_encode($response);
    } elseif($uri === '/api/v1/login' && $method === 'POST') {
        // logowanie
        $data = json_decode(file_get_contents('php://input'), true);
        $response = UserController::login($data);
        echo json_encode($response);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Błędny endpoint']);
    }
?>