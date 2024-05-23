<?php
namespace App\Domain\DTO;

class CountryDto
{
    private ?int $id;
    private string $name;
    private string $description;
    private string $flagUri;

    public function __construct(?int $id, string $name, string $description, string $flagUri)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->flagUri = $flagUri;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getFlagUri(): string
    {
        return $this->flagUri;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
