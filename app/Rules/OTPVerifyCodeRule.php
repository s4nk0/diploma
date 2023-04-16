<?php

namespace App\Rules;

use App\Enums\PhoneVerificationsStatuses;
use App\Models\PhoneVerification;
use Illuminate\Contracts\Validation\Rule;

class OTPVerifyCodeRule implements Rule
{

    public $phone;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($phone = null)
    {
        $this->phone = $phone;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (!$this->phone){
            return false;
        }

        $phoneVerification = PhoneVerification::where('phone_number',$this->phone)->where('verification_code',$value)->where('status',PhoneVerificationsStatuses::PENDING)->first();


        if (!$phoneVerification){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вы не отправили запрос';
    }
}
