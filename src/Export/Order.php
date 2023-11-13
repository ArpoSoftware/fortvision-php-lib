<?php

namespace Fortvision\Export;

use Fortvision\Model\Config;

class Order extends AbstractExport
{
    /**
     * @param array $data
     * @return bool|mixed|string
     * @throws \Fortvision\Exception\RequestExeption
     */
    public function export(array $data)
    {
        $dataExport['publisherId'] = Config::getPublisherId();
        $dataExport['plugin'] = Config::getPlugin();
        $dataExport['orders'] = $data;
        $body = \json_encode($dataExport);

        return $this->client->doExportRequest($body);
    }
}
