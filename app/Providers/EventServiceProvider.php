<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SubmissionSaved;
use App\Listeners\LogSubmissionSaved;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SubmissionSaved::class => [
            LogSubmissionSaved::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
