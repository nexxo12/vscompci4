<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Feature extends BaseConfig
{
    /**
     * Use improved code for auto-routing.
     */
    public bool $autoRoutesImproved = false;

    /**
     * Use filter execution order in 4.4.0 or before.
     */
    public bool $oldFilterOrder = false;
}
