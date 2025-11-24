CREATE TABLE `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `priority` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE `categories` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE `tasks` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `category_id` INT,
    `priority_id` INT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `due_date` DATE,
    `is_completed` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`priority_id`) REFERENCES `priority`(`id`) ON DELETE SET NULL
);

CREATE TABLE `shared_tasks` (
    `task_id` INT NOT NULL,
    `shared_with` INT NOT NULL,
    `can_edit` BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (`task_id`, `shared_with`),
    FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`shared_with`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

INSERT INTO `priority` VALUES(NULL, 'wazne');
INSERT INTO `priority` VALUES(NULL, 'pilne');
INSERT INTO `priority` VALUES(NULL, 'nie wazne');

INSERT INTO `categories` VALUES (NULL, 'szkola');
INSERT INTO `categories` VALUES (NULL, 'praca');
INSERT INTO `categories` VALUES (NULL, 'dom');