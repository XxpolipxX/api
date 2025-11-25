<?php
    namespace App\Utils;

    use DateTime;

    class Validator {
        public static function validateEmail(string $email): bool {
            return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        public static function validateLogin(string $login): bool {
            return preg_match('/^[a-zA-Z0-9_]{3,100}$/', $login) === 1;
        }

        public static function validatePassword(string $password): bool {
            return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/', $password) === 1;
        }

        public static function validateTitle(string $title): bool {
            // od 3 do 255 znaków
            return !empty($title) && mb_strlen($title) >= 3 && mb_strlen($title) <= 255;
        }

        public static function validateDescription(string $description): bool {
            return !empty($description) && mb_strlen($description) <= 300;
        }

        public static function validateDate(string $date): bool {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            return $d && $d->format('Y-m-d') === $date;
        }
    }
?>