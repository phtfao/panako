<?php

namespace Phtfao\Panako\Core\Authorization;

use GuzzleHttp\Client as HttpClient;

class AuthorizationService
{
    const AUTHORIZATION_SERVICE_URI = 'https://run.mocky.io/v3/';
    const AUTHORIZATION_TOKEN = '8fafdd68-a090-496f-8c9a-3442cf30dae6';
    const AUTHORIZED = 'Autorizado';

    public static function isAuthorized(): bool
    {
        $client = new HttpClient(['base_uri' => self::AUTHORIZATION_SERVICE_URI]);
        $response = $client->get(self::AUTHORIZATION_TOKEN);
        $body = json_decode($response->getBody()->getContents());
        return $body->message == self::AUTHORIZED;
    }
}
