<?php

namespace App\Http\Livewire\Auth\Login;

use App\Enums\PhoneNumberEnum;
use App\Enums\PhoneVerificationsStatuses;
use App\Facades\SMS;
use App\Models\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $phone_number;

    protected function rules(){
        return [
            'phone_number' => ['required','regex:'.PhoneNumberEnum::REGEX->value],
        ];
    }

    public function sendCode(){
        $this->validate();

        //проверка на время
        $phoneVerifications = PhoneVerification::where('phone_number',$this->phone_number)->where('status',PhoneVerificationsStatuses::PENDING->value)->get();

        $phoneVerifications->each(function ($phoneVerification) {
            if ($phoneVerification->created_at->diffInMinutes(Carbon::now()) > 3000) {
                $phoneVerification->status = PhoneVerificationsStatuses::EXPIRED;
                $phoneVerification->save();
            }
        });

        $phoneVerificationsUpdated = PhoneVerification::where('phone_number',$this->phone_number)->where('status',PhoneVerificationsStatuses::PENDING->value)->get();

        Validator::make([
            'phone_number'=>$phoneVerificationsUpdated->count(),
        ],[
        'phone_number'=>['required', function ($attribute, $value, $fail) {
            if ($value) {
                $fail('Мы уже отправили код');
            }
        }]
        ])->validate();

        $phoneVerification = PhoneVerification::create(['phone_number' =>$this->phone_number]);

//        SMS::sendCode($phoneVerification->phone_number,$phoneVerification->verification_code);

        session()->flash('code_send', 'Код отправлен');
    }

    public function render()
    {
        return view('livewire.auth.login.modal');
    }
}
