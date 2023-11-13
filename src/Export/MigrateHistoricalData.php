<?php

namespace Fortvision\Export;

use Fortvision\Model\Config;

class MigrateHistoricalData extends AbstractExport
{
    /**
     * @return bool|string
     * @throws \Fortvision\Exception\RequestExeption
     */
    public function migrate()
    {
        $data['publisherId'] = Config::getPublisherId();
        $data['plugin'] = Config::getPlugin();
        $data['migrateHistoricalData'] = true;
        $body = \json_encode($data);

        return $this->client->doExportRequest($body);
    }

    /**
     * @param array $data
     * @return void
     */
    public function export(array $data)
    {
    }
}
