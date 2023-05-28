<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\AdGet;

class AdGetObserver
{
    /**
     * Handle the AdGet "created" event.
     *
     * @param  \App\Models\AdGet  $adGet
     * @return void
     */
    public function creating(AdGet $adGet)
    {
        $adGet->status_moderation_id = StatusEnum::STATUS_MODERATION_PROCESSING_ID->value;
    }

    /**
     * Handle the AdGet "updated" event.
     *
     * @param  \App\Models\AdGet  $adGet
     * @return void
     */
    public function updated(AdGet $adGet)
    {
        //
    }

    /**
     * Handle the AdGet "deleted" event.
     *
     * @param  \App\Models\AdGet  $adGet
     * @return void
     */
    public function deleted(AdGet $adGet)
    {
        //
    }

    /**
     * Handle the AdGet "restored" event.
     *
     * @param  \App\Models\AdGet  $adGet
     * @return void
     */
    public function restored(AdGet $adGet)
    {
        //
    }

    /**
     * Handle the AdGet "force deleted" event.
     *
     * @param  \App\Models\AdGet  $adGet
     * @return void
     */
    public function forceDeleted(AdGet $adGet)
    {
        //
    }
}
