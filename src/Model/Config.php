<?php

namespace Fortvision\Model;

class Config
{
    /**
     * @var array
     */
    private static $config = [];

    /**
     * @return array
     */
    public static function getConfig(): array
    {
        if (empty(self::$config)) {
            self::$config = include __DIR__ . '/../../config.php';
        }

        return self::$config;
    }

    /**
     * @param array $config
     * @return void
     */
    public static function setConfig(array $config)
    {
        self::$config = $config;
    }

    /**
     * @return string
     */
    public static function getUrlProdoction()
    {
        if (isset($_ENV['FORTVISION_URL_PRODUCTION'])) {
            return $_ENV['FORTVISION_URL_PRODUCTION'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_URL_PRODUCTION'];
    }

    /**
     * @return string
     */
    public static function getUrlTesting()
    {
        if (isset($_ENV['FORTVISION_URL_TEST'])) {
            return $_ENV['FORTVISION_URL_TEST'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_URL_TEST'];
    }

    /**
     * @return string
     */
    public static function getUrlExportProdoction()
    {
        if (isset($_ENV['FORTVISION_URL_EXPORT_PRODUCTION'])) {
            return $_ENV['FORTVISION_URL_EXPORT_PRODUCTION'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_URL_EXPORT_PRODUCTION'];
    }

    /**
     * @return string
     */
    public static function getUrlExportTesting()
    {
        if (isset($_ENV['FORTVISION_URL_EXPORT_TEST'])) {
            return $_ENV['FORTVISION_URL_EXPORT_TEST'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_URL_EXPORT_TEST'];
    }

    /**
     * @return string
     */
    public static function getMode()
    {
        if (isset($_ENV['FORTVISION_MODE'])) {
            return $_ENV['FORTVISION_MODE'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_MODE'];
    }

    /**
     * @return string
     */
    public static function getPlugin()
    {
        if (isset($_ENV['FORTVISION_PLUGIN'])) {
            return $_ENV['FORTVISION_PLUGIN'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_PLUGIN'];
    }

    /**
     * @return string
     */
    public static function getPublisherId()
    {
        if (isset($_ENV['FORTVISION_PUBLISHER_ID'])) {
            return $_ENV['FORTVISION_PUBLISHER_ID'];
        }

        $config = Config::getConfig();
        return $config['FORTVISION_PUBLISHER_ID'];
    }
}
