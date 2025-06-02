<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Exceptions;

use Exception;

class MailableException extends Exception
{
    public static function undefined(): static
    {
        return new self('Mailable is required to save the ScheduledEmail instance');
    }

    public static function notAMailable(string $class): static
    {
        return new self("[{$class}] is not a Mailable instance");
    }
}
