<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Mail\Mailable;
use Worksofallen\MailScheduler\Exceptions\MailableException;
use Worksofallen\MailScheduler\Exceptions\NotAMailable;

class SerializedMailable implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param \Worksofallen\MailScheduler\Models\ScheduledEmail $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return ?\Illuminate\Contracts\Mail\Mailable
     *
     * @throws \Worksofallen\MailScheduler\Exceptions\MailableException
     */
    public function get($model, string $key, $value, array $attributes): ?Mailable
    {
        if (blank($value)) {
            return null;
        }

        $value = $model->encrypted ? unserialize(decrypt($value)) : unserialize($value);

        if (!$value instanceof Mailable) {
            throw MailableException::notAMailable($value::class);
        }

        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Worksofallen\MailScheduler\Models\ScheduledEmail $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return ?string
     *
     * @throws \Worksofallen\MailScheduler\Exceptions\MailableException
     */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        if (!$value instanceof Mailable) {
            throw MailableException::notAMailable($value::class);
        }

        return tap(serialize($value), function (&$serialized) use ($attributes, $model, $value) {
            if (data_get($attributes, 'encrypted', false)) {
                $serialized = encrypt($serialized);
            }
        });
    }
}
