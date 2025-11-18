<?php
    namespace App\Repository;

    use App\Database\Database;
    use App\Model\User;
    use Exception;
    use PDO;

    class UserRepository {
        public static function findByEmail(string $email): ?User {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `users` WHERE `email` = ?");
            $zapytanie->bindParam(1, $email, PDO::PARAM_STR);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToUser($row) : null;
        }

        public static function findByID(int $id): ?User {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `users` WHERE `id` = ?");
            $zapytanie->bindParam(1, $id, PDO::PARAM_INT);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToUser($row) : null;
        }

        public static function findByLogin(string $login): ?User {
            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("SELECT * FROM `users` WHERE `login` = ?");
            $zapytanie->bindParam(1, $login, PDO::PARAM_STR);
            $zapytanie->execute();
            $row = $zapytanie->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToUser($row) : null;
        }

        public static function addUser(User $user): bool {
            if (self::findByEmail($user->getEmail())) {
                throw new Exception("Email zajęty");
            }

            if (self::findByLogin($user->getLogin())) {
                throw new Exception("Login zajęty");
            }

            $polaczenie = Database::getConnection();
            $zapytanie = $polaczenie->prepare("INSERT INTO `users` (`email`, `login`, `password_hash`) VALUES (?, ?, ?)");
            $zapytanie->bindValue(1, $user->getEmail(), PDO::PARAM_STR);
            $zapytanie->bindValue(2, $user->getLogin(), PDO::PARAM_STR);
            $zapytanie->bindValue(3, $user->getPasswordHash(), PDO::PARAM_STR);

            return $zapytanie->execute();
        }

        public static function deleteUser(int $id): bool {
            if(!self::findByID($id)) {
                throw new Exception("Nie znaleziono użytkownika o podanym ID");
            } else {
                $polaczenie = Database::getConnection();
                $zapytanie = $polaczenie->prepare("DELETE FROM `users` WHERE `id` = ?");
                $zapytanie->bindParam(1, $id, PDO::PARAM_INT);
                return $zapytanie->execute();
            }
        }

        public static function updateLogin(string $newLogin, int $id): bool {
            if(self::findByLogin($newLogin)) {
                throw new Exception("Login zajęty");
            } elseif(!self::findByID($id)) {
                throw new Exception("Nie znaleziono użytkownika o podanym ID");
            } else {
                $polaczenie = Database::getConnection();
                $zapytanie = $polaczenie->prepare("UPDATE `users` SET `login` = ? WHERE `id` = ?");
                $zapytanie->bindParam(1, $newLogin, PDO::PARAM_STR);
                $zapytanie->bindParam(2, $id, PDO::PARAM_INT);
                return $zapytanie->execute();
            }
        }

        public static function updatePassword(string $newPassword, int $id): bool {
            if(!self::findByID($id)) {
                throw new Exception("Nie znaleziono użytkownika o podanym ID");
            } else {
                $polaczenie = Database::getConnection();
                $zapytanie = $polaczenie->prepare("UPDATE `users` SET `password_hash` = ? WHERE `id` = ?");
                $zapytanie->bindParam(1, $newPassword, PDO::PARAM_STR);
                $zapytanie->bindParam(2, $id, PDO::PARAM_INT);
                return $zapytanie->execute();
            }
        }

        public static function updateEmail(string $newEmail, int $id): bool {
            if(self::findByEmail($newEmail) !== null) {
                throw new Exception("Email zajęty");
            } elseif(self::findByID($id) === null) {
                throw new Exception("Nie znaleziono użytkownika o podanym ID");
            } else {
                $polaczenie = Database::getConnection();
                $zapytanie = $polaczenie->prepare("UPDATE `users` SET `email` = ? WHERE `id` = ?");
                $zapytanie->bindParam(1, $newEmail, PDO::PARAM_STR);
                $zapytanie->bindParam(2, $id, PDO::PARAM_INT);
                return $zapytanie->execute();
            }
        }

        private static function mapRowToUser(array $row): User {
            return new User(
                $row['email'],
                $row['login'],
                $row['password_hash'],
                (int)$row['id']
            );
        }
    }
?>