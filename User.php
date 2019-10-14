<?php
class User {
    /** @var int $id */
    private $id;
    /** @var string $name */
    private $name;
    /** @var int $age */
    public $age;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function toJSON(): string {
        return json_encode(get_object_vars($this));
    }
}
?>