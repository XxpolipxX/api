<?php
    namespace App\Controller;

    use App\Repository\CategoriesRepository;
    use Exception;

    class CategoriesController {
        public static function getAllCategories(): array {
            try {
                $categories = CategoriesRepository::findAll();
                http_response_code(200);
                return ['success' => true, 'categories' => array_map(fn($t) => $t->toArray(), $categories)];
            }catch(Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
    }
?>