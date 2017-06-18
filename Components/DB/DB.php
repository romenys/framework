<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/12/16
 * Time: 20:01
 */

namespace PhpLight\Framework\Components\DB;

use PhpLight\Framework\Components\Parameters;

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
        $this->parameters = (new Parameters())->getParameters();

        return $this;
    }

    public function connect()
    {
        try {
            if (!isset($this->parameters["db_charset"])) $db_charset = "latin1";
            else $db_charset = $this->parameters["db_charset"];

            return new \PDO(
                "mysql:host=" . $this->parameters["db_host"] .
                ";dbname=" . $this->parameters["db_name"] . ";charset=" . $db_charset,
                $this->parameters["db_user"], $this->parameters["db_pass"]
            );
        } catch (\PDOException $e) {
            if (!$this->parameters["debug"]) {
                exit("Unable to connect to db");
            } else {
                dump($e);
                exit("Unable to connect to db");
            }
        }
    }
}
