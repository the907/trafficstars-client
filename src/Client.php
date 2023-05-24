<?php
declare(strict_types=1);

namespace AdCrafters\TrafficStars;

use AdCrafters\TrafficStars\Enums\Transporter\EndPoint;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

final class Client
{
    private GuzzleClient $client;

    public function __construct(private string $refreshToken, private string $baseUri)
    {
        $this->refreshToken = $refreshToken;
        $this->client = new GuzzleClient([
            'base_uri' => $baseUri,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
    }

    public function getAccessToken(): ?string
    {
        $accessToken = $_SESSION['access_token'] ?? null;
        $expiresAt   = $_SESSION['expires_at'] ?? null;

        if ($accessToken && $expiresAt && time() < $expiresAt) {
            return $accessToken;
        }

        try {
            $response = $this->client->request('POST', EndPoint::AUTH_TOKEN, [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->refreshToken,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody();
                $result = json_decode($body, true);

                $accessToken = $result['access_token'] ?? null;
                $expiresIn = $result['expires_in'] ?? 36000;  // defaulting to 10 hours

                // Store the token in the session, along with its expiration time
                $_SESSION['access_token'] = $accessToken;
                $_SESSION['expires_at'] = time() + $expiresIn;

                return $accessToken;
            }
        } catch (GuzzleException $e) {
            // Log or handle exception
            return null;
        }

        return null;
    }

}
