<?php
declare(strict_types=1);

namespace AdCrafters\TrafficStars;

use AdCrafters\TrafficStars\Client;
use AdCrafters\TrafficStars\Factory;


final class Api
{

    /**
     * Creates a new Open AI Client with the given API token.
     */
    public static function client(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->make();
    }

    /**
     * Creates a new factory instance to configure a custom Open AI Client
     */
    public static function factory(): Factory
    {
        return new Factory();
    }
}
