<?php

namespace InfoSirene\SDK;
use InfoSirene\SDK\Driver\ApiCaller;
use InfoSirene\SDK\Driver\ApiDriver;
use InfoSirene\SDK\Driver\Endpoint;

/**
 * Class Api
 * @package InfoSirene\SDK
 */
class Api {

    /** @var string $apiKey */
    private $apiKey;

    /** @var string $secretKey */
    private $secretKey;

    /** @var array $keys */
    private $keys = [];

    /**
     * Api constructor.
     * @param $apiKey
     * @param $secretKey
     */
    public function __construct($apiKey, $secretKey) {
        $this->apiKey    = $apiKey;
        $this->secretKey = $secretKey;
    }

    /**
     * @param $siren
     * @return $this
     */
    public function addSiren($siren) {
        $this->keys[] = [
            'field' => 'SIREN',
            'value' => $siren
        ];

        return $this;
    }

    /**
     * @param $nic
     * @return $this
     */
    public function addNic($nic) {
        $this->keys[] = [
            'field' => 'NIC',
            'value' => $nic
        ];

        return $this;
    }

    /**
     * @return $this
     */
    public function headOfficeOnly() {
        $this->keys[] = [
            'field' => 'SIEGE',
            'value' => 1
        ];

        return $this;
    }

    /**
     * @param $ape
     * @return $this
     */
    public function addApe($ape) {
        $this->key[] = [
            'field' => 'APE',
            'value' => $ape
        ];
        
        return $this;
    }

    /**
     * @param $activity
     * @return $this
     */
    public function addActivity($activity) {
        $this->key[] = [
            'field' => 'ACTIVITY',
            'value' => $activity
        ];

        return $this;
    }

    /**
     * @param $keyword
     * @return $this
     */
    public function addKeyword($keyword) {
        $this->key[] = [
            'field' => 'KEYWORD',
            'value' => $keyword
        ];

        return $this;
    }

    /**
     * @param $denomination
     * @return $this
     */
    public function addDenomination($denomination) {
        $this->key[] = [
            'field' => 'DENOMINATION',
            'value' => $denomination
        ];

        return $this;
    }

    /**
     * @param $department
     * @return $this
     */
    public function addDepartment($department) {
        $this->key[] = [
            'field' => 'DEPT',
            'value' => $department
        ];

        return $this;
    }

    /**
     * @param $postalCode
     * @return $this
     */
    public function addPostalCode($postalCode) {
        $this->key[] = [
            'field' => 'CP',
            'value' => $postalCode
        ];

        return $this;
    }

    /**
     * @param $city
     * @return $this
     */
    public function addCty($city) {
        $this->key[] = [
            'field' => 'CITY',
            'value' => $city
        ];

        return $this;
    }

    /**
     * @param $turnover
     * @return $this
     */
    public function addTurnover($turnover) {
        $this->key[] = [
            'field' => 'TURNOVER',
            'value' => $turnover
        ];

        return $this;
    }

    /**
     * @return $this
     */
    public function withPhone() {
        $this->key[] = [
            'field' => 'HASPHONE',
            'value' => 1
        ];

        return $this;
    }

    /**
     * @return $this
     */
    public function withEmail() {
        $this->key[] = [
            'field' => 'HASEMAIL',
            'value' => 1
        ];

        return $this;
    }

    /**
     * @param $page
     * @return $this
     */
    public function setPage($page) {
        $this->key[] = [
            'field' => 'PAGE',
            'value' => $page
        ];

        return $this;
    }

    /**
     * @param $origin
     * @return $this
     */
    public function setOrigin($origin) {
        $this->key[] = [
            'field' => 'ORIGIN',
            'value' => $origin
        ];

        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    public function forceOrder($order) {
        $this->key[] = [
            'field' => 'FORCE_ORDER',
            'value' => $order
        ];

        return $this;
    }

    /**
     * @param $quantity
     * @return $this
     */
    public function setQuantityPerPage($quantity) {
        $this->key[] = [
            'field' => 'QUANTITYPERPAGE',
            'value' => $quantity
        ];

        return $this;
    }

    /**
     * @param $effective
     * @return $this
     */
    public function addEffective($effective) {
        $this->key[] = [
            'field' => 'EFFECTIVE',
            'value' => $effective
        ];

        return $this;
    }

    /**
     * @param $createdDateMin
     * @return $this
     */
    public function setCreatedDateMin($createdDateMin) {
        $this->key[] = [
            'field' => 'CREATED_DATE_MIN',
            'value' => $createdDateMin
        ];

        return $this;
    }

    /**
     * @param $createdDateMax
     * @return $this
     */
    public function setCreatedDateMax($createdDateMax) {
        $this->key[] = [
            'field' => 'CREATED_DATE_MAX',
            'value' => $createdDateMax
        ];

        return $this;
    }

    /**
     * @return $this
     */
    public function forceRandom() {
        $this->key[] = [
            'field' => 'FORCE_RANDOM',
            'value' => 1
        ];

        return $this;
    }

    /**
     * @param string $endpoint
     * @return null
     */
    public function get($endpoint = Endpoint::ENDPOINT_SEARCH) {
        $api = new ApiCaller($this->apiKey, $this->secretKey);
        $parameters = $api->formatParameters($this->keys);
        return $api->get($endpoint,$parameters);
    }

}