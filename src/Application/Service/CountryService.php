<?php

namespace App\Application\Service;

use App\Domain\DTO\CountryDto;
use App\Domain\Service\CountryServiceInterface;
use Symfony\Component\HttpFoundation\File\File;

class CountryService implements CountryServiceInterface
{
    private array $countries;

    public function __construct()
    {
        $this->countries = [
            new CountryDto(1, 'Canada', 'Maple Leaf country', 'https://anthonygiretti.blob.core.windows.net/countryflags/ca.png'),
            new CountryDto(2, 'USA', 'Federal republic of 50 states', 'https://anthonygiretti.blob.core.windows.net/countryflags/us.png')
        ];
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function getAll(): array
    {
        return $this->countries;
    }

    public function retrieve(int $id): ?CountryDto
    {
        foreach ($this->countries as $country) {
            if ($country->getId() === $id) {
                return $country;
            }
        }
        return null;
    }

    public function createOrUpdate(CountryDto $country): int
    {
        if ($country->getId() === null) {
            return 1;
        }

        foreach ($this->countries as $existingCountry) {
            if ($existingCountry->getId() === $country->getId()) {
                return $existingCountry->getId();
            }
        }

        return 1;
    }

    public function updateDescription(int $id, string $description): bool
    {
        foreach ($this->countries as $country) {
            if ($country->getId() === $id) {
                $country->setDescription($description);
                return true;
            }
        }
        return false;
    }
}
