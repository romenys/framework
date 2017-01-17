<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 28/11/16
 * Time: 18:28
 */

namespace Romenys\Framework\Components;

use Romenys\Helpers\GetEnvironmentByHostName;

class Parameters
{
    private $environment;

    private $parameters = null;

    private $environmentSpecificParameters = null;

    public function __construct()
    {
        $this->setEnvironment();
        $this->setParameters();
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

    private function setParameters()
    {
        $environment = $this->getEnvironment();
        $this->parameters = json_decode(file_get_contents("app/config/parameters.json"), true);

        if (file_exists("app/config/parameters/" . $environment . ".json")) {
            $this->setEnvironmentSpecificParameters(json_decode(file_get_contents("app/config/parameters/" . $environment . ".json"), true));
        }

        if (is_array($this->getEnvironmentSpecificParameters()) && !empty($this->getEnvironmentSpecificParameters())) {
            $this->parameters = array_merge($this->parameters, $this->getEnvironmentSpecificParameters());
        }

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}
