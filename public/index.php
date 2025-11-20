<?php

    use App\Controller\UserController;
    use App\Security\SessionManager;

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
    } elseif($uri === '/api/v1/check_session' && $method === 'GET') {
        // endpoint do sprawdzenia sesji
        $userID = SessionManager::getAuthenticatedUserID();
        // echo '<pre>';
        // print_r($_COOKIE);
        // echo '</pre>';
        if(!$userID) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Brak aktywnej sesji', 'message' => 'test']);
        } else {
            echo json_encode(['success' => true, 'message' => 'jest sesja']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Błędny endpoint', 'endpoint' => $uri]);
    }



    // autoryzacja ciastka z tokenem do wykorzystania potem
    // trza to wstawić do endpointa
    // $userID = SessionManager::getAuthenticatedUserID();
    // if(!$userID) {
    //     http_response_code(401);
    //     echo json_encode(['success' => false, 'error' => 'Brak autoryzacji']);
    //     exit;
    // }
    //
    // tu jak jest autoryzowany
?>
