<?php

namespace App\Repositories;

use App\Entities\Member;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\Guard;

class MembersMemberRepository implements MemberRepository {

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @var Client
     */
    private $client;

    /**
     * MembersMemberRepository constructor.
     * @param Guard $auth
     * @param Client $client
     */
    public function __construct(Guard $auth, Client $client)
    {
        $this->auth = $auth;
        $this->client = $client;
    }

    /**
     * @return Member[]
     */
    public function all()
    {
        return collect([
            new Member('212', 'Sam', 'Greenwood', 'dragoon')
        ]);
    }

    /**
     * @param $id
     * @return Member
     */
    public function findById($id)
    {
        return null;
    }

}