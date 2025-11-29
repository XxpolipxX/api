SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_polish_ci';

CREATE TABLE `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;

CREATE TABLE `priority` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;

CREATE TABLE `categories` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;

CREATE TABLE `tasks` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `category_id` INT,
    `priority_id` INT,
    `title` TEXT NOT NULL,
    `description` TEXT,
    `due_date` DATE,
    `is_completed` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`priority_id`) REFERENCES `priority`(`id`) ON DELETE SET NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;

CREATE TABLE `shared_tasks` (
    `task_id` INT NOT NULL,
    `shared_with` INT NOT NULL,
    `can_edit` BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (`task_id`, `shared_with`),
    FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`shared_with`) REFERENCES `users`(`id`) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;

INSERT INTO `priority` VALUES(NULL, 'wazne');
INSERT INTO `priority` VALUES(NULL, 'pilne');
INSERT INTO `priority` VALUES(NULL, 'nie wazne');

INSERT INTO `categories` VALUES (NULL, 'szkola');
INSERT INTO `categories` VALUES (NULL, 'praca');
INSERT INTO `categories` VALUES (NULL, 'dom');



-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 2", "Opis zadania 2", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 3", "Opis zadania 3", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 4", "Opis zadania 4", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 5", "Opis zadania 5", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 6", "Opis zadania 6", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 7", "Opis zadania 7", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 8", "Opis zadania 8", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 9", "Opis zadania 9", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 10", "Opis zadania 10", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 11", "Opis zadania 11", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 12", "Opis zadania 12", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 13", "Opis zadania 13", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 14", "Opis zadania 14", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 15", "Opis zadania 15", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 16", "Opis zadania 16", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 17", "Opis zadania 17", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 18", "Opis zadania 18", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 19", "Opis zadania 19", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 20", "Opis zadania 20", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 21", "Opis zadania 21", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 22", "Opis zadania 22", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 23", "Opis zadania 23", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 24", "Opis zadania 24", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 25", "Opis zadania 25", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 26", "Opis zadania 26", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 27", "Opis zadania 27", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 28", "Opis zadania 28", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 29", "Opis zadania 29", "2025-12-17");
-- INSERT INTO `tasks` (`user_id`, `category_id`, `priority_id`, `title`, `description`, `due_date`) VALUES (1, 1, 1, "Tytuł zadania 30", "Opis zadania 30", "2025-12-17");