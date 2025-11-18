<?php
    namespace App;
    use App\Database\Database;

    class Test {
        public static function hello(): array {
            $pdo = Database::getConnection();
            $zapytanie = $pdo->prepare("DESC `users`");
            $zapytanie->execute();
            return $zapytanie->fetchAll();
        }
    }
?>