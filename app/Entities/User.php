<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $nickname;

    /**
     * @var Member
     */
    private $member;

    /**
     * User constructor.
     * @param $firstname
     * @param $surname
     * @param $nickname
     * @param Member $member
     */
    public function __construct($firstname, $surname, $nickname, Member $member)
    {
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->nickname = $nickname;
        $this->member = $member;
    }

    /**
     * @param Member $member
     * @return static
     */
    public static function fromMember(Member $member): User
    {
        return new static(
            $member->firstname(),
            $member->surname(),
            $member->nickname(),
            $member
        );
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return sprintf('%s %s', $this->firstname, $this->surname);
    }

    /**
     * @return Member
     */
    public function member(): Member
    {
        return $this->member;
    }
}