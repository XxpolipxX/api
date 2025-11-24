<?php
    namespace App\Model;
    class Priority {
        private ?int $id;
        private string $name;

        public function __construct(?int $id = null, string $name) {
            $this->id = $id;
            $this->name = $name;
        }

        public function getID(): ?int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setID(int $id): void {
            $this->id = $id;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }

        public function toArray(): array {
            return [
                'id' => $this->id,
                'name' => $this->name
            ];
        }
    }
?>