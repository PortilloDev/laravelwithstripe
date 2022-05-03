<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait Services
{
    public function makeRequest(string $method, string $requestUrl, array $queryParams = [], array $formParams = [], 
        array $headers = [], bool $isJsonRequest = false) 
        {
            $client = new Client([
                'base_uri' => $this->baseUri,

            ]); 

            if(method_exists($this, 'resolveAuthorization')) {
                $this->resolveAuthorization($queryParams, $formParams, $headers);
            }
            
            $response = $client->request($method, $requestUrl, [
                $isJsonRequest ? 'json' : 'form_params' => $formParams,
                'headers' => $headers,
                'query' => $queryParams
            ]);

            $response = $response->getBody()->getContents();

            if(method_exists($this, 'decodeResponse')) {
                $this->decodeResponse($response);
            }

            return $response;
        }
}