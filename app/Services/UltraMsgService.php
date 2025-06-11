<?php

namespace App\Services;

class UltraMsgService
{
    protected $instanceId;
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->instanceId = config('ultramsg.instance_id');
        $this->token = config('ultramsg.token');
        $this->baseUrl = rtrim(config('ultramsg.base_url'), '/');
    }

    public function sendMessage($to, $message)
    {
        $url = "{$this->baseUrl}/messages/chat";

        $params = [
            'token' => $this->token,
            'to'    => $to,
            'body'  => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CAINFO, 'C:/xampp/php/extras/ssl/cacert.pem'); // Replace path if different

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
