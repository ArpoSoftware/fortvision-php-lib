<?php

namespace Fortvision\Action;

use Fortvision\Client\HttpClient;
use Fortvision\Entity\UserInfo;

class UserAction extends AbstractAction
{
    const USER_LOGIN_ENDPOINT = '/users/login';
    const USER_ENDPOINT = '/users/register';
    const USER_UPDATE_ENDPOINT = '/users';
    const USER_SUBSCRIPTION = '/users/subscription';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @param string $mode
     * @throws \Fortvision\Exception\RuntimeException
     */
    public function __construct(string $mode = '')
    {
        $this->client = new HttpClient($mode);
    }

    /**
     * @param UserInfo $userInfo
     * @return bool|string
     * @throws \Fortvision\Exception\RequestExeption
     */
    public function login(UserInfo $userInfo)
    {
        $data['userInfo'] = $userInfo->getData();
        $dataJson = \json_encode($data);

        $result = $this->client->doRequest(self::USER_LOGIN_ENDPOINT, $dataJson, HttpClient::METHOD_PUT);
        return $result;
    }

    /**
     * @param UserInfo $userInfo
     * @return bool|string
     * @throws \Fortvision\Exception\RequestExeption
     */
    public function register(UserInfo $userInfo)
    {
        $data['userInfo'] = $userInfo->getData();
        $dataJson = \json_encode($data);

        $result = $this->client->doRequest(self::USER_ENDPOINT, $dataJson, HttpClient::METHOD_PUT);
        return $result;
    }

    /**
     * @param UserInfo $userInfo
     * @param $subscriptionType
     * @return bool|string
     * @throws \Fortvision\Exception\RequestExeption
     */
    public function subscription(UserInfo $userInfo, $subscriptionType = 1)
    {
        $data['userInfo'] = $userInfo->getData();
        $data['subscriptionType'] = $subscriptionType;
        $dataJson = \json_encode($data);

        $result = $this->client->doRequest(self::USER_SUBSCRIPTION, $dataJson, HttpClient::METHOD_POST);
        return $result;
    }

    /**
     * @param UserInfo $userInfo
     * @return bool|string
     * @throws \Fortvision\Exception\RequestExeption
     */
    public function updateUser(UserInfo $userInfo)
    {
        $data['userInfo'] = $userInfo->getData();
        $dataJson = \json_encode($data);

        $result = $this->client->doRequest(self::USER_UPDATE_ENDPOINT, $dataJson, HttpClient::METHOD_PUT);
        return $result;
    }
}
