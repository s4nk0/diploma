<?php

namespace App\Interfaces;

interface SMSService
{
    public function sendSms(string $phones, string $message);
    public function sendCode(string $phones, string $code);
}
