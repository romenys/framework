<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 01/12/16
 * Time: 16:35
 */

namespace PhpLight\Framework\Components;

use PhpLight\Framework\Controller\Controller;
use PhpLight\Http\Request\Request;
use PhpLight\Router\Util\Router;

class HandleRequest implements HandleRequestInterface
{
    private $request = null;

    private $routeName = "";

    private $routeDetails = [];

    private $controller = "";

    private $action = "";

    private $router = null;

    public function __construct($get, $post, $cookie, $files, $env, $session, $server)
    {
        $this->request = new Request($get, $post, $cookie, $files, $env, $session, $server);
        $this->router = new Router();
        $this->setRouteName();
        $this->setRouteDetails();
        $this->setController();
        $this->setAction();
    }

    private function setRouteName()
    {
        if (!isset($this->request->getGet()['route'])) $this->routeName = 'default';

        else $this->routeName = $this->request->getGet()['route'];

        return $this;
    }

    private function getRouteName()
    {
        return $this->routeName;
    }

    private function setRouteDetails()
    {
        foreach ($this->getRoutes() as $routeName => $routeDetails) {

            try {
                if ($this->getRouteName() !== "") {
                    if ($routeName === $this->getRouteName()) {
                        $this->routeDetails = $routeDetails;
                        break;
                    }
                } else {
                    throw new \RuntimeException("No route was set");
                }
            } catch (\RuntimeException $e) {
                exit($e->getMessage());
            }
        }

        return $this;
    }

    private function getRouteDetails()
    {
        return $this->routeDetails;
    }

    private function getRoutes()
    {
        return $this->router->getRoutes();
    }

    private function setController()
    {
        try {
            if (!isset($this->getRouteDetails()["controller"]) || trim($this->getRouteDetails()["controller"] === "")) {
                throw new \RuntimeException("No controller was set for the route <strong>" . $this->getRouteName() . "</strong>");
            }

            $controller = $this->getRouteDetails()["controller"] . "Controller";

            if (!is_object(new $controller)) {
                throw new \RuntimeException("The controller set for the route <strong>" . $this->getRouteName()
                    . "</strong> was not found. Maybe there is a typo in the namespace");
            }

            if (!is_subclass_of(new $controller, Controller::class)) {
                throw new \RuntimeException("The controller <strong>" . $controller . "</strong> must extend "
                    . "<strong>PhpLight\\Framework\\Controller\\Controller</strong>");
            }

            $this->controller = $controller;
        } catch (\RuntimeException $e) {
            exit($e->getMessage());
        }

        return $this;
    }

    private function getController()
    {
        return $this->controller;
    }

    private function setAction()
    {
        $controllerName = $this->getController();
        $controller = new $controllerName;
        $routeDetails = $this->getRouteDetails();

        try {
            if (!isset($routeDetails["action"])) {
                throw new \RuntimeException("No action was specified in the route " . $this->getRouteName());
            }

            $actionName = $routeDetails["action"] . "Action";

            if (!method_exists($controller, $actionName)) {
                throw new \RuntimeException("The action <strong>" . $routeDetails["action"] . "Action</strong> in the route <strong>" .
                    $this->getRouteName() . "</strong> was not found in the controller <strong>" . $routeDetails['controller'] . "</strong>");
            }

            $this->action = $actionName;

        } catch (\RuntimeException $e) {
            exit($e->getMessage());
        }

        return $this;
    }

    private function getAction()
    {
        return $this->action;
    }

    public function handleRequest()
    {
        $controller = $this->getController();
        $action = $this->getAction();

        $controller = new $controller();

        $controller->{$action}($this->request);
    }
}