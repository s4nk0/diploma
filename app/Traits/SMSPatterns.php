<?php

namespace App\Traits;

trait SMSPatterns{

    public function messagePattern($message){
        return 'roommate.kz - '.$message;
    }

    public function sendCodePattern($code){
        return $this->messagePattern('Ваш код подтверждения: '.$code);
    }
}
