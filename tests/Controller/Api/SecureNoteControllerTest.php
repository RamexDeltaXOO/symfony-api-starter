<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SecureNoteControllerTest extends WebTestCase
{
    public function testSecureNotesEndpoint(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/secure-notes');

        self::assertResponseStatusCodeSame(401);
    }
}