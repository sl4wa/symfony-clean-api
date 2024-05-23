<?php
namespace App\Domain\Service;

use App\Domain\DTO\CountryDto;

interface CountryServiceInterface
{
    public function retrieve(int $id): ?CountryDto;
    public function getAll(): array;
    public function createOrUpdate(CountryDto $country): int;
    public function updateDescription(int $id, string $description): bool;
    public function delete(int $id): bool;
}
