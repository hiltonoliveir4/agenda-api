<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EventService
{

    public function __construct(
        private readonly FileUploadService $fileUploadService
    ) {}

    public function getAllEvents(User $user): Paginator
    {
        return $user->events()->latest()->paginate(10);
    }

    public function getEventById(User $user, int $eventId): ?Event
    {
        return $user->events()->findOrFail($eventId);
    }

    public function createEvent(User $user, array $data): Event
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->fileUploadService->uploadEventImage($data['image']);
        }

        return $user->events()->create($data);
    }

    public function updateEvent(User $user, int $eventId, array $data): Event
    {
        $event = $user->events()->findOrFail($eventId);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            if ($event->image) {
                Storage::delete($event->image);
            }
            $data['image'] = $this->fileUploadService->uploadEventImage($data['image']);
        }

        $event->update($data);
        return $event;
    }

    public function deleteEvent(User $user, int $eventId): void
    {
        $user->events()->findOrFail($eventId)->delete();
    }
}
