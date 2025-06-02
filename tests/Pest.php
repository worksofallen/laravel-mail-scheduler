<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Mail\Mailable;
use Worksofallen\MailScheduler\Tests\Support\TestEncryptedMailable;
use Worksofallen\MailScheduler\Tests\Support\TestMailable;
use Worksofallen\MailScheduler\Tests\TestCase;
use function Pest\Faker\fake;

uses(TestCase::class)->in(__DIR__);
uses(LazilyRefreshDatabase::class)->in(__DIR__);

function mailable(): Mailable
{
    return new TestMailable();
}

function encryptedMailable(): Mailable
{
    return new TestEncryptedMailable();
}

function recipients(): array
{
    return [
        ...collect(range(1, 10))->map(fn() => fake()->email),
    ];
}
