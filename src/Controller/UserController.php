<?php
    namespace App\Controller;

    use App\Model\User;
    use App\Repository\UserRepository;
    use App\Security\SessionManager;
    use App\Utils\Hash;
    use App\Utils\Validator;
    use Exception;

    class UserController {
        public static function register(array $data): array {
            // walidacja czy nie ma dodatkowych rzeczy w tablicy
            $allowedKeys = ['login', 'password', 'email'];
            $extraKeys = array_diff(array_keys($data), $allowedKeys);

            if(!empty($extraKeys)) {
                return ['success' => false, 'error' => 'Niedozwolone pola'];
            }


            try {
                $login = $data['login'] ?? '';
                if(!Validator::validateLogin($login)) {
                    return ['success' => false, 'error' => 'Błędny login'];
                }
                if(UserRepository::findByLogin($login) !== null) {
                    return ['success' => false, 'error' => 'Zajęty login'];
                }

                $plainPassword = $data['password'] ?? '';
                if(!Validator::validatePassword($plainPassword)) {
                    return ['success' => false, 'error' => 'Błędne hasło'];
                }
                $passwordHash = Hash::hashPassword($plainPassword);

                $email = $data['email'] ?? '';
                if(!Validator::validateEmail($email)) {
                    return ['success' => false, 'error' => 'Błędny email'];
                }

                UserRepository::addUser(new User($email, $login, $passwordHash));
                return ['success' => true, 'message' => 'Użytkownik zarejestrowany'];
            } catch(Exception $e) {
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public static function login(array $data): array {
            // walidacja czy nie ma dodatkowych rzeczy w tablicy
            $allowedKeys = ['login', 'password'];
            $extraKeys = array_diff(array_keys($data), $allowedKeys);

            if(!empty($extraKeys)) {
                return ['success' => false, 'error' => 'Niedozwolone pola'];
            }


            try {
                $login = $data['login'];
                if(!Validator::validateLogin($login)) {
                    return ['success' => false, 'error' => 'Błędny login'];
                }

                $plainPassword = $data['password'];
                if(!Validator::validatePassword($plainPassword)) {
                    return ['success' => false, 'error' => 'Błędne hasło'];
                }

                $user = UserRepository::findByLogin($login);
                if(!$user || !Hash::checkPassword($plainPassword, $user->getPasswordHash())) {
                    return ['success' => false, 'error' => 'Nieprawidłowy login lub hasło'];
                }

                $accessToken = SessionManager::generateAccessToken($user->getID());
                $refreshToken = SessionManager::generateRefreshToken($user->getID());
                SessionManager::setSessionCookies($accessToken, $refreshToken);

                return ['success' => true, 'message' => 'Zalogowano pomyślnie', 'user' => $user->toArray()];
            } catch(Exception $e) {
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
    }
?>