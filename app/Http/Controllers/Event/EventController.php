<?php

namespace App\Http\Controllers\Event;

use AllowDynamicProperties;
use App\EventEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Interfaces\EventInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties]
class EventController extends Controller
{
    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * List of events
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $events = $this->event->getEvents($request);

        return view('event.index', compact('events'));
    }

    /**
     * Create event form
     * @return View
     */
    public function create(): View
    {
        return view('event.create');
    }

    /**
     * Storing event
     * @param EventRequest $request
     * @return RedirectResponse
     */
    public function store(EventRequest $request): RedirectResponse
    {
        $data             = $request->only('title', 'description', 'date', 'recipients');
        $data['user_id']  = Auth::user()->id;
        $data['event_id'] = 'EVT-' . uniqid();
        $data['status']   = EventEnum::UPCOMING->value;

        $event = $this->event->addEvent($data);

        if (!$event) {
            return redirect()->back()->with('error', 'Failed to create event.')->setStatusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.')->setStatusCode(HttpResponse::HTTP_CREATED);
    }

    /**
     * Edit form
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $event = $this->event->getEvent($id);

        if (!$event) {
            exit(HttpResponse::HTTP_NOT_FOUND);
        }

        return view('event.edit', compact('event'));
    }

    /**
     * Update an event
     * @param $id
     * @param EventRequest $request
     * @return RedirectResponse
     */
    public function update($id, EventRequest $request): RedirectResponse
    {
        $data = $request->only('title', 'description', 'date', 'recipients');

        $eventU = $this->event->updateEvent($id, $data);

        if (!$eventU) {
            return redirect()->back()->with('error', 'Failed to update event.')->setStatusCode(HttpResponse::HTTP_NOT_FOUND);
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.')->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Destroy an event
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->event->deleteEvent($id);

        return response()->json(['message' => 'Event deleted successfully.']);
    }
}
