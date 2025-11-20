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
                http_response_code(400);
                return ['success' => false, 'error' => 'Niedozwolone pola'];
            }


            try {
                $login = $data['login'] ?? '';
                if(!Validator::validateLogin($login)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędny login'];
                }
                if(UserRepository::findByLogin($login) !== null) {
                    http_response_code(409);
                    return ['success' => false, 'error' => 'Zajęty login'];
                }

                $plainPassword = $data['password'] ?? '';
                if(!Validator::validatePassword($plainPassword)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędne hasło'];
                }
                $passwordHash = Hash::hashPassword($plainPassword);

                $email = $data['email'] ?? '';
                if(!Validator::validateEmail($email)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędny email'];
                }

                if(UserRepository::findByEmail($email) !== null) {
                    http_response_code(409);
                    return ['success' => false, 'error' => 'Zajęty email'];
                }

                UserRepository::addUser(new User($email, $login, $passwordHash));
                http_response_code(201);
                return ['success' => true, 'message' => 'Użytkownik zarejestrowany', 'login' => $login];
            } catch(Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public static function login(array $data): array {
            // walidacja czy nie ma dodatkowych rzeczy w tablicy
            $allowedKeys = ['login', 'password'];
            $extraKeys = array_diff(array_keys($data), $allowedKeys);

            if(!empty($extraKeys)) {
                http_response_code(400);
                return ['success' => false, 'error' => 'Niedozwolone pola'];
            }


            try {
                $login = $data['login'];
                if(!Validator::validateLogin($login)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędny login'];
                }

                $plainPassword = $data['password'];
                if(!Validator::validatePassword($plainPassword)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędne hasło'];
                }

                $user = UserRepository::findByLogin($login);
                if(!$user || !Hash::checkPassword($plainPassword, $user->getPasswordHash())) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Nieprawidłowy login lub hasło'];
                }

                $accessToken = SessionManager::generateAccessToken($user->getID());
                $refreshToken = SessionManager::generateRefreshToken($user->getID());
                SessionManager::setSessionCookies($accessToken, $refreshToken);

                http_response_code(200);
                return ['success' => true, 'message' => 'Zalogowano pomyślnie', 'login' => $user->getLogin()];
            } catch(Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
    }
?>
