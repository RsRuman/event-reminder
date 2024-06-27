<?php

namespace App\Repositories;

use App\Interfaces\HomeInterface;
use App\Models\Event;

class HomeRepository implements HomeInterface
{
    /**
     * Get total no. of completed event
     * @return int
     */
    public function getCompletedEvent(): int
    {
        return Event::query()->where('date', '<', now())->count();
    }

    /**\
     * Get total no. of upcoming event
     * @return int
     */
    public function getUpcomingEvent(): int
    {
        return Event::query()->where('date', '>', now())->count();
    }
}
