<?php

namespace App\Entities;

class Product
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $manufacturer;

    public function __construct(string $uuid, string $name, string $manufacturer)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function fullName() : string
    {
        return sprintf('%s %s', $this->manufacturer, $this->name);
    }

    /**
     * @return string
     */
    public function manufacturer(): string
    {
        return $this->manufacturer;
    }
}