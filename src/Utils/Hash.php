<?php
    namespace App\Utils;

    class Hash {
        public static function hashPassword(string $plainPassword): string {
            return password_hash($plainPassword, PASSWORD_DEFAULT);
        }

        public static function checkPassword(string $plain, string $hash): bool {
            return password_verify($plain, $hash);
        }
    }
?>