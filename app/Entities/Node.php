<?php

namespace App\Entities;

use Illuminate\Support\Collection;

class Node implements Assignable {

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $assets;

    /**
     * Node constructor.
     * @param string $uuid
     * @param string $name
     * @param Collection $assets
     */
    public function __construct(string $uuid, string $name, Collection $assets = null)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->assets = $assets ?? collect([]);
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
     * @param $assets
     */
    public function setAssets(Collection $assets)
    {
        $this->assets = $assets;
    }

    /**
     * @return Collection
     */
    public function assets(): Collection
    {
        return $this->assets;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name();
    }
}