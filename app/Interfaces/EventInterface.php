<?php

namespace App\Interfaces;

interface EventInterface
{
    public function getEvents(int $perPage);

    public function addEvent(array $data);

    public function getEvent(int $id);

    public function updateEvent(int $id, array $data);

    public function deleteEvent(int $id);

}
