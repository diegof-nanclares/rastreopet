<?php

namespace Core;

/**
 * Class App
 * @package App\Core
 */
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    protected $config;
    protected $controllerInstance;

    /**
     * App constructor.
     * @param $config
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        \Models\Core\Database::getInstance($config['database']);
    }

    protected function parseUrl()
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $url = explode('?', $url)[0];
        $url = explode('/', $url);
        $url = array_filter($url);
        $url = array_values($url);
        if (count($url)) {
            // Exclude lib calls
            if(ucfirst($url[0]) === "Lib") {
                return false;
            }

             if($url[0] == "rastreopet") {
                $url[0] = "home";
            
             }   
            $this->controller = ucfirst($url[0]) . 'Controller';
            if (count($url) > 1) {
                $this->method = $url[1];
                if (count($url) > 2) {
                    $this->params = array_slice($url, 2);
                }
            }

            // Check other files js or css to exclude from the controller
            $lastSegment = end($url);
            if (preg_match('/\.(css|js|jpg|png|ico|ttf|phtml)$/', $lastSegment)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @throws \Exception
     */
    protected function loadController()
    {
        $controllerClass = "Controllers\\{$this->controller}";
        if (!class_exists($controllerClass)) {
            throw new \Exception("Controller class {$controllerClass} not found.");
        }

        $this->controllerInstance = new $controllerClass;
    }

    /**
     * @throws \Exception
     */
    protected function callMethod()
    {
        if (!method_exists($this->controllerInstance, $this->method)) {
            throw new \Exception("Method {$this->method} not found in controller {$this->controllerInstance}.");
        }
        call_user_func_array([$this->controllerInstance, $this->method], $this->params);
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        $proccessController = $this->parseUrl();
        if($proccessController) {
            $this->loadController();
            $this->callMethod();
        }
    }
}
