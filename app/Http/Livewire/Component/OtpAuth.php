<?php

namespace App\Http\Livewire\Component;

use App\Enums\PhoneNumberEnum;
use App\Enums\PhoneVerificationsStatuses;
use App\Facades\SMS;
use App\Models\PhoneVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class OtpAuth extends Component
{
    public $phone_number;
    public $phone_number_back;
    public $verify_code;
    public $code_send = false;

    protected function rules(){
        return [
            'phone_number' => ['required','regex:'.PhoneNumberEnum::REGEX->value],
        ];
    }


    public function updatedPhoneNumber(){
        $this->phone_number_back = trim($this->phone_number,'+');
    }

    public function sendCode(){
        $this->validate();
        //проверка на время
        $phoneVerifications = PhoneVerification::where('phone_number',$this->phone_number_back)->where('status',PhoneVerificationsStatuses::PENDING->value)->get();

        $phoneVerifications->each(function ($phoneVerification) {
            if ($phoneVerification->created_at->diffInMinutes(Carbon::now()) > 3000) {
                $phoneVerification->status = PhoneVerificationsStatuses::EXPIRED;
                $phoneVerification->save();
            }
        });

        $phoneVerificationsUpdated = PhoneVerification::where('phone_number',$this->phone_number_back)->where('status',PhoneVerificationsStatuses::PENDING->value)->get();

        Validator::make([
            'phone_number'=>$phoneVerificationsUpdated->count(),
        ],[
            'phone_number'=>['required', function ($attribute, $value, $fail) {
                if ($value) {
                    $fail('Мы уже отправили код');
                }
            }]
        ])->validate();

        $phoneVerification = PhoneVerification::create(['phone_number' =>$this->phone_number_back]);

        SMS::sendCode($phoneVerification->phone_number,$phoneVerification->verification_code);
        $this->code_send = true;
        session()->flash('code_send', 'Код отправлен');
    }

    public function updatedVerifyCode(){
        $this->verify_code();
    }

    public function verify_code(){
        if (strlen($this->verify_code) == 4){
            Validator::make(['verify_code' => $this->verify_code],[
                'verify_code' =>'required|numeric|digits:4',
            ])->validate();

            $user = User::where('phone_number',$this->phone_number_back)->first();
            PhoneVerification::where('phone_number',$this->phone_number_back)->update(['status'=>PhoneVerificationsStatuses::VERIFIED]);
            if (!$user){
                //если это новый юзер
                $user =  User::create([
                    'phone_number' => $this->phone_number_back,
                ]);

                $user->roles()->attach(2);
            }

            Auth::login($user,true);
            return redirect()->intended();
        }
    }

    public function render()
    {
        return view('livewire.component.otp-auth');
    }
}
