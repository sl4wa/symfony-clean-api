<?php

namespace App\Tests\Application\Service;

use App\Domain\DTO\CountryDto;
use App\Domain\Service\CountryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CountryServiceTest extends KernelTestCase
{
    private CountryServiceInterface $countryService;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->countryService = $container->get(CountryServiceInterface::class);
    }

    public function testGetAll(): void
    {
        $countries = $this->countryService->getAll();
        $this->assertCount(2, $countries);
        $this->assertEquals('Canada', $countries[0]->getName());
        $this->assertEquals('USA', $countries[1]->getName());
    }

    public function testRetrieve(): void
    {
        $country = $this->countryService->retrieve(1);
        $this->assertInstanceOf(CountryDto::class, $country);
        $this->assertEquals('Canada', $country->getName());

        $country = $this->countryService->retrieve(99);
        $this->assertNull($country);
    }

    public function testCreateOrUpdate(): void
    {
        $newCountry = new CountryDto(null, 'Mexico', 'Country in North America', 'https://example.com/mx.png');
        $id = $this->countryService->createOrUpdate($newCountry);
        $this->assertEquals(1, $id);

        $existingCountry = new CountryDto(1, 'Canada', 'Updated description', 'https://example.com/ca.png');
        $id = $this->countryService->createOrUpdate($existingCountry);
        $this->assertEquals(1, $id);
    }

    public function testUpdateDescription(): void
    {
        $result = $this->countryService->updateDescription(1, 'New description for Canada');
        $this->assertTrue($result);

        $country = $this->countryService->retrieve(1);
        $this->assertEquals('New description for Canada', $country->getDescription());
    }

    public function testDelete(): void
    {
        $result = $this->countryService->delete(1);
        $this->assertTrue($result);
    }
}
