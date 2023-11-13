<?php

namespace Fortvision\Client;

use Psr\Http\Message\ResponseInterface;
use Fortvision\Exception\RequestExeption;
use Fortvision\Exception\RuntimeException;
use Fortvision\Model\Config;

class HttpClient
{
    const MODE_PROD = 'PROD';
    const MODE_TEST = 'TEST';
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * @var mixed|string
     */
    private $urlProdoction = '';

    /**
     * @var mixed|string
     */
    private $urlTesting = '';

    /**
     * @var mixed|string
     */
    private $urlExportProdoction = '';

    /**
     * @var mixed|string
     */
    private $urlExportTesting = '';

    /**
     * @var string
     */
    private $mode;

    /**
     * @param string $mode
     */
    public function __construct(string $mode = '')
    {
        try {
            $this->urlProdoction = Config::getUrlProdoction();
            $this->urlTesting = Config::getUrlTesting();
            $this->urlExportProdoction = Config::getUrlExportProdoction();
            $this->urlExportTesting = Config::getUrlExportTesting();
            $this->mode = empty($mode) ? Config::getMode() : $mode;
        } catch (\Exception $e) {
            throw new RuntimeException('HttpClient Runtime error: ' . $e->getMessage());
        }
    }

    /**
     * @param string $uriEndpoint
     * @param string $body
     * @param string $requestMethod
     * @return bool|string
     * @throws RequestExeption
     */
    public function doRequest(string $uriEndpoint, string $body, string $requestMethod = self::METHOD_PUT)
    {
        try {
            $url = $this->getUrl($uriEndpoint);
            $curl = \curl_init();

            \curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $requestMethod,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = \curl_exec($curl);
            $curlInfo = \curl_getinfo($curl);
            \curl_close($curl);

            if (empty($curlInfo) || $curlInfo['http_code'] != 204) {
                throw new RequestExeption('Fortvision request error: ' . \json_encode([$curlInfo]));
            }
        } catch (\Exception $e) {
            throw new RequestExeption('Fortvision Error: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * @param string $body
     * @return bool|string
     * @throws RequestExeption
     */
    public function doExportRequest(string $body)
    {
        $this->mode === self::MODE_PROD ? $url = $this->urlExportProdoction : $url = $this->urlExportTesting;

        try {
            $curl = \curl_init();

            \curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => self::METHOD_POST,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = \curl_exec($curl);
            \curl_close($curl);
        } catch (\Exception $e) {
            throw new RequestExeption('Fortvision Sync Error: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * @param string $uriEndpoint
     * @return string
     */
    private function getUrl(string $uriEndpoint)
    {
        if ($this->mode === self::MODE_PROD) {
            $url = $this->urlProdoction . $uriEndpoint;
        } else {
            $url = $this->urlTesting . $uriEndpoint;
        }

        return $url;
    }

    /**
     * @param array $params
     * @return void
     */
    private function setHeaders(array &$params)
    {
        $headers = [
            'Accept-Encoding' => 'gzip, deflate',
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/xml'
        ];

        $headers = isset($params['headers']) ? array_merge($headers, $params['headers']) : $headers;
        $params['headers'] = $headers;
    }

    /**
     * @param string $urlProdoction
     * @return $this
     */
    public function setUrlProdoction(string $urlProdoction)
    {
        $this->urlProdoction = $urlProdoction;
        return $this;
    }

    /**
     * @param string $urlTesting
     * @return $this
     */
    public function setUrlTesting(string $urlTesting)
    {
        $this->urlTesting = $urlTesting;
        return $this;
    }

    /**
     * @param string $urlExportProdoction
     * @return $this
     */
    public function setUrlExportProdoction(string $urlExportProdoction)
    {
        $this->urlExportProdoction = $urlExportProdoction;
        return $this;
    }

    /**
     * @param string $urlExportTesting
     * @return $this
     */
    public function setUrlExportTesting(string $urlExportTesting)
    {
        $this->urlExportTesting = $urlExportTesting;
        return $this;
    }
}
