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
                // echo '<pre>';
                // print_r($this->routes);
                // echo '</pre>';
                echo json_encode(['error' => 'Błędny endpoint', 'endpoint' => $uri]);
                return;
            }

            $data = $method === 'POST' ? json_decode(file_get_contents('php://input'), true) ?? [] : [];
            $response = $handler($data);
            echo json_encode($response);
        }
    }
?>