<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Worksofallen\MailScheduler\Enums\EmailStatus;
use Worksofallen\MailScheduler\Exceptions\InvalidRecipients;
use Worksofallen\MailScheduler\Exceptions\RecipientException;
use Worksofallen\MailScheduler\Models\ScheduledEmail;
use Throwable;

class SentEmailRetentions extends Command
{
    protected $signature = 'mail-scheduler:sent-email-retentions';

    protected $description = 'Removes sent emails older than the configured retention period';

    public function handle(): int
    {
        ScheduledEmail::query()
            ->where('status', EmailStatus::SENT)
            ->where('attempted_at', '<', now()->subDays(config('mail-scheduler.retention_days')))
            ->chunk(config('mail-scheduler.delete_chunk_size'), function ($emails) {
                foreach ($emails as $email) {
                    $email->delete();
                }
            });

        return 0;
    }
}
