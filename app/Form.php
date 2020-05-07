<?php

namespace App;

class Form
{
    private $title;
    private $price;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}