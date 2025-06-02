<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Exceptions;

use Exception;

class RecipientException extends Exception
{
    public static function empty(): static
    {
        return new self('Recipients list is empty');
    }
}
