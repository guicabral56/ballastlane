<?php

namespace Core\Domain;

use InvalidArgumentException;

class Product
{
    private string $name;
    private int $price;
    private int $userId;

    public function __construct(string $name, int $price, int $userId)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setUserId($userId);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    private function setName(string $name): void
    {
        if (empty($name) || strlen($name) < 3) {
            throw new InvalidArgumentException('Name is required and must be at least 3 characters long.');
        }
        $this->name = $name;
    }

    private function setPrice(int $price): void
    {        
        $this->price = $price;
    }

    private function setUserId(int $userId): void
    {       
        $this->userId = $userId;
    }
}