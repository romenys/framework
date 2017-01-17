<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/12/16
 * Time: 20:01
 */

namespace Romenys\Framework\Components\DB;

use Romenys\Framework\Components\Parameters;

class DB extends \PDO
{
    private $parameters = [];

    private $instance = null;

    public function __construct()
    {
        $this->setParameters();
        $this->connect();
    }

    private function setParameters()
    {
        $parameters = new Parameters();

        $this->parameters = $parameters->getParameters();

        return $this;
    }

    private function getParameters()
    {
        return $this->parameters;
    }

    public function connect()
    {
        if (strtolower($this->getParameters()["db_driver"]) === "pdo_mysql") {
            try {
                if (!isset($this->getParameters()["db_charset"]) || $this->getParameters()["db_charset"]) $db_charset = "latin1";
                else $db_charset = $this->getParameters()["db_charset"];

                return new \PDO(
                    "mysql:host=" . $this->getParameters()["db_host"] .
                    ";dbname=" . $this->getParameters()["db_name"] . ";charset=" . $db_charset,
                    $this->getParameters()["db_user"], $this->getParameters()["db_pass"]
                );
            } catch (\PDOException $e) {
                if (!$this->getParameters()["debug"])
                    exit("Unable to connect to db");
                else
                    dump($e);
            }
        }

        return $this->instance;
    }
}
