<?php

namespace App\Repositories;

use App\Interfaces\EventInterface;
use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EventRepository implements EventInterface
{
    /**
     * List of events
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getEvents(int $perPage): LengthAwarePaginator
    {
        return Event::query()
            ->paginate($perPage);
    }

    /**
     * Store event data
     * @param array $data
     * @return mixed
     */
    public function addEvent(array $data): mixed
    {
        return Event::create([
            'user_id'     => $data['user_id'],
            'event_id'    => $data['event_id'],
            'title'       => $data['title'],
            'description' => $data['description'],
            'date'        => $data['date'],
            'recipients'  => $data['recipients'],
            'status'      => $data['status']
        ]);
    }

    /**
     * Get an event
     * @param int $id
     * @return Model|null
     */
    public function getEvent(int $id): Model|null
    {
        return Event::query()->findOrFail($id);
    }

    /**
     * Update event
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateEvent(int $id, array $data): bool
    {
        $event = $this->getEvent($id);

        return $event->update([
            'title'       => $data['title'],
            'description' => $data['description'],
            'date'        => $data['date'],
            'recipients'  => $data['recipients'],
        ]);
    }

    /**
     * Delete an event
     * @param int $id
     * @return void
     */
    public function deleteEvent(int $id): void
    {
        $event = Event::query()->findOrFail($id);
        $event->delete();
    }
}
