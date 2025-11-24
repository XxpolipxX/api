<?php
    namespace App\Controller;

    use App\Model\Task;
    use App\Repository\TaskRepository;
    use App\Utils\Validator;
    use Exception;

    class TaskController {
        public static function createTask(array $data, int $userID): array {
            $allowedKeys = ['title', 'description', 'due_date', 'category_id', 'priority_id', 'is_completed'];
            $extraKeys = array_diff(array_keys($data), $allowedKeys);

            if(!empty($extraKeys)) {
                http_response_code(400);
                return ['success' => false , 'error' => 'Niedozwolone pola'];
            }

            try {
                $title = trim($data['title'] ?? '');
                if(!Validator::validateTitle($title)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędny tytuł'];
                }

                $description = trim($data['description'] ?? '');
                if(!Validator::validateDescription($description)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędny opis'];
                }

                $dueDate = trim($data['due_date'] ?? '');
                if(!Validator::validateDate($dueDate)) {
                    http_response_code(400);
                    return ['success' => false, 'error' => 'Błędna data'];
                }

                $categoryID = $data['category_id'] ?? null;
                $priorityID = $data['priority_id'] ?? null;
                $isCompleted = isset($data['is_completed']) ? (bool)$data['is_completed'] : false;

                $task = new Task($title, $description, $dueDate, $isCompleted, null, $userID, $categoryID, $priorityID);
                $success = TaskRepository::addTask($task);

                if(!$success) {
                    http_response_code(500);
                    return ['success' => false, 'error' => 'Nie udało się dodać zadania do bazy danych'];
                }

                http_response_code(201);
                return ['success' => true, 'message' => 'Zadanie utworzone', 'task' => $task->toArray()];
            } catch(Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public static function updateTask(int $taskID, array $data): array {
            $allowedKeys = ['title', 'description', 'due_date', 'category_id', 'priority_id', 'is_completed'];
            $extraKeys = array_diff(array_keys($data), $allowedKeys);

            if (!empty($extraKeys)) {
                http_response_code(400);
                return ['success' => false, 'error' => 'Niedozwolone pola'];
            }

            try {
                $task = TaskRepository::findByID($taskID);
                if (!$task) {
                    http_response_code(404);
                    return ['success' => false, 'error' => 'Nie znaleziono zadania'];
                }

                if (isset($data['title']) && Validator::validateTitle($data['title'])) {
                    $task->setTitle($data['title']);
                }
                if (isset($data['description'])) {
                    $task->setDescription($data['description']);
                }
                if (isset($data['due_date']) && Validator::validateDate($data['due_date'])) {
                    $task->setDueDate($data['due_date']);
                }
                if (isset($data['category_id'])) {
                    $task->setCategoryID((int)$data['category_id']);
                }
                if (isset($data['priority_id'])) {
                    $task->setPriorityID((int)$data['priority_id']);
                }
                if (isset($data['is_completed'])) {
                    $task->setIsCompleted((bool)$data['is_completed']);
                }

                $success = TaskRepository::updateTask($task);
                if (!$success) {
                    http_response_code(500);
                    return ['success' => false, 'error' => 'Nie udało się zaktualizować zadania'];
                }

                http_response_code(200);
                return ['success' => true, 'message' => 'Zadanie zaktualizowane', 'task' => $task->toArray()];
            } catch (Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public static function deleteTask(int $taskID): array {
            try {
                $task = TaskRepository::findByID($taskID);
                if (!$task) {
                    http_response_code(404);
                    return ['success' => false, 'error' => 'Nie znaleziono zadania'];
                }

                $success = TaskRepository::deleteTask($taskID);
                if (!$success) {
                    http_response_code(500);
                    return ['success' => false, 'error' => 'Nie udało się usunąć zadania'];
                }

                http_response_code(200);
                return ['success' => true, 'message' => 'Zadanie usunięte'];
            } catch (Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public static function getTasksByUser(int $userID): array {
            try {
                $tasks = TaskRepository::findByUserID($userID);
                http_response_code(200);
                return ['success' => true, 'tasks' => array_map(fn($t) => $t->toArray(), $tasks)];
            } catch (Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public static function getTaskByID(int $taskID): array {
            try {
                $task = TaskRepository::findByID($taskID);
                if(!$task) {
                    http_response_code(404);
                    return ['success' => false, 'error' => 'Nie znaleziono zadania'];
                }

                http_response_code(200);
                return ['success' => true, 'task' => $task->toArray()];
            }catch(Exception $e) {
                http_response_code(500);
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
    }
?>