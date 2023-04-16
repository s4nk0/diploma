<?php

namespace App\SMS;

use App\Interfaces\SMSService;

class SmsServiceManager
{
    private $smsService;

    public function __construct()
    {
        $service = env('SMS_SERVICE', 'mobizon');

        switch ($service) {
            case 'mobizon':
                $this->smsService = new Mobizon();
                break;
            default:
                $this->smsService = new Mobizon();
        }
    }

    public function sendSms(string $phones, string $message)
    {
        return $this->smsService->sendSms($phones, $message);
    }

    public function sendCode(string $phones, string $code)
    {
        return $this->smsService->sendCode($phones, $code);
    }

    public function generateCode(){
        return ;
    }
}
