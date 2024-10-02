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
     
        $res = $this->connect->request(strtoupper($method), $convertingURL, [
            'body' => json_encode($body)
        ]);

        return $res;

    }


}