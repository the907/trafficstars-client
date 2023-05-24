<?php
declare(strict_types=1);


namespace AdCrafters\TrafficStars;

class Factory
{

    /**
     * The API key for the requests.
     */
    private ?string $apiKey = null;


    private ?string $baseUri = null;


    /**
     * Sets the API key for the requests.
     */
    public function withApiKey(string $apiKey): self
    {
        $this->apiKey = trim($apiKey);

        return $this;
    }

    /**
     * Sets the base URI for the requests.
     * If no URI is provided the factory will use the default Traffic Stars URI.
     */
    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    public function make(): Client
    {



        return new Client();
    }

}
