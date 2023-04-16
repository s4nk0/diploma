<?php

namespace App\SMS;

use App\Interfaces\SMSService;
use App\Traits\SMSPatterns;
use GuzzleHttp\Client;
use Mobizon\MobizonApi;

class Mobizon implements SMSService {

    use SMSPatterns;

    protected $client;

    public function __construct()
    {
        $this->client = new MobizonApi(env('MOBIZON_API_KEY'), 'api.mobizon.kz');
    }

    public function sendSms(string $phones, string $message)
    {
        try {
            $this->client->call('message', 'sendSMSMessage', [
                'recipient' => $phones,
                'text' => $this->messagePattern($message),
            ]);

            return 'SMS sent successfully.';
        } catch (\Exception $e) {
            // Handle the exception
            return 'Error sending SMS: ' . $e->getMessage();
        }
    }

    public function sendCode(string $phones, string $code){
        try {
            $this->client->call('message', 'sendSMSMessage', [
                'recipient' => $phones,
                'text' => $this->sendCodePattern($code),
            ]);

            return 'SMS sent successfully.';
        } catch (\Exception $e) {
            // Handle the exception
            return 'Error sending SMS: ' . $e->getMessage();
        }
    }


}
