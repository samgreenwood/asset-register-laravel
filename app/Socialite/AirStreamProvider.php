<?php

namespace App\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class AirStreamProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @var array
     */
    protected $scopes = [''];

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://members.air-stream.org/oauth/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
       return 'https://members.air-stream.org/oauth/token';
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return array_merge(['grant_type' => 'authorization_code'], parent::getTokenFields($code));
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        $userUrl = 'https://members.air-stream.org/api/user';

        $response = $this->getHttpClient()->get(
            $userUrl, $this->getRequestOptions($token)
        );

        return json_decode($response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array $user
     * @return \Laravel\Socialite\Two\User
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['uuid'],
            'nickname' => $user['username'],
            'name' => $user['firstname'] . ' ' . $user['surname'],
            'email' => $user['username'] . '@air-stream.org'
        ]);
    }

    /**
     * @return array
     */
    protected function getRequestOptions($token = null)
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ];
    }
}