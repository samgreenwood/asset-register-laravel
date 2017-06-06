<?php

namespace App\Entities;

class NullLocation implements Assignable
{
    /**
     * @return string
     */
    public function uuid(): string
    {
        return 'N/A';
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return 'N/A';
    }
    
    public function assignedBy(): string
    {
        return 'N/A';
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name();
    }
}