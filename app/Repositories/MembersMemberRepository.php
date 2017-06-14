<?php

namespace App\Repositories;

use App\Entities\Member;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Facades\Socialite;

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
        return cache()->remember('api.members', 60, function()
        {
            $response = $this->client->get('https://members.air-stream.org/api/members', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.session('oauth_token')
                ],
            ]);

            $members = $response->getBody()->getContents();

            return collect(json_decode($members))->map(function($member) {
                return new Member($member->id, $member->firstname, $member->surname, $member->nickname);
            });
        });
    }

    /**
     * @param $id
     * @return Member
     */
    public function findById($id)
    {
        return $this->all()->filter(function(Member $member) use($id){
            return $member->uuid() == $id;
        })->first();

    }

}