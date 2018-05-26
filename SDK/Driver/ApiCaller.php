<?php

namespace InfoSirene\SDK\Driver;

use GuzzleHttp\Client;

class ApiCaller
{
    const HOSTNAME = "https://api.info-sirene.com/";
    
    /** @var Client $client */
    private $client;

    /**
     * ApiCaller constructor.
     * @param $apiKey
     * @param $secretKey
     */
    public function __construct($apiKey, $secretKey) {
        
        $this->apiKey = $apiKey;
        
        $this->secretKey = $secretKey;

        $this->client = new Client(array(
            'timeout' => 5
        ));
    }

    /**
     * GET Method to retrieve entities from API
     * @param $endpoint
     * @param array $parameters
     * @return null
     */
    public function get($endpoint, Array $parameters = array()) {
        $ps = http_build_query($parameters);

        return $this->callApi('GET', $endpoint.'?'.$ps);
    }

    /**
     * @param array $keys
     * @return array
     */
    public function formatParameters(Array $keys) {
        $parameters = [];
        
        foreach($keys as $key => $info) {
            $field = $info['field'];
            $value = $info['value'];
            
            if(!array_key_exists($field,$parameters)) {
                $parameters[$field] = [];
            }
            
            $parameters[$field][] = $value;
        }
        
        return $parameters;
    }

    /**
     * @param $method
     * @param $endpoint
     * @return null
     */
    private function callApi($method, $endpoint) {
        $responseData = null;

        $postParameters['headers'] = array(
            "user-name"  => $this->apiKey,
            "user-token" => $this->secretKey
        );

        $result   = $this->client->request($method, self::HOSTNAME.$endpoint, $postParameters);
        $status   = $result->getStatusCode();
        $response = $result->getBody();

        if(is_object($response) && $status == 200) {
            $data = json_decode($response->getContents(), true);

            if(isset($data['data']) && is_array($data['data']) && !empty($data['data'])) {
                $responseData = $data['data'];
            } elseif(isset($data['departments']) && is_array($data['departments']) && !empty($data['departments'])) {
                $responseData = $data['departments'];
            } elseif(isset($data['Postal_Codes']) && is_array($data['Postal_Codes']) && !empty($data['Postal_Codes'])) {
                $responseData = $data['Postal_Codes'];
            }
        }

        return $responseData;
    }
}
