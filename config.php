<?php

use Fortvision\Client\HttpClient;

return [
    'FORTVISION_URL_PRODUCTION' => 'https://fb.fortvision.com/fb',
    'FORTVISION_URL_TEST' => 'https://3.249.178.183:1337',
    'FORTVISION_URL_EXPORT_PRODUCTION' => 'https://smc2t4kcbb.execute-api.eu-west-1.amazonaws.com/1/plugin/aggregate',
    'FORTVISION_URL_EXPORT_TEST' => 'https://hqn6787tyl.execute-api.eu-west-1.amazonaws.com/1/plugin/aggreate',
    'FORTVISION_MODE' => HttpClient::MODE_PROD, // mode is PROD or TEST
    'FORTVISION_PLUGIN' => '',
    'FORTVISION_PUBLISHER_ID' => ''
];
