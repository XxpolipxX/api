<?php
    namespace App\Security;

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    class SessionManager {
        private const ACCESS_TTL = 900;     // 15 minut
        private const REFRESH_TTL = 604800;  // 7 dni
        private const ALGORITHM = 'HS256';
        private static string $SECRET;

        private static function init(): void {
            self::$SECRET = getenv('SECRET_KEY') ?: throw new \RuntimeException('Ni ma sikret kija');
        }

        public static function generateAccessToken(int $userID): string {
            if(!isset(self::$SECRET)) {
                self::init();
            }

            $now = time();
            $payload = [
                'sub' => $userID,
                'iat' => $now,
                'exp' => $now + self::ACCESS_TTL,
                'type' => 'access'
            ];
            return JWT::encode($payload, self::$SECRET, self::ALGORITHM);
        }

        public static function generateRefreshToken(int $userID): string {
            $now = time();
            $payload = [
                'sub' => $userID,
                'iat' => $now,
                'exp' => $now + self::REFRESH_TTL,
                'type' => 'refresh'
            ];
            return JWT::encode($payload, self::$SECRET, self::ALGORITHM);
        }

        public static function setSessionCookies(string $accessToken, string $refreshToken): void {
            self::setCookie('access_token', $accessToken, self::ACCESS_TTL);
            self::setCookie('refresh_token', $refreshToken, self::REFRESH_TTL);
        }

        public static function decodeToken(string $token): ?object {
            try {
                return JWT::decode($token, new Key(self::$SECRET, self::ALGORITHM));
            } catch(\Throwable $e) {
                return null;
            }
        }

        public static function getAuthenticatedUserID(): ?int {
            $token = $_COOKIE['access_token'] ?? null;
            if(!$token) {
                return null;
            }

            try {
                $decoded = JWT::decode($token, new Key(self::$SECRET, self::ALGORITHM));
                if(($decoded->type ?? '') !== 'access') {
                    return null;
                }

                return isset($decoded->sub) ? (int)$decoded->sub : null;
            } catch(\Throwable $e) {
                return null;
            }
        }

        private static function setCookie(string $name, string $value, int $ttl): void {
            setcookie($name, $value, [
                'expires' => time() + $ttl,
                'path' => '/',
                'httponly' => true
            ]);
        }
    }
?>