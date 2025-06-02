<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Worksofallen\MailScheduler\Support\Factory;

/**
 * @method static \Worksofallen\MailScheduler\Support\PendingScheduledEmail mailable($mailable)
 * @method static \Worksofallen\MailScheduler\Support\PendingScheduledEmail to($recipients)
 * @method static \Worksofallen\MailScheduler\Support\PendingScheduledEmail encrypted($encrypted = true)
 * @method static \Worksofallen\MailScheduler\Support\PendingScheduledEmail sendAt($send_at)
 * @method static \Worksofallen\MailScheduler\Support\PendingScheduledEmail source($model)
 * @method static \Worksofallen\MailScheduler\Support\PendingScheduledEmail make(\Illuminate\Mail\Mailable $mailable, array $recipients, ?\Carbon\Carbon $send_at = null, ?\Illuminate\Database\Eloquent\Model $source = null, ?bool $encrypted = false)
 * @method static void createMany(\Illuminate\Support\Enumerable $emails)
 */
class ScheduledEmail extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Factory::class;
    }
}
