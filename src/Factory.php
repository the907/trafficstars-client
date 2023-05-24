<?php
declare(strict_types=1);


namespace AdCrafters\TrafficStars;

class Factory
{

    /**
     * The API key for the requests.
     */
    private ?string $apiKey = null;


    /**
     * Sets the API key for the requests.
     */
    public function withApiKey(string $apiKey): self
    {
        $this->apiKey = trim($apiKey);

        return $this;
    }

    public function make(): Client
    {
        return new Client();
    }

}
