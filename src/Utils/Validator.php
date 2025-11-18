<?php
    namespace App\Utils;

    class Validator {
        public static function validateEmail(string $email): bool {
            return filter_var($email. FILTER_VALIDATE_EMAIL) !== false;
        }

        public static function validateLogin(string $login): bool {
            return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $login) === 1;
        }

        public static function validatePassword(string $password): bool {
            return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password) === 1;
        }
    }
?>