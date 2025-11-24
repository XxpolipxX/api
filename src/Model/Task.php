<?php
    namespace App\Model;

    use App\Model\User;
    use App\Model\Categories;
    use App\Model\Priority;

    class Task {
        private ?int $id;
        private ?int $userID;
        private ?User $user = null;
        private ?int $categoryID;
        private ?Categories $category = null;
        private ?int $priorityID;
        private ?Priority $priority = null;
        private string $title;
        private string $description;
        private string $dueDate;
        private bool $isCompleted = false;

        public function __construct(
            string $title,
            string $description,
            string $dueDate,
            bool $isCompleted,
            ?int $id = null,
            ?int $userID = null,
            ?User $user = null,
            ?int $categoryID = null,
            ?Categories $category = null,
            ?int $priorityID = null,
            ?Priority $priority = null
        ) {
            $this->id = $id;
            $this->userID = $userID;
            $this->user = $user;
            $this->categoryID = $categoryID;
            $this->category = $category;
            $this->priorityID = $priorityID;
            $this->priority = $priority;
            $this->title = $title;
            $this->description = $description;
            $this->dueDate = $dueDate;
            $this->isCompleted = $isCompleted;
        }

        // --- GETTERY ---
        public function getID(): ?int { return $this->id; }
        public function getUserID(): ?int { return $this->userID; }
        public function getUser(): ?User { return $this->user; }
        public function getCategoryID(): ?int { return $this->categoryID; }
        public function getCategory(): ?Categories { return $this->category; }
        public function getPriorityID(): ?int { return $this->priorityID; }
        public function getPriority(): ?Priority { return $this->priority; }
        public function getTitle(): string { return $this->title; }
        public function getDescription(): string { return $this->description; }
        public function getDueDate(): string { return $this->dueDate; }
        public function isCompleted(): bool { return $this->isCompleted; }

        // --- SETTERY ---
        public function setID(?int $id): void { $this->id = $id; }
        public function setUserID(?int $userID): void { $this->userID = $userID; }
        public function setUser(?User $user): void { $this->user = $user; }
        public function setCategoryID(?int $categoryID): void { $this->categoryID = $categoryID; }
        public function setCategory(?Categories $category): void { $this->category = $category; }
        public function setPriorityID(?int $priorityID): void { $this->priorityID = $priorityID; }
        public function setPriority(?Priority $priority): void { $this->priority = $priority; }
        public function setTitle(string $title): void { $this->title = $title; }
        public function setDescription(string $description): void { $this->description = $description; }
        public function setDueDate(string $dueDate): void { $this->dueDate = $dueDate; }
        public function setIsCompleted(bool $isCompleted): void { $this->isCompleted = $isCompleted; }

        public function toArray(): array {
            return [
                'id'          => $this->id,
                'user_id'     => $this->userID,
                'user'        => $this->user ? $this->user->toArray() : null,
                'category_id' => $this->categoryID,
                'category'    => $this->category ? $this->category->toArray() : null,
                'priority_id' => $this->priorityID,
                'priority'    => $this->priority ? $this->priority->toArray() : null,
                'title'       => $this->title,
                'description' => $this->description,
                'due_date'    => $this->dueDate,
                'is_completed'=> $this->isCompleted
            ];
        }
    }
?>