<?php
    namespace App\Core;

    class Router {
        private array $routes = [];

        public function add(string $method, string $path, callable $handler): void {
            $method = strtoupper($method);
            $this->routes[$method][$path] = $handler;
        }

        public function dispatch(string $method, string $uri): void {
            $method = strtoupper($method);
            $uri = rtrim($uri, '/');

            $handler = $this->routes[$method][$uri] ?? null;

            if(!$handler) {
                http_response_code(404);
                echo json_encode(['error' => 'Błędny endpoint', 'endpoint' => $uri]);
                return;
            }

            $data = [];
            if(in_array($method, ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'], true)) {
                $raw = file_get_contents('php://input');
                if(!empty($raw)) {
                    $decoded = json_decode($raw, true);
                    if(is_array($decoded)) {
                        $data = $decoded;
                    }
                }
            }

            $response = $handler($data);
            echo json_encode($response);
        }
    }
?>