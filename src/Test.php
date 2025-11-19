<?php
    namespace App;
    use App\Database\Database;
    use App\Security\SessionManager;

    class Test {
        public static function hello(): string {
            $test = SessionManager::generateAccessToken(1);
            return $test;
        }
    }
?>