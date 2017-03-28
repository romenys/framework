<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 19/12/16
 * Time: 21:08
 */

namespace PhpLight\Framework\Components;

use PhpLight\Helpers\GetEnvironmentByHostName;

class Config
{
    private $config;

    private $environmentSpecificParameters = null;

    private $environment;

    public function __construct()
    {
        $this->setEnvironment();
        $this->setConfig();
    }

    private function setEnvironment()
    {
        $environment = new GetEnvironmentByHostName;
        $this->environment = strtolower($environment->getEnv());

        return $this;
    }

    private function getEnvironment()
    {
        return $this->environment;
    }

    private function setEnvironmentSpecificParameters($environmentSpecificParameters)
    {
        $this->environmentSpecificParameters = $environmentSpecificParameters;

        return $this;
    }

    private function getEnvironmentSpecificParameters()
    {
        return $this->environmentSpecificParameters;
    }

    private function setConfig()
    {
        $environment = $this->getEnvironment();
        $this->config = json_decode(file_get_contents("app/config/config.json"), true);

        if (file_exists("app/config/config/" . $environment . ".json")) {
            $this->setEnvironmentSpecificParameters(json_decode(file_get_contents("app/config/config/" . $environment . ".json"), true));
        }

        if (is_array($this->getEnvironmentSpecificParameters()) && !empty($this->getEnvironmentSpecificParameters())) {
            $this->config = array_merge($this->config, $this->getEnvironmentSpecificParameters());
        }

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }
}