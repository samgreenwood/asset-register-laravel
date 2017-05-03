<?php

namespace App\Entities;

class Node {

    /**
     * Node constructor.
     * @param $uuid
     * @param $name
     */
    public function __construct($uuid, $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function uuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function __get($param)
    {
        if(method_exists($this, $param)) return $this->{$param}();

        return $this->{$param};
    }

}