<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(private readonly EventService $eventService) {}

    public function index(Request $request): JsonResponse
    {
        $events = $this->eventService->getAllEvents($request->user());
        return response()->json($events);
    }

    public function store(StoreEventRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['image'] = $request->file('image');

        $event = $this->eventService->createEvent($request->user(), $validated);
        return response()->json($event, 201);
    }

    public function show(Event $event): JsonResponse
    {
        return response()->json($event);
    }

    public function update(UpdateEventRequest $request, Event $event): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image');
        }

        $updatedEvent = $this->eventService->updateEvent($request->user(), $event->id, $validated);
        return response()->json($updatedEvent);
    }

    public function destroy(Event $event): JsonResponse
    {
        $this->eventService->deleteEvent(Auth::user(), $event->id);
        return response()->json(null, 204);
    }
}
