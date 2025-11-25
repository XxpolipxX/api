<?php
    namespace App\Controller;

    use App\Repository\PriorityRepository;
    use Exception;

    class PriorityController {
        public static function getAllPriorities(): array {
            try {
                $priorities = PriorityRepository::findAll();
                http_response_code(200);
                return ['success' => true, 'priorities' => array_map(fn($t) => $t->toArray(), $priorities)];;
            } catch(Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
    }
?>