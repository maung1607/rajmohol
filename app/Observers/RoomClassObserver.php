<?php

namespace App\Observers;

use App\Models\RoomClass;

class RoomClassObserver
{
    /**
     * Handle the RoomClass "created" event.
     */
    public function created(RoomClass $roomClass): void
    {
        //
    }

    /**
     * Handle the RoomClass "updated" event.
     */
    public function updated(RoomClass $roomClass): void
    {
        //
    }

    /**
     * Handle the RoomClass "deleted" event.
     */
    public function deleted(RoomClass $roomClass): void
    {
        //
    }

    /**
     * Handle the RoomClass "restored" event.
     */
    public function restored(RoomClass $roomClass): void
    {
        //
    }

    /**
     * Handle the RoomClass "force deleted" event.
     */
    public function forceDeleted(RoomClass $roomClass): void
    {
        //
    }
}
