<?php

namespace Config;

class Routing extends \CodeIgniter\Config\Routing
{
    /**
     * An array of files that contain route definitions.
     */
    public array $routeFiles = [
        APPPATH . 'Config/Routes.php',
    ];

    /**
     * Whether to override the 404 error status code to 200.
     */
    public ?string $override404 = null;

    /**
     * Whether to auto route matching URIs to Controllers.
     */
    public bool $autoRoute = false;
}
