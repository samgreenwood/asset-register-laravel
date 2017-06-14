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

    /**
     * @return string
     */
    public function assignedBy(): string
    {
        return 'N/A';
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name();
    }
}