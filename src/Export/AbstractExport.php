<?php

namespace Fortvision\Export;

use Fortvision\Client\HttpClient;

abstract class AbstractExport
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @param string $mode
     * @throws \Fortvision\Exception\RuntimeException
     */
    public function __construct(string $mode = '')
    {
        $this->client = new HttpClient($mode);
    }

    /**
     * @param string $mode
     * @return static
     * @throws \Fortvision\Exception\RuntimeException
     */
    public static function create(string $mode = '')
    {
        return new static($mode);
    }

    /**
     * @param array $data
     * @return mixed
     */
    abstract public function export(array $data);
}
