<?php

namespace Fortvision\Action;

class AbstractAction
{
    /**
     * @param string $mode
     * @return static
     */
    public static function create(string $mode = '')
    {
        return new static($mode);
    }
}
