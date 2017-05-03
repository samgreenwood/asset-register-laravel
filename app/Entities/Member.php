<?php

namespace App\Entities;

class Member {

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $nickname;

    /**
     * Member constructor.
     * @param $uuid
     * @param $firstname
     * @param $surname
     * @param $nickname
     */
    public function __construct($uuid, $firstname, $surname, $nickname)
    {
        $this->uuid = $uuid;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->nickname = $nickname;
    }

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
        return sprintf("%s %s (%s)", $this->firstname, $this->surname, $this->nickname);
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