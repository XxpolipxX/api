<?php
    namespace App\Database;
    use PDO;
    use PDOException;
    use RuntimeException;

    class Database {
        private static ?PDO $connection = null;

        public function __construct() {}

        public static function getConnection(): PDO {
            $host = getenv('DB_HOST');
            $database = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $charset = getenv('DB_CHARSET') ?: 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                PDO::MYSQL_ATTR_SSL_CA => null
            ];

            try {
                self::$connection = new PDO($dsn, $user, $pass, $options);
            } catch(PDOException $e) {
                throw new RuntimeException('Zfejlowano połączenie z bazą: ' . $e->getMessage());
            }
            return self::$connection;
        }
    }
?>