<?php

declare(strict_types=1);

namespace AdCrafters\TrafficStars\Enums\Transporter;

enum EndPoint: string
{
    //Authorization
    case AUTH_TOKEN = '/v1/auth/token';
    case AUTH_LOGOUT = '/v1/auth/logout';
    case AUTH_SESSION_INFO = '/v1/auth/info';

}
