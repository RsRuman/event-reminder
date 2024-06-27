<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface EventInterface
{
    public function getEvents(Request $request);

    public function addEvent(array $data);

    public function getEvent(int $id);

    public function updateEvent(int $id, array $data);

    public function deleteEvent(int $id);

}
