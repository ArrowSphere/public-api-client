<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Credentials;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class CredentialsTest
 */
class CredentialsTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Credentials::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'username' => 'admin@example.com',
                    'passwordResetUrl' => 'https://example.com/reset-password',
                    'url' => 'https://example.com/login',
                ],
                'expected' => <<<JSON
{
    "username": "admin@example.com",
    "passwordResetUrl": "https:\/\/example.com\/reset-password",
    "url": "https:\/\/example.com\/login"
}
JSON
            ],
            'with_null_values' => [
                'fields' => [
                    'username' => 'user@test.com',
                    'passwordResetUrl' => null,
                    'url' => null,
                ],
                'expected' => <<<JSON
{
    "username": "user@test.com",
    "passwordResetUrl": null,
    "url": null
}
JSON
            ],
            'all_null_values' => [
                'fields' => [
                    'username' => null,
                    'passwordResetUrl' => null,
                    'url' => null,
                ],
                'expected' => <<<JSON
{
    "username": null,
    "passwordResetUrl": null,
    "url": null
}
JSON
            ],
        ];
    }
}
