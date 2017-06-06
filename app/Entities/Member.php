<?php

namespace App\Entities;

class Member implements Assignable {

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
    private $surname;

    /**
     * @var string
     */
    private $nickname;

    /**
     * Member constructor.
     * @param $uuid
     * @param $firstname
     * @param $surname
     * @param $nickname
     */
    public function __construct(string $uuid, string $firstname, string $surname, string $nickname)
    {
        $this->uuid = $uuid;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->nickname = $nickname;
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
    public function firstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function surname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function nickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return sprintf("%s %s (%s)", $this->firstname, $this->surname, $this->nickname);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name();
    }

}