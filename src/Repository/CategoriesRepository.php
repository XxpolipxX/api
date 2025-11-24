<?php
    namespace App\Repository;
    use App\Database\Database;
    use App\Model\Categories;
    use PDO;

    class CategoriesRepository {
        public static function findByName(string $name): ?Categories {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `categories` WHERE `name` = ?");
            $zapytanie->bindParam(1, $name, PDO::PARAM_STR);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToCategories($row) : null;
        }

        public static function findByID(int $categoryID): ?Categories {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `categories` WHERE `id` = ?");
            $zapytanie->bindParam(1, $categoryID, PDO::PARAM_INT);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToCategories($row) : null;
        }

        public static function findAll(): array {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->query("SELECT * FROM `categories`");
            $rows = $zapytanie->fetchAll(PDO::FETCH_ASSOC);

            $categories = [];
            foreach($rows as $row) {
                $categories[] = self::mapRowToCategories($row);
            }

            return $categories;
        }

        private static function mapRowToCategories(array $row): Categories {
            return new Categories(
                (int)$row['id'],
                $row['name']
            );
        }
    }
?>