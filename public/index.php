<?php

    use App\Controller\CategoriesController;
    use App\Controller\PriorityController;
    use App\Controller\TaskController;
    use App\Controller\UserController;
    use App\Core\Router;
use App\Model\Task;
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

    // pobranie wszystkich tasków dla danego usera
    $router->add('GET', '/api/v2/getTasksForUser', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::getTasksByUser($userID);
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

    // edycja taska
    $router->add('PUT', '/api/v2/updateTask', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::updateTask($data);
    });

    // usunięcie taska
    $router->add('DELETE', '/api/v2/deleteTask', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::deleteTask($data);
    });

    // oznacz jako wykonane
    $router->add('PATCH', '/api/v2/markAsDone', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::markFinished($data);
    });

    // pobranie tasków z filtrami od klienta
    $router->add('GET', '/api/v2/getFilteredTasks', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::getTasksWithFilters($userID, $_GET);
    });

    // pobranie info o tasku
    $router->add('GET', '/api/v2/getTaskByID', function($data): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::getTaskByID($data);
    });

    // pobranie wykonanych tasków
    $router->add('GET', '/api/v2/getCompleted', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::getCompletedTasks($userID);
    });

    // pobranie oczekujących tasków
    $router->add('GET', '/api/v2/getPending', function(): array {
        $userID = SessionManager::getAuthenticatedUserID();
        if(!$userID) {
            http_response_code(401);
            return ['success' => false, 'error' => 'Brak aktywnej sesji'];
        }
        return TaskController::getPending($userID);
    });
    

    // obsługa żądania
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $router->dispatch($method, $uri);
?>