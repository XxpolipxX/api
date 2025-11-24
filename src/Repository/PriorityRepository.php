<?php
    namespace App\Repository;
    use App\Database\Database;
    use App\Model\Priority;
    use PDO;

    class PriorityRepository {
        public static function findByName(string $name): ?Priority {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `priority` WHERE `name` = ?");
            $zapytanie->bindParam(1, $name, PDO::PARAM_STR);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToPriority($row) : null;
        }

        public static function findByID(int $priorityID): ?Priority {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `priority` WHERE `id` = ?");
            $zapytanie->bindParam(1, $priorityID, PDO::PARAM_INT);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToPriority($row) : null;
        }

        public static function findAll(): array {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->query("SELECT * FROM `priority`");
            $rows = $zapytanie->fetchAll(PDO::FETCH_ASSOC);

            $priorities = [];
            foreach($rows as $row) {
                $priorities[] = self::mapRowToPriority($row);
            }

            return $priorities;
        }

        private static function mapRowToPriority(array $row): Priority {
            return new Priority(
                (int)$row['id'],
                $row['name']
            );
        }
    }
?>