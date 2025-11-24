<?php
    namespace App\Repository;

    use App\Database\Database;
    use App\Model\Task;
    use Exception;
    use PDO;

    class TaskRepository {
        public static function findByID(int $id): ?Task {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `id` = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row ? self::mapRowToTask($row) : null;
        }

        public static function findByUserID(int $userID): array {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `user_id` = ?");
            $stmt->bindParam(1, $userID, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($rows as $row) {
                $tasks[] = self::mapRowToTask($row);
            }
            return $tasks;
        }

        public static function findAll(): array {
            $conn = Database::getConnection();
            $stmt = $conn->query("SELECT * FROM `tasks`");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($rows as $row) {
                $tasks[] = self::mapRowToTask($row);
            }
            return $tasks;
        }

        public static function addTask(Task $task): bool {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("
                INSERT INTO `tasks` 
                (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`, `is_completed`) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bindValue(1, $task->getUserID(), PDO::PARAM_INT);
            $stmt->bindValue(2, $task->getCategoryID(), PDO::PARAM_INT);
            $stmt->bindValue(3, $task->getPriorityID(), PDO::PARAM_INT);
            $stmt->bindValue(4, $task->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(5, $task->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(6, $task->getDueDate(), PDO::PARAM_STR);
            $stmt->bindValue(7, $task->isCompleted(), PDO::PARAM_BOOL);

            return $stmt->execute();
        }

        public static function updateTask(Task $task): bool {
            if (!self::findByID($task->getID())) {
                throw new Exception("Nie znaleziono zadania o podanym ID");
            }

            $conn = Database::getConnection();
            $stmt = $conn->prepare("
                UPDATE `tasks` 
                SET `user_id` = ?, `category_id` = ?, `priority_id` = ?, 
                    `title` = ?, `description` = ?, `due_date` = ?, `is_completed` = ?
                WHERE `id` = ?
            ");
            $stmt->bindValue(1, $task->getUserID(), PDO::PARAM_INT);
            $stmt->bindValue(2, $task->getCategoryID(), PDO::PARAM_INT);
            $stmt->bindValue(3, $task->getPriorityID(), PDO::PARAM_INT);
            $stmt->bindValue(4, $task->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(5, $task->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(6, $task->getDueDate(), PDO::PARAM_STR);
            $stmt->bindValue(7, $task->isCompleted(), PDO::PARAM_BOOL);
            $stmt->bindValue(8, $task->getID(), PDO::PARAM_INT);

            return $stmt->execute();
        }

        public static function deleteTask(int $id): bool {
            if (!self::findByID($id)) {
                throw new Exception("Nie znaleziono zadania o podanym ID");
            }

            $conn = Database::getConnection();
            $stmt = $conn->prepare("DELETE FROM `tasks` WHERE `id` = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public static function findCompletedByUserID(int $userID): array {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `user_id` = ? AND `is_completed` = TRUE");
            $stmt->bindParam(1, $userID, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($rows as $row) {
                $tasks[] = self::mapRowToTask($row);
            }
            return $tasks;
        }

        public static function findPendingByUserID(int $userID): array {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `user_id` = ? AND `is_completed` = FALSE");
            $stmt->bindParam(1, $userID, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($rows as $row) {
                $tasks[] = self::mapRowToTask($row);
            }
            return $tasks;
        }

        public static function findByCategory(int $categoryID): array {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `category_id` = ?");
            $stmt->bindParam(1, $categoryID, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($rows as $row) {
                $tasks[] = self::mapRowToTask($row);
            }
            return $tasks;
        }

        public static function findByPriority(int $priorityID): array {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `priority_id` = ?");
            $stmt->bindParam(1, $priorityID, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($rows as $row) {
                $tasks[] = self::mapRowToTask($row);
            }
            return $tasks;
        }

        private static function mapRowToTask(array $row): Task {
            $task = new Task(
                $row['title'],
                $row['description'],
                $row['due_date'],
                (bool)$row['is_completed'],
                (int)$row['id'],
                (int)$row['user_id'],
                $row['category_id'] !== null ? (int)$row['category_id'] : null,
                $row['priority_id'] !== null ? (int)$row['priority_id'] : null
            );

            // Podpięcie pełnych obiektów
            $user = UserRepository::findByID((int)$row['user_id']);
            $task->setUser($user);

            if ($row['category_id'] !== null) {
                $category = CategoriesRepository::findByID((int)$row['category_id']);
                $task->setCategory($category);
            }

            if ($row['priority_id'] !== null) {
                $priority = PriorityRepository::findByID((int)$row['priority_id']);
                $task->setPriority($priority);
            }

            return $task;
        }
    }
?>