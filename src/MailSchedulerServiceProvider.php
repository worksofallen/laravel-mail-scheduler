<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler;

use Illuminate\Console\Scheduling\Schedule;
use Worksofallen\MailScheduler\Console\Commands\SendEmails;
use Worksofallen\MailScheduler\Console\Commands\SentEmailRetentions;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MailSchedulerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-mail-scheduler')
            ->hasConfigFile()
            ->hasMigrations(['create_scheduled_emails_table', 'add_mailer_to_scheduled_emails_table'])
            ->hasCommands(SendEmails::class)
            ->runsMigrations();
    }

    public function boot()
    {
        parent::boot();

        if (config('mail-scheduler.auto_schedule') === true) {
            $schedule = app(Schedule::class);

            $schedule->command(SendEmails::class)
                ->cron(config('mail-scheduler.schedule_cron'))
                ->onOneServer()
                ->withoutOverlapping();
        }

        if (config('mail-scheduler.retention_days') > 0) {
            $schedule = app(Schedule::class);

            $schedule->command(SentEmailRetentions::class)
                ->cron(config('mail-scheduler.retention_cron'))
                ->onOneServer()
                ->withoutOverlapping();
        }
    }
}
