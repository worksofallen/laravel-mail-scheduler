<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Enums;

enum EmailStatus: string
{
    case PENDING = 'pending';
    case SENT = 'sent';
    case ERROR = 'error';
}
