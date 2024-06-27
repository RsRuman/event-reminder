<?php

use App\Mail\EventReminder;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

# Checking in every minute for ensuring not to miss sending mail
Schedule::call(function () {
    $thirtyMinutesLater =  Carbon::now()->addMinutes(30);

    $events = Event::query()->whereBetween('date', [
        $thirtyMinutesLater->startOfMinute()->toDateTimeString(),
        $thirtyMinutesLater->endOfMinute()->toDateTimeString(),
    ])->get();

    foreach ($events as $event) {
        if (!empty($event->recipients)) {
            foreach ($event->recipients as $recipient) {
                Mail::to($recipient)->send(new EventReminder($event));
            }
        }
    }
})->everyMinute();

