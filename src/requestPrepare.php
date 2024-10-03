<?php

namespace hatasever\restapiprepare;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
class requestPrepare
{

    protected $baseUrl = 'https://feed-definition.foreks.com/symbol/';

    protected $method;

    protected $params;

    protected $headers;

    protected $connect;

    function __construct(array $headers = NULL)
    {
        $this->headers = $headers;
        if (isset($headers)) {
            $this->connect = new Client(["headers" => [
                'Content-Type' => 'Application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST',
                'Access-Control-Allow-Headers' =>  "Content-Type, Authorization"
            ]]);
        }
        else
        {
            $this->connect = new Client(["headers" => $headers]);
        }

    }

    public function sendPublicRequest(string $method,string $subUrl, $params = [] , $body = [])
    {
        $convertingURL = $this->baseUrl. (substr($this->baseUrl, -1) == '/' ? $subUrl : '/'.$subUrl);
        $req = new Request(strtoupper($method), $convertingURL, [
            'headers' => $this->headers,
            'body' => json_encode($body)
        ]);
        $res = $this->connect->send($req);

        return json_decode($res->getBody());

    }
}