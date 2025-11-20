<?php
    use App\Controller\UserController;
    use App\Core\Router;
    use App\Security\SessionManager;

    require __DIR__ . '/../vendor/autoload.php';

    header('Content-Type: application/json');

    $router = new Router();

    // rejestracja
    $router->add('POST', '/api/v1/register', function($data) {
        return UserController::register($data);
    });

    // logowanie
    $router->add('POST', '/api/v1/login', function($data) {
        return UserController::login($data);
    });

    // sprawdzanie sesji
    $router->add('GET', '/api/v1/check_session', function() {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        http_response_code(200);
        return ['success' => true, 'message' => 'jest sesja'];
    });

    // wylogowanie
    $router->add('GET', '/api/v1/logout', function() {
        SessionManager::logout();
        http_response_code(200);
        return ['success' => true, 'message' => 'Wylogowano'];
    });

    // obsługa żądania
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    sleep(3);
    $router->dispatch($method, $uri);
?>