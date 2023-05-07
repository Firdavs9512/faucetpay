<?php

namespace Firdavs\Faucetpay;

class Faucetpay {

    protected $username = config('app.faucet_username');

    public function getBalance()
    {
        return $this->username;
    }


}

