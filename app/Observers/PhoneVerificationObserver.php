<?php

namespace App\Observers;

use App\Facades\SMS;
use App\Models\PhoneVerification;

class PhoneVerificationObserver
{
    /**
     * Handle the PhoneVerification "created" event.
     *
     * @param  \App\Models\PhoneVerification  $phoneVerification
     * @return void
     */
    public function creating(PhoneVerification $phoneVerification)
    {
        $phoneVerification->verification_code = rand(1000,9999);
    }

    /**
     * Handle the PhoneVerification "updated" event.
     *
     * @param  \App\Models\PhoneVerification  $phoneVerification
     * @return void
     */
    public function updated(PhoneVerification $phoneVerification)
    {
        //
    }

    /**
     * Handle the PhoneVerification "deleted" event.
     *
     * @param  \App\Models\PhoneVerification  $phoneVerification
     * @return void
     */
    public function deleted(PhoneVerification $phoneVerification)
    {
        //
    }

    /**
     * Handle the PhoneVerification "restored" event.
     *
     * @param  \App\Models\PhoneVerification  $phoneVerification
     * @return void
     */
    public function restored(PhoneVerification $phoneVerification)
    {
        //
    }

    /**
     * Handle the PhoneVerification "force deleted" event.
     *
     * @param  \App\Models\PhoneVerification  $phoneVerification
     * @return void
     */
    public function forceDeleted(PhoneVerification $phoneVerification)
    {
        //
    }
}
