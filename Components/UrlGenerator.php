<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 01/12/16
 * Time: 18:25
 */

namespace Romenys\Framework\Components;

use Romenys\Router\Util\Router;
use Romenys\Http\Request\Request;

class UrlGenerator
{
    private $routes;

    private $request;

    public function __construct(Request $request)
    {
        $this->setRoutes();
        $this->setRequest($request);
    }

    private function setRoutes()
    {
        $router = new Router();

        $this->routes = $router->getRoutes();

        return $this;
    }

    private function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    private function getRequest()
    {
        return $this->request;
    }

    public function relative($routeName)
    {
        return $this->routes[$routeName]["path"];
    }

    public function absolute($routeName = null)
    {
        $url = $this->getRequest()->getUrl();
        return $url["scheme"] . "://" . $url["host"] . '/app.php?route=' . $routeName;
    }
}