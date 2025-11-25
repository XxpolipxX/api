<?php

    use App\Controller\CategoriesController;
    use App\Controller\PriorityController;
    use App\Controller\TaskController;
    use App\Controller\UserController;
    use App\Core\Router;
    use App\Security\SessionManager;
    use App\Repository\UserRepository;

    require __DIR__ . '/../vendor/autoload.php';

    header('Content-Type: application/json');

    $router = new Router();


    // v1

    // rejestracja
    $router->add('POST', '/api/v1/register', function($data): array {
        return UserController::register($data);
    });

    // logowanie
    $router->add('POST', '/api/v1/login', function($data): array {
        return UserController::login($data);
    });

    // sprawdzanie sesji
    $router->add('GET', '/api/v1/check_session', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        $user = UserRepository::findByID($userID);
        if(!$user) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        http_response_code(200);
        return ['success' => true, 'message' => 'jest sesja'];
    });

    // wylogowanie
    $router->add('DELETE', '/api/v1/logout', function(): array {
        SessionManager::logout();
        http_response_code(200);
        return ['success' => true, 'message' => 'Wylogowano'];
    });

    // zwrócenie loginu usera, który ma sesję
    $router->add('GET', '/api/v1/getLogin', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        $user = UserRepository::findByID($userID);
        if(!$user) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        http_response_code(200);
        return ['success' => true, 'login' => $user->getLogin()];
    });

    // zmiana loginu
    $router->add('PATCH', '/api/v1/changeLogin', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        $user = UserRepository::findByID($userID);
        if(!$user) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return UserController::changeLogin($user->getID(), $data);
    });

    // usunięcie konta
    $router->add('DELETE', '/api/v1/deleteAccount', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        $user = UserRepository::findByID($userID);
        if(!$user) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        SessionManager::logout();
        return UserController::deleteUser($user->getID());
    });

    $router->add('PATCH', '/api/v1/changeEmail', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        $user = UserRepository::findByID($userID);
        if(!$user) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return UserController::changeEmail($user->getID(), $data);
    });


    // v2

    // pobranie wszystkich kategorii
    $router->add('GET', '/api/v2/getCategories', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return CategoriesController::getAllCategories();
    });

    // pobranie wszystkich priority
    $router->add('GET', '/api/v2/getPriorities', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return PriorityController::getAllPriorities();
    });

    // dodanie nowego taska
    $router->add('POST', '/api/v2/addTask', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::createTask($data, $userID);
    });
    

    // obsługa żądania
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $router->dispatch($method, $uri);
?>