<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\Ad;

class AdObserver
{
    /**
     * Handle the Ad "created" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function creating(Ad $ad)
    {
        $ad->status_moderation_id = StatusEnum::STATUS_MODERATION_PROCESSING_ID->value;
    }

    /**
     * Handle the Ad "updated" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function updated(Ad $ad)
    {
        //
    }

    /**
     * Handle the Ad "deleted" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function deleted(Ad $ad)
    {
        //
    }

    /**
     * Handle the Ad "restored" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function restored(Ad $ad)
    {
        //
    }

    /**
     * Handle the Ad "force deleted" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function forceDeleted(Ad $ad)
    {
        //
    }
}
