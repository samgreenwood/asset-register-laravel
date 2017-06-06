<?php

namespace App\Entities;

interface Assignable {
    
    public function uuid(): string;
    
    public function name(): string;

}