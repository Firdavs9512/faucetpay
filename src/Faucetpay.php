<?php

namespace Firdavs\Faucetpay;

use Illuminate\Support\Facades\Http;

class Faucetpay
{

    protected $api_key;

    public $cripto = 'BTC';

    protected $url;

    public function __construct()
    {
        $this->api_key = config('faucetpay.faucet_api_key', 'testtetstetstetstesttets123465');
        $this->cripto = config('faucetpay.crypto', 'BTC');
        $this->url = config('faucetpay.faucetpay_url', 'https://faucetpay.io/api/v1/');
    }

    /**
     * Get balance for faucetpay
     *
     * Response Example:
     * {
     *   "status": 200,
     *   "message": "OK",
     *   "currency": "BTC",
     *   "balance": "100000000",
     *   "balance_bitcoin": "1"
     * }
     *
     * @param string|null
     * @return array
     */
    public function getBalance($cripto = ''): array
    {
        $response = Http::asForm()->post($this->url . 'balance', [
            'api_key' => $this->api_key,
            'currency' => $cripto ? $cripto : $this->cripto,
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return [
                'status' => false,
            ];
        }
    }

    /**
     *  All Crypto list for faucetpay
     *
     *  Response Example:
     *
     * {
     *   "status": 200,
     *   "message": "OK",
     *   "currencies": [
     *       "BTC",
     *       "ETH"
     *   ],
     *   "currencies_names": [
     *       {
     *       "name": "Bitcoin",
     *       "acronym": "BTC"
     *       },
     *       {
     *       "name": "Ethereum",
     *       "acronym": "ETH"
     *       }
     *   ]
     *   }
     *
     * @param null
     * @return array
     */
    public function currencies()
    {
        $response = Http::asForm()->post($this->url . 'currencies', [
            'api_key' => $this->api_key,
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return [
                'status' => false,
            ];
        }
    }

    /**
     *  Check address exist or not
     *
     *  Response Example:
     *
     * {
     *   "status": 200,
     *   "message": "OK",
     *   "payout_user_hash": "b8446e7a814d677f5e381f2e05206bf0cee6d063"
     * }
     *
     * For not found:
     * {
     *   "status": 456,
     *   "message": "The address does not belong to any user."
     * }
     *
     * @param string
     * @return array
     */
    public function checkAddress($address)
    {
        $response = Http::asForm()->post($this->url . 'checkaddress', [
            'api_key' => $this->api_key,
            'address' => $address,
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return [
                'status' => false,
            ];
        }
    }

    /**
     *  Send payment for faucetpay address
     *
     *  Response Example:
     *
     * {
     *   "status": 200,
     *   "message": "OK",
     *   "rate_limit_remaining": 9.99780024,
     *   "currency": "BTC",
     *   "balance": "8673047351",
     *   "balance_bitcoin": "86.73047351",
     *   "payout_id": 109,
     *   "payout_user_hash": "c448e31098a8dfb48248f7e2374e77674bb90925"
     * }
     *
     * @param address|string ammount|float
     * @return array
     */
    public function send($address, $ammount, $cripto = '')
    {
        $response = Http::asForm()->post($this->url . 'send', [
            'api_key' => $this->api_key,
            'amount' => $ammount,
            'to' => $address,
            'currency' => $cripto ? $cripto : $this->cripto,
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return [
                'status' => false,
            ];
        }
    }

    /**
     *  List of recent transions
     *
     *  Response Example:
     *
     * {
     *   "status": 200,
     *   "message": "OK",
     *   "rewards": [
     *       {
     *       "to": "ADDRESS",
     *       "amount": 10451,
     *       "date": "14-06-18 03:11:59 GMT"
     *       },
     *       {
     *       "to": "ADDRESS",
     *       "amount": 151,
     *       "date": "10-06-18 03:11:59 GMT"
     *       }
     *   ]
     * }
     *
     * @param $count|int Default = 10
     * @return array
     */
    public function recent($count = 10, $cripto = '')
    {
        $response = Http::asForm()->post($this->url . 'payouts', [
            'api_key' => $this->api_key,
            'currency' => $cripto ? $cripto : $this->cripto,
            'count' => $count,
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return [
                'status' => false,
            ];
        }
    }

    /**
     *  Faucet list for faucetpay
     *
     *  Response Example:
     * {
     *   "status": 200,
     *   "message": "OK",
     *   "list_data": {
     *       "normal": {
     *       "BTC": [
     *           {
     *           "id": 1,
     *           "name": "Rushbitcoin.com",
     *           "url": "https://rushbitcoin.com",
     *           "owner_id": "734",
     *           "owner_name": "anteruzic1",
     *           "currency": "BTC",
     *           "timer_in_minutes": "60",
     *           "reward": "0",
     *           "is_enabled": "0",
     *           "creation_date": "0",
     *           "category": null,
     *           "paid_today": "0.000000",
     *           "total_users_paid": "0",
     *           "active_users": "0",
     *           "balance": "0.00000000",
     *           "health": "0"
     *           }
     *       ]
     *       }
     *   }
     *   }
     *
     * @param null
     * @return array
     */
    public function faucetList()
    {
        $response = Http::asForm()->post('https://faucetpay.io/api/listv1/faucetlist', [
            'api_key' => $this->api_key,
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return [
                'status' => false,
            ];
        }
    }
}
