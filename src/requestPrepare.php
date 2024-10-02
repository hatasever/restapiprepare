<?php

namespace hatasever\restapiprepare;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
class requestPrepare
{

    protected $baseUrl;

    protected $method;

    protected $params;

    protected $headers;

    protected $connect;

    function __construct(string $baseUrl, array $headers)
    {
        $this->baseUrl = $baseUrl;
        $this->headers = $headers;

        $this->connect = new Client(["headers" => $headers]);
    }

    public function sendPublicRequest(string $method,string $subUrl, $params = [] , $body = [])
    {
        $convertingURL = $this->baseUrl. (substr($this->baseUrl, -1) == '/' ? $subUrl : '/'.$subUrl);
        $req = new Request(strtoupper($method), $convertingURL, [
            'headers' => $this->headers,
            'body' => json_encode($body)
        ]);
        $res = $this->connect->send($req);

        return $res->getBody();


    }


}