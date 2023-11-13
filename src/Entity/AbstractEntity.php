<?php

namespace Fortvision\Entity;

use Fortvision\Exception\RuntimeException;

abstract class AbstractEntity extends \stdClass
{
    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @param $data
     */
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->setData($data);
        }
    }

    /**
     * @param $data
     * @return static
     */
    public static function create($data = [])
    {
        return new static($data);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function __get($key)
    {
        return array_key_exists($key, $this->_data) ? $this->_data[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function __set($key, $value)
    {
        $this->setData($key, $value);
        return $this;
    }

    /**
     * @param $method
     * @param $args
     * @return $this|array|bool|mixed|null
     * @throws RuntimeException
     */
    public function __call($method, $args)
    {
        switch (substr((string)$method, 0, 3)) {
            case 'get':
                $key = $this->_underscore(substr($method, 3));
                return $this->getData($key);
            case 'set':
                $key = $this->_underscore(substr($method, 3));
                $value = isset($args[0]) ? $args[0] : null;
                return $this->setData($key, $value);
            case 'uns':
                $key = $this->_underscore(substr($method, 3));
                return $this->unsetData($key);
            case 'has':
                $key = $this->_underscore(substr($method, 3));
                return isset($this->_data[$key]);
        }

        throw new RuntimeException('Invalid method ' . $method);
    }

    /**
     * @param $key
     * @return array|mixed|null
     */
    public function getData($key = '')
    {
        if ('' === $key) {
            return $this->_data;
        }

        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if ($key === (array)$key) {
            $this->_data = $key;
        } else {
            $this->$key = $value;
            $this->_data[$key] = $value;
        }

        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function unsetData($key = null)
    {
        if ($key === null) {
            $this->setData([]);
        } elseif (is_string($key)) {
            if (isset($this->_data[$key]) || array_key_exists($key, $this->_data)) {
                unset($this->_data[$key]);
            }
        } elseif ($key === (array)$key) {
            foreach ($key as $element) {
                $this->unsetData($element);
            }
        }

        return $this;
    }

    /**
     * @param $key
     * @return string
     */
    protected function _underscore($key)
    {
        $result = lcfirst($key);
        return $result;
    }
}
