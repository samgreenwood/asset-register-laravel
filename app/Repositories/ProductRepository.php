<?php

namespace App\Repositories;

interface ProductRepository
{
    public function all();

    public function findById($id);

    public function findByManufacturer($manufacturer);
}